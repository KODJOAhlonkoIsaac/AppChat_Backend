<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\groupeController;
use App\Http\Controllers\GroupeMemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register' , [AuthController::class , 'register']);
Route::post('login' , [AuthController::class , 'login']);
Route::post('send_file' , [FileController::class , 'store']);
Route::post('new_groupe/{userId}' , [groupeController::class , 'create']);
Route::post('addMember/{group_id}/{member_id}' , [GroupeMemberController::class , 'addMember']);
Route::post('addOtherMember/{group_id}' , [GroupeMemberController::class , 'addOtherMember']);
