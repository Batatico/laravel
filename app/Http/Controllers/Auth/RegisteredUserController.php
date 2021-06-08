<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Freshwork\ChileanBundle\Exceptions\InvalidFormatException;
use Freshwork\ChileanBundle\Rut;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rut' => 'required|string|unique:users|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $rut = $request->rut;
        $rut2 = strval(Rut::parse($rut)->number()).strval(Rut::parse($rut)->vn());
       // $rut2 = Rut::parse($rut2)->format(Rut::FORMAT_COMPLETE);
        //dd($rut2);
        if(Rut::parse($rut2)->validate()){
            $rut2 = Rut::parse($rut2)->normalize(); //return '123456785'

            $user = User::create([
                'name' => $request->name,
                'rut' => $rut2,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            $user->attachRole($request->role_id);
            event(new Registered($user));
    
            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
            
        }
        else{
           // return redirect(RouteServiceProvider::WELCOME);
            return redirect()->route('welcome_route')->with('info','¡ Rut mal ingresado');
        }
        


      
    }
}
