<?php

namespace App\Traits;

use App\Models\ArticlesPiece;
use App\Models\Piece;
use App\Models\PiecesVariation;


trait PiecesCommon {

    public function enregistrerPieceVariation($reference, $var_designation, $quantity){
        $piecesVariation = PiecesVariation::where('var_designation', $var_designation)
        ->where('piece_ref', $reference)->first();
        if ($piecesVariation ==null){
            $piecesVariation = new PiecesVariation;
            $piecesVariation->var_designation = $var_designation;
            $piecesVariation->piece_ref = $reference;
            $piecesVariation->save();
        }

        $articlesPiece = ArticlesPiece::where('isUsed', false)->take($quantity)->get();

        foreach($articlesPiece as $article){
            $article->isUsed = true;
            $article->save();
        }

        if (count($articlesPiece) < $quantity){
            for ($i=0; $i<$quantity-count($articlesPiece); $i++){
                $articlePiece = new ArticlesPiece;
                $articlePiece->piece_ref = $reference;
                $articlePiece->isUsed= true;
                $articlePiece->save();
                $this->savePieceQrCode($articlePiece->id, $reference);
            }
            $piece = Piece::find('ref', $reference);
            $piece->qte_stock += $quantity - count($articlesPiece);
        }
    }

    // public function savePiece($prod_ref,$var_designation, $reference, $designation, $photo, $indice_arrivage){
    //     $piece = new Piece();
    //     $piece->ref = $reference;
    //     $piece->designation = $designation;
    //     // $piece->prod_ref = $prod_ref;
    //     $piece->indice_arrivage = $indice_arrivage;
    //     // $piece->var_designation = $var_designation;
    //     $this->saveImage($piece, $photo, 'app/public/photos/pieces');
    //     $piece->save();

    //     //symbolic table to link a piece to a variation
    //     $this->enregistrerPieceVariation($reference, $var_designation);

    // }

    // enregistrement d'une piece d'une variation
    public function savePieceSansReferenceProd($var_designation, $reference, $designation, $photo, $indice_arrivage){
        $piece = new Piece();
        $piece->ref = $reference;
        $piece->designation = $designation;
        // $piece->prod_ref = $prod_ref;
        $piece->indice_arrivage = $indice_arrivage;
        // $piece->var_designation = $var_designation;
        $this->saveImage($piece, $photo, 'app/public/photos/pieces');
        $piece->save();

        //symbolic table to link a piece to a variation
        $piecesVariation = new PiecesVariation;
        $piecesVariation->var_designation = $var_designation;
        $piecesVariation->piece_ref = $reference;
        $piecesVariation->save();
    }

}
