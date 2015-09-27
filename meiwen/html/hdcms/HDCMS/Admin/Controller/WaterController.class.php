<?php

class WaterController extends AuthController
{
    public $db;

    public function __init()
    {
        $this->db = K('Water');
    }

    /**
     * 水印设置
     */
    public function water()
    {
        if (IS_POST) {
            if ($this->db->editConfig()) {
                $this->success('设置成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $config = M('config')->where(array('cgid' => array('IN', 5)))->order("order_list ASC")->getField('name,value,message,title');
            $this->assign('config', $config);
            $this->display();
        }
    }
}