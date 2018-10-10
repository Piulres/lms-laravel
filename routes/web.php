<?php
// Route::get('/', function () { return redirect('/admin/home'); });

Route::get('/', 'HomeController@index');
Route::get('/speech', 'HomeController@speech');

// Route::get('/library', 'LibraryController@index');
Route::get('/library', 'LibraryController@index');
Route::get('/guide', 'GuideController@index');

Route::prefix('courses')->group(function(){
    Route::get('', ['uses' => 'CoursesController@index', 'as' => 'courses']);
    Route::get('{id}', ['uses' => 'CoursesController@show', 'as' => 'courses.show']);
    Route::get('start/{id}', 'CoursesController@start');
    Route::get('add/{id}', 'CoursesController@add');
    Route::get('remove/{id}', 'CoursesController@remove');
    Route::get('certificate/{id}', 'CoursesController@certificate'); 
    Route::get('done/{id}', 'CoursesController@done');
});

Route::prefix('trails')->group(function(){
    Route::get('', ['uses' => 'TrailsController@index', 'as' => 'trail']);
    Route::get('{id}', ['uses' => 'TrailsController@show', 'as' => 'trail.show']);
    Route::get('start/{id}', 'TrailsController@start');
    Route::get('add/{id}', 'TrailsController@add');
    Route::get('remove/{id}', 'TrailsController@remove');
    Route::get('certificate/{id}', 'TrailsController@certificate'); 
    Route::get('done/{id}', 'TrailsController@done');
});

Route::get('/logout', 'Auth\LoginController@logout');

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

// Social Login Routes..
Route::get('login/{driver}', 'Auth\LoginController@redirectToSocial')->name('auth.login.social');
Route::get('{driver}/callback', 'Auth\LoginController@handleSocialCallback')->name('auth.login.social_callback');

