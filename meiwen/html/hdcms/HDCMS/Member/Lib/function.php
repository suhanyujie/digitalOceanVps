<?php
/**
 * 头像处理
 * @param $field
 * @return string
 */
function icon($icon)
{
    $icon = empty($icon)?__STATIC__ . '/image/user.png':__ROOT__.'/'.$icon;
    return $icon;
}
