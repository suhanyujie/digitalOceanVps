<?php

/**
 * 栏目列表
 * Class CategoryController
 */
class CategoryController extends CommonController
{
    //栏目缓存
    protected $category;
    //栏目id
    private $cid;

    public function __init()
    {
        //网站关闭检测
        $this->CheckWebClose();
        $this->cid = Q('cid', 0, 'intval');
        $this->category = S('category');
        if (!isset($this->category[$this->cid])) {
            $this->_404();
        }
        $_REQUEST['mid'] =$_GET['mid']=$this->category[$this->cid]['mid'];
        $this->cacheDir = TEMP_PATH . 'Content/Category/' . $this->cid . '/';
    }

    //栏目列表
    public function index()
    {
        if (C('CACHE_CATEGORY') > 0 && $this->isCache($this->cacheDir)) {
            $this->display(null, C('CACHE_CATEGORY'));
        } else {
            $category = $this->category[$this->cid];
            if ($category['cattype'] == 3) {
                go($category['cat_redirecturl']);
            } else {
                $Model = S('model');
                $table = $Model[$this->category[$this->cid]['mid']]['table_name'];
                //文章数
                $map['cid'] = array('EQ', $this->cid);
                $category['content_num'] = M($table)->where($map)->count();
                //模板
                $tplFile = $category['cattype'] == 2 ? $category['index_tpl'] : $category['list_tpl'];
                $this->assign("hdcms", $category);
                $this->display($this->VIEW_DIR . $tplFile, C('CACHE_CATEGORY'), $this->cacheDir);
            }
        }
    }
}