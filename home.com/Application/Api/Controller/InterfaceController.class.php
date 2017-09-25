<?php
namespace Api\Controller;

use Think\Cache;
use Think\Controller;

class InterfaceController extends Controller
{
    public function index()
    {
        header('Content-Type: application/json; charset=UTF-8;');
        header('Access-Control-Allow-Origin: *');
        C('SHOW_PAGE_TRACE', false);

        $result = array();
        $result_manager = array(
            0 => array('res' => 0),       //成功，没有错误
            99 => array('res' => 99),     //服务器维护，暂停服务
            101 => array('res' => 101),   //参数错误
            102 => array('res' => 102),   //非法请求
            404 => array('res' => 404),   //无数据
            500 => array('res' => 500),   //服务器内部错误
            600 => array('res' => 600),   //自定义错误
        );
        $status_code = 102;
        $std_class = I('request.class', '', 'strip_tags');
        $method = I('request.method', '', 'strip_tags');
        if (!empty($std_class) && !empty($method)) {
            $class = "\Common\Logic\\" . $std_class . 'Logic';
            if (class_exists($class)) {
                $obj = new $class();
                if (method_exists($obj, $method)) {
                    $params = $_REQUEST['params'];
                    if ($params) {
                        if (get_magic_quotes_gpc()) {
                            $params = stripslashes($params);
                        }
                        $params = json_decode($params, true);
                    }
                    //参数过滤
                    $params = $this->filterParam($params);
                    $result['res'] = 0;
                    $result['data'] = $obj->$method($params);;
                    if (3 == $result['data']['status_code']) {
                        $result['res'] = 101;
                        $result['data'] = array();
                    }
                    echo json_encode($result);
                    exit;
                } else {
                    $status_code = 101;
                }
            } else {
                $status_code = 101;
            }
        } else {
            $status_code = 101;
        }
        echo json_encode($result_manager[$status_code]);
    }

    //参数过滤
    public function filterParam($data)
    {
        $filters = isset($filter) ? $filter : C('DEFAULT_FILTER');
        if ($filters) {
            if (is_string($filters)) {
                $filters = explode(',', $filters);
            }
            foreach ($filters as $filter) {
                $data = array_map_recursive($filter, $data); // 参数过滤
            }
        }
        is_array($data) && array_walk_recursive($data, 'think_filter');
        return $data;
    }

}