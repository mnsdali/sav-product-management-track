@extends('layouts.app')



@section('content')

<section id="crud">
    @include('layouts.dashboard_sidebar');
    <div class="container-lg">
        <div class="margined table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Gestionnaire d'<b>achats des revendeurs</b></h2></div>
                    </div>
                </div>
                <table class=" table table-bordered">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Label</th>
                            <th>Description</th>
                            <th>Revendeur</th>
                            <th>NumTel</th>
                            <th>Date Achat</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($commands as $article)
                            <tr>
                                <td><b>{{$article['reference']}}</b></td>
                                <td>{{$article['label']}}</td>
                                <td>{{$article['description']}}</td>
                                <td>{{$article['nom']}} {{$article['prenom']}}</td>
                                <td>{{$article['num_telephone']}}</td>
                                <td>{{$article['created_at']}}</td>
                                <td>
                                    <a class="add icon" title="Add" data-toggle="tooltip"><i class="fa-solid fa-plus fa-beat"></i></a>
                                    <a class="edit icon" title="Edit" data-toggle="tooltip"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    {{-- <a class="delete" title="Delete" data-toggle="tooltip"><i class="fa fa-trash-o" aria-hidden="true"></i></a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</section>

@endsection
