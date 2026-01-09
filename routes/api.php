<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PersonWageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PersonPlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth.jwt')->group(function () {
    Route::get('/persons', [PersonController::class, 'index']);
    Route::get('/persons/{id}', [PersonController::class, 'show']);
    Route::post('/persons', [PersonController::class, 'store']);
    Route::put('/persons/{id}', [PersonController::class, 'update']);
    Route::delete('/persons/{id}', [PersonController::class, 'destroy']);

    Route::get('/person-wages', [PersonWageController::class, 'index']);
    Route::get('/person-wages/{id}', [PersonWageController::class, 'show']);
    Route::get('/persons/{personId}/wages', [PersonWageController::class, 'getByPerson']);
    Route::post('/person-wages', [PersonWageController::class, 'store']);
    Route::put('/person-wages/{id}', [PersonWageController::class, 'update']);
    Route::delete('/person-wages/{id}', [PersonWageController::class, 'destroy']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    Route::get('/expenses', [ExpenseController::class, 'index']);
    Route::get('/expenses/{id}', [ExpenseController::class, 'show']);
    Route::get('/categories/{categoryId}/expenses', [ExpenseController::class, 'getByCategory']);
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
    Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);

    Route::get('/plans', [PlanController::class, 'index']);
    Route::get('/plans/{id}', [PlanController::class, 'show']);
    Route::post('/plans', [PlanController::class, 'store']);
    Route::put('/plans/{id}', [PlanController::class, 'update']);
    Route::delete('/plans/{id}', [PlanController::class, 'destroy']);

    Route::get('/person-plans', [PersonPlanController::class, 'index']);
    Route::get('/person-plans/{id}', [PersonPlanController::class, 'show']);
    Route::get('/persons/{personId}/plans', [PersonPlanController::class, 'getByPerson']);
    Route::get('/plans/{planId}/persons', [PersonPlanController::class, 'getByPlan']);
    Route::post('/person-plans', [PersonPlanController::class, 'store']);
    Route::post('/person-plans/attach', [PersonPlanController::class, 'attach']);
    Route::post('/person-plans/detach', [PersonPlanController::class, 'detach']);
    Route::put('/person-plans/{id}', [PersonPlanController::class, 'update']);
    Route::delete('/person-plans/{id}', [PersonPlanController::class, 'destroy']);

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

