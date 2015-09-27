<?php

/**
 * 用户管理模型
 * Class UserModel
 */
class UserAuditModel extends ViewModel
{
    public $table = "user";
    //表关联
    public $view = array(
        'user' => array('_type' => "INNER"),
        'role' => array('_on' => 'user.rid=role.rid')
    );

    //审核
    public function auditUser()
    {
        $uid = Q('uid', 0, 'intval');
        if ($uid) {
            $data['uid'] = $uid;
            $data['user_status'] = 1;
            if (M('user')->save($data)) {
                return true;
            } else {
                $this->error = '审核失败';
            }
        }
    }
}