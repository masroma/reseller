<?php

use Illuminate\Support\Facades\Route;

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
Route::get('', 'HomeController@index')->name('home');
Route::get('product', 'ProductController@index')->name('product');
Route::get('detail-product/{slug}', 'ProductController@detail')->name('product-detail');
Route::get('keranjang-belanja', 'CartController@index')->name('keranjang-belanja');
Route::post('tambah-keranjang','CartController@store')->name('tambah-keranjang');
Route::post('update-keranjang','CartController@update')->name('update-keranjang');
Route::get('hapus-keranjang/{id}','CartController@destroy')->name('hapus-keranjang');
Route::get('checkout', 'CartController@checkout')->name('checkout');
Route::get('province', 'CartController@get_province')->name('province');
Route::get('kota/{id}', 'CartController@get_city')->name('kota');
Route::get('/origin={city_origin}&destination={city_destination}&weight={weight}&courier={courier}','CartController@get_ongkir');
Route::post('proses-transaksi','CartController@prosesTransaksi')->name('proses-transaksi');
Route::get('sukses-transaksi', 'CartController@suksesTransaksi')->name('sukses-transaksi');
Route::get('sendemail', 'CartController@sendEmail')->name('sendemail');


// webcompro
Route::get(
    '/detail-program/{id}',
    [
        'uses' => 'HomeController@detail',
        'as' => 'detailprogram'
    ]
);

Route::get(
    '/detail-info/{id}',
    [
        'uses' => 'HomeController@detailBanner',
        'as' => 'detailbanner'
    ]
);

Route::get(
    '/tentang-kami',
    [
        'uses' => 'TentangKamiController@index',
        'as' => 'tentang-kami'
    ]
);
Route::get(
    '/tentang-kami/detail/{id}',
    [
        'uses' => 'TentangKamiController@detail',
        'as' => 'tentangkami-detail'
    ]
);

// GET BERITA SLUG
Route::get(
    '/berita/detail/{slug}',
    [
        'uses' => 'BeritaController@detail',
        'as' => 'detailberita'
    ]
);

// GET AGENDA SLUG
Route::get(
    '/agenda/detail/{slug}',
    [
        'uses' => 'AgendaController@detail',
        'as' => 'detailagenda'
    ]
);

Route::get(
    '/kontak',
    [
        'uses' => 'KontakController@index',
        'as' => 'kontak'
    ]
);


Route::prefix('berita')->group(
    function () {
        Route::get(
            '/',
            [
                'uses' => 'BeritaController@index',
                'as' => 'berita'
            ]
        );
        Route::get(
            '/{slug}',
            [
                'uses' => 'BeritaController@detail',
                'as' => 'detailberita'
            ]
        );
    });

    Route::prefix('agenda')->group(
        function () {
            Route::get(
                '/',
                [
                    'uses' => 'AgendaController@index',
                    'as' => 'agenda'
                ]
            );
            Route::get(
                '/{slug}',
                [
                    'uses' => 'AgendaController@detail',
                    'as' => 'detailagenda'
                ]
            );
        });




// admin

