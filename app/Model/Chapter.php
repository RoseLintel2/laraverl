<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table = "chapter";

    public function addRecord($data)
    {
    	return self::insert($data);
    }

    public function getLists($novelId = 0)
    {	
    	if($novelId == 0){
    		return self::select("chapter.id","novel.name","chapter.title","chapter.sort")
    					->leftJoin("novel","chapter.novel_id","=","novel.id")
    					->paginate(5);
    	}else{

    		return self::select("chapter.id","novel.name","chapter.title","chapter.sort")
    					->leftJoin("novel","chapter.novel_id","=","novel.id")
    					->where("novel_id",$novelId)
    					->paginate(5);

    	}

    	
    }

    public function delRecord($id)
    {
    	return self::where('id',$id)->delete();
    }


    //获取记录
    public function getChapter($id)
    {
    	return self::where("id",$id)->first();
    }

    //修改
    public function editRecord($data,$id)
    {
    	return self::where("id",$id)->update($data);
    }

}
