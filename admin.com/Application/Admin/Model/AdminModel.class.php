<?php
namespace Admin\Model;

use Think\Model;

class AdminModel extends BaseModel
{
    protected $initPass=111111; //初始密码
    protected $_validate = array(
        array('username', 'require', '用户名不能够为空!'),
        array('username', '', '用户名已存在!','','unique'),
        array('password', 'require', '密码不能够为空!'),
        array('email', 'require', 'Email不能够为空!'),
        array('email', '', 'Email不能够为空!','','unique'),
        array('status', 'require', '状态不能够为空!'),
        array('sort', 'require', '排序不能够为空!'),
        array('add_time','require','加入时间不能够为空!'),
        array('last_login_time','require','最后登录时间不能够为空!'),
    );
    protected $_auto=array(
        array('add_time',NOW_TIME),
        array('last_login_time',NOW_TIME),
        array('salt','\Org\Util\String::randString','','function') //随机生成6位字符串，含字母和数字混合，是tp中的函数
    );

    public function add($requestData){
        //开启事务
        $this->startTrans();
        //对密码进行加盐加密处理。
        $this->data['password']=md5($this->data['password'].$this->data['salt']);
        //>>1.把通用信息加入到admin表中。
        $admin_id=parent::add();
        if($admin_id===false){
            $this->error="保存基本信息出错";
            $this->callback(); //回滚
            return false;
        }

        //>>2.把用户-角色保存在admin_role表中
       $result=$this->handleRole($admin_id,$requestData['role_ids']);
        if($result===false){
            return false;
        }

        //>>3.把额外权限保存在admin-permission表中
        $result2 = $this->handlePermission($admin_id,$requestData['permission_ids']);
        if($result2===false){
            return false;
        }
        $this->commit(); //提交
        return $admin_id;
    }

    public function save($requestData){
        //>>1.先将请求中的数据更新到admin表中
        $result = parent::save();
        if($result===false){
            return false;
        }
        //>>2.再将请求中的角色数据更新到中间表中
        $result1 =$this->handleRole($requestData['id'],$requestData['role_ids']);
        if($result1===false){
            return false;
        }
        //>>3.再将请求中的额外权限数据更新到中间表admin_permission中
        $result2 = $this->handlePermission($requestData['id'],$requestData['permission_ids']);
        if($result2===false){   //错误才为false,空的是null
            return false;
        }
        return $result;
    }


    /**
     * 根据用户id，向 admin_permission表添加权限id
     * @param $admin_id
     * @param $permission_ids
     * @return bool
     */
    private function handlePermission($admin_id,$permission_ids){
        $rows  = array();
        foreach($permission_ids as $permission_id){
            $rows[] = array('permission_id'=>$permission_id,'admin_id'=>$admin_id);
        }
        $adminPermissionModel = M('AdminPermission');
        $adminPermissionModel->where(array('admin_id'=>$admin_id))->delete();
        if(!empty($rows)){
            $result = $adminPermissionModel->addAll($rows);
            if($result===false){
                $this->error  = '添加额外权限失败!';
                $this->rollback();
                return false;
            }
        }
    }

    /**
     * 根据用户id，向admin_role表添加角色id
     * @param $admin_id
     * @param $role_ids
     * @return bool
     */
    private function handleRole($admin_id,$role_ids){
        $rows = array();
        foreach ($role_ids as $role_id) {
            $rows[] = array("admin_id" => $admin_id, "role_id" => $role_id);
        }
        $adminRoleModel = M('AdminRole');
        $adminRoleModel->where(array('admin_id'=>$admin_id))->delete();
        if(!empty($rows)){
            $result = $adminRoleModel->addAll($rows);
            if ($result === false) {
                $this->error="保存角色出错";
                $this->rollback();
                return false;
            }
        }
    }

    /**
     * 根据用户的id找到角色的id
     * @param $admin_id
     * @return array
     */
    public function getRoleIdByAdminId($admin_id){
        $sql = "select role_id from admin_role where admin_id = ".$admin_id;
        $rows = $this->query($sql);
        return array_column($rows,'role_id');
    }

    /**
     * 根据用户的id,得到权限的id
     * @param $admin_id
     * @return array
     */
    public function getPermissionIdByAdminId($admin_id){
        $sql = "select permission_id  from admin_permission where admin_id = ".$admin_id;
        $rows = $this->query($sql);
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

    /**
     * 初始化密码为6个1
     * @param $id
     * @return bool
     */
    public function initPassword($id){
        //>>1.根据id查询出盐
        $salt = $this->getFieldById($id,'salt'); //动态查询
        //>>2.再将密码和盐进行加密
        $password = md5($this->initPass.$salt);
        //>>3.加密后的结果更新到数据库表中
        return parent::save(array('id'=>$id,'password'=>$password));
    }

    public function getByUsername($username){
        return $this->where(array("username"=>$username))->find();
    }
    public function getByUserEmail($username){
        return $this->where(array("email"=>$username))->find();
    }
}