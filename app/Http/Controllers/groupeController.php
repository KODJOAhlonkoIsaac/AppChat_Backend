<?php

namespace App\Http\Controllers;

use App\Http\Requests\groupeRequest;
use App\Models\Groupe;
use App\Models\GroupeMember;
use Illuminate\Http\Request;

class groupeController extends Controller
{
    public function create(groupeRequest $request, $userId)
    {
        // return response()->json(['messages' => $request->all()]);
        $groupe = new Groupe();
        $groupe->name = $request->name;
        $groupe->description = $request->description;
        $groupe->admin_id = $userId;
        // Mail::to($request->description)->send(new accountMail($request->name));
        $groupe->save();

        return response()->json([
            'message' => 'groupe created successfully',
            'groupe' => $groupe,
        ], 201);
    }

    public function show($user_id)
    {

        // $groups_id = GroupeMember::where('use'); // Je vais faire cette partie
        // ok compris

        $groups = [];

        $groups_id = GroupeMember::where('user_id', $user_id)->pluck('groupe_id');

        if ($groups_id) {
            foreach ($groups_id as $id) {
                array_push($groups, Groupe::find($id));
            }
            return response()->json([
                'message' => 'success',
                'groupe' => $groups,
            ], 201);
        }
        return response()->json([
            'message' => 'error',
            // 'groupe' => $groups,
        ], 201);


    }
}
