<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Livewire\Auth\Pages\Blocks\DeleteBlock;
use App\Models\Page;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Livewire\Auth\Pages\Projects;
use App\Livewire\Auth\Pages\Blocks\Blocks;
use App\Livewire\Auth\Pages\Create;
use App\Livewire\Auth\Pages\Edit;
use App\Livewire\Auth\Pages\Delete;
use App\Livewire\Auth\Dashboard;

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

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/auth/dashboard', Dashboard::class);
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    //admin pages
    Route::get('auth/pages', \App\Livewire\Auth\Pages\Pages::class)->middleware('auth');
    Route::get('auth/pages/create', Create::class)->middleware('auth');
    Route::get('auth/pages/edit/{id}', Edit::class)->middleware('auth');
    Route::get('auth/pages/delete/{id}', Delete::class)->middleware('auth');

    //admin projects
    Route::get('auth/projects', \App\Livewire\Auth\Projects\Projects::class)->middleware('auth');
    Route::get('auth/projects/create', \App\Livewire\Auth\Projects\Create::class)->middleware('auth');
    Route::get('auth/projects/edit/{id}', \App\Livewire\Auth\Projects\Edit::class)->middleware('auth');
    Route::get('auth/projects/delete/{id}', \App\Livewire\Auth\Projects\Delete::class)->middleware('auth');
    Route::get('auth/projects/sort/{id}', \App\Livewire\Auth\Projects\Sort::class)->middleware('auth');

    //admin menu
    Route::get('auth/menu', \App\Livewire\Auth\Menu\Menu::class)->middleware('auth');
    Route::get('auth/menu/create', \App\Livewire\Auth\Menu\Create::class)->middleware('auth');
    Route::get('auth/menu/edit/{id}', \App\Livewire\Auth\Menu\Edit::class)->middleware('auth');
    Route::get('auth/menu/delete/{id}', \App\Livewire\Auth\Menu\Delete::class)->middleware('auth');

    ////admin page blocks
    Route::get('auth/pages/blocks/{id}/block-type', \App\Livewire\Auth\Pages\Blocks\ChooseBlock::class)->middleware('auth');
    Route::get('auth/pages/blocks/{id}', Blocks::class)->middleware('auth');
    Route::get('auth/pages/blocks/delete/{id}', DeleteBlock::class)->middleware('auth');


//blocks routes



//frondend routes

    Route::get('/', function () {
        $page = Page::where('route', 'index')->first();
        $menu_items = \App\Models\MenuItems::orderBy('order_id', 'asc')->get();
        view()->share(['page' => $page, 'menu_items' => $menu_items]);
        return view('livewire.frontend.index.index');
    });

    Route::get('/{locale?}', function (string $locale) {
        $page = Page::where('route', $locale)->first();
        $menu_items = \App\Models\MenuItems::orderBy('order_id', 'asc')->get();
        view()->share(['page' => $page, 'menu_items' => $menu_items]);
        return view("livewire.frontend.$page->page_type.index");
    });

    Route::get('/{locale?}/{slug}', function (string $locale, string $slug) {
        $page = Page::where('route', $locale)->first();
        $project = \App\Models\Project::where('friendly_route', $slug)->first();
        $menu_items = \App\Models\MenuItems::orderBy('order_id', 'asc')->get();
        view()->share(['page' => $page, 'project' => $project, 'menu_items' => $menu_items]);
        return view('livewire.frontend.projectDetail.index');
    });

