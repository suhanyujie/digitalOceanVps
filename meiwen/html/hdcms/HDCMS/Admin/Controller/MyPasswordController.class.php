<?php

/**
 * 管理员个人信息管理模块
 * Class MyPassword
 * @author 向军 <houdunwangxj@gmail.com>
 */
class MyPasswordController extends AuthController
{
    //操作模型
    private $db;

    //构造函数
    public function __init()
    {
        $this->db = K('MyPassword');
    }

    /**
     * 修改密码
     */
    public function edit()
    {
        if (IS_POST) {
            if ($this->db->editPassword()) {
                $this->success('修改成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $this->user = $this->db->find($_SESSION['user']['uid']);
            $this->display();
        }
    }
}