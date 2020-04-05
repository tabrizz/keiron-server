<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

  public function login(Request $request) {
    //
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json([
            'message' => 'Wrong email or password 1',
            'status' => 422
        ], 422);
    }
   
    if (!Hash::check(request('password'), $user->password)) {
        return response()->json([
            'message' => 'Wrong email or password 2',
            'status' => 422
        ], 422);
    }
    
    $client = DB::table('oauth_clients')
        ->where('password_client', true)
        ->first();
    
    if (!$client) {
        return response()->json([
            'message' => 'Laravel Passport is not setup properly.',
            'status' => 500
        ], 500);
    }

    $data = [
        'grant_type' => 'password',
        'client_id' => "$client->id",
        'client_secret' => $client->secret,
        'username' => request('email'),
        'password' => request('password'),
    ];

    $request = Request::create('/oauth/token', 'POST', $data);

    $response = app()->handle($request);
    
    if ($response->getStatusCode() != 200) {
        return response()->json([
            'message' => 'Wrong email or password 3',
            'status' => 422
        ], 422);
    }
    
    $data = json_decode($response->getContent());
    return response()->json([
        'token' => $data->access_token,
        'user' => $user,
        'status' => 200
    ]);
  }

  public function logout () {
    $accessToken = Auth::user()->token();

    $refreshToken = DB::table('oauth_refresh_tokens')
        ->where('access_token_id', $accessToken->id)
        ->update([
            'revoked' => true
        ]);

    $accessToken->revoke();

    return response()->json(['status' => 200]);
  }

  public function changePassword(Request $request) {
    $userId = Auth::user()->id;
    $user = Auth::user();
    $user->token()->revoke();
    $token = $user->createToken('newToken')->accessToken;
    DB::table('users')
        ->where('id', $userId)
        ->update([
        'password' => bcrypt($request->password)
    ]);

    return response()->json([
        'token' => $token
    ]);
  }
}
