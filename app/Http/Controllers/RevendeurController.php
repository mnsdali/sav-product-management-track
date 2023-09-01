<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevendeurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $revendeurs = User::role('revendeur')->get();
        return view('revendeurs.index', compact('revendeurs'));
    }

    public function listArticles(){
        //get user email
        $user_id = Auth::id();
        $user = User::role('revendeur')->where('id', $user_id)->first();

        $articles = Article::where('articles.rev_email', $user->email)
        // ->join('clients', 'clients.pseudo', '=', 'articles.client_pseudo')
        ->join('variations', 'variations.designation','=','articles.var_designation')
        ->join('produits','produits.reference','variations.prod_ref')
        ->get(['articles.*','variations.designation','produits.*']);
        // ->get(['articles.*','variations.designation','produits.*','clients.num_tel1','clients.num_tel2','clients.nom AS cl_nom', 'clients.prenom AS cl_prenom']);
        return view('revendeurs.articles', compact('articles'));


    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $revendeur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
    }
}
