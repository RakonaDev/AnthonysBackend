<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

// Authorization: Bearer {token}.

class AuthController extends Controller
{
  // Método de registro
  public function register (Request $request){
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|unique:users,email',
      'password' => 'required|string|min:6|confirmed'
    ]);

    if($validator->fails()){
      $response = [
        'mensaje' => 'Hubo un error',
        'error' => $validator->errors(),
        'status' => 400
      ];

      return response()->json($response, 400);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role' => 'user'
    ]);

    $token = JWTAuth::fromUser($user);
    $user->save();

    $reponse = [
      'mensaje' => 'Usuario Creado Correctamente',
      'user' => $user,
      'token' => $token
    ];

    return response()->json($reponse, 201);
  }

  // Método de login
  public function login (Request $request) {
    $credentials = $request->only('email', 'password');
    // auth()->attempt($credentials)
    if(!$token = JWTAuth::attempt($credentials)){
      $reponse = [
        'error' => 'Credenciales no válidas',
        'status' => 401
      ];
      return response()->json($reponse, 401);
    }

    $reponse = [
      'user' => auth()->user(),
      'token' => $token
    ];

    return response()->json($reponse, 200);
  }

  // Método para cerrar sesión
  public function logout()
  {
    auth()->logout();
    return response()->json(['message' => 'Sesión cerrada con éxito']);
  }

  // Método para obtener el usuario autenticado
  public function me()
  {
    return response()->json(auth()->user(), 200);
  }
}
