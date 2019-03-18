<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Author;

class AuthorController extends Controller
{	
	//作者列表
    public function list()
    {	

    	$author = new Author();

    	$assign['author'] = $author->getLists();

    	return view("admin.author.list",$assign);
    }


    //作者添加
    public function create()
    {	
    	return view("admin.author.create");
    }

    //执行作者添加
    public function store(Request $request)
    {
    	$params = $request->all();

    	unset($params['_token']);

    	$author = new Author();

    	$res = $author->addRecord($params);

    	if(!$res){
    		return redirect()->back();
    	}

    	return redirect("/admin/author/list");
    }	


    public function del($id)
    {
    	$author = new Author();

    	$res = $author->del($id);

    	
    	return redirect("/admin/author/list");
    	

    }
}
