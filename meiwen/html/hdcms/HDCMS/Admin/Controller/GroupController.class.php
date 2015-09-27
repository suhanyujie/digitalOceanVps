<?php

/**
 * 会员组管理
 * Class GroupControl
 * @author 向军 <houdunwangxj@gmail.com>
 */
class GroupController extends AuthController
{
    //模型
    private $db;

    //构造函数
    public function __init()
    {
        $this->db = K('Group');
        if (!IS_WEBMASTER) {
            $this->error('没有操作权限');
        }
    }

    //角色列表
    public function index()
    {
        $this->assign('data', M('role')->where('admin=0')->order('rid ASC')->all());
        $this->display();
    }

    /**
     * 添加角色
     */
    public function add()
    {
        if (IS_POST) {
            if ($aid = $this->db->addRole()) {
                $this->success('添加成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $this->display();
        }
    }

    //编辑角色
    public function edit()
    {
        if (IS_POST) {
            if ($this->db->editRole($_POST)) {
                $this->success('修改成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $rid = Q('rid', 0, 'intval');
            $this->assign('field', M('role')->find($rid));
            $this->display();
        }
    }

    //删除角色
    public function del()
    {
        if ($this->db->delRole()) {
            $this->success('删除成功');
        } else {
            $this->error($this->db->error);
        }
    }
}