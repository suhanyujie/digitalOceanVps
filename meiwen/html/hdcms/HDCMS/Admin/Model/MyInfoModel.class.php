<?php

/**
 * 我的面板
 * Class MyPassword
 */
class MyInfoModel extends Model
{
    public $table = "user";
    public $validate = array(
        array('email', 'email', '邮箱格式错误', 3, 3),
        array('email', 'checkEmail', '邮箱已存在', 3, 3)
    );

    //邮箱验证
    public function checkEmail($name, $value, $msg, $arg)
    {
        $map['uid'] = array('NEQ', $_SESSION['user']['uid']);
        $map['email'] = array('EQ', $value);
        if (M('user')->where($map)->find()) {
            return $msg;
        } else {
            return true;
        }
    }

    /**
     * 修改个人资料
     */
    public function editInfo()
    {
        if ($this->create()) {
            $this->data['uid'] = $_SESSION['user']['uid'];
            if ($this->save()) {
                return true;
            } else {
                $this->error = '修改失败';
            }
        }
    }
}