<div class="m-5">
    <div class="form-reclamation">

        <h1>Formulaire de réclamation</h1>


        <form action="{{ route('reclamations.store') }}" method="post" enctype="multipart/form-data">
            @csrf



            {{-- scan qr --}}
            @if(session('failure'))
            <div class="alert alert-icon alert-failure text-center" role="alert">
                <i class="fe fe-alert-triangle mr-2"></i> {{ session('failure') }}
            </div>
            @endif
            <div class="row clearfix row-deck">

                <div class="row  col-lg-6 col-md-6 col-sm-12">
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                    <div class="alert alert-primary text-center" role="alert">
                        <i class="fa fa-qrcode mr-2"></i> Veuillez s'il vous plaît scanner le QR de Numéro de série de votre article
                    </div>
                    </div>
                    <div class=" col-lg-12 col-md-12 col-sm-12">
                    <div id="qr_status">

                    </div>

                    <div class="QR_div">
                        <div id="readerQrReclamation"></div>
                        <div id="result">
                            <div id="recl_prod_details">
                            <p id="referenceProd"> Produit: <b >  </b> </p>
                            <p id="variation"> Série: <b ></b> </p>
                            <p id="serie_number"> Numéro de série: <b ></b> </p>
                            <p id="created_at"> Acheté le: <b ></b> </p>
                            <p id="pseudo"> Pseudo de client: <b ></b> </p>
                        </div>
                            <input type="hidden" id="lat" name="lat">
                            <input type="hidden" id="lng" name="lng">
                            <input type="hidden" id="ipaddr" name="ipaddr">
                            <input type="hidden" id="prodSerial" name="prodSerial">
                        </div>
                    </div>
                    <small id="resultCoords"> </small>
                    </div>
                </div>
                <div class="row col-lg-6 col-md-6 col-sm-12">
                    <!-- Type de Panne de la Machine -->
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <label class="form-label">Selectionner le type de panne</label>
                        <div class="form-group multiselect_div">
                            <select id="type-panne-select" name="typePanne" class="multiselect multiselect-custom type-panne-select">

                                @foreach ($typesPanne as $type)
                                    <option value="{{ $type->id }}"> {{ $type->designation }}</option>
                                @endforeach
                                <option value="inconnue">  je ne sais pas </option>
                            </select>
                        </div>

                    </div>

                    <!-- Description de Panne de la Machine -->
                    <div class="col-lg-12 col-md-12  col-sm-12 form-group">
                        <label class="form-label">Décrire brièvement la panne de votre produit... <span
                                id="countCharsPanneDescrip" class="form-label-small">0/500</span></label>
                        <textarea class="form-control" id="panne-descrip-textarea" name="panneDescrip" rows="6"
                            placeholder="Veuillez écrire une description briéve sur la panne"></textarea>
                    </div>

                    <div class="col-lg-12 col-md-12  col-sm-12">
                    <button type="submit" class="btn btn-square btn-primary mt-4 mx-auto" title="Envoyer la réclamation"
                        data-toggle="tooltip" data-placement="top">
                        <i class="fe fe-slack mr-2"></i> Envoyer
                    </button>
                    </div>
                </div>


            </div>
        </form>
    </div>
</div>



{{-- qr scanner + jquery + coords --}}

<script>
    var articles = @json($articles);
</script>
