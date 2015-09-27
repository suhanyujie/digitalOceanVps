<?php

class InstallTag extends Tag
{
    public $Tag = array(
        'hdjs' => array('block' => 0, 'level' => 0),
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
}