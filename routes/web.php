<?php

use App\Http\Controllers\AuthController;
use App\Http\Livewire\AtemptQuisioner;
use App\Http\Livewire\CrudGenerator;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\DataDosenController;
use App\Http\Livewire\DataJadwalController;
use App\Http\Livewire\DataMahasiswaController;
use App\Http\Livewire\MahaSiswaListQuisioner;
use App\Http\Livewire\MahaSiswaListQuisionerAnswer;
use App\Http\Livewire\Master\DataKelasController;
use App\Http\Livewire\Master\DataMatakuliahController;
use App\Http\Livewire\Master\DataProdiController;
use App\Http\Livewire\Master\DataSemesterController;
use App\Http\Livewire\Master\QuestionController;
use App\Http\Livewire\PanduanAdmin;
use App\Http\Livewire\PanduanDosen;
use App\Http\Livewire\PanduanMhs;
use App\Http\Livewire\PerhitunganKinerja;
use App\Http\Livewire\Quisioner\ListQuisioner;
use App\Http\Livewire\Settings\Menu;
use App\Http\Livewire\UpdateProfile;
use App\Http\Livewire\UserManagement\Permission;
use App\Http\Livewire\UserManagement\PermissionRole;
use App\Http\Livewire\UserManagement\Role;
use App\Http\Livewire\UserManagement\User;
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

Route::get('/', function () {
    return redirect('login');
});


Route::post('login', [AuthController::class, 'login'])->name('admin.login');
Route::group(['middleware' => ['auth:sanctum', 'verified', 'user.authorization']], function () {
    // Crud Generator Route
    Route::get('/crud-generator', CrudGenerator::class)->name('crud.generator');

    // user management
    Route::get('/permission', Permission::class)->name('permission');
    Route::get('/permission-role/{role_id}', PermissionRole::class)->name('permission.role');
    Route::get('/role', Role::class)->name('role');
    Route::get('/user', User::class)->name('user');
    Route::get('/menu', Menu::class)->name('menu');

    // App Route
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Master data
    Route::group(['prefix' => 'master'], function () {
        Route::get('data-semester', DataSemesterController::class)->name('data-semester');
        Route::get('data-prodi', DataProdiController::class)->name('data-prodi');
        Route::get('data-matakuliah', DataMatakuliahController::class)->name('data-matakuliah');
        Route::get('data-kelas', DataKelasController::class)->name('data-kelas');

        Route::get('pertanyaan', QuestionController::class)->name('pertanyaan');
    });

    Route::get('data-mahasiswa', DataMahasiswaController::class)->name('data-mahasiswa');
    Route::get('data-dosen', DataDosenController::class)->name('data-dosen');


    Route::group(['prefix' => 'panduan'], function () {
        Route::get('mahasiswa', PanduanMhs::class)->name('panduan-mahasiswa');
        Route::get('admin', PanduanAdmin::class)->name('panduan-admin');
        Route::get('dosen', PanduanDosen::class)->name('panduan-dosen');
    });

    Route::group(['prefix' => 'quisioner'], function () {
        Route::get('list', DataJadwalController::class)->name('data-jadwal');
        Route::get('atemps/{id}', AtemptQuisioner::class)->name('quisioner.atemps');
    });

    Route::get('perhitungan-kinerja', PerhitunganKinerja::class)->name('perhitungan-kinerja');
    Route::get('/update-profile', UpdateProfile::class)->name('update-profile');

    Route::get('quisioner-detail/{jadwal_id}', MahaSiswaListQuisioner::class)->name('quisioner.detail');
    Route::get('quisioner-detail-answer/{id}/{user_id}', MahaSiswaListQuisionerAnswer::class)->name('quisioner.detail.answer');
});
