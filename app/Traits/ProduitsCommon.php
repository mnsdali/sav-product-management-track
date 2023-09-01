<?php

namespace App\Traits;
use App\Models\Produit;


trait ProduitsCommon {
    public function enregistrerProduit($reference, $nom, $description, $prix ){ //$typeGaz
        $produit = new Produit;
        $produit->reference = $reference;
        $produit->nom = $nom;
        $produit->description = $description;
        $produit->prix = $prix;
        // $produit->typeGaz = $typeGaz;
        $produit->save();
        return $produit;
    }

}
