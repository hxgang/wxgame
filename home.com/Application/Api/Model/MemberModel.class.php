<?php
namespace Api\Model;

use Think\Model;

class MemberModel extends Model
{
    public function  getUid($openid)
    {
        if (!$openid) return false;
        $rt = $this->where(['openid' => $openid])->getField('id');
        return $rt;
    }

    /**
     * 获取会员信息
     * @param string $openid
     * @param string $field
     * @return array|bool|mixed
     */
    public function isMember($openid, $field = "id,amount,share")
    {
        if (!$openid) return false;
        $member_info = $this->field($field)->where(['openid' => $openid])->find();
        if (empty($member_info)) {
            //新增
            $data = array(
                'openid' => $openid,
                'add_time' => NOW_TIME
            );
            $rst = $this->add($data);
            if ($rst) {
                return true;
            }
        }
        return empty($member_info) ? array() : $member_info;
    }

    /**
     * 存储金额
     * @param $params
     * @return bool
     */
    public function storeAmount($params)
    {
        if (empty($params)) return array();
        $where = array(
            'openid' => $params['openid']
        );
        $info = $rst = $this->where($where)->field('amount,share')->find();
        if ($info['share'] >= $params['share'] && $info['share'] > 0) {
            $data['share'] = $info['share'] - $params['share'];
        }
        $data['amount'] = floatval($info['amount']) + floatval($params['amount']);
        $rst = $this->where($where)->save($data);
        return $rst;
    }

    /**
     * 更新用户金额
     * @param  [type] $where [description]
     * @param  [type] $data  [description]
     * @return [type]        [description]
     */
    public function descAmount($member_id, $amount)
    {
        if (empty($member_id)) return false;
        if ($amount <= 0) {
            return true;
        }
        return $this->where(['id' => $member_id])->setDec('amount', $amount);
    }

    public function incShare($openid)
    {
        if (empty($openid)) return false;
        return $this->where(['openid' => $openid])->setInc('share');
    }
}