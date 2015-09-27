<?php

/**
 * 内容属性管理
 * Class ContentControl
 * @author 向军 <houdunwangxj@gmail.com>
 */
class FlagController extends AuthController
{
    //模型
    private $db;
    //模型mid
    private $mid;
    //模型缓存
    private $model;

    public function __init()
    {
        $this->model = S('model' );
        $this->mid = Q('mid', 0, 'intval');
        if (!$this->mid || !isset($this->model[$this->mid])) {
            $this->error('模型不存在','index');
        }
        $this->db = new FlagModel();
    }

    /**
     * 属性列表
     */
    public function index()
    {
        $this->assign("model", $this->model);
        $this->assign('flag', S('flag'.$this->mid));
        $this->display();
    }

    /**
     * 删除属性
     */
    public function del()
    {
        $index = Q('number');
        if (empty($index)) {
            $this->error('参数错误');
        }
        if ($this->db->delFlag($index)) {
            $this->success('删除成功');
        } else {
            $this->error($this->db->error);
        }
    }

    /**
     * 修改属性
     */
    public function edit()
    {
        if (IS_POST) {
            if ($this->db->editFlag()) {
                $this->success('修改成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $this->error('参数错误');
        }
    }

    /**
     * 添加属性
     */
    public function add()
    {
        if (IS_POST) {
            if ($this->db->addFlag()) {
                $this->success('添加成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $this->display();
        }
    }

    /**
     * 更新缓存
     */
    public function updateCache()
    {
        if ($this->db->updateCache()) {
            $this->success('缓存更新成功');
        }
    }
}