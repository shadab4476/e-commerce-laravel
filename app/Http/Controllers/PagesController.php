<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    public function contect()
    {
        $title = "Contect";
        return view("dashboard.contect.contect", compact('title'));
    }
    
    public function about()
    {
        $title = "About";
        return view("dashboard.about.about", compact('title'));
    }
}
