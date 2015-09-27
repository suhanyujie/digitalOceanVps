<?php

//标签类文件命名规范：Addon插件名Tag
class AddonCommentTag extends Tag
{
    //声明标签
    public $Tag = array(
        'addon_Comment_list' => array('block' => 0, 'level' => 4),
    );
    //示例标签
    //a) 标签命名规范：_addon_插件名_标签
    //b) 插件安装后才可以使用标签
    //c) 模板使用<addon_Comment_test> </addon_Comment_test>调用
    public function _addon_Comment_list($attr, $content)
    {
        $php=<<<php
        <?php
        require_cache('HDCMS/Addons/Comment/Controller/CommentController.class.php');
        \$obj = new CommentController();
        \$obj->index();
        ?>
php;
        return $php;
    }
}