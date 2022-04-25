<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Master extends Controller
{
    public function index(){
    	return view('welcome');
    }
}
