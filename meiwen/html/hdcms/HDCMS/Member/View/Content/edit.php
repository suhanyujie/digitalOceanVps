<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HDCMS永久免费 - {$hd.config.webname} - by HDCMS</title>
    <hdjs/>
    <jsconst/>
    <js file="__STATIC__/cal/lhgcalendar.min.js"/>
    <js file="__CONTROLLER_VIEW__/js/js.js"/>
    <css file="__CONTROLLER_VIEW__/css/css.css"/>
    <css file="__PUBLIC__/static/css/common.css"/>
    <script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor1_4_3/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor1_4_3/ueditor.all.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor1_4_3/lang/zh-cn/zh-cn.js"></script>
    <script src="__STATIC__/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="__STATIC__/uploadify/uploadify.css">
</head>
<body>
<include file="__PUBLIC__/block/top_menu.php"/>
<div style="margin: 0 auto;width:1100px;">
    <form class="hd-form">
        <input type="hidden" name="mid" value="{$hd.request.mid}"/>
        <input type="hidden" name="cid" value="{$hd.request.cid}"/>
        <input type="hidden" name="aid" value="{$hd.request.aid}"/>
        <!--右侧缩略图区域-->
        <div class="content_right">
            <div class="mod-body">
                <h3>文章发起指南</h3>
                <p><b>• 文章标题:</b> 请用准确的语言描述您发布的文章思想</p>
                <p><b>• 文章内容:</b> 详细补充您的文章内容, 并提供一些相关的素材以供参与者更多的了解您所要文章的主题思想</p>
                <p><b>• 选择栏目:</b> 选择一个或者多个合适的话题, 让您发布的文章得到更多有相同兴趣的人参与. 所有人可以在您发布文章之后添加和编辑该文章所属的话题</p>
            </div>
        </div>
        <div class="content_left">
            <div class="hd-title-header">添加文章</div>
            <table class="hd-table hd-table-form">
                <?php foreach ($form as $field): ?>
                    <tr>
                        <th class="hd-w80">{$field['title']}</th>
                        <td>
                            {$field['form']}
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <input type="submit" class="hd-btn hd-btn-primary" value="确定"/>
        <input type="button" class="hd-btn" onclick="window.close()" value="关闭"/>
    </form>
</div>
</body>
</html>