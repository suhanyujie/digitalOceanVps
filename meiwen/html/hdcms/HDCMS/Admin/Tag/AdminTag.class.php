<?php

/**
 * 后台标签
 * Class AdminTag
 */
class AdminTag extends Tag
{
    public $Tag = array(
        'hdjs' => array('block' => 0, 'level' => 0),
        'cal' => array('block' => 0, 'level' => 0),
    );

    //HDJS库
    public function _hdjs($attr, $content, &$hd)
    {
        return '
            <script type="text/javascript" src="__STATIC__/hdjs/jquery-1.8.2.min.js"></script>
            <link rel="stylesheet" href="__STATIC__/hdjs/hdjs.css"/>
            <script type="text/javascript" src="__STATIC__/hdjs/hdjs.min.js"></script>
        ';
    }

    //日历
    public function _cal($attr, $content, &$hd)
    {
        return '<script src="__STATIC__/cal/lhgcalendar.min.js"></script>';
    }
}