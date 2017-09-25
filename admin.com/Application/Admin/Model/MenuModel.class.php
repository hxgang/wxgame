<?php
namespace Admin\Model;

use Admin\Service\NestedSetsService;
use Think\Model;

class MenuModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '菜单名称不能够为空!'),
//        array('url', 'require', '菜单的URL不能够为空!'),
//        array('parent_id', 'require', '父权限不能够为空!'),
        array('lft', 'require', '左边界不能够为空!'),
        array('rgt', 'require', '右边界不能够为空!'),
        array('level', 'require', '级别不能够为空!'),
        array('status', 'require', '状态不能够为空!'),
        array('sort', 'require', '排序不能够为空!'),
    );

    public function add($requestData){
        //>>1.得到一个符合接口条件的model
        $DbMysqlInterfaceImplModel=new DbMysqlInterfaceImplModel();
        //>>2.调用插件
        $NestedSetsService=new NestedSetsService($DbMysqlInterfaceImplModel,'menu', 'lft' , 'rgt', 'parent_id', 'id', 'level');
        //>>3.调用插件插入数据
        $id=$NestedSetsService->insert($this->data['parent_id'],$this->data,'bottom');

        //>>4.把menu_id和permission_id保存在关联表中。
//        $result=$this->handlePermission($id,$requestData['permission_ids']);

//        if($result===false){
//            return false;
//        }
    }

    public function save($requestData){
        //>>1.保存基本信息到menu表中
        $DbMysqlInterfaceImplModel=new DbMysqlInterfaceImplModel();
        $NestedSetsService=new NestedSetsService($DbMysqlInterfaceImplModel,'menu', 'lft' , 'rgt', 'parent_id', 'id', 'level');
        //>>>只能移动节点
        $rst = $NestedSetsService->moveUnder($this->data['id'],$this->data['parent_id']);
        if($rst === false){
            $this->error="不能把父类移动到子类下面";
            return false;
        }
        $result=parent::save();
        if($result===fasle){
            $this->error="保存基本信息出错";
            return false;
        }

        //>>2.保存权限到menu_permission中。
//        $result=$this->handlePermission($requestData['id'],$requestData['permission_ids']);
//        if($result){
//            return false;
//        }
    }

    public function changeStatus($id, $status)
    {
        //>>>1.得到要改变成的状态
        $data = array('status' => $status);

        //>>>2.根据该分类的边界去查询其子分类和本身,得到所有子分类及其自身的id
        $sql="SELECT  child.`id` FROM menu AS child,menu AS parent WHERE child.`lft`>=parent.`lft` AND child.`rgt`<=parent.`rgt` AND parent.`id`=$id";
        $rows=M()->query($sql);

        $id=array_column($rows,'id');  //5.5后系统中有，之前的用自己定义的
        $wheres = array('id' => array('in', $id));

        if ($status == -1) {
            $data['name'] = array('exp', 'concat(name,"_del")');
        }
        $this->where($wheres);  //返回的是this对象
        return parent::save($data); //不用this，是因为这个模型的save方法已经被覆盖了，这里只需要原始的save保存操作。
    }

//    private function handlePermission($menu_id,$permission_ids){
//        $rows=array();
//        foreach($permission_ids as $permission_id){
//            $rows[]=array("menu_id"=>$menu_id,"permission_id"=>$permission_id);
//        }
//        $menuPermissionModel=M('MenuPermission');
//        //>>先清空
//        $menuPermissionModel->where(array("menu_id"=>$menu_id))->delete();
//        //>>再增加
//        $result=$menuPermissionModel->addAll($rows);
//        if($result===false){
//            $this->error="增加权限出错";
//            return false;
//        }
//    }

    /**
     * 根据menu_id得到permission_id
     * @param $menu_id
     * @return array
     */
    public function getPermissionByMenu($menu_id){
        $sql="select permission_id from menu_permission where menu_id=$menu_id";
        $rows=$this->query($sql);
        return array_column($rows,'permission_id');

    }
}