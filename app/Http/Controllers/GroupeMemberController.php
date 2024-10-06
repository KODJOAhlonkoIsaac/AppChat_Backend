<?php

namespace App\Http\Controllers;

use App\Http\Requests\groupeRequest;
use App\Http\Requests\OtherMemberRequest;
use App\Models\GroupeMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GroupeMemberController extends Controller
{

    //mamam
    public function addMember(OtherMemberRequest $groupeRequest, $group_id)
    {

        $check_if_in_bd = User::where('email', $groupeRequest->email)->first();


        if ($check_if_in_bd) {
            // return response()->json(['messages' => $request->all()]);
            $member = new GroupeMember();
            $member->groupe_id = $group_id;
            $member->user_id = $check_if_in_bd->id;
            // Mail::to($request->email)->send(new accountMail($request->name));
            $member->save();

            return response()->json([
                'message' => 'member created successfully',
                'member' => $member,
            ], 201);
        } else {
            // return response()->json(['messages' => $request->all()]);
            $member = new GroupeMember();
            $member->groupe_id = $group_id;
            $member->email = $groupeRequest->email;
            $member->if_already_register = false;
            // Mail::to($request->email)->send(new accountMail($request->name));
            $member->save();

            return response()->json([
                'message' => 'member created successfully',
                'member' => $member,
            ], 201);
        }
    }
}
