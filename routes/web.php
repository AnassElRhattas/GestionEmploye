<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Routes pour les employés
    Route::resource('employees', EmployeeController::class);
    Route::post('/employees/{employee}/toggle-availability', [EmployeeController::class, 'toggleAvailability'])->name('employees.toggle-availability');
    Route::get('/employees/{employee}/pdf', [EmployeeController::class, 'generatePDF'])->name('employees.pdf');
    
    // Routes pour les missions
    Route::get('/missions', [App\Http\Controllers\MissionController::class, 'index'])->name('missions.index');
    Route::post('/missions', [App\Http\Controllers\MissionController::class, 'store'])->name('missions.store');
    Route::get('/missions/{mission}', [App\Http\Controllers\MissionController::class, 'show'])->name('missions.show');
    Route::get('/missions/{mission}/pdf', [App\Http\Controllers\MissionController::class, 'generatePdf'])->name('missions.pdf');
    Route::patch('/missions/{mission}/status', [App\Http\Controllers\MissionController::class, 'updateStatus'])->name('missions.update-status');
    Route::get('/missions/employees/available', [App\Http\Controllers\MissionController::class, 'getAvailableEmployees'])->name('missions.get-available-employees');
});

require __DIR__.'/auth.php';
