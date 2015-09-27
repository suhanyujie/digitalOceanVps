<include file="__PUBLIC__/header"/>
<body>
<form class="hd-form" onsubmit="return hd_submit(this,'__ACTION__','{|U:'Role/index'}')">
    <input type="hidden" name="rid" value="{$rid}"/>

    <div class="hd-menu-list">
        <ul>
            <li><a href="{|U:'Role/index'}">角色列表</a></li>
            <li class="active"><a href="javascript:;">设置权限</a></li>
        </ul>
    </div>
    <div class="access">
        <ul>
            <list from="$access" name="$a">
                <li class="li1">
                    <h3> {$a.checkbox}</h3>
                    <?php if ($a['_data']): ?>
                        <ul class="level2">
                            <list from="$a._data" name="$b">
                                <li class="li2">
                                    <h4> {$b.checkbox}</h4>
                                    <?php if ($b['_data']): ?>
                                        <ul class="level3">
                                            <list from="$b._data" name="$c">
                                                <li>
                                                    {$c.checkbox}
                                                </li>
                                            </list>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            </list>
                        </ul>
                    <?php endif; ?>
                </li>
            </list>
        </ul>
    </div>
    <input type="submit" class="hd-btn" value="确定"/>
</form>
<style type="text/css">
    h3, h4, li, label {
        font-size: 12px;
        vertical-align: middle;
    }

    h3 {
        margin-bottom: 0px;
        margin-top: 10px;
        background: #E6E6E6;
        padding: 8px;
    }

    ul .level2 {
        height: auto;
        overflow: hidden;
    }

    ul .level2 li.li2 {
        padding: 5px 10px 5px 5px;
        height: auto;
        overflow: hidden;
        clear: both;
        border-bottom: solid 1px #dcdcdc;
        margin: 5px;
    }

    ul .level3 {
        clear: both;
        height: auto;
        overflow: hidden;
    }

    ul .level3 li {
        float: left !important;
        display: inline-block;
        padding: 10px 10px 5px 0px;
        margin-right: 10px;
        border: 0;
    }

    ul .level3 li:first-child {
        border: none;
    }
</style>
<script>
    //复选框选后，将子集checked选中
    $("input").click(function () {
        var _obj = $(this);
        //将所有子节点选中
        $(this).parents("li").eq(0).find("input").not($(this)).each(function (i) {
            $(this).attr("checked", _obj.attr("checked") == "checked");
        });
        //将父级NID选中
        if ($(this).attr("checked")) {
            $(this).parents("li").each(function (i) {
                $(this).children("label,h3,h4").find("input").attr("checked", "checked");
            })
        }
    })
</script>
</body>
</html>