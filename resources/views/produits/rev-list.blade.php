@extends('layouts.app')

@section('content')

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="pieces-dataTable" class="table table-hover js-basic-example  dataTable table-vcenter table-striped" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Reference</th>
                                    <th>Designation</th>
                                    <th>Indice d'arrivage</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Reference</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr class="curr-piece gradeA">
                                        <td>
                                            {{$article->serie_number}}
                                         </td>

                                         <td>
                                            {{$article->reference}}
                                         </td>
                                         <td>
                                            {{$article->var_designation}}
                                         </td>
                                         <td>
                                            {{ $article->client_pseudo==null ? '<i class="fa fa-circle fa-red mr-2"> </i> non vendu' : '<i class="fa fa-circle fa-green mr-2"> </i> vendu'}}
                                         </td>
                                         <td>
                                            <div class="ml-auto text-muted">
                                                @if ($article->client==null)
                                                <a href="javascript:void(0)"  title="non vendu" data-toggle="tooltip"data-placement="top" class="icon d-md-inline-block ml-2 "><i class="fe fe-shopping-bag"></i></a>
                                                @else
                                                <a href="javascript:void(0)"  title="Client: {{$article->client->pseudo}}   NumTel1: {{$article->client->num_tel1}}" data-toggle="tooltip"data-placement="top" class="icon d-md-inline-block ml-2 "><i class="fe fe-user"></i></a>
                                            </div>
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
