<?php

/**
 * 后台RBAC角色管理
 * Class RoleControl
 * @author 向军 <houdunwangxj@gmail.com>
 */
class RoleController extends AuthController
{
    //模型
    private $db;

    //构造函数
    public function __init()
    {
        $this->db = K('Role');
    }

    //角色列表
    public function index()
    {
        $AdminRole = $this->db->where("admin=1")->all();
        $this->assign('data', $AdminRole);
        $this->display();
    }

    //添加角色
    public function add()
    {
        if (IS_POST) {
            if ($this->db->addRole()) {
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
            if ($this->db->editRole()) {
                $this->success('修改成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $rid = Q('rid', 0, 'intval');
            if ($rid) {
                $this->assign('field', M('role')->find($rid));
                $this->display();
            }
        }
    }

    //删除角色
    public function del()
    {
        if ($this->db->delRole()) {
            $this->success('删除角色成功！');
        } else {
            $this->error('参数错误');
        }
    }
}
