<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenditureTypeController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\IncomeTypeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\IncomeReportController;
use App\Http\Controllers\ExpenditureReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccoutsReceivableController;


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

Route::get('/datatable', function () {
    return view('example.datatable');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {

Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    Route::get('edit', [UserController::class, 'edit'])->name('edit');
});

Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');

    Route::middleware('role:staff')->group(function () {
        Route::get('create', [CustomerController::class, 'create'])->name('create');
        Route::post('store', [CustomerController::class, 'store'])->name('store');
        Route::get('edit/{customer}', [CustomerController::class, 'edit'])->name('edit');
        Route::patch('update/{customer}', [CustomerController::class, 'update'])->name('update');
        Route::delete('destroy/{customer}', [CustomerController::class, 'destroy'])->name('destroy');
    });

    Route::get('datatable', [CustomerController::class, 'datatable'])->name('datatable');
});

Route::group(['prefix' => 'expenditure-type', 'as' => 'expenditure_type.'], function () {
    Route::get('/', [ExpenditureTypeController::class, 'index'])->name('index');

    Route::middleware('role:staff')->group(function () {
        Route::get('create', [ExpenditureTypeController::class, 'create'])->name('create');
        Route::post('store', [ExpenditureTypeController::class, 'store'])->name('store');
        Route::get('edit/{expenditure_type}', [ExpenditureTypeController::class, 'edit'])->name('edit');
        Route::patch('update/{expenditure_type}', [ExpenditureTypeController::class, 'update'])->name('update');
        Route::delete('destroy/{expenditure_type}', [ExpenditureTypeController::class, 'destroy'])->name('destroy');
    });

    Route::get('datatable', [ExpenditureTypeController::class, 'datatable'])->name('datatable');
});

Route::group(['prefix' => 'income-type', 'as' => 'income_type.'], function () {
    Route::get('/', [IncomeTypeController::class, 'index'])->name('index');

    Route::middleware('role:staff')->group(function () {
        Route::get('create', [IncomeTypeController::class, 'create'])->name('create');
        Route::post('store', [IncomeTypeController::class, 'store'])->name('store');
        Route::get('edit/{income_type}', [IncomeTypeController::class, 'edit'])->name('edit');
        Route::patch('update/{income_type}', [IncomeTypeController::class, 'update'])->name('update');
        Route::delete('destroy/{income_type}', [IncomeTypeController::class, 'destroy'])->name('destroy');
    });
    
    Route::get('datatable', [IncomeTypeController::class, 'datatable'])->name('datatable');
});

Route::group(['prefix' => 'income', 'as' => 'income.'], function () {
    Route::get('/', [IncomeController::class, 'index'])->name('index');

    Route::middleware('role:staff')->group(function () {
        Route::get('create', [IncomeController::class, 'create'])->name('create');
        Route::post('store', [IncomeController::class, 'store'])->name('store');
        Route::get('edit/{income}', [IncomeController::class, 'edit'])->name('edit');
        Route::patch('update/{income}', [IncomeController::class, 'update'])->name('update');
        Route::delete('destroy/{income}', [IncomeController::class, 'destroy'])->name('destroy');
        Route::get('receivable-pay/{customer}', [IncomeController::class, 'showFormReceivable'])->name('form_receivable');
        Route::patch('receivable-pay/{income}', [IncomeController::class, 'payReceivable'])->name('pay_receivable');
        Route::patch('full-pay/{customer}', [IncomeController::class, 'fullPay'])->name('full_pay');
        Route::patch('single-full-pay/{income}', [IncomeController::class, 'singleFullPay'])->name('single_full_pay');
    });
    
    Route::get('datatable/{param?}', [IncomeController::class, 'datatable'])->name('datatable');
    Route::get('datatable-receivable/{param?}', [IncomeController::class, 'datatableReceivable'])->name('datatable_receivable');
    Route::get('datatable-receivable-detail/{id_customer}/{param?}', [IncomeController::class, 'datatableReceivableDetail'])->name('datatable_receivable_detail');
});

Route::group(['prefix' => 'receivable', 'as' => 'receivable.'], function () {
    Route::get('/', [IncomeController::class, 'index'])->name('index');

    Route::middleware('role:staff')->group(function () {
        Route::get('create', [IncomeController::class, 'create'])->name('create');
        Route::post('store', [IncomeController::class, 'store'])->name('store');
        Route::get('edit/{income}', [IncomeController::class, 'edit'])->name('edit');
        Route::patch('update/{income}', [IncomeController::class, 'update'])->name('update');
        Route::delete('destroy/{income}', [IncomeController::class, 'destroy'])->name('destroy');
        Route::get('receivable-pay/{income}', [IncomeController::class, 'showFormReceivable'])->name('form_receivable');
        Route::patch('receivable-pay/{income}', [IncomeController::class, 'payReceivable'])->name('pay_receivable');
        Route::patch('full-pay/{income}', [IncomeController::class, 'fullPay'])->name('full_pay');
    });
    
    Route::get('datatable/{param?}', [IncomeController::class, 'datatable'])->name('datatable');
    Route::get('datatable-receivable', [IncomeController::class, 'datatableReceivable'])->name('datatable_receivable');
});

Route::group(['prefix' => 'expenditure', 'as' => 'expenditure.'], function () {
    Route::get('/', [ExpenditureController::class, 'index'])->name('index');

    Route::middleware('role:staff')->group(function () {
        Route::get('create', [ExpenditureController::class, 'create'])->name('create');
        Route::post('store', [ExpenditureController::class, 'store'])->name('store');
        Route::get('edit/{expenditure}', [ExpenditureController::class, 'edit'])->name('edit');
        Route::patch('update/{expenditure}', [ExpenditureController::class, 'update'])->name('update');
        Route::delete('destroy/{expenditure}', [ExpenditureController::class, 'destroy'])->name('destroy');
    });

    Route::get('datatable', [ExpenditureController::class, 'datatable'])->name('datatable');
});

// Route::group(['prefix' => 'customer','as'=>'customer.', 'middleware' => 'role:admin,employee'], function () {

Route::group(['prefix' => 'staff', 'as' => 'staff.', 'middleware' => 'role:pimpinan'], function () {
    Route::get('/', [StaffController::class, 'index'])->name('index');
    Route::get('create', [StaffController::class, 'create'])->name('create');
    Route::post('store', [StaffController::class, 'store'])->name('store');
    Route::get('edit/{staff}', [StaffController::class, 'edit'])->name('edit');
    Route::patch('update/{staff}', [StaffController::class, 'update'])->name('update');
    Route::delete('destroy/{staff}', [StaffController::class, 'destroy'])->name('destroy');
    Route::get('datatable', [StaffController::class, 'datatable'])->name('datatable');
});

Route::group(['prefix' => 'income-report', 'as' => 'income_report.'], function () {
    Route::get('/', [IncomeReportController::class, 'index'])->name('index');
    Route::get('datatable/{date?}', [IncomeReportController::class, 'datatable'])->name('datatable');
    Route::get('create', [IncomeReportController::class, 'create'])->name('create');
});

Route::group(['prefix' => 'expenditure-report', 'as' => 'expenditure_report.'], function () {
    Route::get('/', [ExpenditureReportController::class, 'index'])->name('index');
    Route::get('create', [ExpenditureReportController::class, 'create'])->name('create');
});


});
