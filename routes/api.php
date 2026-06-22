<?php

use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("contacts", [ContactController::class, 'index']);
Route::post("contacts", [ContactController::class, 'store']);
Route::put("contacts/{contact}", [ContactController::class, 'update']);
Route::delete("contacts/{contact}", [ContactController::class, 'destroy']);