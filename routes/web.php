<?php

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
    return redirect('dashboard');
});

Route::middleware('auth')->group(function(){

	Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('/dashboard/get_chart', 'DashboardController@getChart')->name('dashboard.chart');
	Route::get('/dashboard/get_data_park', 'DashboardController@getDataPark')->name('dashboard.get_data_park');
	Route::get('/dashboard/get_data_user', 'DashboardController@getDataUser')->name('dashboard.get_data_user');
	Route::get('/dashboard/revoke/{user_id}', 'DashboardController@revoke')->name('dashboard.revoke');

	Route::post('/user/validate', 'UserController@validatePost');
	Route::get('/user/export', 'UserController@export')->name('user.export');
	Route::post('/user/import', 'UserController@import')->name('user.import');
	Route::get('/user/tes', 'UserController@tes');
	Route::resource('/user', 'UserController');
	
	Route::post('/menu/bulk_edit', 'MenuController@bulkEdit');
	Route::resource('menu', 'MenuController');

	// Master Division 
	Route::get('division/get_data', 'DivisionController@getData');
	Route::get('division/get_department_by_division/{division_id}', 'DivisionController@getDepartmentByDivision');
	Route::resource('division', 'DivisionController');

	// Master Department 
	Route::get('department/get_data', 'DepartmentController@getData');
	Route::resource('department', 'DepartmentController');

	// Master Company
	Route::get('company/get_data', 'CompanyController@getData');
	Route::get('/company/export', 'CompanyController@export')->name('company.export');
	Route::resource('company', 'CompanyController');

	// Master Period 
	Route::get('period/get_data', 'PeriodController@getData');
	Route::resource('period', 'PeriodController');

	// Master Section 
	Route::get('section/get_data', 'SectionController@getData');
	Route::resource('section', 'SectionController');

	// Master Position 
	Route::get('position/get_data', 'PositionController@getData');
	Route::resource('position', 'PositionController');
	
	// Master Program 
	Route::get('program/get_data', 'ProgramController@getData');
	Route::resource('program', 'ProgramController');

	// Master Kegiatan 
	Route::get('activity/get_data', 'ActivityController@getData');
	Route::resource('activity', 'ActivityController');
	
	// Master Sub Kegiatan 
	Route::get('sub-activity/get_data', 'SubActivityController@getData');
	Route::resource('sub-activity', 'SubActivityController');

	// Master System 
	Route::get('system/get_data', 'SystemController@getData');
	Route::get('/system/export', 'SystemController@export')->name('system.export');
	Route::resource('system', 'SystemController');

	// Master Anggaran
	Route::get('anggaran/get_data', 'AnggaranController@getData');
	Route::resource('anggaran', 'AnggaranController');

	// Master Rincian
	Route::get('rincian/get_data', 'RincianBelanjaController@getData');
	Route::resource('rincian', 'RincianBelanjaController');

	// Report
	// Route::get('report/get_data', 'AnggaranController@getData');
	Route::post('/report/cetak', 'ReportController@cetak');
	Route::resource('report', 'ReportController');

	// Settings
	Route::prefix('settings')->group(function(){
		Route::get('role/get_data', 'RoleController@getData');
		Route::resource('role', 'RoleController');

		Route::get('permission/get_data', 'PermissionController@getData');
		Route::resource('permission', 'PermissionController');

		Route::get('servers/get_data', 'ServerController@getData');
		Route::resource('servers', 'ServerController');
	});
	Route::resource('/settings', 'SettingController');

	// // Laporan Omzet
	// Route::get('/omzet_report', 'OmzetReportController@index');
	// Route::post('/omzet_report/cetak_pdf', 'OmzetReportController@cetak_pdf');

});

Auth::routes();
