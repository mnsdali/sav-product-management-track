@extends('layouts.app')

@section('content')
    @if ($errors->any())
    <div id="dangerAlert" class="alert alert-icon alert-danger alert-admissible fade show" role="alert">
        <i class="fe fe-bell mr-2" aria-hidden="true"></i> Une erreur s'est produit! veuillez reéssayer!
    </div>
    @endif
    @if (session('success'))
        <div id="successAlert" class="alert alert-icon alert-success" role="alert">
            <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ session('success') }}
        </div>
    @endif
    <div class="form-group prod-create-section">
        <form action="{{ route('produits.store') }}" method="post" id="prodsForm">
            @csrf
            <h2 class="text-center"> Ajout d'un nouveau produit au stock! </h2>

            <div class="card">
                <h5 class="text-center my-2">Détails Produit</h5>
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-4 form-group">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Reference</label>
                                <input type="text" class="form-control designation" name="referenceProd"
                                    placeholder="reference de produit..." required >
                                <div class="validity-msg"></div>

                            </div>
                        </div>
                        <div class="col-4 form-group">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-control  designation" name="nomProd"
                                    placeholder="nom de produit..." required >
                                <div class="validity-msg"></div>

                            </div>
                        </div>
                        <div class="col-4 form-group">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control designation" name="descriptionProd"
                                    placeholder="description de produit..." required>
                                <div class="validity-msg"></div>

                            </div>
                        </div>
                        <div class="col-4 form-group">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Prix</label>
                                <input type="number" name="prixProd" value="0" min="0" step="0.01"
                                    class="form-control is-valid" required>
                                <div class="valid-feedback">Le prix est bien saisie</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="text-center"> Ajout des séries à ce produit! </h2>

            {{-- <div class="prod-vars row d-flex justify-content-center">
                <div class="curr-var col-sm-6 col-lg-6 col-md-6 card">
                    <div class="card-body">
                        <h5 class="text-center my-2"></h5>
                        <h5 class="text-center"> Détails de la série! </h5>
                        <div class="card-body">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-10 row">
                                    <div class="col-8 form-group">
                                        <div class="form-group custom-control-inline">
                                            <label class="form-label">Designation</label>
                                            <input type="text" class="form-control designation"
                                                name="designations[]" placeholder="designation de variation...">
                                            <div class="validity-msg"></div>

                                        </div>
                                    </div>
                                    <div class="col-4 form-group">
                                        <div class="form-group custom-control-inline">
                                            <label class="form-label">Quantité</label>
                                            <input type="number" name="quantities[]" spellcheck="false" value="0"
                                                oninput="this.value = parseInt(this.value) || 0;" min="1"
                                                class="form-control quantity-inp">
                                            <div class="validity-msg">La quantité est n'est pas bien saisie</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 form-group">
                                    <div class="form-group custom-control-inline">
                                        <a class="add-var-btn" title="Ajouter une autre designation" data-toggle="tooltip"
                                            data-placement="top">
                                            <i class="fe fe-plus-square"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="var-pieces">
                            <div class="curr-piece">
                                <h4 class="text-center"> Ajout des piéces à la variation ci-dessus! </h4>
                                <div class="card">
                                    <h5 class="text-center my-2">Détails Piéce</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="form-group custom-control-inline ">
                                                    <label class="form-label">Reference de la piéce</label>
                                                    <input type="text" name="referencesPieces[][]"
                                                        class="form-control ref-piece-cls"
                                                        placeholder="reference de piece...">
                                                    <div class="validity-msg"></div>

                                                </div>
                                                <div class="form-group custom-control-inline">
                                                    <label class="form-label">Designation de la piéce</label>
                                                    <input type="text" name="designationsPieces[][]"
                                                        class="form-control ref-piece-cls"
                                                        placeholder="Designation de la piece...">
                                                    <div class="validity-msg"></div>

                                                </div>
                                                <div class="form-group custom-control-inline">
                                                    <label class="form-label">Indice d'arrivage de la piéce</label>
                                                    <input type="text" name="indices_arrivage[][]"
                                                        class="form-control ref-piece-cls"
                                                        placeholder="Indice d'arrivage de la piéce...">
                                                    <div class="validity-msg"></div>

                                                </div>
                                                <div class="form-group custom-control-inline col-lg-4 col-md-12">
                                                    <a class="add-piece-btn" title="Ajouter une autre designation"
                                                        data-toggle="tooltip" data-placement="top">
                                                        <i class="fe fe-plus-square"></i>
                                                    </a>
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
                                                    <input type="file" class="dropify-event dropify"
                                                        name="photosPieces[][]"
                                                        data-default-file="{{ asset('assets/images/noimage.jpg') }}"
                                                        value="{{ asset('assets/images/noimage.jpg') }}">
                                                    <x-input-error :messages="$errors->get('photosPieces')" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="new-vars row d-flex justify-content-center">
                <div class="new-vars-curr-var card">
                    <div class="card-body">
                        <h5 class="text-center"> Détails de la série! </h5>
                        <div class="card-body">
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-10 row">
                                    <div class="col-8 form-group">
                                        <div class="form-group custom-control-inline">
                                            <label class="form-label">Designation</label>
                                            <input type="text" class="form-control designation" name="designations[]"
                                                placeholder="designation de variation..." required>
                                            <div class="validity-msg"></div>

                                        </div>
                                    </div>
                                    <div class="col-4 form-group">
                                        <div class="form-group custom-control-inline">
                                            <label class="form-label">Quantité</label>
                                            <input type="number" name="quantities[]" spellcheck="false" value="0"
                                                oninput="this.value = parseInt(this.value) || 0;" min="1"
                                                class="form-control quantity-inp" required>
                                            <div class="validity-msg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 form-group">
                                    <div class="form-group custom-control-inline">
                                        <a class="vars-add-var-btn" title="Ajouter une autre designation"
                                            data-toggle="tooltip" data-placement="top">
                                            <i class="fe fe-plus-square"></i>
                                        </a>
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
                                                class="multiselect multiselect-custom new-var-piece-select" required>
                                                @foreach ($pieces as $piece)
                                                    <option value="{{ $piece['ref'] }}"> {{ $piece['ref'] }}
                                                        - {{ $piece['designation'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="form-group custom-control-inline">
                                            <a class="new-var-add-piece-btn" title="Ajouter une autre piéce"
                                                data-toggle="tooltip" data-placement="top">
                                                <i class="fe fe-plus-square"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <button
                                        class="float-right new-var-create-piece btn text-white bg-indigo btn-sm ml-4 mb-2"
                                        data-toggle="modal" type="button" data-target="#create-piece-modal">
                                        <small>céer une piéce qui n'existe pas</small>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"
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
                                <input type="text" name="pieceModalDesignation" class="form-control ref-piece-cls"
                                    placeholder="Designation de la piece...">
                                <div class="validity-msg"></div>

                            </div>
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Indice d'arrivage de la piéce</label>
                                <input type="text" name="pieceModalIndiceArrivage" class="form-control ref-piece-cls"
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
        var leftSidebarID = "left-sidebar-menu-produits-create";
    </script>
    <script>
        var pieces = @json($pieces);
    </script>
    <script>
        setTimeout(function() {
            var successAlert = document.getElementById('successAlert');
            if (successAlert) {
                successAlert.classList.add('hide-transition');
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
@endsection
