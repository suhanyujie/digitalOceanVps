<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li class="active"><a href="{|U:'index'}">会员列表</a></li>
        <li><a href="{|U:'add'}">添加会员</a></li>
    </ul>
</div>
<table class="hd-table hd-table-list hd-form">
    <thead>
    <tr>
        <td class="hd-w30">uid</td>
        <td>昵称</td>
        <td class="hd-w200">帐号</td>
        <td CLASS="W300">会员组</td>
        <td class="hd-w150">登录时间</td>
        <td CLASS="W300">锁定</td>
        <td class="hd-w100">注册IP</td>
        <td class="hd-w100">最近登录IP</td>
        <td class="hd-w100">积分</td>
        <td class="hd-w60">操作</td>
    </tr>
    </thead>
    <list from="$data" name="$d">
        <tr>
            <td>{$d.uid}</td>
            <td>{$d.nickname}</td>
            <td>{$d.username}</td>
            <td>{$d.rname}</td>
            <td>{$d.logintime|date:'Y-m-d H:i:s',@@}</td>
            <td>
                <?php if ($d['lock_end_time'] > 0 && $d['lock_end_time'] < time()) { ?>
                    √</a>
                <?php } else { ?>
                    x
                <?php } ?>
            </td>
            <td>{$d.regip}</td>
            <td>{$d.lastip}</td>
            <td>{$d.credits}</td>
            <td>
                <if value="$d.username eq C('WEB_MASTER')">
                    修改 | 删除
                    <else/>
                    <a href="{|U:'edit',array('uid'=>$d['uid'])}">修改</a>
                    <span class="line">|</span>
                    <a href="{|U:'del',array('uid'=>$d['uid'])}">删除</a>
                </if>
            </td>
        </tr>
    </list>
</table>
</body>
</html>