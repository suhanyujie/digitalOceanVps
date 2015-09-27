
/**
 * 选择模板
 * @param id 表单id
 */
function selectTemplate(id) {
    hd_modal({
        width: 650,//宽度
        height: 500,//高度
        title: '选择模板文件',//标题
        content: '<iframe style="height:420px" src="'+CONTROLLER+'&a=selectTemplate&id='+id+'"></iframe>',//提示信息
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


/**
 * 权限全选复选框(水平选择权限）
 * @param type
 */
function select_access_checkbox(obj) {
    $(obj).parents('tr').eq(0).find('input').attr('checked', function () {
        return !$(this).attr('checked');
    });
}
/**
 * 权限标题点击(垂直选择权限）
 * @param obj
 */
function select_access_col_checkbox(obj) {
    var index = $(obj).parent().index();
    $(obj).parents('table').eq(0).find('tbody tr').each(function (i) {
        $(this).find("td:eq(" + index + ")").find('input').attr('checked', function(){
            return !$(this).attr('checked');
        });
    })
}