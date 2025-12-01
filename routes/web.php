<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;

Route::get('/', [PegawaiController::class,'index']);

Route::post('/update/{id}', [PegawaiController::class,'update']);
Route::post('/store', [PegawaiController::class,'store']);
Route::get('/delete/{id}', [PegawaiController::class,'delete']);

Route::get('/generate_pdf', [PegawaiController::class, "generate_pdf"]);