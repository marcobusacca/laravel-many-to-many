<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as DashboardController;

use App\Http\Controllers\Admin\ProjectController as ProjectController;

use App\Http\Controllers\Admin\TypeController as TypeController;

use App\Http\Controllers\Admin\TechnologyController as TechnologyController;

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
    return view('home');
})->name('home');


Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // ADMIN DASHBOARD
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // PROJECTS RESOURCE (INDEX, SHOW, CREATE, STORE, EDIT, UPDATE, DESTROY)
    Route::resource('projects', ProjectController::class);

    // PROJECTS EDIT: DELETE-COVER-IMAGE
    Route::get('/projects/{project}/edit/delete-cover-image', [ProjectController::class, 'deleteCoverImage'])->name('projects.edit.delete-cover-image');

    // TYPES RESOURCE (INDEX, SHOW, CREATE, STORE, EDIT, UPDATE, DESTROY)
    Route::resource('types', TypeController::class);

    // TECHNOLOGIES RESOURCE (INDEX, SHOW, CREATE, STORE, EDIT, UPDATE, DESTROY)
    Route::resource('technologies', TechnologyController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';