<?php

/**
 * 后台管理员管理模块
 * Class AdministratorModel
 * @author 向军 <2300071698@qq.com>
 */
class AdministratorModel extends ViewModel
{
    public $table = "user";
    public $view = array(
        "user" => array("_type" => 'INNER'),
        "role" => array("_on" => "user.rid=role.rid")
    );
    //自动完成
    public $auto = array(
        array('user_state', 1, 'string', 2, 3),
        array('credits', 'intval', 'function', 2, 3)
    );
    //表单验证
    public $validate = array(
        array('username', 'nonull', '帐号不能为空 ', 2, 1),
        array('username', 'IsUsername', '帐号已经存在 ', 2, 1),
        array('password', 'minlen:5', '密码不能小于5位 ', 3, 3),
        array('password', 'nonull', '密码不能为空 ', 3, 3),
        array('password', 'confirm:c_password', '密码不一致 ', 3, 3)
    );

    //验证帐号
    public function IsUsername($name, $value, $msg, $arg)
    {
        $map['username'] = $value;
        if (M('user')->find($map)) {
            return $msg;
        } else {
            return true;
        }
    }

    /**
     * 删除用户
     * @param int $uid 用户uid
     * @return mixed
     */
    public function delUser($uid)
    {
        if ($this->del($uid)) {
            return true;
        } else {
            $this->error = '删除失败';
        }
    }

    /**
     * 修改用户
     */
    public function editUser()
    {
        if ($this->create()) {
            //没有添加密码时删除密码数据
            if (empty($this->data['password'])) {
                unset($this->data['password']);
            } else {
                $code = $this->getUserCode();
                $this->data['code'] = $code;
                $this->data['password'] = md5($this->data['password'] . $code);
            }
            if ($this->save()) {
                return true;
            } else {
                $this->error = '修改失败';
            }
        }
    }

    /**
     * 添加帐号
     */
    public function addUser()
    {
        if ($this->create()) {
            $code = $this->getUserCode();
            $this->data['code'] = $code;
            $this->data['password'] = md5($this->data['password'] . $code);
            $this->data['nickname'] = $this->data['username'];
            $this->data['regtime'] = time();
            $this->data['logintime'] = time();
            $this->data['regip'] = ip_get_client();
            $this->data['lastip'] = ip_get_client();
            $this->data['credits'] = C('init_credits');
            //设置用户头像
            if ($uid = $this->add()) {
                return true;
            } else {
                $this->error = '添加失败';
                return false;
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