<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;


Route::post('Post/criarPostagem', [PostController::class,'criarPostagem']);

Route::get('Post/index', [PostController::class, 'index']);
Route::delete('Post/destroy/{id}', [PostController::class, 'destroyPost']);
Route::put('Post/editPost/{id}', [PostController::class, 'editPost']);
Route::get('Post/showPost/{id}', [PostController::class, 'showPost']);
//----------------------------------------------------------------------------------------------------------------------
Route::post('Post/{id}/storeComment', [CommentController::class, 'storeComment']);
Route::get('Post/{id}/indexComment', [CommentController::class, 'indexComment']);
Route::delete('Post/{id}/destroyComment/{id_comments}', [CommentController::class, 'destroyComment']);
Route::put('Post/{id}/editComment/{id_comments}', [CommentController::class, 'editComment']);
Route::get('Post/{id}/showComment/{id_comments}', [CommentController::class, 'showComment']);
