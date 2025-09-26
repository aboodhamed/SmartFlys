<?php

// use App\Http\Controllers\AllCoursesController;
// use App\Http\Controllers\AllHallsController;
// use App\Http\Controllers\BookingController;
// use App\Http\Controllers\CoursesController;
// use App\Http\Controllers\HallController;
// use App\Http\Controllers\HallsController;

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\LecturesController;
// use App\Http\Controllers\MyHallController;
// use App\Http\Controllers\MyReservationController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\RoleRightsController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SystemModuleController;
use App\Http\Controllers\TripController;
// use App\Http\Controllers\TrainersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

// test 

Route::get('/test',function(){
     return view('components.trainers.all-trainers.index');
});


// end test


/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------|
| Routes for unauthenticated users (guests) like login and registration
*/
Route::middleware('guest')->group(function () {

    // Welcome page for guests(need a new page)
    Route::get('/', function () {
        return view('auth.welcome');
    });

    // Login routes using SessionController
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);

    // Registration routes using RegisterUserController
    Route::get('/register', [RegisterUserController::class, 'create'])->name('register'); 
    Route::post('/register', [RegisterUserController::class, 'store']);

});

Route::middleware('auth')->group(function () {

    /*
     |-------------------
     | Authenticated User Routes
     |-------------------|
     | Routes for authenticated users, like logout and account management
    */

    //logout route using SessionController
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth');

    // Account management routes using UserController
    Route::prefix('account')->group(function () {
      Route::get('/', [UserController::class, 'index'])->name('myaccount');
      Route::put('/update', [UserController::class, 'updateProfile'])->name('update');
      Route::post('/change-password', [UserController::class, 'changePassword'])->name('change-password');
      Route::delete('/delete', [UserController::class, 'deleteAccount'])->name('delete');
    });
    
    /*
     |-------------------
     | System Module Group
     |-------------------|
     | Routes for managing system modules, entities, and actions
    */
    Route::group(['prefix' => 'system-module', 'as' => 'system.module'], function () {
      Route::get('/', [SystemModuleController::class, 'index'])->name('index');
      Route::post('/add', [SystemModuleController::class, 'addModule'])->name('.add');
      Route::post('/edit/{id}', [SystemModuleController::class, 'editModule'])->name('.edit');
      Route::delete('/delete/{id}', [SystemModuleController::class, 'deleteModule'])->name('.delete');
      Route::post('/action/add', [SystemModuleController::class, 'addAction'])->name('.action.add');
      Route::post('/action/edit/{id}', [SystemModuleController::class, 'editAction'])->name('.action.edit');
      Route::delete('/action/delete/{id}', [SystemModuleController::class, 'deleteAction'])->name('.action.delete');
      Route::post('/entity/add', [SystemModuleController::class, 'addEntity'])->name('.entity.add');
      Route::post('/entity/edit/{id}', [SystemModuleController::class, 'editEntity'])->name('.entity.edit');
      Route::delete('/entity/delete/{id}', [SystemModuleController::class, 'deleteEntity'])->name('.entity.delete');
      Route::post('/entity/actions/{id}', [SystemModuleController::class, 'updateEntityActions'])->name('.entity.actions');
    });

    /*
    |-------------------
    | Role Rights Group
    |-------------------|
    | Routes for managing roles and permissions
    */
    Route::group(['prefix' => 'role-rights', 'as' => 'role.rights'], function () {
      Route::get('/', [RoleRightsController::class, 'index'])->name('');
      Route::post('/add', [RoleRightsController::class, 'addRole'])->name('.add');
      Route::post('/edit/{id}', [RoleRightsController::class, 'editRole'])->name('.edit');
      Route::delete('/delete/{id}', [RoleRightsController::class, 'deleteRole'])->name('.delete');
    });

    /*
    |-------------------
    | Admin Users Management Group
    |-------------------|
    | Routes for admin to manage all users and sessions
    */
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
      Route::get('/', [UsersController::class, 'index'])->name('index');
      Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('edit');
      Route::put('/{id}', [UsersController::class, 'update'])->name('update');
      Route::delete('/{id}', [UsersController::class, 'destroy'])->name('destroy');
      Route::put('/{id}/change-password', [UsersController::class, 'changePassword'])->name('change-password');
    });
    
    // Sessions route outside the 'users' prefix since it’s separate
    Route::get('/sessions', [SessionsController::class, 'index'])->name('sessions.index');

    // Home Page الصفحه الرئيسية
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
   // Airlines: List and show individual airlines
Route::get('/airlines', [AirlineController::class, 'index'])->name('airlines.index');


// Trips: Search/filter trips and create new trips
Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
Route::get('/trips/create', [TripController::class, 'create'])->name('trips.create');
Route::post('/trips', [TripController::class, 'store'])->name('trips.store');
Route::get('/trips/{id}', [TripController::class, 'show'])->name('trips.show');
Route::post('/trips/book', [TripController::class, 'book'])->name('trips.book');

// Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
// Route::get('/trips/{id}', [TripController::class, 'show'])->name('trips.show');
// Route::post('/trips/book', [TripController::class, 'book'])->name('trips.book');
// Route::get('/trips/create', [TripController::class, 'create'])->name('trips.create');
// Route::post('/trips', [TripController::class, 'store'])->name('trips.store');

// Chat: Display and send chat messages
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index')->middleware('auth');
Route::post('/chat', [ChatController::class, 'send'])->name('chat.send')->middleware('auth');


Route::get('/geminiChat',[GeminiController::class,'chat'])->name('gemini.chat');

  
// Route::get('/airlines', [AirlineController::class, 'index'])->name('airlines.index');
// Route::get('/trips', [TripController::class, 'index'])->name('trips.index');
// Route::get('/trips/create', [TripController::class, 'create'])->name('trips.create');
// Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
// Route::get('/trips/my-trips', [TripController::class, 'myTrips'])->name('trips.my-trips');
// Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

});