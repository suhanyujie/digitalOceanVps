<div class="top">
    <div class="top_warp">
        <div class="logo">
            <a href="{|U:'Member/Index/index'}">
                <img src="__PUBLIC__/images/member.png" alt=""/>
            </a>
        </div>
        <div class="top_menu">
            <a href="{|U:'Member/Index/index'}">会员中心</a>
            <a href="{|U:'Space/index',array('uid'=>$_SESSION['user']['uid'])}">个人空间</a>
            <a href="__ROOT__">网站首页</a>
            <a href="{|U:'Index/index'}" class="login">
                <img src="{$hd.session.user.icon}" class="user"/>
                {$hd.session.user.username}
            </a>
        </div>
    </div>
</div>
