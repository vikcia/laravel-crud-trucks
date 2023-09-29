<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrucksController;
use App\Http\Controllers\SubunitsController;

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

Route::get('/trucks/assignsubunits', [SubunitsController::class, 'subunits'])->name('trucks.assignsubunits');
Route::post('/trucks/assignsubunits', [SubunitsController::class, 'createsubunit'])->name('trucks.createsubunit');
Route::get('/trucks/assignsubunits/{subunits}/edit', [SubunitsController::class, 'editsubunit'])->name('trucks.editsubunit');
Route::put('/trucks/assignsubunits/{subunits}/update', [SubunitsController::class, 'updatesubunit'])->name('trucks.updatesubunit');
Route::delete('/trucks/assignsubunits/{subunits}/delete', [SubunitsController::class, 'deletesubunit'])->name('trucks.deletesubunit');