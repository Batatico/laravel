<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        
        if(Auth::user()->hasRole('Admin')){
            return view('adminVista');
        }
        elseif(Auth::user()->hasRole('Docente')){
            return view('docenteVista');
        }
        elseif(Auth::user()->hasRole('Alumno')){
            return view('alumnoVista');
        }
        elseif(Auth::user()->hasRole('Alumno Ayudante')){
            return view('ayudanteVista');
        }
        else{
            return view('register');
        }

    }


    public function perfil(){
        return  view('miperfil');
    }

    public function giveWelcome() {
        return view('welcome');
    }
}
