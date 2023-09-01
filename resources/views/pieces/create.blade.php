@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div id="successAlert" class="alert alert-icon alert-success" role="alert">
            <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pieces.add') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h2 class="text-center"> Création des piéces! </h2>

        <div class="card curr-piece">
            {{-- <h3 class="text-center">Détails de la piéce</h3> --}}
            <div class="card-body">
                <div class="row d-flex align-items-center">
                    <div class="row col-7">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group custom-control-inline ">
                                <label class="form-label">Reference</label>
                                <input type="text" name="referencesNewPiece[]"
                                    class="form-control ref-piece-cls" placeholder="reference de la piéce...">
                                <div class="validity-msg"></div>

                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Designation</label>
                                <input type="text" name="designationsNewPiece[]"
                                    class="form-control ref-piece-cls" placeholder="designation de la piéce...">
                                <div class="validity-msg"></div>

                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group custom-control-inline">
                                <label class="form-label">Indice d'arrivage</label>
                                <input type="text" name="indiceArrivageNewPiece[]"
                                    class="form-control ref-piece-cls"
                                    placeholder="indice d'arrivage de la piéce...">
                                <div class="validity-msg"></div>

                            </div>
                        </div>
                    </div>


                    <div class="col-4 h-25">

                        <div class="card-header">
                            <h3 class="card-title">Photo de la piéce<small>choisir une image pour représenter la
                                    piéce</small></h3>
                        </div>
                        <div class="card-body">
                            <input type="file" class="dropify-event dropify" name="photos[]"
                                data-default-file="{{ asset('assets/images/noimage.jpg') }}"
                                value="{{ asset('assets/images/noimage.jpg') }}">
                            <x-input-error :messages="$errors->get('photos')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1 col-lg-1">
                        <div class="form-group custom-control-inline">
                            <a class="add-piece-btn-create" title="Créer une autre piece" data-toggle="tooltip"
                                data-placement="top">
                                <i class="fe fe-plus-square"></i>
                            </a>
                        </div>
                    </div>
                    <div class="form-group custom-control-inline">
                        <label class="form-label">Quantité total en stock</label>
                        <input type="number" name="quantities[]" spellcheck="false" value="0"
                                            oninput="this.value = parseInt(this.value) || 0;" min="1"
                                            class="form-control  quantity-inp">
                        <div class="validity-msg"></div>

                    </div>
                </div>
            </div>
        </div>

        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check" aria-hidden="true"></i></button>
        </div>

    </form>
    <script>
        var leftSidebarID = "left-sidebar-menu-pieces-create";
    </script>

    <script>
        setTimeout(function() {
            var successAlert = document.getElementById('successAlert');
            if (successAlert) {
                successAlert.classList.add('hide-transition');
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>

    <script>
        const variations = @json($variations);
    </script>
@endsection
