<?php

/**
 * 会员管理
 * @author hdxj <houdunwangxj@gmail.com>
 */
class UserController extends AuthController
{
    private $db;

    public function __init()
    {
        $this->db = K("User");
    }

    //会员列表
    public function index()
    {
        $map['user_status'] = array('EQ', 1);
        $data = $this->db->where($map)->order("uid ASC")->all();
        $this->assign('data', $data);
        $this->display();
    }


    //删除
    public function del()
    {
        if (IS_POST) {
            if ($this->db->delUser()) {
                $this->success('删除成功');
            } else {
                $this->error = $this->db->error;
            }
        } else {
            $this->assign('field', M('user')->find(Q('uid')));
            $this->display();
        }
    }

    //添加
    public function add()
    {
        if (IS_POST) {
            if ($this->db->addUser()) {
                $this->success("添加成功");
            } else {
                $this->error($this->db->error);
            }
        } else {
            $this->role = M("role")->order("rid DESC")->all();
            $this->display();
        }
    }

    //修改
    public function edit()
    {
        if (IS_POST) {
            if ($this->db->editUser()) {
                $this->success("修改成功");
            } else {
                $this->error($this->db->error);
            }
        } else {
            $uid = Q("uid", 0, "intval");
            if ($uid) {
                $field = $this->db->find($uid);
                $role = M("role")->order("rid DESC")->all();
                $this->assign('field', $field);
                $this->assign('role', $role);
                $this->display();
            }
        }
    }

}