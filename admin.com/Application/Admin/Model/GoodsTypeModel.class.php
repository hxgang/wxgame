<?php
namespace Admin\Model;

use Think\Model;

class GoodsTypeModel extends BaseModel
{
    protected $_validate=array(
        array('name','require','类型名称不能够为空!'),
array('status','require','状态不能够为空!'),
array('sort','require','排序不能够为空!'),
    );
}