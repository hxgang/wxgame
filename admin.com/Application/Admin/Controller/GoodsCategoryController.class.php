<?php
namespace Admin\Controller;

use Think\Controller;

class GoodsCategoryController extends BaseController
{
    protected $meta_title = "商品分类";

    public function index()
    {
        //得到按分类顺序排类的数据。
        $data = $this->model->getList();
        $meta_title =$this->meta_title;
        $this->assign(get_defined_vars());
        cookie('__forword__', $_SERVER['REQUEST_URI']);
        $this->display('index');
    }

    //钩子函数，让父类调用子类的方法
    protected function _before_show_view(){
        //得到数需要的数据(json字符串)
        $rows=$this->model->getList();
        //准备商品种类
        $types=M('GoodsType')->field('id,name,status')->select();

        $this->assign('nodes',json_encode($rows));
        $this->assign('types',$types);
    }
}