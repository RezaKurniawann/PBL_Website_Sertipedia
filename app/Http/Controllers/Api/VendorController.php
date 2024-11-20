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

    public function store(Request $request)
    {
        $vendor = VendorModel::create($request->all());
        return response()->json($vendor, 201);
    }

    public function show(VendorModel $vendor)
    {
        return response()->json($vendor);
    }

    public function update(Request $request, VendorModel $vendor)
    {
        $vendor->update($request->all());
        return response()->json(['message' => 'vendor updated successfully!', 'vendor' => $vendor], 200);
    }

    public function destroy(vendorModel $vendor)
    {
        $vendor->delete();

        return response()->json([
            'success' => true, 
            'message' => 'Data Terhapus!', 
        ], );
    }
    
}
