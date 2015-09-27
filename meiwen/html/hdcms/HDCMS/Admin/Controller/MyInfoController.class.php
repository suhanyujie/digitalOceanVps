<?php

/**
 * 管理员个人信息管理模块
 * Class MyInfo
 * @author 向军 <houdunwangxj@gmail.com>
 */
class MyInfoController extends AuthController
{
    //操作模型
    private $db;

    //构造函数
    public function __init()
    {
        $this->db = K('MyInfo');
    }

    /**
     * 编辑个人信息
     */
    public function edit()
    {
        if (IS_POST) {
            if ($this->db->editInfo()) {
                $this->success('修改成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $user = $this->db->find($_SESSION['user']['uid']);
            $this->assign('user', $user);
            $this->display();
        }
    }

}