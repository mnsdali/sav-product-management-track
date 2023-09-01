@extends('layouts.app')

@section('content')
    @if ($errors->any())
    <div id="dangerAlert" class="alert alert-icon alert-danger alert-admissible fade show" role="alert">
        <i class="fe fe-bell mr-2" aria-hidden="true"></i> Une erreur s'est produit! veuillez reéssayer!
    </div>
    @endif
    @if (session('success'))
        <div id="successAlert" class="alert alert-icon alert-success alert-admissible fade show" role="alert">
            <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ session('success') }}
        </div>

    @endif
    @if (session('warning'))
        <div id="warningAlert" class="alert alert-icon alert-warning alert-admissible fade show" role="alert">
            <i class="fe fe-bell mr-2" aria-hidden="true"></i> {{ session('warning') }}
        </div>
    @endif
    <div class="form-group prod-create-section">
        <form action="{{ route('variation.update-serie') }}" method="post">
            @csrf
            <h2 class="text-center"> Création des séries </h2>

            <div class="new-vars row d-flex justify-content-center">
                <div class="new-vars-curr-var card">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-10 row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 mx-auto">

                                        <label class="form-label">Selectionner la série souhaitée</label>
                                        <div class="form-group multiselect_div">
                                            {{-- ref-opt --}}
                                            <select id="edit-var-var-select" name="var_designation" class="multiselect multiselect-custom edit-var-prods-select" required>
                                                @foreach ($variations as $variation)
                                                    <option value="{{ $variation['designation'] }}"> {{ $variation['designation'] }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4 form-group">
                                        <div class="form-group custom-control-inline">
                                            <label class="form-label">Ajouter une quantité</label>
                                            <input type="number" name="quantity" spellcheck="false" value="0"
                                                oninput="this.value = parseInt(this.value) || 0;" min="0"
                                                class="form-control  quantity-inp-edit-var">
                                            <div class="validity-msg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="text-center"> Ajout des piéces à la variation ci-dessus! </h4>
                        <hr>
                        <div class="new-var-pieces row">

                            <div class="new-var-curr-piece card col-lg-3 col-md-6 col-sm-12">
                                <div class="row d-flex align-items-end">
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <label class="form-label">Selectionner une piéce</label>
                                        <div class="form-group multiselect_div">
                                            <select name="referencesPieces[][]"
                                                class="multiselect multiselect-custom new-var-piece-select">
                                                @foreach ($pieces as $piece)
                                                    <option value="{{ $piece['ref'] }}"> {{ $piece['ref'] }}
                                                        - {{ $piece['designation'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="form-group custom-control-inline">
                                            <a class="new-var-add-piece-btn" title="Ajouter une autre piéce" data-toggle="tooltip"
                                                data-placement="top">
                                                <i class="fe fe-plus-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <button class="float-right new-var-create-piece btn text-white bg-indigo btn-sm ml-4 mb-2" data-toggle="modal"
                         type="button"   data-target="#create-piece-modal"><small>céer une piéce qui n'existe pas</small></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block submit-vars-create-btn"><i class="fa fa-check"
                        aria-hidden="true"></i></button>
            </div>

        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="create-piece-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Détails Piéce</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group custom-control-inline ">
                                <label class="form-label">Reference de la piéce</label>
                                <input type="text" name="pieceModalRef" class="form-control ref-piece-cls"
                                    placeholder="reference de piece...">
                                <div class="validity-msg"></div>

                            </div>
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Designation de la piéce</label>
                                <input type="text" name="pieceModalDesignation"
                                    class="form-control  ref-piece-cls" placeholder="Designation de la piece...">
                                <div class="validity-msg"></div>

                            </div>
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Indice d'arrivage de la piéce</label>
                                <input type="text" name="pieceModalIndiceArrivage"
                                    class="form-control ref-piece-cls"
                                    placeholder="Indice d'arrivage de la piéce...">
                                <div class="validity-msg"></div>

                            </div>
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Quantité total en stock</label>
                                <input type="number" name="pieceModalQteStock" spellcheck="false" value="0"
                                                    oninput="this.value = parseInt(this.value) || 0;" min="1"
                                                    class="form-control  quantity-inp">
                                <div class="validity-msg"></div>

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">

                            <div class="card-header">
                                <h3 class="card-title">Photo de la piéce<small>choisir une image pour
                                        représenter
                                        la
                                        piéce</small></h3>
                            </div>
                            <div class="card-body">
                                <input type="file" class="dropify-event dropify" name="pieceModalPhoto"
                                    data-default-file="{{ asset('assets/images/noimage.jpg') }}"
                                    value="{{ asset('assets/images/noimage.jpg') }}">
                                <x-input-error :messages="$errors->get('pieceModalPhoto')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="button" id="piece-modal-save-btn" class="btn btn-primary">Sauvegarder</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var leftSidebarID = "left-sidebar-menu-variations-create";
    </script>

    <script>
        var pieces = @json($pieces);
    </script>

@endsection
