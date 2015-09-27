<include file="__PUBLIC__/header"/>
<body>
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:index,array('mid'=>$_REQUEST['mid'])}">属性管理</a></li>
        <li class="active"><a href="{|U:'add',array('mid'=>$_REQUEST['mid'])}">添加属性</a></li>
    </ul>
</div>
<div class="wrap">
    <div class="hd-title-header">添加属性</div>
    <form class="hd-form" onsubmit="return hd_submit(this,'{|U:'add'}','{|U:'index',array('mid'=>$_GET['mid'])}')">
        <input type="hidden" name="mid" value="{$hd.get.mid}"/>
        <table class="hd-table hd-table-form">
            <tr>
                <th class="hd-w100">属性名称</th>
                <td>
                    <input type="text" name="value" class="hd-w200"/>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" class="hd-btn" value="确定"/>
        </div>
    </form>
</div>

</body>
</html>