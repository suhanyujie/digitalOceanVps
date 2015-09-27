$(function () {
    /**
     * 提交表单
     */
    $('form').submit(function () {
        var obj =this;
        if (!$(this).data('isPost')) {
            $(this).data('isPost', 1);
            $.post(ACTION, $(this).serialize(), function (json) {
                if (json.status) {
                    hd_alert({
                        message: json.message,//显示内容
                        timeout: 1,//显示时间
                        success: function () {//这是回调函数
                            window.opener.location.reload(true);
                            window.close();
                        }
                    })
                } else {
                    hd_alert({
                        message: json.message,//显示内容
                        timeout: 1
                    })
                    $(obj).removeData('isPost');
                }
            }, 'json');
        }
        return false;
    })
})
/**
 * 预览上传图片
 * @param obj
 */
function viewImage(obj) {
    var src = $(obj).attr('src');
    var id = 'viewImage';
    var viewImg = $('#viewImage');
    //删除预览图
    if (viewImg.length >= 1) {
        viewImg.remove();
    }
    //鼠标移除时删除预览图
    $(obj).mouseout(function () {
        $('#viewImage').remove();
    })
    if (src) {
        var offset = $(obj).offset();
        var _left = 320 + offset.left + "px";
        var _top = offset.top - 75 + "px";
        var html = '<img src="' + src + '" style="border:solid 5px #dcdcdc;position:absolute;z-index:1000;height:150px;left:' + _left + ';top:' + _top + ';" id="viewImage"/>';
        $('body').append(html);
    }
}
/**
 * 多文件上传
 * @param mid 模型id
 * @param name 表单name
 * @param num 上传数量
 */
function filesUpload(mid, name, num) {
    var id = name + 'Box';
    //已经上传数量
    var imageLen = $("#" + id).find('li').length;
    if (imageLen >= num) {
        hd_alert({
            message: '最多只能上传' + num + '张图',//显示内容
            timeout: 3//显示时间
        })
    } else {
        var url = CONTROLLER + '&a=uploadFile&mid=' + mid + '&type=files&name=' + name;
        hd_modal({
            width: 650,//宽度
            height: 450,//高度
            title: '上传文件',//标题
            content: '<iframe src="' + url + '" style="height:360px;"></iframe>',//提示信息
            button: false,//显示按钮
            button_success: "确定",//确定按钮文字
            button_cancel: "关闭",//关闭按钮文字
            timeout: 0,//自动关闭时间 0：不自动关闭
            shade: true,//背景遮罩
            shadeOpacity: 0.1//背景透明度
        });
    }
}
/**
 * 上传多图
 * @param mid 模型id
 * @param name 表单name
 * @param num 上传数量
 */
function imagesUpload(mid, name, num) {
    var id = name + 'Box';
    //已经上传数量
    var imageLen = $("#" + id).find('li').length;
    if (imageLen >= num) {
        hd_alert({
            message: '最多只能上传' + num + '张图',//显示内容
            timeout: 3//显示时间
        })
    } else {
        var url = CONTROLLER + '&a=uploadFile&mid=' + mid + '&type=images&name=' + name;
        hd_modal({
            width: 650,//宽度
            height: 450,//高度
            title: '上传缩略图',//标题
            content: '<iframe src="' + url + '" style="height:360px;"></iframe>',//提示信息
            button: false,//显示按钮
            button_success: "确定",//确定按钮文字
            button_cancel: "关闭",//关闭按钮文字
            timeout: 0,//自动关闭时间 0：不自动关闭
            shade: true,//背景遮罩
            shadeOpacity: 0.1//背景透明度
        });
    }
}
/**
 * 移除多图文件
 * @param obj
 */
function removeFiles(obj) {
    $(obj).parents('li').remove();
}
/**
 * 移除多图文件
 * @param obj
 */
function removeImages(obj) {
    $(obj).parents('li').remove();
}
/**
 * 移除单图
 */
