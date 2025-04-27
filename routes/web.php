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
/**
 * Model binding into route
 */
Route::model('users', 'App\User');
/**
 */
    /**
     * Auth
     */
    Route::get('/', array('as' => 'home', 'uses' => 'Setting\UserController@index'));
    Route::get('login', array('as' => 'login', 'uses' => 'Setting\UserController@index'));
    Route::post('login', array('as' => 'login.post', 'uses' => 'Setting\UserController@loginAdmin'));
    Route::get('logout', array('as' => 'logout', 'uses' => 'Setting\UserController@getLogout'));

    Route::group(array('prefix' => 'dashboard', 'middleware' => 'App\Http\Middleware\SentinelGuest'), function () {
        # Error pages should be shown without requiring login
        Route::get('404', function () {
            return View('404');
        });
        Route::get('500', function () {
            return View::make('500');
        });

        Route::group(array('middleware' => 'App\Http\Middleware\SentinelUser'), function () {
            /**
             * Task management
             */
            Route::get('/task', array('as' => 'task', 'uses' => 'Main\TaskManageController@index'));
            Route::get('/task/add/{id}', array('as' => 'task.add', 'uses' => 'Main\TaskManageController@add'));
            Route::post('/task/save', array('as' => 'task.save', 'uses' => 'Main\TaskManageController@save'));
            Route::post('/task/change', array('as' => 'task.change', 'uses' => 'Main\TaskManageController@change'));
            Route::post('/task/delete', array('as' => 'task.delete', 'uses' => 'Main\TaskManageController@delete'));
        });

    });


