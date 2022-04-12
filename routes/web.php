<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Check_Date;
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

// Route::get('/', function () {
//     return view('Dashboard');
// });
Route::get('/', [App\Http\Controllers\HomeController::class, 'homepage'])->name('homepage');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'homepage']);

// Roles
Route::get('/allRoles', [App\Http\Controllers\RoleController::class, 'getAllRoles'])->name('getAllRoles');
Route::post('/roles', [App\Http\Controllers\RoleController::class, 'addRole'])->name('addRole');
Route::get('/roles', [App\Http\Controllers\RoleController::class, 'roleForm'])->name('roleForm');
Route::get('/permissions', [App\Http\Controllers\RoleController::class, 'createPermissions'])->name('createPermissions');



// Administration route
Route::get('/userslist', [App\Http\Controllers\AdminController::class, 'index'])->name('userslist');
Route::get('/userslistboard', [App\Http\Controllers\AdminController::class, 'userslistboard'])->name('userslistboard');

Route::get('/editUser/{id}', [App\Http\Controllers\AdminController::class, 'editUser'])->name('editUser');
Route::post('/updateUser', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('updateUser');
Route::get('/initializePassword', [App\Http\Controllers\AdminController::class, 'initializePassword'])->name('initializePassword');
Route::post('/initializePassword', [App\Http\Controllers\AdminController::class, 'initializePasswordSave'])->name('initializePasswordSave');
Route::get('/changePassword', [App\Http\Controllers\AdminController::class, 'changePassword'])->name('changePassword');
Route::get('/controlpanel', [App\Http\Controllers\AdminController::class, 'controlpanel'])->name('controlpanel');



// File Maintainance
Route::get('/newsession', [App\Http\Controllers\FileController::class, 'newSession'])->name('newSession');
Route::post('/editsession', [App\Http\Controllers\FileController::class, 'editSession'])->name('editSession');

Route::get('/sessionlist', [App\Http\Controllers\FileController::class, 'sessionlist'])->name('sessionlist');


Route::get('/closesession', [App\Http\Controllers\FileController::class, 'closeSession'])->name('closeSession');
Route::get('/masterfile', [App\Http\Controllers\FileController::class, 'masterfile'])->name('masterfile');
Route::post('/addMasterFile', [App\Http\Controllers\FileController::class, 'addMasterFile'])->name('addMasterFile');

Route::get('/examtitle', [App\Http\Controllers\FileController::class, 'examtitlelist'])->name('examtitlelist');
Route::get('/addexamtitle', [App\Http\Controllers\FileController::class, 'addexamtitle'])->name('addexamtitle');
Route::get('/editexamtitle', [App\Http\Controllers\FileController::class, 'editexamtitle'])->name('editexamtitle');

Route::get('/trade', [App\Http\Controllers\FileController::class, 'tradelist'])->name('tradelist');
Route::get('/addtrade', [App\Http\Controllers\FileController::class, 'addtrade'])->name('addtrade');
Route::get('/edittrade', [App\Http\Controllers\FileController::class, 'edittrade'])->name('edittrade');

Route::get('/qualcode', [App\Http\Controllers\FileController::class, 'qualcodelist'])->name('qualcodelist');
Route::get('/addqualcode', [App\Http\Controllers\FileController::class, 'addqualcode'])->name('addqualcode');
Route::get('/editqualcode', [App\Http\Controllers\FileController::class, 'editqualcode'])->name('editqualcode');

Route::get('/centrecode', [App\Http\Controllers\FileController::class, 'centrecodelist'])->name('centrecodelist');
Route::get('/addcentrecode', [App\Http\Controllers\FileController::class, 'addcentrecode'])->name('addcentrecode');
Route::post('/savecentrecode', [App\Http\Controllers\FileController::class, 'savecentrecode'])->name('savecentrecode');
Route::get('/editcentrecode/{id}', [App\Http\Controllers\FileController::class, 'editcentrecode'])->name('editcentrecode');
Route::post('/updatecentrecode', [App\Http\Controllers\FileController::class, 'updatecentrecode'])->name('updatecentrecode');


Route::get('/groupshift', [App\Http\Controllers\FileController::class, 'groupshiftlist'])->name('groupshiftlist');
Route::get('/addgroupshift', [App\Http\Controllers\FileController::class, 'addgroupshift'])->name('addgroupshift');
Route::post('/addgroupshift', [App\Http\Controllers\FileController::class, 'savegroupshift'])->name('savegroupshift');
Route::get('/editgroupshift/{id}', [App\Http\Controllers\FileController::class, 'editgroupshift'])->name('editgroupshift');
Route::post('/updategroupshift', [App\Http\Controllers\FileController::class, 'updategroupshift'])->name('updategroupshift');






// Data Processing Module
Route::get('/enteryear', [App\Http\Controllers\DataController::class, 'enterYear'])->name('enterYear');
Route::get('/studentDetail', [App\Http\Controllers\DataController::class, 'enterStudentDetails'])->name('enterStudentDetails');


Route::get('/punjabAccess', [App\Http\Controllers\SetAccessController::class, 'index'])->name('punjabAccess');
Route::post('/punjabAccess', [App\Http\Controllers\SetAccessController::class, 'allpunjabAccesssave'])->name('allpunjabAccesssave');
Route::get('/InstitueLevelAccess', [App\Http\Controllers\SetAccessController::class, 'InstitueLevelAccess'])->name('InstitueLevelAccess');
Route::get('/InstitueLevelAccessEdit/{id}', [App\Http\Controllers\SetAccessController::class, 'InstitueLevelAccessEdit'])->name('InstitueLevelAccessEdit');
Route::post('/InstitueLevelAccessUpdate', [App\Http\Controllers\SetAccessController::class, 'InstitueLevelAccessUpdate'])->name('InstitueLevelAccessUpdate');
Route::view('/sessionAccess', 'setaccess_module.setSessionLevelAccess')->name('sessionAccess');
Route::view('/strengthSessionWise', 'setaccess_module.strengthSessionWise')->name('strengthSessionWise');
Route::get('/setsessionlist', [App\Http\Controllers\SetAccessController::class, 'setsessionlist'])->name('setsessionlist');

//Set  Access Module
Route::middleware([Check_Date::class],'auth')->group(function () {
   

    Route::get('/studentinformation', [App\Http\Controllers\DataController::class, 'studentinformation'])->name('studentinformation');
Route::post('/sessionStudentList', [App\Http\Controllers\DataController::class, 'sessionStudentList'])->name('sessionStudentList');



    
});



// Route::view('/punjabAccess', 'access_module.setPunjabLevelAccess')->name('punjabAccess');
// Route::view('/sessionAccess', 'access_module.setSessionLevelAccess')->name('sessionAccess');


// Delete Selected
Route::post('/deleteSelected', [App\Http\Controllers\ManageController::class, 'deleteSelected'])->name('deleteSelected');


// Change Status
Route::get('/changeStatusUser', [App\Http\Controllers\ManageController::class, 'changeStatusUser'])->name('changeStatusUser');
Route::get('/changeStatusSession', [App\Http\Controllers\ManageController::class, 'changeStatusSession'])->name('changeStatusSession');
Route::get('/changeStatusCentre', [App\Http\Controllers\ManageController::class, 'changeStatusCentre'])->name('changeStatusCentre');

Route::get('/changeStatusRole', [App\Http\Controllers\ManageController::class, 'changeStatusRole'])->name('changeStatusRole');
