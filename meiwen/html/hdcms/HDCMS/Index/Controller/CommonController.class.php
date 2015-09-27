<?php

/**
 * 前台基类
 * Class CommonController
 * @author hdxj <2300071698@qq.com>
 */
abstract class CommonController extends Controller
{
    //缓存目录
    protected $cacheDir;
    //风格目录
    protected $VIEW_DIR;

    function __construct()
    {
        define('__TEMPLATE__', 'Template/' . C('WEB_STYLE'));
        $this->VIEW_DIR = 'Template/' . C('WEB_STYLE') . '/';
        parent::__construct();
    }

    /**
     * 404页面
     */
    protected function _404()
    {
        set_http_state(404);
        $this->display('Template/system/404');
        exit;
    }

    /**
     * 验证网站关闭
     */
    protected function CheckWebClose(){
        if (!IS_ADMIN && !C("WEB_OPEN")) {
            $this->display('Template/system/web_close');
            exit;
        }
    }
}