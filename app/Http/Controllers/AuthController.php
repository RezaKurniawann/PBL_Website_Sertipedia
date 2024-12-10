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
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/home');  // Redirect to admin dashboard if logged in as admin
        }
        
        if (Auth::check()) {
            return redirect('/user/home');  // Redirect to user dashboard if logged in as a regular user
        }
        
        return view('auth.login');  // Show login page if not authenticated
    }
    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            
            $credentials = $request->only('email', 'password');
            
            // Check login for admin guard
            if (Auth::guard('admin')->attempt($credentials)) {
                return response()->json([
                    'status' => true, 
                    'message' => 'Login Berhasil', 
                    'redirect' => url('/admin/home') 
                ]);
            }

            // Check login for user guard (default)
            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true, 
                    'message' => 'Login Berhasil', 
                    'redirect' => url('/user/home')
                ]);
            }
            
            // If authentication fails
            return response()->json([
                'status' => false, 
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