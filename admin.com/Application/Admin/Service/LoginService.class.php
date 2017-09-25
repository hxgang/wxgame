<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/11
 * Time: 15:14
 */
namespace Admin\Service;
//use Org\Util\String;

class LoginService
{

    /**
     * 根据用户名和密码进行登陆
     * @param $username
     * @param $password
     */
    public function login($username,$password){
        //>>1.先判断用户名
          $adminModel = D('Admin');
          $rowName = $adminModel->getByUsername($username);
          $rowEmail = $adminModel->getByUserEmail($username);
          if( $rowEmail  ){
              $row=$rowEmail;
          }
          if($rowName){
              $row = $rowName;
          }
          if($row){
              //>>2.再判断密码(将当前登陆用户名的密码进行加密之后再和数据库中的密码进行对比)
                $password = md5($password.$row['salt']);
                if($row['password']==$password){
                    return $row;
                }else{
                    return '密码错误!';
                }
          }else{
              return '用户名错误或者不存在';
          }
    }

    /**
     * 根据用户的id找到权限(id,url)
     * @param $admin_id
     */
    public function getPermissions($admin_id){
        $sql = "select  distinct  id,url from permission  where id in
        (select  distinct rp.permission_id from  admin_role as ar  join role_permission as rp on ar.role_id = rp.role_id  where ar.admin_id = $admin_id)";
        $rows =  M()->query($sql);
        return $rows;
    }
//                $sql = "select  distinct  id,url from permission  where id in
//        (select  distinct rp.permission_id from  admin_role as ar  join role_permission as rp on ar.role_id = rp.role_id  where ar.admin_id = $admin_id)
//        or id in(select  ap.permission_id from admin_permission as ap where ap.admin_id = $admin_id);";


    public function saveAutoLogin($admin_id){
         //>>1.生成一个随机的字符串,作为auto_key的值, 并且保存到数据库中
           //$auto_key = String::randString();
          $string    = array('aadwa','bdawc','cdawd','dddwdd','ertou',
                          'eddwdd','fddwd','ertyu','ereyu','eeryu');
           $key      = mt_rand(0,9);
           $auto_key =$string[$key];
           $adminModel  = M('Admin');
           $adminModel->save(array('auto_key'=>$auto_key,'id'=>$admin_id));
        //>>2. 将auto_key和用户对应的盐，进行加密之后保存到cookie中
           $salt = $adminModel->getFieldById($admin_id,'salt');
           $auto_key = md5($auto_key.$salt);
            //让cookie的值在浏览器中保存一个星期
            cookie('admin_id',$admin_id,60*60*24*7);
            cookie('auto_key',$auto_key,60*60*24*7);
    }


    /**
     * 自动登录的方法 , 就是根据cookie中值进行登录
     * 1. 登录失败: 返回false
     * 2. 登录成功: 返回true
     */
    public function autoLogin(){
        //>>1.得到cookie中信息
          $admin_id = cookie('admin_id');
          $auto_key = cookie('auto_key');
              //如果没有cookie的值就需要自动登录
          if(empty($admin_id) || empty($auto_key)){
              return false;
          }
        //>>2.根据cookie中的admin_id,查找是否有该用户
          $adminModel  = M('Admin');
          $row = $adminModel->getById($admin_id);
          if($row){
              //>>3.如果有该用户,再对比加密后的auto_key
              if($auto_key==md5($row['auto_key'].$row['salt'])){
                    //登录成功
                  login($row); //将当前登陆信息保存到 session中
                   //根据用户的id 查询出当前用户的权限的url和id 保存到session中
                   $permissions = $this->getPermissions($row['id']);
                   savePermissionURL(array_column($permissions,'url'));  //将权限的url地址保存
                   savePermissionId(array_column($permissions,'id'));   //将权限的id保存
                  return true;  //一定要返回
              }
          }
          return false;
    }
}