<include file="__PUBLIC__/header"/>
<body>
<js file="__CONTROLLER_VIEW__/js/js.js"/>
<css file="__CONTROLLER_VIEW__/css/css.css"/>
<script src="__STATIC__/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="__STATIC__/uploadify/uploadify.css">
<div class="hd-menu-list">
    <ul>
        <li><a href="{|U:'index'}">栏目列表</a></li>
        <li class="active"><a href="javascript:;">修改栏目</a></li>
    </ul>
</div>
<form class="hd-form" onsubmit="return hd_submit(this,'{|U:edit}','{|U:'index'}')">
    <input type="hidden" value="{$field.cid}" name="cid"/>

        <div class="hd-tab">
            <ul class="hd-tab-menu">
                <li lab="base" class="active"><a href="#">基本设置</a></li>
                <li lab="tpl"><a href="#">模板设置</a></li>
                <li lab="html"><a href="#">静态HTML设置</a></li>
                <li lab="seo"><a href="#">SEO</a></li>
                <li lab="access"><a href="#">权限设置</a></li>
                <li lab="charge"><a href="#">收费设置</a></li>
            </ul>
            <div class="hd-tab-content">
                <div lab="base" class="hd-tab-area">
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th class="hd-w100">内容模型</th>
                            <td>
                                <select name="mid"  class="hd-w200" <if value="$disabledChangeModel">disabled=""</if>>
                                    <option value=''>模型选择</option>
                                    <list from="$model" name="$m">
                                        <if value="$m.enable">
                                        <option value="{$m.mid}" <if value="$field.mid eq $m.mid">selected=""</if>>
                                            {$m.model_name}
                                        </option>
                                        </if>
                                    </list>
                                </select>
                                <if value="$disabledChangeModel">
                                    <input type="hidden" name="mid" value="{$field.mid}"/>
                                </if>
                            </td>
                        </tr>
                        <tr>
                            <th class="hd-w100">上级</th>
                            <td>
                                <select name="pid">
                                    <option value="0">一级栏目</option>
                                    <list from="$category" name="$c">
                                        <option value="{$c.cid}"
                                        {$c.selected} {$c.disabled}>
                                        {$c._name}
                                        </option>
                                    </list>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>栏目名称</th>
                            <td>
                                <input type="text" name="catname" value="{$field.catname}" class="hd-w300" required=""/>
                            </td>
                        </tr>
                        <tr>
                            <th>栏目类型</th>
                            <td>
                                <label>
                                    <input type="radio" name="cattype" value="1" <if value="$field.cattype==1">checked="checked"</if>/> 普通栏目
                                </label>
                                <label>
                                    <input type="radio" name="cattype" value="2" <if value="$field.cattype==2">checked="checked"</if>/> 频道封面
                                </label>
                                <label>
                                    <input type="radio" name="cattype" value="3" <if value="$field.cattype==3">checked="checked"</if>/> 外部链接(在跳转Url处填写网址)
                                </label>
                                <label><input type="radio" name="cattype" value="4" <if value="$field.cattype==4">checked="checked"</if>/>单页面(直接发布文章，如:公司简介)</label>
                            </td>
                        </tr>
                        <tr>
                            <th>静态目录</th>
                            <td>
                                <input type="text" name="catdir" value="{$field.catdir}" class="hd-w300" required=""/>
                            </td>
                        </tr>
                        <tr>
                            <th>跳转Url</th>
                            <td>
                                <input type="text" name="cat_redirecturl" value="{$field.cat_redirecturl}" class="hd-w300"/>
                            </td>
                        </tr>
                        <tr>
                            <th>栏目图片</th>
                            <td>
                                <input type="text" name="catimage" class="hd-w200" readonly="" value="{$field.catimage}"/>
                                <input id="file" type="file" multiple="true">
                                <img id="catimage" src="__ROOT__/{$field.catimage}" style="<if value='empty($field.catimage)'>display:none;</if>"/>
                                <script type="text/javascript">
                                    $(function() {
                                        $('#file').uploadify({
                                            'formData'     : {//POST数据
                                                '<?php echo session_name();?>' : '<?php echo session_id();?>',
                                            },
                                            'fileTypeDesc' : '栏目图片',//上传描述
                                            'fileTypeExts' : '*.gif; *.jpg; *.png',
                                            'swf'      : '__STATIC__/uploadify/uploadify.swf',
                                            'uploader' : '{|U:"categoryImage"}',
                                            'buttonText':'上传图片',
                                            'fileSizeLimit' : '1000KB',
                                            'uploadLimit' : 100,//上传文件数
                                            'width':80,
                                            'height':30,
                                            'successTimeout':10,//等待服务器响应时间
                                            'removeTimeout' : 0.5,//成功显示时间
                                            'onUploadSuccess' : function(file, data, response) {
                                                data=$.parseJSON(data);
                                                $("[name='catimage']").val(data.path);
                                                $("#catimage").attr('src',data.url).show();

                                            }
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <th>栏目访问</th>
                            <td>
                                <label>
                                    <input type="radio" name="cat_url_type" value="1" <if value="$field.cat_url_type==1">checked="checked"</if>/> 静态
                                </label>
                                <label>
                                    <input type="radio" name="cat_url_type" value="2" <if value="$field.cat_url_type==2">checked="checked"</if>/> 动态
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th>文章访问</th>
                            <td>
                                <label>
                                    <input type="radio" name="arc_url_type" value="1" <if value="$field.arc_url_type==1">checked="checked"</if>/> 静态
                                </label>
                                <label>
                                    <input type="radio" name="arc_url_type" value="2" <if value="$field.arc_url_type==2">checked="checked"</if>/> 动态
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th>在导航显示</th>
                            <td>
                                <label>
                                    <input type="radio" name="cat_show" value="1" <if value="$field.cat_show==1">checked="checked"</if>/> 是
                                </label>
                                <label>
                                    <input type="radio" name="cat_show" value="0" <if value="$field.cat_show==0">checked="checked"</if>/> 否
                                </label>
                                <span class="validate-message">前台使用&lt;channel&gt;标签时是否显示</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div lab="tpl"  class="hd-tab-area">
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th class="hd-w100">封面模板 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="index_tpl" required="" class="hd-w200" id="index_tpl" value="{$field.index_tpl}"/>
                                <button type="button" onclick="selectTemplate('index_tpl');" class="hd-btn hd-btn-xm">选择封面模板</button>
                            </td>
                        </tr>
                        <tr>
                            <th>列表页模板 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="list_tpl" required="" id="list_tpl" class="hd-w200" value="{$field.list_tpl}"/>
                                <button type="button" onclick="selectTemplate('list_tpl');" class="hd-btn hd-btn-xm">选择列表模板</button>
                            </td>
                        </tr>
                        <tr>
                            <th>内容页模板 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="arc_tpl" required="" id="arc_tpl" class="hd-w200" value="{$field.arc_tpl}"/>
                                <button type="button" onclick="selectTemplate('arc_tpl');" class="hd-btn hd-btn-xm">选择内容页模板</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div lab="html"  class="hd-tab-area">
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th class="hd-w100">栏目页URL规则 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="cat_html_url" required="" class="hd-w300" value="{$field.cat_html_url}"/>
                                <span class="hd-validate-notice">{cid} 栏目ID, {catdir} 栏目目录, {page} 列表的页码</span>
                            </td>
                        </tr>
                        <tr>
                            <th>内容页URL规则 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="arc_html_url" required="" class="hd-w300" value="{$field.arc_html_url}"/>
                                <span class="hd-validate-notice">{y}、{m}、{d} 年月日,{timestamp}UNIX时间戳 {catdir}栏目目录 {cid}栏目cid {aid}文章ID</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div lab="seo" class="hd-tab-area">
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th>关键字</th>
                            <td>
                                <input type="text" name="cat_keyworks" value="{$field.cat_keyworks}" class="hd-w300"/>
                            </td>
                        </tr>
                        <tr>
                            <th>描述</th>
                            <td>
                                <textarea name="cat_description" class="hd-w350 hd-h60">{$field.cat_description}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th class="hd-w100">SEO标题</th>
                            <td>
                                <input type="text" name="cat_seo_title" value="{$field.cat_seo_title}" class="hd-w300"/>
                            </td>
                        </tr>
                        <tr>
                            <th>SEO描述</th>
                            <td>
                                <textarea name="cat_seo_description" class="hd-w350 hd-h60">{$field.cat_seo_description}</textarea>
                            </td>
                        </tr>
                    </table>
                </div>

                <div lab="access" class="hd-tab-area">
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th class="hd-w100">
                                投稿不需要审核
                            </th>
                            <td>
                                <label><input type="radio" name="member_send_status" value="1" <if value="$field.member_send_status eq 1">checked=""</if>/> 是 </label>
                                <label><input type="radio" name="member_send_status" value="0" <if value="$field.member_send_status eq 0">checked=""</if>/> 否 </label>
                            </td>
                        </tr>
                    </table>
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th class="hd-w100">
                                管理组权限
                            </th>
                            <td>
                                <table class="hd-table hd-table-form">
                                    <thead>
                                    <tr>
                                        <td class="hd-w250">组名</td>
                                        <td><a href="javascript:" onclick="select_access_col_checkbox(this)">查看</a></td>
                                        <td><a href="javascript:" onclick="select_access_col_checkbox(this)">添加</a></td>
                                        <td><a href="javascript:" onclick="select_access_col_checkbox(this)">修改</a></td>
                                        <td><a href="javascript:" onclick="select_access_col_checkbox(this)">删除</a></td>
                                        <td><a href="javascript:" onclick="select_access_col_checkbox(this)">排序</a></td>
                                        <td><a href="javascript:" onclick="select_access_col_checkbox(this)">移动</a></td>
                                        <td><a href="javascript:" onclick="select_access_col_checkbox(this)">审核</a></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <list from="$access.admin" name="$r">
                                        <tr>
                                            <td>
                                                <a href="javascript:" onclick="select_access_checkbox(this)">{$r.rname}</a>
                                                <input type="hidden" name="access[{$r.rid}][rid]" value="{$r.rid}"/>
                                                <input type="hidden" name="access[{$r.rid}][admin]" value="1"/>
                                            </td>
                                            <td><input type="checkbox" name="access[{$r.rid}][content]" value="1" <if value="$r.content">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][add]" value="1" <if value="$r.add">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][edit]" value="1" <if value="$r.edit">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][del]" value="1" <if value="$r.del">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][order]" value="1" <if value="$r.order">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][move]" value="1" <if value="$r.move">checked=""</if>/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][audit]" value="1" <if value="$r.audit">checked=""</if>/></td>
                                        </tr>
                                    </list>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th class="hd-w100">
                                会员组权限
                            </th>
                            <td>
                                <table class="hd-table hd-table-form">
                                    <thead>
                                    <tr>
	                                    <td class="hd-w250">组名</td>
	                                    <td><a href="javascript:" onclick="select_access_col_checkbox(this)">查看</a></td>
	                                    <td><a href="javascript:" onclick="select_access_col_checkbox(this)">投稿</a></td>
	                                    <td><a href="javascript:" onclick="select_access_col_checkbox(this)">修改</a></td>
	                                    <td><a href="javascript:" onclick="select_access_col_checkbox(this)">删除</a></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <list from="$access.user" name="$r">
                                        <tr>
                                            <td>
                                                <a href="javascript:" onclick="select_access_checkbox(this)">{$r.rname}</a>
                                                <input type="hidden" name="access[{$r.rid}][rid]" value="{$r.rid}"/>
                                                <input type="hidden" name="access[{$r.rid}][admin]" value="0"/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][content]" value="1" <if value="$r.content">checked=""</if>/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][add]" value="1" <if value="$r.add">checked=""</if>/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][edit]" value="1" <if value="$r.edit">checked=""</if>/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][del]" value="1" <if value="$r.del">checked=""</if>/>
                                            </td>
                                        </tr>
                                    </list>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>应用到子栏目</th>
                            <td>
                                <label><input type="radio" name="priv_child" value="1" <if value="$field.priv_child eq 1">checked=""</if>/>是 </label>
                                <label><input type="radio" name="priv_child" value="0" <if value="$field.priv_child eq 0">checked=""</if>/>否 </label>
                            </td>
                        </tr>
                    </table>
                </div>

                <div lab="charge" class="hd-tab-area">
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th class="hd-w100">阅读金币</th>
                            <td>
                                <input type="text" name="show_credits" required="" class="hd-w100" value="{$field.show_credits}"/> 金币
                                <span id="hd_show_credits"></span>
                            </td>
                        </tr>
                        <tr>
                            <th class="hd-w100">重复收费设置</th>
                            <td>
                                <input type="text" name="repeat_charge_day" required="" class="hd-w100" value="{$field.repeat_charge_day}"/> 天
                                <span id='hd_repeat_charge_day'>

                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <input type="submit" class="hd-btn" value="确定"/>
</form>
<script>

    //获得静态目录(将目录名转为拼音)
        $("[name='catname']").blur(function () {
            //栏目类型不为外部链接时获取
            if ($("[name='cattype']:checked").val() != 3) {
                //栏目名
                $catname = $.trim($("[name='catname']").val())
                //静态目录名
                $catdir = $.trim($("[name='catdir']").val());
                //静态目录名为空时获得
                if (!$catdir && $catname) {
                    var pid = $("[name=pid]").val();
                    $.post(CONTROLLER + "&a=dir_to_pinyin&pid=" + pid, {catname: $(this).val()}, function (data) {
                        $("[name='catdir']").val(data);
                    })
                }
            }
        })


</script>
</body>
</html>