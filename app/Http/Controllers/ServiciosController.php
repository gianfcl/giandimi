<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function index(Request $request)
    {
    	return view("servicios.index");
    }
}
