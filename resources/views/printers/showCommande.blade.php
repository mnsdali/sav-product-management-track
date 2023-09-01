@extends('layouts.app')

@section('content')
<div>

    <div class="card">
        <div class="card-body">
            <div class="ml-4">
                <div class="row">
                    <div class="col-6">
                        <p> Commande n° <b>{{ $commande['reference'] }} </b> </p>
                    </div>
                    <div class="col-6">
                        <p> Date de la commande: {{ $commande['updated_at'] }}</b> </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p> Nom du revendeur: <b>{{ $commande['name'] }}</b> </p>
                    </div>
                    <div class="col-6">
                        <p> Email du revendeur: <b>{{ $commande['email'] }}</b> </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p> Numéro de téléphone 1:<b> {{ $commande['num_tel1'] }}</b> </p>
                    </div>
                    <div class="col-6">
                        <p> Numéro de téléphone 2:<b> {{ $commande['num_tel2'] }}</b> </p>
                    </div>
                </div>
            </div>

            <h3 class="text-center my-4"> Détails de la commande </h3>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="panier">
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Référence </th>
                                                <th>Désignation</th>
                                                <th>Prix</th>
                                                <th>Quantité</th>
                                                <th>Sous-total</th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <hr>
                                            <tr>
                                                <td colspan="4" class="text-right"><b>Total</b></td>
                                                <td><b id="total">{{ $commande['total'] }}</b> <small> DT </small>
                                                </td>
                                            </tr>

                                        </tfoot>

                                        <tbody id="cart-table">
                                            @foreach ($detailsCommande as $detail)
                                                <tr class="cart_row bg-white border-b border-gray-700">
                                                    <td><b>{{ $detail['cmd_ref'] }}</b> </td>
                                                    <td><b>{{ $detail['var_designation'] }}</b> </td>
                                                    <td class="prix">{{ $detail['prix'] }}</td>
                                                    <td class="qte">{{ $detail['qte'] }}</td>
                                                    <td class="sout_total"><b>{{ $detail['sous_total'] }}</b></td>
                                                </tr>
                                            @endforeach
                                        </tbody>


                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="my-4">
            <p class="text-right mr-4"> Reçu en <b>{{$currDate}}</b> </p>
        </div>
    </div>
</div>
    <div class="d-flex justify-content-center">
        <div class="return-btn-label d-flex">
            <small class="mt-2"> Si vous avez terminé, </small>
            <a href="{{ route('printers.revendeurs_commandes') }}" class="btn btn-link">
                <small class="return-btn-label">retourner vers la liste des commandes </small> </a>
        </div> <span class="rotative-icon mt-1 mr-4"><i class="fe fe-rotate-cw"></i></span>

        <button type="button" id="print-commande-btn" class="btn btn-success checkout-btn" title="Impression d'un reçu"
            data-toggle="tooltip" data-placement="bottom">
            <i class="icon-printer mr-2"></i>Imprimer Reçu
        </button>
        <button type="button" id="print-commande-qrs-btn" class="btn btn-indigo" title="Impression d'un reçu"
            data-toggle="tooltip" data-placement="bottom">
            <i class="icon-printer mr-2"></i>Imprimer Qrs
        </button>
    </div>
    <script>
        var leftSidebarID = "left-sidebar-menu-commandes-revendeurs";
    </script>
@endsection


<div id="pdf-content" style="display:none">
    <br><br><br>
    <div class="card">
        <div class="card-body">
            <table cellspacing="10">
                <tr>
                    <td>
                        <p> Commande n° <b>{{ $commande['reference'] }} </b> </p>
                    </td>
                    <td></td>
                    <td>
                        <p> Date de la commande: {{ $commande['updated_at'] }}</b> </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p> Nom du revendeur: <b>{{ $commande['name'] }}</b> </p>
                    </td>
                    <td></td>
                    <td>
                        <p> Email du revendeur: <b>{{ $commande['email'] }}</b> </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p> Numéro de téléphone 1:<b> {{ $commande['num_tel1'] }}</b> </p>
                    </td>
                    <td></td>
                    <td>
                        <p> Numéro de téléphone 2:<b> {{ $commande['num_tel2'] }}</b> </p>
                    </td>
                </tr>
            </table>
            <br><br><br>
            <br><br><br>
            <h3 align="center">
                Détails de la commande
            </h3>

            <br> <br>
            <table class="table table-hover table-vcenter table-striped" cellspacing="20">
                <thead>
                    <tr>
                        <th colspan="2">Référence </th>
                        <th colspan="2">Désignation</th>
                        <th colspan="2">Prix</th>
                        <th colspan="2">Quantité</th>
                        <th colspan="2">Sous-total</th>
                    </tr>
                </thead>

                <tfoot>
                    <hr>
                    <tr>
                        <td colspan="8" ><b align="right">Total</b></td>
                        <td><b id="total">{{ $commande['total'] }}</b> <small> DT </small>
                        </td>
                    </tr>

                </tfoot>

                <tbody id="cart-table">
                    @foreach ($detailsCommande as $detail)
                        <tr class="cart_row bg-white border-b border-gray-700">
                            <td colspan="2"><b>{{ $detail['cmd_ref'] }}</b> </td>
                            <td colspan="2"><b>{{ $detail['var_designation'] }}</b> </td>
                            <td colspan="2" class="prix">{{ $detail['prix'] }}</td>
                            <td colspan="2" class="qte">{{ $detail['qte'] }}</td>
                            <td colspan="2" class="sout_total"><b>{{ $detail['sous_total'] }}</b></td>
                        </tr>
                    @endforeach
                </tbody>


            </table>


        </div>
        <br>
        <br>
            <p align="right"> Reçu en <b>{{ $currDate }}</b> </p>

    </div>
</div>

    <div class="card " id="pdf-qrs-content" style="display:none">
        <div class="card-body">
            <table>
                <thead>

                </thead>


                <tbody>


                    @for($i=0; $i<count($qrs); $i+=3 )
                        {{-- image sn --}}
                        <tr>
                            <td><pre>        Intervention  <pre></td>
                            <td><pre>        S/N d'article  <pre></td>
                            <td><pre>           Vente   <pre></td>
                        </tr>
                        <tr>
                           <td> <img src="{{asset('storage/'.$qrs[$i])}}" width=200 > </td>
                           <td> <img src="{{asset('storage/'.$qrs[$i+1])}}" width=200 > </td>
                           <td> <img src="{{asset('storage/'.$qrs[$i+2])}}" width=200 > </td>
                        </tr>
                    @endfor
                </tbody>
                </table>
        </div>
    </div>
{{-- --}}
