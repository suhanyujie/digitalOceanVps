<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <css file="__PUBLIC__/static/css/common.css"/>
    <hdjs/>
</head>
<body>
<include file="__PUBLIC__/block/top_menu.php"/>
<div class="wrap">
    <div class="menu">
        <include file="__PUBLIC__/block/left_menu.php"/>
    </div>
    <div class="content">
        <div class="list">
            <div class="header">
                修改密码
            </div>
            <div class="article">
                <div class="form">
                    <form method="post" onsubmit="return hd_submit(this,'__ACTION__','__ACTION__')">
                        <label>旧密码</label>
                        <input type="password" name="oldpassword" placeholder="请输入旧密码" required="">
                        <label>新密码</label>
                        <input type="password" name="password" placeholder="请输入新密码" required="">
                        <label>确证密码</label>
                        <input type="password" name="passwordc" placeholder="请输入确认密码" required="">
                        <br/>
                        <input type="submit" value="保存修改" class="btn"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>