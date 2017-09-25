<?php
/**
 * Created by PhpStorm.
 * User: ying
 * Date: 2015/11/12
 * Time: 1:10
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Verify;

class VerifyController extends Controller
{
    protected $config=array(
        'useImgBg' => true, // 使用背景图片
        'length'   => 6, // 验证码位数
        'fontSize' => 12, // 验证码字体大小(px)
        'useNoise' => false, // 是否添加杂点
        'useCurve' => false, // 是否画混淆曲线
        'fontttf'  => '10.ttf', // 验证码字体，不设置随机获取
    );
    public function index(){
        ob_clean();
        $verify = new Verify($this->config);
        /*
         *   输出验证码并把验证码的值保存的session中
        *   验证码保存到session的格式为： array('verify_code' => '验证码值', 'verify_time' => '验证码创建时间');
        */
        $verify->entry();
    }
}