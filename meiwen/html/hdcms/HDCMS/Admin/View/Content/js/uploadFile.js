$(function () {
    $(".imagelist ul li").live('click', function () {
        switch (type) {
            case 'thumb':
                thumb(this);
                break;
            case 'image':
                image(this);
                break;
            case 'images':
                images(this);
                break;
            case 'files':
                files(this);
                break;
        }
    })
})
/**
 * 多文件上传
 * @param obj
 */
function files(obj) {
    //路径
    var path = $(obj).attr('path');
    //图片url
    var url = $(obj).attr('url');
    var box=name+'Box';
    var html='<li style="width:98%">\
        <img src="'+STATIC +'/image/default.png" style="width:50px;height:50px;">&nbsp;&nbsp;\
    地址: <input name="'+name+'[path][]" value="'+path+'" style="width:35%" readonly="" type="text"> &nbsp;&nbsp;\
    描述: <input name="'+name+'[alt][]" style="width:35%;" value="" type="text">\
        &nbsp;&nbsp;\
            <a href="javascript:;" onclick="remove_upload(this)">删除</a>\
        </li>';
    $(parent.document).find('#'+box).find('ul').append(html);
    parent.hd_modal_close();
}

/**
 * 多图上传
 * @param obj
 */
function images(obj) {
    //路径
    var path = $(obj).attr('path');
    //图片url
    var url = $(obj).attr('url');
    var box=name+'Box';
    var html='<li>\
        <div class="img">\
    <img src="'+url+'" style="width:135px;height:135px;vertical-align:middle">\
        <a href="javascript:;" onclick="removeImages(this)">X</a>\
    </div>\
    <input name="'+name+'[path][]" value="'+path+'" class="w400 images" type="hidden">\
    <input name="'+name+'[alt][]" value="" placeholder="图片描述..." type="text">\
    </li>';
    $(parent.document).find('#'+box).find('ul').append(html);
    parent.hd_modal_close();
}
/**
 * 单图上传
 * @param obj
 */
function image(obj) {
    //路径
    var path = $(obj).attr('path');
    //图片url
    var url = $(obj).attr('url');
    //移除所有li样式
    $("li").removeClass('active');
    //当前li添加选中样式
    $(obj).addClass('active');
    //更改父级INPUT表单
    $(parent.document).find('input[name="'+name+'"]').val(path)
    $(parent.document).find('input[name="'+name+'"]').attr('src',path)
    parent.hd_modal_close();
}
/**
 * 缩略图
 * @param obj
 */
function thumb(obj) {
    //路径
    var path = $(obj).attr('path');
    //图片url
    var url = $(obj).attr('url');
    //移除所有li样式
    $("li").removeClass('active');
    //当前li添加选中样式
    $(obj).addClass('active');
    //更改父级INPUT表单
    $(parent.document).find('input[name="'+name+'"]').val(path)
    $(parent.document).find('#thumbImg').attr('src', url);
    parent.hd_modal_close();
}
/**
 * 获取站内文件
 * @param page
 */
function webFile(type, page) {
    $.get(CONTROLLER + '&a=webFile', {type: type, page: page}, function (html) {
        $("#webFile").html(html);
    })
}
$(function () {
    $("#webFilePage a").live('click', function () {
        //页码
        var page = $.trim($(this).html());
        webFile('thumb', page);
        return false;
    })
})
/**
 * 未使用图片
 */
function noUse(type, page) {
    $.get(CONTROLLER + '&a=noUse', {type: type, page: page}, function (html) {
        $("#noUse").html(html);
    })
}
$(function () {
    $("#noUsePage a").live('click', function () {
        //页码
        var page = $.trim($(this).html());
        noUse('thumb', page);
        return false;
    })
})
/**
 * 加载站内图片与委外未使用图片
 */
$(function () {
    webFile(type, 1);
    noUse(type, 1);
})