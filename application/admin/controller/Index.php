<?php
namespace app\admin\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function welcome()
    {
        \phpmailer\Email::send('876602469@qq.com','封装类测试','Hello world');
        return '发送邮件成功';
        return '欢迎来到O2O主后台首页！';
    }

    public function test(){
        \Map::getLngLat('北京昌平沙河地铁');   //因为Map类没有命名空间，所以可以使用\Map直接调用
    }

    public function map(){
        return \Map::staticimage('北京昌平沙河地铁');
    }
}
