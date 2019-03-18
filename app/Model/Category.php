<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //分类表
    protected $table = "category";

    public function getLists()
    {
    	return self::paginate(2);
    }

    public function addRecord($data)
    {
    	return self::insert($data);
    }

    public function del($id)
    {
    	return self::where("id",$id)->delete();
    }

    public function getCategory()
    {
        return self::get()->toArray();
    }
}
