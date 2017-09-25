<?php
namespace Admin\Controller;

use Think\Controller;

class RoleController extends BaseController
{
    protected $meta_title = "角色";
    protected $useAllPostParams=true;  //是否使用所有post传来的数据

    protected function _before_show_view(){
        //>>1.页面展示之前得到权限分类
        $permissionModel=D('Permission');
        $rows=$permissionModel->getList();
        $this->assign('nodes',json_encode($rows));


        //>>编辑时
        $role_id=I('get.id');
        if($role_id){
            //>>1.准备角色已有的所有权限。role-permission
            $permission_ids=$this->model->getPermissionByRole($role_id);

            //>>2.把权限的id分配到页面上
            $this->assign('permission_ids',json_encode($permission_ids));


            //思想是：删除原来对应的，把现在得到的重新加入。


        }
    }
}