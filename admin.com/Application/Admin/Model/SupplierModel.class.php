<?php
/**
 * Created by PhpStorm.
 * User: ying
 * Date: 2015/10/30
 * Time: 17:56
 */

namespace Admin\Model;


use Think\Model;

class SupplierModel extends BaseModel
{
    // 自动验证定义
    protected $_validate = array(
        array('name', 'require', '名称不能为空'),
        array('name', '', '名称不能为重复', '', 'unique'),
        array('intro', 'require', '简介不能为空'),
    );
}