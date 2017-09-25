<?php
namespace Admin\Model;


class DbMysqlInterfaceImplModel implements DbMysqlInterfaceModel
{
    public function connect()
    {
        echo 'connect';
        exit;
    }

    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo 'disconnect';
        exit;
    }

    public function free($result)
    {
        // TODO: Implement disconnect() method.
        echo 'free';
        exit;
    }

    public function query($sql, array $args = array())
    {
        $targetSQL = $this->buildSQL(func_get_args());
        return M()->execute($targetSQL);
    }

    public function insert($sql, array $args = array())
    {
        $params = func_get_args();
        $sql = $params[0];
        $sql = str_replace('?T', $params[1], $sql);

        //将插入的值的连接
        $values = array();
        foreach ($params[2] as $k => $v) {
            if ($k !== 'id') {
                $values[] = "$k='$v'";
            }
        }
        $values = implode(',', $values);

        //将插入的值替换到$sql中
        $sql = str_replace('?%', $values, $sql);
        $result = M()->execute($sql);
        if ($result !== false) {
            //执行成功之后要返回id
            return M()->getLastInsID();
        } else {
            return false;//执行失败,返回false
        }
    }

    public function update($sql, array $args = array())
    {
        // TODO: Implement disconnect() method.
        echo 'update';
        exit;
    }

    public function getAll($sql, array $args = array())
    {
        // TODO: Implement disconnect() method.
        echo 'getAll';
        exit;
    }

    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement disconnect() method.
        echo 'getAssoc';
        exit;
    }


    /**
     * @param string $sql
     * @param array $args
     * @return mixed  必须是查询出来的一行数据
     */
    public function getRow($sql, array $args = array())
    {
        //>>1.先拼好sql
        $targetSQL = $this->buildSQL(func_get_args());
        //>>2.再执行
        $rows = M()->query($targetSQL);
        if (!empty($rows)) {
            return $rows[0];
        }
    }

    /**
     * 根据参数拼sql
     */
    private function buildSQL($params)
    {
        $sql = array_shift($params);  //将params中的第一个元素弹出, 弹出的是一个sql模板
        $sqls = preg_split("/\?[FNT]/", $sql);  //将sql模板进行分隔
        $targetSQL = '';  //保存拼接好的sql
        foreach ($sqls as $k => $v) {
            $targetSQL .= $v . $params[$k];   //将sql模板和实际参数进行拼接为完整的sql
        }
        return $targetSQL;
    }

    public function getCol($sql, array $args = array())
    {
        // TODO: Implement disconnect() method.
        echo 'getCol';
        exit;
    }

    public function getOne($sql, array $args = array())
    {
        $sql=$this->buildSQL(func_get_args());
        $rows = M()->query($sql);
        return array_shift($rows[0]);
    }

}