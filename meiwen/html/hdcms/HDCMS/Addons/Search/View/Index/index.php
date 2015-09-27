<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{$hd.config.webname}</title>
    <script type="text/javascript" src="__STATIC__/hdjs/jquery-1.8.2.min.js"></script>
    <link rel="stylesheet" href="__STATIC__/hdjs/hdjs.css"/>
    <script type="text/javascript" src="__STATIC__/hdjs/hdjs.min.js"></script>
    <css file="__CONTROLLER_VIEW__/css/css.css"/>
</head>
<body>
<div class="wrap">
    <div class="top">
        <a href="__ROOT__">网站首页</a> |
        <a href="__ROOT__/index.php?m=Member">会员中心</a>
    </div>
    <div class="form">
        <div class="logo">
            <a href="__ROOT__">
                <img src="__CONTROLLER_VIEW__/image/logo.png" alt="{$hd.config.webname}"/>
            </a>
        </div>
        <div class="input">
            <form action="__ROOT__/index.php?g=Addons&m=Search" method="post">
                <input type="text" name="wd"/>
                <input type="submit" value="搜索" class="btn"/>
            </form>
        </div>
    </div>
    <div class="content">
        <div class="left">
            <dl>
                <dt>全部结果</dt>
                <list from="$model" name="$m">
                    <dd>
                        <a href="{|remove_url_param:'mid','__URL__'}&mid={$m.mid}" <if value="$hd.get.mid==$m.mid">class='cul'</if>>{$m.model_name}</a>
                    </dd>
                </list>
            </dl>
            <dl>
                <dt>全部结果</dt>
                <dd>
                    <a href="{|remove_url_param:'time','__URL__'}&time=day" <if value="$hd.get.time=='day'">class='cul'</if>>一天内</a>
                </dd>
                <dd>
                    <a href="{|remove_url_param:'time','__URL__'}&time=week" <if value="$hd.get.time=='week'">class='cul'</if>>一周内</a>
                </dd>
                <dd>
                    <a href="{|remove_url_param:'time','__URL__'}&time=month" <if value="$hd.get.time=='month'">class='cul'</if>>一月内</a>
                </dd>
                <dd>
                    <a href="{|remove_url_param:'time','__URL__'}&time=year" <if value="$hd.get.time=='year'">class='cul'</if>>一年内</a>
                </dd>
            </dl>
            <dl>
                <dt>搜索历史</dt>
                <foreach from="$search_history" key="$k" value="$v">
                    <dd>
                        <a href="{|remove_url_param:'wd','__URL__'}&wd={$v}">{$v}</a>
                    </dd>
                </foreach>
            </dl>
        </div>
        <div class="middle">
            <ul>
                <list from="$data" name="$d">
                <li>
                    <a href="<?php echo Url::content($d);?>" target="_blank">{$d.title}</a>
                    <p class="description">
                       {$d.description|mb_substr:0,60,'utf-8'}...
                    </p>
                    <p class="link">
                        <span class="link"><?php echo Url::content($d);?></span>
                        <a href="<?php echo Url::category($d);?>">{$d.catname}</a>
                    </p>
                </li>
                </list>
            </ul>
        </div>
        <div class="right">

            <dl>
                <dt>顶尖PHP培训</dt>
                <dd>
                    <a href="http://www.houdunwang.com" target="_blank"><img src="__CONTROLLER_VIEW__/image/study.gif" alt="后盾网"/></a>
                </dd>
            </dl>
        </div>
    </div>
</div>
<div class="bottom-form">
    <div class="input">
        <form action="__ROOT__/index.php?g=Addons&m=Search" method="post">
            <input type="text" name="wd"/>
            <input type="submit" value="搜索" class="btn"/>
        </form>
    </div>
</div>
<div class="copyright">
    {$hd.config.copyright}
</div>
</body>
</html>