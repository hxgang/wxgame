<?php
namespace Admin\Model;

use Think\Model;

class GoodsModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '商品名称不能够为空!'),
        array('shop_price', 'require', '商品价格不能够为空!'),
        array('stock', 'require', '库存不能够为空!'),
        array('status', 'require', '商品状态不能够为空!'),
        array('keyword', 'require', '商品描述字不能够为空!'),
         array('logo', 'require', '商品图片不能够为空!'),
        array('status', 'require', '状态不能够为空!'),
        //array('sort', 'require', '排序不能够为空!'),
    );

    public function add($requestData)
    {
        //开启事务
        $this->startTrans();
        //>>1.把商品的状态用一个数字表示，用集合的方式 1,2,4
        $this->handleGoodsStatus();
        //>>2.插入除了货号以外的所有数据，返回新纪录的id
        $id = parent::add();
        if ($id === false) {
            $this->callback();
            $this->error('商品通信信息保存失败');
            return false;
        }
        //>>3.根据新生成的id，计算出货号(年月日+8位id)更新到该行记录中
        $sn = date('Ymd') . str_pad($id, 8, '0', STR_PAD_LEFT);
        $this->where("id=$id");
        $rst = parent::save(array('sn' => $sn));
        if ($rst === false) {
            $this->callback();
            $this->error('商品货号保存失败');
            return false;
        }

        //>>4.把商品描述的数据保存到goods_intro表中。
        $result=$this->handleGoodsIntro($id,$requestData['intro']);
        if($result===false){
            $this->callback();
            $this->error('商品描述保存失败');
            return false;
        }
        //>>5.把商品相册地址保存在goods_album表中
        $result=$this->handleGoodsAlbum($id,$requestData['upload_album_path']);
        if($result===false){
            $this->callback();
            $this->error('商品相册保存失败');
            return false;
        }
        //>>6.把关联文章的id存入goods_article表中
        $result=$this->handleGoodsArticle($id,$requestData['article_id']);
        if($result===false){
            $this->callback();
            $this->error('关联文章保存失败');
            return false;
        }

        //>>7.把商品会员价格保存在goods_member_level表中
        $result=$this->handleGoodsMemberPrice($id,$requestData['memberPrice']);
        if($result===false){
            $this->callback();
            $this->error('会员价格保存失败');
            return false;
        }

        //>>8.处理商品属性---将商品属性添加到goods_attribute表中
        $result = $this->addGoodsAttribute($id,$requestData['goodsAttribute']);
//        echo "<pre/>";
//        echo $id;
//        print_r($result);
//        print_r($requestData);
//        exit;
        if($result===false){
            $this->callback();
            $this->error('商品属性保存失败');
            return false;
        }

        $this->commit();
        return $id;
    }

    /**
     * 将请求中的商品属性保存到goods_attribute表中
     * @param $goods_id
     * @param $goodsAttributes
     * @return bool
     */
    private function addGoodsAttribute($goods_id,$goodsAttributes){
        $rows = array();
        foreach($goodsAttributes as $attribute_id => $value){
            if(is_array($value)){  //多值的情况
                foreach($value as $v){
                    $rows[] = array('goods_id'=>$goods_id,'attribute_id'=>$attribute_id, 'value'=>$v);
                }
            }else{  //单值的情况
                $rows[] = array('goods_id'=>$goods_id,'attribute_id'=>$attribute_id, 'value'=>$value);
            }
        }
        if(!empty($rows)){
            $result = M('GoodsAttribute')->addAll($rows);
//            echo M('GoodsAttribute')->getLastSql();
//            exit;
            if($result===false){
                $this->rollback();
                $this->error = '保存商品属性失败!';
                return false;
            }
        }
    }

    public function save($requestData)
    {
        $this->startTrans();

        $goods_id=$requestData['id'];
  /*      //>>1.改变了商品状态
        $this->handleGoodsStatus();
        //>>2.改变商品描述（删掉原来的，重新添加）
        $this->handleGoodsIntro($goods_id,$requestData['intro']);
        //>>3.改变商品相册图片
        $this->handleGoodsAlbum($goods_id,$requestData['upload_album_path']);
        //>>4.改变关联文章
        $this->handleGoodsArticle($goods_id,$requestData['article_id']);
        //>>5.改变会员价格
        $this->handleGoodsMemberPrice($goods_id,$requestData['memberPrice']);*/

        //>>6.进行属性的更新
        /*$result = $this->updateGoodsAttribute($this->data['id'],$requestData['goodsAttribute']);
        if($result===false){
            return false;
        }*/
        //7.更新
        $result = parent::save($requestData);
        if($result===false){
            $this->rollback();
            return false;
        }

        $this->commit(); //提交事物
        return $result;
    }


    /**
     * 根据商品id和请求中的goodsAttribute(商品属性) 将其值更新到数据库中
     * @param $goods_id
     * @param $goodsAttribute
     *
     *  单值:
     *    直接将单值属性的值更新到对应的属性值中
     *
     *  多值:
     *    请求中有,数据库中没有,      需要将请求中的数据添加到数据库中
     *    请求中有,数据库也有,        保持不变
     *    请求没有,数据库有,          将数据库中的删除
     *    请求没有,数据库没有,        保持不变
     *
     */
    private function updateGoodsAttribute($goods_id,$goodsAttribute){

        //查询出当前商品在数据库中的多值属性的值
        $sql = "SELECT obj.id,obj.attribute_id,obj.value FROM `goods_attribute` as obj join attribute as a on obj.attribute_id = a.id where a.attribute_type=2  and obj.goods_id = $goods_id;";
        $goodsAttributeInDB = $this->query($sql);
        //>>1.循环请求中的每一个商品属性已经对应的值
        foreach($goodsAttribute as $request_attribute_id=>$requestGoodsAttributeValue){
            if(!is_array($requestGoodsAttributeValue)){
                //>>2.单值的情况, 直接将属性的值更新到数据库中
                $result = M('GoodsAttribute')->where(array('goods_id'=>$goods_id,'attribute_id'=>$request_attribute_id))->setField('value',$requestGoodsAttributeValue);
                if($result===false){
                    $this->error = '更新单值属性失败!';
                    $this->rollback();
                    return false;
                }
            }else{
                //>>3. 多值的情况
                //>>3.1  请求中有,数据库中没有, 需要将请求中的数据添加到数据库中
                foreach($requestGoodsAttributeValue as $requestValue){
                    $tag = false;  //请求中的数据不在   数据库中
                    foreach($goodsAttributeInDB as $rowInDB){
                        if($rowInDB['attribute_id']==$request_attribute_id && $rowInDB['value']==$requestValue){
                            $tag = true;
                            break;
                        }
                    }
                    if(!$tag){ //不在
                        $result = M('GoodsAttribute')->add(array('goods_id'=>$goods_id,'attribute_id'=>$request_attribute_id,'value'=>$requestValue));
                        if($result===false){
                            $this->error = '添加多值属性失败!';
                            $this->rollback();
                            return false;
                        }
                    }
                }
            }
        }

        //>>3.2  请求没有,数据库有,          将数据库中的删除      (需要拿着数据库中的数据和请求中的数据进行对比)
        foreach($goodsAttributeInDB as $rowInDB){
            $tag = false; //数据库中的数据不在请求中存在
            foreach($goodsAttribute as $request_attribute_id=>$requestGoodsAttributeValue){
                if(is_array($requestGoodsAttributeValue)){ //只关心多值属性
                    if($rowInDB['attribute_id']==$request_attribute_id && in_array($rowInDB['value'],$requestGoodsAttributeValue)){
                        $tag = true;
                        break;
                    }
                }
            }

            if(!$tag){  //如果数据库中的不在请求中,需要将数据库中的删除
                $result = M('GoodsAttribute')->delete($rowInDB['id']);
                if($result===false){
                    $this->error = '添加多值属性失败!';
                    $this->rollback();
                    return false;
                }
            }
        }


    }


    public function handleGoodsMemberPrice($goods_id,$memberPrices){
        $rows=array();
        foreach($memberPrices as $member_level_id=>$price){
            $rows[]=array('goods_id'=>$goods_id,'member_level_id'=>$member_level_id,'price'=>$price);
        }
        if(!empty($rows)){
            $GoodsMemberLevelModel=M('GoodsMemberPrice');
            $GoodsMemberLevelModel->where(array('goods_id'=>$goods_id))->delete();
            //再把所有新数据插入
            $result=$GoodsMemberLevelModel->addAll($rows); //可以把一个数组依次插入
            if($result===false){
                $this->error('保存失败');
                $this->callback();
                return false;
            }
        }
    }
    /**
     * 处理关联文章
     * @param $goods_id
     * @param $article_ids
     * @return bool
     */
    private function handleGoodsArticle($goods_id,$article_ids){
        $rows=array();
        foreach($article_ids as $article_id){
            $rows[]=array('goods_id'=>$goods_id,'article_id'=>$article_id);
        }
        if(!empty($rows)){
            $goodsArticleModel=M('GoodsArticle');
            //先清空所有的文章
            $goodsArticleModel->where(array('goods_id'=>$goods_id))->delete();
            //再把所有新数据插入
            $result=$goodsArticleModel->addAll($rows); //可以把一个数组依次插入
            if($result===false){
                $this->callback();
                $this->error('保存关联文章失败');
                return false;
            }
        }
    }

    /**
     * 把商品相册中的图片路径存库
     * @param $goods_id
     * @param $path
     * @return bool
     */
    private function handleGoodsAlbum($goods_id,$paths){
        //把商品的图片路径保存在相册表中，插入的数据有id和path
        $rows=array();
        foreach($paths as $path){
            $rows[]=array('goods_id'=>$goods_id,'path'=>$path);
        }
        if(!empty($rows)){
            $goodsAlbumModel=M('GoodsAlbum');
            $result=$goodsAlbumModel->addAll($rows); //可以把一个数组依次插入
            if($result===false){
                $this->callback();
                $this->error('保存商品相册失败');
                return false;
            }
        }
    }
    /**
     * 插入商品描述到数据库中。
     * @param $goods_id
     * @param $intro
     * @return bool
     */
    private  function handleGoodsIntro($goods_id,$intro){
        $GoodsIntroModel=M('GoodsIntro');  //没有现有的模型，用M可以创建，用D不行。
        $GoodsIntroModel->where("goods_id=$goods_id")->delete(); //删除对应的商品描述
        $result=$GoodsIntroModel->add(array("goods_id"=>$goods_id,"intro"=>$intro)); //这里是用的GoodsIntro这个模型里面的add方法，没有重写，即最初的add方法
        if($result===false){
            $this->callback();
            $this->error('商品描述保存失败');
            return false;
        }
    }

    /**
     * 得到商品的最终保存状态
     */
    private function handleGoodsStatus()
    {
        $goods_status = 0;
        foreach ($this->data['goods_status'] as $value) {
            $goods_status = $goods_status | $value;
        }
        $this->data['goods_status'] = $goods_status;
    }



    public function changeStatus($id, $status)
    {
        $data = array('status' => $status);
        $wheres = array('id' => array('in', $id));
        if ($status == -1) {
            $data['name'] = array('exp', 'concat(name,"_del")');
        }
        $this->where($wheres);
        return parent::save($data);
    }


    /**
     * 根据商品id查询出所有的属性..
     *   先根据商品的id查询出商品的类型, 再根据类型查询出商品的属性
     * @param $id
     */
    public function getAttributeGoodsId($id){
        $sql = "SELECT a.id,a.`name`,a.attribute_type,a.attribute_input_type,a.option_values from goods as obj join attribute as a  on a.goods_type_id = obj.goods_type_id  where obj.id = $id";
        $rows = $this->query($sql);
        foreach($rows as &$row){
            if(!empty($row['option_values'])){
                //将可选值变为 数组
                $row['option_values'] = str2arr($row['option_values'],"\r\n");  //这里必须使用双引号,因为只有双引号才能够将\r\n解析为 换行
            }
        }
        return $rows;
    }

}