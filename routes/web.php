<?php

//use User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\SortController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\FilterController;
use App\Http\Controllers\User\SearchController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // routes for users 
    Route::resource('/users',UserController::class);
    Route::delete('/users/force-delete/{user}',[UserController::class,'forceDelete'])->name('users.force-delete');
    Route::post('/users/mass-delete',[UserController::class,'massDel'])->name('users.mass-delete');
    Route::post('/users/mass-forcedelete',[UserController::class,'massForceDel'])->name('users.mass-forcedelete');
    Route::post('/users/search',SearchController::class)->name('users.search');
    Route::post('/users/sort',SortController::class)->name('users.sort');
   
});

require __DIR__.'/auth.php';

Route::get('/reset-db',function(){
       Artisan::call('migrate:fresh',['--seed' =>true]);
    return to_route('login') ;
});
