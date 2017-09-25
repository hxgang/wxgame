<?php
/**
 * 该文件的名字必须叫做 function.php
 */


/**
 * 从模型中获取错误信息拼装为ul
 * @param $model
 * @return string
 */
function showError($model)
{
    $errors = $model->getError();
    $msg = '<ul>';
    if (is_array($errors)) {  //如果是数组,拼装
        foreach ($errors as $error) {
            $msg .= "<li>{$error}</li>";
        }
    } else { //如果不是数组,直接拼装
        $msg .= "<li>{$errors}</li>";
    }

    $msg .= '</ul>';
    return $msg;
}


/**
 * 返回input数组中键值为column_key的列， 如果指定了可选参数index_key，那么input数组中的这一列的值将作为返回数组中对应值的键。
 * @param $rows
 * @param $column_key
 * @return array
 */
if (!function_exists('array_column')) {
    function array_column($rows, $column_key)
    {
        $temp = array();
        foreach ($rows as $row) {
            $temp[] = $row[$column_key];
        }
        return $temp;
    }
}


/**
 * 根据传入的name和rows生成一个下拉列表的html
 * @param $name    表单元素的名字
 * @param $rows    下拉列表中需要的数据
 */
function arr2selected($name, $rows, $defaultValue, $fieldValue = 'id', $fieldName = 'name')
{
    $html = "<select name='{$name}' class='{$name}'>
            <option value=''>--请选择--</option>";
    foreach ($rows as $row) {
        //根据默认值比对每一行,从而生成selected='selected',然后在option中使用.
        $selected = '';
        if ($row[$fieldValue] == $defaultValue) {
            $selected = "selected='selected'";
        }
        $html .= "<option value='{$row[$fieldValue]}' {$selected}>{$row[$fieldName]}</option>";
    }
    $html .= "</select>";
    echo $html;
}


/**
 * 如果传递的有用户信息, 将用户信息保存到session,
 * 如果没有用户信息,  是从session获取用户信息
 * @param $userinfo
 */
function login($userinfo = null)
{
    if ($userinfo) {
        session('USERINFO', $userinfo);
    } else {
        return session('USERINFO');
    }
}

/**
 * 判定用户是否登陆
 * @return bool
 */
function isLogin()
{
    return login() !== null;
}

/**
 * 判定是否为超级管理员
 */
function isSuperUser()
{
    //>>1.得到当前的登陆用户
    $userinfo = login();
    $username = $userinfo['username'];
    //>>2.获取配置中指定的超级用户的用户名
    $super_name = C('SUPER_USER');
    return $username == $super_name;
}

/**
 * 清楚记录
 */
function logout()
{
    session('USERINFO', null);
    session('PERMISSIONURL', null);
    session('PERMISSIONID', null);
    cookie('admin_id', null);
    cookie('auto_key', null);
}


/**
 * 将权限的url地址保存到session中
 * @param null $urls
 * @return mixed
 */
function savePermissionURL($urls = null)
{
    if ($urls) {
        session('PERMISSIONURL', $urls);
    } else {
        return session('PERMISSIONURL');
    }
}

/**
 * 将权限的id保存到session中
 * @param null $ids
 * @return mixed
 */
function savePermissionId($ids = null)
{
    if ($ids) {
        session('PERMISSIONID', $ids);
    } else {
        return session('PERMISSIONID');
    }
}


/**
 * 通过分隔符将数组中的元素链接起来
 * @param $arr
 * @param string $seq
 */
function arr2str($arr, $seq = ',')
{
    return implode($seq, $arr);
}

/**
 * 将字符串str通过seq的分隔符 分隔开
 * @param $str
 * @param string $seq
 * @return array
 */
function str2arr($str, $seq = ',')
{
    return explode($seq, $str);
}

function dd($data)
{
    echo "<pre/>";
    print_r($data);
    exit;
}

/**
 * 加解密函数
 * 用法  ：
 *  $str = 'abc';
 * $key = 'www.helloweba.com';
 * $token = encrypt($str, 'E', $key);
 * echo '加密:'.encrypt($str, 'E', $key);
 * echo '解密：'.encrypt($str, 'D', $key);
 * @param $string
 * @param $operation
 * @param string $key
 * @return mixed|string
 */
function encrypt($string, $operation, $key = '')
{
    $key = md5($key);
    $key_length = strlen($key);
    $string = $operation == 'D' ? base64_decode($string) : substr(md5($string . $key), 0, 8) . $string;
    $string_length = strlen($string);
    $rndkey = $box = array();
    $result = '';
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($key[$i % $key_length]);
        $box[$i] = $i;
    }
    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if ($operation == 'D') {
        if (substr($result, 0, 8) == substr(md5(substr($result, 8) . $key), 0, 8)) {
            return substr($result, 8);
        } else {
            return '';
        }
    } else {
        return str_replace('=', '', base64_encode($result));
    }
}

//随机串
function getString($length = 16)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
        $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
}

