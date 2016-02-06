<?php

/**
 * Remove any registration
 */
Route::any('/auth/register', function() {
	return redirect('/');
});

/**
 * Basic Pages Controller
 */
Route::get('/', 'ArticleController@index');
Route::get('contact', 'PagesController@contact');
Route::get('about', 'PagesController@about');

Route::get('blog/manage', 'ManageController@manageArticles');



Route::get('install', [
			'as' => 'install', 'uses' => 'Install\InstallController@installBlogShow']);
Route::post('install', [
			'as' => 'install', 'uses' => 'Install\InstallController@installBlog']);

Route::post('install/register', [
			'as' => 'install.register', 'uses' => 'Install\InstallController@installRegister']);
Route::post('install/manage', [
			'as' => 'install.manage', 'uses' => 'Install\InstallController@installManage']);


/**
 * Handles install and update of blog info
 */
Route::post('blog/manage/store', [
			'as' => 'blog.manage.store', 'uses' => 'ManageController@storeBlogInfo']);

/**
 * Basic search with post data
 */
Route::post('blog/search', [
			'as' => 'blog.search', 'uses' => 'ArticleController@search']);
/**
 * Auth controller
 */
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


/**
 * Main Blog articles controller
 */
Route::resource('blog', 'ArticleController');
Route::get('blog/{year}/{month}', 'ArticleController@showMonth');


/**
 * Tags Controller routes
 */
Route::get('tags/{tag}', 'TagsController@show');

/**
 * Tags Controller routes
 */
Route::get('category/{category}', 'CategoryController@show');
