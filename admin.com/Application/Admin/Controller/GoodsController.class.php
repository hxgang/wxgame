<?php
namespace Admin\Controller;

use Think\Controller;

class GoodsController extends BaseController
{
    protected $meta_title = "商品";

    /**
     * 根据请求中的内容为wheres准备查询条件
     * @param $wheres
     */
    protected  function _setWheres($wheres){

    }

    protected function _before_index_view(){

    }

    protected function _before_show_view(){
        //编辑时，得到传来的id
        $goods_id=I('get.id');
        if($goods_id){



        }
    }

    public function deleteGoodsAlbum(){
        $album_id=$_POST['album_id'];
        $GoodsAlbumModel=D('GoodsAlbum');
        $result=array('success'=>true);
        if($GoodsAlbumModel->where(array('id'=>$album_id))->delete() === false){
            $result['success']=false;
        }
       $this->ajaxReturn($result);  //tp框架中返回ajax请求数据
    }

    public function add()
    {
        if (IS_POST) {
            //>>2.用模型中的add方法得到数据
            if ($this->model->create() !== false) {
                $requestData=I('post.','',false);
                $requestData['detail']=$requestData['editorValue'];
                if ($this->model->add($requestData) !== false) {
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
    public function edit()
    {
        $id = I('id');
        if (IS_POST) {
            //用模型中的save方法得到数据
            if ($this->model->create() !== false) {
                $requestData=I('post.','',false); //接收所有的数据
                $requestData['detail']=$requestData['editorValue'];
                unset($requestData['editorValue']);
                if($id){
                    $map['id'] =$id;
                    $res = M('goods')->where($map)->save($requestData);
                }else{
                    $res = M('goods')->add($requestData);
                }
                if($res !== false) {
                    $this->success('添加成功', cookie('__forword__'));
                    return; //这里一定要退出，不然后面的代码无论如何都要执行。
                }else{
                    $this->error('操作失败' . showError($this->model));
                }
            }

        } else {
            if($id){
                $data = $this->model->find($id);
                $data['detail'] = htmlspecialchars_decode($data['detail']);
                $this->_before_show_view(); //这里调用钩子函数，实现其余数据的处理。
            }
            //展示编辑页面
            $this->assign('meta_title', '编辑' . $this->meta_title);
            $this->assign(get_defined_vars());
            $this->display('edit');
        }
    }

    /**
     * 修改状态。（移除和修改是否显示）
     * @param $id
     * @param int $status
     */
    public function changeStatus($id, $status = -1)
    {
        if ($this->model->changeStatus($id, $status) !== false) {
            $this->success('操作成功',U('index'));
        } else {
            $this->error('操作失败');
        }
    }


}