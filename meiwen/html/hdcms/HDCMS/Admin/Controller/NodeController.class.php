<?php

/**
 * 权限节点管理
 * Class NodeControl
 * @author hdxj <houdunwangxj@gmail.com>
 */
class NodeController extends AuthController
{
    //模型
    private $db;
    //节点树
    private $node;

    public function __init()
    {
        //获得模型实例
        $this->db = K("Node");
        $data = $this->db->order('list_order ASC, nid ASC')->all();
        $node = Data::tree($data, "title", "nid", "pid");
        $this->node = $node;
    }

    //节点列表
    public function index()
    {
        $this->assign('node', $this->node);
        $this->display();
    }

    //添加节点
    public function add()
    {
        if (IS_POST) {
            if ($this->db->addNode()) {
                $this->success('添加成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            //配置菜单列表
            $this->assign('node', $this->node);
            $this->display();
        }
    }

    //删除节点
    public function del()
    {
        if ($this->db->delNode()) {
            $this->success('删除成功');
        } else {
            $this->error($this->db->error);
        }
    }

    //修改节点
    public function edit()
    {
        if (IS_POST) {
            if ($this->db->editNode()) {
                $this->success('修改成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $nid = Q('nid');
            $field = $this->db->find($nid);
            foreach ($this->node as $id => $node) {
                $this->node[$id]['disabled'] = Data::isChild($this->node, $id, $nid, 'nid') ? ' disabled="disabled" ' : '';
            }
            $this->assign('node', $this->node);
            $this->assign('field',$field);
            $this->display();
        }
    }

    //更改菜单排序
    public function updateOrder()
    {
        $menu_order = Q("post.list_order");
        foreach ($menu_order as $nid => $order) {
            $this->db->save(array(
                "nid" => $nid,
                "list_order" => $order
            ));
        }
        $this->db->updateCache();
        $this->success('更改排序成功');
    }
}