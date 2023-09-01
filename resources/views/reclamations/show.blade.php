{{--
    'description_machine',
                    'google_maps_coordinates_produit', 'type_panne', 'description_panne',
                    'etat', 'kilometrage', 'cl_prenom_nom', 'tech_prenom_nom', 'created_at',
                    'num_serie', 'photo_num_serie',

                    $basic  = new \Vonage\Client\Credentials\Basic("2e674e68", "TITzKXJN8cnrSTYn");
                    $client = new \Vonage\Client($basic);
    --}}
@extends('layouts.app')


@section('content')

    <form action="{{route('reclamations.update', $reclamation->id)}}" method="POST">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <iframe id="maps-iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                src="https://maps.google.com/maps?q={{$reclamation->lat}},{{$reclamation->lng}}&hl=ar&z=14&amp;output=embed">
                {{-- src="https://maps.google.com/maps?q=34.7759724,10.6998073&hl=ar&z=14&amp;output=embed"> --}}
            </iframe>
            <div class="card-body">
                <h5 class="card-title">Reclamation N°{{$reclamation->id}} - Type de Panne: {{$reclamation->type_panne}}</h5>
                <p class="card-text">{{$reclamation->description_panne}}</p>
                <div class="row">
                    <div class="col-3">
                        <h6><strong>{{$reclamation->serie_number}}</strong></h6>
                        <span>S/N</span>
                    </div>
                    <div class="col-3">
                        <h6><strong>{{$reclamation->article->var_designation}}</strong></h6>
                        <span>Série</span>
                    </div>
                    <div class="col-3">
                        <h6><strong>{{$reclamation->article->variation->prod_ref}}</strong></h6>
                        <span>Ref.Prod.</span>
                    </div>
                    <div class="col-3">
                        <h6><strong class="rec-time">{{$reclamation->updated_at}}</strong></h6>
                        <span>Il y a</span>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{$client->pseudo}}</li>
                <li class="list-group-item">{{$client->prenom. ' '. $client->nom}}</li>
                <li class="list-group-item">+216 {{$client->num_tel1}}</li>
                <li class="list-group-item">+216 {{$client->num_tel2}}</li>
                <li class="list-group-item">
                    @if($reclamation->tech_email)
                       Tech: {{$reclamation->technicien->name}}
                    @else
                    <div class="form-group multiselect_div">
                        <label for="technicien">Technicien à s'intervenir: </label>
                        <select name="technicien"
                            class="multiselect multiselect-custom techniciens-list" required>
                            {{-- <option value="aucun" autofocus>aucun n'est choisi</option> --}}
                             @foreach ($techniciens as $technicien)
                                <option value="{{$technicien->email}}"> {{$technicien->name}}</option>
                             @endforeach
                        </select>
                    </div>
                    @endif
                </li>
            </ul>
            <div class="card-body">
                <a href="https://maps.google.com/maps?q={{$reclamation->lat}},{{$reclamation->lng}}"
                         target="_blank" class="btn btn-primary" title="Voir une plus grande version de la map" data-toggle="tooltip" data-placement="bottom">
                        <i class="icon-map"></i> Maps
                </a>
                <button type="submit" class="card-link btn btn-primary"><i class="icon-note mr-2"></i> Validez</button>
            </div>
        </div>
    </div>
    </form>

@endsection
