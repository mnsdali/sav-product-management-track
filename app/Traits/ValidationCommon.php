<?php

namespace App\Traits;
use App\Models\Article;
use Illuminate\Http\Request;

trait ValidationCommon {

    public function validateProdCreation(Request $request){
        $request->validate([
            'referenceProd' => 'required',
            'nomProd' => 'required',
            'descriptionProd' => 'required',
            'prixProd' => 'required|numeric|between:0,9999.99',
        ]);
    }

    public function validateProdSelect(Request $request){
        $request->validate([
            'referenceProd' => 'required',
        ]);
    }
    public function validateVarSelect(Request $request){
        $request->validate([
            'var_designation' => 'required',
        ]);
    }


    public function validateVarCreation(Request $request){
        $request->validate([
            'referenceProd' => 'required',
            'designations' => 'required|array',
            'designations.*' => 'required',
            'quantities'   => 'required|array',
            'quantities.*' => 'integer',
        ]);
    }

    public function validatePieceCreation(Request $request){
        $request->validate([
            'referencesNewPiece' => 'required|array',
            'designationsNewPiece' => 'required|array',
            'indiceArrivageNewPiece' => 'required|array',
            'quantities' => 'required|array',
            'quantities.*' => 'integer',
        ]);
    }

    public function validatePieceModalCreation(Request $request){
        $request->validate([
            'reference' => 'required|unique:pieces,ref',
            'designation' => 'required',
            'indice_arrivage' => 'required',
            'qte_stock' => 'required|integer',
        ]);
    }

    public function validatePieceSelect(Request $request){
        $request->validate([
            'referencesPieces' => 'required|array',
            'referencesPieces.*' => 'required|array',
        ]);
    }



}
