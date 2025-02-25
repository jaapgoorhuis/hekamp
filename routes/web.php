<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Livewire\Auth\Pages\Blocks\Blocks;
use App\Livewire\Auth\Pages\Blocks\ChooseBlock;
use App\Livewire\Auth\Pages\Blocks\DeleteBlock;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Livewire\Auth\Pages\Create;
use App\Livewire\Auth\Pages\Edit;
use App\Livewire\Auth\Pages\Delete;
use App\Livewire\Auth\Dashboard;
use Livewire\Livewire;
use \Spatie\LivewireFilepond\WithFilePond;

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

Livewire::setScriptRoute(function ($handle) {
    return Route::get('public/vendor/livewire/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('vendor/livewire/update', $handle);
});


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

    Route::get('auth/categories', \App\Livewire\Auth\Categories\Categories::class)->middleware('auth');
    Route::get('auth/categories/create', \App\Livewire\Auth\Categories\Create::class)->middleware('auth');
    Route::get('auth/categories/edit/{id}', \App\Livewire\Auth\Categories\Edit::class)->middleware('auth');
    Route::get('auth/categories/delete/{id}', \App\Livewire\Auth\Categories\Delete::class)->middleware('auth');


    ////admin sub categories
    Route::get('auth/categories/{id}/subcategories', \App\Livewire\Auth\Categories\SubCategories\SubCategories::class)->middleware('auth');
    Route::get('auth/categories/{id}/subcategories/create', \App\Livewire\Auth\Categories\SubCategories\Create::class)->middleware('auth');
    Route::get('auth/categories/{id}/subcategories/edit/{slug}', \App\Livewire\Auth\Categories\SubCategories\Edit::class)->middleware('auth');
    Route::get('auth/categories/{id}/subcategories/delete/{slug}', \App\Livewire\Auth\Categories\SubCategories\Delete::class)->middleware('auth');

    //admin sub categories
    Route::get('auth/categories/{id}/subcategories/{slug}/products', \App\Livewire\Auth\Categories\SubCategories\Products\Products::class)->middleware('auth');
    Route::get('auth/categories/{categoryid}/subcategories/{subcategoryid}/products/create', \App\Livewire\Auth\Categories\SubCategories\Products\Create::class)->middleware('auth');
    Route::get('auth/categories/{categoryid}/subcategories/{subcategoryid}/products/edit/{id}', \App\Livewire\Auth\Categories\SubCategories\Products\Edit::class)->middleware('auth');
    Route::get('auth/categories/{categoryid}/subcategories/{subcategoryid}/products/delete/{id}', \App\Livewire\Auth\Categories\SubCategories\Products\Delete::class)->middleware('auth');

    //admin menu
    Route::get('auth/menu', \App\Livewire\Auth\Menu\Menu::class)->middleware('auth');
    Route::get('auth/menu/create', \App\Livewire\Auth\Menu\Create::class)->middleware('auth');
    Route::get('auth/menu/edit/{id}', \App\Livewire\Auth\Menu\Edit::class)->middleware('auth');
    Route::get('auth/menu/delete/{id}', \App\Livewire\Auth\Menu\Delete::class)->middleware('auth');

    //admin search
    Route::get('auth/search', \App\Livewire\Auth\Search\Search::class)->middleware('auth');
    Route::get('auth/search/create', \App\Livewire\Auth\Search\Create::class)->middleware('auth');
    Route::get('auth/search/edit/{id}', \App\Livewire\Auth\Search\Edit::class)->middleware('auth');
    Route::get('auth/search/delete/{id}', \App\Livewire\Auth\Search\Delete::class)->middleware('auth');

    ////admin page blocks
    Route::get('auth/pages/blocks/{id}/block-type', \App\Livewire\Auth\Pages\Blocks\ChooseBlock::class)->middleware('auth');
    Route::get('auth/pages/blocks/{id}', Blocks::class)->middleware('auth');
    Route::get('auth/pages/blocks/delete/{id}', DeleteBlock::class)->middleware('auth');


    //account routes
    Route::get('auth/account', \App\Livewire\Auth\Account\Account::class)->middleware('auth');

    //download routes
    Route::get('auth/downloads', \App\Livewire\Auth\Download\Download::class)->middleware('auth');

    //site routes
    Route::get('auth/site', \App\Livewire\Auth\Site\Site::class)->middleware('auth');
//blocks routes


    //always redirect to index
    Route::get('/', function () {
        $locale = App::getLocale();
        return redirect($locale.'/index');
    });

    //redirect to the right locale
    Route::get('/{slug?}', function (string $slug) {

        $locale = App::getLocale();
        if(count(Page::where('route', $slug)->get())) {
            return redirect($locale . '/' . $slug);
        } else {
            return redirect($locale . '/index');
        }
    });

    Route::any('/{locale}/{slug}/{route?}', function (string $locale, string $slug, string $route = null) {

        if (! in_array($locale, ['de', 'nl', 'en'])) {
            return redirect('nl/'.$slug);
        }

        //op de een of andere manier de route doorsturen naar een view voor subpagina's
        //wanneer is de route een category?
        App::setLocale($locale);
        $authUser = User::find(Auth::id());
        $page = Page::where('route', $slug)->first();
        $isSubCategory = \App\Models\SubCategorie::where('route',$route)->first();
        $settings = \App\Models\Site::find(1);

        $menu_items = \App\Models\MenuItems::orderBy('order_id', 'asc')->get();
        $siteSettings = \App\Models\Site::find(1);
        $categories = \App\Models\Categorie::orderBy('order_id', 'asc')->get();
        $downloads = \Spatie\MediaLibrary\MediaCollections\Models\Media::where('collection_name', 'downloads')->orderBy('order_column', 'asc')->get();
        $subcategories = \App\Models\SubCategorie::where('show_home', '1')->orderBy('order_id', 'asc')->get();
        view()->share(['page' => $page, 'authUser' => $authUser, 'settings' => $settings, 'menu_items' => $menu_items, 'categories' => $categories, 'slug' => $slug, 'route' => $route, 'locale' => $locale, 'site_settings'=> $siteSettings, 'downloads' => $downloads, 'subcategories' => $subcategories]);

        if($page) {
            $view = $page->page_type;
        } elseif($isSubCategory) {
            $view = 'subcategories';
        } elseif($slug == 'search') {
            $view = 'search';
        } else {
            $view = 'index';
        }

        return view('livewire.frontend.'.$view.'.index');

    })->name('search');


