<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Novel;
use App\Model\Author;
use App\Model\Category;

use App\Tools\ToolsAdmin;

class NovelController extends Controller
{
    
    public function list()
    {	
    	$novel = new Novel();

    	$assign['novel'] = $novel->getLists();
    		// dd($assign);
    	return view("admin.novel.list",$assign);
    }

    public function create()
    {	
    	$category = new Category();
    	$author = new Author();

    	$assign['category'] = $category->getCategory();
    	$assign['author'] = $author->getAuthor();

    	return view("admin.novel.create",$assign);
    }

    public function store(Request $request)
    {
    	$params = $request->all(); 

    	$image_url = ToolsAdmin::uploadFile($params['image_url']);
    		
    	unset($params['_token']);

    	$params['image_url'] = $image_url;

    	$novel = new Novel();

    	$res = $novel -> addRecord($params);

    	if(!$res){
    	
    		return redirect()->back();
    	}

    	return redirect("/admin/novel/list");
    }

    public function del($id)
    {
    	$novel = new Novel();

    	$res = $novel->del($id);

    	return redirect("/admin/novel/list");
    }

    public function edit($id){

    	$category = new Category();
    	$author = new Author();

    	$novel = new Novel();


    	$assign['category'] = $category->getCategory();
    	$assign['author'] = $author->getAuthor();

    	$assign['novel'] = $novel->getNovelInfo($id);
    		// dd($assign);
    	return view('admin.novel.edit',$assign);
    }

    //执行小说编辑
    public function doEdit(Request $request)
    {
    	$params = $request->all();

    	if(isset($params['image_url'])){
    		$image_url = ToolsAdmin::uploadFile($params['image_url']);
    	}
    	
    	$id = $params['id'];
    		
    	unset($params['_token']);

    	unset($params['id']);

    	$params['image_url'] = $image_url;
 
    	$novel = new Novel();

    	$res = $novel -> updateInfo($params,$id);

    	if(!$res){
    	
    		return redirect()->back();
    	}

    	return redirect("/admin/novel/list");
    }

}
