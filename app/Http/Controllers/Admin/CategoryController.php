<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Category;


class CategoryController extends Controller
{
    //小说分类列表
    public function list(){

    	$category = new Category();

    	$assign['category'] = $category->getLists();

    	return view("admin.category.list",$assign);
    }

    //分类添加
    public function create()
    {
    	return view("admin.category.create");
    }

    //执行分类添加	
    public function store(Request $request)
    {
    	$params = $request->all();

    	$category = new Category();

    	$data = [
    		"c_name" => $params['c_name']
    	];
    	$res = $category -> addRecord($data);

    	if(!$res){
    		return redirect()->back();
    	}

    	return redirect("/admin/category/list");
    }

    //删除分类
    public function del($id)
    {
    	$category = new Category();

    	$res = $category->del($id);

    	return redirect("/admin/category/list");
    }
}
