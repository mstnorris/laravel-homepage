<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function home()
    {
        $sites = Site::with('category')->get();

        return view('welcome', compact('sites'));
    }
}
