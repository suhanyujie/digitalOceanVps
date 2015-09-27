//更改模型后
$(function () {
    $("#mid").change(function () {
        var mid = $(this).val();
        var html = "<option selected='selected' value='0'>不限栏目</option>";
        var attr='';
        for (var i in category) {
        	if(category[i].cattype!=1 && category[i].cattype!=2){
        		continue;
        	}
            if (category[i].mid != mid) {
                continue;
            }
            html += "<option value='" + category[i].cid + "' >" + category[i]._name + "</option>";
        }
        $("#cid").html(html);
    })
    $("#mid").trigger("change");
})