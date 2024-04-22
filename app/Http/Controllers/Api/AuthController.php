<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return response()->json(['message' => 'Halo Admin!']);
        } elseif ($user->hasRole('user')) {
            return response()->json(['message' => 'Halo User!']);
        } else {
            return response()->json(['message' => 'Halo!']);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = $request->validate(
                [
                    'email' => 'required',
                    'password' => 'required',
                ],
                [
                    'email.required' => 'Email wajib diisi.',
                    'password.required' => 'Password wajib diisi.',
                ]
            );

            if (!$validator) {
                return response()->json(['error' => 'Validation failed, Anda Tidak mempunyai akses'], 422);
            }

            $credentials = $request->only('email', 'password');

            if (!$token = Auth::guard('api')->attempt($credentials)) {
                return response()->json(['error' => 'Email atau password salah.'], 401);
            }

            $user = Auth::guard('api')->user();
            $userInfo = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ];

            return response()->json(['token' => $token, 'user' => $userInfo]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        //Response
        return response()->json([
            'message' => 'Success Created Account',
            'data' => $user
        ]);
    }

    public function me()
    {
        $data = [
            'data_user' => auth()->user(),
            'role' => Auth::user()->getRoleNames()
        ];
        return response()->json($data);
    }

    public function logout()
    {
        try {
            Auth::guard('api')->logout();

            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
