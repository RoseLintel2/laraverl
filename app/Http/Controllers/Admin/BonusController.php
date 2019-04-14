<?php

namespace App\Http\Controllers\Admin;

use App\Model\Bonus;
use App\Model\UserBonus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
class BonusController extends Controller
{
    //列表
    public function list()
    {
        $bonus = new Bonus();

        $assign['bonus_list'] = $this->getLists($bonus);

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

        $bonus = new Bonus();

        $res = $this->storeData($bonus,$params);

        if(!$res){
            return redirect()->back()->with("msg","添加数据失败");
        }

        return redirect("/admin/bonus/list");
    }

    //修改
    public function edit($id)
    {
        $bonus = new  Bonus();

        $assign['bonusInfo'] = $this->getDataInfo($bonus,$id);

        return view("admin.bonus.edit",$assign);
    }

    //执行修改
    public function doEdit(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);

        $bonus = new bonus();

        $res = $this->updateDataInfo($bonus,$params,$params['id']);

        if(!$res){
            return redirect()->back()->with('msg',"修改红包数据失败");
        }

        return redirect("/admin/bonus/list");
    }

    //删除
    public function del($id)
    {
        $bonus = new Bonus();

        $this->delRecord($bonus,$id);

        return redirect("/admin/bonus/list");
    }


    //发放红包
    public function sendAdd($id)
    {
        $bonus  = new Bonus();

        $assign['bonus_info'] = $this->getDataInfo($bonus,$id);

//                $b="2019-04-04";
//               $a = strtotime("{$b}+1 days");
//               dd(date("Y-m-d",$a));
        return view("admin.bonus.send",$assign);
    }

    //执行添加红包发放记录
    public function sendStore(Request $request)
    {
        $params = $request->all();

        $params = $this->delToken($params);
        dd($params);
        if(!isset($params['phone']) || empty($params['phone'])){
            return redirect()->back()->with("msg","用户手机号不能为空");
        }

        $user = new User();

        $userInfo = $this->getDataInfo($user,$params['phone'],"phone");

        if(empty($userInfo)){
            return redirect()->back()->with("msg","用户不存在");
        }

        $data = [
            "user_id"=>$userInfo->id,
            'bonus_id' => $params['bonus_id'],
            "start_time" =>$params['start_time'],
            "end_time" => $params['start_time'],
            "status" => $params['status']
        ];
        dd($data);
        $userBonus = new UserBonus();

        $res = $this->storeData($userBonus,$data);

        if(!$res){
            return redirect()->back()->with("msg","添加失败");
        }

        return redirect("/admin/send/list");

    }
    //红包发放记录列表
    public function UserBonusInfo()
    {
        $userBonus = new UserBonus();

        $assign['userBonus'] = $this->getLists($userBonus);
       
//        $expires_time = $bonusData['send_start_time']+$bonusData['expires'];

        return view("admin.bonus.userBonus",$assign);
    }
}
