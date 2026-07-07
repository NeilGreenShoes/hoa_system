<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Homeowners;
use App\Models\Registrations;

class HomeownerController extends Controller
{
    public function index() 
    {
        $homeowners = Homeowners::all();

        return view('admin.homeowner.index', compact('homeowners'));
    }
}
