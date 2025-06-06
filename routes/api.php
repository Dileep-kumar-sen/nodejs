<?php

use App\Http\Controllers\apicontroller;
use App\Http\Controllers\firstcontrolle;
use App\Http\Controllers\UseraddController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testcontroller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::resource('dileep',testcontroller::class);
Route::get('createuser',[UseraddController::class,'createuser']);
Route::post('checkuser',[apicontroller::class,'checkvalidator']);
Route::middleware('auth:sanctum')->group(function(){
Route::get('getdata',[apicontroller::class,'getdata']);
})->name('getdata');
Route::fallback(function(){
 return "This Route Are Not Matching...";
});
Route::get('checking/{user:email}',[apicontroller::class,'checking']);
Route::get('invokable',firstcontrolle::class);
Route::controller(apicontroller::class)->prefix('admin')->group(function(){
 Route::get('test','test')->middleware('agecheck');
 Route::get('best','best');
});



