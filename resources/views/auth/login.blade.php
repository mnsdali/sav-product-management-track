<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta name="description" content="Crush it Able The most popular Admin Dashboard template and ui kit">
<meta name="author" content="PuffinTheme the theme designer">

<link rel="icon" href="favicon.ico" type="image/x-icon"/>

<title>:: Crush it :: Login</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" />

<!-- Core css -->
<link rel="stylesheet" href="{{ asset('assets/css/main.css')}}"/>
<link rel="stylesheet" href="{{ asset('assets/css/theme4.css')}}" id="stylesheet"/>

</head>
<body class="font-opensans">

<div class="auth">
    <div class="card">
        <div class="text-center mb-5">
            <a class="header-brand" href="index.html"><i class="fe fe-command brand-logo"></i></a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="card-title">Login to your account</div>
                <div class="form-group style2">
                    <label class="form-label" for="email"  >Email </label>
                    <input id="email" class="form-control" type="email" name="email"placeholder="Enter email" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="form-group style2">

                    <label class="form-label">
                        Password
                        @if (Route::has('password.request'))
                        <a class="float-right small" href="{{ route('password.request') }}">
                            I forgot password
                        </a>
                        @endif
                    </label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required autocomplete="current-password">

                </div>
                <div class="form-group">
                    <label for="remember_me" class="custom-control custom-checkbox">
                        <input id="remember_me" type="checkbox" class="custom-control-input" name="remember">
                        <span class="custom-control-label">Remember me</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block" title="Sign in">Sign in</a>
                </div>
            </form>
        </div>

        <div class="text-center text-muted">
            Don't have account yet? <a href="{{route('register')}}">Sign up</a>
        </div>

    </div>

</div>

<!-- jQuery and bootstrtap js -->
<script src="{{ asset('assets/bundles/lib.vendor.bundle.js')}}"></script>

<!-- start plugin js file  -->
<!-- Start core js and page js -->
<script src="{{ asset('assets/js/core.js')}}"></script>
</body>
</html>






{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
