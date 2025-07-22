<?php 
/****************** ADMIN MIDDLEWARE PAGES ROUTES START****************/

use App\Http\Controllers\Crp\FarmingProfileController;
use App\Http\Controllers\Crp\MonthlyFarmingReportController;
use App\Http\Controllers\Crp\PgMonthlyFarmingReportController;
use App\Http\Controllers\Crp\PgMonthlyProgressReportController;
use App\Http\Controllers\Crp\RespondentMasterController;
use App\Http\Controllers\Crp\TrainingReportController;

Route::group(['prefix' => 'crp', 'as'=>'crp.','middleware' => 'auth:user'], function () { 
    Route::group(['middleware' => 'crp'], function () { 
        /*******************DASHBOARD ROUTE START*************/       
        Route::view('dashboard','crp.dashboard.index')->name('dashboard.index');
        /*******************DASHBOARD ROUTE END*************/       
        /*******************TRAINING REPORT ROUTE START*************/       
        Route::resource('training_report',TrainingReportController::class);
        /*******************TRAINING REPORT ROUTE END*************/   
        /*******************Respondent Master ROUTE START*************/       
        Route::resource('respondent_master',RespondentMasterController::class);
        Route::get('export', [RespondentMasterController::class, 'export'])->name('export');

        /*******************Respondent Master ROUTE END*************/   
        /*******************Farming Profile ROUTE START*************/       
        Route::resource('farming_profile',FarmingProfileController::class);
        /*******************Farming Profile ROUTE END*************/  
        /*******************Monthly Farming Report ROUTE START*************/       
        Route::post('get_months',[MonthlyFarmingReportController::class,'getMonths'])->name('monthly_farming_report.getMonths');
        Route::post('get_blocks',[MonthlyFarmingReportController::class,'getBlocks'])->name('monthly_farming_report.get_blocks');
        Route::post('get_gram_panchyats',[MonthlyFarmingReportController::class,'getGramPanchyats'])->name('monthly_farming_report.get_gram_panchyats');
        Route::post('get_villages',[MonthlyFarmingReportController::class,'getVillages'])->name('monthly_farming_report.get_villages');
        Route::post('get_shgs',[MonthlyFarmingReportController::class,'getShgs'])->name('monthly_farming_report.get_shgs');
        Route::post('get_pgs',[MonthlyFarmingReportController::class,'getPgs'])->name('monthly_farming_report.get_pgs');
        Route::resource('monthly_farming_report',MonthlyFarmingReportController::class);
        Route::resource('pg_monthly_progress_report',PgMonthlyProgressReportController::class);
        /*******************Monthly Farming Report ROUTE END*************/    
    });        
});        
/****************** ADMIN MIDDLEWARE PAGES ROUTES END****************/
?>