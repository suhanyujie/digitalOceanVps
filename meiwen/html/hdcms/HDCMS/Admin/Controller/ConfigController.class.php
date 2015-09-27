<?php

/**
 * 后台网站配置管理
 * Class ConfigControl
 * @author 向军 <2300071698@qq.com>
 */
class ConfigController extends AuthController
{
    private $db;

    public function __init()
    {
        $this->db = K('config');
    }

    //删除配置
    public function del()
    {
        if ($this->db->delConfig()) {
            $this->success('操作成功');
        } else {
            $this->error($this->db->error);
        }
    }

    //添加配置项
    public function add()
    {
        if (IS_POST) {
            if ($this->db->addConfig()) {
                $this->success('添加成功!');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $configGroup = $this->db->getConfigGroup();
            $this->assign("configGroup", $configGroup);
            $this->display();
        }
    }

    //修改网站配置(基本配置）
    public function webConfig()
    {
        if (IS_POST) {
            if ($this->db->editWebConfig()) {
                $this->success("修改成功");
            } else {
                $this->error($this->db->error);
            }
        } else {
            //分配配置组
            $data = $this->db->getConfig();
            $this->assign('data', $data);
            $this->display();
        }
    }



    //更新缓存
    public function updateCache()
    {
        if ($this->db->updateCache()) {
            $this->success('缓存更新成功！');
        } else {
            $this->error($this->db->error);
        }
    }
}