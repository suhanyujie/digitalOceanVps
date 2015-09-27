<?php

/**
 * 我的面板
 * Class MyPassword
 */
class MyPasswordModel extends Model
{
    public $table = "user";
    public $validate = array(
        array('old_password', 'nonull', '旧密码不能为空', 2, 3),
        array('old_password', 'CheckPassword', '旧密码输入错误', 2, 3),
        array('password', 'nonull', '新密码不能为空', 2, 3),
        array('password', 'confirm:passwordc', '两次密码不一致', 2, 3),
        array('passwordc', 'nonull', '确认密码不能为空', 2, 3),
    );

    public function CheckPassword($name, $value, $msg, $arg)
    {
        $user = M('user')->find($_SESSION['user']['uid']);
        if ($user['password'] != md5($value . $user['code'])) {
            return $msg;
        } else {
            return true;
        }
    }

    /**
     * 修改密码
     */
    public function editPassword()
    {
        if ($this->create()) {
            $code = $this->getUserCode();
            $this->data['uid'] = $_SESSION['user']['uid'];
            $this->data['code'] = $code;
            $this->data['password'] = md5($this->data['password'] . $code);
            if ($this->save()) {
                return true;
            } else {
                $this->error = '修改失败';
            }
        }
    }

    /**
     * 获取用户密码加密key
     * @return string
     */
    public function getUserCode()
    {
        return substr(md5(C("AUTH_KEY") . mt_rand(1, 1000) . time() . C('AUTH_KEY')), 0, 10);
    }
}