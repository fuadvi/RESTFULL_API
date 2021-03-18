<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // ambil data email user
        $user = User::where('email', $request->email)->first();

        // jika user kosong atau password beda dengan pasword user
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(
                [
                    'massage' => "UNAOUTHORIZED",
                ],
                401
            );
        }

        // jika user ada maka buat token
        $token = $user->createToken('token')->plainTextToken;

        // kirim data berhasil
        return response()->json(
            [
                'massage' => 'success',
                'user' => $user,
                'token' => $token
            ],
            200
        );
    }

    public function logout(Request $request)
    {
        // find user
        $user = $request->user();

        // menghapus token
        $user->currentAccessToken()->delete();

        // kirim respon
        return response()->json(
            [
                "massage" => "berhasil logout"
            ],
            200
        );
    }
}
