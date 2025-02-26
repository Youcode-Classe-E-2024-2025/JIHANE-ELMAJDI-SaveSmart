<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
})->name("login");

Route::get('/register', function () {
    return view('register');
})->name("register");

Route::get('/dashbord', function () {
    return view('dashbord');
})->name('dashbord');  
use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {
    
    if (Auth::check()) {
        return view('dashboard', ['user' => Auth::user()]);
    }
    

    return redirect()->route('login');
})->middleware('auth')->name('dashboard');



Route::post('/login', [AuthController::class, 'login']);  

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard'); 

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login')->with('success', 'You have been logged out.');
})->name('logout');
Route::get('/home', function () {
    return view('home');
})->name('home');


Route::get('/profile', function () {
    return view('profile');
})->name("profile");

Route::get('/dashbord', function () {
    return view('dashbord');
})->name("dashbord");

use App\Http\Controllers\ProfileController;

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

