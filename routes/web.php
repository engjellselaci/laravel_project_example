<?php
Route::get('/', 'Task\TaskController@index')->name('tasks.list');
Route::get('tasks/add', 'Task\TaskController@addTaskForm')->name('tasks.add-form');
Route::get('tasks/update/{id}', 'Task\TaskController@updateTaskForm')->name('tasks.update-form');
Route::post('tasks/update/', 'Task\TaskController@updateTask')->name('tasks.update');
Route::post('tasks/insert', 'Task\TaskController@addTask')->name('tasks.insert');
Route::get('tasks/delete/{id}', 'Task\TaskController@deleteTask')->name('tasks.delete');