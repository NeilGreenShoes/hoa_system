<?php

namespace App\Http\Controllers;

use App\Models\OwnershipTransfers;
use Illuminate\Http\Request;

class OwnershipTransfersController extends Controller
{
    public function index()
    {
        $ownershipTransfer = OwnershipTransfers::get();

        return view('admin.ownership.index');
    }
}
