<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Revendeur;
use App\Models\RevendeurCommande;
use App\Traits\ArticlesCommon;
use App\Traits\QrCodeCommon;
use App\Traits\Common;
use Illuminate\Http\Request;

class RevendeurCommandeController extends Controller
{

    use QrCodeCommon;
    use ArticlesCommon;
    use Common;




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $commands = RevendeurCommande::join('users', 'users.email', '=', 'revendeur_commandes.rev_email')
        //                     ->join('produits', 'revendeur_commandes.prod_ref', '=', 'produits.reference')
        //                     ->get(['produits.reference', 'produits.nom', 'produits.description' ,'revendeur_commandes.qte', 'revendeur_commandes.created_at', 'users.email', 'users.name']);
        // return view('commandes_rev.index', compact('commands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produits = Produit::all();
        $revendeurs = Revendeur::all();
        return view('commandes_rev.create', compact('produits', 'revendeurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $references = $request->input('references');
        $quantities = $request->input('quantities');
        $series = $request->input('series');
        $sous_totals = $request->input('sous_totals');
        $revendeur = $request->input('revendeur');
        $prices =$request->input('prices');
        $total = floatval($request->input('total'));

        // dd($references, $quantities,$series,$sous_totals,$prices, $total);

        if ($revendeur!=null){
            $cmd_ref = $this->enregistrerCommandeRevendeur($revendeur, $series, $quantities, $sous_totals, $prices, $total);
            for ($i=0; $i<count($series); $i++){
                $this->confirmerArticles($series[$i], intval($quantities[$i]), $revendeur, $cmd_ref);
            }

            $success =  "Les articles désirés ont été associé au revendeur avec succés! Substitution des articles de stock! ";
            return redirect()->route('printers.revendeurs_commandes')->with('success', $success);


        }
        else{
            $failure =  "Veuillez choisir un revendeur! ";
            return redirect()->route('printers.panier')->with(
                ['success'=>$failure
                , 'references'=> $references
                , 'quantities'=> $quantities
                , 'series'=> $series
                , 'sous_totals'=> $sous_totals
                , 'prices'=> $prices]
            );
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(RevendeurCommande $revendeurCommande)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RevendeurCommande $revendeurCommande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RevendeurCommande $revendeurCommande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RevendeurCommande $revendeurCommande)
    {
        //
    }
}
