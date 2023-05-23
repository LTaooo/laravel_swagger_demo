<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//
//     return view('welcome', ['name' => 'James']);
// });
Route::prefix('student')->group(function () {
    Route::get('list', [StudentController::class, 'list']);
    Route::get('detail', [StudentController::class, 'detail']);
    Route::get('add', [StudentController::class, 'add']);
    Route::get('update', [StudentController::class, 'update']);
    Route::get('delete', [StudentController::class, 'delete']);
});
