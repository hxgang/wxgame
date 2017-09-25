<?php
namespace Admin\Controller;

use Think\Controller;

class PermissionController extends BaseController
{
    protected $meta_title = "权限";

    protected function _before_show_view(){
        //得到数需要的数据(json字符串)
        $rows=$this->model->getList();
        $this->assign('nodes',json_encode($rows));
    }

    public function index()
    {
        header('Content-Type:text/html;charset=utf-8');
        $rows = $this->model->getList('id,name,parent_id,intro,status,sort,url,level');
        if($rows) {
            $this->assign('rows',$rows);
        }
        $this->assign('meta_title',$this->meta_title);
        cookie('__forword__', $_SERVER['REQUEST_URI']);
        $this->display('index');
    }


}