<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <css file="__PUBLIC__/static/css/common.css"/>
    <jquery/>
    <bootstarp/>
</head>
<body>
<include file="__PUBLIC__/block/top_menu.php"/>
<div class="wrap">
    <div class="menu">
        <include file="__PUBLIC__/block/left_menu.php"/>
    </div>
    <div class="content">
        <div class="member_info">
            <div class="user-icon">
                <img src="{$hd.session.user.icon}"/>
            </div>
            <div class="user-info">
                <div class="top-info">
                    <div class="username">{$hd.session.user.username}</div>
                    <div class="role">{$hd.session.user.rname}</div>
                </div>
                <div class="logintime">
                    本次登录时间：{$hd.session.user.logintime|date:"Y-m-d H:i",@@}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;本次登录IP： {$hd.session.user.lastip}
                </div>
            </div>
        </div>
        <div class="list">
            <div class="header">
                收藏夹
            </div>
            <div class="article">
                <table class="table2 hd-form">
                    <list from="$data" name="$c">
                        <tr>
                            <td>
                                <a href="{|U:'Index/Content/index',array('mid'=>$c['mid'],'cid'=>$c['cid'],'aid'=>$c['aid'])}"
                                   target="_blank">
                                    {$c.title}
                                </a>
                            </td>
                        </tr>
                    </list>
                </table>
                <if value="$count">
                    <div class="page1">
                        {$page}
                    </div>
                </if>

            </div>
        </div>
    </div>
</div>
</body>
</html>