<?php

use App\Http\Controllers\AuthController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// http:localhost:500/api/
// Universal Resource Locator
// tickets
// http:localhost:500/api/tickets/
// http:localhost:500/api/tickets/{id}
// http:localhost:500/api/tickets/{id}/edit
// http:localhost:500/api/tickets/{id}/delete
// users
// http:localhost:500/api/users/
// http:localhost:500/api/users/{id}
// http:localhost:500/api/users/{id}/edit
// http:localhost:500/api/users/{id}/delete

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/tickets', function() {
    return Ticket::all();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
