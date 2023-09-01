@extends('layouts.app')

@section('content')
@if (session('success'))
<div id="successAlert" class="alert alert-icon alert-success" role="alert">
    <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ session('success') }}
</div>
@endif
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary my-2" href="{{route('type_panne.create')}}">Créer un type de panne</a>
                    <div class="table-responsive">
                        <table id="pieces-dataTable" class="table table-hover js-basic-example  dataTable table-vcenter table-striped" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Designation</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Designation</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                    @foreach ($typesPanne as $type)
                                    <tr class="curr-type-panne gradeA">


                                         <td>
                                            <div class="type-id">{{$type->id}}</div>
                                         </td>
                                         <td>
                                            <div class="piece-stats-designation">{{$type->designation}}</div>
                                         </td>
                                         <td>
                                            <div class="ml-auto text-muted">
                                                <a href="javascript:void(0)"  title="voir les piéces relatives à ce type de panne" data-toggle="tooltip"data-placement="top" class="icon d-md-inline-block ml-2 "><i class="icon-book-open"></i></a>
                                                <a href="javascript:void(0)"  title="modifier le type" data-toggle="tooltip" data-placement="top" class="icon d-md-inline-block ml-2 settings-btn"><i class="icon-pencil"></i></a>
                                                <span class="isHiddenSpan"> <a href="javascript:void(0)"  title="{{$type->isHidden ? "afficher ce type pour les utilisateurs" : "cacher ce type de utilisateurs"}}" data-toggle="tooltip" data-placement="top" class="icon d-md-inline-block ml-2 check-status-type-panne">
                                                    @if ($type->isHidden)
                                                        <i class="fe fe-eye"></i>
                                                    @else
                                                        <i class="fe fe-eye-off"></i>
                                                    @endif
                                                   </span>
                                            </div>
                                         </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <!-- Modal -->
    <div class="modal fade" id="edit-piece-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                              <input type="file" class="dropify-event dropify" name="pieceModalPhoto" >
                              <x-input-error :messages="$errors->get('pieceModalPhoto')" class="mt-2" />
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  <button type="button" id="edit-piece-modal-save-btn" class="btn btn-primary">Sauvegarder</button>
              </div>
          </div>
      </div>
  </div>
  <script>
    var createPiecesRoute = '{{ route("pieces.create") }}';
</script>


@endsection
