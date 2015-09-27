<?php

/**
 * 登录注册处理模型
 * Class LoginModel
 * @author 后盾向军 <houdunwangxj@gmail.com>
 */
class LoginModel extends Model
{
    public $table = 'user';
    //验证
    public $validate = array(
        array('username', 'checkUsername', '帐号不能为空', 2, 1),
        array('nickname', 'checkNickname', '昵称不能为空', 2, 1),
        array('email', 'checkEmail', '邮箱不能为空', 2, 1),
        array('password', 'nonull', '密码不能为空', 2, 1),
        array('passwordc', 'confirm:password', '确认密码输入错误', 2, 1),
    );

    //验证邮箱
    public function checkEmail($name, $value, $msg, $arg)
    {
        if (empty($value)) {
            return $msg;
        }
        if (M('user')->find("email='{$value}'")) {
            return '邮箱已经存在';
        }
        return true;
    }

    //验证用户名
    public function checkUsername($name, $value, $msg, $arg)
    {
        if (empty($value)) {
            return $msg;
        }
        if (M('user')->find("username='{$value}'")) {
            return '帐号已经存在';
        }
        return true;
    }

    //验证昵称
    public function checkNickname($name, $value, $msg, $arg)
    {
        if (empty($value)) {
            return $msg;
        }
        return true;
    }

    public $auto = array(
        array('regtime', 'time', 'function', 2, 1), //注册时间
        array('logintime', 'time', 'function', 2, 1), //登录时间
        array('regip', 'ip_get_client', 'function', 2, 1), //注册ip
        array('lastip', 'getIp', 'method', 2, 1), //最后登录ip
        array('code', 'getPasswordCode', 'method', 2, 1), //最后登录ip
        array('password', 'getPassword', 'method', 2, 1), //最后登录ip
        array('user_status', '1', 'string', 2, 1), //会员状态
        array('credits', 'getCredits', 'method', 2, 1), //默认积分
        array('rid', '1', 'string', 2, 1), //角色rid
        array('signature', '这家伙很懒什么也没写...', 'string', 2, 1), //个性签名
        array('spec_num', '0', 'string', 2, 1), //空间访问数
        array('icon', 'getIcon', 'method', 2, 1), //头像
    );

    //密码令牌
    public function getPasswordCode()
    {
        return substr(md5(mt_rand() . time()), -10);
    }

    //获得密码
    public function getPassword($v)
    {
        return md5($v . $this->data['code']);
    }

    //获得头像
    public function getIcon($v)
    {
        return '';
    }

    //初始积分
    public function getCredits($v)
    {
        return C('INIT_CREDITS');
    }


    //会员注册
    public function userReg()
    {
        if ($this->create()) {
            $this->data['rid'] = C('DEFAULT_GROUP');
            $this->data['last']=ip_get_client();
            if ($uid = $this->add()) {
                $user = M("user")->join("__user__ u JOIN __role__ r ON u.rid=r.rid")->find($uid);
                //头像
                if (empty($user['icon']) || !is_file($user['icon'])) {
                    $user['icon'] = __STATIC__ . '/image/user.png';
                } else {
                    $user['icon'] = __ROOT__ . '/' . $user['icon'];
                }
                unset($user['password']);
                unset($user['code']);
                $_SESSION['user'] = $user;
                return true;
            }
        }
    }

    //会员登录
    public function userLogin()
    {
        if (!$username = Q('post.username')) {
            $this->error = '帐号不能为空';
            return false;
        }
        if (!$password = Q('post.password')) {
            $this->error = '密码不能为空';
            return false;
        }
        if (!$user = M("user")->join("__user__ u JOIN __role__ r ON u.rid=r.rid")->find("username='{$username}'")) {
            $this->error = '帐号不存在';
            return false;
        }
        if (md5($password . $user['code']) != $user['password']) {
            $this->error = '密码错误';
            return false;
        }
        /**
         * 修改登录IP
         */
        $data['uid']=$user['uid'];
        $data['lastip']=ip_get_client();
        M('user')->save($data);
        unset($user['password']);
        unset($user['code']);
        //头像
        if (empty($user['icon']) || !is_file($user['icon'])) {
            $user['icon'] = __STATIC__ . '/image/user.png';
        } else {
            $user['icon'] = __ROOT__ . '/' . $user['icon'];
        }
        $user['web_master'] = strtolower($user['username']) == strtolower(C('WEB_MASTER'));;
        $_SESSION['user'] = $user;
        return true;
    }
}