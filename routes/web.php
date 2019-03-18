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

Route::group(['prefix'=>"study"],function(){
	Route::any("user","study\BsStudyController@index");
	Route::any("study/houns","study\BsStudyController@houns");
	Route::any("study/getHounsLists","study\BsStudyController@getHounsLists");
	Route::any("study/addHouns","study\BsStudyController@addHouns");
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
	#
	###################################[小说相关]##########################
	//作者列表
	Route::get("author/list","Admin\AuthorController@list")->name("admin.author.list");
	//作者添加
	Route::get("author/create","Admin\AuthorController@create")->name("admin.author.create");
	//作者执行添加
	Route::post("author/store","Admin\AuthorController@store")->name("admin.author.store");
	//删除作者
	Route::get("author/del/{id}","Admin\AuthorController@del")->name("admin.author.del");

	//分类列表
	Route::get("category/list","Admin\CategoryController@list")->name("admin.category.list");
	//分类添加
	Route::get("category/create","Admin\CategoryController@create")->name("admin.category.create");
	//执行分类添加
	Route::post("category/store","Admin\CategoryController@store")->name("admin.category.store");
	//删除分类
	Route::get("category/del/{id}","Admin\CategoryController@del")->name("admin.category.del");

	//小说列表
	Route::get("novel/list","Admin\NovelController@list")->name("admin.novel.list");
	//小说添加
	Route::get("novel/create","Admin\NovelController@create")->name("admin.novel.create");
	//执行小说添加
	Route::post("novel/store","Admin\NovelController@store")->name("admin.novel.store");
	//编辑小说列表
	Route::get("novel/edit/{id}","Admin\NovelController@edit")->name("admin.novel.edit");
	//执行编辑小说列表
	Route::post("novel/doEdit","Admin\NovelController@doEdit")->name("admin.novel.doEdit");
	//删除小说列表
	Route::get("novel/del/{id}","Admin\NovelController@del")->name("admin.novel.del");

	//章节添加
	Route::get("chapter/create/{novel_id}","Admin\ChapterController@create")->name("admin.chapter.create");
	//章节添加
	Route::post("chapter/store","Admin\ChapterController@store")->name("admin.chapter.store");
	//章节列表
	Route::get("chapter/list/{novel_id?}","Admin\ChapterController@list")->name("admin.chapter.list");
		//章节删除
	Route::get("chapter/del/{id}","Admin\ChapterController@del")->name("admin.chapter.del");
	//章节编辑
	Route::get("chapter/edit/{id}","Admin\ChapterController@edit")->name("admin.chapter.edit");
	//执行章节编辑
	Route::post("chapter/doEdit","Admin\ChapterController@doEdit")->name("admin.chapter.doEdit");


	//评论列表
	Route::get("novel/comment/list","Admin\CommentController@list")->name("admin.novel.comment.list");
	//小说数据
	Route::get("novel/comment/data","Admin\CommentController@getComment")->name("admin.novel.comment.data");
	//评论审核
	Route::get("novel/comment/check/{id}","Admin\CommentController@check")->name("admin.novel.comment.check");
	//评论删除
	Route::get("novel/comment/del/{id}","Admin\CommentController@del")->name("admin.novel.comment.del");

	###################################[小说相关]##########################
});
