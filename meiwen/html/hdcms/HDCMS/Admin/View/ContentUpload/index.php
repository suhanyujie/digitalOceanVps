<include file="__PUBLIC__/header.php"/>
<body>
<div class="wrap">
    <div class="tab">
        <ul class="tab_menu">
            <li lab="upload"><a href="#">上传文件</a></li>
            <li lab="site"><a href="#">站内文件</a></li>
            <li lab="untreated"><a href="#">未使用文件</a></li>
        </ul>
        <div class="tab_content">
            <div id="upload" style="padding: 5px;">
                {$upload}
            </div>
            <div id="site" class="pic_list">
                <div class="site_pic">
                    <ul>
                        <list from="$site_data" name="f">
                            <li class="upload_thumb">
                                <img src="<if value='$f.image eq 1'>__ROOT__/{$f.path}<else>__HDPHP_EXTEND__/Org/Uploadify/default.png</if>" path="{$f.path}"/>
                                <input style="padding:3px 0px;width:84px" type="text" name="hdcms[][alt]"
                                       value="{$f.name}" onblur="if(this.value=='')this.value='{$f.name}'"
                                       onfocus="this.value=''">
                                <input type="hidden" name="table_id" value="{$f.id}"/>
                            </li>
                        </list>
                    </ul>
                </div>
                <div class="page1">
                    {$site_page}
                </div>
            </div>
            <div id="untreated" class="pic_list">
                <div class="site_pic">
                    <ul>
                        <list from="$untreated_data" name="f">
                            <li class="upload_thumb">
                                <img src="<if value='$f.image eq 1'>__ROOT__/{$f.path}<else>__HDPHP_EXTEND__/Org/Uploadify/default.png</if>" path="{$f.path}"/>
                                <input style="padding:3px 0px;width:84px" type="text" name="hdcms[][alt]"
                                       value="{$f.name}" onblur="if(this.value=='')this.value='{$f.name}'"
                                       onfocus="this.value=''">
                                <input type="hidden" name="table_id" value="{$f.id}"/>
                            </li>
                        </list>
                    </ul>
                </div>
                <div class="page1">
                    {$untreated_page}
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="position-bottom" style="position: fixed;bottom:0px;">
        <input type="button" class="hd-success" id="pic_selected" value="确定"/>
        <input type="button" class="hd-cancel" value="关闭" onclick="close_window();"/>
    </div>
</body>
<style type="text/css">
    body {
        background: #fff;
    }
    div.wrap {
        background: #fff;
        overflow: hidden;
    }

    div.uploadify_upload_files {
        padding: 10px;
        border: solid 1px #ccc;
        margin-top: 10px;
        height: 225px;
    }

    li.upload_thumb img {
        width: 90px;
        height: 78px;
    }

    /*图片列表*/
    div.site_pic {
        height: auto;
        padding: 10px 0px;
        overflow: hidden;
    }

    div.site_pic ul li.upload_thumb {
        border: 2px solid #dcdcdc;
        float: left;
        margin: 2px 5px;
        overflow: hidden;
        position: relative;
        width: 90px;
        overflow: hidden;
    }
    img {
        cursor: pointer !important;
    }

    input[type=text] {
        border: none;
        width: 90px;
    }

    input:focus {
        border: none !important;
        outline: 0px solid #51B4FF;
        color: #666;
    }
