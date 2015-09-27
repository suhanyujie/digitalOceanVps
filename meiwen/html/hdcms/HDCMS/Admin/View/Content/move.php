<include file="__PUBLIC__/header"/>
<body>
<div class="hd-title-header">温馨提示</div>
<div class="help">
    <ul>
        <li>不能够跨模型移动文章
        </li>
    </ul>
</div>
<form method="post" onsubmit="return false" class="hd-form">
        <input type="hidden" name="mid" value="{$hd.get.mid}"/>
        <input type="hidden" name="cid" value="{$hd.get.cid}"/>
        <table style="table1">
            <tr>
                <td>指定来源</td>
                <td>目标栏目</td>
            </tr>
            <tr>
                <td>
                    <ul class="fromtype">
                        <li>
                            <label><input type="radio" name="from_type" value="1" checked="checked"/> 从指定aid </label>
                        </li>
                        <li>
                            <label> <input type="radio" name="from_type" value="2"/> 从指定栏目</label>
                        </li>
                    </ul>
                    <div id="t_aid">
                        <textarea name="aid" class="w250 h180">{$hd.get.aid}</textarea>
                    </div>
                    <div id="f_cat" style="display: none">
                        <select id="fromid" style="width:250px;height:180px;" multiple="multiple" size="2"
                                name="from_cid[]">
                            <list from="$category" name="$c">
                                <option value="{$c.cid}"{$c.disabled}>{$c._name}</option>
                            </list>
                        </select>
                    </div>
                </td>
                <td>
                    <select id="fromid" style="width:250px;height:215px;" size="100" name="to_cid">
                        <list from="$category" name="$c">
                            <option value="{$c.cid}"
                            {$c.disabled} {$c.selected}>
                            {$c._name}
                            </option>
                        </list>
                    </select>
                </td>
            </tr>
        </table>
        <input type="submit" class="hd-btn" value="确定"/>
</form>
<style type="text/css">
    body{
        background: #FFFFFF;
    }
    li {
        float: left;
        height: 30px;
        margin-right:10px;
    }

    div {
        clear: both;
    }
    tr td{
        padding: 5px;
        vertical-align: top;
    }
    select {
        border: 1px solid #CCCCCC;
        box-shadow: 2px 2px 2px #F0F0F0 inset;
    }
</style>
<script>
    $("[name='from_type']").click(function () {
        var t = parseInt($("[name='from_type']:checked").val());
        $("div#t_aid,div#f_cat").hide().find("textarea,select").attr("disabled", "disabled");
        switch (t) {
            //文章移动
            case 1:
                $("div#t_aid").show().find("textarea").removeAttr("disabled");
                break;
            //栏目移动
            case 2:
                $("div#f_cat").show().find("select").removeAttr("disabled");
                break;
        }
    })
    //移动
    $("form").submit(function () {
        var data=$(this).serialize();
        var url=CONTROLLER + "&a=move";
        $.ajax({
            type: "POST",
            url: url,
            dataType: "JSON",
            cache: false,
            data: data,
            success: function (data) {
                if (data.status == 1) {
                    hd_alert({
                        message: '移动成功',//显示内容
                        timeout: 3,//显示时间
                        success: function () {//这是回调函数
                            parent.location.reload();
                            window.parent.hd_modal_close();
                        }
                    })
                }
            }
        })
    })
</script>
</body>
</html>