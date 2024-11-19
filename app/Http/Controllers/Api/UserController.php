<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index ()
    {
        return UserModel::all();
    }

    public function show(UserModel $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, UserModel $user)
    {
        $user->update($request->all());
        return response()->json(['message' => 'User updated successfully!', 'user' => $user], 200);
    }

}