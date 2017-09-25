<?php
namespace Admin\Model;

use Think\Model;

class MemberLevelModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '级别名称不能够为空!'),
        array('bottom', 'require', '经验值下限不能够为空!'),
        array('top', 'require', '经验值上限不能够为空!'),
        array('discount', 'require', '折扣率不能够为空!'),
        array('status', 'require', '状态不能够为空!'),
        array('sort', 'require', '排序不能够为空!'),
    );
}