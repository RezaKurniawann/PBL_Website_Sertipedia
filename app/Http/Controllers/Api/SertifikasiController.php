<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SertifikasiModel;

class SertifikasiController extends Controller
{
    public function index ()
    {
        return SertifikasiModel::all();
    }

    public function show(SertifikasiModel $sertifikasi)
    {
        return response()->json($sertifikasi);
    }
}
