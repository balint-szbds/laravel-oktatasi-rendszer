<?php

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

/*Route::get('/', function () {
    return view('home', ['name' => 'James']);
});*/

// Az útvonalakat az alábbi paranccsal tudod kilistázni:
//  php artisan route:list

Route::redirect('/', '/home');


// Kapcsolat
Route::get('/kapcsolat', 'KapcsolatController@All')->name('kapcsolat');

// User kiíratás
Route::get( '/users',                      'UserListController@indexAll'   )    ->name('users-list');
//Route::get( '/user/{id}',                  'UserListController@indexItem'  )    ->name('user-list');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profil/{id}', 'UserListController@profil')->name('profil');

// Új tárgy hozzáadása
Route::get( '/add-targy',                   'TargyController@indexAdd'   )     ->name('add-targy');
Route::post('/add-targy',                   'TargyController@store'      )     ->name('store-targy');

// Tárgy publikálása
Route::get( '/home/{id}',                   'TargyController@publikal'   )     ->name('publikal');

// Tárgy részletei
Route::get( '/targy-reszletei/{id}',        'TargyController@reszletek'   )     ->name('reszletek');

// Tárgy felvétele
Route::get( '/public-targyak',                'TargyController@listAll'      )     ->name('all-targy');
Route::get('/apply-targy/{id}',              'TargyController@indexApply'   )   ->name('apply-targy');

// Tárgy módosítása
Route::get( '/edit-targy/{id}',             'TargyController@indexEdit'   )     ->name('edit-targy');
Route::post('/edit-targy/{id}',             'TargyController@update'      )     ->name('update-targy');

// Tárgy törlése
Route::get( '/delete-targy',                'TargyController@indexDelete' )     ->name('delete-targy');
Route::post('/delete-targy/{id}',           'TargyController@delete'      )     ->name('delete-targy-post');

// Feladat létrehozása
Route::get( '/add-feladat/{id}',                   'FeladatController@indexAdd'   )     ->name('add-feladat');
Route::post('/add-feladat/{id}',                   'FeladatController@store'      )     ->name('store-feladat');

// Feladat részletei
Route::get( '/feladat-reszletei/{id}',        'FeladatController@reszletek'   )     ->name('feladat-reszletek');

// Feladat módosítása
Route::get( '/edit-feladat/{id}',             'FeladatController@indexEdit'   )     ->name('edit-feladat');
Route::post('/edit-feladat/{id}',             'FeladatController@update'      )     ->name('update-feladat');

// Feladatok listája
Route::get('/feladatok-listaja',                'FeladatController@list'      )      ->name('feladataim');

// Feladat megoldása
Route::get( '/solve-feladat/{id}',                              'FeladatController@indexSolve'        )     ->name('megold-feladat');
Route::post('/solve-feladat/{feladatid}/{diakid}',             'FeladatController@storeSolution'      )     ->name('store-megoldas');

// Megoldás letöltése
Route::get( '/letolt/{id}',                              'FeladatController@indexDownload'            )     ->name('megold-letolt');

//Megoldás értékelése
Route::get( '/megoldas-ertekeles/{id}',             'FeladatController@indexGrade'                    )     ->name('megold-ertekel');
Route::post('/megoldas-ertekeles/{id}',             'FeladatController@updateSolution'                )     ->name('update-megold');
