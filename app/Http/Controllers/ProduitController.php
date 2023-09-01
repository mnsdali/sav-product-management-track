<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Piece;
use App\Models\PiecesArticle;
use App\Models\PiecesVariation;
use App\Models\Produit;
use App\Models\Revendeur;
use App\Models\User;
use App\Models\Variation;
use App\Models\VariationsPorduit;
use App\Traits\ValidationCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

// import the Intervention Image Manager Class
use App\Traits\QrCodeCommon;
use App\Traits\ImagesCommon;
use App\Traits\ArticlesCommon;
use App\Traits\VariationsCommon;
use App\Traits\PiecesCommon;
use App\Traits\ProduitsCommon;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    use QrCodeCommon;
    use ImagesCommon;
    use ArticlesCommon;
    use PiecesCommon;
    use VariationsCommon;
    use ProduitsCommon;
    use ValidationCommon;



    public function changeState(Request $request){
        $reference = $request->input('reference');
        $produit = Produit::where('reference', $reference)->first();
        $produit->est_disponible = !$produit->est_disponible;
        $produit->save();
        $message = $produit->est_disponible == 0
                    ?  'Votre produit est maintenant en archive'
                    :  'Votre produit est maintenant en service';
        return response()->json(['message' => $message]);


    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::all();
        $revendeurs = User::role('revendeur')->get();
        $variations = Variation::join('produits', 'produits.reference', '=', 'variations.prod_ref')->get(['variations.*', 'produits.reference']);
        return view('produits.index', compact('variations','produits','revendeurs'));
    }

    public function listProduits()
    {
        $produits = Produit::all();
        $prodVariations = [];
        foreach($produits as $produit){

            $variations = Variation::join('produits', 'produits.reference', '=', 'variations.prod_ref')
                ->where('variations.prod_ref', $produit->reference)->get(['variations.*', 'produits.*']);
            $prodVariations[$produit->reference] = $variations;
        }

        return view('produits.index2', compact('prodVariations'));
    }

    public function listProduitsRevendeur()
    {
        $rev = Auth::user();
        $articles = Article::where('rev_email', $rev->email)
        ->join('variations_produits', 'variations_produits.designation', '=', 'articles.var_designation')
        ->join('produits', 'produits.reference', '=', 'variations_produits.prod_ref')
        ->get();
        return view('produits.rev-list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pieces = Piece::all();
        return view('produits.create', compact('pieces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validateProdCreation($request);
        $this->validateVarCreation($request);
        $this->validatePieceSelect($request);

        // Access the product data
        $referenceProd = $request->input('referenceProd');
        $nomProd = $request->input('nomProd');
        $descriptionProd = $request->input('descriptionProd');
        $prixProd = $request->input('prixProd');

        // Access the series data
        $designations = $request->input('designations');
        $quantities = $request->input('quantities');

        // Access the pieces data
        $referencesPieces = $request->input('referencesPieces');
        $success = null;
        $warning = null;
        $this->enregistrerProduit($referenceProd, $nomProd, $descriptionProd, $prixProd);

        for($desigIdx=0; $desigIdx<count($designations);$desigIdx++){
            $article = Article::where('var_designation', $designations[$desigIdx])->first();
            if($article == null){
                $this->enregistrerVariation($designations[$desigIdx], $referenceProd);
                // $this->enregistrerArticles($referenceProd, $designations[$desigIdx], intval($quantities[$desigIdx]));
                $this->enregistrerArticlesSansProdReference( $designations[$desigIdx], intval($quantities[$desigIdx]));

                foreach ($referencesPieces[$desigIdx] as $referencePiece){
                    $this->enregistrerPieceVariation($referencePiece, $designations[$desigIdx], $quantities[$desigIdx]);
                }
                $success = "Les séries qui n'ont pas déja été crées sont ajoutées avec succés";
            }
            else{
                $warning = "Un ou quelques séries que vous souhaiterez ajouter sont déja inclus dans le stock!";
            }
        }
        return redirect()->route('produits.list')->with(['success'=> $success, 'warning'=>$warning]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $ref_prod = $request->get('ref');
        $produit = Produit::where('reference', $ref_prod)->get();

        return response()->json($produit);
    }

    public function load(Request $request)
    {
        $produits = Produit::all();

        return response()->json($produits);
    }

    public function modify()
    {
        $produits = Produit::all();
        return view('produits.modify', compact('produits'));
    }

    public function maj(Request $request)
    {
        // $produits = Produit::all();
        // return view('produits.modify'); //, compact('produits'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit){

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        //
    }
}
