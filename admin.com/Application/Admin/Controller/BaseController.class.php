<?php
/**
 * Created by PhpStorm.
 * User: ying
 * Date: 2015/11/2
 * Time: 12:48
 */

namespace Admin\Controller;

use Think\Controller;

class BaseController extends Controller
{
    protected $model;
    protected $useAllPostParams=true;  //是否使用所有post传来的数据
    public function _initialize(){
        $this->model=D(CONTROLLER_NAME);
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
        $this->assign(get_defined_vars());
    }

    /**
     * 展示列表
     */
    public function index()
    {
        //得到搜索的关键字。
        $wheres = array();
        $keyword = I('get.keyword');
        if (!empty($keyword)) {
            $wheres['name'] = array('like', "%$keyword%"); //按关键字模糊查询
        }
        $this->_setWheres($wheres);

        //得到分页的数据和分页工具代码
        $data = $this->model->getPageResult($wheres);
        //把当前地址保存在cookie中
        cookie('__forword__', $_SERVER['REQUEST_URI']);
        $this->assign('meta_title',$this->meta_title);
        $this->_before_index_view();
        $this->assign(get_defined_vars());
        $this->display('index');
    }

    /**
     * 主要是被子类覆盖,提供查询条件
     * @param $wheres
     */
    protected function _setWheres(&$wheres){

    }

    /**
     * 准备是被子类覆盖,为列表页面展示之前准备数据
     */
    protected function _before_index_view(){

    }


    /**
     * 添加
     */
    public function add()
    {
        if (IS_POST) {
            //>>2.用模型中的add方法得到数据
            if ($this->model->create() !== false) {
                if ($this->model->add($this->useAllPostParams?I('post.'):'') !== false) {
                    $this->success('添加成功', cookie('__forword__'));
                    return; //这里一定要退出，不然后面的代码无论如何都要执行。
                }
            }
            $this->error('操作失败' . showError($this->model));
        } else {
            $this->_before_show_view();
            $this->assign('meta_title', '添加' . $this->meta_title); //meta_title在子类中。
            $this->display('edit');
        }
    }

    /**
     * 编辑
     * @param $id
     */
    public function edit($id)
    {
        if (IS_POST) {
            //用模型中的save方法得到数据
            if ($this->model->create() !== false) {
                if ($this->model->save($this->useAllPostParams?I('post.'):'') !== false) {
                    $this->success('修改成功', cookie('__forword__'));
                    return; //这里一定要退出，不然后面的代码无论如何都要执行。
                }
            }
            $this->error('操作失败' . showError($this->model));

        } else {
            //得到所有信息。
            $row = $this->model->find($id);
//            print_r($row);
            //传递查到的所有信息。
            $this->assign($row);
            //展示编辑页面
            $this->assign('meta_title', '编辑' . $this->meta_title);
            $this->_before_show_view(); //这里调用钩子函数，实现其余数据的处理。
            $this->display('edit');
        }
    }

    protected function _before_show_view(){
        /*相当于预留了而一个处理其余数据的位置，有需要的就直接重写覆盖，不需要的也不会出错
            通常称之为钩子函数。 规则：用protected限制范围，宝成可以被继承，用下划线开头，显示不同。
        */

    }

    /**
     * 修改状态。（移除和修改是否显示）
     * @param $id
     * @param int $status
     */
    public function changeStatus($id, $status = -1)
    {
        if ($this->model->changeStatus($id, $status) !== false) {
            $this->success('操作成功', cookie('__forword__'));
        } else {
            $this->error('操作失败');
        }
    }
}