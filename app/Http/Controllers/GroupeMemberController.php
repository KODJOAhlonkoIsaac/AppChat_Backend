<?php

namespace App\Http\Controllers;

use App\Http\Requests\groupeRequest;
use App\Http\Requests\OtherMemberRequest;
use App\Models\GroupeMember;
use Illuminate\Http\Request;

class GroupeMemberController extends Controller
{
    
    public function addMember($group_id, $member_id)
    {
        // return response()->json(['messages' => $request->all()]);
        $member = new GroupeMember();
        $member->groupe_id = $group_id;
        $member->user_id = $member_id;
        // Mail::to($request->email)->send(new accountMail($request->name));
        $member->save();

        return response()->json([
            'message' => 'member created successfully',
            'member' => $member,
        ], 201);
    }

    public function addOtherMember(OtherMemberRequest $groupeRequest, $group_id)
    {
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
