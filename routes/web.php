<?php
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Sākumlapa: ja ielogojies, rāda auto sarakstu, ja nē - welcome lapu
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('cars.index');
    }
    return view('welcome');
})->name('home');



Route::get('/dashboard', function () {
    return redirect()->route('cars.index');
})->middleware(['auth', 'verified']);

// Visi maršruti, kuriem vajag būt ielogotam
Route::middleware(['auth'])->group(function () {
    
    // Auto saraksts un vadība
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');

    Route::post('/cars/{car}/check-service', [CarController::class, 'checkService'])->name('cars.check-service');
});


require __DIR__.'/settings.php';