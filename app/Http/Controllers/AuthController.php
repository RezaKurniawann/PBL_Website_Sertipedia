<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\LevelModel;
use App\Models\UserModel;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('auth.login');
    }
    public function postlogin(Request $request)
{
    if ($request->ajax() || $request->wantsJson()) {
        
        $credentials = $request->only('username', 'password');
        
        // Mencoba untuk mengautentikasi pengguna dengan kredensial yang diberikan
        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil,
            return response()->json([
                'status' => true, // Status login
                'message' => 'Login Berhasil', 
                'redirect' => url('/home') 
            ]);
        }
        
        // Jika autentikasi gagal,
        return response()->json([
            'status' => false, // Status login
            'message' => 'Login Gagal' 
        ]);
    }
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
    public function register()
    {

        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('auth.signup')->with('level', $level);
    }

    public function postregister(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:5'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            // Hash password sebelum disimpan
            $data = $request->all();
            $data['password'] = Hash::make($request->password);

            // Simpan data user
            usermodel::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan',
                'redirect' => url('login') 
            ]);
        }

        return redirect('login')->with('success', 'Registrasi berhasil!');
    }
}