Route::group(['middleware' => ['auth', 'approved'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@home');
    // Route::get('/home', 'Admin\DashboardController@index');

    Route::resource('content_categories', 'Admin\ContentCategoriesController');
    Route::post('content_categories_mass_destroy', ['uses' => 'Admin\ContentCategoriesController@massDestroy', 'as' => 'content_categories.mass_destroy']);
    Route::resource('content_tags', 'Admin\ContentTagsController');
    Route::post('content_tags_mass_destroy', ['uses' => 'Admin\ContentTagsController@massDestroy', 'as' => 'content_tags.mass_destroy']);
    Route::resource('content_pages', 'Admin\ContentPagesController');
    Route::post('content_pages_mass_destroy', ['uses' => 'Admin\ContentPagesController@massDestroy', 'as' => 'content_pages.mass_destroy']);
    Route::get('internal_notifications/read', 'Admin\InternalNotificationsController@read');
    Route::resource('internal_notifications', 'Admin\InternalNotificationsController');
    Route::post('internal_notifications_mass_destroy', ['uses' => 'Admin\InternalNotificationsController@massDestroy', 'as' => 'internal_notifications.mass_destroy']);
    Route::resource('lessons', 'Admin\LessonsController');
    Route::post('lessons_mass_destroy', ['uses' => 'Admin\LessonsController@massDestroy', 'as' => 'lessons.mass_destroy']);
    Route::post('lessons_duplicate/{id}', ['uses' => 'Admin\LessonsController@duplicate', 'as' => 'lessons.duplicate']);
    Route::post('lessons_restore/{id}', ['uses' => 'Admin\LessonsController@restore', 'as' => 'lessons.restore']);
    Route::delete('lessons_perma_del/{id}', ['uses' => 'Admin\LessonsController@perma_del', 'as' => 'lessons.perma_del']);
    Route::resource('coursecategories', 'Admin\CoursecategoriesController');
    Route::post('coursecategories_mass_destroy', ['uses' => 'Admin\CoursecategoriesController@massDestroy', 'as' => 'coursecategories.mass_destroy']);
    Route::post('coursecategories_restore/{id}', ['uses' => 'Admin\CoursecategoriesController@restore', 'as' => 'coursecategories.restore']);
    Route::delete('coursecategories_perma_del/{id}', ['uses' => 'Admin\CoursecategoriesController@perma_del', 'as' => 'coursecategories.perma_del']);
    Route::resource('coursetags', 'Admin\CoursetagsController');
    Route::post('coursetags_mass_destroy', ['uses' => 'Admin\CoursetagsController@massDestroy', 'as' => 'coursetags.mass_destroy']);
    Route::post('coursetags_restore/{id}', ['uses' => 'Admin\CoursetagsController@restore', 'as' => 'coursetags.restore']);
    Route::delete('coursetags_perma_del/{id}', ['uses' => 'Admin\CoursetagsController@perma_del', 'as' => 'coursetags.perma_del']);
    Route::resource('courses', 'Admin\CoursesController');
    Route::post('courses_mass_destroy', ['uses' => 'Admin\CoursesController@massDestroy', 'as' => 'courses.mass_destroy']);
    Route::post('courses_restore/{id}', ['uses' => 'Admin\CoursesController@restore', 'as' => 'courses.restore']);
    Route::delete('courses_perma_del/{id}', ['uses' => 'Admin\CoursesController@perma_del', 'as' => 'courses.perma_del']);
    Route::resource('coursescertificates', 'Admin\CoursescertificatesController');
    Route::post('coursescertificates_mass_destroy', ['uses' => 'Admin\CoursescertificatesController@massDestroy', 'as' => 'coursescertificates.mass_destroy']);
    Route::post('coursescertificates_restore/{id}', ['uses' => 'Admin\CoursescertificatesController@restore', 'as' => 'coursescertificates.restore']);
    Route::delete('coursescertificates_perma_del/{id}', ['uses' => 'Admin\CoursescertificatesController@perma_del', 'as' => 'coursescertificates.perma_del']);
    Route::resource('faq_categories', 'Admin\FaqCategoriesController');
    Route::post('faq_categories_mass_destroy', ['uses' => 'Admin\FaqCategoriesController@massDestroy', 'as' => 'faq_categories.mass_destroy']);
    Route::resource('faq_questions', 'Admin\FaqQuestionsController');
    Route::post('faq_questions_mass_destroy', ['uses' => 'Admin\FaqQuestionsController@massDestroy', 'as' => 'faq_questions.mass_destroy']);
    Route::resource('generals', 'Admin\GeneralsController');
    Route::post('generals_mass_destroy', ['uses' => 'Admin\GeneralsController@massDestroy', 'as' => 'generals.mass_destroy']);
    Route::post('generals_restore/{id}', ['uses' => 'Admin\GeneralsController@restore', 'as' => 'generals.restore']);
    Route::delete('generals_perma_del/{id}', ['uses' => 'Admin\GeneralsController@perma_del', 'as' => 'generals.perma_del']);
    Route::resource('trailcategories', 'Admin\TrailcategoriesController');
    Route::post('trailcategories_mass_destroy', ['uses' => 'Admin\TrailcategoriesController@massDestroy', 'as' => 'trailcategories.mass_destroy']);
    Route::post('trailcategories_restore/{id}', ['uses' => 'Admin\TrailcategoriesController@restore', 'as' => 'trailcategories.restore']);
    Route::delete('trailcategories_perma_del/{id}', ['uses' => 'Admin\TrailcategoriesController@perma_del', 'as' => 'trailcategories.perma_del']);
    Route::resource('trailtags', 'Admin\TrailtagsController');
    Route::post('trailtags_mass_destroy', ['uses' => 'Admin\TrailtagsController@massDestroy', 'as' => 'trailtags.mass_destroy']);
    Route::post('trailtags_restore/{id}', ['uses' => 'Admin\TrailtagsController@restore', 'as' => 'trailtags.restore']);
    Route::delete('trailtags_perma_del/{id}', ['uses' => 'Admin\TrailtagsController@perma_del', 'as' => 'trailtags.perma_del']);
    Route::resource('trails', 'Admin\TrailsController');
    Route::post('trails_mass_destroy', ['uses' => 'Admin\TrailsController@massDestroy', 'as' => 'trails.mass_destroy']);
    Route::post('trails_restore/{id}', ['uses' => 'Admin\TrailsController@restore', 'as' => 'trails.restore']);
    Route::delete('trails_perma_del/{id}', ['uses' => 'Admin\TrailsController@perma_del', 'as' => 'trails.perma_del']);
    Route::resource('trailscertificates', 'Admin\TrailscertificatesController');
    Route::post('trailscertificates_mass_destroy', ['uses' => 'Admin\TrailscertificatesController@massDestroy', 'as' => 'trailscertificates.mass_destroy']);
    Route::post('trailscertificates_restore/{id}', ['uses' => 'Admin\TrailscertificatesController@restore', 'as' => 'trailscertificates.restore']);
    Route::delete('trailscertificates_perma_del/{id}', ['uses' => 'Admin\TrailscertificatesController@perma_del', 'as' => 'trailscertificates.perma_del']);
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('teams', 'Admin\TeamsController');
    Route::post('teams_mass_destroy', ['uses' => 'Admin\TeamsController@massDestroy', 'as' => 'teams.mass_destroy']);
    Route::resource('user_actions', 'Admin\UserActionsController');
    Route::resource('datatrails', 'Admin\DatatrailsController');
    Route::post('datatrails_mass_destroy', ['uses' => 'Admin\DatatrailsController@massDestroy', 'as' => 'datatrails.mass_destroy']);
    Route::post('datatrails_restore/{id}', ['uses' => 'Admin\DatatrailsController@restore', 'as' => 'datatrails.restore']);
    Route::delete('datatrails_perma_del/{id}', ['uses' => 'Admin\DatatrailsController@perma_del', 'as' => 'datatrails.perma_del']);
    Route::resource('datacourses', 'Admin\DatacoursesController');
    Route::post('datacourses_mass_destroy', ['uses' => 'Admin\DatacoursesController@massDestroy', 'as' => 'datacourses.mass_destroy']);
    Route::post('datacourses_restore/{id}', ['uses' => 'Admin\DatacoursesController@restore', 'as' => 'datacourses.restore']);
    Route::delete('datacourses_perma_del/{id}', ['uses' => 'Admin\DatacoursesController@perma_del', 'as' => 'datacourses.perma_del']);

    Route::resource('datalessons', 'Admin\DatalessonsController');
    Route::post('datalessons_mass_destroy', ['uses' => 'Admin\DatalessonsController@massDestroy', 'as' => 'datalessons.mass_destroy']);
    Route::post('datalessons_restore/{id}', ['uses' => 'Admin\DatalessonsController@restore', 'as' => 'datalessons.restore']);
    Route::delete('datalessons_perma_del/{id}', ['uses' => 'Admin\DatalessonsController@perma_del', 'as' => 'datalessons.perma_del']);


    Route::resource('tests', 'Admin\TestsController');
    Route::resource('roles', 'Admin\RolesController');
    Route::resource('topics', 'Admin\TopicsController');
    Route::resource('questions', 'Admin\QuestionsController');
    Route::resource('questions_options', 'Admin\QuestionsOptionsController');
    Route::resource('results', 'Admin\ResultsController');

    Route::post('topics_mass_destroy', ['uses' => 'Admin\TopicsController@massDestroy', 'as' => 'topics.mass_destroy']);
    Route::post('questions_mass_destroy', ['uses' => 'Admin\QuestionsController@massDestroy', 'as' => 'questions.mass_destroy']);
    Route::post('questions_options_mass_destroy', ['uses' => 'Admin\QuestionsOptionsController@massDestroy', 'as' => 'questions_options.mass_destroy']);
    Route::post('results_mass_destroy', ['uses' => 'Admin\ResultsController@massDestroy', 'as' => 'results.mass_destroy']);

    Route::model('messenger', 'App\MessengerTopic');
    Route::get('messenger/inbox', 'Admin\MessengerController@inbox')->name('messenger.inbox');
    Route::get('messenger/outbox', 'Admin\MessengerController@outbox')->name('messenger.outbox');
    Route::resource('messenger', 'Admin\MessengerController');

    Route::get('testimonal', 'HomeController@testimonal');
    Route::post('savecoursefeedback', 'HomeController@savecoursefeedback')->name('savecoursefeedback');
    Route::post('savetrailfeedback', 'HomeController@savetrailfeedback')->name('savetrailfeedback');

    Route::get('search', 'MegaSearchController@search')->name('mega-search');
    Route::get('language/{lang}', function ($lang) {
        return redirect()->back()->withCookie(cookie()->forever('language', $lang));
    })->name('language');});
