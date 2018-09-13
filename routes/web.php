<?php
// Route::get('/', function () { return redirect('/admin/home'); });

Route::get('/', 'HomeController@index');
Route::get('/library', 'LibraryController@index');

Route::get('courses', ['uses' => 'CoursesController@index', 'as' => 'courses']);
Route::get('courses/{id}', ['uses' => 'CoursesController@show', 'as' => 'courses.show']);


Route::get('/courses/{id}', 'CoursesController@show');
Route::get('/logout', 'Auth\LoginController@logout');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePaswosrdController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

Route::group(['middleware' => ['auth', 'approved'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@home');
    // Route::get('/home', 'Admin\DashboardController@index');
    
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('courses', 'Admin\CoursesController');
    Route::post('courses_mass_destroy', ['uses' => 'Admin\CoursesController@massDestroy', 'as' => 'courses.mass_destroy']);
    Route::post('courses_restore/{id}', ['uses' => 'Admin\CoursesController@restore', 'as' => 'courses.restore']);
    Route::delete('courses_perma_del/{id}', ['uses' => 'Admin\CoursesController@perma_del', 'as' => 'courses.perma_del']);
    Route::resource('coursescategories', 'Admin\CoursescategoriesController');
    Route::post('coursescategories_mass_destroy', ['uses' => 'Admin\CoursescategoriesController@massDestroy', 'as' => 'coursescategories.mass_destroy']);
    Route::post('coursescategories_restore/{id}', ['uses' => 'Admin\CoursescategoriesController@restore', 'as' => 'coursescategories.restore']);
    Route::delete('coursescategories_perma_del/{id}', ['uses' => 'Admin\CoursescategoriesController@perma_del', 'as' => 'coursescategories.perma_del']);
    Route::resource('lessons', 'Admin\LessonsController');
    Route::post('lessons_mass_destroy', ['uses' => 'Admin\LessonsController@massDestroy', 'as' => 'lessons.mass_destroy']);
    Route::post('lessons_restore/{id}', ['uses' => 'Admin\LessonsController@restore', 'as' => 'lessons.restore']);
    Route::delete('lessons_perma_del/{id}', ['uses' => 'Admin\LessonsController@perma_del', 'as' => 'lessons.perma_del']);
    Route::resource('trails', 'Admin\TrailsController');
    Route::post('trails_mass_destroy', ['uses' => 'Admin\TrailsController@massDestroy', 'as' => 'trails.mass_destroy']);
    Route::post('trails_restore/{id}', ['uses' => 'Admin\TrailsController@restore', 'as' => 'trails.restore']);
    Route::delete('trails_perma_del/{id}', ['uses' => 'Admin\TrailsController@perma_del', 'as' => 'trails.perma_del']);
    Route::resource('trailscategories', 'Admin\TrailscategoriesController');
    Route::post('trailscategories_mass_destroy', ['uses' => 'Admin\TrailscategoriesController@massDestroy', 'as' => 'trailscategories.mass_destroy']);
    Route::post('trailscategories_restore/{id}', ['uses' => 'Admin\TrailscategoriesController@restore', 'as' => 'trailscategories.restore']);
    Route::delete('trailscategories_perma_del/{id}', ['uses' => 'Admin\TrailscategoriesController@perma_del', 'as' => 'trailscategories.perma_del']);
    Route::resource('datacourses', 'Admin\DatacoursesController');
    Route::post('datacourses_mass_destroy', ['uses' => 'Admin\DatacoursesController@massDestroy', 'as' => 'datacourses.mass_destroy']);
    Route::post('datacourses_restore/{id}', ['uses' => 'Admin\DatacoursesController@restore', 'as' => 'datacourses.restore']);
    Route::delete('datacourses_perma_del/{id}', ['uses' => 'Admin\DatacoursesController@perma_del', 'as' => 'datacourses.perma_del']);
    Route::resource('datatrails', 'Admin\DatatrailsController');
    Route::post('datatrails_mass_destroy', ['uses' => 'Admin\DatatrailsController@massDestroy', 'as' => 'datatrails.mass_destroy']);
    Route::post('datatrails_restore/{id}', ['uses' => 'Admin\DatatrailsController@restore', 'as' => 'datatrails.restore']);
    Route::delete('datatrails_perma_del/{id}', ['uses' => 'Admin\DatatrailsController@perma_del', 'as' => 'datatrails.perma_del']);
    Route::resource('user_actions', 'Admin\UserActionsController');
    Route::resource('teams', 'Admin\TeamsController');
    Route::post('teams_mass_destroy', ['uses' => 'Admin\TeamsController@massDestroy', 'as' => 'teams.mass_destroy']);
    Route::get('internal_notifications/read', 'Admin\InternalNotificationsController@read');
    Route::resource('internal_notifications', 'Admin\InternalNotificationsController');
    Route::post('internal_notifications_mass_destroy', ['uses' => 'Admin\InternalNotificationsController@massDestroy', 'as' => 'internal_notifications.mass_destroy']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');

    Route::model('messenger', 'App\MessengerTopic');
    Route::get('messenger/inbox', 'Admin\MessengerController@inbox')->name('messenger.inbox');
    Route::get('messenger/outbox', 'Admin\MessengerController@outbox')->name('messenger.outbox');
    Route::resource('messenger', 'Admin\MessengerController');


    Route::get('search', 'MegaSearchController@search')->name('mega-search');
    Route::get('language/{lang}', function ($lang) {
        return redirect()->back()->withCookie(cookie()->forever('language', $lang));
    })->name('language');});