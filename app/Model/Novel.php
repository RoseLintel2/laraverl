<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    

    protected $table = "novel";

    public function getLists()
    {
    	return self::select("novel.id","c_name","author_name","c_id","a_id","name","novel.image_url","tags","status")
    				->leftJoin("category","novel.c_id","=","category.id")
    				->leftJoin("author","novel.a_id","=","author.id")
    				->orderBy("novel.id","desc")
    				->paginate(2);
    }


    //小说添加
    public function addRecord($data)
    {
    	return self::insert($data);
    }

    public function del($id)
    {
    	return self::where("id",$id)->delete();
    }

    public function getNovelInfo($id)
    {
    	return self::where("id",$id)->first();
    }

    public function updateInfo($data,$id)
    {
    	return self::where("id",$id)->update($data);
    }
}
