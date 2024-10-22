<?php

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

Route::fallback(function (){
   return view("Layout.404");
});
