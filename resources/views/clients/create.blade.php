@extends('layouts.app')

@section('imports')

@vite(['resources/js/client_create_script.js'])
@endsection

@section('sidebar')
    @include('layouts.dashboard_sidebar');
@endsection

@section('content')

<div class="fullscreen-image reclamation_img_wrapper">
    <img src="{{ Vite::asset('resources/img/light wallpaper.jpg') }}" alt="Full-screen Image" />
</div>



<div class="container form-reclamation">

    <h1>Formulaire de d'achat d'un produit</h1>

    <form action="{{route('clients.store')}}" method="post" enctype="multipart/form-data">
        @csrf


      {{-- scan qr --}}
        <div id="qr_status">

        </div>
        <div class="QR_div">
            <div id="reader"></div>
            <div id="result">
                <input type="hidden" id="serie_number" name="serie_number">
            </div>
        </div>

    <div class="input-block mx-auto disabled-input">
        <input class="input-box arr" type="text"  spellcheck="false"
             value="{{$revendeur["prenom"]}} {{$revendeur["nom"]}}" disabled />
        <input type="hidden" value="{{$revendeur['id']}}" name="rev_id">
        <span class="placeholder">Revendeur</span>
    </div>

    <br>
    <h4>Remplir les crédentiels de client</h4>
      <div class="input-block mx-auto">
        <input class="input-box arr" type="text"  name="nom" spellcheck="false"
          required />
        <span class="placeholder">nom</span>
      </div>
      <div class="input-block mx-auto">
        <input class="input-box arr" type="text"  name="prenom" spellcheck="false"
          required />
        <span class="placeholder">prenom</span>
      </div>
      <div class="input-block mx-auto">
        <input class="input-box arr" type="text"  name="num_telephone1" spellcheck="false"
          required />
        <span class="placeholder">nom telephone1</span>
      </div>
      <div class="input-block mx-auto">
        <input class="input-box arr" type="text" name="num_telephone2"   />
        <span class="placeholder">nom telephone2</span>
      </div>

      <select name="ref_prod" id="rev-opt">
        @foreach ($produits as $produit)
            <option value="{{$produit['reference']}}">{{$produit['label']}}</option>
        @endforeach
    </select>

    <button type="submit" class="btn_ submit_btn">
        Confirmer l'achat <i class="far fa-bookmark"></i>
    </button>

    </form>
  </div>




{{-- qr scanner + jquery + coords --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



@endsection
