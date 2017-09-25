<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/11
 * Time: 15:49
 */

namespace Admin\Behavior;


use Think\Behavior;

class CheckPermissionBehavior extends Behavior
{
    public function run(&$params)
    {
        //>>1.定义不需要登陆验证的地址
        $noCheck = C('NO_CHECK');
        //>>2.获取用户正在访问的url地址
        $requestURL = CONTROLLER_NAME.'/'.ACTION_NAME;
        if(in_array($requestURL,$noCheck)){
            return;
        }
        header('Content-Type: text/html;charset=utf-8');
       //>>1.判定用户是否登陆
        if(!isLogin()){
              $loginService = D('Login','Service');
             if(!$loginService->autoLogin()){  //进行自动登录, 如果没有自动登录,就转向登录页面
                 redirect(U('Login/checkLogin'),1,'请登录!');
             }
        }
        //>>3.如果是超级管理员不用在判定权限
        if(isSuperUser()){
            return;
        }
        //>>2.判定登陆用户访问的url是否在他的权限范围之内
        $urls = savePermissionURL();
         if(!in_array($requestURL,$urls)){
            echo '权限不足!请求联系管理员!';
            exit;
        }
    }
}