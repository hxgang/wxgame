<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/4
 * Time: 14:19
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Upload;

class UploaderController extends Controller
{

    //接收到上传插件上传上来的文件保存到指定的位置
    public function index(){
        $dir = ROOT_PATH.'Uploads/goods';  //brand

        if(!is_dir($dir)) {  //如果Uploads下的目录不存在就创建
            mkdir($dir, 0777, true);
        }

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728000 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','mp4','wmv');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/goods/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
        }else{// 上传成功
            $url='/Uploads/goods/'.$info['upload_file0']['savepath'].$info['upload_file0']['savename'];
            $data['img']= "<img src='$url'>";
            $data['url'] = $url;
            $data['code'] = 1;
            $this->ajaxReturn($data);
        }
    }
}