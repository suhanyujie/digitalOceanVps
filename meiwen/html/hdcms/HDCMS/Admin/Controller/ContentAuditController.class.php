<?php

/**
 * 文章审核
 * Class ContentControl
 * @author 向军 <houdunwangxj@gmail.com>
 */
class ContentAuditController extends AuthController
{
    //模型缓存
    private $model;
    //模型mid
    private $mid;
    //栏目cid
    private $cid;

    //构造函数
    public function __init()
    {
        $this->model = S("model");
        $this->mid = Q('mid', 0, 'intval');
        if (!isset($this->model[$this->mid])) {
            $this->error("模型不存在！");
        }
    }

    //文章列表
    public function content()
    {
        $Model = ContentViewModel::getInstance($this->mid);
        $count = $Model->where('content_status=0')->count();
        $page = new Page($count, 15);
        $data = $Model->where('content_status=0')->limit($page->limit())->order('updatetime DESC')->all();
        $this->assign('data', $data);
        $this->assign('mid', $this->mid);
        $this->assign('model', $this->model);
        $this->assign('page', $page->show());
        $this->display();
    }

    /**
     * 批量删除
     */
    public function batchDel()
    {
        $aid = Q('aid', '', '');
        if (empty($aid)) {
            $this->error('请选择文章');
        }
        $ContentModel = new Content();
        foreach ($aid as $id) {
            $ContentModel->del($id);
        }
        $this->success('删除成功');
    }

    /**
     * 审核文章
     */
    public function audit()
    {
        if ($aids = Q('aid')) {
            $ContentModel = ContentModel::getInstance($this->mid);
            foreach ($aids as $aid) {
                $data = array('aid' => $aid, 'content_status' => 1);
                $ContentModel->save($data);
            }
            $this->success('操作成功');
        } else {
            $this->error('参数错误');
        }
    }
}