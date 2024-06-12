<?php

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

Route::middleware(['backend'])
    ->prefix('backend')
    ->name('backend.')
    ->namespace('Cpkm\Print\Http\Controllers\Backend')->group(function(){
        Route::middleware(['auth:backend', 'admin.permission'])
            ->prefix('print')
            ->name('print.')
            ->group(function () {
                /* 列印模板 */
                Route::resource('template', 'Print\TemplateController');
                /* 測試列印 */
                Route::get('demo/{id}', 'Print\TemplateController@print')->name('demo');
            });
    });
