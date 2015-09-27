<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{$hd.config.webname}</title>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <css file="__PUBLIC__/static/css/common.css"/>
    <jquery/>
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
                {$model.model_name}
            </div>
            <div class="article_menu">
                <a href="javascript:;" onclick="window.open('{|U:'add',array('mid'=>$_GET['mid'])}')">发表文章</a>
            </div>
            <div class="article">
                <table class="table2 hd-form">
                    <thead>
                    <tr>
                        <td>文章标题</td>
                        <td width="100">栏目</td>
                        <td width="50">状态</td>
                        <td width="50">点击</td>
                        <td width="100">发布时间</td>
                        <td width="100">操作</td>
                    </tr>
                    </thead>
                    <list from="$data" name="$c">
                        <tr>
                            <td>
                                <a href="{|U:'Index/Content/index',array('mid'=>$c['mid'],'cid'=>$c['cid'],'aid'=>$c['aid'])}" target="_blank">
                                    {$c.title}
                                </a>
                            </td>
                            <td>
                                <a href="{|U:'Index/Category/index',array('cid'=>$c['cid'])}" target="_blank">
                                    {$c.catname}
                                </a>
                            </td>
                            <td>
                                <if value="$c.content_status eq 1">
                                    已审核
                                <else/>
                                    未审核
                                </if>
                            </td>
                            <td>{$c.click}</td>
                            <td>{$c.addtime|date:"Y-m-d",@@}</td>
                            <td>
                                <a href="{|U:'Index/Content/index',array('cid'=>$c['cid'],'aid'=>$c['aid'])}" target="_blank">
                                    访问
                                </a>
                                <span class="line">|</span>
                                <a href="javascript:;"
                                    onclick="window.open('{|U:edit,array('mid'=>$c['mid'],'cid'=>$c['cid'],'aid'=>$c['aid'])}')">
                                    编辑
                                </a>
                                <span class="line">|</span>
                                <a href="javascript:;" onclick="del({$c.mid},{$c.cid},{$c.aid})">
                                    删除
                                </a>
                            </td>
                        </tr>
                    </list>
                </table>
                <div class="page1">
                    {$page}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * 删除单一文章
     * @param mid
     * @param cid
     * @param aid
     */
    function del(mid,cid,aid) {
        hd_modal({
            width: 400,//宽度
            height: 200,//高度
            title: '提示',//标题
            content: '确定删除吗',//提示信息
            button: true,//显示按钮
            button_success: "确定",//确定按钮文字
            button_cancel: "关闭",//关闭按钮文字
            timeout: 0,//自动关闭时间 0：不自动关闭
            shade: true,//背景遮罩
            shadeOpacity: 0.1,//背景透明度
            success: function () {//点击确定后的事件
                hd_ajax('{|U:"del"}', {mid:mid,cid:cid,aid: aid}, '__URL__');
            },
            cancel: function () {//点击关闭后的事件

            }
        });
    }
</script>
</body>
</html>