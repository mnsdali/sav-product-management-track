@extends('layouts.app')


@section('content')
    {{-- @include('layouts.dashboard_sidebar'); --}}
    {{-- <section id="crud">

    <h2 class="fst-title">Gestionnaire de <b>Reclamations</b></h2>
    <div class="container-lg">
        <div class="margined scrollable">
            @foreach ($reclamations as $reclamation)
                <div class="reclamation-card">
                    <div class="reclamation-col-1">

                        <p class="rec-author"> <b>{{ $reclamation['client_pseudo'] }} </b> </p>
                        <small class="rec-num"> Reclamation n°<b class="rec_id">{{ $reclamation['id'] }}</b> </small>
                        <small class="rec-date"> <b class="pt">.</b> il ya <b class="time">{{ $reclamation['created_at'] }}</b> </small>
                        <small class="rec-num"> Tel:<b>+216 {{ $reclamation['num_tel1'] }} </b> <b>+216 {{ $reclamation['num_tel2'] }} </b></small>
                        <input type="hidden" class="created_at" value="{{ $reclamation['created_at'] }}"/>
                    </div>
                    <div class="reclamation-col-2">
                        <p><small><b>Type de panne:</b> {{ $reclamation['type_panne'] }} </small></p>
                        <p><small><b>Description de panne:</b> {{ $reclamation['description_panne'] }} </small></p>
                    </div>
                    <div class="reclamation-col-3">
                        <div class="rec3-content">
                            <a class="sort icon" title="Trier Techniciens" data-bs-toggle="tooltip" data-bs-placement="top">
                                <i    class='bx bx-trip'></i></a>
                            <a class="delete icon" title="Delete" data-bs-toggle="tooltip" ><i class='bx bx-trash-alt' ></i></a>



                        </div>
                        <div class="technicien">
                        </div>
                        <input type="hidden" class="coords" value="{{ $reclamation['google_maps_coordinates_produit'] }}" />

                    </div>

                </div>
            @endforeach


        </div>
    </div>
    <div class="hover-div"></div>
</section> --}}
    {{-- @if ($reclamation['etat'] == 0){
                                <button type="button" class="etat-red"> panne </button>
                            } @elseif ($reclamation['etat'] == 1){
                                <button type="button" class="etat-yellow"> suivi </button>
                            }@else{
                                <button type="button" class="etat-green"> réparé </button>
                            }
                            @endif --}}

    @if (session('success'))
    <div id="successAlert" class="alert alert-icon alert-success alert-admissible fade show" role="alert">
        <i class="fe fe-check mr-2" aria-hidden="true"></i> {{ session('success') }}
    </div>
