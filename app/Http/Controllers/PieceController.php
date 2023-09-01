<?php

namespace App\Http\Controllers;

use App\Models\ArticlesPiece;
use App\Models\Piece;
use App\Models\Produit;
use App\Models\Variation;
use App\Traits\ImagesCommon;
use App\Traits\QrCodeCommon;
use App\Traits\ValidationCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PieceController extends Controller
{
    use ValidationCommon;
    use ImagesCommon;
    use QrCodeCommon;
    // update piece through modal
    public function maj(Request $request){
        $originalRef = $request->input('pieceRefOld');
        $reference = $request->input('reference');
        $designation = $request->input('designation');
        $photo = $request->file('photo');
        $indice_arrivage = $request->input('indice_arrivage');
        $qte_stock = $request->input('pieceQteStock');

        $piece = Piece::where('ref', $originalRef)->first();
        $pieceToCheck = Piece::where('ref', $reference)->first();
        if ($pieceToCheck != null && $pieceToCheck != $piece) {
            return response()->json(['error' => "vous devez modifier la référence avec une autre inexistante! \n mise à jour non abouti."]) ;
        }
        $piece->ref = $reference;
        if (isset($photo)){
            $this->saveImage($piece, $photo, 'app/public/photos/pieces');
        }
        if (isset($designation)){
            $piece->designation = $designation;
        }
        if (isset($indice_arrivage)){
            $piece->indice_arrivage = $indice_arrivage;
        }
        if (isset($qte_stock) ){
            if ($qte_stock < $piece->qte_sav){
                $piece->save();
                return response()->json(['warning' => "la quantité totale en stock ne doit pas étre inférieur à la quantité de piéces utilisés pour le sav! quantité non à jour", 'success' => "mise à jour du reste des champs avec succés", 'photo_path'=> $piece->photo]) ;
            }
            $piece->qte_stock = $qte_stock;
        }
        $piece->save();
        return response()->json(['success' => "mise à jour avec succés", 'photo_path'=> $piece->photo]) ;
    }

    /**
     * save image in storage and save path in db.
     */


    public function savePiece($reference, $designation, $photo, $indice_arrivage, $qte_stock){


        $piece = new Piece();
        $piece->ref = $reference;
        $piece->designation = $designation;
        $piece->indice_arrivage = $indice_arrivage;
        $piece->qte_stock = $qte_stock;
        $this->saveImage($piece, $photo, 'app/public/photos/pieces');
        $piece->save();

        for ($i=0; $i<intval($qte_stock);$i++){
            $articlePiece = new ArticlesPiece;
            $articlePiece->ref = $reference;
            $articlePiece->isUsed= false;
            $articlePiece->save();
            $this->savePieceQrCode($articlePiece->id, $reference);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pieces = Piece::All();
        // $paths = [];
        // foreach($pieces as $piece){
        //     array_push($paths, Storage::disk('public')->exists($piece->photo) );
        // }
        // dd($paths);
        return view('pieces.index', compact('pieces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produits = Produit::all();
        $variations = Variation::all();

        return view('pieces.create', compact('produits', 'variations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validatePieceCreation($request);

        $piece_refs = $request->input('referencesNewPiece');
        $piece_photos = $request->file('photos');
        $piece_designations = $request->input('designationsNewPiece');
        $indices_arrivage = $request->input('indiceArrivageNewPiece');
        $quantities = $request->input('quantities');

        for ($i = 0; $i < count($piece_refs); $i++) {
            $photo = isset($piece_photos[$i]) ? $piece_photos[$i] : null;

            $this->savePiece($piece_refs[$i], $piece_designations[$i], $photo, $indices_arrivage[$i], $quantities[$i] );
        }

        return redirect()->route('pieces.index')->with('success', 'Pièces ajoutées avec succès');
    }

    public function savePieceModal($reference , $designation, $photo, $indice_arrivage, $qte_stock){
        $piece = new Piece();
        $piece->ref = $reference;
        $piece->designation = $designation;
        $piece->indice_arrivage = $indice_arrivage;
        $piece->qte_stock = $qte_stock;
        $this->saveImage($piece, $photo, 'app/public/photos/pieces');
        $piece->save();

        for ($i=0; $i<intval($qte_stock);$i++){
            $articlePiece = new ArticlesPiece;
            $articlePiece->piece_ref = $reference;
            $articlePiece->status= false;
            $articlePiece->save();
            $this->savePieceQrCode($articlePiece->id, $reference);
        }

        return $piece;
    }

    public function storePieceModal(Request $request)
    {
        $this->validatePieceModalCreation($request);

        $reference = $request->get('reference');
        $designation = $request->get('designation');
        $photo = $request->file('photo');
        $indice_arrivage = $request->get('indice_arrivage');
        $qte_stock = $request->get('qte_stock');

        $photo = isset($photo) ? $photo : null;
        $pieceOld  = Piece::find('ref', $reference)->first();
        if ($pieceOld == null){
            $piece = $this->savePieceModal($reference , $designation, $photo, $indice_arrivage, $qte_stock );
            return response()->json($piece);
        }else{
            return response()->json(['failed' => 'cette piece existe veuillez ressayer']);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Piece $piece)
    {
        $articlesPiece = $piece->articlesPiece;
        $parent = 'photos/qr_codes_pieces/';
        // $dirLen = strlen($dir);
        $files = Storage::disk('public')->files($parent);
        // dd($files);
        $qrCodes = [];
        foreach ($articlesPiece as $article){
            $qrCodeSub = [];
            for ($i=0; $i<count($files); $i++) {
                if (str_contains($files[$i], $piece->ref.'_'.$article->id)) {
                    array_push($qrCodeSub,  $files[$i]);
                    break;
                }
            }
            $qrCodes[$piece->ref.'_'.$article->id] = $qrCodeSub;
        }
        return view('pieces.show', compact('qrCodes', 'piece', 'articlesPiece'));
    }

    public function printQrs($piece){
        $piece = Piece::where('ref', $piece)->first();
        $parent = 'photos/qr_codes_pieces/';
        // $dirLen = strlen($dir);
        $files = Storage::disk('public')->files($parent);
        // dd($files);
        $qrCodes = [];
        foreach ($files as $file) {
            if (str_contains($file, $piece->ref)) {
                    array_push($qrCodes,  $file);
            }
        }
        // dd($qrCodes);

        return view('pieces.print-qrs', compact('qrCodes','piece'));
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Piece $piece)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Piece $piece)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Piece $piece)
    {
        //
    }

    public function modify()
    {
        // dd('rr') ;
        $produits = Produit::all();
        $variations = Variation::all();
        $pieces = Piece::all();
        return view('pieces.modify', compact('produits', 'variations', 'pieces'));
    }

}
