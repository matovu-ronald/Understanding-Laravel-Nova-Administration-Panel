<?php

use Dotenv\Regex\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::post('/', function(Request $request) {
    Artisan::call('view:cache');
    return [
        'success' => true
    ];
});
// Route::get('/endpoint', function (Request $request) {
//     //
// });
