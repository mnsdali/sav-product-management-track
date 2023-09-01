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

    <h4 class="text-center">Liste des article de la variation: {{$variation->designation}}</h4>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover data-table-articles-var  dataTable table-vcenter table-striped" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Numéro de série</th>
                                    <th>Status de revendeur</th>
                                    <th>Status de client</th>
                                    <th>Derniére update</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Numéro de série</th>
                                    <th>Status de revendeur</th>
                                    <th>Status de client</th>
                                    <th>Derniére update</th>
                                    <th></th>

                                </tr>
                            </tfoot>
                            <tbody>
                                   @for($i=0;$i<count($articles); $i++)
                                        <tr class="curr-article">
                                            <td class="serie_number">{{$articles[$i]->serie_number}}</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-icon on-default m-r-5"
                                                data-html="true"    data-toggle="tooltip" title="{{$articles[$i]->rev_email ? "vendu" : "non vendu" }}">
                                                    @if($articles[$i]->rev_email)

                                                        <i class="fa fa-circle fa-color-gray" aria-hidden="true"></i>

                                                    @else
                                                        <i class="fa fa-circle fa-color-green" aria-hidden="true"></i>
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-icon on-default m-r-5"
                                            data-html="true"    data-toggle="tooltip" title="{{$articles[$i]->client_pseudo ? "vendu" : "non vendu" }}">
                                                @if($articles[$i]->client_pseudo)
                                                    <i class="fa fa-circle fa-color-gray" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-circle fa-color-green" aria-hidden="true"></i>
                                                @endif
                                            </a>
                                            </td>

                                            <td>{{$articles[$i]->updated_at}}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-icon on-default m-r-5 print-article-qrs-btn"
                                                    data-toggle="tooltip" title="Imprimer ses Codes QRs">
                                                        <i class="fa fa-qrcode" aria-hidden="true"></i>
                                                    </a>
                                            </td>
                                        </tr>
                                   @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
    <a href="{{route('variations.printQrs', $variation->designation)}}" class="btn btn-primary on-default w-25"
        target="_blank" data-toggle="tooltip" title="Imprimer ses Codes QRs">
        <div class="d-flex align-items-center mx-auto">
            <i class="fa fa-qrcode mr-2" aria-hidden="true"></i> Imprimer les CQR de cette variation
        </div>
    </a></div>

    <script>
        var qrCodes = @json($qrCodes);
    </script>
@endsection
