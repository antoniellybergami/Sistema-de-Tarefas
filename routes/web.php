<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefasController;


Route::get('/', TarefasController::class .'@index')->name('tarefas.index');
Route::get('/tarefas/create', TarefasController::class . '@create')->name('tarefas.create');
Route::post('/tarefas', TarefasController::class .'@store')->name('tarefas.store');
Route::get('/tarefas/{tarefa}', TarefasController::class .'@show')->name('tarefas.show');
Route::get('/tarefas/{tarefa}/edit', TarefasController::class .'@edit')->name('tarefas.edit');
Route::put('/tarefas/{tarefa}', TarefasController::class .'@update')->name('tarefas.update');
Route::delete('/tarefas/{tarefa}', TarefasController::class .'@destroy')->name('tarefas.destroy');


Route::post('/tarefas/reordenar', [TarefasController::class, 'reordenar'])->name('tarefas.reordenar');
