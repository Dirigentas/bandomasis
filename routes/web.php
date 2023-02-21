<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController as R;
use App\Http\Controllers\DishController as D;


Route::prefix('admin/restaurants')->name('restaurants-')->group(function () {
    Route::get('/index', [R::class, 'index'])->name('index')->middleware('roles:A');    
    Route::get('/create', [R::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/store', [R::class, 'store'])->name('store')->middleware('roles:A');    
    Route::get('/edit/{restaurant}', [R::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/update/{restaurant}', [R::class, 'update'])->name('update')->middleware('roles:A');    
    Route::delete('/destroy/{restaurant}', [R::class, 'destroy'])->name('destroy')->middleware('roles:A');    
});

Route::prefix('admin/dishes')->name('dishes-')->group(function () {
    Route::get('/index', [D::class, 'index'])->name('index')->middleware('roles:A');    
    Route::get('/create', [D::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/store', [D::class, 'store'])->name('store')->middleware('roles:A');    
    Route::get('/edit/{dish}', [D::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/update/{dish}', [D::class, 'update'])->name('update')->middleware('roles:A');    
    Route::delete('/destroy/{dish}', [D::class, 'destroy'])->name('destroy')->middleware('roles:A');    
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
