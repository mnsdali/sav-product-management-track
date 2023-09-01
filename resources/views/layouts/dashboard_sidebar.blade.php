@vite(['resources/css/dashboard_sidebar.css'])

<div class="sidebar close">
    <div class="logo-details">
        <i> <x-bxl-c-plus-plus /> </i>
        <span class="logo_name">CodingLab</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="#">

               <i> <x-bx-grid-alt /> </i>
                <span class="link_name">Dashboard </span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Dashboard</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#">
                    <i> <x-bx-user-pin /> </i>
                    <span class="link_name">Client</span>
                </a>
                <i class="arrow"><x-bxs-chevron-down /></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="{{route('clients.index')}}">Client</a></li>
                <li><a href="{{route('clients.index')}}">Afficher clients</a></li>
                <li><a href="{{route('reclamations.index')}}">Afficher reclamations</a></li>
                <li><a href="">Nouvelle commande</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
                <a href="#"><i>
                    <x-bx-store-alt /> </i>
                    <span class="link_name">Revendeur</span>
                </a>
                <i class="arrow"><x-bxs-chevron-down /></i>

            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="{{route('revendeurs.index')}}">Revendeur</a></li>
                <li><a href="{{route('revendeurs.index')}}">Afficher revendeurs</a></li>
                <li><a href="{{route('revendeur-commandes.index')}}">Afficher ventes</a></li>
                <li><a href="{{route('revendeur-commandes.create')}}">Nouvelle commande</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i>
                <x-bx-cool /> </i>
                <span class="link_name">Techniciens</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Techniciens</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i>
                <x-bx-wrench /> </i>
                <span class="link_name">Interventions</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Interventions</a></li>
            </ul>
        </li>


        <li>
            <a href="#"><i>
                <x-bx-cog /> </i>
                <span class="link_name">Paramétres</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Paramétres</a></li>
            </ul>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="image/profile.jpg" alt="profileImg">
                </div>
                <div class="name-job">
                    <div class="profile_name">Prem Shahi</div>
                    <div class="job">Web Desginer</div>
                </div>
                <i class="arrow"> <x-bx-log-out /></i>
            </div>
        </li>
    </ul>
</div>
<section class="home-section">
    <div class="home-content">
        <x-bx-menu class="bx-menu" />
        <span class="text">Drop Down Sidebar</span>
    </div>
</section>
<script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
            let arrowParent = e.target.parentElement.parentElement.parentElement; //selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    // console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });
</script>
