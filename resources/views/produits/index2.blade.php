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
    <h4 class="text-center">Liste des produits</h4>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover variations-produit-data-table table-vcenter table-striped"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Reference</th>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Reference</th>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($prodVariations as $variations)
                                    <tr class="curr-prod gradeA">
                                        <td class="reference"> <b>{{ $variations[0]->reference }}</b> </td>
                                        <td class="childTitle">
                                            {{ $variations[0]->nom }}
                                        </td>
                                        <td> <small> {{ $variations[0]->description }} </small></td>
                                        <td class="prix"> {{ $variations[0]->prix }} </td>
                                    </tr>

                                    @foreach ($variations as $variation)
                                    <tr class="curr-var gradeA">
                                        <td class="reference"> <b>{{ $variations[0]->reference }}</b> </td>
                                        <td>
                                            <div class="ml-4">
                                            {{ $variation->designation }}

                                            </div>
                                        </td>
                                        <td><a href="{{ route('variations.show-articles', $variation->designation) }}"
                                            class="btn btn-sm btn-icon on-default m-r-5" target="_blank"
                                            data-toggle="tooltip" title="Afficher ses articles">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a></td>
                                        <td>-</td>

                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
