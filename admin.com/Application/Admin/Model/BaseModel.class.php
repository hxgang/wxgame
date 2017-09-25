<?php
/**
 * Created by PhpStorm.
 * User: ying
 * Date: 2015/11/2
 * Time: 13:15
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BaseModel extends Model
{
    // 是否批处理验证
    protected $patchValidate = true;

    /**
     * 得到分数工具条和分页数据
     * @return array
     */
    public function getPageResult($wheres = array())
    {
        $wheres['status'] = array('NEQ', '-1');
        //分页工具条
        $total = $this->count();
        $pageSize = C('PAGE_SIZE') ? C('PAGE_SIZE') : 10;
        $page = new Page($total, $pageSize);  //在Page类中设置了，不传递当前页码就为1.
        $pageHtml = $page->show(); //Page类里面的show方法，用来显示分页工具条。
        //页面展示数据
        $rows = $this->where($wheres)->order('sort asc')->limit($page->firstRow, $page->listRows)->select();
        return array('list' => $rows, 'page' => $pageHtml);
    }

    /**
     * 根据id去改变一条数据的状态。
     * @param $id
     * @param $status
     */
    public function changeStatus($id, $status)
    {
        $data = array('status' => $status);
        $wheres = array('id' => array('in', $id));
        if ($status == -1) {
            $data['name'] = array('exp', 'concat(name,"_del")');
        }
        return $this->where($wheres)->save($data);
    }

    /**
     * 得到所有处于显示状态的数据
     * @return mixed
     */
    public  function  getAllList($wheres=array(),$field='*'){
        $wheres['status']=1;
        return $this->field($field)->where($wheres)->order('sort')->select(); //默认是升序
    }

    /**
     * 得到所有的数据
     * @return mixed
     */
    public  function  getList($field="id,name,parent_id"){
        return $this->where("status>=0")->field($field)->order('lft')->select(); //默认是升序
    }

}