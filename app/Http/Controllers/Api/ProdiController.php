<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdiModel;

class ProdiController extends Controller
{
    public function index ()
    {
        return ProdiModel::all();
    }

    public function show(ProdiModel $prodi)
    {
        return response()->json($prodi);
    }
}
