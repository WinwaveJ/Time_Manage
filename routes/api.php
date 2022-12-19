<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_events', 'EventsController@get_events');
Route::post('/add_event', 'EventsController@add_event');
Route::post('/mod_event', 'EventsController@mod_event');
Route::post('/del_event', 'EventsController@del_event');

Route::post('/create_record', 'RecordsController@create_record');
Route::post('/stop_record', 'RecordsController@stop_record');
Route::get('/get_time_use', 'RecordsController@get_time_use');
