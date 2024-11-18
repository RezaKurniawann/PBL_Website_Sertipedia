<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailSertifikasiModel;

class DetailSertifikasiController extends Controller
{
    public function index ()
    {
        return DetailSertifikasiModel::all();
    }

    public function show(DetailSertifikasiModel $detailSertifikasi)
    {
        return response()->json($detailSertifikasi);
    }
}
