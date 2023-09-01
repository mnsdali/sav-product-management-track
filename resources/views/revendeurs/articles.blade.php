@extends('layouts.app')

@section('content')
    @if (session('success'))
    <div id="successAlert" class="alert alert-icon alert-success alert-admissible fade show" role="alert">
        <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ session('success') }}
    </div>

    @endif
    @if (session('warning'))
    <div id="successAlert" class="alert alert-icon alert-warning alert-admissible fade show" role="alert">
        <i class="fe fe-bell mr-2" aria-hidden="true"></i> {{ session('warning') }}
    </div>
    @endif
    <h4 class="text-center">Votre liste des commandes achevés</h4>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover revendeurDTable  dataTable table-vcenter table-striped" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Serie Number</th>
                                    <th>Commande d'achat</th>
                                    <th>Série</th>
                                    <th>Produit</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>
                                    @foreach ($articles as $article)
                                    <tr class="curr-cmd-cl gradeA">
                                        <td>{{$article->serie_number}}</td>
                                        <td>{{$article->cmd_ref}}</td>
                                        <td>{{$article->designation}}</td>
                                        <td>{{$article->reference}}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-icon on-default m-r-5"
                                            data-html="true"    data-toggle="tooltip" title="{{$article->client_pseudo ? "vendu" : "non vendu" }}">
                                                @if($article->client_pseudo)

                                                    <i class="fa fa-circle fa-color-gray" aria-hidden="true"></i>

                                                @else
                                                    <i class="fa fa-circle fa-color-green" aria-hidden="true"></i>
                                                @endif
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
