<?php
namespace Admin\Controller;

use Admin\Model\BaseModel;
use Think\Controller;

class MenuController extends BaseController
{
    protected $meta_title = "菜单";
    protected $useAllPostParams=true;

    protected function _before_show_view(){
        //>>1.得到菜单树需要的数据(json字符串)
        $rows=$this->model->getList();
        $this->assign('nodes',json_encode($rows));

        //>>2.得到权限树需要的数据
        $permissionModel=D('Permission');
        $permission_ids=$permissionModel->getList();
        $this->assign('nodes_permission',json_encode($permission_ids));

        //>>3.编辑时
        $id=I('get.id');
        if($id){
            //>>3.1得到用户的权限，在权限树中选中。
            $permission_ids=$this->model->getPermissionByMenu($id);
            $this->assign('permission_ids',json_encode($permission_ids));
            //>>3.2
        }
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