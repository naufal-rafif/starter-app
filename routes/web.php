<?php

use App\Livewire\Page\Blog\Detail as BlogDetail;
use App\Livewire\Page\Project\Detail as ProjectDetail;
use App\Livewire\Page\Home;
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

Route::get('/', Home::class)->name('app.home');
Route::get('/project/{project:slug}', ProjectDetail::class)->name('app.project.details');
Route::get('/blog/{blog:slug}', BlogDetail::class)->name('app.blog.details');