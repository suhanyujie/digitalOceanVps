<?php

/**
 * 会员审核
 * Class UserAuditController
 * @author 向军 <2300071698@qq.com>
 */
class UserAuditController extends Controller
{
    public $db;

    public function __init()
    {
        $this->db = K('UserAudit');
    }

    //会员列表
    public function index()
    {
        $map['user_status'] = array('EQ', 0);
        $data = $this->db->where($map)->order("uid ASC")->all();
        $this->assign('data', $data);
        $this->display();
    }

    //审核
    public function audit()
    {
        if ($this->db->auditUser()) {
            $this->success('审核成功');
        } else {
            $this->error('审核失败');
        }
    }
}