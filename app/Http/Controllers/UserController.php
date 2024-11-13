<?php

namespace App\Http\Controllers;
use App\Models\LevelModel;

use Illuminate\Http\Request;

class UserController extends Controller
{
     // menampilkan halaman awal user
     public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar User',
             'list' => ['Home', 'User']
         ];
 
         $page = (object) [
             'title' => 'Daftar user yang terdaftar dalam sistem'
         ];
 
         $activeMenu = 'manage-user';
 
         $level = LevelModel::all();
 
         return view('admin.user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
     }
}
