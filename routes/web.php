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
  use App\Video;

  Route::get('/', 'HomeController@index')->name('home');


Auth::routes();


Route::get('criar-video',[
    'as' => 'createvideo',
    'middleware' =>'auth',
    'uses' => 'VideoController@createVideo'
    ]);

Route::get('buscarvideo/{buscar?}',[
    'as' => 'searchvideo',
    'uses' => 'VideoController@searchVideo'
    ]);

Route::post('salvar-video',[
    'as' => 'saveVideo',
    'middleware' =>'auth',
    'uses' => 'VideoController@saveVideo'
    ]);

    Route::get('thumbnail/{filename}',array(
        'as' =>'imagevideo',
        'middleware' =>'auth',
        'uses' =>'VideoController@getImage'
    ));
 
    Route::get('/mostrarvideo/{videoid}',array(
        'as' =>'mostrarvideo',
        'uses' =>'VideoController@mostrarVideo'
    ));
    Route::get('/video-file/{filename}',array(
        'as' =>'videofile',
        'uses' =>'VideoController@getVideo'
    ));

    Route::get('/videodelete/{videoid}',array(
        'as' =>'videodelete',
        'middleware' =>'auth',
        'uses' =>'VideoController@deleteVideo'
    ));

    Route::post('/comment',array(
        'as' =>'comment',
        'middleware' =>'auth',
        'uses' => 'CommentController@store'

    ));
