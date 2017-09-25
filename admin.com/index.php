<?php
// 应用入口文件

// 1.检测PHP环境
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    die('require PHP > 5.3.0 !');
}

//2.定义项目的根目录
define('ROOT_PATH',dirname($_SERVER['SCRIPT_FILENAME']).'/');

//3.将thinkphp的框架目录定义为常量
define('THINK_PATH',dirname(ROOT_PATH).'/ThinkPHP/');

//4. 定义应用目录
define('APP_PATH', ROOT_PATH.'/Application/');

//5.定义ROOTIME_PATH，指定运行目录。
define('RUNTIME_PATH',ROOT_PATH.'Runtime/');

//6.定义上传图片的目录
define('UPLOAD_PATH',ROOT_PATH.'Uploads');

// 7.开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG', true);

//绑定模块
define('BIND_MODULE','Admin');

// 7.引入ThinkPHP入口文件
require '../ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单
