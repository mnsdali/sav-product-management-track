<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="Crush it Able The most popular Admin Dashboard template and ui kit">
    <meta name="author" content="PuffinTheme the theme designer">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <title>SAV</title>

    <!-- Bootstrap Core and vandor -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" />

    <!-- Datatables Core and vandor -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/charts-c3/c3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jvectormap-2.0.3.css') }}" />

    {{-- form advanced --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/multi-select/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/parsleyjs/css/parsley.css') }}">

    <!-- Core css -->

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/theme4.css') }}" id="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />


    <script>
        var baseUrl = "{{ url('/') }}";
    </script>

</head>

<body class="font-opensans">


    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
        </div>
    </div>

    <!-- Start main html -->
    <div id="main_content">

        @include('layouts.left_sidebar')


        <div class="page">
            <!-- Small icon top menu -->
            @include('layouts.header')

            <!-- Notification and  Activity-->



            <div class="section-body mt-3">
                @yield('content')
            </div>


            @include('layouts.footer')

        </div>
        @include('layouts.notifications')
        <div class="user_div">
            <h5 class="brand-name mb-4">User Crush<a href="javascript:void(0)" class="user_btn"><i
                        class="icon-close"></i></a></h5>
            <div class="card">
                <img class="card-img-top" src="{{ asset('assets/images/gallery/6.jpg') }}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Daniel Kristeen</h5>
                    <p class="card-text">795 Folsom Ave, Suite 600 San Francisco, 94107</p>
                    <div class="row">
                        <div class="col-4">
                            <h6><strong>3265</strong></h6>
                            <small>Post</small>
                        </div>
                        <div class="col-4">
                            <h6><strong>1358</strong></h6>
                            <small>Followers</small>
                        </div>
                        <div class="col-4">
                            <h6><strong>10K</strong></h6>
                            <small>Likes</small>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">michael@example.com</li>
                    <li class="list-group-item">+ 202-555-2828</li>
                    <li class="list-group-item">October 22th, 1990</li>
                </ul>
                <div class="card-body">
                    <a href="javascript:void(0);" class="card-link">View More</a>
                    <a href="javascript:void(0);" class="card-link">Another link</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="d-block">Total Income<span class="float-right">77%</span></label>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="77"
                                aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block">Total Expenses <span class="float-right">50%</span></label>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label class="d-block">Gross Profit <span class="float-right">23%</span></label>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="23"
                                aria-valuemin="0" aria-valuemax="100" style="width: 23%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="d-block">Storage <span class="float-right">77%</span></label>
                <div class="progress progress-sm">
                    <div class="progress-bar" role="progressbar" aria-valuenow="77" aria-valuemin="0"
                        aria-valuemax="100" style="width: 77%;"></div>
                </div>
                <button type="button" class="btn btn-primary btn-block mt-3">Upgrade Storage</button>
            </div>
        </div>
        <!-- start main body part-->



        <!-- jQuery and bootstrtap js -->
        <script src="{{ asset('assets/bundles/lib.vendor.bundle.js') }}"></script>

        <!-- start plugin js file  -->
        <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/counterup.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/knobjs.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/c3.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/flot.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/jvectormap1.bundle.js') }}"></script>

        <!-- Datatables start plugin js file  -->
        <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>

        {{--  Form advanced --}}
        {{-- <script src="{{ asset('assets/plugins/sweetalert/sweetalert-dev.js') }}"></script> --}}
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
        <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>
        <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/plugins/jspdf/jspdf.min.js') }}"></script> --}}
        <script src="{{ asset('assets/plugins/html2pdf/html2pdf.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/parsleyjs/js/parsley.js') }} "></script>
        <script src="{{ asset('assets/plugins/html5-qrcode/html5-qrcode.min.js') }} "></script>
        <script src="{{ asset('assets/plugins/jquery-easyPaginate/jquery-easyPaginate.js') }} "></script>

        <!-- Form advance init js -->

        <!-- Start core js and page js -->

        <script src="{{ asset('assets/js/core.js') }}"></script>
        <script src="{{ asset('assets/js/page/index.js') }}"></script>
        <script src="{{ asset('assets/js/form/form-advanced.js') }}"></script>
        <script src="{{ asset('assets/js/table/datatable.js') }}"></script>


        {{-- custom js --}}
        <script src="{{ asset('assets/js/custom-js/app.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/produits.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/produits2.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/variations.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/pieces.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/piece.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/panier.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/qrs.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/geolocation.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/qr-interface.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/reclamation.js') }}"></script>
        <script src="{{ asset('assets/js/custom-js/type_panne.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/custom-js/piece.js') }}"></script>  --}}
        <script>
            const Toast = swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', swal.stopTimer);
                    toast.addEventListener('mouseleave', swal.resumeTimer);
                }
            });
        </script>
        <script>
            function setStyleSheet(url) {
                var stylesheet = document.getElementById("stylesheet");
                stylesheet.setAttribute('href', url);
            }
        </script>
        <script type="text/javascript">
            setTimeout(function () {
                // Closing the alert
                $('.alert').alert('close');
            }, 3000);
        </script>



</body>

</html>
