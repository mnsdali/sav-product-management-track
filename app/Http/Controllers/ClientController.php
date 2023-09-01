<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Client;
use App\Models\Produit;
use App\Models\Revendeur;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $isRedirected = false;
        $clients = Client::All();
        return view('clients.index', compact('clients', 'isRedirected'));
    }

    public function indexAfterStoring($isRedirected = true)
    {
        $clients = Client::All();
        return view('clients.index', compact('clients', 'isRedirected'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($rev_id)
    {
        $revendeur = Revendeur::where('id', $rev_id)->first();
        $produits = Produit::All();
        return view('clients.create', compact('revendeur', 'produits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $serie_number = $request->input('serie_number');
        $nom  =  $request->input('nom');
        $prenom  =  $request->input('prenom');
        $num_telephone1  =  $request->input('num_telephone1');
        $num_telephone2  =  $request->input('num_telephone2');
        $ref_prod  =  $request->input('ref_prod');
        $rev_id  =  $request->input('rev_id');

        $client = Client::where('nom',  $nom)
                        ->where('prenom',$prenom)
                        ->where('num_telephone1',  $num_telephone1)->first();
        if ($client == null){
            $client = new Client;
            $client->num_telephone1 = $num_telephone1;
            $client->num_telephone2 = $num_telephone2;
            $client->nom = $nom;
            $client->prenom = $prenom;
            $client->save();
        }

        $article = new Article;
        $article->serie_number = $serie_number;
        $article->client_id = $client->id;
        $article->prod_ref = $ref_prod;
        $article->rev_id = $rev_id;
        $article->save();


        return $this->indexAfterStoring();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->get('id');
        $articles = Article::where('client_id', intval($id))->get();

        return response()->json($articles);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        // Access the data

        $id = $data['id'];
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $num_telephone1 = $data['num_telephone1'];
        $num_telephone2 = $data['num_telephone2'];

        $client = Client::where('id', intval($id))->first();
        $client->nom = $nom;
        $client->prenom = $prenom;
        $client->num_telephone1 = $num_telephone1;
        $client->num_telephone2 = $num_telephone2;
        $client->save();

        return response()->json(['message' => 'Modification effectuée avec succès!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
