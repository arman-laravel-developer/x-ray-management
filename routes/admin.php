<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\GoogleAnalyticController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ReturnAndRefundController;

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('migrate', function() {
            $exitCode = Artisan::call('migrate');

            if ($exitCode === 0) {
                $output = Artisan::output();
                return response()->json(['status' => 'success', 'message' => $output]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Migration failed'], 500);
            }
        })->name('migrate');

        Route::get('migrate-seed', function() {
            $exitCode = Artisan::call('migrate --seed');

            if ($exitCode === 0) {
                $output = Artisan::output();
                return response()->json(['status' => 'success', 'message' => $output]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Migration failed'], 500);
            }
        })->name('migrate-seed');

        Route::get('migrate-rollback', function() {
            $exitCodeRollBack = Artisan::call('migrate:rollback');

            if ($exitCodeRollBack === 0) {
                $output = Artisan::output();
                return response()->json(['status' => 'success', 'message' => $output]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Migration failed'], 500);
            }
        })->name('migrate-rollback');

        Route::get('clear', function() {
            Artisan::call('optimize:clear');
            flash()->success('Cache Clear', 'Cache clear successfully');
            return redirect()->back();
        })->name('clear-cache');

        Route::get('/contact-form-queries', [DashboardController::class, 'contactFormShow'])->name('dashboard.contact-form');
        Route::get('/contact-form-detail/{id}', [DashboardController::class, 'contactFormDetail'])->name('contactForm.detail');
        Route::post('/contact-form-replay/{id}', [DashboardController::class, 'contactFormReplay'])->name('contactForm.replay');
        Route::get('/customer-manage', [DashboardController::class, 'customer'])->name('dashboard.customer');
        Route::post('/customer-delete/{id}', [DashboardController::class, 'customerDelete'])->name('dashboard.customer-delete');
        Route::get('/customer-login/{id}', [DashboardController::class, 'customerLogin'])->name('customer.login-admin');
        Route::post('/test-mail', [DashboardController::class, 'testMail'])->name('test.mail');
        Route::get('/backup', [GeneralSettingController::class, 'backup'])->name('setting.backup');
        Route::get('/smtp', [GeneralSettingController::class, 'smtp'])->name('setting.smtp');
        Route::post('/smtp-update', [GeneralSettingController::class, 'smtpUpdate'])->name('setting.smtp-update');

    });



    Route::middleware(['roles'])->group(function () {
        Route::group(['prefix' => 'role', 'as' => 'role.'], function(){
            Route::get('/add', [RoleController::class, 'index'])->name('add');
            Route::post('/new', [RoleController::class, 'create'])->name('new');
            Route::get('/manage', [RoleController::class, 'manage'])->name('manage');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [RoleController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
        });

        Route::prefix('user')->group(function () {
            Route::get('/add', [UserController::class, 'index'])->name('user.add');
            Route::post('/new', [UserController::class, 'create'])->name('user.new');
            Route::get('/manage', [UserController::class, 'manage'])->name('user.manage');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
            Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        });
        Route::prefix('slider')->group(function () {
            Route::get('/add', [SliderController::class, 'index'])->name('slider.add');
            Route::post('/new', [SliderController::class, 'create'])->name('slider.new');
            Route::get('/manage', [SliderController::class, 'manage'])->name('slider.manage');
            Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
            Route::post('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
            Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');
        });
        Route::prefix('category')->group(function () {
            Route::get('/add', [CategoryController::class, 'index'])->name('category.add');
            Route::post('/new', [CategoryController::class, 'create'])->name('category.new');
            Route::get('/manage', [CategoryController::class, 'manage'])->name('category.manage');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::post('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        });
        Route::prefix('privacy')->group(function () {
            Route::get('/add', [PrivacyController::class, 'index'])->name('privacy.add');
            Route::post('/new', [PrivacyController::class, 'create'])->name('privacy.new');
            Route::get('/manage', [PrivacyController::class, 'manage'])->name('privacy.manage');
            Route::get('/edit/{id}', [PrivacyController::class, 'edit'])->name('privacy.edit');
            Route::post('/update', [PrivacyController::class, 'update'])->name('privacy.update');
            Route::post('/delete/{id}', [PrivacyController::class, 'delete'])->name('privacy.delete');
        });

        Route::prefix('return-and-refund')->group(function () {
            Route::get('/add', [ReturnAndRefundController::class, 'index'])->name('return.add');
            Route::post('/new', [ReturnAndRefundController::class, 'create'])->name('return.new');
            Route::get('/manage', [ReturnAndRefundController::class, 'manage'])->name('return.manage');
            Route::get('/edit/{id}', [ReturnAndRefundController::class, 'edit'])->name('return.edit');
            Route::post('/update', [ReturnAndRefundController::class, 'update'])->name('return.update');
            Route::post('/delete/{id}', [ReturnAndRefundController::class, 'delete'])->name('return.delete');
        });

        Route::prefix('general-settings')->group(function () {
            Route::get('/add', [GeneralSettingController::class, 'index'])->name('setting.add');
            Route::post('/new', [GeneralSettingController::class, 'create'])->name('setting.new');
            Route::get('/manage', [GeneralSettingController::class, 'manage'])->name('setting.manage');
            Route::get('/edit/{id}', [GeneralSettingController::class, 'edit'])->name('setting.edit');
            Route::post('/update', [GeneralSettingController::class, 'update'])->name('setting.update');
            Route::post('/delete/{id}', [GeneralSettingController::class, 'delete'])->name('setting.delete');
        });

        Route::prefix('about-us-admin')->group(function () {
            Route::get('/add', [AboutUsController::class, 'index'])->name('about-us.add');
            Route::post('/new', [AboutUsController::class, 'create'])->name('about-us.new');
            Route::get('/manage', [AboutUsController::class, 'manage'])->name('about-us.manage');
            Route::get('/edit/{id}', [AboutUsController::class, 'edit'])->name('about-us.edit');
            Route::post('/update/{id}', [AboutUsController::class, 'update'])->name('about-us.update');
            Route::post('/delete/{id}', [AboutUsController::class, 'delete'])->name('about-us.delete');
        });

        Route::prefix('google-analytics')->group(function () {
            Route::get('/add', [GoogleAnalyticController::class, 'index'])->name('google-analytic.add');
            Route::post('/new', [GoogleAnalyticController::class, 'create'])->name('google-analytic.new');
            Route::get('/manage', [GoogleAnalyticController::class, 'manage'])->name('google-analytic.manage');
            Route::get('/edit/{id}', [GoogleAnalyticController::class, 'edit'])->name('google-analytic.edit');
            Route::post('/update', [GoogleAnalyticController::class, 'update'])->name('google-analytic.update');
            Route::post('/delete/{id}', [GoogleAnalyticController::class, 'delete'])->name('google-analytic.delete');
        });
    });
});
