<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PasswordController;


// Authentication routes
Route::post('/login', [AuthController::class, 'login']);  // Public login route
Route::post('/password/forgot', [PasswordController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [PasswordController::class, 'resetPassword']);

Route::middleware(['auth:api', \App\Http\Middleware\EnsureAcceptJson::class])->group(function () {
    // Admin routes for managing projects
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index']);   // Get all projects
        Route::get('/{project}', [ProjectController::class, 'show']);  // Get a specific project
        Route::post('/create', [ProjectController::class, 'store']);   // Create a new project
        Route::put('/update/{project}', [ProjectController::class, 'update']);  // Update a project
        Route::delete('/delete/{project}', [ProjectController::class, 'destroy']);  // Delete a project
    });




    // Admin routes for managing reviews
    Route::prefix('reviews')->group(function () {
        Route::get('/', [ReviewController::class, 'index']);   // Get all reviews
        Route::get('/{review}', [ReviewController::class, 'show']);  // Get a specific review
        Route::post('/add', [ReviewController::class, 'store']);   // Create a new review
        Route::put('/update/{review}', [ReviewController::class, 'update']);  // Update a review
        Route::delete('/delete/{review}', [ReviewController::class, 'destroy']);  // Delete a review
    });

    // Admin routes for managing stats
    Route::prefix('stats')->group(function () {
        Route::get('/', [StatController::class, 'index']);   // Get the stats
        Route::put('/update', [StatController::class, 'update']);   // Update the stats
    });

    // Admin routes for viewing all contact form submissions
    Route::prefix('contacts')->group(function () {
        Route::get('/', [ContactController::class, 'index']);   // Get all contact messages
        Route::get('/{contact}', [ContactController::class, 'show']);  // Get a specific contact message
        Route::delete('/{contact}', [ContactController::class, 'destroy']);  // Delete a contact message
    });

    Route::post('logout',[AuthController::class, 'logout']); 
});

// Public route for submitting a contact form
Route::post('/contact-us', [ContactController::class, 'store']);  // Submit a contact form message
