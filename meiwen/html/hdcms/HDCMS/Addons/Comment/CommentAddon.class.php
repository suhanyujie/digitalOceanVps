<?php

/**
 * Comment 插件
 * @author 后盾向军 <houdunwangxj@gmail.com>
 */
class CommentAddon extends Addon
{

    //插件信息
    public $info = array(
        'name' => 'Comment',
        'title' => '评论',
        'description' => '网站评论插件',
        'status' => 1,
        'author' => '后盾网向军',
        'version' => '1.0',
        'has_adminlist' => 1,
    );

    //安装
    public function install()
    {
        if (!M()->exe("DROP TABLE IF EXISTS `" . C('DB_PREFIX') . "addon_comment`")) return false;
        if (!M()->exe("CREATE TABLE `" . C('DB_PREFIX') . "addon_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '评论ID',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '用户ID',
  `comment_content` text COMMENT '评论内容',
  `comment_time` int(11) DEFAULT NULL,
  `cid` smallint(5) unsigned DEFAULT NULL,
  `aid` int(10) unsigned DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态 1 审核 0 待审',
  `praise` int(11) DEFAULT '0' COMMENT '赞',
  PRIMARY KEY (`comment_id`),
  KEY `mid_cid_aid` (`cid`,`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论表'")
        ) return false;
        if (!M()->exe("DROP TABLE IF EXISTS `" . C('DB_PREFIX') . "addon_comment_praise`")) return false;
        if (!M()->exe("CREATE TABLE `" . C('DB_PREFIX') . "addon_comment_praise` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论点赞表'")
        ) return false;
        if (!M()->exe("DROP TABLE IF EXISTS `" . C('DB_PREFIX') . "addon_comment_reply`")) return false;
        if (!M()->exe("CREATE TABLE `" . C('DB_PREFIX') . "addon_comment_reply` (
  `reply_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT NULL COMMENT '评论id',
  `user_id` int(11) DEFAULT NULL COMMENT '会员id',
  `reply_time` int(11) DEFAULT NULL COMMENT '回复时间',
  `reply_content` text COMMENT '回复内容',
  PRIMARY KEY (`reply_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论回复表'")
        ) return false;
        return true;
    }

    //卸载
    public function uninstall()
    {
        if (!M()->exe("DROP TABLE IF EXISTS `" . C('DB_PREFIX') . "addon_comment`")) return false;
        if (!M()->exe("DROP TABLE IF EXISTS `" . C('DB_PREFIX') . "addon_comment_praise`")) return false;
        if (!M()->exe("DROP TABLE IF EXISTS `" . C('DB_PREFIX') . "addon_comment_reply`")) return false;
        return true;
    }
}