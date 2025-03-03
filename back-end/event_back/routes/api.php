<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Return all events
Route::get('/events',[EventController::class,'index']);
//Return only the events in this week
Route::get('/events/week',[EventController::class,'week']);
//Return only the event matched with meetings room id and event data
//with axios use params called "id" and "date"
Route::get('/events/find',[EventController::class,'find']);
//Return only meetings available in the specific data range if free
Route::get('/events/availableMeetings',[EventController::class,'availableMeetings']);

Route::post('/events/storeEvents', [EventController::class, 'storeEvents']);


Route::apiResource('/meetings',MeetingController::class);
