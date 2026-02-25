<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('note', [NoteController::class, 'index'])->name('note.index');
    Route::get('note/create', [NoteController::class, 'create'])->name('note.create');
    Route::post('note', [NoteController::class, 'store'])->name('note.store');
    Route::get('note/{note}/edit', [NoteController::class, 'edit'])->name('note.edit');
    Route::put('note/{note}', [NoteController::class, 'update'])->name('note.update');
    Route::delete('note/{note}', [NoteController::class, 'destroy'])->name('note.destroy');
});

require __DIR__ . '/settings.php';
