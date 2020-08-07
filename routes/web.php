<?php

/*
 * Public Routes
 */
Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@getHome',
]);

Route::get('article/{id}/{title?}', [
    'as' => 'getArticle',
    'uses' => 'ArticleController@getArticle',
]);
Route::get('category/{id}/{name?}', [
    'as' => 'getCategory',
    'uses' => 'ArticleController@getCategory',
]);

/*
 * Login routes
 */

Route::get('login', [
    'as' => 'login',
    'uses' => 'LoginController@getLogin',
]);
Route::get('logout', [
    'as' => 'logout',
    'uses' => 'LoginController@userLogout',
]);
Route::post('postLogin', [
    'as' => 'postLogin',
    'uses' => 'LoginController@postLogin',
]);
Route::get('profile/{id}/{name?}', [
    'as' => 'profile',
    'uses' => 'UserProfileController@getProfile',
]);
/*
 * Authenticated User routes
 */

Route::group([
    'middleware' => 'auth'
], function () {

    Route::get('addArticle', [
        'as' => 'addArticle',
        'uses' => 'ArticleController@getNewArticlePage',
    ]);
    Route::get('likeArticle', [
        'as' => 'likeArticle',
        'uses' => 'ArticleController@likeArticle',
    ]);
    Route::post('postArticle', [
        'as' => 'postArticle',
        'uses' => 'ArticleController@postArticle',
    ]);
    Route::get('editProfile/{id}}', [
        'as' => 'editProfile',
        'uses' => 'UserProfileController@editProfile',
    ]);
    Route::post('postEditProfile', [
        'as' => 'postEditProfile',
        'uses' => 'UserProfileController@postEditProfile',
    ]);
    Route::post('postComment', [
        'as' => 'postComment',
        'uses' => 'ArticleController@postComment',
    ]);
});

/*
 * Admin Login routes
 */

Route::get('admin/login', [
    'as' => 'adminLogin',
    'uses' => 'LoginController@getAdminLoginPage',
]);
Route::post('admin/login', [
    'as' => 'postAdminLogin',
    'uses' => 'LoginController@postAdminLogin',
]);
Route::get('admin/logout', [
    'as' => 'adminLogout',
    'uses' => 'LoginController@AdminLogout',
]);

/*
 * Admin Authenticated routes
 */
Route::group([
    'prefix' => 'admin',
    'middleware' => 'isAdmin'
], function () {

    Route::get('/', [
        'uses' => 'AdminController@getHome',
        'as' => 'adminHome'
    ]);
    /*
     * Department
     */
    Route::get('departments', [
        'as' => 'departments',
        'uses' => 'AdminController@getDepartments'
    ]);
    Route::get('getDepartments', [
        'uses' => 'AdminController@getDepartmentsDetails',
        'as' => 'getDepartments'
    ]);
    Route::post('addDepartments', [
        'uses' => 'AdminController@addDepartments',
        'as' => 'addDepartments'
    ]);
    Route::get('deleteDepartment', [
        'as' => 'deleteDepartment',
        'uses' => 'AdminController@deleteDepartment',
    ]);
    /*
     * Course
     */
    Route::get('courses', [
        'as' => 'courses',
        'uses' => 'AdminController@getCoursePage'
    ]);
    Route::post('addCourse', [
        'as' => 'addCourse',
        'uses' => 'AdminController@addCourse'
    ]);
    Route::get('getCourses', [
        'as' => 'getCourses',
        'uses' => 'AdminController@getCourses'
    ]);
    Route::get('deleteCourse', [
        'as' => 'deleteCourse',
        'uses' => 'AdminController@deleteCourse'
    ]);
    Route::get('getAllDepartments', [
        'as' => 'getAllDepartments',
        'uses' => 'AdminController@getAllDepartments'
    ]);
    /*
     * Student
     */
    Route::get('students', [
        'as' => 'getStudents',
        'uses' => 'AdminController@getStudentsPage'
    ]);
    Route::get('getAllCourses', [
        'as' => 'getAllCourses',
        'uses' => 'AdminController@getAllCourses'
    ]);
    Route::post('addStudent', [
        'as' => 'addStudent',
        'uses' => 'AdminController@addStudent'
    ]);
    Route::get('getStudentDetails', [
        'as' => 'getStudentDetails',
        'uses' => 'AdminController@getStudentDetails'
    ]);
    Route::get('deleteStudent', [
        'as' => 'deleteStudent',
        'uses' => 'AdminController@deleteStudent'
    ]);
    Route::get('changeStatus', [
        'as' => 'changeStatus',
        'uses' => 'AdminController@changeStatus'
    ]);
    /*
     * faculties
     */
    Route::get('faculties', [
        'as' => 'getFaculty',
        'uses' => 'AdminController@getFacultyPage'
    ]);
    Route::get('getFacultyDetails', [
        'as' => 'getFacultyDetails',
        'uses' => 'AdminController@getFacultyDetails'
    ]);
    Route::post('addFaculty', [
        'as' => 'addFaculty',
        'uses' => 'AdminController@addFaculty'
    ]);
    Route::get('deleteFaculty', [
        'as' => 'deleteFaculty',
        'uses' => 'AdminController@deleteFaculty'
    ]);
    /*
     * Moderator
     */
    Route::get('moderators', [
        'as' => 'moderators',
        'uses' => 'AdminController@getModeratorsPage'
    ]);
    Route::post('postModerators', [
        'as' => 'postModerators',
        'uses' => 'AdminController@postModerators'
    ]);
    Route::get('getModerators', [
        'as' => 'getModerators',
        'uses' => 'AdminController@getModerators'
    ]);

    Route::group([
        'prefix' => 'moderator',
    ], function () {
        Route::get('newArticles', [
            'as' => 'newArticles',
            'uses' => 'ModeratorController@getAllArticlesPage'
        ]);
        Route::get('approvedArticles', [
            'as' => 'approvedArticles',
            'uses' => 'ModeratorController@approvedArticles'
        ]);
        Route::get('rejectedArticles', [
            'as' => 'rejectedArticles',
            'uses' => 'ModeratorController@rejectedArticles'
        ]);
        Route::get('getRejectedArticles', [
            'as' => 'getRejectedArticles',
            'uses' => 'ModeratorController@getRejectedArticles'
        ]);
        Route::get('getArticles', [
            'as' => 'getArticles',
            'uses' => 'ModeratorController@getArticles'
        ]);
        Route::get('getApprovedArticles', [
            'as' => 'getApprovedArticles',
            'uses' => 'ModeratorController@getApprovedArticles'
        ]);
        Route::get('approveArticle', [
            'as' => 'approveArticle',
            'uses' => 'ModeratorController@approveArticle'
        ]);
        Route::get('rejectArticle', [
            'as' => 'rejectArticle',
            'uses' => 'ModeratorController@rejectArticle'
        ]);
    });
});
