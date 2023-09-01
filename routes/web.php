<?php

use App\Http\Controllers\ProfileController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\RevendeurCommandeController;
use App\Http\Controllers\RevendeurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientCommandeController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\PrintersController;
use App\Http\Controllers\TypePanneController;
use App\Models\Revendeur;
use App\Models\TypePanne;
use App\Models\User;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $typesPanne = TypePanne::where('isHidden', false);
    $articles = Article::join('variations', 'variations.designation', '=', 'articles.var_designation')
                        ->join('produits', 'variations.prod_ref', '=', 'produits.reference')
                        ->join('client_commandes', 'client_commandes.id', '=', 'articles.cl_cmd_id')
                        ->get(['articles.serie_number', 'produits.reference', 'articles.var_designation','articles.client_pseudo', 'client_commandes.created_at']);
    return view('welcome', compact('articles', 'typesPanne'));
})->name('welcome');

Route::get('/dashboard', function () {
    if (User::role('admin')){
        return redirect()->route('reclamations.index');
    }else if (User::role('revendeur')){
        return redirect()->route('commandes_cl.liste');
    }else if (User::role('technicien')){
        return redirect()->route('reclamations.index');
    }
    // return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth']], function() {
    // Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);
    // Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';

/*================================================================
=======================3rd party actions==========================
==================================================================
==================================================================*/
Route::middleware(['auth', 'role:admin'])->group(function () {


Route::post('/reclamation/update', [ReclamationController::class, 'update']);
Route::post('/reclamation/sort', [ReclamationController::class, 'sort']);
Route::post('/reclamation/assign-tech', [ReclamationController::class, 'assignTech']);
Route::post('/reclamation/archive/{rec_id}', [ReclamationController::class, 'archive']);

});

Route::resource('reclamations', ReclamationController::class)
->only(['index',  'destroy','show', 'update', 'show'])->middleware(['auth', 'role:admin']);

Route::middleware(['auth', 'role:revendeur'])->group(function () {
    Route::get('/panneau/qr_vente', [ClientCommandeController::class, 'create'])->name('panneau.qr_vente');
    Route::get('/ventes/update/{serie_numbers}', [ClientCommandeController::class, 'venteProduitIndex'])->name('vente.update');
    Route::post('/ventes/store', [ClientCommandeController::class, 'store'])->name('commande_cl.store');
});

Route::resource('reclamations', ReclamationController::class)
->only(['create', 'store']);

// Route::post('/reclamations/save', [ReclamationController::class, 'save'])->name('reclamations.save');
// Route::get('/reclamations/update/{serie_number}', [ReclamationController::class, 'sendReclamation']);




Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('reclamations', ReclamationController::class)
    ->only([ 'show']);
});


// Route::resource('interventions', interventionsController::class)
// ->only(['index', 'store', 'edit', 'update', 'destroy', 'show']);



// revendeurs section****
Route::resource('revendeur-commandes', RevendeurCommandeController::class)
->only(['index', 'store', 'edit', 'update', 'destroy', 'show', 'create']);




Route::resource('revendeurs', RevendeurController::class)
->only(['index', 'store', 'edit', 'update', 'destroy', 'showVentes']);

Route::post('/revendeur/add', [RevendeurController::class, 'store']);
Route::post('/revendeur/edit', [RevendeurController::class, 'edit']);
Route::post('/revendeur/delete', [RevendeurController::class, 'destroy']);
Route::post('/revendeur/show', [RevendeurController::class, 'show']);


// client section****
Route::resource('clients', ClientController::class)
->only(['index', 'store', 'edit', 'update', 'destroy', 'show']);

$router->get('/client/create/{rev_id}',[ClientController::class, 'create'])->name('clients.create');

Route::post('/client/update', [ClientController::class, 'update']);
Route::post('/client/edit', [ClientController::class, 'edit']);
// Route::post('/client/delete', [ClientController::class, 'destroy']);
Route::post('/client/show-articles', [ClientController::class, 'show']);


