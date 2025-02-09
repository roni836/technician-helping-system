<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\DecisionTreeController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/brand', [CommonController::class, 'brandStore'])->name('brand.store');
Route::post('/problem', [CommonController::class, 'problemStore'])->name('problem.store');

Route::get('/', [DecisionTreeController::class, 'start'])->name('decision_tree.start');
Route::post('/decision-tree/problems', [DecisionTreeController::class, 'getProblems'])->name('decision_tree.get_problems');
Route::match(['get','post'],'/decision-tree/show', [DecisionTreeController::class, 'show'])->name('decision_tree.show');
Route::get('/decision-tree/question/{id}', [DecisionTreeController::class, 'showQuestion'])->name('decision_tree.show_question');
Route::post('/decision-tree/question/{id}/answer', [DecisionTreeController::class, 'answer'])->name('decision_tree.answer');

Route::post('/decision-tree/add-question', [DecisionTreeController::class, 'addQuestion'])->name('decision_tree.add_question');
Route::post('/decision-tree/add-starting-question', [DecisionTreeController::class, 'addStartingQuestion'])->name('decision_tree.add__starting_question');




Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected route
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DecisionTreeController::class, 'start'])->name('dashboard');
});
