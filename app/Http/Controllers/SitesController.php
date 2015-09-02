<?php

namespace App\Http\Controllers;

use App\Category;
use App\Site;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SitesController extends Controller
{
    public function index()
    {
        return Site::with('category')->get();

        //return Category::with('sites')->get();
    }

    public function store(Request $request)
    {
        Site::create($request->all());
    }
}
