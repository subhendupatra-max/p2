<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\AiprController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\HodController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\AiprMasterController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::as('admin.')->group(function () {

    Route::post('refresh-captcha', function () {
        return response()->json(['captcha' => captcha_img('flat')]);
    })->name('refresh.captcha');

    Route::controller(AuthController::class)->group(function () {
        Route::match(['get', 'post'], 'login', 'login')->name('login');
        Route::match(['get', 'post'], 'otp-login', 'otp_login')->name('otp-login');
        Route::match(['get', 'post'], 'otp-verification', 'otp_verification')->name('otp-verification');
        Route::match(['get', 'post'], 'logout', 'logout')->name('logout');
        Route::match(['get', 'post'], 'forgot-page/password', 'forgotPasswordPage')->name('forgot.password.page');
        Route::match(['get', 'post'], 'forgot/password', 'forgotPassword')->name('forgot.password');
        Route::match(['get', 'post'], 'reset/password/{token?}', 'resetPassword')->name('reset.password');
        Route::post('notification/read', 'readNotification')->name('read.notification');
    });

    Route::middleware(['auth'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('dashboard');
            Route::post('profile/update', 'profileUpdate')->name('profile.update');
            Route::post('password/update', 'passwordUpdate')->name('password.update');
            Route::get('activity-log', 'activity_log')->name('activity-log.index')->can('activity-log');
            Route::get('unit-not-assigned', 'unit_not_assigned')->name('unit-not-assigned');
        });
        Route::controller(RolePermissionController::class)->as('role.')->prefix('role')->group(function () {
            Route::get('list', 'index')->name('list')->can('role-list');
            Route::post('add', 'roleAdd')->name('add')->middleware('canAny:add-role,edit-role');
            Route::any('permission/{uuid}', 'rolePermission')->name('permission')->can('give-permission');
            Route::any('user-permission/{uuid}', 'userRolePermission')->name('user.permission');
        });
        Route::controller(UserController::class)->as('user.')->prefix('user')->group(function () {
            Route::any('list', 'userList')->name('list')->can('user-list');
            Route::any('add/{uuid?}', 'userAdd')->name('add')->middleware('canAny:add-user,edit-user');
        });
        Route::controller(BannerController::class)->as('banner.')->prefix('banner')->group(function () {
            Route::get('list', 'index')->name('list')->can('banner-list');
            Route::any('add/{uuid?}', 'add')->name('add')->middleware('canAny:add-banner,edit-banner');
            Route::post('order', 'order')->name('order');
        });

        Route::controller(UnitController::class)->as('unit.')->prefix('unit')->group(function () {
            Route::get('list', 'index')->name('list')->can('unit-list');
            Route::any('add/{uuid?}', 'add')->name('add')->middleware('canAny:add-unit,edit-unit');
        });
        Route::controller(CmsController::class)->as('content.')->prefix('content')->group(function () {
            Route::get('list', 'index')->name('list')->middleware('canAny:all-content,my-content');
            Route::any('add/{uuid?}', 'add')->name('add')->can('add-content');
            Route::any('edit/{uuid?}', 'edit')->name('edit')->middleware('canAny:add-edit-all-content-details,add-edit-hindi-content-details,add-edit-english-content-details');
            Route::any('view/{uuid?}', 'view')->name('view')->can('view-content');
            Route::get('/get-menus-by-unit/{unit_id}', 'getUnits');
            Route::get('/get-menus-for-parent-by-unit/{unit_id}', 'getMenus');
            Route::get('/get-sections-by-menu/{menu_id}', 'getSections');
            Route::post('order', 'order')->name('order');
        });
        Route::controller(CategoryController::class)->as('category.')->prefix('category')->group(function () {
            Route::get('list', 'index')->name('list')->can('category-list');
            Route::any('add/{uuid?}', 'add')->name('add')->middleware('canAny:add-category,edit-category');
        });
        Route::controller(AiprMasterController::class)->as('aipr-master.')->prefix('aipr-master')->group(function () {
            Route::get('list', 'index')->name('list')->can('aipr-master-list');
            Route::any('add/{uuid?}', 'add')->name('add')->middleware('canAny:add-aipr-master,edit-aipr-master');
        });
        Route::controller(DesignationController::class)->as('designation.')->prefix('designation')->group(function () {
            Route::get('list', 'index')->name('list')->can('designation-list');
            Route::any('add/{uuid?}', 'add')->name('add')->middleware('canAny:add-designation,edit-designation');
        });
        Route::controller(SectionController::class)->as('section.')->prefix('section')->group(function () {
            Route::get('list', 'index')->name('list')->can('section-list');
            // Route::any('add/{uuid?}', 'add')->name('add');
        });
        Route::controller(DocumentController::class)->as('document.')->prefix('document')->group(function () {
            Route::get('list', 'index')->name('list');
            Route::any('add/{uuid?}', 'add')->name('add')->middleware('canAny:add-document,edit-document');
              Route::post('order', 'order')->name('order');
        });

        Route::controller(FeedbackController::class)->as('feedback.')->prefix('feedback')->group(function () {
            Route::get('list', 'index')->name('list')->can('feedback-list');
            Route::any('reply', 'reply')->name('reply')->can('reply-feedback');
        });

        Route::controller(SettingController::class)->as('setting.')->prefix('setting')->group(function () {
            Route::any('index', 'index')->name('index')->can('website-setting-list');
            Route::any('add/{id?}', 'add')->name('add')->can('edit-website-setting');
        });
        Route::controller(HodController::class)->as('hod.')->prefix('hod')->group(function () {
            Route::any('index', 'index')->name('list')->can('hod-list');
            Route::any('add/{uuid?}', 'add')->name('add')->middleware('canAny:add-hod,edit-hod');
        });
        Route::controller(NotificationController::class)->as('notification.')->prefix('notification')->group(function () {
            Route::get('list', 'index')->name('list')->can('notification-list');
        });

        Route::controller(TeamController::class)->as('team.')->prefix('team')->group(function () {
            Route::get('list', 'index')->name('list')->can('team-list');
            Route::any('add/{uuid?}', 'add')->name('add')->middleware('canAny:add-team,edit-team');
              Route::post('order', 'order')->name('order');
        });
        Route::controller(MenuController::class)->as('menu.')->prefix('menu')->group(function () {
            Route::get('list', 'index')->name('list')->can('menu-list');
            Route::any('add/{uuid?}', 'add')->name('add')->middleware('canAny:add-menu,edit-menu');
            Route::post('order', 'order')->name('order');
        });
        Route::controller(AiprController::class)->as('aipr.')->prefix('aipr')->group(function () {
            Route::get('list', 'index')->name('list')->can('aipr-list');
            Route::any('upload', 'upload')->name('upload')->can('add-aipr');
        });
        Route::controller(MediaController::class)->as('media.')->prefix('media')->group(function () {
            Route::get('list', 'index')->name('list')->can('media-list');
            Route::any('add/{uuid?}', 'add')->name('add')->middleware('canAny:add-media,edit-media');
        });
    });
});
