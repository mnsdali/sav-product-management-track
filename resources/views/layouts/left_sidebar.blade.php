<div id="header_top" class="header_top">
    <div class="container">
        <div class="hleft">
            <div class="dropdown">
                <a href="javascript:void(0)" class="nav-link user_btn"><img class="avatar"
                        src="{{ asset('assets/images/user.png') }}" alt="" /></a>
                <a href="page-search.html" class="nav-link icon"><i class="fa fa-search"></i></a>
                <a href="index.html" class="nav-link icon"><i class="fa fa-home"></i></a>
                <a href="app-email.html" class="nav-link icon app_inbox"><i class="fa fa-envelope"></i></a>
                <a href="app-chat.html" class="nav-link icon xs-hide"><i class="fa fa-comments"></i></a>
                <a href="app-filemanager.html" class="nav-link icon app_file xs-hide"><i
                        class="fa fa-folder"></i></a>
            </div>
        </div>
        <div class="hright">
            <div class="dropdown">
                <a href="javascript:void(0)" id="notification-btn" class="nav-link icon settingbar"><i class="fa fa-bell"></i></a>
                <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa fa-navicon"></i></a>
            </div>
        </div>
    </div>
</div>

<div id="left-sidebar" class="sidebar">
    <div class="d-flex justify-content-between brand_name">
        <h5 class="brand-name">Crush it</h5>
        <div class="theme_btn">
            <a class="theme1" data-toggle="tooltip" title="Theme Radical" href="#" onclick="setStyleSheet('../assets/css/theme1.css', 0);"></a>
            <a class="theme2" data-toggle="tooltip" title="Theme Turmeric" href="#" onclick="setStyleSheet('../assets/css/theme2.css', 0);"></a>
            <a class="theme3" data-toggle="tooltip" title="Theme Caribbean" href="#" onclick="setStyleSheet('../assets/css/theme3.css', 0);"></a>
            <a class="theme4" data-toggle="tooltip" title="Theme Cascade" href="#" onclick="setStyleSheet('../assets/css/theme4.css', 0);"></a>
        </div>
    </div>
    <div class="input-icon">
        <span class="input-icon-addon">
            <i class="fe fe-search"></i>
        </span>
        <input type="text" class="form-control" placeholder="Search...">
    </div>
    <ul class="nav nav-tabs b-none">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all-tab"><i class="fa fa-list-ul"></i> All</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#app-tab">Elements</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting-tab">Settings</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="all-tab">
            <nav class="sidebar-nav" id="left-sidebar-dashboard-links">
                <ul class="metismenu ci-effect-1">
                    {{-- Admin:
                         * Panier
                         * Produit (Ref, Nom, Description, Prix )
                         * Variation :
                            Créer Variation (Designation, Quantité)
                            Créer Pieces (Ref, Designation, Photo)
                         * Reclamation

                         Client:
                         * Reclamation (Envoyer)
                         * Voir Intervetions

                         Revendeur:
                         * Ventes
                         * Achats
                         * Client

                         Technicien:
                         * Reclamations
                         * Interventions
                         * Stock Pieces

                         --}}
                    @hasrole('admin')
                    <li class="g_heading">Services Admin</li>
                     {{--<a href="{{route('produits.create')}}" class="has-arrow arrow-b"><i class="fe fe-hard-drive"></i><span data-hover="Produits">Produits</span></a>
                    <li class="active">
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="fe fe-hard-drive"></i><span data-hover="Produits">Produits</span></a>
                        <ul>
                            <li class="active"><a href="{{route('produits.create')}}"><span data-hover="Créer Produits">Créer Produits</span></a></li>
                            <li class="active"><a href="{{route('produits.modify')}}"><span data-hover="Modifier Produits">Modifier Produits</span></a></li>
                            <li><a href="{{route('pieces.create')}}"><span data-hover="Créer Piéces">Créer Piéces</span></a></li>
                        </ul>
                    </li> --}}

                    <li id="left-sidebar-menu-panier"><a  href="{{route('produits.index')}}"><i class="fe fe-home"></i><span data-hover="Panier">Panier</span></a></li>
                    <li  id="left-sidebar-menu-commandes">
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="fe fe-package"></i><span data-hover="Commandes">Commandes</span></a>
                        <ul>
                            <li  id="left-sidebar-menu-commandes-revendeurs"><a href="{{route('printers.revendeurs_commandes')}}"><span data-hover="Revendeurs">Revendeurs</span></a></li>
                            <li id="left-sidebar-menu-commandes-clients"><a href="#"><span data-hover="Clients">Clients</span></a></li>
                        </ul>
                    </li>
                    <li  id="left-sidebar-menu-produits">
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="fe fe-hard-drive"></i><span data-hover="Produits">Produits</span></a>
                        <ul>
                            <li id="left-sidebar-menu-produits-liste"><a href="{{route('produits.list')}}"><span data-hover="Liste">Liste</span></a></li>
                            <li  id="left-sidebar-menu-produit-create"><a href="{{route('produits.create')}}"><span data-hover="Créer">Créer</span></a></li>
                        </ul>
                    </li>

                    <li  id="left-sidebar-menu-variations">
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-layers"></i><span data-hover="Séries">Séries</span></a>
                        <ul>
                            <li  id="left-sidebar-menu-variations-create"><a href="{{route('variations.create')}}"><span data-hover="Créer">Créer</span></a></li>
                            <li id="left-sidebar-menu-variations-liste"><a href="{{route('edit-serie')}}"><span data-hover="Modifier">Modifier</span></a></li>
                        </ul>
                    </li>
                    <li  id="left-sidebar-menu-pieces">
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="fe fe-cpu"></i><span data-hover="Piéces">Piéces</span></a>
                        <ul>
                            <li id="left-sidebar-menu-pieces-liste"><a href="{{route('pieces.index')}}"><span data-hover="Liste">Liste</span></a></li>
                            <li  id="left-sidebar-menu-pieces-create"><a href="{{route('pieces.create')}}"><span data-hover="Créer">Créer</span></a></li>
                        </ul>
                    </li>

                    <li  id="left-sidebar-menu-pieces">
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="fe fe-book-open"></i><span data-hover="Types Pannes">Types Pannes</span></a>
                        <ul>
                            <li id="left-sidebar-menu-pieces-liste"><a href="{{route('type_panne.index')}}"><span data-hover="Liste">Liste</span></a></li>
                            <li  id="left-sidebar-menu-pieces-create"><a href="{{route('type_panne.create')}}"><span data-hover="Créer">Créer</span></a></li>
                        </ul>
                    </li>

                    {{-- <li><a href="{{route('printers.qrcodes')}}" id="left-sidebar-menu-qrcodes"><i class="icon-grid"></i><span data-hover="QrCodes">QrCodes</span></a></li> --}}

                    <li><a href="{{ route('reclamations.index')}}" id="left-sidebar-menu-reclamations"><i class="fe fe-file-text"></i><span data-hover="Reclamations">Reclamations</span></a></li>

                    <li><a href="{{route('revendeurs.index')}}"><i class="icon-eyeglasses"></i><span data-hover="Revendeurs">Revendeurs</span></a></li>
                    <li><a href="app-chat.html"><i class="fa fa-user-secret"></i><span data-hover="Techniciens">Techniciens</span></a></li>
                    <li><a href="app-contact.html"><i class="icon-notebook"></i><span data-hover="Contact">Contact</span></a></li>
                    <li><a href="app-blog.html"><i class="icon-globe"></i><span data-hover="Blog">Blog</span></a></li>
                    <li><a href="app-filemanager.html"><i class="icon-folder-alt"></i><span data-hover="FileManager">File Manager</span></a></li>
                    <li><a href="page-gallery.html"><i class="icon-picture"></i><span data-hover="Gallery">Gallery</span></a></li>
                    @elserole('revendeur')
                    <li class="g_heading">Services Revendeur</li>
                    <li><a href="{{route('panneau.qr_vente')}}"><i class="fa fa-qrcode"></i><span data-hover="Scanner QR">Nouvelle vente</span></a></li>
                    <li id="left-sidebar-menu-panier"><a  href="{{route('commandes_cl.liste')}}"><i class="icon-grid"></i><span data-hover="Liste">Commandes</span></a></li>
                    <li id="left-sidebar-menu-panier"><a  href="{{route('revendeur.liste-articles')}}"><i class="icon-list"></i><span data-hover="Liste">Articles</span></a></li>
                    @elserole('technicien')
                    <li class="g_heading">Services Technicien</li>
                    @else
                    <li class="g_heading">Services Client</li>
                    @endhasrole

                    {{-- <li class="g_heading">Utilities</li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-tag"></i><span data-hover="Icons">Icons</span></a>
                        <ul>
                            <li><a href="icons-feather.html"><span data-hover="Feather">Feather Icons</span></a></li>
                            <li><a href="icons-line.html"><span data-hover="Line">Line Icons</span></a></li>
                            <li><a href="icons-fontawesome.html"><span data-hover="FontAwesome">FontAwesome</span></a></li>
                            <li><a href="icons-flags.html"><span data-hover="Flags">Flags Icons</span></a></li>
                            <li><a href="icons-payments.html"><span data-hover="Payments">Payments Icons</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-bar-chart"></i><span data-hover="Charts">Charts</span></a>
                        <ul>
                            <li><a href="charts-apex.html"><span data-hover="ChartsApex">Charts Apex</span></a></li>
                            <li><a href="charts-e.html"><span data-hover="EChart">EChart</span></a></li>
                            <li><a href="charts-c3.html"><span data-hover="C3Chart">C3 Chart</span></a></li>
                            <li><a href="charts-knob.html"><span data-hover="JQueryKnob">JQuery Knob</span></a></li>
                            <li><a href="charts-sparkline.html"><span data-hover="SparklineChart">Sparkline Chart</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-layers"></i><span data-hover="Forms">Forms</span></a>
                        <ul>
                            <li><a href="form-elements.html"><span data-hover="BasicElements">Basic Elements</span></a></li>
                            <li><a href="form-advanced.html"><span data-hover="AdvancedElements">Advanced Elements</span></a></li>
                            <li><a href="form-validation.html"><span data-hover="FormValidation">Form Validation</span></a></li>
                            <li><a href="form-wizard.html"><span data-hover="FormWizard">Form Wizard</span></a></li>
                            <li><a href="form-summernote.html"><span data-hover="Summernote">Summernote</span></a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-tag"></i><span data-hover="Tables">Tables</span></a>
                        <ul>
                            <li><a href="table-normal.html"><span data-hover="Bootstrap">Bootstrap Table</span></a></li>
                            <li><a href="table-datatable.html"><span data-hover="Datatable">Jquery Datatable</span></a></li>
                        </ul>
                    </li>
                    <li><a href="widgets.html"><i class="icon-puzzle"></i><span data-hover="Widgets">Widgets</span></a></li>
                    <li class="g_heading">Extra Pages</li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-lock"></i><span data-hover="Authentication">Authentication</span></a>
                        <ul>
                            <li><a href="login.html"><span data-hover="Login">Login</span></a></li>
                            <li><a href="register.html"><span data-hover="Register">Register</span></a></li>
                            <li><a href="forgot-password.html"><span data-hover="Forgot">Forgot password</span></a></li>
                            <li><a href="404.html"><span data-hover="404">404 error</span></a></li>
                            <li><a href="500.html"><span data-hover="500">500 error</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="fe fe-file"></i><span data-hover="Pages">Pages</span></a>
                        <ul>
                            <li><a href="page-empty.html"><span data-hover="Emptypage">Empty page</span></a></li>
                            <li><a href="page-profile.html"><span data-hover="Profile">Profile</span></a></li>
                            <li><a href="page-search.html"><span data-hover="SearchResults">Search Results</span></a></li>
                            <li><a href="page-timeline.html"><span data-hover="Timeline">Timeline</span></a></li>
                            <li><a href="page-invoices.html"><span data-hover="Invoices">Invoices</span></a></li>
                            <li><a href="page-pricing.html"><span data-hover="Pricing">Pricing</span></a></li>
                            <li><a href="page-carousel.html"><span data-hover="Carousel">Carousel</span></a></li>
                        </ul>
                    </li>
                    <li><a href="page-maps.html"><i class="icon-map"></i><span data-hover="Maps">Maps</span></a></li> --}}
                </ul>
            </nav>
        </div>
        <div class="tab-pane fade" id="app-tab">
            <nav class="sidebar-nav">
                <ul class="metismenu">
                    <li class="g_heading">Components</li>
                    <li><a href="components/typography.html"><i class="fe fe-type"></i><span>Typography</span></a></li>
                    <li><a href="components/colors.html"><i class="fe fe-feather"></i><span>Colors</span></a></li>
                    <li><a href="components/alerts.html"><i class="fe fe-alert-triangle"></i><span>Alerts</span></a></li>
                    <li><a href="components/avatars.html"><i class="fe fe-user"></i><span>Avatars</span></a></li>
                    <li><a href="components/buttons.html"><i class="fe fe-toggle-right"></i><span>Buttons</span></a></li>
                    <li><a href="components/breadcrumb.html"><i class="fe fe-link-2"></i><span>Breadcrumb</span></a></li>
                    <li><a href="components/forms.html"><i class="fe fe-layers"></i><span>Input group</span></a></li>
                    <li><a href="components/list-group.html"><i class="fe fe-list"></i><span>List group</span></a></li>
                    <li><a href="components/modal.html"><i class="fe fe-square"></i><span>Modal</span></a></li>
                    <li><a href="components/pagination.html"><i class="fe fe-file-text"></i><span>Pagination</span></a></li>
                    <li><a href="components/cards.html"><i class="fe fe-image"></i><span>Cards</span></a></li>
                    <li><a href="components/charts.html"><i class="fe fe-pie-chart"></i><span>Charts</span></a></li>
                    <li><a href="components/form-components.html"><i class="fe fe-check-square"></i><span>Form</span></a></li>
                    <li><a href="components/tags.html"><i class="fe fe-tag"></i><span>Tags</span></a></li>
                    <li><a href="javascript:void(0)"><i class="fe fe-help-circle"></i><span>Documentation</span></a></li>
                    <li><a href="javascript:void(0)"><i class="fe fe-life-buoy"></i><span>Changelog</span></a></li>
                </ul>
            </nav>
        </div>
        <div class="tab-pane fade" id="setting-tab">
            <div class="mb-4 mt-3">
                <h6 class="font-14 font-weight-bold text-muted">Font Style</h6>
                <div class="custom-controls-stacked font_setting">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="font" value="font-opensans" checked="">
                        <span class="custom-control-label">Open Sans Font</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="font" value="font-montserrat">
                        <span class="custom-control-label">Montserrat Google Font</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="font" value="font-poppins">
                        <span class="custom-control-label">Poppins Google Font</span>
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <h6 class="font-14 font-weight-bold text-muted">Dropdown Menu Icon</h6>
                <div class="custom-controls-stacked arrow_option">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="marrow" value="arrow-a" checked="">
                        <span class="custom-control-label">A</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="marrow" value="arrow-b">
                        <span class="custom-control-label">B</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="marrow" value="arrow-c">
                        <span class="custom-control-label">C</span>
                    </label>
                </div>
                <h6 class="font-14 font-weight-bold mt-4 text-muted">SubMenu List Icon</h6>
                <div class="custom-controls-stacked list_option">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="listicon" value="list-a" checked="">
                        <span class="custom-control-label">A</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="listicon" value="list-b">
                        <span class="custom-control-label">B</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="listicon" value="list-c">
                        <span class="custom-control-label">C</span>
                    </label>
                </div>
            </div>
            <div>
                <h6 class="font-14 font-weight-bold mt-4 text-muted">General Settings</h6>
                <ul class="setting-list list-unstyled mt-1 setting_switch">
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Night Mode</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-darkmode">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Fix Navbar top</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-fixnavbar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Header Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-pageheader">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Min Sidebar Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-min_sidebar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Sidebar Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-sidebar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Icon Color</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-iconcolor">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Gradient Color</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-gradient">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Box Shadow</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxshadow">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">RTL Support</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-rtl">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Box Layout</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxlayout">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
