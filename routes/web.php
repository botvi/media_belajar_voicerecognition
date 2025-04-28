<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\superadmin\{
    DashboardSuperdminController,
    AbjadAlfabetController,
    BelajarMembacaController,
    MateriController,
    MenyusunKataController,
    ProfilController,
};
use App\Http\Controllers\web\{
    IndexController,
    WebBelajarMembacaController,
    WebMenyusunKataController,
};
use App\Http\Controllers\{
    LoginController,
};

Route::get('/run-admin', function () {
    Artisan::call('db:seed', [
        '--class' => 'UsersTableSeeder'
    ]);

    return "AdminSeeder has been create successfully!";
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('loginadmin.index');
Route::post('/login', [LoginController::class, 'login'])->name('loginadmin.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logoutadmin.index');

// ADMIN
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [DashboardSuperdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('abjad-alfabet', AbjadAlfabetController::class);
    Route::resource('belajar-membaca', BelajarMembacaController::class);
    Route::resource('menyusun-kata', MenyusunKataController::class);
    Route::resource('profil', ProfilController::class);
});
// ADMIN

Route::get('/', [IndexController::class, 'index'])->name('web.index');
Route::get('/menuutama', [IndexController::class, 'menuutama'])->name('web.menuutama');
Route::get('/mengenalabjad', [IndexController::class, 'mengenalabjad'])->name('web.mengenalabjad');

Route::get('/belajarmembaca', [WebBelajarMembacaController::class, 'index'])->name('web.belajarmembaca');
Route::get('/getbelajarmembaca', [WebBelajarMembacaController::class, 'getBelajarMembaca'])->name('web.getbelajarmembaca');

Route::get('/menyusunkata', [WebMenyusunKataController::class, 'index'])->name('web.menyusunkata');
Route::get('/getmenyusunkata', [WebMenyusunKataController::class, 'getMenyusunKata'])->name('web.getmenyusunkata');