@extends('layouts.app')

@section('imports')

@vite([
    'resources/css/style3.css'
        ])
@endsection


@section('content')

        <!-- ==== NAVBAR ==== -->
        <nav class="nav">
          <div class="logo">
            <h2>TUN-SAV.</h2>
          </div>

          <div class="nav_menu" id="nav_menu">
            <button class="close_btn" id="close_btn">
              <i class="ri-close-fill"></i>
            </button>

            <ul class="nav_menu_list">
              <li class="nav_menu_item">
                <a href="#" class="nav_menu_link">acceuil</a>
              </li>
              <li class="nav_menu_item">
                <a href="#" class="nav_menu_link">à-propos</a>
              </li>
              <li class="nav_menu_item">
                <a href="#" class="nav_menu_link">service</a>
              </li>
              <li class="nav_menu_item">
                <a href="#" class="nav_menu_link">contact</a>
              </li>
              <li class="nav_menu_item">
               <a href="#"> <button class="nav-btn">login</button></a>
              </li>
              <li class="nav_menu_item">
                <a href="#"><button class="nav-btn">sign-up</button></a>
              </li>
            </ul>
          </div>

          <button class="toggle_btn" id="toggle_btn">
            <i class="ri-menu-line"></i>
          </button>
        </nav>
      </header>
    <!-- ==== MAIN ==== -->
    <div class="fullscreen-image">
        <img src="img/sav_intervention.png" alt="Full-screen Image" />
    </div>

    <div class="container form-reclamation">
        <h1>Enquête d'intervention</h1>
        <form action="{{route('intervention.store')}}" method="post">
            @csrf

            <div class="nomInp">
                <div class="input-block " id="nom">
                <input class="input-box arr" type="text" id="nom_cl" name="nom_cl" spellcheck="false"
                    required />
                <span class="placeholder">Nom de Client</span>
                </div>
                <div class="input-block" id="prenom">
                    <input class="input-box arr" type="text" id="prenom_cl" name="prenom_cl" spellcheck="false"
                    required />
                    <span class="placeholder">Prénom de Client</span>
                </div>

            </div>


          <div class="input-block mx-auto">
            <input class="input-box arr" type="text" id="type_panne" name="type_panne" spellcheck="false"
              required />
            <span class="placeholder">Type de panne</span>
          </div>
          <div class="input-block mx-auto">
            <input class="input-box arr" type="text" id="cause_panne" name="cause_panne" spellcheck="false"
              required />
            <span class="placeholder">Cause de panne</span>
          </div>


          <div id="wrapper">
            <label for="piece_nature">Choix entre piéce vendu ou changé?</label>
          <p>
          <input type="radio" name="piece_choix" checked>Change</input>
          </p>
          <p>
          <input type="radio" name="piece_choix">Vendu</input>
          </p>
          </div>


        <div class="opsList">
            @foreach ($ops as $op )

                 <input type="checkbox" namme="ops[]" id={{$op->id}}/> {{$op->label}} <br />
            @endforeach

        </div>


        <button type="submit" class="btn_ submit_btn">
            Envoyer

            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/>
              </svg>
        </button>

        </form>
      </div>




@endsection
