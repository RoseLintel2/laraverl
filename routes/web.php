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
    return view('welcome');
});



Route::any("/show","SendController@show");

Route::get("/home",function(){
	return view('show',['name' => "黑飞"]);
});

Route::middleware('check_age')->group( function () {
    Route::get('checkAge', function () {
        return "I'm young";
    });   
});

Route::prefix('study')->group(function(){
	Route::any("user","study\BsStudyController@index");
	Route::any("study/houns","study\BsStudyController@houns");
	Route::any("study/getHounsLists","study\BsStudyController@getHounsLists");
	Route::any("study/addHouns","study\BsStudyController@addHouns");


	Route::get("guess/add","Study\GuessController@add"); //足球竞猜添加页面
    Route::any("guess/store","Study\GuessController@store"); //执行足球竞猜添加页面
    Route::get("guess/list","Study\GuessController@list");//竞猜记录

    Route::get("guess/guess","Study\GuessController@addUserRecord"); //用户竞猜
    Route::post("guess/doGuess","Study\GuessController@doGuess"); //用户竞猜
    Route::get("guess/record","Study\GuessController@reCord"); //竞猜结果




    Route::get("exam/add","Study\ExamController@add");
    Route::post("exam/store","Study\ExamController@store");
    Route::get("exam/list","Study\ExamController@list");

    Route::get("exam/guess","Study\ExamController@guess");
    Route::post("exam/doGuess","Study\ExamController@doGuess");
    Route::get("exam/result","Study\ExamController@result");


});



Route::get("403",function(){
		return view("403");
});

Route::prefix("admin")->group(function(){
	Route::any("home","Admin\HomeController@home");
	Route::any("login","Admin\AdminController@login");
	Route::any("getlogin","Admin\AdminController@getLogin");
	Route::any("logout","Admin\AdminController@logout");
	
});

Route::middleware(['admin_auth','permission_auth'])->prefix('admin')->group(function(){

	###################################[权限相关]##########################
	//后台首页
	Route::get("home","Admin\HomeController@home")->name("admin.home");
	//权限列表展示
	Route::get("/permission/list","Admin\PermissionController@list")->name("admin.permission.list");
	//获取权限数据
	Route::any("/get/permission/list/{fid?}","Admin\PermissionController@getPermissionList")->name("admin.get.permission.list");
	//权限添加
	Route::get("/permission/create","Admin\PermissionController@create")->name("admin.permission.create");
	//执行权限添加
	Route::post("/permission/doCreate","Admin\PermissionController@doCreate")->name("admin.permission.doCreate");
	//删除
	Route::get("/permission/del/{id}","Admin\PermissionController@del")->name("admin.permission.del");
	###################################[权限相关]##########################



	###################################[用户相关]##########################
	#//用户添加
	Route::get("/user/add","Admin\AdminUsersController@create")->name("admin.user.add");
	//执行用户添加
	Route::post("user/store","Admin\AdminUsersController@store")->name("admin.user.store");
	//用户列表
	Route::get("/user/list","Admin\AdminUsersController@list")->name("admin.user.list");
	//用户删除
	Route::get("/user/del/{id}","Admin\AdminUsersController@delUser")->name("admin.user.del");
	//用户编辑
	Route::get("user/edit/{id}","Admin\AdminUsersController@edit")->name("admin.user.edit");
	//用户编辑
	Route::post("/user/doEdit","Admin\AdminUsersController@doEdit")->name("admin.user.doEdit");

	###################################[用户相关]##########################
	
	###################################[角色相关]##########################
	//角色列表
	Route::get("/role/list","Admin\RoleController@list")->name("admin.role.list");
	//角色添加
	Route::get("/role/create","Admin\RoleController@create")->name("admin.role.create");
	//执行角色添加
	Route::post("/role/store","Admin\RoleController@store")->name("admin.role.store");
	//角色删除
	Route::get("/role/del/{id}","Admin\RoleController@delRole")->name("admin.role.del");
	//角色编辑
	Route::get("/role/edit/{id}","Admin\RoleController@edit")->name("admin.role.edit");
	//执行角色编辑
	Route::post("/role/doEdit","Admin\RoleController@doEdit")->name("admin.role.doEdit");
	//角色权限编辑
	Route::get("/role/permission/{id}","Admin\RoleController@rolePermission")->name("admin.role.permission");
	//执行角色权限编辑
	Route::post("/save/role/permission","Admin\RoleController@saveRolePermission")->name("admin.save.role.permission");

	###################################[角色相关]##########################
});



