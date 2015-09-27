<?php

/**
 * 网站前台
 * Class IndexController
 * @author 向军 <houdunwangxj@gmail.com>
 */
class IndexController extends CommonController
{
    public function __init()
    {
        //网站关闭检测
        $this->CheckWebClose();
        //缓存目录
        $this->cacheDir = TEMP_PATH . 'Content/';
    }

    /**
     * 网站首页
     */
    public function index()
    {
        $this->display($this->VIEW_DIR . '/index.html', C('CACHE_INDEX'), $this->cacheDir);
    }
}
