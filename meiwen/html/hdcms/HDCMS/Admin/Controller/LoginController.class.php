<?php

/**
 * 登录处理模块
 * Class LoginController
 *
 * @author 向军 <houdunwangxj@gmail.com>
 */
class LoginController extends Controller
{
    //模型
    private $db;

    /**
     * 构造函数
     */
    public function __init()
    {
        $this->db = K('Login');
        /**
         * 已经登录用户不允许执行
         */
        if (IS_ADMIN && ACTION != 'out') {
            go("Index/index");
        }
    }

    /**
     * 登录页面显示验证码
     *
     * @access public
     */
    public function code()
    {
        C(array(
                "CODE_BG_COLOR" => "#ffffff", "CODE_LEN" => 4,
                "CODE_FONT_SIZE" => 20, "CODE_WIDTH" => 120,
                "CODE_HEIGHT" => 35,
            )
        );
        $code = new Code();
        $code->show();
        exit;
    }

    //用户登录处理
    public function Login()
    {
        if (IS_POST) {
            if ($this->db->login()) {

            } else {
                $this->error($this->db->error);
            }
            //插件监听
            Hook::listen('ADMIN_LOGIN_SUCCESS');
            go("Index/index");
        } else {
            //登录前监听插件
            Hook::listen('ADMIN_LOGIN_START');
            $this->display();
        }
    }

    /**
     * 退出
     */
    public function out()
    {
        //清空SESSION
        session_unset();
        session_destroy();
        echo "<script>
            window.top.location.href='" . U("login") . "';
        </script>";
        exit;
    }

}
