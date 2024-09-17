<?php

use App\Http\Controllers\FormController;
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

// Redirige la route "/" vers l'index des formulaires
Route::get('/', [FormController::class, 'index'])->name('forms.index');

// Routes pour les formulaires
Route::get('forms', [FormController::class, 'index'])->name('forms.index');
Route::get('forms/create', [FormController::class, 'create'])->name('forms.create');
Route::post('forms/store', [FormController::class, 'store'])->name('forms.store');
Route::get('forms/{form}', [FormController::class, 'show'])->name('forms.show');
Route::delete('forms/{form}', [FormController::class, 'destroy'])->name('forms.destroy');

