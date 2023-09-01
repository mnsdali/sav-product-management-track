<?php

namespace App\Traits;
use App\Models\Variation;
use App\Models\VariationsProduit;


trait VariationsCommon {

public function enregistrerVariationSansProd($designation ){
        $variation = new Variation;
        $variation->designation = $designation;
        // $variation->prod_ref = $reference;
        $variation->save();
    }

    public function enregistrerVariation($designation , $reference){
        $variation = new Variation;
        $variation->designation = $designation;
        $variation->prod_ref = $reference;
        $variation->save();

        // $variationsProd = new VariationsProduit;
        // $variationsProd->var_designation = $designation;
        // $variationsProd->prod_ref = $reference;
        // $variationsProd->save();
    }
}
