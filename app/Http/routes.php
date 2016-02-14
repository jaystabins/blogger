<?php

/**
 * Remove any registration unless install
 */
Route::any('/auth/register', function() {
	return redirect('/');
});

/**
 * Basic Pages Controller
 */
Route::get('/', 'ArticleController@index');

/**
 * Install Blog
 */
Route::get('install', [
			'as' => 'install', 'uses' => 'Install\InstallController@installBlogShow']);
Route::post('install', [
			'as' => 'install', 'uses' => 'Install\InstallController@installBlog']);
Route::post('install/register', [
			'as' => 'install.register', 'uses' => 'Install\InstallController@installRegister']);
Route::post('install/manage', [
			'as' => 'install.manage', 'uses' => 'Install\InstallController@installManage']);
Route::get('install/mailSettings', 'Install\InstallController@showMailSettings');
Route::post('install/mailSettings', 'Install\InstallController@storeMailSettings');
Route::get('install/socialConnect', 'Install\InstallController@showSocalConnectSettings');
Route::post('install/socialConnect', 'Install\InstallController@storeSocalConnectSettings');

/**
 * Manage Blog 
 */
Route::post('manage/checkMailSettings', 'ManageController@checkMailSettings');

/**
 * Main Page Routes
 */
Route::get('{page}', 'PagesController@index');
Route::delete('{slug}', [
			'as' => 'page.delete', 'uses' => 'PagesController@destroy']);
Route::put('{slug}', [
			'as' => 'page.update', 'uses' => 'PagesController@update']);
Route::get('page/create', 'PagesController@create');
Route::post('page/store', [
			'as' => 'page.store', 'uses' => 'PagesController@store']);
Route::get('page/edit/{slug}', [
			'as' => 'page.edit', 'uses' => 'PagesController@edit']);
Route::post('page/sendMail', 'PagesController@sendContactMail');

/**
 * Main Manage Screen
 */
Route::get('blog/manage', 'ManageController@manageArticles');
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
 * Handles ajax request to update blog Catagory Visability
 */
Route::post('category/updateCategory', 'CategoryController@updateCategory');
/**
 * Handles ajax request to check blog Catagory Visability
 */
Route::post('category/checkCategoryMenu', 'CategoryController@checkCategory');
/**
 * Category Controller routes
 */
Route::get('category/{category}', 'CategoryController@show');
