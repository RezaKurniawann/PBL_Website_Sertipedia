<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KompetensiModel;

class KompetensiController extends Controller
{
    public function index ()
    {
        return KompetensiModel::all();
    }

    public function show(KompetensiModel $kompetensi)
    {
        return response()->json($kompetensi);
    }
}
