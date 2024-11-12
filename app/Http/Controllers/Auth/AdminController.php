<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function login (Request $request) {
      $credentials = $request->only('email','password');

      if (!$token = JWTAuth::attempt($credentials)) {
        $response = [
          'mensaje' => 'Credenciales no válidas',
          'status'=> 401
        ];
        return response()->json($response, 401);
      }

      $response = [
        'admin' => auth()->user(),
        'token' => $token,
        'status' => 200
      ];

      return response()->json($response, 200);
    }

    public function logout () {
      auth()->logout();
      return response()->json(['message' => 'Cerrando Sesión Correctamente.'],200);
    }

    public function me () {
      return response()->json(auth()->user(), 200);
    }
}
