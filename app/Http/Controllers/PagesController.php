<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Site;

class PagesController extends Controller
{
    public function home()
    {
        //$sites = Site::all();

        //return view('welcome', compact('sites'));

        return view('welcome');
    }
}
