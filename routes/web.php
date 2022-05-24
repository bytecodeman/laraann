<?php

use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\UsersController;
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

// Route::get('/', function () {
//     return view('announcements', [
//         'announcements' => Announcement::all()
//     ]);
// });

// Route::get('/listings/{id}', function ($id) {
//     $announcements = Announcement::find($id);
//     if ($announcements) {
//         return view('announcement', [
//             'announcement' => $announcements
//         ]);
//     } else {
//         abort(404);
//     }
// });

// Route::get('/listings/{announcement}', function (Announcement $announcement) {
//     return view('announcement', [
//         'announcement' => $announcement
//     ]);
// });


Route::get('/', [AnnouncementsController::class, "index"])->name("home");

Route::get('/announcements/create', [AnnouncementsController::class, "create"])->name('announcements-create')->middleware("auth");
Route::post('/announcements', [AnnouncementsController::class, "store"])->middleware("auth");

Route::get('/announcements/manage', [AnnouncementsController::class, "manage"])->name('announcements-manage')->middleware('auth');
Route::get('/announcements/manage/listings/{message?}', [AnnouncementsController::class, "backToProperListing"])->name('backToProperListing');
Route::get('/announcements/manage/{announcement}/delete', [AnnouncementsController::class, "confirmDelete"])->middleware("auth");

Route::get('/announcements/{announcement}', [AnnouncementsController::class, "show"])->name('announcement-show');
Route::get('/announcements/{announcement}/edit', [AnnouncementsController::class, "edit"])->middleware("auth");
Route::get('/announcements/{announcement}/delete', [AnnouncementsController::class, "confirmDelete"])->middleware("auth");
Route::put('/announcements/{announcement}/update', [AnnouncementsController::class, "update"])->middleware("auth");
Route::delete('/announcements/{announcement}', [AnnouncementsController::class, "destroy"])->middleware("auth");

Route::get('/users/create', [UsersController::class, "create"])->name('users-create')->middleware("guest");
Route::get('/register', function () {
    return Redirect(route('users-create'));
});
Route::get('/login', [UsersController::class, "showLoginForm"])->name("login")->middleware("guest");
Route::post('/users', [UsersController::class, "store"])->name('users-store')->middleware('guest');
Route::post('/login', [UsersController::class, "login"])->name('users-login')->middleware('guest');
Route::post('/logout', [UsersController::class, "logout"])->name("users-logout")->middleware('auth');

Route::get('/users', [UsersController::class, "index"])->name("users-manage")->middleware('auth');
Route::delete('/users/{user}', [UsersController::class, "destroy"])->middleware('auth');

Route::fallback(function () {
    return redirect(route('home'))->with('message', 'Page Not found');
})->name('page404');
