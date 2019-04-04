<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsAttr extends Model
{
    const
        PAGE_SIZE = 5,
        END        = true;

    protected  $table="jy_goods_attr";
    public $timestamps=false;


    //列表数据
    public static function getLists($where=[])
    {
        return self::select()
                    ->leftJoin("jy_goods_type","jy_goods_type.id","=","jy_goods_attr.cate_id")
                    ->where($where)
                    ->paginate(self::PAGE_SIZE);
    }
}
