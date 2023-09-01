<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\DetailsCommandeRevendeur;
use App\Models\RevendeurCommande;
use Illuminate\Http\Request;
use App\Traits\Common;
use Illuminate\Support\Facades\Storage;

class PrintersController extends Controller
{
    use Common;
    public function revendeursCommandesIndex()
    {
        $revendeursCommandes = RevendeurCommande::join('users', 'users.email', '=', 'revendeur_commandes.rev_email')
                            ->get(['revendeur_commandes.*', 'users.name']);
        return view('printers.revendeurs_commandes', compact('revendeursCommandes'));
    }

    public function showCommande($reference)
    {
        $commande = RevendeurCommande::where('reference', $reference)->join('users', 'users.email','=','revendeur_commandes.rev_email')->first();
        $detailsCommande = DetailsCommandeRevendeur::where('cmd_ref', $reference)->get();
        $currDate = $this->getDate();
        $articles = Article::where('cmd_ref', $reference)->get();
        $qrs=[];
        $dir = 'photos/qr_codes';
        $files = Storage::disk('public')->files($dir);

        foreach ($articles as $article){
                foreach ($files as $file) {
                    if (str_contains($file, $article->serie_number)) {
                        array_push($qrs,  $file);
                    }
                }
        }
        // dd($files);
        return view('printers.showCommande', compact('detailsCommande','commande', 'currDate','qrs'));
    }

    public function qrCodesIndex(){
        $dir = 'photos/qr_codes';
        $dirLen = strlen($dir);
        $directories = Storage::disk('public')->directories($dir);
        // dd(substr($directories[0], strlen($dir)));
        return view('printers.qrcodes', compact('directories','dirLen'));
    }

    public function showDir($dir){
        $parent = 'photos/qr_codes';
        // $dirLen = strlen($dir);
        $files = Storage::disk('public')->files($parent.'/'.$dir);
        // dd($files);
        return view('printers.showQr', compact('files'));
    }
}
