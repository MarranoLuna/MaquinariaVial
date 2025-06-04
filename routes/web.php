<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConstructionController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MachineTypeController;
use App\Http\Controllers\AssignmentController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php'; // Rutas de autenticación de Breeze

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('obras', ConstructionController::class);

    Route::resource('maquinas', MachineController::class);

    Route::resource('asignaciones', AssignmentController::class);

    Route::resource('services', ServiceController::class);

    Route::resource('tipos-maquina', MachineTypeController::class)->parameters(['tipos-maquina' => 'machineType'])->names('machine_types');

    Route::get('/asignaciones/{assignment}/finalizar-formulario', [AssignmentController::class, 'showFinalizeForm'])->name('asignaciones.showFinalizeForm');
    Route::patch('/asignaciones/{assignment}/finalizar-proceso', [AssignmentController::class, 'processFinalization'])->name('asignaciones.processFinalization');
  
    Route::get('/test-finalizar-asignacion/{assignment}', [AssignmentController::class, 'testFinalize'])->name('test.finalizeAssignment');
    
    Route::patch('/obras/{obra}/finalize', [ConstructionController::class, 'finalize'])->name('obras.finalize');
});