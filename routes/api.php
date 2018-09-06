<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);

        Route::resource('courses', 'CoursesController', ['except' => ['create', 'edit']]);

        Route::resource('coursescategories', 'CoursescategoriesController', ['except' => ['create', 'edit']]);

        Route::resource('lessons', 'LessonsController', ['except' => ['create', 'edit']]);

        Route::resource('trails', 'TrailsController', ['except' => ['create', 'edit']]);

        Route::resource('trailscategories', 'TrailscategoriesController', ['except' => ['create', 'edit']]);

        Route::resource('datacourses', 'DatacoursesController', ['except' => ['create', 'edit']]);

        Route::resource('datatrails', 'DatatrailsController', ['except' => ['create', 'edit']]);

        Route::resource('teams', 'TeamsController', ['except' => ['create', 'edit']]);

});
