<?php

/**
 * 搜索关键词管理
 * Class ManageControl
 * @author <houdunwangxj@gmail.com>
 */
class SearchController extends AuthController
{
    private $db;

    public function __init()
    {
        $this->db = K("Search");
    }

    //显示关键词列表
    public function index()
    {
        $page = new Page($this->db->count(), 15);
        $this->data = $this->db->limit($page->limit())->order("total DESC")->all();
        $this->page = $page->show();
        $this->display();
    }

    //删除搜索词
    public function del()
    {
        $sid = Q("post.sid");
        if (!empty($sid)) {
            foreach ($sid as $i) {
                $this->db->del(intval($i));
            }
            $this->success('操作成功');
        }
    }

    //修改搜索词
    public function edit()
    {
        if (IS_POST) {
            if ($this->db->save()) {
                $this->success('操作成功');
            }
        } else {
            $sid = Q("get.sid", 0, "intval");
            $field = $this->db->find($sid);
            $this->assign("field", $field);
            $this->display();
        }
    }
}