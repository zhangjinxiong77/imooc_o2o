<?php
namespace app\bis\controller;
use think\Controller;
class Register extends Controller
{
    public function index(){
        //获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();
        return $this->fetch('',[
            'citys' => $citys,
        ]);
    }
}