<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Piece;
use App\Models\PiecesVariation;
use App\Models\Produit;
use App\Models\Revendeur;
use App\Models\RevendeurCommande;
use App\Models\User;
use App\Models\Variation;
use App\Models\VariationsPorduit;
use App\Traits\ValidationCommon;
use Illuminate\Http\Request;

use App\Traits\QrCodeCommon;
use App\Traits\ImagesCommon;
use App\Traits\ArticlesCommon;
use App\Traits\VariationsCommon;
use App\Traits\PiecesCommon;
use Illuminate\Support\Facades\Storage;

class VariationController extends Controller
{
    use QrCodeCommon;
    use ImagesCommon;
    use ArticlesCommon;
    use PiecesCommon;
    use VariationsCommon;
    use ValidationCommon;

    public function savePieceModal($reference , $designation, $photo, $indice_arrivage, $qte_stock){
        $piece = new Piece();
        $piece->ref = $reference;
        $piece->designation = $designation;
        $piece->indice_arrivage = $indice_arrivage;
        $piece->qte_stock = $qte_stock;
        $this->saveImage($piece, $photo, 'app/public/photos/pieces');
        $piece->save();

        return $piece;
    }

    public function storePieceModal(Request $request)
    {
        // dd($request->get('reference'),$request->get('designation'), $request->file('photo'),$request->get('indice_arrivage'));
        $reference = $request->get('reference');
        $designation = $request->get('designation');
        $photo = $request->file('photo');
        $indice_arrivage = $request->get('indice_arrivage');
        $qte_stock = $request->get('qte_stock');

        $photo = isset($photo) ? $photo : null;

        $piece = $this->savePieceModal($reference , $designation, $photo, $indice_arrivage, $qte_stock );
        return response()->json(['piece' => $piece]);
    }








    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::all();
        $revendeurs = User::role('revendeur')->get();
        $variations = Variation::join('produits', 'variations.prod_ref', '=', 'produits.reference')
                                ->get(['variations.*', 'produits.*']);
        return view('variations.index', compact('variations','revendeurs', 'produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $produits = Produit::all();
        $pieces =  Piece::all();
        return view('variations.create', compact('pieces', 'produits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateVarCreation($request);
        $this->validatePieceSelect($request);
        // Access the product data
        $referenceProd = $request->input('referenceProd');

        // Access the series data
        $designations = $request->input('designations');
        $quantities = $request->input('quantities');
        $success = null;
        $warning = null;
        // Access the pieces data
        $referencesPieces = $request->input('referencesPieces');
        for($desigIdx=0; $desigIdx<count($designations);$desigIdx++){
            $article = Article::where('var_designation', $designations[$desigIdx])->first();
            if($article == null){
                $this->enregistrerVariation($designations[$desigIdx], $referenceProd);
                // $this->enregistrerArticles($referenceProd, $designations[$desigIdx], intval($quantities[$desigIdx]));
                $this->enregistrerArticlesSansProdReference( $designations[$desigIdx], intval($quantities[$desigIdx]));

                foreach ($referencesPieces[$desigIdx] as $referencePiece){
                    $this->enregistrerPieceVariation($referencePiece, $designations[$desigIdx], intval($quantities[$desigIdx]));
                }

                $success = "Les séries qui n'ont pas déja été crées sont ajoutées avec succés";

            }else{
                $warning = "Un ou quelques produits que vous souhaiterez ajouter sont déja inclus dans le stock!";
            }
        }
        return redirect()->route('variations.create')->with(['success'=> $success, 'warning'=>$warning]);

    }

    public function changeState(Request $request){
        $designation = $request->get('designation');
        $variation = Variation::where('designation', $designation)->first();
        $variation->est_disponible = !$variation->est_disponible;
        $variation->save();
        $message = $variation->est_disponible == 0
                    ?  'Votre série est maintenant en archive'
                    :  'Votre série est maintenant en service';
        return response()->json(['message' => $message]);
    }

    public function addMore(Request $request)
    {
        $referencesProd = $request->input('referencesProd');
        $designations = $request->input('designations');
        $quantities = $request->input('quantities');
        $referencesPieces = $request->input('referencesPieces');

        for($desigIdx=0; $desigIdx<count($designations);$desigIdx++){
            if ( Variation::where(['designation'=>$designations[$desigIdx]])->exists()){
                continue;
            }else{
                $this->enregistrerVariation($designations[$desigIdx], $referencesProd[$desigIdx]);
                $this->enregistrerArticlesSansProdReference( $designations[$desigIdx], intval($quantities[$desigIdx]));

            }
        }

        // for($i = 0; $i<count($designations); $i++){
        //     $this->enregistrerArticles( $designations[$i], intval($quantities[$i]));
        // }

        $success= "Ajout des variations avec succés";
        return redirect()->route('variations.create')->with('success', $success);

    }

    public function printQrs($designation){
        $variation = Variation::where('designation', $designation)->first();
        $articles = Article::where('var_designation', $designation)->get();
        $parent = 'photos/qr_codes';
        // $dirLen = strlen($dir);
        $files = Storage::disk('public')->files($parent);
        // dd($files);
        $qrCodes = [];
        foreach ($articles as $article){
            foreach ($files as $file) {
                if (str_contains($file, $article->serie_number)) {
                    array_push($qrCodes,  $file);
                }
            }
        }
        return view('variations.print-qrs', compact('qrCodes','variation'));
    }

    public function showArticles($designation){
        $variation = Variation::where('designation', $designation)->first();
        $articles = Article::where('var_designation', $designation)->get();
        $parent = 'photos/qr_codes';
        // $dirLen = strlen($dir);
        $files = Storage::disk('public')->files($parent);
        // dd($files);
        $qrCodes = [];
        foreach ($articles as $article){
            $qrCodeSub = [];
            for ($i=0; $i<count($files); $i+=3) {
                if (str_contains($files[$i], $article->serie_number)) {
                    array_push($qrCodeSub,  $files[$i]);
                    array_push($qrCodeSub,  $files[$i+1]);
                    array_push($qrCodeSub,  $files[$i+2]);
                    break;
                }
            }
            $qrCodes[$article->serie_number] = $qrCodeSub;
        }
        return view('variations.show-articles', compact('qrCodes','articles','variation'));
    }


    //
    /**
     * Display the specified resource.
     */
    public function show(Variation $variation)
    {
        //
    }
    public function reloadProducts(Request $request)
    {
        $produits = Produit::all();

        return response()->json($produits);
    }

    public function editSerie()
    {
        $variations = Variation::all();
        $pieces = Piece::all();
        return view('variations.add-pieces', compact('variations', 'pieces'));
    }

    public function updateSerie(Request $request)
    {
        $this->validateVarSelect($request);
        $this->validatePieceSelect($request);

        // Access the series data
        $designation = $request->input('var_designation');
        $quantity = $request->input('quantity');
        $success = null;
        $warning = null;
        // Access the pieces data
        $referencesPieces = $request->input('referencesPieces');
        $this->enregistrerArticlesSansProdReference( $designation, intval($quantity));
        foreach ($referencesPieces as $referencePiece){
            $this->enregistrerPieceVariation($referencePiece, $designation, intval($quantity));
        }

        $success = "La série est à jour";
        return redirect()->route('produits.list')->with(['success'=> $success]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variation $variation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variation $variation)
    {
        //
    }
}
