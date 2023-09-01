<?php

namespace App\Traits;

use App\Models\ClientCommande;
use App\Models\DetailsCommandeClient;
use App\Models\DetailsCommandeRevendeur;
use App\Models\Revendeur;
use App\Models\RevendeurCommande;
use App\Models\User;
use Nette\Utils\DateTime;



trait Common {

    public function getDate(){
        // une fonction qui transforme le nombre de jour de  semaine en nom de jour
        $date = new DateTime();
        $currentDay = $date->format('w'); // Numeric representation of the day of the week (0 = Sunday, 6 = Saturday)
        $dayNames = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];

        $currentDate = $dayNames[$currentDay] . ' Le ' . $date->format('d/m/Y');
        return $currentDate;
    }


    public function generateReference($username, $counter) {
        $date = date('Ymd');
        $username = strtoupper(substr($username, 0, 4)).strtoupper(substr($username, -4)); // Use the first four characters of the username
        $counter = str_pad($counter, 5, '0', STR_PAD_LEFT); // Ensure the counter is 5 digits long

        return $date . '-' . $username . '-' . $counter;
    }

    public function enregistrerDetailsCommandeRevendeur($cmd_ref, $designations, $quantities, $subTotals, $prices){
        for ($i=0; $i<count($designations); $i++){
            $detailsCommandeRevendeur = new DetailsCommandeRevendeur();
            $detailsCommandeRevendeur->cmd_ref = $cmd_ref;
            $detailsCommandeRevendeur->var_designation = $designations[$i];
            $detailsCommandeRevendeur->qte = intval($quantities[$i]);
            $detailsCommandeRevendeur->sous_total = floatval($subTotals[$i]);
            $detailsCommandeRevendeur->prix = floatval($prices[$i]);
            $detailsCommandeRevendeur->save();
        }
    }
    public function enregistrerCommandeRevendeur($rev_email, $designations, $quantities, $subTotals, $prices, $total){
        $revendeur = User::role('revendeur')->where('email', $rev_email)->first();
        $commandesDeRevendeur = RevendeurCommande::where('rev_email',$rev_email)->get();
        $nbCmdsRevendeur = count($commandesDeRevendeur) +1; // number of commands of that revendeur
        $revendeurCommande = new RevendeurCommande;
        $revendeurCommande->rev_email = $rev_email;
        $revendeurCommande->total = $total;
        $revendeurCommande->reference = $this->generateReference($revendeur->name, $nbCmdsRevendeur);
        $revendeurCommande->save();

        $this->enregistrerDetailsCommandeRevendeur($revendeurCommande->reference, $designations, $quantities, $subTotals, $prices );

        // $revendeurCommande->var_designation = $designation;
        // $revendeurCommande->qte = $quantity;
        // $revendeurCommande->total = $subTotal;
        return $revendeurCommande->reference;

    }

    public function enregistrerCommandeClient($articles, $rev_email, $client_pseudo, $total, $vars, $prices){
        $clientCommande = new ClientCommande();
        $clientCommande->total = $total;
        $clientCommande->client_pseudo = $client_pseudo;
        $clientCommande->rev_email = $rev_email;
        $clientCommande->save();

        foreach($articles as $article){
            $article->cl_cmd_id = $clientCommande->id;
            $article->save();
        }

        foreach ($vars as $var => $qte){
            $detailCommande = new DetailsCommandeClient;
            $detailCommande->cl_cmd_id = $clientCommande->id;
            $detailCommande->var_designation = $var;
            $detailCommande->qte = $qte;
            $detailCommande->prix = $prices[$var];
            $detailCommande->sous_total = $qte * $prices[$var];
            $detailCommande->save();
        }
    }
}
