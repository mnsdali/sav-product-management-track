@extends('layouts.app')


@section('content')

                    {{-- scan qr --}}
        <div class="col-4 form-group">
            <div class="form-group custom-control-inline">
                <label class="form-label">Préciser la quantité des articles à scanner</label>
                <input type="number" name="quantity" spellcheck="false" value="1"
                    oninput="this.value = parseInt(this.value) || 1;" min="1"
                    class="form-control  quantity-inp-edit-var quantity-cl-commande">
                <div class="validity-msg">
                </div>
                <a class="quantity-cl-commande-confirm-btn" title="confirmer la quantité (une seule fois)" data-toggle="tooltip"> <i class="fe fe-check-square"></i></a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="alert alert-primary text-center" role="alert">
                    <i class="fa fa-qrcode mr-2"></i> Veuillez s'il vous plaît scanner le QR de vente d'article à vendre
                </div>
            </div>
            <div id="qr_status">
                Veuillez rapprocher le QR pour le détecter
            </div>
            <div class="QR_div w-50" >
                <div id="venteLinkReader"></div>
            </div>
        </div>


    <script>
        var redirectUrl = `{{ route('vente.update', ':s_n') }}`;
        var lenCommandeClient=-1;
        var counterArticlesCommandeClient=0;
    </script>


@endsection
