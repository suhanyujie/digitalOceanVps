<?php

/**
 * 访问权限验证
 * Class AuthController
 *
 * @author 后盾网向军 <2300071698@qq.com>
 */
abstract class AuthController extends Controller
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        //设置此页面的过期时间(用格林威治时间表示)
        header("Expires: Mon, 26 Jul 1970 05:00:00 GMT");
        //设置此页面的最后更新日期(用格林威治时间表示)为当天
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        //告诉客户端浏览器不使用缓存，HTTP 1.1 协议
        header("Cache-Control: no-cache, must-revalidate");
        //告诉客户端浏览器不使用缓存，兼容HTTP 1.0 协议
        header("Pragma: no-cache");
        //验证后台登录权限
        if ( ! $this->checkAdminAccess()) {
            $this->error("没有操作权限");
        }
        parent::__construct();
    }

    /**
     * 后台权限验证
     *
     * @return bool
     */
    protected function checkAdminAccess()
    {
        //没登录或普通用户
        if ( ! IS_ADMIN) {
            go("Login/login");
        }

        /**
         * 超级管理员与站长不受限制
         */
        if (IS_SUPER_ADMIN || IS_WEB_MASTER) {
            return true;
        }
        /**
         * 普通管理员权限检查
         */
        $nodeModel        = M("node");
        $nodeModel->where = array(
            "MODULE" => MODULE, "controller" => CONTROLLER, "action" => ACTION,
            'type'   => 1
        );
        $node             = $nodeModel->field("nid")->find();
        /**
         * 当节点不存时，表示不需要验证
         * 这时直接允许操作
         */
        if ( ! $node) {
            return true;
        } else {
            $map['nid'] = $node['nid'];
            $map['rid'] = $_SESSION['user']['rid'];

            return M('access')->where($map)->find();
        }
    }
}












