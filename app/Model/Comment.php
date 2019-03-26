<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comment";

    //获取评论数据
    public function getLists()
    {
    	return self::select("comment.id","novel.name","user.username","comment.content","comment.status")
    			->leftJoin("novel","novel.id","=","comment.novel_id")
    			->leftJoin("user","user.id","=","comment.user_id")
    			->orderBy("comment.id","desc")
    			->paginate(2)
    			->toArray();
    }


    public function checkComment($id)
    {
    	return self::where("id",$id)->where("status",1)->update(['status'=>2]);
    }

    public function del($id)
    {
    	return self::where('id',$id)->delete();
    }

    //添加评论
    public function addRecord($data)
    {
        return self::insert($data);
    }

    //评论列表
    public function getCommentList($novelId)
    {
        return self::select("comment.id","user.username","content","comment.created_at")
                        ->leftJoin("user","user_id","=","comment.user_id")
                        ->where("comment.novel_id",$novelId)
                        ->orderBy("comment.id","desc")
                        ->get()
                        ->toArray();
    }

}
