<?php
/**
 * Created by PhpStorm.
 * User: ying
 * Date: 2016/4/16
 * Time: 23:15
 */

namespace Admin\Controller;

use Think\Controller;

class AttributeController extends BaseController{
    protected $meta_title = '属性';


    protected function _setWheres(&$wheres){
        $goods_type_id = I('get.goods_type_id');
        if(!empty($goods_type_id)){
            $wheres['obj.goods_type_id'] = $goods_type_id;
        }
    }

    protected function _before_index_view(){
        //>>1.准备所有的商品类型的数据,搜索用
        $goodsTypeModel = D('GoodsType');
        $goodsTypes = $goodsTypeModel->getAllList();
        $this->assign('goodsTypes',$goodsTypes);
    }


    public function _before_show_view(){
        //>>1.准备所有的商品类型
        $goodsTypeModel = D('GoodsType');
        $goodsTypes = $goodsTypeModel->getAllList(array(),'id,name');
        $this->assign('goodsTypes',$goodsTypes);
    }

    //根据商品分类生成属性列表
    public function getByGoodsTypeId($goods_type_id){
        $rows = $this->model->getAllList(array('goods_type_id'=>$goods_type_id),'id,name,attribute_type,attribute_input_type,option_values');
        foreach($rows as &$row){
            if(!empty($row['option_values'])){
                //将可选值变为 数组
                $row['option_values'] = str2arr($row['option_values'],"\r\n");  //这里必须使用双引号,因为只有双引号才能够将\r\n解析为 换行
            }
        }
        $this->ajaxReturn($rows);
    }
}