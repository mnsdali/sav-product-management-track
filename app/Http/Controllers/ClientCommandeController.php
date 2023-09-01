<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ClientCommande;
use App\Models\Revendeur;
use App\Models\User;
use App\Models\Client;
use App\Traits\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientCommandeController extends Controller
{

    use Common;

    function getRevendeurHashTagForPseudo($username){
        //get first 2 letters and last letter from username
        $first2 = substr($username, 0, 2);
        $last1 = substr($username, -1);
        return strtoupper($first2.$last1);
    }

    public function venteProduitIndex($serie_numbers)
    {
        $serie_numbers = json_decode($serie_numbers);
        $user_id = Auth::id();
        //get user from user id
        $user = User::role('revendeur')->where('id', $user_id)->first();
        // get revendeur from user email


        foreach ($serie_numbers as $serie_number){
            $articles[$serie_number] = Article::where('serie_number', $serie_number)
            ->join('variations', 'variations.designation','=','articles.var_designation')
             ->join('produits', 'produits.reference','=','variations.prod_ref')->first(['produits.*','articles.*']);
             if ($articles[$serie_number]->rev_email != $user->email){
                return redirect()->route('revendeur.index')->with('failure', 'un des produits ne correspond pas à vous en tant que revendeur! veuillez réessayer');
            }
        }

        // dd($user['name'], $article['prix'], $revendeur);
        session(['articles' => $articles,'revendeur'=> $user]);
        return view('commandes_cl.index', compact('articles','user'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::join('revendeurs', 'articles.rev_id', '=', 'revendeurs.id')
                            ->get(['articles.*', 'revendeurs.id', 'revendeurs.prenom', 'revendeurs.nom']);;
        return view('commandes_cl.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('commandes_cl.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prenom = $request->input('prenom');
        $nom = $request->input('nom');
        $num_tel1 = $request->input('num_tel1');
        $num_tel2 = $request->input('num_tel2');
        $revendeur = $request->session()->get('revendeur');
        $pseudo = strtoupper($prenom).strtoupper($nom).'#'.$this->getRevendeurHashTagForPseudo($revendeur->name);
        $client = Client::where('pseudo', $pseudo)->first();
        // dd($client);
        if ($client == null){

            $client = new Client;
            $client->pseudo = $pseudo;
            $client->prenom = $prenom;
            $client->nom = $nom;
            $client->num_tel1 = $num_tel1;
            $client->num_tel2 = $num_tel2;

            $client->save();
        }

        $articles = $request->session()->get('articles');
        // $cmd_id = ClientCommande::latest()->first()->id + 1;
        $total = 0;
        $vars = [];
        $prices = [];
        foreach($articles as $article){
            $article->client_pseudo = $pseudo;
            $article->save();
            $vars[$article->var_designation]++;
            $prices[$article->var_designation] = $article->prix;
            $total+=$article->prix;
        }
        $this->enregistrerCommandeClient($articles, $revendeur->email, $pseudo, $total, $vars, $prices);
        $success = "La vente est confirmée avec succés";
        return redirect()->route('commandes_cl.liste')->with(['success'=> $success]);

    }

    public function listCommandes(){
        $user_id = Auth::id();
        //get user from user id
        $user = User::role('revendeur')->where('id', $user_id)->first();
        // get revendeur from user email
        $commandes = ClientCommande::where('client_commandes.rev_email', $user->email)
        ->join('clients', 'clients.pseudo', '=', 'client_commandes.client_pseudo')
        ->join('articles', 'articles.serie_number','=','client_commandes.serie_number')
        ->join('variations', 'variations.designation','=','articles.var_designation')
        ->join('produits','produits.reference','variations.prod_ref')
        ->get(['client_commandes.*','variations.designation','produits.*','clients.num_tel1','clients.num_tel2','clients.nom AS cl_nom', 'clients.prenom AS cl_prenom']);
        return view('commandes_cl.list', compact('commandes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientCommande $clientCommande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientCommande $clientCommande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientCommande $clientCommande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientCommande $clientCommande)
    {
        //
    }
}
