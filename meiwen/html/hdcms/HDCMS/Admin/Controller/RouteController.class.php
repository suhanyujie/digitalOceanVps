<?php

/**
 * 路由器设置
 * Class RouteController
 * @author 后盾向军 <2300071698@qq.com>
 */
class RouteController extends AuthController
{
    public function __init()
    {

    }

    /**
     * 路由设置
     */
    public function index()
    {
        $Model = K('Route');
        if (IS_POST) {
            if ($Model->addRoute()) {
                $this->success('设置成功');
            } else {
                $this->error('设置失败');
            }
        } else {
            $route=$Model->all();
            $this->assign('route', $route);
            $this->display();
        }
    }
}