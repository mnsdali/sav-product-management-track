@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div id="successAlert" class="alert alert-icon alert-success" role="alert">
            <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('type_panne.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h2 class="text-center"> Création des types de pannes! </h2>

        <div class="types-panne row">

            <div class="curr-type-panne card col-lg-3 col-md-6 col-sm-12 m-2">
                <div class="row d-flex align-items-end">
                    <div class="col-sm-10 col-md-10 col-lg-10">

                            <div class="form-group custom-control-inline">
                                <label class="form-label">Designation</label>
                                <input type="text" class="form-control designation"
                                    name="designations[]" placeholder="designation de type de panne...">
                                <div class="validity-msg"></div>
                            </div>


                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <div class="form-group custom-control-inline">
                            <a class="new-type-add-btn" title="Ajouter un autre type de panne" data-toggle="tooltip"
                                data-placement="top">
                                <i class="fe fe-plus-square"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="w-75">
            <button type="submit" class="btn btn-primary"><i class="fa fa-check mr-2" aria-hidden="true"></i> Valider</button>
            </div>
        </div>

    </form>
    <script>
        var leftSidebarID = "left-sidebar-menu-type-create";
    </script>




@endsection
