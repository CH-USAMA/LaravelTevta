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
Route::post('/controlPanelData', [App\Http\Controllers\AdminController::class, 'controlPanelData'])->name('controlPanelData');




// File Maintainance
Route::get('/newsession', [App\Http\Controllers\FileController::class, 'newSession'])->name('newSession');
Route::post('/newsession', [App\Http\Controllers\FileController::class, 'addSession'])->name('addSession');
Route::get('/editsession/{id}', [App\Http\Controllers\FileController::class, 'editSession'])->name('editSession');
Route::post('/updatesession', [App\Http\Controllers\FileController::class, 'updatesession'])->name('updatesession');
Route::get('/sessionlist', [App\Http\Controllers\FileController::class, 'sessionlist'])->name('sessionlist');


Route::get('/closesession', [App\Http\Controllers\FileController::class, 'closeSession'])->name('closeSession');
Route::post('/closesession', [App\Http\Controllers\FileController::class, 'closingsession'])->name('closingsession');

Route::get('/setagelimit', [App\Http\Controllers\FileController::class, 'setagelimit'])->name('setagelimit');
Route::post('/setagelimit', [App\Http\Controllers\FileController::class, 'saveagelimit'])->name('saveagelimit');


Route::get('/masterfile', [App\Http\Controllers\FileController::class, 'masterfile'])->name('masterfile');
Route::post('/masterfile', [App\Http\Controllers\FileController::class, 'addMasterFile'])->name('addMasterFile');

Route::get('/examtitle', [App\Http\Controllers\FileController::class, 'examtitlelist'])->name('examtitlelist');
Route::get('/addexamtitle', [App\Http\Controllers\FileController::class, 'addexamtitle'])->name('addexamtitle');
Route::post('/saveexamtitle', [App\Http\Controllers\FileController::class, 'saveexamtitle'])->name('saveexamtitle');
Route::get('/editexamtitle/{id}', [App\Http\Controllers\FileController::class, 'editexamtitle'])->name('editexamtitle');
Route::post('/updateexamtitle', [App\Http\Controllers\FileController::class, 'updateexamtitle'])->name('updateexamtitle');

Route::get('/trade', [App\Http\Controllers\FileController::class, 'tradelist'])->name('tradelist');
Route::get('/addtrade', [App\Http\Controllers\FileController::class, 'addtrade'])->name('addtrade');
Route::post('/savetrade', [App\Http\Controllers\FileController::class, 'savetrade'])->name('savetrade');
Route::get('/edittrade/{id}', [App\Http\Controllers\FileController::class, 'edittrade'])->name('edittrade');
Route::post('/updatetrade', [App\Http\Controllers\FileController::class, 'updatetrade'])->name('updatetrade');

Route::get('/qualcode', [App\Http\Controllers\FileController::class, 'qualcodelist'])->name('qualcodelist');
Route::get('/addqualcode', [App\Http\Controllers\FileController::class, 'addqualcode'])->name('addqualcode');
Route::post('/savequalcode', [App\Http\Controllers\FileController::class, 'savequalcode'])->name('savequalcode');
Route::get('/editqualcode/{id}', [App\Http\Controllers\FileController::class, 'editqualcode'])->name('editqualcode');
Route::post('/updatequalcode', [App\Http\Controllers\FileController::class, 'updatequalcode'])->name('updatequalcode');


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






// Set Access

Route::get('/punjabAccess', [App\Http\Controllers\SetAccessController::class, 'index'])->name('punjabAccess');
Route::post('/punjabAccess', [App\Http\Controllers\SetAccessController::class, 'allpunjabAccesssave'])->name('allpunjabAccesssave');
Route::get('/InstitueLevelAccess', [App\Http\Controllers\SetAccessController::class, 'InstitueLevelAccess'])->name('InstitueLevelAccess');
Route::get('/InstitueLevelAccessEdit/{id}', [App\Http\Controllers\SetAccessController::class, 'InstitueLevelAccessEdit'])->name('InstitueLevelAccessEdit');
Route::post('/InstitueLevelAccessUpdate', [App\Http\Controllers\SetAccessController::class, 'InstitueLevelAccessUpdate'])->name('InstitueLevelAccessUpdate');


