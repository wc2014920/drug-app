<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Doctor\DrugController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\IsDoctor;
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
Route::get('/404',function (){
    return view('dashboard.user.layouts.notready');
})->name('http404');
Route::get('/', function () {
    return view('welcome');
})->name('home');
Auth::routes();
Route::prefix('user')->name('user.')->group(function (){ //前綴：url->'user' ; 路由名稱->'user.'
    Route::middleware(['guest:web',PreventBackHistory::class])->group(function (){ // 狀態：登入/註冊前
        Route::view('/login','dashboard.user.login')->name('login');//路由名稱: user.login, 以下以此類推...
        Route::view('/register','dashboard.user.register')->name('register');
        //建立帳戶 [ create ]
        Route::post('/create',[UserController::class,'create'])->name('create');
        Route::post('/check',[UserController::class, 'check'])->name('check');
    });
    Route::middleware(['auth:web',PreventBackHistory::class,'verified'])->group(function (){ // 狀態：登入後
        //在這裡，我們可以通過 middleware 中間件 "IsDoctor" ，來決定該用戶的去處
        Route::middleware([IsDoctor::class])->group(function (){
            Route::get('/doctor/home',[DrugController::class,'showprescription'])->name('home.doctor');
            Route::view('/doctor/create','dashboard.function.doctor.createprescription')->name('drug.view.create.doctor');
            Route::view('/doctor/edit','dashboard.function.doctor.editprescription')->name('drug.view.edit.doctor');
            Route::post('/doctor/create',[DrugController::class,'create'])->name('drug.create.doctor');
            Route::get('/doctor/edit/show',[DrugController::class,'showeditprescription'])->name('drug.edit.show.doctor');
            Route::post('/doctor/edit',[DrugController::class,'editprescription'])->name('drug.edit.doctor');
            Route::post('/doctor/delete',[DrugController::class,'deleteprescription'])->name('drug.delete.doctor');
            Route::post('/doctor/search',[DrugController::class,'searchrescriptionresult'])->name('drug.search.doctor');
        });
        Route::post('/showprofile',[DrugController::class,'ShowProfile'])->name('showprofile');
        //醫生除了有自身角色，還可以拥有病患角色 -> 在使用權限與範圍： 醫生 > 病患
        Route::get('/patient/home',[DrugController::class,'showmyown'])->name('home.patient');
        Route::get('/patient/home/detail',[DrugController::class,'showmyowndetail'])->name('home.detail.patient');
        //登出權限人人皆有
        Route::post('/logout',[UserController::class, 'logout'])->name('logout');
    });
});

Route::prefix('admin')->name('admin.')->group(function (){ //前綴：url->'admin' ; 路由名稱->'admin.'
    Route::middleware(['guest:admin',PreventBackHistory::class])->group(function(){
        Route::view('/login','dashboard.admin.login')->name('login');//路由名稱: user.login, 以下以此類推...
        //因為管理者僅需一人，所以勿須建立註冊通道
        //登入檢查
        Route::post('/check',[AdminController::class, 'check'])->name('check');
    });
    Route::middleware(['auth:admin',PreventBackHistory::class])->group(function(){
        Route::view('/home','dashboard.admin.home')->name('home');
        Route::post('/logout',[AdminController::class, 'logout'])->name('logout');
    });
});
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/user/patient/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


