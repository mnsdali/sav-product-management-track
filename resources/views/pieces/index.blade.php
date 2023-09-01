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
                    <a class="btn btn-primary my-2" href="{{route('pieces.create')}}">Créer une piéce</a>
                    <div class="table-responsive">
                        <table id="pieces-dataTable" class="table table-hover js-basic-example  dataTable table-vcenter table-striped" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Reference</th>
                                    <th>Designation</th>
                                    <th>Indice d'arrivage</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Reference</th>
                                    <th>Designation</th>
                                    <th>Indice d'arrivage</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                    @foreach ($pieces as $piece)
                                    <tr class="curr-piece gradeA">

                                        <td>
                                            <div class="img-hover-zoom">
                                                <img src="{{ str_contains($piece->photo, '/noimage.jpg' ) ? asset($piece->photo) : asset('storage/'.$piece->photo) }}" class="rounded piece-stats-photo" width=50 height=50>
                                            </div>
                                        </td>
                                         <td>
                                            <div class="piece-reference">{{$piece->ref}}</div>
                                         </td>
                                         <td>
                                            <div class="piece-stats-designation">{{$piece->designation}}</div>
                                         </td>
                                         <td>
                                            <small class="d-block text-muted piece-stats-ind-arr">{{$piece->indice_arrivage}}</small>
                                         </td>
                                         <td>
                                            <div class="ml-auto text-muted">
                                                <input type="hidden" value="{{$piece->qte_stock}}" class="total-stock">
                                                <a href="javascript:void(0)" class="icon piece-stats-qte {{$piece->qte_stock - $piece->qte_sav <= 0 ? "bg-red-class": ""}}" title="Qte Stock: {{$piece->qte_stock}} / Qte SAV: {{$piece->qte_sav}}" data-toggle="tooltip"data-placement="top">
                                                    <i class="icon-calculator"></i>
                                                </a>
                                                <a href="javascript:void(0)"  title="voir les séries qui utilisent cette piéce" data-toggle="tooltip"data-placement="top" class="icon d-md-inline-block ml-2 "><i class="icon-book-open"></i></a>
                                                <a href="javascript:void(0)"  title="modifier la piéce" data-toggle="tooltip" data-placement="top" class="icon d-md-inline-block ml-2 settings-btn"><i class="icon-pencil"></i></a>
                                                <a href="{{route('pieces.show', $piece->ref)}}"  title="voir les articles de la piéce" data-toggle="tooltip" data-placement="top" class="icon d-md-inline-block ml-2"><i class="fe fe-eye"></i></a>
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
    <div id="displayImage"></div>

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
