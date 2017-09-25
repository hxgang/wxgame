<?php
namespace Admin\Model;

use Think\Model;

class AttributeModel extends BaseModel
{
    protected $_validate=array(
        array('name','require','属性名称不能够为空!'),
array('goods_type_id','require','商品类型ID不能够为空!'),
array('attribute_type','require','属性类型不能够为空!'),
array('attribute_input_type','require','录入方式不能够为空!'),
array('status','require','状态不能够为空!'),
array('sort','require','排序不能够为空!'),
    );

}