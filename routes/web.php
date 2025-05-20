<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransacaoController;






Route::get('/', [TransacaoController::class, 'index'])->name('home');
Route::get('/transacoes', [TransacaoController::class, 'index'])->name('transacoes.index');
Route::get('/transacoes/criar', [TransacaoController::class, 'create'])->name('transacoes.create');
Route::post('/transacoes', [TransacaoController::class, 'store'])->name('transacoes.store');
Route::get('/transacoes/{id}/edit', [TransacaoController::class, 'edit'])->name('transacoes.edit');
Route::put('/transacoes/{id}', [TransacaoController::class, 'update'])->name('transacoes.update');
Route::delete('/transacoes/{id}', [TransacaoController::class, 'destroy'])->name('transacoes.destroy');
