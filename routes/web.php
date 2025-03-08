<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/home', function () {
return view('homepage');
});

Route::get('/about', function () {
    return view('aboutpage');
    });
    
    Route::get('/ourroom', function () {
        return view('roompage');
        });

        Route::get('/gallery', function () {
            return view('gallerypage');
            });

            Route::get('/blog', function () {
                return view('blogpage');
                });

                Route::get('/contact', function () {
                    return view('contactpage');
                    });