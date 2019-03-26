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

    //小说列表
    public function getChapterList($novelId)
    {
        return self::select("id","novel_id","title")
                        ->where("novel_id",$novelId)
                        ->orderBy("sort")
                        ->get()
                        ->toArray();
    }
    //获取小说第一章节
    public function getNovelChapter($novelId)
    {
        return self::select("id")
                        ->where("novel_id",$novelId)
                        ->first();
    }
    //获取小说上一章内容
    public function getPrevChapter($novelId,$sort)
    {
        return self::where("novel_id",$novelId)
                        ->where("sort",$sort-1)
                        ->first();
    }
    //获取小说下一章内容
    public function getNextChapter($novelId,$sort)
    {
        return self::where("novel_id",$novelId)
                    ->where("sort",$sort+1)
                    ->first();
    }

    public function getChapterContent($id)
    {
        return self::where("id",$id)->first();
    }
}
