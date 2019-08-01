<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp = true; //可以避免写$data['create_time'] = time();同时会更新的还有update_time字段；
    public function add($data){
        $data['status'] = 1;
        //$data['create_time'] = time();
        return $this->save($data);
    }

    //获取一级分类选项，用于表单的单选项
    public function getNormalFirstCategory(){
        $data =[
            'status'=>1,
            'parent_id'=>0,
        ];

        $order = [
            'id'=>'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

    //获取一级分类，用于首页展示
    public function getFirstCategorys($parentId = 0){
        $data =[
            'status'=>['neq',-1],
            'parent_id'=> $parentId,
        ];

        $order = [
            'listorder' => 'desc',    //排序一节才加上此段代码
            'id'=>'desc',
        ];

        $result = $this->where($data)
            ->order($order)
            ->paginate();
            //->select();
        //echo $this->getLastSql();

        return $result;
    }


}