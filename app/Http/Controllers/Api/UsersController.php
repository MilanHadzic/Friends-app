<?php

namespace App\Http\Controllers\Api;

use App\Invite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthroized'], 401);
        }

        $users = User::where('id', '!=', $user->id)->get();

        return response()->json(['users' => $users], 200);
    }
}
