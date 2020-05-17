<?php

namespace App\Http\Controllers\Api;

use App\Friends;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \Validator;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user   = Auth::id();
        $friend = Friends::where('sender_id', $user)->get();

        return response()->json($friend, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $data = [
            'sender_id'   => Auth::user()->id,
            'receiver_id' => $request->route('receiver_id'),
            'status'      => 'friend'
        ];

        $rules     = [
            'sender_id'   => 'required',
            'receiver_id' => 'required',
            'status'      => 'required'
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->getMessageBag()->toArray()
            ], 400); // 400 being the HTTP code for an invalid request.
        }

        $invite = Friends::create($data);

        return response()->json($invite, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user   = Auth::id();
        $friend = Friends::findOrFail($id);

        return response()->json($friend, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $invite = Friends::findOrFail($id);
        $invite->delete();

        return response()->json(['Friend deleted'], 200);
    }
}
