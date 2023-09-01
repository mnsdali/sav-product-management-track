<?php

namespace App\Http\Controllers;

use App\Http\Dto\ReverseGeocoding;
use App\Models\Article;
use App\Models\Produit;
use App\Models\Reclamation;
use App\Models\Technicien;
use App\Models\Client;
use App\Models\TypePanne;
use App\Models\User;
use App\Notifications\NouveauIntervention;
use App\Notifications\SuccessfullReclamationCreation;
use App\Traits\DistanceCommon;
use App\Traits\ReclamationInterventionCommon;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;
use Ramsey\Collection\Map\AssociativeArrayMap;

class ReclamationController extends Controller
{
    use ReclamationInterventionCommon;
    use DistanceCommon;




    public function sendNotification($technicien, $client, $defaultClientCoords, $created_at, $typePanne ){
        $cl_prenom_nom = $client->prenom . " " . $client->nom;
        $defaultClientCoordsArr = $this->splitCoords($defaultClientCoords);
        $geoloc_adress = new ReverseGeocoding($defaultClientCoordsArr[0], $defaultClientCoordsArr[1]);
        $deadline = (new DateTime($created_at))->modify('+48 hours')->format('Y-m-d H:i:s');

        // $technicien->notify(new NouveauIntervention($cl_prenom_nom, $geoloc_adress->getAddress() , $typePanne,  $deadline ));
        // $client->notify(new SuccessfullReclamationCreation($client->num_telephone1, $created_at));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $techniciens = User::role('technicien')->get();
        $reclamations = Reclamation::join('clients', 'reclamations.client_pseudo', '=', 'clients.pseudo')
        ->get(['reclamations.*' ,'clients.num_tel1', 'clients.num_tel2']);
        return view('reclamations.index', compact('reclamations', 'techniciens'));
    }

    public function sendReclamation($serie_number)
    {
        // $articles = Article::all();
        $client = User::join('articles', 'articles.client_email','=', 'users.email')->first();
        $article = Article::join('variations', 'variations.designation','=', 'articles.var_designation')
                            ->join('produits', 'variations.prod_ref', '=', 'produits.reference')
                            ->where('serie_number', $serie_number)->get(['articles.*', 'produits.*']);
        return view('reclamations.create', compact('article', 'client'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $articles = Article::all();
        $typesPanne = TypePanne::where('isHidden', false)->get();
        return view('reclamations.create', compact('articles','typesPanne'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $defaultClientCoords = "34.7804898016659, 10.794638234382727"; // needs to be edited

        if (empty($request->input('typePanne')) || empty($request->input('panneDescrip'))) {
            return redirect()->route('welcome')->with(['failure'=>'veuillez remplir tous les champs de la reclamation']);
        }

        $this->enregistrerReclamation($request);
        // dd($request);

        // $bestTechProps = $this->findClosestTechnicien($defaultClientCoords);
        // $reclamation->technicien_email = $bestTechProps['bestTech']->email;
        // $reclamation->kilometrage = $bestTechProps['bestDist'];
        // For notification
        // $technicien = $bestTechProps['bestTech'];
        // $created_at = $reclamation->created_at;
        // $this->sendNotification($technicien, $article->client, $defaultClientCoords, $created_at, $typePanne );

        return redirect()->route('welcome')->with(['success'=>"Votre réclamation est enregistrer! \n  un sms sera envoyer vers votre gsm."]);
    }

    public function archive($rec_id){
        $reclamation = Reclamation::find($rec_id);
        $reclamation->etat = "archivé";
        $reclamation->save();
        return redirect()->route('reclamations.index')->with(['success'=>"Réclamation archivé avec succès."]);
    }

    public function assignTech(Request $request){
        $tech = $request->input('technicien');
        $rec = $request->input('reclamation');

        $reclamation = Reclamation::find($rec);
        $reclamation->technicien_email = $tech;
        $reclamation->etat = "en_attente";
        $reclamation->save();


        return response()->json(['success'=>'Technicien assigné avec succès.']);

    }


    /**
     * Display the specified resource.
     */
    public function show(Reclamation $reclamation)
    {
        $client = $reclamation->client;
        $article = $reclamation->article;
        // dd($article, $client);
        $techniciens = User::role('technicien')->get();
        return view('reclamations.show', compact('reclamation','client','techniciens','article'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reclamation $reclamation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reclamation $reclamation)
    {
        $technicien = $request->input('technicien');
        $reclamation->etat = 'en_attente';
        $reclamation->tech_email = $technicien;
        $reclamation->save();

        //notifier client et technicien

        return redirect()->route('reclamations.index')->with(['success'=> 'la réclamation est assigné à un technicien avec succés! rester en fil avec lui!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reclamation $reclamation)
    {
        //
    }
}
