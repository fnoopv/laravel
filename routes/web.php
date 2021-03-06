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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'QuestionsController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('email/verify/{token}',['as' => 'email.verify','uses' => 'EmailController@verify']);

Route::resource('questions','QuestionsController');

Route::post('questions/{question}/answer','AnswersController@store');

Route::get('/question/{question}/follow','QuestionFollowController@follow');

Route::get('notifications','NotificationController@index');

Route::get('/user/{user}','ProfileController@guest');

Route::get('/profile/{user}','ProfileController@admin');

Route::get('/profile/edit/{user}','ProfileController@edit');

Route::patch('/profile/update/{user}','ProfileController@update');

Route::get('/topics',[
    'as' => 'topics',
    'uses' => 'TopicShowController@index'
]);

Route::get('/mailVerify','EmailController@toVerify');

Route::get('/topic/{topic}','TopicShowController@show');

Route::get('/topic/edit/{topic}','TopicShowController@edit');

Route::patch('/topic/{topic}/update','TopicShowController@update');

Route::get('discover','DiscoverController@index');

Route::get('/test','TestController@index');
Route::get('/test/store','TestController@show');
Route::post('/search', 'SearchController@search');