@extends('layouts.app')

@section('imports')

    @vite(['resources/css/revendeur_crud.css',
    'resources/css/client_crud.css',
            'resources/js/client_crud.js'])
@endsection





@section('content')

<section id="crud">
    @include('layouts.dashboard_sidebar');
    <div class="container-lg">
        <div class="margined table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Gestionnaire de <b>Clients</b></h2></div>
                        <div class="col-sm-4">
                            <a href="{{route('clients.create', ['rev_id'=>1])}}"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Ajouter</button></a>
                        </div>
                    </div>
                </div>
                <table class=" table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>NumTel1</th>
                            <th>NumTel2</th>
                            <th>Inscrit depuis</th>
                            <th>Derniére Mise à jour</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td id="#0"><b >{{$client['id']}}</b></td>
                                <td id="#1">{{$client['nom']}}</td>
                                <td id="#2">{{$client['prenom']}}</td>
                                <td id="#3">{{$client['num_telephone1']}}</td>
                                <td id="#4">{{$client['num_telephone2']}}</td>
                                <td>{{$client['created_at']}}</td>
                                <td>{{$client['updated_at']}}</td>
                                <td>
                                    <a class="add icon" title="Add" data-toggle="tooltip"><i class="fa-solid fa-plus fa-beat"></i></a>
                                    <a class="edit icon" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    {{-- <a class="delete" title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a> --}}
                                    <a class="view icon" title="View" data-toggle="tooltip"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="client-modal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>


            <div id="modal-body"> </div>
        </div>

        <div class="hover-div">
        </div>

    </div>

    @if ($isRedirected)
        <div id="newClientAdded"></div>
    @endif
</section>

@endsection
