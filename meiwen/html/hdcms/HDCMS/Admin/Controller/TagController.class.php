<?php

/**
 * 内容tag管理
 * Class TagControl
 * @author <houdunwangxj@gmail.com>
 */
class TagController extends AuthController
{
    private $db;

    public function __init()
    {
        $this->db = M("tag");
    }

    /**
     * 列表
     */
    public function index()
    {
        $page = new Page($this->db->count(), 15);
        $this->data = $this->db->limit($page->limit())->order("total DESC")->all();
        $this->page = $page->show();
        $this->display();
    }

    /**
     * 删除tag
     */
    public function del()
    {
        if ($tid = Q("tid", 0, 'intval')) {
            if (!is_array($tid)) {
                $tid = array($tid);
            }
            $map['tid'] = array('IN', $tid);
            $this->db->where($map)->del();
            $this->success('删除成功!');
        }
    }

    /**
     * 修改tag
     */
    public function edit()
    {
        if (IS_POST) {
            if ($this->db->save()) {
                $this->success('修改成功!');
            }
        } else {
            $tid = Q("get.tid", 0, "intval");
            $this->field = $this->db->find($tid);
            $this->display();
        }
    }

}