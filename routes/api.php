<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are prefixed with `/api` and belong to the `api` middleware
| group, which applies the global `throttle:api` limiter (60 requests per
| minute per authenticated user, or per IP for guests) configured in
| App\Providers\AppServiceProvider. No per-route throttle is needed here.
|
*/

Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});

// Example authenticated endpoint (enable once an API guard such as Sanctum is set up):
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
