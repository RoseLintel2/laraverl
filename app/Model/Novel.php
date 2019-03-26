<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

    //获取banner图
    public function bannersList($nums =3)
    {
        return self::select("id","image_url")
                        ->orderBy("id","desc")
                        ->limit($nums)
                        ->get()
                        ->toArray();
    }

    //获取首页最新小说
    public function newsNovel($nums = 3)
    {
        return self::select("novel.id","novel.name","author.author_name","novel.tags","novel.desc","novel.image_url")
                        ->leftJoin("author","novel.a_id","=","author.id")
                        ->orderBy("novel.id","desc")
                        ->limit($nums)
                        ->get()
                        ->toArray();
    }

    //获取首页点击小说
    public function clicksList($nums = 3)
    {
        return self::select("novel.id","novel.name","author.author_name","novel.tags","novel.desc","novel.image_url","clicks")
                        ->leftJoin("author","novel.a_id","=","author.id")
                        ->orderBy("novel.clicks","desc")
                        ->limit($nums)
                        ->get()
                        ->toArray();
    }


    //获取小说列表
    public function novelLists()
    {
        return self::select("novel.id","author_name","name","novel.image_url","tags","status")
                    ->leftJoin("author","novel.a_id","=","author.id")
                    ->orderBy("novel.id","desc")
                    ->paginate(4);
    }

    public function getNoveListByCid($cId)
    {
        return self::select("novel.id","author_name","name","novel.image_url","tags","status")
            ->leftJoin("author","novel.a_id","=","author.id")
            ->where("novel.c_id",$cId)
            ->orderBy("id","desc")
            ->get()
            ->toArray();
    }

    public function getNoveListByName($name)
    {
        return self::select("novel.id","author_name","name","novel.image_url","tags","status")
            ->leftJoin("author","novel.a_id","=","author.id")
            ->where("novel.name","like","%".$name."%")
            ->orwhere("author_name",$name)
            ->orderBy("id","desc")
            ->get()
            ->toArray();
    }


    public function ReadRankList($num = 6)
    {
        return self::select("name","read_num","id")
                        ->orderBy("read_num","desc")
                        ->limit($num)
                        ->get()
                        ->toArray();
    }

    //根据novelId查询小说信息
    public function DetailByNovelId($novelId)
    {
        return self::select("novel.id","author_name","name","novel.image_url","tags","status","c_name","desc","read_num")
                            ->leftJoin("author","novel.a_id","=","author.id")
                            ->leftJoin("category","c_id","=","category.id")
                            ->where("novel.id",$novelId)
                            ->first();
    }

    //修改点击次数
    public function updateClicks($id)
    {
        return self::where("id",$id)
                        ->update(['clicks'=>DB::raw('clicks+1')]);
    }
}
