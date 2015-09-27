<?php

class LoginModel extends ViewModel
{
    //用户表
    public $table = 'user';
    //视图关联
    public $view
        = array(
            'user' => array('_type' => 'INNER'),
            'role' => array('_on' => 'user.rid=role.rid')
        );
    /**
     * 登录验证
     *
     * @var array
     */
    public $validate
        = array(
            array('code', 'isCode', '验证码输入错误', 2, 3),
            array('username', 'nonull', '帐号不能为空', 2, 3),
            array('username', 'isUser', '帐号不存在', 2, 3),
            array('password', 'nonull', '密码不能为空', 2, 3),
            array('password', 'isPassword', '', 2, 3)
        );

    /**
     * 验证码检测
     *
     * @param $name
     * @param $value
     * @param $msg
     * @param $arg
     *
     * @return mixed
     */
    public function isCode($name, $value, $msg, $arg)
    {
        if (empty($value)) {
            return '验证码不能为空';
        } else if (strtoupper($value) !== session('code')) {
            return '验证码输入错误';
        } else {
            return true;
        }
    }

    /**
     * 验证帐号
     *
     * @param $name
     * @param $value
     * @param $msg
     * @param $arg
     *
     * @return bool|string
     */
    public function isUser($name, $value, $msg, $arg)
    {
        $map['username'] = $value;
        if ($user = M()->join('__user__ u join __role__ r on r.rid=r.rid')
            ->where($map)->find()
        ) {
            if ($user['admin'] != 1) {
                return '此帐号没有登录后台权限';
            }

            return true;
        } else {
            return $msg;
        }
    }

    /**
     * 验证密码
     *
     * @param $name
     * @param $value
     * @param $msg
     * @param $arg
     *
     * @return bool|string
     */
    public function isPassword($name, $value, $msg, $arg)
    {
        $map['username'] = Q('post.username');
        $user            = M('user')->where($map)->find();
        if (empty($value)) {
            return '密码不能为空';
        } else if (md5($value . $user['code']) != $user['password']) {
            return '密码输入错误';
        } else {
            return true;
        }
    }

    /**
     * 登录
     *
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            $map['username'] = Q('post.username', '', '');
            $user            = $this->where($map)->find();
            /**
             * 头像设置
             */
            if (empty($user['icon']) || !is_file($user['icon'])) {
                $user['icon'] = __STATIC__ . '/image/user.png';
            } else {
                $user['icon'] = __ROOT__ . '/' . $user['icon'];
            }
            /**
             * 修改登录IP
             */
            $data['uid']=$user['uid'];
            $data['lastip']=ip_get_client();
            M('user')->save($data);
            //删除不需要的字段
            unset($user['password']);
            unset($user['code']);
            session('user', $user);
            /**
             * 登录信息修改
             */
            $this->log();

            return true;
        } else {

            return false;
        }
    }

    /**
     * 更改登录信息
     */
    public function log()
    {
        $data = array(
            'uid'       => $_SERVER['user']['uid'],
            'logintime' => time(),
            'lastip'    => ip_get_client()
        );

        return $this->save($data);
    }
}