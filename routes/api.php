<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('lessons', 'LessonsController', ['except' => ['create', 'edit']]);

        Route::resource('coursecategories', 'CoursecategoriesController', ['except' => ['create', 'edit']]);

        Route::resource('coursetags', 'CoursetagsController', ['except' => ['create', 'edit']]);

        Route::resource('courses', 'CoursesController', ['except' => ['create', 'edit']]);

        Route::resource('coursescertificates', 'CoursescertificatesController', ['except' => ['create', 'edit']]);

        Route::resource('generals', 'GeneralsController', ['except' => ['create', 'edit']]);

        Route::resource('trailcategories', 'TrailcategoriesController', ['except' => ['create', 'edit']]);

        Route::resource('trailtags', 'TrailtagsController', ['except' => ['create', 'edit']]);

        Route::resource('trails', 'TrailsController', ['except' => ['create', 'edit']]);

        Route::resource('trailscertificates', 'TrailscertificatesController', ['except' => ['create', 'edit']]);

        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);

        Route::resource('datatrails', 'DatatrailsController', ['except' => ['create', 'edit']]);

        Route::resource('datacourses', 'DatacoursesController', ['except' => ['create', 'edit']]);
        
        Route::resource('datalessons', 'DatalessonsController', ['except' => ['create', 'edit']]);

});
