<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeriodeModel;

class PeriodeController extends Controller
{
    public function index ()
    {
        return PeriodeModel::all();
    }

    public function show(PeriodeModel $periode)
    {
        return response()->json($periode);
    }
}
