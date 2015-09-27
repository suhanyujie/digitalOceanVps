<?php

/**
 * 修改个人资料
 * Class AccountModel
 * @author 后盾向军 <houdunwangxj@gmail.com>
 */
class AccountModel extends Model
{
    public $table = 'user';

    //设置个人资料
    public function personal()
    {
        if (!Q('post.nickname')) {
            $this->error = '昵称不能为空';
            return false;
        }
        if (!$email = Q('post.email')) {
            $this->error = '邮箱不能为空';
            return false;
        }
        if (M('user')->where(array('email' => array("EQ", $email), 'username' => array('NEQ', $_SESSION['user']['username'])))->find()) {
            $this->error = '昵称已经存在';
            return false;
        }
        $_POST['uid'] = $_SESSION['user']['uid'];
        return $this->save();
    }

    //设置密码
    public function setPassword()
    {
        $this->validate = array(
            array('oldpassword', 'nonull', '旧密码不能为空', 2, 3),
            array('password', 'nonull', '新密码不能为空', 2, 3),
            array('passwordc', 'nonull', '确认密码不能为空', 2, 3),
            array('password', 'confirm:passwordc', '两次密码不一致', 2, 3),
        );
        if ($this->create()) {
            $user = M('user')->find($_SESSION['user']['uid']);
            if (md5($_POST['oldpassword'] . $user['code']) != $user['password']) {
                $this->error = '旧密码输入错误';
                return false;
            }
            $data['uid'] = $_SESSION['user']['uid'];
            $data['code'] = substr(md5(mt_rand() . time()), -10);
            $data['password'] = md5($_POST['password'] . $data['code']);
            return $this->save($data);
        }
    }
}