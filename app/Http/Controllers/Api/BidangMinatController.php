<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BidangMinatModel;

class BidangMinatController extends Controller
{
    public function index ()
    {
        return BidangMinatModel::all();
    }

    public function show(BidangMinatModel $bidangminat)
    {
        return response()->json($bidangminat);
    }
}
