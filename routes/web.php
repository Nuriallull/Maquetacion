<?php

use Illuminate\Support\Facades\Route;
use App\Vendor\Locale\LocalizationSeo;

$localizationseo = new LocalizationSeo();

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function () {

    Route::get('/informacion-de-la-empresa', 'App\Http\Controllers\Admin\BusinessInformationController@index')->name('business_information');
    Route::post('/informacion-de-la-empresa', 'App\Http\Controllers\Admin\BusinessInformationController@store')->name('business_information_store');

    Route::get('/seo/sitemap', 'App\Http\Controllers\Admin\LocaleSeoController@getSitemaps')->name('create_sitemap');
    Route::get('/seo/import', 'App\Http\Controllers\Admin\LocaleSeoController@importSeo')->name('seo_import');
    Route::get('/seo/{key}', 'App\Http\Controllers\Admin\LocaleSeoController@edit')->name('seo_edit');
    Route::get('/seo', 'App\Http\Controllers\Admin\LocaleSeoController@index')->name('seo');
    Route::post('/seo', 'App\Http\Controllers\Admin\LocaleSeoController@store')->name('seo_store');
    Route::get('/ping-google', 'App\Http\Controllers\Admin\LocaleSeoController@pingGoogle')->name('ping_google');

    Route::get('/image/delete/{image?}', 'App\Vendor\Image\Image@destroy')->name('delete_image');
    Route::get('/image/{image}', 'App\Vendor\Image\Image@show')->name('show_image_seo');
    Route::post('/image/seo', 'App\Vendor\Image\Image@storeSeo')->name('store_image_seo');

    Route::get('/menus/item/index/{language?}/{item?}', 'App\Http\Controllers\Admin\MenuItemController@index')->name('menus_item_index');
    Route::get('/menus/item/create/{language?}', 'App\Http\Controllers\Admin\MenuItemController@create')->name('menus_item_create');
    Route::delete('/menus/item/delete/{item?}', 'App\Http\Controllers\Admin\MenuItemController@destroy')->name('menus_item_destroy');
    Route::get('/menus/item/edit/{item?}', 'App\Http\Controllers\Admin\MenuItemController@edit')->name('menus_item_edit');
    Route::post('/menus/item/store', 'App\Http\Controllers\Admin\MenuItemController@store')->name('menus_item_store'); 
    Route::post('/menus/item/reordermenu', 'App\Http\Controllers\Admin\MenuItemController@orderItem')->name('menus_reorder');
    
    Route::resource('menus', 'App\Http\Controllers\Admin\MenuController', [
        'names' => [
            'index' => 'menus',
            'create' => 'menus_create',
            'store' => 'menus_store',
            'destroy' => 'menus_destroy',
            'edit' => 'menus_edit',
        ]
    ]);


    Route::get('/traductions', 'App\Http\Controllers\Admin\LocaleTagController@index')->name('traductions');
    Route::get('/traductions/{group}/{key}', 'App\Http\Controllers\Admin\LocaleTagController@edit')->name('traductions_edit');
    Route::post('/traductions', 'App\Http\Controllers\Admin\LocaleTagController@store')->name('traductions_store');
    Route::get('/traductions/filter/{filters?}', 'App\Http\Controllers\Admin\LocaleTagController@filter')->name('traductions_filter');
    Route::get('/traductions/import', 'App\Http\Controllers\Admin\LocaleTagController@importTags')->name('traductions_import');

    Route::resource('faqs/categorias', 'App\Http\Controllers\Admin\FaqCategoryController', [
        'parameters' => [
            'categorias' => 'faq_category', 
        ],
        'names' => [
            'index' => 'faqs_categories',
            'create' => 'faqs_categories_create',
            'edit' => 'faqs_categories_edit',
            'store' => 'faqs_categories_store',
            'destroy' => 'faqs_categories_destroy',
            'show' => 'faqs_categories_show',
        ]
    ]);
    
    /* Hacemos la llamada tipo get en vez de post para filtros paginados, pasamos los datos
    por la variable {filters?}*/

    Route::get('/faqs/filter/{filters?}', 'App\Http\Controllers\Admin\FaqController@filter')->name('faqs_filter');
    Route::resource('faqs', 'App\Http\Controllers\Admin\FaqController', [
        'names' => [
            'index' => 'faqs',
            'create' => 'faqs_create',
            'edit' => 'faqs_edit',
            'store' => 'faqs_store',
            'destroy' => 'faqs_destroy',
            'show' => 'faqs_show',
        ]
    ]);
    
    Route::resource('usuarios', 'App\Http\Controllers\Admin\UserController', [
        'parameters' => [
            'usuarios' => 'user', 
        ],
        'names' => [
            'index' => 'users',
            'create' => 'users_create',
            'edit' => 'users_edit',
            'store' => 'users_store',
            'destroy' => 'users_destroy',
            'show' => 'users_show',
        ]
    ]);


    Route::resource('clientes', 'App\Http\Controllers\Admin\ClientController', [
        'parameters' => [
            'clientes' => 'client', 
        ],
        'names' => [
            'index' => 'clients',
            'create' => 'clients_create',
            'edit' => 'clients_edit',
            'store' => 'clients_store',
            'destroy' => 'clients_destroy',
            'show' => 'clients_show',
        ]
    ]);


    Route::get('/sliders/filter/{filters?}', 'App\Http\Controllers\Admin\SliderController@filter')->name('sliders_filter');

    Route::resource('sliders', 'App\Http\Controllers\Admin\SliderController', [
        'parameters' => [
            'sliders' => 'slider', 
        ],
        'names' => [
            'index' => 'sliders',
            'create' => 'sliders_create',
            'edit' => 'sliders_edit',
            'store' => 'sliders_store',
            'destroy' => 'sliders_destroy',
            'show' => 'sliders_show',
        ]
    ]);
    
    
    Route::resource('muebles/categories', 'App\Http\Controllers\Admin\MueblesCategoryController', [
        'parameters' => [
            'categories' => 'muebles_category', 
        ],
        'names' => [
            'index' => 'muebles_categories',
            'create' => 'muebles_categories_create',
            'edit' => 'muebles_categories_edit',
            'store' => 'muebles_categories_store',
            'destroy' => 'muebles_categories_destroy',
            'show' => 'muebles_categories_show',
        ]
    ]);

    Route::get('/muebles/filter/{filters?}', 'App\Http\Controllers\Admin\MuebleController@filter')->name('muebles_filter');
    Route::resource('muebles', 'App\Http\Controllers\Admin\MuebleController', [
        'parameters' => [
            'muebles' => 'mueble', 
        ],
        'names' => [
            'index' => 'muebles',
            'create' => 'muebles_create',
            'edit' => 'muebles_edit',
            'store' => 'muebles_store',
            'destroy' => 'muebles_destroy',
            'show' => 'muebles_show',
        ]
    ]);

});

