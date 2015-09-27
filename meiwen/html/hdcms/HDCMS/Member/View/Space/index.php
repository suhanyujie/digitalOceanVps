<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人空间</title>
    <bootstrap/>
    <css file="__CONTROLLER_VIEW__/css/space.css"/>
</head>
<body>
<div class="wrap">
    <div class="content">
        <div class="top_pic">
            空间顶图
        </div>
        <div class="about">
            <div class="feeb">
                <img src="{$user.icon|icon}"/>
            </div>
            <div class="userinfo">
                <div class="username">
                    <span class="userinfo_username">{$user.nickname}</span>
                </div>
                <div class="userinfo_userdata">
                    <span><b>个性签名:</b> {$user.signature}</span>
                    <span class="userinfo_split"></span>&nbsp;&nbsp;&nbsp;
                    <span><b>空间访问数:</b> {$user.spec_num}</span>
                </div>
            </div>
            <div class="userinfo_shortcut">
                <a href="__ROOT__">返回首页</a> |
                <a href="{|U:'Member/Index/index'}">会员中心</a>
            </div>
        </div>
        <div class="content_wrap">
            <div class="article_list">
                <h1 class="list_title">{$model_name}</h1>
                <ul>
                    <list from="$data" name="$d">
                    <li>
                        <div class="addtime">{$d.addtime|date:"Y-m-d",@@}</div>
                        <div class="article_content">
                            <span class="post_ico"></span>
                            <span class="post_content">
                                <a href="{|U:'Index/Content/index',array('mid'=>$d['mid'],'cid'=>$d['cid'],'aid'=>$d['aid'])}">{$d.title}</a>
                            </span>
                        </div>
                    </li>
                    </list>
                </ul>
                <div class="page1">
                    {$page}
                </div>
            </div>
            <div class="follow">
                <h1 class="ihome_aside_title">频道</h1>
                <ul>
                    <list from="$model" name="$m">
                        <li style="clear: both">
                            <if value="$m.contribute">
                            <a href="{|U:'index',array('uid'=>$_GET['uid'],'mid'=>$m['mid'])}">
                                {$m.model_name}
                            </a>
                            </if>
                        </li>
                    </list>
                </ul>
                <h1 class="ihome_aside_title">最近来访</h1>
                <ul>
                    <list from="$guest" name="$g">
                        <li>
                            <a href="{|U:'index',array('uid'=>$g['uid'])}">
                                <img src="{$g.icon|icon}" alt="{$g.nickname}" title="{$g.nickname}"/>
                            </a>
                        </li>
                    </list>
                </ul>
            </div>
        </div>
    </div>
    <div class="copyright">
        {$hd.config.copyright}
    </div>
</div>

</body>
</html>