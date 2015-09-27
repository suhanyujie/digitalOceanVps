<?php

/**
 * Search 插件
 * @author 后盾向军 <houdunwangxj@gmail.com>
 */
class SearchAddon extends Addon
{

    //插件信息
    public $info = array(
        'name' => 'Search',
        'title' => '前台搜索',
        'description' => '前台搜索',
        'status' => 1,
        'author' => '后盾网向军',
        'version' => '1.0',
        'has_adminlist' => 0,
    );

    //安装
    public function install()
    {
        return true;
    }

    //卸载
    public function uninstall()
    {
        return true;
    }
}