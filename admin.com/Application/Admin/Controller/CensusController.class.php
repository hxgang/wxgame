<?php
namespace Admin\Controller;
use Think\Controller;

class CensusController extends Controller
{

    /**
     * @desc 订单统计
     */
    public function index(){
        //>>1.准备所有的菜单数据
        if(isSuperUser()){
            //>>2.如果是超级管理员,查询所有的菜单
            $sql="select id,`name`,`url`,`parent_id`,`level` from permission where  status=1";
            $menus = M()->query($sql);
        }else{
            //>>2.如果不是超级管理员, 根据权限查询菜单
            $permission_ids = savePermissionId();
            if($permission_ids){
                $permission_ids = arr2str($permission_ids);
                $sql="select id,`name`,`url`,`parent_id`,`level` from permission where id in ($permission_ids) and status=1";
                $menus = M()->query($sql);
            }
        }
        $date_start = I('request.date_start');
        $date_end   = I('request.date_end');
        $date_start = $date_start > $date_end?$date_end:$date_start;
        $date_start = $date_start ? $date_start : date('Y-m-01');
        $date_end   = $date_end ? $date_end : date('Y-m-d');

        $order_num = D('Common/Census','Logic')->monthlOrder($date_start,$date_end);//每日订单数量，金额
        $order_all = D('Common/Census','Logic')->orderPriceNum($date_start,$date_end);//订单总数量和总金额

        $temp_key = array_keys($order_num['order']);
        $temp     = array_map(
                    function($a){
                        return "'".$a."'";
                    },$temp_key);
        $order_month_day_key = implode(',',$temp);

        $order_month_day_order_val = implode(',',array_values($order_num['order']));
        $order_month_day_price_val = implode(',',array_values($order_num['price']));

        unset($order_num,$temp_key,$temp);
        $this->assign(get_defined_vars());
        $this->display();
    }


}