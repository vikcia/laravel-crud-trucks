<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrucksController;

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

Route::get('/trucks', [TrucksController::class, 'index'])->name('trucks.index');
Route::get('/trucks/create', [TrucksController::class, 'create'])->name('trucks.create');
Route::post('/trucks', [TrucksController::class, 'store'])->name('trucks.store');
Route::get('/trucks/{trucks}/edit', [TrucksController::class, 'edit'])->name('trucks.edit');
Route::put('/trucks/{trucks}/update', [TrucksController::class, 'update'])->name('trucks.update');
Route::delete('/trucks/{trucks}/delete', [TrucksController::class, 'delete'])->name('trucks.delete');

Route::get('/trucks/subunits', [TrucksController::class, 'subunits'])->name('trucks.subunits');
Route::post('/trucks/subunits', [TrucksController::class, 'createsubunit'])->name('trucks.createsubunit');
Route::get('/trucks/subunits/{subunits}/edit', [TrucksController::class, 'editsubunit'])->name('trucks.editsubunit');
Route::put('/trucks/subunits/{subunits}/update', [TrucksController::class, 'updatesubunit'])->name('trucks.updatesubunit');
Route::delete('/trucks/subunits/{subunits}/delete', [TrucksController::class, 'deletesubunit'])->name('trucks.deletesubunit');