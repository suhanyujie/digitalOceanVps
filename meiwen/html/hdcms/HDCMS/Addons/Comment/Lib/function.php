<?php
/**
 * 头像处理
 * @param $field
 * @return string
 */
function icon($icon)
{
    $icon = empty($icon) ? __STATIC__ . '/image/user.png' : __ROOT__ . '/' . $icon;
    return $icon;
}

/**
 * 评论与回复内容安全处理
 * @param $content
 * @return string
 */
function ContentSecurity($content)
{
    //匹配所有[code]代码
    preg_match_all('@\[code\](.+?)\[\/code\]@is', $content, $code, PREG_SET_ORDER);
    //将[code]替换为点位符
    if (!empty($code)) {
        $content = preg_replace('@\[code\].+?\[\/code\]@is', '__HDCODE__', $content);
    }
    //实例化
    $content = nl2br(htmlspecialchars($content));
    //还原代码
    if (!empty($code)) {
        foreach ($code as $c) {
            $brush = '<pre class="brush: php;">' . $c[1] . "</pre>";
            $content = preg_replace('@__HDCODE__@', $brush, $content, 1);
        }
    }
    $content = preg_replace('/^@(.*?):/', "<a href='javascript:;' class='c-user-name'>@\\1:</a>", $content);
    return $content;
}