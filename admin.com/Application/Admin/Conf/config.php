<?php
//define('SRC_URL','http://www.19890407.com');

define('SRC_URL','http://game.cn');
return array(
    'TMPL_PARSE_STRING' =>array(
        '__CSS__' =>SRC_URL . '/Public/Admin/assets/css',
        '__JS__' =>SRC_URL .'/Public/Admin/assets/js',
        //'__IMG__' =>SRC_URL .'/Public/Admin/images',
        '__IMG__' =>SRC_URL .'/Public/Admin/assets/img',
        '__LAYER__'=>SRC_URL .'/Public/Admin/layer/layer.js', //提示框插件
        '__UPLOADIFY__'=>SRC_URL .'/Public/Admin/uploadify', //上传文件插件
        '__TREEGRID__'=>SRC_URL .'/Public/Admin/treegrid', //分类缩进插件
        '__ZTREE__'=>SRC_URL .'/Public/Admin/zTree', //树状结构插件
       // '__BRAND__'=>'http://itsource-brand.b0.upaiyun.com', //brand又拍云空间域名
       // '__GOODS__'=>'http://itsource-goods.b0.upaiyun.com', //goods又拍云空间域名
        '__UEDITOR__'=>SRC_URL .'/Public/Admin/ueditor',
    ),
    'URL_MODEL'              => 2, //url的rewrite模式
    'PAGE_SIZE'=>10, //每页的条数
    'SUPER_USER'=>'root', //超级管理员
    'NO_CHECK'=>array('Login/checkLogin','Verify/index','Login/logout'),
    'COOKIE_DOMAIN'=>'.19890407.com',
    'LAYOUT_ON'=>true,
    'LAYOUT_NAME'=>'Public/layout',

      ////////////////////Redis Session配置//////////////////////////

    'SESSION_AUTO_START'    =>  true,    // 是否自动开启Session
//    'SESSION_TYPE'            =>  'Redis',    //session类型
    'SESSION_TYPE'            =>  'Redis',    //session类型
    'SESSION_PERSISTENT'    =>  1,        //是否长连接(对于php来说0和1都一样)
    'SESSION_CACHE_TIME'    =>  1,        //连接超时时间(秒)
    'SESSION_EXPIRE'        =>  0,        //session有效期(单位:秒) 0表示永久缓存
    'SESSION_PREFIX'        =>  'sess_',        //session前缀
    'SESSION_REDIS_HOST'    =>  '127.0.0.1', //分布式Redis,默认第一个为主服务器
    'SESSION_REDIS_PORT'    =>  '6379',           //端口,如果相同只填一个,用英文逗号分隔
//   // 'SESSION_REDIS_AUTH'    =>  'redis',    //Redis auth认证(密钥中不能有逗号),如果相同只填一个,用英文逗号分隔
);