<?php
namespace Admin\Controller;

use Admin\Model\BaseModel;
use Think\Controller;

class ArticleCategoryController extends BaseController
{
    protected $meta_title = "文章分类";

    public function index()
    {
        header("content-type:text/html;charset=utf-8");
        $row = $this->model->getList();
        $this->assign('rows',$row);
        //把当前地址保存在cookie中
        cookie('__forword__', $_SERVER['REQUEST_URI']);
        $this->assign('meta_title',$this->meta_title);
        $this->display('index');
    }
}