<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use App\User;
use Auth;

class AuthController extends Controller
{
    /**
     * @OA\POST(
     *      path="/login",
     *      operationId="login",
     *      tags={"Test neki"},
     *      summary="User login",
     *      description="User login",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = $request->user();
            $data['token'] = $user->createToken('friends')->accessToken;
            $data['name']  = $user->name;
            $data['id']  = $user->id;
            return response()->json($data, 200);
        }

        return response()->json(['error'=>'Unauthorized'], 401);
    }

    /**
     * @OA\POST(
     *      path="/register",
     *      operationId="register",
     *      tags={"Test neki"},
     *      summary="User login",
     *      description="User login",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user = $request->all();
        $user['password'] = Hash::make($user['password']);
        $user = User::create($user);
        $success['token'] =  $user->createToken('friends')-> accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success]);
    }

}
