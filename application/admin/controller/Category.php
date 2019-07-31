<?php
namespace app\admin\controller;
use think\Controller;

class Category extends Controller
{
    private $obj;
    public function _initialize(){
        $this->obj = model("Category");
    }

    public function index()
    {
        $parentId = input('get.parent_id',0,'intval');
        $categorys = $this->obj->getFirstCategorys($parentId);
        return $this->fetch('',[
            'categorys'=>$categorys,
        ]);
    }

    //添加分类表单
    public function add()
    {

        //$categorys = model("Category")->getNormalFirstCategory();
        $categorys = $this->obj->getNormalFirstCategory();  //获取一级分类
        return $this->fetch('',[
            'categorys'=>$categorys,]
            );
    }

    public function save()
    {
        /**
         * 做下严格判定
         */
        if(!request()->isPost()){
            $this->error('请求失败');
        }
        $data = input('post.');
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        //判断是新增还是编辑
        if(!empty($data['id'])){
            return $this->update($data);
        }
        //把数据提交model
        //$res = model('Category')->add($data);
        $res = $this->obj->add($data);
        if($res){
            $this->success('新增成功'); //success是TP5的方法
        }else{
            $this->error('新增失败');
        }
    }

    /**
     * 编辑页面
     */
    public function edit($id=0){
        //echo input('get.id');   测试用语句。或者用echo $id
        if(intval($id)<1){
            $this->error('参数不合法');
        }
        $category = $this->obj->get($id); //此处使用的是继承自父类model的方法
        $categorys = $this->obj->getNormalFirstCategory();  //获取一级分类
        return $this->fetch('',[
                'categorys'=>$categorys,
                'category'=>$category,
                ]);

    }

    public function update($data){
        $res = $this->obj->save($data,['id'=>intval($data['id'])]);
        if($res){
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }

    }

}