<include file="__PUBLIC__/header"/>
<body>
    <div class="hd-menu-list">
        <ul>
            <li><a href="{|U:'index'}">tag列表</a></li>
            <li class="active"><a href="javascript:;">修改tag</a></li>
        </ul>
    </div>
    <div class="hd-title-header">修改Tag</div>
    <form onsubmit="return hd_submit(this,'__ACTION__','{|U:'index'}')" class="hd-form">
        <input type="hidden" name="tid" value="{$field.tid}"/>
        <table class="hd-table hd-table-form">
            <tr>
                <th class="hd-w100">tag</th>
                <td>
                    <input type="text" name="tag" value="{$field.tag}" class="hd-w200"/>
                </td>
            </tr>
            <tr>
                <th class="hd-w100">统计</th>
                <td>
                    <input type="text" name="total" value="{$field.total}" class="hd-w200"/>
                </td>
            </tr>
        </table>
            <input type="submit" class="hd-btn" value="确定"/>
    </form>

</body>
</html>