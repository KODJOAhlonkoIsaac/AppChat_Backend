<?php

namespace App\Http\Controllers;

use App\Http\Requests\groupeRequest;
use App\Models\Groupe;
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
}