Route::prefix('admin')->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::prefix('dashboard')->group(function () {
            Route::get(
                '/',
                [
                    'uses' => 'Admin\DashboardController@index',
                    'as' => 'dashboard.index'
                ]
            );
            Route::get(
                '/data',
                [
                    'uses' => 'Admin\DashboardController@data',
                    'as' => 'dashboard.data'
                ]
            );
        });

        Route::prefix('transaksi')->group(function () {
            Route::get(
                '/detail/{id}',
                [
                    'uses' => 'Admin\DashboardController@detailTransaksi',
                    'as' => 'transaksi.detail'
                ]
            );
        });

        Route::prefix('user')->group(
            function () {
                Route::get(
                    '/data',
                    [
                        'uses' => 'Admin\UserController@data',
                        'as' => 'user.data'
                    ]
                );
                Route::get(
                    '/',
                    [
                        'uses' => 'Admin\UserController@index',
                        'as' => 'user.index'
                    ]
                );
                Route::get(
                    '/create',
                    [
                        'uses' => 'Admin\UserController@create',
                        'as' => 'user.create'
                    ]
                );
                Route::post(
                    '/store',
                    [
                        'uses' => 'Admin\UserController@store',
                        'as' => 'user.store'
                    ]
                );
                Route::get(
                    '/{id}/edit',
                    [
                        'uses' => 'Admin\UserController@edit',
                        'as' => 'user.edit'
                    ]
                );
                Route::post(
                    '/update/{id}',
                    [
                        'uses' => 'Admin\UserController@update',
                        'as' => 'user.update'
                    ]
                );
                Route::get(
                    '/editprofile',
                    [
                        'uses' => 'Admin\UserController@editprofile',
                        'as' => 'user.editprofile'
                    ]
                );
                Route::post(
                    '/updateprofile/{id}',
                    [
                        'uses' => 'Admin\UserController@proseseditprofile',
                        'as' => 'user.updateprofile'
                    ]
                );
                Route::get(
                    '/{id}/delete',
                    [
                        'uses' => 'Admin\UserController@destroy',
                        'as' => 'user.destroy'
                    ]
                );
            }
        );

        Route::prefix('banner')->group(
            function () {
                Route::get(
                    '/data',
                    [
                        'uses' => 'Admin\BannerController@data',
                        'as' => 'banner.data'
                    ]
                );
                Route::get(
                    '/',
                    [
                        'uses' => 'Admin\BannerController@index',
                        'as' => 'banner.index'
                    ]
                );
                Route::get(
                    '/create',
                    [
                        'uses' => 'Admin\BannerController@create',
                        'as' => 'banner.create'
                    ]
                );
                Route::post(
                    '/store',
                    [
                        'uses' => 'Admin\BannerController@store',
                        'as' => 'banner.store'
                    ]
                );
                Route::get(
                    '/{id}/edit',
                    [
                        'uses' => 'Admin\BannerController@edit',
                        'as' => 'banner.edit'
                    ]
                );
                Route::post(
                    '/update/{id}',
                    [
                        'uses' => 'Admin\BannerController@update',
                        'as' => 'banner.update'
                    ]
                );

                Route::get(
                    '/{id}/delete',
                    [
                        'uses' => 'Admin\BannerController@destroy',
                        'as' => 'banner.destroy'
                    ]
                );
            }
        );

        Route::prefix('berita')->group(
            function () {
                Route::get(
                    '/data',
                    [
                        'uses' => 'Admin\BeritaController@data',
                        'as' => 'berita.data'
                    ]
                );
                Route::get(
                    '/',
                    [
                        'uses' => 'Admin\BeritaController@index',
                        'as' => 'berita.index'
                    ]
                );
                Route::get(
                    '/create',
                    [
                        'uses' => 'Admin\BeritaController@create',
                        'as' => 'berita.create'
                    ]
                );
                Route::post(
                    '/store',
                    [
                        'uses' => 'Admin\BeritaController@store',
                        'as' => 'berita.store'
                    ]
                );
                Route::get(
                    '/{id}/edit',
                    [
                        'uses' => 'Admin\BeritaController@edit',
                        'as' => 'berita.edit'
                    ]
                );
                Route::post(
                    '/update/{id}',
                    [
                        'uses' => 'Admin\BeritaController@update',
                        'as' => 'berita.update'
                    ]
                );

                Route::get(
                    '/{id}/delete',
                    [
                        'uses' => 'Admin\BeritaController@destroy',
                        'as' => 'berita.destroy'
                    ]
                );
            }
        );

        Route::prefix('agenda')->group(
            function () {
                Route::get(
                    '/data',
                    [
                        'uses' => 'Admin\AgendaController@data',
                        'as' => 'agenda.data'
                    ]
                );
                Route::get(
                    '/',
                    [
                        'uses' => 'Admin\AgendaController@index',
                        'as' => 'agenda.index'
                    ]
                );
                Route::get(
                    '/create',
                    [
                        'uses' => 'Admin\AgendaController@create',
                        'as' => 'agenda.create'
                    ]
                );
                Route::post(
                    '/store',
                    [
                        'uses' => 'Admin\AgendaController@store',
                        'as' => 'agenda.store'
                    ]
                );
                Route::get(
                    '/{id}/edit',
                    [
                        'uses' => 'Admin\AgendaController@edit',
                        'as' => 'agenda.edit'
                    ]
                );
                Route::post(
                    '/update/{id}',
                    [
                        'uses' => 'Admin\AgendaController@update',
                        'as' => 'agenda.update'
                    ]
                );

                Route::get(
                    '/{id}/delete',
                    [
                        'uses' => 'Admin\AgendaController@destroy',
                        'as' => 'agenda.destroy'
                    ]
                );
            }
        );

        Route::prefix('tentangkami')->group(
            function () {

                Route::get(
                    '/',
                    [
                        'uses' => 'Admin\TentangKamiController@index',
                        'as' => 'tentangkami.index'
                    ]
                );


                Route::post(
                    '/update',
                    [
                        'uses' => 'Admin\TentangKamiController@update',
                        'as' => 'tentangkami.update'
                    ]
                );


            }
        );

        Route::prefix('profile')->group(
            function () {

                Route::get(
                    '/',
                    [
                        'uses' => 'Admin\ProfileController@index',
                        'as' => 'profile.index'
                    ]
                );


                Route::post(
                    '/update',
                    [
                        'uses' => 'Admin\ProfileController@update',
                        'as' => 'profile.update'
                    ]
                );


            }
        );

        Route::prefix('program')->group(
            function () {
                Route::get(
                    '/data',
                    [
                        'uses' => 'Admin\ProgramController@data',
                        'as' => 'program.data'
                    ]
                );
                Route::get(
                    '/',
                    [
                        'uses' => 'Admin\ProgramController@index',
                        'as' => 'program.index'
                    ]
                );
                Route::get(
                    '/create',
                    [
                        'uses' => 'Admin\ProgramController@create',
                        'as' => 'program.create'
                    ]
                );
                Route::post(
                    '/store',
                    [
                        'uses' => 'Admin\ProgramController@store',
                        'as' => 'program.store'
                    ]
                );
                Route::get(
                    '/{id}/edit',
                    [
                        'uses' => 'Admin\ProgramController@edit',
                        'as' => 'program.edit'
                    ]
                );
                Route::post(
                    '/update/{id}',
                    [
                        'uses' => 'Admin\ProgramController@update',
                        'as' => 'program.update'
                    ]
                );

                Route::get(
                    '/{id}/delete',
                    [
                        'uses' => 'Admin\ProgramController@destroy',
                        'as' => 'program.destroy'
                    ]
                );
            }
        );
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
