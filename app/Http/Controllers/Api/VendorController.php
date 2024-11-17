<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorModel;

class VendorController extends Controller
{
    public function index ()
    {
        return VendorModel::all();
    }

    public function show(VendorModel $vendor)
    {
        return response()->json($vendor);
    }
}
