<?php if(!defined('HDPHP_PATH'))EXIT;
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."all_client_web`");
$db->exe("CREATE TABLE `all_client_web` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `web` varchar(255) NOT NULL,
  `status` tinyint(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `web` (`web`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."access`");
$db->exe("CREATE TABLE `".$db_prefix."access` (
  `rid` smallint(5) unsigned NOT NULL,
  `nid` smallint(5) unsigned NOT NULL,
  KEY `gid` (`rid`),
  KEY `nid` (`nid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员权限分配表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."addon_comment`");
$db->exe("CREATE TABLE `".$db_prefix."addon_comment` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."addon_comment_praise`");
$db->exe("CREATE TABLE `".$db_prefix."addon_comment_praise` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论点赞表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."addon_comment_reply`");
$db->exe("CREATE TABLE `".$db_prefix."addon_comment_reply` (
  `reply_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT NULL COMMENT '评论id',
  `user_id` int(11) DEFAULT NULL COMMENT '会员id',
  `reply_time` int(11) DEFAULT NULL COMMENT '回复时间',
  `reply_content` text COMMENT '回复内容',
  PRIMARY KEY (`reply_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='评论回复表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."addons`");
$db->exe("CREATE TABLE `".$db_prefix."addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `has_adminlist` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=294 DEFAULT CHARSET=utf8 COMMENT='插件表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."category`");
$db->exe("CREATE TABLE `".$db_prefix."category` (
  `cid` mediumint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目ID',
  `pid` mediumint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `catname` char(30) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `catimage` varchar(200) DEFAULT NULL COMMENT '栏目图片',
  `catdir` varchar(255) DEFAULT NULL,
  `cat_keyworks` varchar(255) DEFAULT '' COMMENT '栏目关键字',
  `cat_description` varchar(255) DEFAULT '' COMMENT '栏目描述',
  `index_tpl` varchar(200) DEFAULT '' COMMENT '封面模板',
  `list_tpl` varchar(200) DEFAULT '' COMMENT '列表页模板',
  `arc_tpl` varchar(200) DEFAULT '' COMMENT '内容页模板',
  `cat_html_url` varchar(200) DEFAULT '' COMMENT '栏目页URL规则\n\n',
  `arc_html_url` varchar(200) DEFAULT '' COMMENT '内容页URL规则',
  `mid` smallint(6) NOT NULL DEFAULT '0' COMMENT '模型ID',
  `cattype` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 栏目,2 封面,3 外部链接,4 单文章',
  `arc_url_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '文章访问方式 1 静态访问 2 动态访问',
  `cat_url_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '栏目访问方式 1 静态访问 2 动态访问',
  `cat_redirecturl` varchar(100) NOT NULL DEFAULT '' COMMENT '跳转url',
  `catorder` smallint(5) unsigned NOT NULL DEFAULT '100' COMMENT '栏目排序',
  `cat_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'channel标签调用时是否显示',
  `cat_seo_title` char(100) NOT NULL DEFAULT '' COMMENT 'SEO标题',
  `cat_seo_description` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO描述',
  `add_reward` smallint(5) NOT NULL DEFAULT '0' COMMENT '搞稿奖励',
  `show_credits` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '查看积分',
  `repeat_charge_day` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '重复收费天数',
  `allow_user_set_credits` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否允许会员投稿设置积分 1 允许 0 不允许',
  `member_send_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '会员投稿状态 1 审核 2 未审核',
  `priv_child` tinyint(1) DEFAULT '0' COMMENT '应用到子栏目',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='栏目表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."category_access`");
$db->exe("CREATE TABLE `".$db_prefix."category_access` (
  `rid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目cid',
  `mid` smallint(1) NOT NULL DEFAULT '0' COMMENT '模型mid',
  `content` tinyint(1) NOT NULL DEFAULT '0' COMMENT '允许访问 1 允许 0 不允许',
  `add` tinyint(1) NOT NULL DEFAULT '0' COMMENT '允许投稿(添加) 1允许 0 不允许',
  `edit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '允许更新 1允许 0 不允许',
  `del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '允许删除 1允许 0 不允许',
  `order` tinyint(1) NOT NULL DEFAULT '0' COMMENT '允许排序 1允许 0 不允许',
  `move` tinyint(1) NOT NULL DEFAULT '0' COMMENT '允许移动 1允许 0 不允许',
  `audit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '允许审核栏目文章 1 允许 0 不允许',
  `admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为管理员权限 1 管理员 2 前台用户'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='栏目权限表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."config`");
$db->exe("CREATE TABLE `".$db_prefix."config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cgid` mediumint(9) DEFAULT NULL COMMENT '配置组ID',
  `name` varchar(45) NOT NULL DEFAULT '' COMMENT '配置名称\n',
  `value` text NOT NULL COMMENT '配置值',
  `title` char(30) NOT NULL DEFAULT '',
  `show_type` enum('text','radio','textarea','select','group') DEFAULT 'text',
  `info` text COMMENT '参数',
  `message` varchar(255) DEFAULT NULL COMMENT '提示',
  `order_list` smallint(6) unsigned DEFAULT '100' COMMENT '排序',
  `status` tinyint(4) DEFAULT '1' COMMENT '总配置模块显示  如模板风格就不显示 1显示 0 不显示',
  `system` tinyint(1) DEFAULT '0' COMMENT '系统字段',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='系统配置'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."config_group`");
$db->exe("CREATE TABLE `".$db_prefix."config_group` (
  `cgid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cgname` char(100) DEFAULT NULL COMMENT '组名（英文）',
  `cgtitle` varchar(255) DEFAULT NULL COMMENT '组标题（中文）',
  `cgorder` mediumint(6) DEFAULT '100' COMMENT '组顺序',
  `isshow` tinyint(1) DEFAULT '1' COMMENT '显示',
  `system` tinyint(1) DEFAULT '0' COMMENT '系统组',
  PRIMARY KEY (`cgid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='配置组'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."content`");
$db->exe("CREATE TABLE `".$db_prefix."content` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目cid',
  `uid` int(10) unsigned NOT NULL COMMENT '用户uid',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '标题',
  `flag` set('热门','置顶','推荐','图片','精华','幻灯片','站长推荐') DEFAULT NULL,
  `new_window` tinyint(1) NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  `seo_title` char(100) NOT NULL DEFAULT '' COMMENT 'SEO标题',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图',
  `click` int(6) NOT NULL DEFAULT '0' COMMENT '点击数',
  `redirecturl` varchar(255) NOT NULL DEFAULT '' COMMENT '转向链接',
  `html_path` varchar(255) NOT NULL DEFAULT '' COMMENT '自定义生成的静态文件地址',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `updatetime` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `color` char(7) NOT NULL DEFAULT '' COMMENT '标题颜色',
  `template` varchar(255) NOT NULL DEFAULT '' COMMENT '模板',
  `url_type` tinyint(80) NOT NULL DEFAULT '3' COMMENT '文章访问方式  1 静态访问  2 动态访问  3 继承栏目',
  `arc_sort` mediumint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `content_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '文章状态  1 已审核 0 未审核 2 草稿',
  `readpoint` char(6) DEFAULT NULL COMMENT '阅读收费',
  `keywords` varchar(100) DEFAULT '' COMMENT '关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `auto_send_time` int(11) DEFAULT '0' COMMENT '自动发表时间',
  `files` mediumtext,
  PRIMARY KEY (`aid`),
  KEY `uid` (`uid`),
  KEY `cid` (`cid`),
  KEY `flag` (`flag`),
  KEY `content_status` (`content_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."content_data`");
$db->exe("CREATE TABLE `".$db_prefix."content_data` (
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章主表ID',
  `content` mediumtext COMMENT '内容',
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章正文表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."content_tag`");
$db->exe("CREATE TABLE `".$db_prefix."content_tag` (
  `mid` smallint(6) NOT NULL COMMENT '模型mid',
  `cid` smallint(6) NOT NULL DEFAULT '0' COMMENT '栏目cid',
  `aid` int(11) NOT NULL DEFAULT '0' COMMENT '文章aid',
  `tid` int(11) NOT NULL DEFAULT '0' COMMENT '标签id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容标签表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."download`");
$db->exe("CREATE TABLE `".$db_prefix."download` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目cid',
  `uid` int(10) unsigned NOT NULL COMMENT '用户uid',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '标题',
  `flag` set('热门','置顶','推荐','图片','精华','幻灯片','站长推荐') DEFAULT NULL,
  `new_window` tinyint(1) NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  `seo_title` char(100) NOT NULL DEFAULT '' COMMENT 'SEO标题',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图',
  `click` int(6) NOT NULL DEFAULT '0' COMMENT '点击数',
  `redirecturl` varchar(255) NOT NULL DEFAULT '' COMMENT '转向链接',
  `html_path` varchar(255) NOT NULL DEFAULT '' COMMENT '自定义生成的静态文件地址',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `updatetime` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `color` char(7) NOT NULL DEFAULT '' COMMENT '标题颜色',
  `template` varchar(255) NOT NULL DEFAULT '' COMMENT '模板',
  `url_type` tinyint(80) NOT NULL DEFAULT '3' COMMENT '文章访问方式  1 静态访问  2 动态访问  3 继承栏目',
  `arc_sort` mediumint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `content_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '文章状态  1 已审核 0 未审核 2 草稿',
  `readpoint` char(6) DEFAULT NULL COMMENT '阅读收费',
  `keywords` varchar(100) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `files` mediumtext,
  `system` varchar(255) NOT NULL DEFAULT '',
  `language` char(250) NOT NULL DEFAULT '',
  `softtype` char(250) NOT NULL DEFAULT '',
  `version` varchar(255) NOT NULL DEFAULT '',
  `auto_send_time` int(11) DEFAULT '0' COMMENT '自动发表时间',
  PRIMARY KEY (`aid`),
  KEY `uid` (`uid`),
  KEY `cid` (`cid`),
  KEY `flag` (`flag`),
  KEY `content_status` (`content_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."download_data`");
$db->exe("CREATE TABLE `".$db_prefix."download_data` (
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章主表ID',
  `content` text COMMENT '内容',
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章正文表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."favorite`");
$db->exe("CREATE TABLE `".$db_prefix."favorite` (
  `fid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `mid` smallint(6) unsigned DEFAULT NULL,
  `cid` smallint(6) unsigned DEFAULT NULL,
  `aid` int(10) unsigned DEFAULT NULL,
  `title` char(200) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员文章收藏夹'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."field`");
$db->exe("CREATE TABLE `".$db_prefix."field` (
  `fid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型ID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1 正常 0 禁用',
  `field_type` varchar(255) NOT NULL DEFAULT '' COMMENT '字段类型 text|textarea|radio|checkbox|image|images|datetime|',
  `table_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '字段所在表 1 主表 2 副表',
  `table_name` varchar(255) NOT NULL DEFAULT '' COMMENT '所在表名',
  `field_name` varchar(255) NOT NULL DEFAULT '' COMMENT '字段name名称',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '字段标题 ',
  `tips` varchar(255) NOT NULL DEFAULT '' COMMENT '字段提示',
  `enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 开启 0 关闭',
  `is_system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为系统字段',
  `fieldsort` mediumint(9) NOT NULL DEFAULT '100' COMMENT '字段排序',
  `set` text COMMENT '字段设置',
  `css` varchar(255) NOT NULL DEFAULT '' COMMENT 'CSS样式',
  `minlength` char(255) NOT NULL DEFAULT '' COMMENT '最小字数',
  `maxlength` char(255) NOT NULL DEFAULT '' COMMENT '最大字数',
  `validate` char(255) NOT NULL DEFAULT '' COMMENT '正则验证',
  `required` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否必须输入',
  `error` varchar(255) NOT NULL DEFAULT '' COMMENT '错误提示',
  `isunique` tinyint(1) NOT NULL DEFAULT '0' COMMENT '值唯一',
  `isbase` tinyint(1) NOT NULL DEFAULT '1' COMMENT '作为基本信息',
  `issearch` tinyint(1) NOT NULL DEFAULT '1' COMMENT '作为搜索条件',
  `isadd` tinyint(1) NOT NULL DEFAULT '1' COMMENT '在前台投稿中显示',
  PRIMARY KEY (`fid`),
  KEY `mid` (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=216 DEFAULT CHARSET=utf8 COMMENT='模型字段'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."hooks`");
$db->exe("CREATE TABLE `".$db_prefix."hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  `status` tinyint(1) DEFAULT NULL COMMENT '状态',
  `is_system` tinyint(1) DEFAULT '0' COMMENT '系统钩子',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='钩子表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."menu_favorite`");
$db->exe("CREATE TABLE `".$db_prefix."menu_favorite` (
  `uid` smallint(5) unsigned NOT NULL,
  `nid` smallint(5) unsigned NOT NULL,
  KEY `gid` (`uid`),
  KEY `nid` (`nid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员权限分配表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."model`");
$db->exe("CREATE TABLE `".$db_prefix."model` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `model_name` char(255) NOT NULL DEFAULT '' COMMENT '模型名称',
  `table_name` char(255) NOT NULL DEFAULT '' COMMENT '主表名',
  `enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '禁用 1 开启 0 关闭',
  `model_description` varchar(255) NOT NULL DEFAULT '' COMMENT '模型描述',
  `is_system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 系统模型  2 普通模型',
  `contribute` tinyint(1) NOT NULL DEFAULT '1' COMMENT '前台投稿',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='模型表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."node`");
$db->exe("CREATE TABLE `".$db_prefix."node` (
  `nid` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` char(200) NOT NULL DEFAULT '' COMMENT '中文标题',
  `group` char(200) NOT NULL DEFAULT '',
  `module` char(200) NOT NULL DEFAULT '' COMMENT '应用',
  `controller` char(200) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` char(200) NOT NULL DEFAULT '' COMMENT '方法',
  `param` char(255) NOT NULL DEFAULT '' COMMENT '参数',
  `comment` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `is_show` tinyint(4) DEFAULT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '类型 1 权限控制菜单   2 普通菜单 ',
  `pid` mediumint(6) NOT NULL DEFAULT '0',
  `list_order` mediumint(6) NOT NULL DEFAULT '100' COMMENT '排序',
  `is_system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '系统菜单 1 是  0 不是',
  `favorite` tinyint(1) NOT NULL DEFAULT '0' COMMENT '后台常用菜单   1 是  0 不是',
  PRIMARY KEY (`nid`)
) ENGINE=MyISAM AUTO_INCREMENT=194 DEFAULT CHARSET=utf8 COMMENT='节点表（后台菜单也使用）'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."picture`");
$db->exe("CREATE TABLE `".$db_prefix."picture` (
  `aid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `cid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '栏目cid',
  `uid` int(10) unsigned NOT NULL COMMENT '用户uid',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '标题',
  `flag` set('热门','置顶','推荐','图片','精华','幻灯片','站长推荐') DEFAULT NULL,
  `new_window` tinyint(1) NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  `seo_title` char(100) NOT NULL DEFAULT '' COMMENT 'SEO标题',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图',
  `click` int(6) NOT NULL DEFAULT '0' COMMENT '点击数',
  `redirecturl` varchar(255) NOT NULL DEFAULT '' COMMENT '转向链接',
  `html_path` varchar(255) NOT NULL DEFAULT '' COMMENT '自定义生成的静态文件地址',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `updatetime` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `color` char(7) NOT NULL DEFAULT '' COMMENT '标题颜色',
  `template` varchar(255) NOT NULL DEFAULT '' COMMENT '模板',
  `url_type` tinyint(80) NOT NULL DEFAULT '3' COMMENT '文章访问方式  1 静态访问  2 动态访问  3 继承栏目',
  `arc_sort` mediumint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `content_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '文章状态  1 已审核 0 未审核 2 草稿',
  `readpoint` char(6) DEFAULT NULL COMMENT '阅读收费',
  `keywords` varchar(100) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `pics` mediumtext,
  `auto_send_time` int(11) DEFAULT '0' COMMENT '自动发表时间',
  PRIMARY KEY (`aid`),
  KEY `uid` (`uid`),
  KEY `cid` (`cid`),
  KEY `flag` (`flag`),
  KEY `content_status` (`content_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."picture_data`");
$db->exe("CREATE TABLE `".$db_prefix."picture_data` (
  `aid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章主表ID',
  `content` text COMMENT '内容',
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章正文表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."role`");
$db->exe("CREATE TABLE `".$db_prefix."role` (
  `rid` smallint(5) NOT NULL AUTO_INCREMENT,
  `rname` char(60) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '描述',
  `admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '管理组 1 是 0 不是',
  `system` tinyint(1) NOT NULL DEFAULT '0' COMMENT '系统角色',
  `creditslower` mediumint(9) NOT NULL DEFAULT '0' COMMENT '积分<=时为此会员组',
  `comment_state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '评论不需要审核  1 不需要  2 需要',
  `allowsendmessage` tinyint(1) NOT NULL DEFAULT '1' COMMENT '允许发短消息  1 允许  2 不允许',
  PRIMARY KEY (`rid`),
  KEY `gid` (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='角色表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."route`");
$db->exe("CREATE TABLE `".$db_prefix."route` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '描述',
  `route` varchar(255) DEFAULT NULL COMMENT '路由规则',
  `url` varchar(255) DEFAULT NULL COMMENT '正常URL',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='前台路由配置'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."session`");
$db->exe("CREATE TABLE `".$db_prefix."session` (
  `sessid` char(32) NOT NULL DEFAULT '',
  `data` mediumtext NOT NULL,
  `atime` int(10) NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`sessid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='session会话表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."tag`");
$db->exe("CREATE TABLE `".$db_prefix."tag` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(30) DEFAULT '' COMMENT 'tag字符',
  `total` mediumint(9) DEFAULT '1' COMMENT '次数',
  PRIMARY KEY (`tid`),
  UNIQUE KEY `name` (`tag`),
  KEY `total` (`total`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tag标签表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."upload`");
$db->exe("CREATE TABLE `".$db_prefix."upload` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `name` varchar(255) DEFAULT '' COMMENT '原文件名',
  `filename` varchar(100) NOT NULL DEFAULT '' COMMENT '文件名',
  `basename` varchar(100) NOT NULL DEFAULT '' COMMENT '有扩展名的文件名',
  `path` char(200) NOT NULL DEFAULT '' COMMENT '文件路径 ',
  `ext` varchar(45) NOT NULL DEFAULT '' COMMENT '扩展名',
  `image` tinyint(1) NOT NULL DEFAULT '1' COMMENT '图片',
  `size` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `uptime` int(10) NOT NULL DEFAULT '0' COMMENT '上传时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否使用 1 使用 0 未使用',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户uid',
  `mid` smallint(6) NOT NULL DEFAULT '0' COMMENT '模型mid',
  PRIMARY KEY (`id`),
  KEY `basename` (`basename`),
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='上传文件'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."user`");
$db->exe("CREATE TABLE `".$db_prefix."user` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` char(30) NOT NULL DEFAULT '' COMMENT '昵称',
  `username` char(30) NOT NULL DEFAULT '',
  `password` char(40) NOT NULL DEFAULT '',
  `code` char(30) NOT NULL DEFAULT '' COMMENT '密码key',
  `email` char(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `regtime` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录时间',
  `regip` char(255) NOT NULL DEFAULT '' COMMENT '注册IP',
  `lastip` char(15) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `user_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1  正常  0 锁定',
  `lock_end_time` int(10) NOT NULL DEFAULT '0' COMMENT '锁定到期时间',
  `qq` char(20) NOT NULL DEFAULT '' COMMENT 'qq号码',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 男 2 女 3 保密',
  `credits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `rid` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '角色id',
  `signature` varchar(255) NOT NULL DEFAULT '' COMMENT '个性签名',
  `spec_num` mediumint(9) unsigned NOT NULL DEFAULT '0' COMMENT '空间访问数',
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='会员表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."user_credits`");
$db->exe("CREATE TABLE `".$db_prefix."user_credits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` smallint(5) unsigned DEFAULT NULL COMMENT '栏目',
  `aid` int(10) unsigned DEFAULT NULL COMMENT '文章',
  `mid` smallint(5) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '文章标题',
  `uid` int(10) unsigned DEFAULT NULL COMMENT '会员',
  `rectime` int(10) DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员积分日志表'");
$db->exe("DROP TABLE IF EXISTS `".$db_prefix."user_guest`");
$db->exe("CREATE TABLE `".$db_prefix."user_guest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `space_uid` int(11) unsigned DEFAULT NULL COMMENT '主人uid',
  `guest_uid` int(11) unsigned DEFAULT NULL COMMENT '访问uid',
  `entertime` int(11) DEFAULT NULL COMMENT '访客时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='空间访客记录'");
