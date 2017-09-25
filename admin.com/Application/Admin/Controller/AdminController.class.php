<?php
namespace Admin\Controller;

use Admin\Model\BaseModel;
use Think\Controller;

class AdminController extends BaseController
{
    protected $meta_title = "管理员";
    protected $useAllPostParams=true;
    protected function _before_show_view(){
        //>>1.页面展示之前，准备所有的角色。
        $roleModel=D('Role');
        $roles=$roleModel->getAllList(array(),"id,name");
        $this->assign('roles',$roles);

        //>>2.准备所有的权限数据作为额外权限
        $permissionModel = D('Permission');
        $permissiones = $permissionModel->getList();
        $this->assign('nodes',json_encode($permissiones));

        $id = I('get.id');
        if(!empty($id)){
            //回显用户的权限
            $role_ids  = $this->model->getRoleIdByAdminId($id);
            $this->assign('role_ids',json_encode($role_ids));

            //回显用户的额外权限数据。
            $permission_ids  = $this->model->getPermissionIdByAdminId($id);
            $this->assign('permission_ids',json_encode($permission_ids));
        }
    }

    public function initPassword($id){
        $result = $this->model->initPassword($id);
        if($result===false){
            $this->error('重置密码失败!');
        }else{
            $this->success('重置密码成功!',cookie('__forward__'));
        }
    }
}