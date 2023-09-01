@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div id="successAlert" class="alert alert-icon alert-success" role="alert">
            <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ session('success') }}
        </div>
    @endif
    <div class="form-group">
        <form action="{{ route('produits.maj') }}" method="post" id="edit-prod-form">
            @csrf
            <h2 class="text-center"> Modifier un produit! </h2>

            <div class="card-body">
                <div class="form-group d-flex justify-content-center">
                    <div class="col-lg-4 col-md-12">
                        <label class="form-label">Selectionner un produit</label>
                        <div class="form-group multiselect_div">

                            <select id="edit-produit-select" name="reference" class="multiselect multiselect-custom">
                                @foreach ($produits as $produit)
                                    <option value="{{ $produit['reference'] }}"> <b>{{ $produit['reference'] }}</b> -
                                        <b>{{ $produit['nom'] }}</b>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>{{-- ref-opt --}}

            <div class="card">
                <h3 class="text-center my-2">Détails Produit</h3>
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-4 col-md-4 col-lg-4 form-group">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Reference</label>
                                <input type="text" class="form-control is-invalid designation" name="newReference"
                                    placeholder="reference de produit...">
                                <div class="invalid-feedback">ce champ est invalide</div>

                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4form-group">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-control is-invalid designation" name="nomsNewProd[]"
                                    placeholder="nom de produit...">
                                <div class="invalid-feedback">ce champ est invalide</div>

                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-4 col-md-4 col-lg-4 form-group">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control is-invalid designation" name="descriptions"
                                    placeholder="description de produit...">
                                <div class="invalid-feedback">ce champ est invalide</div>

                            </div>
                        </div>
                        <div class="col-4 form-group">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Prix</label>
                                <input type="number" name="prix" value="0" min="0" step="0.01"
                                    class="form-control is-valid">
                                <div class="valid-feedback">Le prix est bien saisie</div>
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
        setTimeout(function() {
            var successAlert = document.getElementById('successAlert');
            if (successAlert) {
                successAlert.classList.add('hide-transition');
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
@endsection
