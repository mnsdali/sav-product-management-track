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

    <h4 class="text-center">Liste des articles de la piece: {{$piece->designation}}</h4>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover data-table-articles-var  dataTable table-vcenter table-striped" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID Article Piece</th>
                                    <th>Reference</th>
                                    <th>Status d'utilisation</th>
                                    <th>Derniére update</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID Article Piece</th>
                                    <th>Reference</th>
                                    <th>Status d'utilisation</th>
                                    <th>Derniére update</th>
                                    <th></th>

                                </tr>
                            </tfoot>
                            <tbody>
                                   @for($i=0;$i<count($articlesPiece); $i++)
                                        <tr class="curr-article">
                                            <input type="hidden" class="qr_file_name" value="{{$piece->ref.'_'.$articlesPiece[$i]->id}}">
                                            <td class="ref-article">{{$piece->ref.'#'.$articlesPiece[$i]->id}}</td>
                                            <td class="ref-piece">{{$piece->ref}}</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-icon on-default m-r-5"
                                                data-html="true"    data-toggle="tooltip" title="{{$articlesPiece[$i]->isUsed ? "utilisé" : "non utilisé" }}">
                                                    @if($articlesPiece[$i]->isUsed)
                                                        <i class="fa fa-circle fa-color-gray" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-circle fa-color-green" aria-hidden="true"></i>
                                                    @endif
                                                </a>
                                            </td>
                                            </td>

                                            <td>{{$articlesPiece[$i]->updated_at}}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-icon on-default m-r-5 print-article-piece-qrs-btn"
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
    <a href="{{route('pieces.printQrs', $piece->ref)}}" class="btn btn-primary on-default w-25"
        target="_blank" data-toggle="tooltip" title="Imprimer ses Codes QRs">
        <div class="d-flex align-items-center mx-auto">
            <i class="fa fa-qrcode mr-2" aria-hidden="true"></i> Imprimer les CQR de cette piéce
        </div>
    </a></div>

    <script>
        var qrCodesPieces = @json($qrCodes);
    </script>
@endsection
