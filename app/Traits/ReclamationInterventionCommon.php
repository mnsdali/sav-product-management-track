<?php

namespace App\Traits;
use App\Models\Article;
use App\Models\Reclamation;


trait ReclamationInterventionCommon {

    public function enregistrerReclamation($request){
        if (!empty($request->input('lat')) && !empty($request->input('lng'))){
            $lat = floatval($request->input('lat'));
            $lng = floatval( $request->input('lng'));
        }else{
            $ip = $request->input('ipaddr');
            $coords = $this->getCoordsFromIpAddr($ip);
            $lat = floatval($coords[0]);
            $lng = floatval($coords[1]);
        }

        $article = Article::where('serie_number', $request->input('prodSerial'))->first();

        $reclamation = new Reclamation();
        $reclamation->lat = $lat;
        $reclamation->lng = $lng;
        $reclamation->client_pseudo = $article->client_pseudo;
        $reclamation->type_panne = $request->input('typePanne');
        $reclamation->description_panne = $request->input('panneDescrip');
        $reclamation->etat = '0';
        $reclamation->serie_number = $article->serie_number; // Update this line

        $reclamation->save();

    }

}
