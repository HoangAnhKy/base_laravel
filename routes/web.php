<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::group(["prefix" => "/"], function (){
    Route::get("/", [UsersController::class, "index"])->name("users.index");
    Route::get("/create", [UsersController::class, "create"])->name("users.create");
    Route::post("/store", [UsersController::class, "store"])->name("users.store");
    Route::get("/edit/{user}", [UsersController::class, "edit"])->name("users.edit");
    Route::put("/update/{user}", [UsersController::class, "update"])->name("users.update");
    Route::get("/delete/{user}", [UsersController::class, "delete"])->name("users.delete");
});

Route::group(["prefix" => "/course"], function (){
    Route::get("/", [CoursesController::class, "index"])->name("courses.index");
    Route::get("/create", [CoursesController::class, "create"])->name("courses.create");
    Route::post("/save", [CoursesController::class, "store"])->name("courses.store");
    Route::get("/edit/{course}", [CoursesController::class, "edit"])->name("courses.edit");
    Route::put("/update/{course}", [CoursesController::class, "update"])->name("courses.update");
    Route::get("/delete/{course}", [CoursesController::class, "delete"])->name("courses.delete");
});

Route::fallback(function (){
   return view("Layout.404");
});

