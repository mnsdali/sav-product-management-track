@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div id="successAlert" class="alert alert-icon alert-success" role="alert">
            <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ session('success') }}
        </div>
    @endif
    <div class="form-group">
        <form action="{{ route('pieces.maj') }}" method="post" id="edit-prod-form">
            @csrf
            <h2 class="text-center"> Modifier une piéce! </h2>

            <div class="card-body">
                <div class="form-group d-flex justify-content-center">
                    <div class="row d-inline-flex justify-content-center">
                        <div class="col-sm-6 col-md-6 col-lg-6">

                            <label class="form-label">Selectionner un produit</label>
                            <div class="form-group multiselect_div">
                                {{-- ref-opt --}}
                                <select id="edit-piece-prod-select" name="reference" class="multiselect multiselect-custom prod-for-edit-piece">
                                    @foreach ($produits as $produit)
                                        <option value="{{ $produit['reference'] }}"> {{ $produit['reference'] }} -
                                            {{ $produit['nom'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <label class="form-label">Selectionner une variation</label>
                            <div class="form-group multiselect_div">
                                {{-- ref-opt --}}
                                {{-- select variations that correspond only to the selected produit --}}
                                <select id="edit-piece-var-select" name="variation" class="multiselect multiselect-custom vars-for-edit-piece">
                                    {{-- @foreach ($variations as $variation)
                                        <option value="{{ $variation['designation'] }}"> {{ $variation['designation'] }}
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <label class="form-label">Selectionner une piéce</label>
                            <div class="form-group multiselect_div">
                                {{-- ref-opt --}}
                                {{-- select variations that correspond only to the selected produit --}}
                                <select id="edit-piece-piece-select" name="piece" class="multiselect multiselect-custom pieces-for-edit-piece">
                                    {{-- @foreach ($pieces as $piece)
                                        <option value="{{ $piece['designation'] }}"> {{ $piece['designation'] }}
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>{{-- ref-opt --}}

            <div class="card">
                <h3 class="text-center my-2">Détails de la piéce</h3>
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-4 col-md-4 col-lg-4 form-group">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Reference</label>
                                <input type="text" class="form-control is-invalid designation" name="reference"
                                    placeholder="reference de la piéce..." readonly>
                                <div class="invalid-feedback">ce champ est invalide</div>

                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4form-group">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control is-invalid designation" name="designation"
                                    placeholder="designation de la piéce...">
                                <div class="invalid-feedback">ce champ est invalide</div>

                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-4 col-md-4 col-lg-4 form-group">
                            <div class="card-header">
                                <h3 class="card-title">Photo de la piéce<small>mettre à jour l'image qui représente la
                                        piéce</small></h3>
                            </div>
                            <div class="card-body">
                                <input type="file" class="dropify-event dropify" name="photo" >
                                        {{-- data-default-file="{{ asset('assets/images/noimage.jpg') }}" value="{{ asset('assets/images/noimage.jpg') }}"> --}}
                                <x-input-error :messages="$errors->get('photos')" class="mt-2" />
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
    {{-- <script>
        const produits = @json($produits);
    </script> --}}
    <script>
        const variations = @json($variations);
        const pieces = @json($pieces);
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
