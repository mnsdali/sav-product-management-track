<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Revendeur;
use App\Models\Technicien;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


class RegisteredUserController extends Controller
{


    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'prenom' => ['required', 'string', 'max:255'],
            'nom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'num_tel1' => ['required', 'numeric', 'min:8'],
            'num_tel2' => ['nullable', 'numeric', 'min:8'],
            'accountTypes' => 'required'
        ]);

        $user = User::create([
            'name'=>$request->prenom.' '.$request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'num_tel1' => $request->num_tel1,
            'num_tel2' => $request->num_tel2,

        ]);



        if (in_array('rev', $request->accountTypes)){
            // $revendeur = new Revendeur;
            // $revendeur->email = $user->email;
            // $revendeur->username = $user->name;
            // $revendeur->save();
            $user->assignRole('revendeur');

        }

        if (in_array('tech', $request->accountTypes)){
            // $technicien = new Technicien;
            // $technicien->email = $user->email;
            // $technicien->username = $user->name;
            // $technicien->save();
            $user->assignRole('technicien');
        }

        // if (in_array('client', $request->accountTypes)){
        //     $client = new Client;
        //     $client->email = $user->email;
        //     $client->username = $user->name;
        //     $client->save();
        //     $user->assignRole('client');
        // }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
