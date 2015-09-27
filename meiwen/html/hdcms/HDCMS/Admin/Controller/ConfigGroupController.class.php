<?php

/**
 * 配置组管理
 * Class ConfigGroupController
 * @author 后盾向军 <2300071698@qq.com>
 */
class ConfigGroupController extends AuthController
{
    private $db;

    public function __init()
    {
        $this->db = K('ConfigGroup');
    }

    /**
     * 配置组列表
     */
    public function index()
    {
        //获取组列表
        $data = $this->db->getGroup(1);
        $this->assign('data', $data);
        $this->display();
    }

    /**
     * 添加组
     */
    public function add()
    {
        if (IS_POST) {
            if ($this->db->addConfigGroup()) {
                $this->success('添加成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $this->display();
        }
    }

    //修改组
    public function edit()
    {
        if (IS_POST) {
            if ($this->db->editConfigGroup()) {
                $this->success('修改成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $cgid = Q('cgid', 0, 'intval');
            $field = $this->db->find($cgid);
            if (!$field) {
                $this->error($this->db->error);
            } else {
                $this->assign("field", $field);
                $this->display();
            }
        }
    }

    /**
     * 删除配置组
     */
    public function del()
    {
        if ($this->db->delConfigGroup()) {
            $this->success('删除成功');
        } else {
            $this->error($this->db->error);
        }
    }
}