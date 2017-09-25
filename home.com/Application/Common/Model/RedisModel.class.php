<?php
/**
 * 实现各种数据接口
 *
 * 注意：将该方法与S方法中redis类区分开来，用途不一样
 */
namespace Common\Model;

use \Redis;

class RedisModel extends Redis
{
    /**
     * @param unknown $options
     * @throws \Exception
     */
    public function __construct($options = array())
    {

        parent::__construct();

        if (!is_array($options) || empty($options)) {
            $options = array(
                'host' => C('REDIS_HOST') ? C('REDIS_HOST') : '127.0.0.1',
                'port' => C('REDIS_PORT') ? C('REDIS_PORT') : 6379,
                'timeout' => C('DATA_CACHE_TIMEOUT') ? C('DATA_CACHE_TIMEOUT') : false,
                'persistent' => false,
            );
        }
        $func = $options['persistent'] ? 'pconnect' : 'connect';
        $options['timeout'] === false ?
            $this->$func($options['host'], $options['port']) :
            $this->$func($options['host'], $options['port'], $options['timeout']);
    }
}