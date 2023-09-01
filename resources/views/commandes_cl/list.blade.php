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
                                    <th class="text-center">#</th>
                                    <th>Serie Number</th>
                                    <th>Pseudo de Client</th>
                                    <th>Nom et Prénom</th>
                                    <th>Tel1</th>
                                    <th>Tel2</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>
                                    @foreach ($commandes as $commande)
                                    <tr class="curr-cmd-cl gradeA">
                                        <td>{{$commande->id}}</td>
                                        <td>{{$commande->serie_number}}</td>
                                        <td>{{$commande->client_pseudo}}</td>
                                        <td>{{$commande->cl_prenom}} {{$commande->cl_nom}}</td>
                                        <td>{{$commande->num_tel1}}</td>
                                        <td>{{$commande->num_tel2 ?$commande->num_tel2 : 'xxxxxxxx' }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-icon on-default m-r-5"
                                            data-html="true"    data-toggle="tooltip" title="{{$commande->serie_number}}<br>{{$commande->designation}}<br>{{$commande->reference}}: {{$commande->nom}} {{$commande->prix}}D.T">
                                                <i class="icon-eye" aria-hidden="true"></i>
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
