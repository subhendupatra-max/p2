<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CookieSettingsController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
// dd(Session::get('unit'));


// Logout on browser close
Route::post('/logout-on-close', function () {
    if (auth()->check()) {
        auth()->logout();
        Session::invalidate();
        Session::regenerateToken();
    }
    return response('', 204);
});

Route::post('/logout-on-close', function () {
    if (auth()->check()) {
        auth()->logout();
        Session::invalidate();
        Session::regenerateToken();
    }
    return response('', 204);
});
 Route::get('admin/refresh_captcha', [AdminController::class,'refreshCaptcha' ])->name('admin.refresh_captcha');
Route::get('/login', function () {
    return redirect(route('admin.login'));
});
Route::get('/admin', function () {
    return redirect(route('admin.login'));
});

Route::get('/otp-login', function () {
    return redirect(route('admin.otp-login'));
});
Route::get('/', function () {
    session(['unit' => 'main']);
    return redirect('/en/main/home');
});
Route::post('unit-change-store-session', [PageController::class, 'unit_change_store_session'])->name('unit.change.store.session');
Route::get('/secure-file/{filename}', [FileController::class, 'show'])->name('secure-file');


Route::post('/change-unit', function (\Illuminate\Http\Request $request) {
    session(['unit' => $request->unit]);
    return redirect()->to(
        localized_route('home', ['unit' => $request->unit])
    );
})->name('change.unit');


Route::group(['prefix' => '{locale}/{unit}', 'middleware' => ['setlocale', 'unit']], function () {
    Route::get('/media/image/{uuid}', [PageController::class, 'mediaShow'])->name('media.show');
    Route::post('feedback-store', [PageController::class, 'feedbackstore'])->name('feedback.store');
    Route::post('search', [PageController::class, 'search'])->name('search');
    Route::get('/details/{uuid?}', [PageController::class, 'details'])->name('details');
    Route::get('our-units', [PageController::class, 'ourUnit'])->name('our-unit');
    Route::get('our-history', [PageController::class, 'ourHistory'])->name('our-history');
    Route::get('join-us', [PageController::class, 'joinUs'])->name('join-us');
    Route::get('recent-documents', [PageController::class, 'recentDocuments'])->name('recent-documents');
    Route::get('/cookie-settings', [CookieSettingsController::class, 'index'])->name('cookie.settings');
    Route::post('/cookie-settings/save', [CookieSettingsController::class, 'save'])->name('cookie.settings.save');
    Route::get('{slug?}', [PageController::class, 'show'])
        ->name('page.show')
        ->where([
            'locale' => '^(hi|en)$',
            'slug' => '^[^/]+$',
        ]);

    Route::get('{slug1}/{slug2}', [PageController::class, 'show'])
        ->name('page.subpage.show')
        ->where([
            'locale' => '^(hi|en)$',
            'slug1' => '^[^/]+$',
            'slug2' => '^[^/]+$',
        ]);
});