</style>
<script>
    {$get}
    //----------获得站内图片与未使用图片-----------------
    //点击分页时获取数据
    $('div.page1 a').live('click', function () {
        var _url = $(this).attr('href');
        var _div = $(this).parents('.pic_list').eq(0);
        $.get(_url, function (data) {
            _div.html(data);
        })
        return false;
    })
    //----------获得站内图片与未使用图片-----------------
    //选中图片操作
    $("img").live("click", function () {
        if ($(this).attr("selected") == "selected") {
            //反选（原来选中的图片取沙选中)
            $(this).parents('li').eq(0).css({"border": "2px solid #dcdcdc"}).find("img").removeAttr("selected");
        } else if ($("img[selected='selected']").length >= num) {
            //判断选中数量
            alert("只能选择" + num + "个文件。请取消已经选择的文件后再选择");
        } else {
            //成功选中
            $(this).parent().css({"border": "2px solid #E93614"}).find("img").attr("selected", "selected");
        }
    })
    /**
     * 文本框失去焦点时改变upload表中的name值 (上传文件描述）
     * 就是改变图片的alt值
     */

    $("input").live('blur', function () {
        var obj = $(this);
        var id = $(this).parents('li').eq(0).find('input[name=table_id]').val();
        var name = $(this).val();
        //异步修改表单值
        $.post(CONTROL + '&m=update_file_name', {id: id, name: name}, function () {
        });
    })
    //点击确定
    $("#pic_selected").click(function () {
        switch (type) {
            case "thumb":
                //父级IMG标签
                var _p_obj = $(parent.document).find("#" + id);
                //父级input表单
                var _input_obj = $(parent.document).find("[name=" + id + "]");
                //选中的图片
                var _img = $("img[selected='selected']").eq(0);
                //更改父级img标签src值
                _p_obj.attr("src", _img.attr("src"));
                //更改父级input值
                _input_obj.val(_img.attr("path"));
                break;
            //单图
            case "image":
                var _input_obj = $(parent.document).find("#" + id);
                var _img = $("img[selected='selected']").eq(0);
                _input_obj.val(_img.attr("path"));
                _input_obj.attr("src", _img.attr("src"));
                break;
            case "images":
                var img_div = $(parent.document).find("#" + id);
                //所有选中的图片
                var _img = $("img[selected='selected']");
                var _ul = "<ul>";
                $(_img).each(function (i) {
                    _ul += "<li>";
                    _ul += "<div class='img'><img src='" + ROOT + "/" + $(_img[i]).attr("path") + "'/>";
                    _ul += "<a href='javascript:;' onclick='remove_upload(this,\"" + id + "\")'>X</a>";
                    _ul += "</div>";
                    _ul += "<input type='hidden' name='" + name + "[path][]'  value='" + $(_img[i]).attr("path") + "' src='" + $(_img[i]).attr("src") + "' class='w400 images'/> ";
                    _ul += "<input type='text' name='" + name + "[alt][]' style='width:135px;' value=''/>";
                    _ul += "</li>";
                })
                _ul = _ul + "</ul>";
                img_div.append(_ul);
                //父窗口中记录数量的span标签
                var _num_span = $(parent.document).find('#hd_up_' + id);
                //更改数量
                _num_span.text(_num_span.text() * 1 - _img.length);
                break;
            case "files":
                var img_div = $(parent.document).find("#" + id);
                //所有选中的图片
                var _img = $("img[selected='selected']");
                var _ul = "<ul>";
                $(_img).each(function (i) {
                    _ul += "<li style='width:98%'>";
                    _ul += "<img src='" + HDPHPEXTEND + "/Org/Uploadify/default.png' style='width:50px;height:50px;'/>";
                    _ul += "&nbsp;&nbsp;地址: <input type='text' name='" + name + "[path][]'  value='" + $(_img[i]).attr("path") + "' style='width:35%' readonly=''/> ";
                    _ul += "&nbsp;&nbsp;描述: <input type='text' name='" + name + "[alt][]' style='width:35%;' value=''/>";
                    _ul += "&nbsp;&nbsp;<a href='javascript:;' onclick='remove_upload(this,\"" + id + "\")'>删除</a>";
                    _ul += "</li>";
                })
                _ul = _ul + "</ul>";
                img_div.append(_ul);
                //父窗口中记录数量的span标签
                var _num_span = $(parent.document).find('#hd_up_' + id);
                //更改数量
                _num_span.text(_num_span.text() * 1 - _img.length);
                break;
        }
        close_window();
    })
    //uploadify上传完图片后自动选中
    function hd_upload(file, data, response) {
        $("#upload img:last").trigger('click');
    }
    //关闭
    function close_window() {
        $(parent.document).find("[class*=modal]").remove();
    }
</script>
</html>