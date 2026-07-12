<?php

namespace App\Http\Controllers;

use App\Models\WaterReading;
use Illuminate\Http\Request;

class WaterReadingController extends Controller
{
    public function index()
    {
        $water = WaterReading::orderBy('waterReadingID', 'desc')->get();

        return view('admin.water_readings.index', compact('water'));
    }
}
