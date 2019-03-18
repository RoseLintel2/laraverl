<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //作者
    protected $table = "author";

    const PAGE_SIZE = 2;

    //作者分页展示
    public function getLists(){
    	return self::paginate(self::PAGE_SIZE);
    }

    //执行作者添加
    public function addRecord($data){
    	return self::insert($data);
    }

    //删除作者
    public function del($id)
    {
    	return self::where("id",$id)->delete();
    }

    //获取作者列表
    public function getAuthor()
    {
        return self::get()->toArray();
    }
}
