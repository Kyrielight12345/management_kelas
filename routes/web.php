<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapController;
use Illuminate\Support\Facades\Route;
use App\Livewire\KelasList;
use App\Livewire\GuruList;
use App\Livewire\Listall;
use App\Livewire\Listguru;
use App\Livewire\Listsiswa;
use App\Livewire\SiswaList;
use App\Livewire\RekapList;

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

    Route::get('/Listkelas', KelasList::class)->name('list.kelas');
    Route::get('/Listguru', GuruList::class)->name('list.guru');
    Route::get('/Listsiswa', SiswaList::class)->name('list.siswa');
    Route::get('/tampilan-per-kelas', RekapList::class)->name('tampilan.per.kelas');
    Route::get('/siswa-per-kelas', Listsiswa::class)->name('tampilan.list.siswa');
    Route::get('/guru-per-kelas', Listguru::class)->name('tampilan.list.guru');
    Route::get('/tampilan-all-kelas', Listall::class)->name('tampilan.list.all');
});
require __DIR__ . '/auth.php';
