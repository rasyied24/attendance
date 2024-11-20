<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // return response()->json(['message' => 'Login endpoint hit successfully'], 200);

        // Validasi data input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek kredensial
        if ($user && Hash::check($request->password, $user->password)) {
            // Cek status pengguna
            if ($user->status === 'inactive') {
                return response()->json(['message' => 'Your account is inactive.'], 403);
            }

            // Buat API token untuk user
            $user->api_token = bin2hex(random_bytes(30)); // Generate token yang unik
            $user->login_at = now()->format('Y-m-d');
            $user->save();

            return response()->json([
                'token' => $user->api_token,
                'user' => $user
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        // Hapus token API untuk logout
        $user->api_token = null;
        $user->save();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }


}
