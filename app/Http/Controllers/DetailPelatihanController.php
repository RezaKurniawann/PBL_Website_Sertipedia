<?php

namespace App\Http\Controllers;

use App\Models\PelatihanModel;
use App\Models\PeriodeModel;
use App\Models\UserModel;
use App\Models\VendorModel;
use App\Models\DetailPelatihanModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class DetailPelatihanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Pelatihan',
            'list' => ['Home', 'Detail Pelatihan']
        ];

        $page = (object) [
            'title' => 'Daftar detail pelatihan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-detailevent';

        $user = UserModel::all();
        $pelatihan = PelatihanModel::all();

        return view('admin.detailEvent.pelatihan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'pelatihan' => $pelatihan, 'activeMenu' => $activeMenu]);
    }

    public function formDataPelatihan()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pelatihan',
            'list' => ['Home', 'Pelatihan']
        ];

        $page = (object) [
            'title' => 'Daftar Pelatihan yang Sedang Diikuti'
        ];

        $activeMenu = 'inputdata';

        return view('user.inputdata.pelatihan', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function listPelatihan(Request $request)
    {
        if ($request->ajax()) { // Pastikan hanya melayani request AJAX
            $user = UserModel::findOrFail(Auth::id());

            // Ambil data detail pelatihan beserta relasi
            $detailPelatihan = DetailPelatihanModel::with(['user', 'pelatihan.vendor', 'pelatihan.periode'])
                ->where('id_user', $user->id_user)
                ->where('status', 'On Going')
                ->get();

            return DataTables::of($detailPelatihan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($detailPelatihan) {
                    return '<button onclick="modalAction(\'' . url('inputdata/pelatihan/' . $detailPelatihan->id_detail_pelatihan . '/show_pelatihan') . '\')" class="btn btn-sm btn-info"><i class="fa fa-upload"></i> Input Data</button>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function showPelatihan(string $id)
    {
        $detailPelatihan = DetailPelatihanModel::find($id);
        if ($detailPelatihan) {
            return view('user.inputdata.showPelatihan', ['detailPelatihan' => $detailPelatihan]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function uploadDataPelatihan(Request $request, $id)
    {
        $detailPelatihan = DetailPelatihanModel::find($id); // Adjust this according to your model structure
    
        if ($detailPelatihan) {
            // Check if the image file is provided
            if ($request->hasFile('image_pelatihan')) {
                // If the record already has an image, delete it from storage
                if ($detailPelatihan->image && Storage::disk('public')->exists('photos/' . $detailPelatihan->image)) {
                    Storage::disk('public')->delete('photos/' . $detailPelatihan->image);
                }
    
                // Store the new image and update the record
                $fileName = $request->file('image_pelatihan')->hashName();
                $request->file('image_pelatihan')->storeAs('public/photos', $fileName);
                $detailPelatihan->image = $fileName;
                $detailPelatihan->status = "Completed"; // Update the status if necessary
            }
    
            // Save the changes to the database
            $detailPelatihan->save();
    
            // Return a success response in JSON format
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan!',
            ]);
        } else {
            // Return a failure response if the detail not found
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!',
            ]);
        }
    }
}
