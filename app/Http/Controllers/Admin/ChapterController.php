<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Chapter;

class ChapterController extends Controller
{
    public function create($id)
    {	

    	$assign['novel_id'] = $id;

    	return view("admin.chapter.create",$assign);
    }

    //保存章节
    public function store(Request $request)
    {
    	$params = $request->all();

    	unset($params['_token']);

    	$chapter = new Chapter();

    	$res = $chapter -> addRecord($params);

    	if(!$res){
    		return redirect("/admin/chapter/add/"+$params['novel_id']);
    	}

    	return redirect("/admin/chapter/list");

    }

    public function list($novelId = 0)
    {	
    	$chapter = new Chapter();

    	$assign['chapter']  = $chapter->getLists($novelId);

    	return view("admin.chapter.list",$assign);
    }

    public function del($id)
    {
    	$chapter = new Chapter();

    	$res = $chapter->delRecord($id);
    	return redirect("/admin/chapter/list");
    }

    public function edit($id)
    {
    	$chapter = new Chapter();

    	$assign['chapter'] = $chapter->getChapter($id);

    	return view("admin.chapter.edit",$assign);
    }
    public function doEdit(Request $request)
    {
    	$params = $request->all();
    	
    	$id = $params['id'];

    	unset($params['_token']);
    	
    	$chapter = new Chapter();

    	$res = $chapter->editRecord($params,$id);

    	if(!$res){
    		return redirect("/admin/chapter/edit"+$params['novel_id']);
    	}
    	return redirect("/admin/chapter/list/".$params['novel_id']);
    }
}
