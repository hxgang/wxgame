<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function index()
    {
        //>>1.准备所有的菜单数据
        if(isSuperUser()){
            //>>2.如果是超级管理员,查询所有的菜单
            $sql="select id,`name`,`url`,`parent_id`,`level` from permission where  status=1";
            $menus = M()->query($sql);
        }else{
            //>>2.如果不是超级管理员, 根据权限查询菜单
            $permission_ids = savePermissionId();
            if($permission_ids){
                $permission_ids = arr2str($permission_ids);
                $sql="select id,`name`,`url`,`parent_id`,`level` from permission where id in ($permission_ids) and status=1";
                $menus = M()->query($sql);
            }
        }

        $res   = D('Common/Census','Logic')->getOrderPrice();
        $data = D('Common/Census','Logic')->getOrderNum();
        $this->assign(get_defined_vars());
        $this->display('index');
    }
}