<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PelatihanModel;

class PelatihanController extends Controller
{
    public function index ()
    {
        return PelatihanModel::all();
    }

    public function show(PelatihanModel $pelatihan)
    {
        return response()->json($pelatihan);
    }
}