Route::get('/setattendance', [App\Http\Controllers\SetAccessController::class, 'setattendance'])->name('setattendance');
Route::get('/strengthSessionWise', [App\Http\Controllers\SetAccessController::class, 'strengthSessionWise'])->name('strengthSessionWise');
Route::post('/strengthSessionWise', [App\Http\Controllers\SetAccessController::class, 'strengthSessionWiseUpdate'])->name('strengthSessionWiseUpdate');



// Route::view('/sessionAccess', 'setaccess_module.setSessionLevelAccess')->name('sessionAccess');
// Route::view('/strengthSessionWise', 'setaccess_module.strengthSessionWise')->name('strengthSessionWise');

Route::get('/setsessionlist', [App\Http\Controllers\SetAccessController::class, 'setsessionlist'])->name('setsessionlist');

//Set  Access Module
Route::middleware([Check_Date::class],'auth')->group(function () {
   

    Route::get('/studentinformation', [App\Http\Controllers\DataController::class, 'studentinformation'])->name('studentinformation');
Route::post('/sessionStudentList', [App\Http\Controllers\DataController::class, 'sessionStudentList'])->name('sessionStudentList');
    



// Route::view('/punjabAccess', 'access_module.setPunjabLevelAccess')->name('punjabAccess');
// Route::view('/sessionAccess', 'access_module.setSessionLevelAccess')->name('sessionAccess');


// Delete Selected
Route::post('/deleteSelected', [App\Http\Controllers\ManageController::class, 'deleteSelected'])->name('deleteSelected');


// Change Status
Route::get('/changeStatusUser', [App\Http\Controllers\ManageController::class, 'changeStatusUser'])->name('changeStatusUser');
Route::get('/changeStatusSession', [App\Http\Controllers\ManageController::class, 'changeStatusSession'])->name('changeStatusSession');
Route::get('/changeStatusCentre', [App\Http\Controllers\ManageController::class, 'changeStatusCentre'])->name('changeStatusCentre');
Route::get('/changeStatusQual', [App\Http\Controllers\ManageController::class, 'changeStatusQual'])->name('changeStatusQual');
Route::get('/changeStatusTrade', [App\Http\Controllers\ManageController::class, 'changeStatusTrade'])->name('changeStatusTrade');


Route::get('/changeStatusRole', [App\Http\Controllers\ManageController::class, 'changeStatusRole'])->name('changeStatusRole');


// Data Processing Module
Route::get('/enteryear', [App\Http\Controllers\DataController::class, 'enterYear'])->name('enterYear');
Route::get('/studentDetail', [App\Http\Controllers\StudentController::class, 'enterStudentDetails'])->name('enterStudentDetails');

Route::get('/studentinformation', [App\Http\Controllers\StudentController::class, 'studentinformation'])->name('studentinformation');
Route::post('/sessionStudentList', [App\Http\Controllers\StudentController::class, 'sessionStudentList'])->name('sessionStudentList');

Route::get('/sessionStudentList', [App\Http\Controllers\StudentController::class, 'sessionStudentListget'])->name('sessionStudentListget');

// Add student 
Route::get('/addStudent', [App\Http\Controllers\StudentController::class, 'addStudent'])->name('addStudent');
Route::post('/createStudent', [App\Http\Controllers\StudentController::class, 'createStudent'])->name('createStudent');
Route::post('/updateStudent', [App\Http\Controllers\StudentController::class, 'updateStudent'])->name('updateStudent');




Route::get('/enterStudentSession/{session}', [App\Http\Controllers\StudentController::class, 'enterStudentSession'])->name('enterStudentSession');
Route::post('/sessionToAddStudent', [App\Http\Controllers\StudentController::class, 'sessionToAddStudent'])->name('sessionToAddStudent');


Route::get('/editStudent/{ses_cnic_no}/{session}', [App\Http\Controllers\StudentController::class, 'editStudent'])->name('editStudent');
Route::post('/updateStudent', [App\Http\Controllers\StudentController::class, 'updateStudent'])->name('updateStudent');
// Student Data Submitted to admin

Route::get('/submitStudentData', [App\Http\Controllers\StudentController::class, 'submitStudentData'])->name('submitStudentData');
Route::post('/studentDataSubmit', [App\Http\Controllers\StudentController::class, 'studentDataSubmit'])->name('studentDataSubmit');
// Student Updated by Admin 

Route::post('/AllStudentList', [App\Http\Controllers\StudentController::class, 'AllStudentList'])->name('AllStudentList');

Route::get('/sessioninformation', [App\Http\Controllers\StudentController::class, 'sessioninformation'])->name('sessioninformation');

Route::get('/editStudentByAdmin/{ses_cnic_no}/{session}', [App\Http\Controllers\StudentController::class, 'editStudentByAdmin'])->name('editStudentByAdmin');
Route::post('/updateStudentByAdmin', [App\Http\Controllers\StudentController::class, 'updateStudentByAdmin'])->name('updateStudentByAdmin');



// Enter Student Attendence 


  Route::get('/student_attendence', [App\Http\Controllers\StudentController::class, 'studentAttendence'])->name('studentAttendence');
Route::post('/attendence_student', [App\Http\Controllers\StudentController::class, 'attendenceStudent'])->name('attendenceStudent');



//Enter Student Result 
  Route::get('/enter_student_result', [App\Http\Controllers\StudentController::class, 'enterStudentResult'])->name('enterStudentResult');
Route::post('/student_result', [App\Http\Controllers\StudentController::class, 'studentResult'])->name('studentResult');
Route::post('/submit_student_result', [App\Http\Controllers\StudentController::class, 'submitStudentResult'])->name('submitStudentResult');


//Reports

Route::get('/strength-summary', [App\Http\Controllers\ReportController::class, 'strengthSummary'])->name('strengthSummary');
Route::get('/session-history-report', [App\Http\Controllers\ReportController::class, 'sessionHistoryReport'])->name('sessionHistoryReport');
Route::get('/registration-allotted-report', [App\Http\Controllers\ReportController::class, 'registrationAllottedReport'])->name('registrationAllottedReport');

Route::get('/strength-summary-report', [App\Http\Controllers\ReportController::class, 'strengthSummaryReport'])->name('strengthSummaryReport');

// Route::get('/print-certificate-report', [App\Http\Controllers\ReportController::class, 'printCertificateReport'])->name('printCertificateReport');
Route::get('/session-history-statistical-report', [App\Http\Controllers\ReportController::class, 'sessionHistoryStatisticalReport'])->name('sessionHistoryStatisticalReport');






Route::get('/sce-attendence-sheet', [App\Http\Controllers\ReportController::class, 'sceAttendenceSheet'])->name('sceAttendenceSheet');
Route::post('/picture-list-student-report', [App\Http\Controllers\ReportController::class, 'pictureListStudentReport'])->name('pictureListStudentReport');




Route::get('/editing-data-form', [App\Http\Controllers\ReportController::class, 'editingDataForm'])->name('editingDataForm');
Route::post('/editing-data-list-report', [App\Http\Controllers\ReportController::class, 'editingDatalistReport'])->name('editingDatalistReport');


// Pending
Route::get('/admitance_slip_form', [App\Http\Controllers\ReportController::class, 'admitanceSlipForm'])->name('admitanceSlipForm');
Route::post('/admitance_slip_report', [App\Http\Controllers\ReportController::class, 'admitanceSlipReport'])->name('admitanceSlipReport');


//pending
Route::get('/attendence_sheet_form', [App\Http\Controllers\ReportController::class, 'attendenceSheetForm'])->name('attendenceSheetForm');
Route::post('/attendence_sheet_report', [App\Http\Controllers\ReportController::class, 'attendenceSheetReport'])->name('attendenceSheetReport');



//pending
Route::get('/award_list_form', [App\Http\Controllers\ReportController::class, 'awardListForm'])->name('awardListForm');
Route::post('/award_list_report', [App\Http\Controllers\ReportController::class, 'awardListReport'])->name('awardListReport');


//pending
Route::get('/result_statement_form', [App\Http\Controllers\ReportController::class, 'resultStatementForm'])->name('resultStatementForm');
Route::post('/result-statement-report', [App\Http\Controllers\ReportController::class, 'resultStatementReport'])->name('resultStatementReport');


// pending
Route::get('/center_summary_form', [App\Http\Controllers\ReportController::class, 'centerSummaryForm'])->name('centerSummaryForm');
Route::post('/center-report', [App\Http\Controllers\ReportController::class, 'centerReport'])->name('centerReport');


//pending
Route::get('/print-certificate-form', [App\Http\Controllers\ReportController::class, 'printCertificateForm'])->name('printCertificateForm');

Route::post('/print-certificate-report', [App\Http\Controllers\ReportController::class, 'printCertificateReport'])->name('printCertificateReport');

});
