<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Response;
use PhpParser\Node\Stmt\Echo_;

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

//Routing -> Parameters
Route::get('/post/{postId}/comment/{comment}', function(string $postId, string $comment) {
    return "Post ID: " . $postId . " - Comment: " . $comment;
});

Route::get('/post/{id}', function(string $id){
    return $id;
})->where('id', '[0-9]+');

Route::get('/search/{search}', function(string $search) {
    return $search;
})->where('search', '.*');

Route::get('/test/route', function() {
    return route('test-route');
})->name('test-route');

//Route -> Middleware Group
Route::middleware(['user-middleware'])->group(function() {
    Route::get('route-middleware-group/first', function (Request $request) {
        echo 'first';
    });

    Route::get('route-middleware-group/second', function (Request $request) {
        echo 'second';
    });    
});

//Route -> Controller
Route::controller(UserController::class)->group(function(){
    Route::get('/users', 'index');
    Route::get('/users/first', 'first');
    Route::get('/users/{id}', 'show');
});

//CSRF
Route::get('/token', function(Request $request){
    return view('token');
});

Route::post('/token', function(Request $request){
    return $request->all();
});
