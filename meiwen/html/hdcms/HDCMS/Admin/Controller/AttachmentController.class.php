<?php

/**
 * 附件管理
 * Class AttachmentControl
 * @author 后盾向军 <2300071698@qq.com>
 */
class AttachmentController extends AuthController
{
    private $db;

    public function __init()
    {
        $this->db = K("Upload");
    }

    /**
     * 显示列表
     */
    public function index()
    {
        $count = $this->db->count();
        $page = new Page($count);
        $this->page = $page->show();
        $upload = $this->db->order("id desc")->limit($page->limit())->all();
        $this->assign('upload', $upload);
        $this->display();
    }

    /**
     * 删除附件
     */
    public function del()
    {
        $id = Q("id", null, "intval");
        if ($id) {
            $this->db->delFile($id);
            $this->success("删除成功!");
        }
    }

    /**
     * 批量删除
     */
    public function batchDel()
    {
        $ids = Q('ids');
        if ($ids && is_array($ids)) {
            foreach ($ids as $id) {
                $this->db->delFile($id);
            }
            $this->success("删除成功!");
        } else {
            $this->error('参数错误');
        }
    }

}
