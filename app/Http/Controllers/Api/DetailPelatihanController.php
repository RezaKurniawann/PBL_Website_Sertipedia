<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPelatihanModel;

class DetailPelatihanController extends Controller
{
    public function index ()
    {
        return DetailPelatihanModel::all();
    }

    public function show(DetailPelatihanModel $detailPelatihan)
    {
        return response()->json($detailPelatihan);
    }
}