@endif
    <div class="section-body reclamations-section">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="list" role="tabpanel">
                    <div class="table-responsive" id="users">
                        <table class="table table-hover reclamations-data-table table-vcenter text-nowrap table_custom list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th >Status</th>
                                    <th >Reclamation N°</th>
                                    <th>Client</th>
                                    <th>Technicien</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reclamations as $reclamation)
                                    <tr class="curr-rec">
                                        <td class="width35">
                                            <a href="javascript:void(0);" class="mail-star"><i class="fa fa-star"></i></a>
                                        </td>
                                        <td>

                                            <div>Reclamation n°<b class="rec_id">{{ $reclamation['id'] }}</b>
                                                <span class="rec-date d-flex align-items-center"><i class="fe fe-watch mr-2"></i>  il ya <b class="rec-time ml-2">{{ $reclamation['created_at'] }}</b> </span>
                                                <input type="hidden" class="created_at" value="{{ $reclamation['created_at'] }}"/>
                                            </div>
                                        </td>

                                        <td class="hidden-sm">
                                            <div><a href="javascript:void(0);">{{ $reclamation['client_pseudo'] }}</a></div>
                                            <div class="text-muted">+216 {{ $reclamation['num_tel1'] }}</div>
                                            <div class="text-muted">+216
                                                {{ $reclamation['num_tel2'] != null ? $reclamation['num_tel2'] : 'xxxxxxxx' }}
                                            </div>
                                        </td>
                                        @if($reclamation->technicien != null)
                                        <td class="hidden-sm">
                                            <div><a href="javascript:void(0);">{{ $reclamation->technicien->name }}</a></div>
                                            <div class="text-muted">+216 {{ $reclamation->technicien->num_tel1 }}</div>
                                            <div class="text-muted">+216
                                                {{  $reclamation->technicien->num_tel2 != null ?  $reclamation->technicien->num_tel2 : 'xxxxxxxx' }}
                                            </div>
                                        </td>
                                        @else
                                        <td> <span  class="bg-red bg-gradient text-light">Non assigné</span></td>
                                        @endif
                                        {{-- <td class="technicien-select">
                                            <div class="form-group multiselect_div">
                                                <label for="technicien">Technicien à s'intervenir: </label>
                                                <select name="techniciens[]"
                                                    class="multiselect multiselect-custom techniciens-list">
                                                    <option value="aucun" autofocus>aucun n'est choisi</option>
                                                     @foreach ($techniciens as $technicien)
                                                        <option value="{{$technicien->email}}"> {{$technicien->name}}</option>
                                                     @endforeach
                                                </select>
                                            </div>
                                       </td> --}}
                                        <td>
                                            <div class="row">
                                                {{-- <a class="btn btn-sm btn-link sort-techs" data-toggle="tooltip"
                                                    title="Trier par distance les techniciens"><i
                                                        class="fe fe-sliders"></i></a> --}}
                                                <a href="{{route('reclamations.show', $reclamation->id)}}" class="btn btn-sm"  data-toggle="tooltip" title="En-savoir plus"><i
                                                        class="fe fe-eye"></i></a>
                                                {{-- <a class="btn btn-sm btn-link valider-choix" data-toggle="tooltip"
                                                        title="Valider le choix de technicien">
                                                        <i class="fe fe-target"></i></a> --}}
                                            </div>

                                        </td>
                                        <input type="hidden" class="lat" value="{{ $reclamation['lat'] }}" />
                                        <input type="hidden" class="lng" value="{{ $reclamation['lng'] }}" />
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="tab-pane fade" id="grid" role="tabpanel">
                    <div class="row row-deck">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card " >
                                <div class="card-body">
                                    <div class="card-status bg-blue"></div>
                                    <div class="mb-3"> <img src="../assets/images/sm/avatar1.jpg" class="rounded-circle w100" alt=""> </div>
                                    <div class="mb-2">
                                        <h5 class="mb-0">Paul Schmidt</h5>
                                        <p class="text-muted">Aalizeethomas@info.com</p>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt</span>
                                    </div>
                                    <span class="font-12 text-muted">Common Contact</span>
                                    <ul class="list-unstyled team-info margin-0 pt-2">
                                        <li><img src="../assets/images/xs/avatar1.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar8.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar2.jpg" alt="Avatar"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="mb-3"> <img src="../assets/images/sm/avatar2.jpg" class="rounded-circle w100" alt=""> </div>
                                    <div class="mb-2">
                                        <h5 class="mb-0">Andrew Patrick</h5>
                                        <p>Aalizeethomas@info.com</p>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt</span>
                                    </div>
                                    <span class="font-12 text-muted">Common Contact</span>
                                    <ul class="list-unstyled team-info margin-0 pt-2">
                                        <li><img src="../assets/images/xs/avatar1.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar2.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar3.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar4.jpg" alt="Avatar"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="mb-3"> <img src="../assets/images/sm/avatar3.jpg" class="rounded-circle w100" alt=""> </div>
                                    <div class="mb-2">
                                        <h5 class="mb-0">Mary Schneider</h5>
                                        <p>Aalizeethomas@info.com</p>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt</span>
                                    </div>
                                    <span class="font-12 text-muted">Common Contact</span>
                                    <ul class="list-unstyled team-info margin-0 pt-2">
                                        <li><img src="../assets/images/xs/avatar1.jpg" alt="Avatar"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card " >
                                <div class="card-body">
                                    <div class="card-status bg-green"></div>
                                    <div class="mb-3"> <img src="../assets/images/sm/avatar4.jpg" class="rounded-circle w100" alt=""> </div>
                                    <div class="mb-2">
                                        <h5 class="mb-0">Sean Black</h5>
                                        <p>Aalizeethomas@info.com</p>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt</span>
                                    </div>
                                    <span class="font-12 text-muted">Common Contact</span>
                                    <ul class="list-unstyled team-info margin-0 pt-2">
                                        <li><img src="../assets/images/xs/avatar2.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar6.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar5.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar7.jpg" alt="Avatar"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="mb-3"> <img src="../assets/images/sm/avatar5.jpg" class="rounded-circle w100" alt=""> </div>
                                    <div class="mb-2">
                                        <h5 class="mb-0">David Wallace</h5>
                                        <p>Aalizeethomas@info.com</p>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt</span>
                                    </div>
                                    <span class="font-12 text-muted">Common Contact</span>
                                    <ul class="list-unstyled team-info margin-0 pt-2">
                                        <li><img src="../assets/images/xs/avatar3.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar4.jpg" alt="Avatar"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="card-status bg-pink"></div>
                                    <div class="mb-3"> <img src="../assets/images/sm/avatar6.jpg" class="rounded-circle w100" alt=""> </div>
                                    <div class="mb-2">
                                        <h5 class="mb-0">Andrew Patrick</h5>
                                        <p>Aalizeethomas@info.com</p>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt</span>
                                    </div>
                                    <span class="font-12 text-muted">Common Contact</span>
                                    <ul class="list-unstyled team-info margin-0 pt-2">
                                        <li><img src="../assets/images/xs/avatar5.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar6.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar1.jpg" alt="Avatar"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="mb-3"> <img src="../assets/images/sm/avatar2.jpg" class="rounded-circle w100" alt=""> </div>
                                    <div class="mb-2">
                                        <h5 class="mb-0">Michelle Green</h5>
                                        <p>Aalizeethomas@info.com</p>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt</span>
                                    </div>
                                    <span class="font-12 text-muted">Common Contact</span>
                                    <ul class="list-unstyled team-info margin-0 pt-2">
                                        <li><img src="../assets/images/xs/avatar8.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar7.jpg" alt="Avatar"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="mb-3"> <img src="../assets/images/sm/avatar4.jpg" class="rounded-circle w100" alt=""> </div>
                                    <div class="mb-2">
                                        <h5 class="mb-0">Mary Schneider</h5>
                                        <p>Aalizeethomas@info.com</p>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt</span>
                                    </div>
                                    <span class="font-12 text-muted">Common Contact</span>
                                    <ul class="list-unstyled team-info margin-0 pt-2">
                                        <li><img src="../assets/images/xs/avatar2.jpg" alt="Avatar"></li>
                                        <li><img src="../assets/images/xs/avatar7.jpg" alt="Avatar"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="tab-pane fade" id="addnew" role="tabpanel">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Enter Number">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <textarea type="text" class="form-control" rows="4">Enter your Address</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="file" class="dropify">
                        </div>
                        <div class="col-lg-12 mt-3">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <button type="submit" class="btn btn-default">Cancel</button>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="hover-div"></div>

@endsection
