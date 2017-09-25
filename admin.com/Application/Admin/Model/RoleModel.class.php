<?php
namespace Admin\Model;

use Think\Model;

class RoleModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '角色名称不能够为空!'),
        array('status', 'require', '状态不能够为空!'),
//        array('permission_id', 'require', '角色权限不能够为空!'),
        array('sort', 'require', '排序不能够为空!'),
    );

    public function  getList($fields = "id,name,parent_id")
    {
        header('Content-Type:text/html;charset=utf-8');
        //在树状结构中，如果有url地址，会把节点变成可以点击的链接
        return $this->where('status>=0')->field($fields)->order('lft')->select();
    }

    public function add($requestData)
    {
        //>>1.把除了权限id外的数据保存在role表中。
        $role_id = parent::add();
        if ($role_id === false) {
            $this->error = "保存角色基本信息出错";
            return false;
        }
        //>>2.把permission_id和role_id保存在role_permission表中
       $this->handleRolePermission($role_id,$requestData['permission_ids']);

        return $role_id;
    }

    private function handleRolePermission($role_id,$permission_ids){
        $rows = array();
        foreach ($permission_ids as $permission_id) {
            $rows[] = array("role_id" => $role_id, "permission_id" => $permission_id);
        }
        $rolePermisssionModel = M('RolePermission');
        $rolePermisssionModel->where(array('role_id'=>$role_id))->delete();
        $result = $rolePermisssionModel->addAll($rows);
        if ($result === false) {
            $this->error = "保存角色权限出错";
            return false;
        }
    }
    public function save($requestData){
        //>>1.保存基本信息到role表
        $result=parent::save();
        if($result === false){
            $this->error="保存角色基本信息出错";
            return false;
        }
        //>>2.保存权限到role-permission表
        $this->handleRolePermission($requestData['id'],$requestData['permission_ids']);
    }


    public function getPermissionByRole($role_id)
    {
        //从role-permission表中得到数据
        $sql = "select permission_id from role_permission where role_id=$role_id";
        $rows=M()->query($sql);
        return array_column($rows,'permission_id');
    }

    public function changeStatus($id, $status)
    {
        $data = array('status' => $status);
        $wheres = array('id' => array('in', $id));
        if ($status == -1) {
            $data['name'] = array('exp', 'concat(name,"_del")');
        }
        $this->where($wheres);
        return parent::save($data);
    }

}