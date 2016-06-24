<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * Pagrindinis puslapis
 */

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home',
]);

/*
 * Prisijungimas, registracija ir atsijungimas
 */

Route::get('/prisijungti', [
    'uses' => 'AuthController@getLogin',
    'as' => 'auth.login',
    'middleware' => ['guest'],
]);

Route::post('/prisijungti', [
    'uses' => 'AuthController@postLogin',
    'middleware' => ['guest'],
]);

Route::get('/registracija', [
    'uses' => 'AuthController@getRegister',
    'as' => 'auth.register',
    'middleware' => ['guest'],
]);

Route::post('/registracija', [
    'uses' => 'AuthController@postRegister',
    'middleware' => ['guest'],
]);

Route::get('/atsijungti', [
    'uses' => 'AuthController@getLogout',
    'as' => 'auth.logout',
    'middleware' => ['auth'],
]);

/*
 * Užsakymų sąrašai bei jų tvarkymas
 */

Route::get('/uzsakymu-sarasas', [
    'uses' => 'OrdersController@getOrdersList',
    'as' => 'order.list',
    'middleware' => ['auth'],
]);

Route::get('/naujas-uzsakymas', [
    'uses' => 'OrdersController@getNewOrder',
    'as' => 'order.new',
    'middleware' => ['auth'],
]);

Route::post('/naujas-uzsakymas', [
    'uses' => 'OrdersController@postNewOrder',
    'middleware' => ['auth'],
]);

Route::get('/trinti-uzsakyma/{id}', [
    'uses' => 'OrdersController@postDeleteOrder',
    'as' => 'order.delete',
    'middleware' => ['auth'],
]);

Route::post('/trinti-uzsakyma/{id}', [
    'uses' => 'OrdersController@postDeleteOrder',
    'middleware' => ['auth'],
]);

Route::get('/redaguoti-uzsakyma/{id}', [
    'uses' => 'OrdersController@getEditOrder',
    'as' => 'order.edit',
    'middleware' => ['auth'],
]);

Route::post('/redaguoti-uzsakyma/{id}', [
    'uses' => 'OrdersController@postEditOrder',
    'middleware' => ['auth'],
]);

Route::get('/trinti-preke/{id}', [
    'uses' => 'OrdersController@postDeleteItem',
    'as' => 'order.delete.item',
    'middleware' => ['auth'],
]);

Route::post('/trinti-preke/{id}', [
    'uses' => 'OrdersController@postDeleteItem',
    'middleware' => ['auth'],
]);