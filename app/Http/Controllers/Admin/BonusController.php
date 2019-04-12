<?php

namespace App\Http\Controllers\Admin;

use App\Model\Bonus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BonusController extends Controller
{
    //列表
    public function list()
    {
        $bonus = new Bonus();

        $assign['bonus_list'] = $this->getLists($bonus);
        dd($assign);
        return view("admin.bonus.list",$assign);
    }

    //添加
    public function add()
    {
        return view("admin.bonus.add");
    }

    //执行添加
    public function doAdd(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        dd($params);
    }
}
