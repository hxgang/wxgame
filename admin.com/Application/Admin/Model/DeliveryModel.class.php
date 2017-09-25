<?php
namespace Admin\Model;

use Think\Model;

class DeliveryModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '送货方式名称不能够为空!'),
        array('price', 'require', '运费不能够为空!'),
        array('status', 'require', '状态不能够为空!'),
        array('sort', 'require', '排序不能够为空!'),
        array('is_default', 'require', '是否默认地址不能够为空!'),
    );
}