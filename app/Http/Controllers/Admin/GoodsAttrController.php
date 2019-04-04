<?php

namespace App\Http\Controllers\Admin;

use App\Model\GoodsAttr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\GoodsType;
class GoodsAttrController extends Controller
{
    //列表页面
    public function list($typeId)
    {
        $where['cate_id'] = $typeId;

        $assign['list'] = GoodsAttr::getLists($where);

        return view("admin.goodsAttr.list",$assign);
    }

    //添加页面
    public function add()
    {
        $goodsType = new GoodsType();

        $assign['list'] = $this->getLists($goodsType);

        return view('admin.goodsAttr.add',$assign);
    }

    //执行添加
    public function doAdd(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        dd($params);
    }
}
