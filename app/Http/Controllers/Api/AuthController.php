<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::query()->create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('Auth Token')->accessToken;

        $response = [
            'status' => 'success',
            'user' => UserResource::make($user),
            'token' => $token,
            'token_type' => 'Bearer',
        ];

        return response()->json($response, 200)->header('Authorization', $token);
    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $user = $request->user();

        $accessToken = $user->createToken('Auth Token')->accessToken;

        $message = [
            'status' => 'success',
            'user' => UserResource::make($user),
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(Carbon::now()->addDays(1))->toDateTimeString(),
        ];

        return response()->json($message);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $token->delete();
        $response = [
            'status' => 'success',
            'message' => 'You have been successfully logged out!'
        ];
        return response()->json($response, 200);
    }

    public function refresh(Request $request)
    {
        $user = $request->user();
        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        $payload = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->header('refresh'),
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'scope' => '',
        ];

        $request->request->add($payload);
        $proxy = Request::create('oauth/token', 'POST');

        $response = json_decode(Route::dispatch($proxy)->getContent(), true);

        $message = [
            'status' => 'success',
            'user' => UserResource::make($user),
            'accessToken' => $response['access_token'],
            'refresh' => $response['refresh_token'],
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(Carbon::now()->addDays(1))->toDateTimeString(),
        ];

        return response()->json($message, 200)
            ->withHeaders([
                'Access-Control-Expose-Headers' => 'Authorization, Refresh',
                'Authorization' => 'Bearer ' . $response['access_token'],
                'Refresh' => $response['refresh_token'],
            ]);
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
}
