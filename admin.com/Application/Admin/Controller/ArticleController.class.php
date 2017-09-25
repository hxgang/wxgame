<?php
namespace Admin\Controller;

use Admin\Model\BaseModel;
use Think\Controller;

class ArticleController extends BaseController
{
    protected $meta_title = "文章";

    protected function _before_show_view(){
        //>>准备文章分类的数据
        $articleCategoryModel=D('ArticleCategory');
        $article_categorys=$articleCategoryModel->getAllList();
        $this->assign('article_categorys',$article_categorys);
    }

    public function add()
    {
        if (IS_POST) {
            //>>2.用模型中的add方法得到数据
            if ($this->model->create() !== false) {
               $content=I('post.content','',false);
                if ($this->model->add($content) !== false) {
                    $this->success('添加成功', cookie('__forword__'));
                    return; //这里一定要退出，不然后面的代码无论如何都要执行。
                }
            }
            $this->error('操作失败' . showError($this->model));
        } else {
            $this->_before_show_view();
            $this->assign('meta_title', '添加' . $this->meta_title); //meta_title在子类中。
            $this->display('edit');
        }
    }

    public function search(){
        $title=$_GET['title'];
        $wheres['name']=array('like',"%$title%");
        $ArticleModel=D('Article');
        $result=$ArticleModel->getAllList($wheres,$field="id,name"); //把文章表中的id和name 都查询出来
        $this->ajaxReturn($result);
    }
}