// produit section****
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('produits', ProduitController::class)
    ->only(['index', 'store', 'update', 'destroy', 'show', 'create']);

    Route::post('/prod/changeState', [ProduitController::class, 'changeState'])->name('produit.changeState');
    Route::get('/prods/modify', [ProduitController::class, 'modify'])->name('produits.modify');
    Route::get('/produitss/maj', [ProduitController::class, 'maj'])->name('produits.maj');
    Route::get('/produits-list', [ProduitController::class, 'listProduits'])->name('produits.list');

// Route::post('/produits/modify',[ProduitController::class, 'editView'])->name('produits.modify');
});

// Route::post('/produit/show', [ProduitController::class, 'show']);
// Route::post('/produit/load', [ProduitController::class, 'load']);

// variations section****
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('variations', VariationController::class)
    ->only(['index', 'update', 'destroy', 'show', 'create']);
    Route::post('/variations/add', [VariationController::class, 'store'])->name('variation.add');
    Route::get('/variation/test', [VariationController::class, 'editSerie'])->name('edit-serie');
    Route::post('/variation/update-serie', [VariationController::class, 'updateSerie'])->name('variation.update-serie');
    Route::post('/variations/add-more', [VariationController::class, 'addMore'])->name('variation.add-more');
    Route::post('/variations/reloadProducts', [VariationController::class, 'reloadProducts'])->name('variation.reload-products');

    Route::post('/variations/checkout', [VariationController::class, 'checkout'])->name('variation.checkout');
    Route::post('/variations/save-piece-modal', [VariationController::class, 'storePieceModal']);
    Route::post('/variations/changeState', [VariationController::class, 'changeState'])->name('variation.changeState');
    Route::get('/variations/print-qrs/{designation}', [VariationController::class, 'printQrs'])->name('variations.printQrs');
    Route::get('/variations/show-articles/{designation}', [VariationController::class, 'showArticles'])->name('variations.show-articles');

});

// pieces section****
Route::middleware(['auth', 'role:admin'])->group(function () {



    Route::resource('pieces', PieceController::class)
    ->only(['index',  'edit', 'update', 'destroy', 'show', 'create']);

    Route::post('/add-piece', [PieceController::class, 'store'])->name('pieces.add');
    Route::get('/pieces/modify', [PieceController::class, 'modify'])->name('pieces.modify');
    Route::post('/pieces/maj', [PieceController::class, 'maj'])->name('pieces.maj');
    Route::get('/pieces/print-qrs/{ref}', [PieceController::class, 'printQrs'])->name('pieces.printQrs');

    // Route::post('/pieces/add', [PieceController::class, ])->name('pieces.add');
    // Route::post('/pieces/add-more', [PieceController::class, 'addMore'])->name('pieces.add-more');
    // Route::post('/pieces/reloadProducts', [PieceController::class, 'reloadVariations'])->name('pieces.reload-variations');
    Route::resource('type_panne', TypePanneController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy', 'show', 'create']);
    Route::post('/type_panne/check_status', [TypePanneController::class, 'checkStatus']);

});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/revendeurs_commandes/index', [PrintersController::class, 'revendeursCommandesIndex'])->name('printers.revendeurs_commandes');
    Route::get('/commande/show/{reference}', [PrintersController::class, 'showCommande'])->name('printers.showCommande');
    Route::get('/qrcodes', [PrintersController::class, 'qrCodesIndex'])->name('printers.qrcodes');
    Route::get('/qrcodes/{dir}', [PrintersController::class, 'showDir'])->name('printers.showDir');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('revendeurs', RevendeurController::class)
    ->only(['index']);
});

Route::middleware(['auth', 'role:revendeur'])->group(function () {
    Route::get('/commandes_cl/liste', [ClientCommandeController::class, 'listCommandes'])->name('commandes_cl.liste');
    Route::get('/revendeurs/liste-articles', [RevendeurController::class, 'listArticles'])->name('revendeur.liste-articles');

});

