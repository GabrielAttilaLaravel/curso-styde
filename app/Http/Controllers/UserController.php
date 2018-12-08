<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if(request()->has('empty')){
            $users = [];
        }else{
            $users = [
                'Gabriel',
                'Alexander',
                'Milagros',
                'Attila',
                '<script>alert("Hola")</script>'
            ];
        }

        $title = 'Listado de Usuarios';

        return view('users', compact('title', 'users'));
    }

    public function show($id)
    {
        return "Mostrando detalles del usuario: {$id}";
    }

    public function create()
    {
        return 'Crear nuevo usuario';
    }
}
