<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{

  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|unique:users,email',
      'password' => 'required|string|min:6|confirmed'
    ]);

    if ($validator->fails()) {
      $response = [
        'mensaje' => 'Hubo un error',
        'error' => $validator->errors(),
        'status' => 400
      ];

      return response()->json($response, 400);
    }

    $admin = Admin::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    $token = JWTAuth::fromUser($admin);

    $admin->save();

    $reponse = [
      'mensaje' => 'Admin Creado Correctamente',
      'admin' => $admin,
      'token' => $token
    ];

    return response()->json($reponse, 201);
  }
  
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');

    if (!$token = auth('admin')->attempt($credentials)) {
      $response = [
        'mensaje' => 'Credenciales no válidas',
        'status' => 401
      ];
      return response()->json($response, 401);
    }

    $response = [
      'admin' => auth('admin')->user(),
      'token' => $token,
      'status' => 200
    ];

    return response()->json($response, 200);
  }

  public function logout()
  {
    auth()->logout();
    return response()->json(['message' => 'Cerrando Sesión Correctamente.'], 200);
  }

  public function me()
  {
    return response()->json(auth()->user(), 200);
  }
}
