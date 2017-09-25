<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/11
 * Time: 14:44
 */
namespace Admin\Controller;

use Think\Controller;
use Think\Verify;

class LoginController extends Controller
{
    public function checkLogin(){
        if(IS_POST){
            //>>先进行验证码的验证
            $captcha = I('post.captcha');
           /* $verify = new Verify();
            if(!$verify->check($captcha)){
                $this->error('验证码错误');
            }*/
             //>>1.接收请求参数
                $username = I('post.username');
                $password = I('post.password');
            //>>2.再进行验证登陆
                $loginService = D('Login','Service');
                //根据用户名和密码进行验证
                $result = $loginService->login($username,$password);
                if(is_array($result)){  //是数组, 表示用户信息
                     //登陆成功,将用户信息保存到session中
                    login($result);
                    session('adminName',$username);
                    //需要将当前用户能够访问的url地址保存到session中
                    $permissions = $loginService->getPermissions($result['id']);
                    savePermissionURL(array_column($permissions,'url'));  //将权限的url地址保存
                    savePermissionId(array_column($permissions,'id'));   //将权限的id保存
                    //完成自动登录信息的保存
                    $remember = I('post.remember');
                    if(!empty($remember)){
                        //保存用户信息
                        $loginService->saveAutoLogin($result['id']);
                    }
                        $this->success('登陆成功!',U('Index/index'));

                }else{ //如果不是数组, 就是错误信息
                    $this->error($result);
                }
        }else{
            layout(false);
            $this->display('login');
        }
    }

    public function logout(){
        logout();
        $this->success('退出成功！',U('checkLogin'));
    }

}