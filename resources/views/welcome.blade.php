<!DOCTYPE html>
<html>

<head>
    <title>Welcome to SAV</title>
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" /> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"> --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css', 'resources/css/style2.css', 'resources/css/footer.css']) --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" />

    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/charts-c3/c3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jvectormap-2.0.3.css') }}" />

    <!-- Core css -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/theme4.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}" />

</head>

<body>

    @include('layouts.left_sidebar')
    @include('layouts.notifications')
    <div id="main_content">
        <div class="page">
            @if(session('success'))
            <div class="alert alert-icon alert-success text-center" role="alert">
                <i class="fe fe-alert-triangle mr-2"></i> {{ session('success') }}
            </div>
            @endif
            <div class="section-body mt-3">
                @include('pages.index')
            </div>
            <div id="reclamation-form" class="mt-3">
                @include('reclamations.create')
            </div>
            @include('layouts.footer')
        </div>
    </div>

    {{-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script> --}}
    {{-- @vite([ 'resources/js/uploadPhase.js']) --}}
    <!-- jQuery and bootstrtap js -->
    <script src="{{ asset('assets/bundles/lib.vendor.bundle.js') }} "></script>

    <!-- start plugin js file  -->
    <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }} "></script>
    <script src="{{ asset('assets/bundles/counterup.bundle.js') }} "></script>
    <script src="{{ asset('assets/bundles/knobjs.bundle.js') }} "></script>
    <script src="{{ asset('assets/bundles/c3.bundle.js') }} "></script>
    <script src="{{ asset('assets/bundles/flot.bundle.js') }} "></script>
    <script src="{{ asset('assets/bundles/jvectormap1.bundle.js') }} "></script>

    <!-- Start core js and page js -->
    <script src="{{ asset('assets/js/core.js') }} "></script>
    <script src="{{ asset('assets/js/page/index.js') }} "></script>

    <script>
        function setStyleSheet(url) {
            var stylesheet = document.getElementById("stylesheet");
            stylesheet.setAttribute('href', url);
        }
    </script>
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/gsap/gsap.min.js') }} "></script>

    <script src="{{ asset('assets/plugins/html5-qrcode/html5-qrcode.min.js') }} "></script>

    <script src="{{ asset('assets/js/custom-js/app.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/qrs.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/geolocation.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/reclamation.js') }}"></script>
    <script src="{{ asset('assets/js/custom-js/qr-interface.js') }}"></script>

</body>

</html>
