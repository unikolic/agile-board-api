<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    Route::get('tasks/{id}', 'TaskController@getTask');
    Route::post('tasks', 'TaskController@createTask');
    Route::put('tasks/{id}', 'TaskController@updateTask');
    Route::delete('tasks/{id}', 'TaskController@deleteTask');
    Route::patch('tasks/{id}/status/{statusId}', 'TaskController@updateTaskStatus');
    Route::patch('tasks/{id}/block', 'TaskController@blockTask');

    Route::get('projects/{id}/tasks/{name?}/{user?}/{priority?}', 'ProjectController@getProjectTasks');
    Route::get('projects/{id}', 'ProjectController@getProject');
    Route::get('projects', 'ProjectController@getProjects');
    Route::post('projects', 'ProjectController@createProject');
    Route::put('projects/{id}', 'ProjectController@updateProject');
    Route::delete('projects/{id}', 'ProjectController@deleteProject');
    Route::get('projects/{id}/init', 'ProjectController@getInitData');