Route::post('/contacto', 'App\Http\Controllers\Front\ContactController@send')->name('front_contact_form');

Route::group(['prefix' => $localizationseo->setLocale(),
              'middleware' => [ 'localize' ]
            ], function () use ($localizationseo) {

    Route::get($localizationseo->transRoute('routes.front_faqs'), 'App\Http\Controllers\Front\FaqController@index')->name('front_faqs');
    Route::get($localizationseo->transRoute('routes.front_faq'), 'App\Http\Controllers\Front\FaqController@show')->name('front_faq');
    Route::get($localizationseo->transRoute('routes.front_muebles'), 'App\Http\Controllers\Front\MuebleController@index')->name('front_muebles');
    Route::get($localizationseo->transRoute('routes.front_mueble'), 'App\Http\Controllers\Front\MuebleController@show')->name('front_mueble');
    Route::get($localizationseo->transRoute('routes.front_contact'), 'App\Http\Controllers\Front\ContactController@index')->name('front_contact');
    Route::get($localizationseo->transRoute('routes.front_about_us'), 'App\Http\Controllers\Front\AboutUsController@index')->name('front_about_us');
    Route::get($localizationseo->transRoute('routes.front_home'), 'App\Http\Controllers\Front\HomeController@index')->name('front_home');           
});

Route::post('/contacto', 'App\Http\Controllers\Front\ContactController@store')->name('front_contact_form');
Route::get('/traduccion/{language}/{parent}/{slug?}', 'App\Http\Controllers\Front\LocalizationController@show')->name('front_localization');

Route::post('/fingerprint', 'App\Http\Controllers\Front\FingerPrintController@store')->name('front_fingerprint');
Route::get('/login', 'App\Http\Controllers\Front\LoginController@index')->name('login');
Route::post('/login', 'App\Http\Controllers\Front\LoginController@login')->name('front_login_submit');
Route::get('/faqs', 'App\Http\Controllers\Front\FaqController@index')->name('faqs_front');
Route::get('/muebles', 'App\Http\Controllers\Front\MuebleController@index')->name('muebles_front');
