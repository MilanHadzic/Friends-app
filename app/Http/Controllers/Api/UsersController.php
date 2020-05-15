<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;

class UsersController
{
    public function index(Request $request)
    {
        $users = User::paginate($request->per_page??'10');
        return response()->json(['users' => $users], 200);
    }
}
