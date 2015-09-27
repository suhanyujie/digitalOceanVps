<?php

/**
 * 管理员管理模块
 * Class AdministratorControl
 * @author 向军 <2300071698@qq.com>
 */
class AdministratorController extends AuthController
{
    private $db;

    public function __init()
    {
        $this->db = K("Administrator");
        if (!IS_WEBMASTER) {
            $this->error('没有操作权限');
        }
    }

    /**
     * 管理员列表
     */
    public function index()
    {
        $data = $this->db->order("uid ASC")->where("admin=1")->all();
        $this->assign('data', $data);
        $this->display();
    }

    //删除管理员
    public function del()
    {
        $uid = Q("POST.uid", 0, "intval");
        if ($this->db->delUser($uid)) {
            $this->success('删除成功');
        }
    }

    //添加管理员
    public function add()
    {
        if (IS_POST) {
            if ($this->db->addUser()) {
                $this->success("添加成功！");
            } else {
                $this->error($this->db->error);
            }
        } else {
            $this->role = M("role")->where('admin=1')->order("rid DESC")->all();
            $this->display();
        }
    }

    //修改管理员
    public function edit()
    {
        if (IS_POST) {
            $uid = Q('uid', 0, 'intval');
            $_POST['uid'] = $uid;
            if ($this->db->editUser($_POST)) {
                $this->success("修改成功！");
            } else {
                $this->error($this->db->error);
            }
        } else {
            $uid = Q("request.uid", null, "intval");
            if ($uid) {
                //会员信息
                $this->field = $this->db->find($uid);
                $this->role = $this->db->table("role")->where('admin=1')->order("user.rid DESC")->all();
                $this->display();
            }
        }
    }

}
