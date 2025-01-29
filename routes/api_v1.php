<?php

use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\AuthorsController;
use App\Http\Controllers\Api\V1\AuthorTicektsController;
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

// We must add versions of Api like:
// http:localhost:500/api/v1/tickets
// http:localhost:500/api/v2/tickets ...

// Make the controller for Ticket Model and also make requests (php artisan make:controller Api\V1\TicketController --resource --model=Ticket --requests)
Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('tickets', TicketController::class)->except('update'); // except update method means we don't want to update the ticket
    Route::put('tickets/{ticket}', [TicketController::class, 'replace']);

    Route::apiResource('authors', AuthorsController::class);
    Route::apiResource('authors.tickets', AuthorTicektsController::class)->except('update'); // parent-child relationship
    Route::put('authors/{author}/tickets/{ticket}', [AuthorTicektsController::class, 'replace'] );

    Route::get('/user', function (Request $request) {
        return $request->user();
    }); 
});