<?php

namespace App\Http\Controllers\Api;

use App\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Validator;

class UserInvitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user   = Auth::id();
        $invite = Invite::where('sender_id', $user)->get();

        return response()->json($invite, 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $data = [
            'sender_id'   => Auth::user()->id,
            'receiver_id' => $request->route('receiver_id'),
            'status'      => 'pending'
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

        $invite = Invite::create($data);

        return response()->json($invite, 200);
    }

}
