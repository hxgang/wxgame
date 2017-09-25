<?php
namespace Admin\Model;

use Think\Model;

class PayTypeModel extends BaseModel
{
    protected $_validate=array(
        array('name','require','支付方式名称不能够为空!'),
array('status','require','状态不能够为空!'),
array('sort','require','排序不能够为空!'),
array('is_default','require','默认不能够为空!'),
    );
}