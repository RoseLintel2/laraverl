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

    ###################################[商品品牌相关]##########################
    //商品品牌列表页面
    Route::get("brand/list","Admin\BrandController@list")->name("admin.brand.list");
    Route::post("brand/getLists","Admin\BrandController@getLists")->name("admin.brand.getLists");
    //商品品牌添加页面
    Route::get("brand/add","Admin\BrandController@add")->name("admin.brand.add");
    //执行添加商品品牌
    Route::post("brand/doAdd","Admin\BrandController@doAdd")->name("admin.brand.doAdd");
    //删除商品品牌
    Route::get("brand/del/{id}","Admin\BrandController@del")->name("admin.brand.del");
    //修改商品品牌页面
    Route::get("brand/edit/{id}","Admin\BrandController@edit")->name("admin.brand.edit");
    //执行修改商品品牌
    Route::post("brand/doEdit","Admin\BrandController@doEdit")->name("admin.brand.doEdit");
    //修改商品品牌属性值
    Route::post("brand/updateStatus","Admin\BrandController@updateStatus")->name("admin.brand.updateStatus");
    ###################################[商品品牌相关]##########################

    ###################################[商品分类相关]##########################
    //商品分类页面
    Route::get("category/list","Admin\CategoryController@list")->name("admin.category.list");
    //商品分类数据
    Route::post("category/getCategory/{fid?}","Admin\CategoryController@getCategory")->name("admin.category.getCategory");
    //添加商品分类页面
    Route::get("category/add","Admin\CategoryController@add")->name("admin.category.add");
    //执行商品分类添加
    Route::post("category/doAdd","Admin\CategoryController@doAdd")->name("admin.category.doAdd");
    //删除商品分类
    Route::get("category/del/{id}","Admin\CategoryController@del")->name("admin.category.del");
    //修改商品分类
    Route::get("category/edit/{id}","Admin\CategoryController@edit")->name("admin.category.edit");
    //执行修改商品分类
    Route::post("category/doEdit","Admin\CategoryController@doEdit")->name("admin.category.doEdit");

    ###################################[商品分类相关]##########################

    ###################################[文章分类相关]##########################
    //文章分类页面
    Route::get("article/category/list","Admin\ArticleCategoryController@list")->name("admin.article.category.list");
    //文章添加页面
    Route::get("article/category/add","Admin\ArticleCategoryController@add")->name("admin.article.category.add");
    //执行文章添加页面
    Route::post("article/category/doAdd","Admin\ArticleCategoryController@doAdd")->name("admin.article.category.doAdd");
    //删除文章分类
    Route::get("article/category/del/{id}","Admin\ArticleCategoryController@del")->name("admin.article.category.del");
    //修改页面
    Route::get("article/category/edit/{id}","Admin\ArticleCategoryController@edit")->name("admin.article.category.edit");
    //执行修改
    Route::post("article/category/doEdit","Admin\ArticleCategoryController@doEdit")->name("admin.article.category.doEdit");
    ###################################[文章分类相关]##########################

    ###################################[文章列表相关]##########################
    //文章列表页面
    Route::get("article/article/list","Admin\ArticleController@list")->name("admin.article.article.list");
    //文章列表添加页面
    Route::get("article/article/add","Admin\ArticleController@add")->name("admin.article.article.add");
    //执行文章列表添加页面
    Route::post("article/article/doAdd","Admin\ArticleController@doAdd")->name("admin.article.article.doAdd");
    //删除文章列表
    Route::get("article/article/del/{id}","Admin\ArticleController@del")->name("admin.article.article.del");
    //修改文章页面
    Route::get("article/article/edit/{id}","Admin\ArticleController@edit")->name("admin.article.article.edit");
    //执行修改
    Route::post("article/article/doEdit","Admin\ArticleController@doEdit")->name("admin.article.article.doEdit");

    ###################################[文章列表相关]##########################


    ###################################[广告位相关]##########################
    //广告位列表
    Route::get("position/list","Admin\AdPositionController@list")->name("admin.position.list");
    //广告位添加页面
    Route::get("position/add","Admin\AdPositionController@add")->name("admin.position.add");
    //执行添加
    Route::post("position/doAdd","Admin\AdPositionController@doAdd")->name("admin.position.doAdd");
    //删除广告位
    Route::get("position/del/{id}","Admin\AdPositionController@del")->name("admin.position.del");
    //修改广告位页面
    Route::get("position/edit/{id}","Admin\AdPositionController@edit")->name("admin.position.edit");
    //执行修改
    Route::post("position/doEdit","Admin\AdPositionController@doEdit")->name("admin.position.doEdit");
    ###################################[广告位相关]##########################

    ###################################[广告相关]##########################
    //广告列表
    Route::get("ad/list","Admin\AdController@list")->name("admin.ad.list");
    //广告添加页面
    Route::get("ad/add","Admin\AdController@add")->name("admin.ad.add");
    //执行添加
    Route::post("ad/doAdd","Admin\AdController@doAdd")->name("admin.ad.doAdd");
    //删除广告
    Route::get("ad/del/{id}","Admin\AdController@del")->name("admin.ad.del");
    //修改广告页面
    Route::get("ad/edit/{id}","Admin\AdController@edit")->name("admin.ad.edit");
    //执行修改
    Route::post("ad/doEdit","Admin\AdController@doEdit")->name("admin.ad.doEdit");
    ###################################[广告相关]##########################

    ###################################[商品分类相关]##########################
    //商品分类列表
    Route::get("goods/type/list","Admin\GoodsTypeController@list")->name("admin.goods.type.list");
    //商品分类添加页面
    Route::get("goods/type/add","Admin\GoodsTypeController@add")->name("admin.goods.type.add");
    //执行添加
    Route::post("goods/type/doAdd","Admin\GoodsTypeController@doAdd")->name("admin.goods.type.doAdd");
    //删除商品分类
    Route::get("goods/type/del/{id}","Admin\GoodsTypeController@del")->name("admin.goods.type.del");
    //修改商品分类页面
    Route::get("goods/type/edit/{id}","Admin\GoodsTypeController@edit")->name("admin.goods.type.edit");
    //执行修改
    Route::post("goods/type/doEdit","Admin\GoodsTypeController@doEdit")->name("admin.goods.type.doEdit");

    ###################################[商品分类相关]##########################

    ###################################[商品分类属性相关]##########################
    //商品分类列表
    Route::get("goods/attr/list/{typeId}","Admin\GoodsAttrController@list")->name("admin.goods.attr.list");
    //商品分类添加页面
    Route::get("goods/attr/add","Admin\GoodsAttrController@add")->name("admin.goods.attr.add");
    //执行添加
    Route::post("goods/attr/doAdd","Admin\GoodsAttrController@doAdd")->name("admin.goods.attr.doAdd");
    //删除商品分类
    Route::get("goods/attr/del/{id}","Admin\GoodsAttrController@del")->name("admin.goods.attr.del");
    //修改商品分类页面
    Route::get("goods/attr/edit/{id}","Admin\GoodsAttrController@edit")->name("admin.goods.attr.edit");
    //执行修改
    Route::post("goods/attr/doEdit","Admin\GoodsAttrController@doEdit")->name("admin.goods.attr.doEdit");

    ###################################[商品分类属性相关]##########################
});



