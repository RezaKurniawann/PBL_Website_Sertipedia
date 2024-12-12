<?php

namespace App\Http\Controllers;

use App\Models\SertifikasiModel;
use App\Models\PeriodeModel;
use App\Models\UserModel;
use App\Models\VendorModel;
use App\Models\DetailSertifikasiModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class DetailSertifikasiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Detail Sertifikasi',
            'list' => ['Home', 'Detail Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar detail Sertifikasi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'manage-detailevent';

        $user = UserModel::all();
        $sertifikasi = SertifikasiModel::all();

        return view('admin.detailEvent.Sertifikasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'Sertifikasi' => $sertifikasi, 'activeMenu' => $activeMenu]);
    }

    public function formDataSertifikasi()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Sertifikasi',
            'list' => ['Home', 'Sertifikasi']
        ];

        $page = (object) [
            'title' => 'Daftar Sertifikasi yang Sedang Diikuti'
        ];

        $activeMenu = 'inputdata';

        return view('user.inputdata.sertifikasi', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function listSertifikasi(Request $request)
    {
        if ($request->ajax()) { // Pastikan hanya melayani request AJAX
            $user = UserModel::findOrFail(Auth::id());

            // Ambil data detail sertifikasi beserta relasi
            $detailSertifikasi = DetailSertifikasiModel::with(['user', 'sertifikasi.vendor', 'sertifikasi.periode'])
                ->where('id_user', $user->id_user)
                ->where('status', 'On Going')
                ->get();

            return DataTables::of($detailSertifikasi)
                ->addIndexColumn()
                ->addColumn('aksi', function ($detailSertifikasi) {
                    return '<button onclick="modalAction(\'' . url('inputdata/sertifikasi/' . $detailSertifikasi->id_detail_sertifikasi . '/show_sertifikasi') . '\')" class="btn btn-sm btn-info"><i class="fa fa-upload"></i> Input Data</button>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function showSertifikasi(string $id)
    {
        $detailSertifikasi = DetailSertifikasiModel::find($id);
        if ($detailSertifikasi) {
            return view('user.inputdata.showSertifikasi', ['detailSertifikasi' => $detailSertifikasi]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    public function uploadDatasertifikasi(Request $request, $id)
    {
        $detailSertifikasi = DetailSertifikasiModel::find($id); // Adjust this according to your model structure
    
        if ($detailSertifikasi) {
            // Check if the image file is provided
            if ($request->hasFile('image_sertifikasi')) {
                // If the record already has an image, delete it from storage
                if ($detailSertifikasi->image && Storage::disk('public')->exists('photos/' . $detailSertifikasi->image)) {
                    Storage::disk('public')->delete('photos/' . $detailSertifikasi->image);
                }
    
                // Store the new image and update the record
                $fileName = $request->file('image_sertifikasi')->hashName();
                $request->file('image_sertifikasi')->storeAs('public/photos', $fileName);
                $detailSertifikasi->image = $fileName;
                $detailSertifikasi->status = "Completed"; // Update the status if necessary
            }
    
            $detailSertifikasi->no_sertifikasi = $request->input('no_sertifikasi');
            $detailSertifikasi->save();
    
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
