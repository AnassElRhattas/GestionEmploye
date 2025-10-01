<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use App\Models\CustomChoice;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::delete('/missions/{mission}', [App\Http\Controllers\MissionController::class, 'destroy'])->name('missions.destroy');
    Route::get('/missions/{mission}/pdf', [App\Http\Controllers\MissionController::class, 'generatePdf'])->name('missions.pdf');
    Route::patch('/missions/{mission}/status', [App\Http\Controllers\MissionController::class, 'updateStatus'])->name('missions.update-status');
    Route::get('/missions/employees/available', [App\Http\Controllers\MissionController::class, 'getAvailableEmployees'])->name('missions.get-available-employees');

    // Endpoint AJAX: création instantanée d'un choix personnalisé
    Route::post('/custom-choices', function (Request $request) {
        $validated = $request->validate([
            'type' => 'required|in:culture,specialite',
            'value' => 'required|string|max:255',
        ]);

        $choice = CustomChoice::firstOrCreate([
            'type' => $validated['type'],
            'value' => trim($validated['value']),
        ]);

        return response()->json(['id' => $choice->id, 'type' => $choice->type, 'value' => $choice->value]);
    })->name('custom-choices.store');
    // WhatsApp management
    Route::get('/whatsapp', [WhatsAppController::class, 'index'])->name('whatsapp.index');
    Route::get('/whatsapp/status', [WhatsAppController::class, 'status'])->name('whatsapp.status');
    Route::get('/whatsapp/qrcode', [WhatsAppController::class, 'qrcode'])->name('whatsapp.qrcode');
    Route::post('/whatsapp/employees/{employee}/send', [WhatsAppController::class, 'sendToEmployee'])->name('whatsapp.send.employee');
    Route::post('/whatsapp/send-bulk', [WhatsAppController::class, 'sendBulk'])->name('whatsapp.send.bulk');
});

require __DIR__.'/auth.php';
