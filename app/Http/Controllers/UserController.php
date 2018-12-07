<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return 'usuarios';
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
