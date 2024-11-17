<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MataKuliahModel;

class MataKuliahController extends Controller
{
    public function index ()
    {
        return MataKuliahModel::all();
    }

    public function show(MataKuliahModel $mataKuliah)
    {
        return response()->json($mataKuliah);
    }
}
