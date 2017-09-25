<?php
namespace Admin\Model;

use Admin\Service\NestedSetsService;
use Think\Model;

class GoodsCategoryModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '分类名称不能够为空!'),
        array('status', 'require', '状态不能够为空!'),
        array('sort', 'require', '排序不能够为空!'),
    );

    /**
     * 得到按左边界排序的数据
     * @return mixed
     */
    public  function  getList(){
        header('Content-Type:text/html;charset=utf-8');
       return $this->where('status>=0')->order('lft')->select();
    }

    //覆盖add方法，完成边界的计算和sql语句的执行。
    public function add(){
        //得到遵守一定规则的对象。
        $DbMysqlInterfaceImplModel=new DbMysqlInterfaceImplModel();
        //（参考原类）参数都是名字
        $NestedSetsService=new NestedSetsService($DbMysqlInterfaceImplModel,'goods_category', 'lft' , 'rgt', 'parent_id', 'id', 'level');
        //把数据传入到页面 ,父id 数据 插入到前面还是后面   在这之前已经有create接收了所有post方式提交的数据，才回执行add方法，所以接收道德数据可以在$this->data中找到
        return $NestedSetsService->insert($this->data['parent_id'],$this->data,'bottom');
    }

    public function save(){
        $DbMysqlInterfaceImplModel=new DbMysqlInterfaceImplModel();
        $NestedSetsService=new NestedSetsService($DbMysqlInterfaceImplModel,'goods_category', 'lft' , 'rgt', 'parent_id', 'id', 'level');
       //>>>只能移动节点
        $rst = $NestedSetsService->moveUnder($this->data['id'],$this->data['parent_id']);
        if($rst === false){
            $this->error="不能把父类移动到子类下面";
            return false;
        }
        //>>>实现数据的保存
        return parent::save();
    }

    public function changeStatus($id, $status)
    {
        //>>>1.得到要改变成的状态
        $data = array('status' => $status);

        //>>>2.根据该分类的边界去查询其子分类和本身,得到所有子分类及其自身的id
        $sql="SELECT  child.`id` FROM goods_category AS child,goods_category AS parent WHERE child.`lft`>=parent.`lft` AND child.`rgt`<=parent.`rgt` AND parent.`id`=$id";
        $rows=M()->query($sql);

        $id=array_column($rows,'id');  //5.5后系统中有，之前的用自己定义的
        $wheres = array('id' => array('in', $id));

        if ($status == -1) {
            $data['name'] = array('exp', 'concat(name,"_del")');
        }
        $this->where($wheres);  //返回的是this对象
        return parent::save($data); //不用this，是因为这个模型的save方法已经被覆盖了，这里只需要原始的save保存操作。
    }

}