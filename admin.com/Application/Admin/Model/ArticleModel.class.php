<?php
namespace Admin\Model;

use Think\Model;
use Think\Page;

class ArticleModel extends BaseModel
{
    protected $_validate = array(
        array('name', 'require', '标题不能够为空!'),
        array('article_category_id', 'require', '文章分类不能够为空!'),
        array('intro', 'require', '简介不能够为空!'),
        array('content', 'require', '内容不能够为空!'),
        array('status', 'require', '状态不能够为空!'),
        array('sort', 'require', '排序不能够为空!'),
        array('inputtime','require','录入时间不能够为空!'),
    );

    protected $_auto = array(
        array('inputtime',NOW_TIME)
    );

    public function add($content){
        $this->data['content']=$content;
        return parent::add();
    }

    //复写基础模型中的方法，不然文章分类出智能显示编号，不能显示文字
    public function getPageResult($wheres = array())
    {
        $wheres['a.status'] = array('NEQ', '-1');
        //分页工具条
        $total = $this->count();
        $pageSize = C('PAGE_SIZE') ? C('PAGE_SIZE') : 10;
        $page = new Page($total, $pageSize);  //在Page类中设置了，不传递当前页码就为1.
        $pageHtml = $page->show(); //Page类里面的show方法，用来显示分页工具条。
        //页面展示数据
        $rows = $this->alias("a")->join("__ARTICLE_CATEGORY__ as ac on ac.id=a.article_category_id")->field("ac.name as article_category_name,a.*")->where($wheres)->order('a.sort')->limit($page->firstRow, $page->listRows)->select();
        return array('rows' => $rows, 'pageHtml' => $pageHtml);
    }
}