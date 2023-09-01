<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta name="description" content="Crush it Able The most popular Admin Dashboard template and ui kit">
<meta name="author" content="PuffinTheme the theme designer">

<link rel="icon" href="favicon.ico" type="image/x-icon"/>

<title>:: Crush it :: Register</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css" />

<!-- Core css -->
<link rel="stylesheet" href="../assets/css/main.css"/>
<link rel="stylesheet" href="../assets/css/theme4.css" id="stylesheet"/>

</head>
<body class="font-opensans bg-dark">

<div class="auth">
    <div class="card">
        {{-- <div class="text-center mb-5">
            <a class="header-brand" href="index.html"><i class="fe fe-command brand-logo"></i></a>
        </div> --}}
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
            <div class="">
            <div class="card-title custom-control-inline">Créer un nouveau compte
                </div>
                <div class="float-right  text-muted custom-control-inline"> <a href="{{ route('login') }}">
                    Acceuil </a>
                    </div>
            </div>
            <div class="form-group style2">
                <label class="form-label">Prenom</label>
                <input type="text" class="form-control" placeholder="John"
                id="prenom"  name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom">
                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
            </div>

            <div class="form-group style2">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" placeholder="Wick"
                id="nom"  name="nom" :value="old('nom')" required autofocus autocomplete="nom">
                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
            </div>

            <div class="form-group style2">
                <label class="form-label" for="email"  >Adresse email </label>
                <input id="email" class="form-control" type="email" name="email"placeholder="exemple@gmail.com" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>
            <div class="form-group style2">

                <label class="form-label">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required autocomplete="current-password">
            </div>
            <div class="form-group style2">
                <label class="form-label">Confirmer Mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation"  class="form-control" placeholder="Enter password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="row">
                <div class="col-6 form-group style2">
                    <label class="form-label" for="num_tel1"  >Numéro Téléphone 1 </label>
                    <input id="num_tel1" class="form-control" type="text" name="num_tel1" placeholder="52195080" required autofocus autocomplete="num_tel1" />
                    <x-input-error :messages="$errors->get('num_tel1')" class="mt-2" />

                </div>
                <div class="col-6 form-group style2">
                    <label class="form-label" for="num_tel2"  >Numéro Téléphone 2 </label>
                    <input id="num_tel2" class="form-control" type="text" name="num_tel2"placeholder="52195080"  autofocus autocomplete="num_tel2" />
                    <x-input-error :messages="$errors->get('num_tel2')" class="mt-2" />

                </div>
            </div>
            <div class="form-group style2">
                <div class="form-label">Qu'est ce que vous êtes?</div>
                <div>
                    <label class="custom-control custom-checkbox custom-control-inline">
                        <input  type="checkbox" class="custom-control-input" id="client-checkbox-list" name="accountTypes[]" value="client" checked>
                        <span class="custom-control-label">Client</span>
                    </label>
                    <label class="custom-control custom-checkbox custom-control-inline" style="margin-left: 20%">
                        <input id="rev-checkbox-list" name="accountTypes[]"  type="checkbox" class="custom-control-input" name="example-inline-checkbox2" value="rev"  >
                        <span class="custom-control-label">Revendeur</span>
                    </label>
                    <label class="custom-control custom-checkbox custom-control-inline" style="margin-left: 20%">
                        <input id="tech-checkbox-list" type="checkbox" name="accountTypes[]" class="custom-control-input" name="example-inline-checkbox3" value="tech" >
                        <span class="custom-control-label">Technicien</span>
                    </label>
                </div>
            </div>


            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-block">Create nouveau compte</button>
            </div>
            </form>
        </div>
        <div class="text-center text-muted mb-4">
            Vous avez déja un compte? <a href="{{route('login')}}">Sign in</a>
        </div>
    </div>
</div>

<!-- jQuery and bootstrtap js -->
<script src="../assets/bundles/lib.vendor.bundle.js"></script>

<!-- start plugin js file  -->
<!-- Start core js and page js -->
<script src="../assets/js/core.js"></script>
</body>
</html>
