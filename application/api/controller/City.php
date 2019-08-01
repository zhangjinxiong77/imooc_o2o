<?php
namespace app\api\controller;
use think\Controller;

class City extends Controller
{
    private $obj;
    public function _initialize(){
        $this->obj = model("City");
    }

    public function getCitysByParentId()
    {
        $id = input('post.id');
        if(!$id){
            $this->error('ID不合法');
        }
        //通过ID获取二级城市
        $citys = $this->obj->getNormalCitysByParentId($id);
        //不再使用result()给前端JS返回数据；使用另一种方法，可以避免City类不再继承Controller时无法再使用$this调用result()方法
        //该方法在api/common.php中定义
        if(!$citys){
            return show(0,'error');
        }
        return show(1,'success',$citys);


    }



}