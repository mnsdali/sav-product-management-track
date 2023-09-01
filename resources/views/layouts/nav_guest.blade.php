
{{--
<div class="nav-main">
<header class="container header">
    <!-- ==== NAVBAR ==== -->
    <nav class="nav">
      <div class="logo">
        <h2>TUN-SAV.</h2>
      </div>

      <div class="nav_menu" id="nav_menu">
        <button class="close_btn" id="close_btn">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </button>

        <ul class="nav_menu_list">
          <li class="nav_menu_item">
            <a href="#" class="nav_menu_link">ACCEUIL</a>
          </li>
          <li class="nav_menu_item">
            <a href="#" class="nav_menu_link">À-PROPOS</a>
          </li>
          <li class="nav_menu_item">
            <a href="#" class="nav_menu_link">ÈQUIPE</a>
          </li>
          <li class="nav_menu_item">
            <a href="#" class="nav_menu_link">GALLERIE</a>
          </li>
          <li class="nav_menu_item">
            <a href="#" class="nav_menu_link">CONTACT</a>
          </li>
          <li class="nav_menu_item">
           <a href="#"> <button class="nav-btn"><span>ALLONS-Y</span></button></a>
          </li>
        </ul>
      </div>

      <button class="toggle_btn" id="toggle_btn">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </button>
    </nav>
</header>
</div> --}}



<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 mt-3">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex md:flex md:flex-grow flex-row-reverse space-x-3 mt-2">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        Se connecter
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        S'inscrire
                    </x-nav-link>
                </div>
            </div>


        </div>
    </div>
</nav>
