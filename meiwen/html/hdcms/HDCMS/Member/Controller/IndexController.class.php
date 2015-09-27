<?php

/**
 * 会员中心首页
 * Class IndexController
 */
class IndexController extends AuthController
{

    public function index()
    {
        //获取收藏夹文章
        $data = $this->getFavoritesAricle();
        $this->assign($data);
        $this->display();
    }

    //获取收藏夹文章
    public function getFavoritesAricle()
    {
        $db = M('favorite');
        $where = "user_id=".$_SESSION['user']['uid'];
        $page = new Page($db->where($where)->count(), 6);
        $data = $db->where($where)->limit($page->limit())->order('fid DESC')->all();
        return array('data'=>$data,'page'=>$page->show());
    }
}