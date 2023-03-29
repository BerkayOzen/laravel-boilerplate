<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        return response()->json([
            'users' => $user,
        ],200);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user,
        ],200);
    }

    public function me(Request $request)
    {
        $user = Auth::user();
        return response()->json([
            'user' => $user,
        ],200);
    }
}
