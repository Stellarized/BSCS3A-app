<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});

// Service Container
Route::get('/test-container', function (Request $request) {
    $input = $request->input('key');
    return $input;
});

// Service Providers
Route::get('/test-provider', function(UserService $userService) {
    return $userService->listUsers();
    //dd($userService->listUsers());
});

// Service Controller
Route::get('/test-users', [UserController::class, 'index']);

// Facades
Route::get('/test-facade', function(UserService $userService) {
    return Response::json($userService->listUsers());
    //dd(Response::json($userService->listUsers()));
});

?>