function removeImage() {
    $("#thumbImg").attr('src', 'Static/image/upload_pic.png');
    $("input[name='thumb']").val('');
}
/**
 * 上传单图
 * @param id
 */
function imageOne(mid, name) {
    var url = CONTROLLER + '&a=uploadFile&mid=' + mid + '&type=image&name=' + name;
    hd_modal({
        width: 650,//宽度
        height: 450,//高度
        title: '上传缩略图',//标题
        content: '<iframe src="' + url + '" style="height:360px;"></iframe>',//提示信息
        button: false,//显示按钮
        button_success: "确定",//确定按钮文字
        button_cancel: "关闭",//关闭按钮文字
        timeout: 0,//自动关闭时间 0：不自动关闭
        shade: true,//背景遮罩
        shadeOpacity: 0.1//背景透明度
    });
}

/**
 * 移除缩略图
 */
function removeThumb() {
    $("#thumbImg").attr('src', 'Static/image/upload_pic.png');
    $("input[name='thumb']").val('');
}
/**
 * 上传文件
 * @param id
 */
function UploadThumb(mid, name) {
    var url = CONTROLLER + '&a=uploadFile&mid=' + mid + '&type=thumb&name=' + name;
    hd_modal({
        width: 650,//宽度
        height: 450,//高度
        title: '上传缩略图',//标题
        content: '<iframe src="' + url + '" style="height:360px;"></iframe>',//提示信息
        button: false,//显示按钮
        button_success: "确定",//确定按钮文字
        button_cancel: "关闭",//关闭按钮文字
        timeout: 0,//自动关闭时间 0：不自动关闭
        shade: true,//背景遮罩
        shadeOpacity: 0.1//背景透明度
    });
}
/**
 * 选择颜色
 * @param obj 颜色选择对象，按钮对象
 * @param _input 颜色name=color表单
 */
function selectColor(obj, _input) {
    if ($("div.colors").length == 0) {
        var _div = "<div class='colors' style='width:80px;height:160px;position: absolute;z-index:999;'>";
        //颜色块
        var colors = ["#f00f00", "#272964", "#4C4952", "#74C0C0", "#3B111B", "#147ABC", "#666B7F", "#A95026", "#7F8150", "#F09A21", "#7587AD", "#231012", "#DE745C", "#ED2F8D", "#B57E3E", "#002D7E", "#F27F00", "#B74589"];
        for (var i = 0; i < 16; i++) {
            _div += "<div color='" + colors[i] + "' style='background:" + colors[i] + ";width:20px;height:20px;float:left;cursor:pointer;'></div>"
        }
        _div += "</div>";
        $("body").append(_div);
        $(".colors").css({
            top: $(obj).offset().top + 30,
            left: $(obj).offset().left
        });
    }
    $("div.colors").show();
    $("div.colors div").click(function () {
        $("div.colors").hide();
        var _c = $(this).attr("color");
        $("[name='" + _input + "']").val(_c);
        $("[name='title']").css({
            color: _c
        });
    })
}

/**
 * 标题颜色
 */
function update_title_color() {
    var title = $("[name='title']").css({
        "color": $("[name='color']").val()
    });
}

/**
 * 编辑文章时更改标题颜色
 */
$(function () {
    //更改颜色文本框时
    $("[name='color']").blur(function () {
        update_title_color();
    })
    update_title_color();
})


/**
 * 选择模板
 * @param id 表单id
 */
function selectTemplate(id) {
    hd_modal({
        width: 650,//宽度
        height: 500,//高度
        title: '选择模板文件',//标题
        content: '<iframe style="height:420px" src="' + CONTROLLER + '&a=selectTemplate&id=' + id + '"></iframe>',//提示信息
        button: false,//显示按钮
        //button_success: "确定",//确定按钮文字
        button_cancel: "关闭",//关闭按钮文字
        timeout: 0,//自动关闭时间 0：不自动关闭
        shade: true,//背景遮罩
        shadeOpacity: 0.1,//背景透明度
        success: function () {//点击确定后的事件

        },
        cancel: function () {//点击关闭后的事件

        }
    });
}