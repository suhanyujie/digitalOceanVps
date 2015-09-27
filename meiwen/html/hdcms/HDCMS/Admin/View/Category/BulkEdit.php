<include file="__PUBLIC__/header"/>
<body>
<js file="__CONTROLLER_VIEW__/js/js.js"/>
<div class="hd-menu-list">
    <ul>
        <li>
            <a href="{|U:'Category/index'}">
                栏目列表
            </a>
        </li>
        <li class="active">
            <a href="javascript:;">
                批量修改栏目
            </a>
        </li>
    </ul>
</div>
<div class="hd-title-header">温馨提示</div>
<div class="help">
    <ul>
        <li>双击单选框，可以选中所有同类型</li>
    </ul>
</div>
<div class="hd-title-header">批量编辑栏目</div>
<form class="hd-form" onsubmit="return hd_submit(this,'__URL__','{|U:'index'}');">
<input type="hidden" name="BulkEdit" value="1"/>
<div class="category">
            <table class="hd-table hd-table-form">
                <tr>
                    <list from="$data" name='$field'>
                        <td>
                            <table class="table1 category" style="width:100%;">
                                <tr>
                                    <th>栏目名称</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" name="cat[{$field.cid}][cid]" value="{$field.cid}"/>
                                        <input type="text" name="cat[{$field.cid}][catname]" value="{$field.catname}"
                                               class="hd-w250"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>静态目录</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="cat[{$field.cid}][catdir]" value="{$field.catdir}"
                                               class="hd-w250"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>栏目访问</th>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            <input type="radio" name="cat[{$field.cid}][cat_url_type]" value="1"
                                            <if value="$field.cat_url_type==1">checked="checked"</if>
                                            /> 静态
                                        </label>
                                        <label>
                                            <input type="radio" name="cat[{$field.cid}][cat_url_type]" value="2"
                                            <if value="$field.cat_url_type==2">checked="checked"</if>
                                            /> 动态
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>文章访问</th>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            <input type="radio" name="cat[{$field.cid}][arc_url_type]" value="1"
                                            <if value="$field.arc_url_type==1">checked="checked"</if>
                                            /> 静态
                                        </label>
                                        <label>
                                            <input type="radio" name="cat[{$field.cid}][arc_url_type]" value="2"
                                            <if value="$field.arc_url_type==2">checked="checked"</if>
                                            /> 动态
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>在导航显示</th>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            <input type="radio" name="cat[{$field.cid}][cat_show]" value="1"
                                            <if value="$field.cat_show==1">checked="checked"</if>
                                            /> 是
                                        </label>
                                        <label>
                                            <input type="radio" name="cat[{$field.cid}][cat_show]" value="0"
                                            <if value="$field.cat_show==0">checked="checked"</if>
                                            /> 否
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th>投稿不需要审核</th>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            <input type="radio" name="cat[{$field.cid}][member_send_status]" value="1"
                                            <if value="$field.member_send_status==1">checked="checked"</if>
                                            /> 是
                                        </label>
                                        <label>
                                            <input type="radio" name="cat[{$field.cid}][member_send_status]" value="0"
                                            <if value="$field.member_send_status==0">checked="checked"</if>
                                            /> 否
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="hd-w100">封面模板</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="index_tpl" required="" class="hd-w200" id="index_tpl_{$field.cid}" value="{$field.index_tpl}"/>
                                        <button type="button" onclick="selectTemplate('index_tpl_{$field.cid}');" class="hd-btn hd-btn-xm">选择封面模板</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="hd-w100">列表页模板</th
                                </tr>
                                <tr>

                                    <td>
                                        <input type="text" name="list_tpl" required="" id="list_tpl_{$field.cid}" class="hd-w200" value="{$field.list_tpl}"/>
                                        <button type="button" onclick="selectTemplate('list_tpl_{$field.cid}');" class="hd-btn hd-btn-xm">选择列表模板</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>内容页模板</th>
                                </tr>
                                <tr>

                                    <td>
                                        <input type="text" name="arc_tpl" required="" id="arc_tpl_{$field.cid}" class="hd-w200" value="{$field.arc_tpl}"/>
                                        <button type="button" onclick="selectTemplate('arc_tpl_{$field.cid}');" class="hd-btn hd-btn-xm">选择内容页模板</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="hd-w100">栏目页URL规则</th>
                                </tr>
                                <tr>

                                    <td>
                                        <input type="text" name="cat[{$field.cid}][cat_html_url]" required=""
                                               class="hd-w250" value="{$field.cat_html_url}"/>
                                        <span id="hd_cat_html_url"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>内容页URL规则</th>
                                </tr>
                                <tr>

                                    <td>
                                        <input type="text" name="cat[{$field.cid}][arc_html_url]" required=""
                                               class="hd-w250" value="{$field.arc_html_url}"/>
                                        <span id="hd_arc_html_url"></span>
                                    </td>
                                </tr>


                                <tr>
                                    <th>关键字</th>
                                </tr>
                                <tr>

                                    <td>
                                        <input type="text" name="cat[{$field.cid}][cat_keyworks]"
                                               value="{$field.cat_keyworks}" class="hd-w250"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>描述</th>
                                </tr>
                                <tr>

                                    <td>
                                        <textarea name="cat[{$field.cid}][cat_description]" class="hd-w250 h100">{$field.cat_description}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="hd-w100">SEO标题</th>
                                </tr>
                                <tr>

                                    <td>
                                        <input type="text" name="cat[{$field.cid}][cat_seo_title]"
                                               value="{$field.cat_seo_title}" class="hd-w250"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>SEO描述</th>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea name="cat[{$field.cid}][cat_seo_description]" class="hd-w250 hd-h150">{$field.cat_seo_description}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </list>
                </tr>
            </table>
        </div>
        <input type="submit" class="hd-btn hd-btn-sm" value="确定"/>
        <button type="button" class="hd-btn hd-btn-sm" onclick="setTemplate('index_tpl')">批量设置封面模板</button>
        <button type="button" class="hd-btn hd-btn-sm" onclick="setTemplate('list_tpl')">批量设置列表页模板</button>
        <button type="button" class="hd-btn hd-btn-sm" onclick="setTemplate('arc_tpl')">批量设置内容页模板</button>
</form>
<style type="text/css">
    table th,table td {
        text-align: left !important;
        border-right: 1px solid #dcdcdc;
    }
</style>
<script type="text/javascript" charset="utf-8">
    //批量设置模板
    function setTemplate(name){
        var template= $('[name*='+name+']:eq(0)').val();
        $('[name*='+name+']').each(function(i){
            $(this).val(template);
        })
    }

    $(function () {
        /**
         * 批量选中单选框
         */
        $('input[type=radio]').dblclick(function (e) {
            var tr_index = $($(this).parents('tr')).index();
            var label_index = $($(this).parent()).index();
            $("table.category").each(function () {
                $(this).find('tr').eq(tr_index).find('label').eq(label_index).find('input').attr('checked', 'checked');
            })
        })
    })

</script>
</body>
</html>