<?php

namespace App\Http\Controllers\Api;

use App\Invite;
use Illuminate\Support\Facades\Auth;

class InvitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user   = Auth::id();
        $invite = Invite::where('receiver_id', $user)->get();
        if (!$invite) {
            return response()->json([
                'message' => 'You did not invite anyone for friend'
            ], 400);
        }

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
        $invites = Invite::findOrFail($id);

        return response()->json($invites, 200);
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
        $invite = Invite::findOrFail($id);
        $invite->delete();

        return response()->json(['deleted'], 200);
    }
}
