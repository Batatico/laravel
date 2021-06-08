<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
class UserController extends Controller
{
    //
    function show(){
        
        $data= User::all();
       
        return view('listaAlumnos', ['users' =>$data]);
    }

    function retornoUsuarios(){
        
        $data= User::all();
       
        return view('listaUsuarios', ['users' =>$data]);
    }
}
