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
    return view('_auth/signup');
    // return view('auth/login');
});


Auth::routes();

Route::get('/home', 'RoleController@index')->name('home');
// =========== ROLES ===========
Route::get('role/create', 'RoleController@create');
Route::post('role/insert', 'RoleController@insert');
Route::get('role/all', 'RoleController@ViewAll');
Route::get('role/view/{id}', 'RoleController@Show');
Route::get('role/del/{id}', 'RoleController@Delete');
Route::post('role/edit/{id}', 'RoleController@Edit');

Route::get('role/group-create', 'RoleController@GroupCreate');
Route::get('role/group-edit/{id}', 'RoleController@GroupEdit');
Route::post('role/group-update/{id}', 'RoleController@GroupUpdate');
Route::get('role/group-del/{id}', 'RoleController@GroupDelete');

// =========== CATEGORIES ===========
Route::get('question-category/create', 'QuestionCatController@Create');
Route::post('question-category/insert', 'QuestionCatController@Insert');
Route::get('question-category/{type}/all', 'QuestionCatController@ViewAll');
Route::get('question-category/view/{type}/{id}', 'QuestionCatController@Show');
Route::post('question-category/edit/{id}', 'QuestionCatController@Edit');
Route::get('question-category/del/{type}/{id}', 'QuestionCatController@Delete');
// =========== USERS ===========
Route::get('user/create', 'UserController@Create');
Route::post('user/insert', 'UserController@Insert');
Route::get('user/all', 'UserController@ViewAll');
Route::get('user/edit/{id}', 'UserController@Edit');
Route::post('user/update', 'UserController@Update');
Route::get('user/del/{id}', 'UserController@Delete');
Route::get('user/get/{id}', 'UserController@GetUser');
// =========== SERVICE SECTOR ===========
Route::prefix('service-sector')->group(function () {
    Route::get('create', 'ServiceSectorController@Create');
    Route::post('insert', 'ServiceSectorController@Insert');
    Route::get('all', 'ServiceSectorController@ViewAll');
    Route::get('edit/{id}', 'ServiceSectorController@Edit');
    Route::post('update/{id}', 'ServiceSectorController@Update');
    Route::get('del/{id}', 'ServiceSectorController@Delete');
});
// =========== Onboarding Status ===========
Route::prefix('onboarding-status')->group(function () {
    Route::get('create', 'OnboardingstatusController@Create');
    Route::post('insert', 'OnboardingstatusController@Insert');
    Route::get('all', 'OnboardingstatusController@ViewAll');
    Route::get('edit/{id}', 'OnboardingstatusController@Edit');
    Route::post('update/{id}', 'OnboardingstatusController@Update');
    Route::get('del/{id}', 'OnboardingstatusController@Delete');
});
// =========== Questions ===========
Route::prefix('Question')->group(function () {
	Route::get('get-cat/{id}', 'E_questionController@GetCat');
    Route::get('create', 'E_questionController@Create');
    Route::post('insert', 'E_questionController@Insert');
    Route::get('all/{type}', 'E_questionController@ViewAll');
    Route::get('edit/{id}/{type}', 'E_questionController@Edit');
    Route::post('update/{id}', 'E_questionController@Update');
    Route::get('del/{id}/{type}', 'E_questionController@Delete');
    Route::get('getAppendedData/{id}/{type}', 'E_questionController@GetAppendedData');
});
// =========== Answer ===========
Route::prefix('answer')->group(function () {
    Route::get('get-user/{type}', 'AnswerController@Getuser');
    Route::get('create', 'AnswerController@Create');
    Route::get('insert', 'AnswerController@Insert');
    Route::get('all/{type}', 'AnswerController@ViewAll');
    Route::get('view/{type}', 'AnswerController@Show');
});
// =========== Membership Plane ===========
Route::prefix('membership-plane')->group(function () {
    Route::get('get-user/{type}', 'MembershipController@Getuser');
    Route::get('create', 'MembershipController@Create');
    Route::post('insert', 'MembershipController@Insert');
    Route::get('all', 'MembershipController@ViewAll');
    Route::get('edit/{id}', 'MembershipController@Edit');
    Route::post('update/{id}', 'MembershipController@Update');
    Route::get('del/{id}', 'MembershipController@Delete');
    Route::get('assign', 'MembershipController@Assign');
    Route::get('get/{user_id}', 'MembershipController@Get');
});
// =========== COUNTRY STATE CITY ===========
Route::get('get-state/{country_id}', 'UserController@GetState');
Route::get('get-city/{state_id}', 'UserController@GetCity');

// =========== EMAIL EVENTS ===========
Route::prefix('email-event')->group(function () {
    Route::get('create', 'EmailEventController@Create');
    Route::post('insert', 'EmailEventController@Insert');
    Route::get('all', 'EmailEventController@ViewAll');
    Route::get('edit/{id}', 'EmailEventController@Edit');
    Route::post('update/{id}', 'EmailEventController@Update');
    Route::get('del/{id}', 'EmailEventController@Delete');
});

// =========== EMAIL USER GROUP ===========
Route::prefix('email-user-group')->group(function () {
    Route::get('create', 'EmailUserGroupController@Create');
    Route::post('insert', 'EmailUserGroupController@Insert');
    Route::get('all', 'EmailUserGroupController@ViewAll');
    Route::get('edit/{id}', 'EmailUserGroupController@Edit');
    Route::post('update/{id}', 'EmailUserGroupController@Update');
    Route::get('del/{id}', 'EmailUserGroupController@Delete');
});

// =========== EMAIL TEMP ===========
Route::prefix('email-temp')->group(function () {
    Route::get('create', 'EventTempController@Create');
    Route::post('insert', 'EventTempController@Insert');
    Route::get('all', 'EventTempController@ViewAll');
    Route::get('edit/{id}', 'EventTempController@Edit');
    Route::post('update/{id}', 'EventTempController@Update');
    Route::get('del/{id}', 'EventTempController@Delete');
});

// =========== EMAIL ASSIGN ===========
Route::prefix('assign-email')->group(function () {
    Route::get('create', 'EmailAssignController@Create');
    Route::post('insert', 'EmailAssignController@Insert');
    Route::get('all', 'EmailAssignController@ViewAll');
    Route::get('edit/{id}', 'EmailAssignController@Edit');
    Route::post('update/{id}', 'EmailAssignController@Update');
    Route::get('del/{id}', 'EmailAssignController@Delete');
});

// =========== SEND EMAIL ===========
Route::prefix('email')->group(function () {
    Route::get('direct-send', 'MailController@DSend');
    Route::get('send/{trigger_id}', 'MailController@Send');
    
});