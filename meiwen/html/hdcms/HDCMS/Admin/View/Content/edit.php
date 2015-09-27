<include file="__PUBLIC__/header"/>
<body>
<js file="__STATIC__/cal/lhgcalendar.min.js"/>
<js file="__CONTROLLER_VIEW__/js/js.js"/>
<css file="__CONTROLLER_VIEW__/css/css.css"/>
<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor1_4_3/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor1_4_3/lang/zh-cn/zh-cn.js"></script>
<script src="__STATIC__/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="__STATIC__/uploadify/uploadify.css">
<form class="hd-form">
    <input type="hidden" name="mid" value="{$hd.request.mid}"/>
    <input type="hidden" name="cid" value="{$hd.request.cid}"/>
    <input type="hidden" name="aid" value="{$hd.request.aid}"/>
        <!--右侧缩略图区域-->
        <div class="content_right">
            <table class="hd-table hd-table-form">
            	<?php foreach($form['nobase'] as $field):?>
                    <tr>
                        <th>{$field['title']}</th>
                    </tr>
                    <tr>
                        <td>
                           {$field['form']}
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
        <div class="content_left">
            <div class="hd-title-header">添加文章</div>
            <table class="hd-table hd-table-form">
            	<?php foreach($form['base'] as $field):?>
                <tr>
                    <th class="hd-w80">{$field['title']}</th>
                    <td>
                       {$field['form']}
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
    <input type="submit" class="hd-btn hd-btn-primary" value="确定"/>
    <input type="button" class="hd-btn" onclick="window.close()" value="关闭"/>
</form>
</body>
</html>