<?php
/**
 * Created by PhpStorm.
 * User: ying
 * Date: 2015/11/9
 * Time: 18:35
 */

namespace Admin\Model;


use Think\Model;

class GoodsArticleModel extends Model
{
    public function getArticleName($goods_id){
        $sql="select `name`,`id` from `goods_article` as a join `article` as b on a.article_id=b.id where a.goods_id=$goods_id";
        $rows=M()->query($sql);
        if(!empty($rows)){
            return $rows;
        }else{
            return false;
        }
    }
}