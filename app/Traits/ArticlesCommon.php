<?php

namespace App\Traits;
use App\Models\Article;


trait ArticlesCommon {
    public function generateSerialNumber(){
        while(true){
            $serie_number = "";
            for($j = 0; $j<13; $j++){
                $serie_number .= strval(rand(0,9));
            }
            $article = Article::where('serie_number', $serie_number)->first();
            if($article == null){
                break;
            }
        }
        return $serie_number;
    }

    public function enregistrerArticles($reference, $var_designation, $quantity){
        for($i = 0; $i<$quantity; $i++){
            $article = new Article;

            $article->serie_number = $this->generateSerialNumber();
            $article->prod_ref = $reference;
            $article->var_designation = $var_designation;
            $article->status = 0;
            $article->save();

            $this->generateQrCodes($article->serie_number, $article->var_designation);
        }
    }

    // Enregistrement des articles sans réference de produit
    public function enregistrerArticlesSansProdReference( $var_designation, $quantity){
        for($i = 0; $i<$quantity; $i++){
            $article = new Article;

            $article->serie_number = $this->generateSerialNumber();
            // $article->prod_ref = $reference;
            $article->var_designation = $var_designation;
            $article->status = 0;
            $article->save();

            $this->generateQrCodes($article->serie_number, $var_designation);
        }
    }

    public function confirmerArticles($var_designation, $quantity, $rev_email, $cmd_ref){
        $articlesNonAchetés =  Article::where('status', 0)
                                        ->where('var_designation', $var_designation)
                                        ->get();

        $i=0;
        foreach ($articlesNonAchetés as $article){

            if ($i==$quantity){break;}
            $article->status = 1;
            $article->rev_email = $rev_email;
            $article->cmd_ref = $cmd_ref;
            $article->save();
            $i++;
            // dd($article->rev_email);
        }

        // if quantity is greater than saved non bought articles then create new articles and assign them
        for(; $i<$quantity; $i++){
            $article = new Article;

            $article->serie_number = $this->generateSerialNumber();
            $article->var_designation = $var_designation;
            $article->status = 1;
            $article->rev_email = $rev_email;
            $article->cmd_ref = $cmd_ref;
            $article->save();
            $this->generateQrCodes($article->serie_number, $var_designation);

        }



    }



}
