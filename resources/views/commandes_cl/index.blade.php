@extends('layouts.app')

@section('content')
    <div class="form-group">
        <form action="{{ route('commande_cl.store') }}" method="post" id="commande_cl_form">
            @csrf
            <h2 class="text-center"> Confirmer la vente avec le client </h2>

            <div class="card">
                <h5 class="text-center my-2">Détails des produits</h5>
                <div class="col-6">
                    Revendeur: <b>{{ $user['name'] }}</b>
                </div>
                <div class="card-body">
                    @foreach($articles as $article)
                    <div class="row d-flex">
                        <div class="col-4 ">
                            S/N: <b>{{ $article->serie_number }}</b>
                        </div>
                        <div class="col-4 ">
                            Reference: <b>{{ $article['reference'] }}</b>
                        </div>
                        <div class="col-4">
                            Série: <b>{{ $article['var_designation'] }}</b>
                        </div>
                        <div class="col-4">
                            Prix: <b>{{ $article['prix'] }}</b> D.T
                        </div>


                    </div>
                    @endforeach

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="prenom" class="control-label">Prénom</label>
                                <input type="text" id="prenom" name="prenom" placeholder="John" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="nom" class="control-label">Nom</label>
                                <input type="text" id="nom" name="nom" placeholder="Wick" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="num_tel1" class="control-label">Num tel1</label>
                                <input type="text" id="num_tel1" name="num_tel1" class="form-control"
                                    pattern="[1-9]{1}[0-9]{7}" required>
                                <span class="help-block">99666999</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="num_tel2" class="control-label">Num tel2</label>
                                <input type="text" id="num_tel2" name="num_tel2" class="form-control"
                                    pattern="[1-9]{1}[0-9]{7}">
                                <span class="help-block">99666999</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-25 mx-auto">
                <button type="submit" class="btn btn-square btn-primary" title="Confirmer l'achat" data-toggle="tooltip"
                    data-placement="top">
                    <i class="fe fe-shopping-bag mr-2"></i> Confirmer
                </button>
            </div>
        </form>
    </div>
@endsection
