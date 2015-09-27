<include file="__PUBLIC__/header"/>
<body>
<js file="__CONTROLLER_VIEW__/js/js.js"/>
<css file="__CONTROLLER_VIEW__/css/css.css"/>
<script src="__STATIC__/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="__STATIC__/uploadify/uploadify.css">
    <form onsubmit="return hd_submit(this,'{|U:add}','{|U:'index'}');" class="hd-form">
        <div class="hd-menu-list">
            <ul>
                <li><a href="{|U:'index'}">栏目列表</a></li>
                <li class="active"><a href="javascript:;">添加栏目</a></li>
            </ul>
        </div>
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
                            <th class="hd-w120">内容模型 <span class="star">*</span></th>
                            <td>
                                <select name="mid" class="hd-w200">
                                    <option value=''>模型选择</option>
                                    <list from="$model" name="$m">
                                        <if value="$m.enable">
                                        <option value="{$m.mid}">
                                            {$m.model_name}
                                        </option>
                                        </if>
                                    </list>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>上级 <span class="star">*</span></th>
                            <td>
                                <select name="pid" class="hd-w200">
                                    <option value="0">一级栏目</option>
                                    <list from="$category" name="$c">
                                        <option value="{$c.cid}"
                                        <if value="$hd.get.pid==$c.cid">selected='selected'</if>
                                        >{$c._name}</option>
                                    </list>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>栏目名称 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="catname" required="" class="hd-w300"/>
                            </td>
                        </tr>
                        <tr>
                            <th>栏目类型</th>
                            <td>
                                <label><input type="radio" name="cattype" checked="checked" value="1"/> 普通栏目</label>
                                <label><input type="radio" name="cattype" value="2"/> 频道封面</label>
                                <label><input type="radio" name="cattype" value="3"/> 外部链接(在跳转Url处填写网址)

                                </label>
                                <label><input type="radio" name="cattype" value="4"/> 单页面(直接发布文章，如:公司简介)</label>
                            </td>
                        </tr>
                        <tr>
                            <th>静态目录 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="catdir" required="" class="hd-w300"/>
                            </td>
                        </tr>
                        <tr>
                            <th>跳转Url</th>
                            <td>
                                <input type="text" name="cat_redirecturl" class="hd-w300"/>
                                <span class="hd-validate-notice">栏目类型选择为“外部链接”才有效</span>
                            </td>
                        </tr>
                        <tr>
                            <th>栏目图片</th>
                            <td>
                                <input type="text" name="catimage" class="hd-w200" readonly=""/>
                                <input id="file" type="file" multiple="true">
                                <img id="catimage" style="display: none;"/>
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
                                            'width':65,
                                            'height':25,
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
                                <label><input type="radio" name="cat_url_type" value="1"/> 静态</label>
                                <label><input type="radio" name="cat_url_type" value="2" checked="checked"/> 动态</label>
                            </td>
                        </tr>
                        <tr>
                            <th>文章访问</th>
                            <td>
                                <label><input type="radio" name="arc_url_type" value="1"/> 静态</label>
                                <label><input type="radio" name="arc_url_type" value="2" checked="checked"/> 动态</label>
                            </td>
                        </tr>
                        <tr>
                            <th>在导航显示</th>
                            <td>
                                <label><input type="radio" name="cat_show" value="1" checked="checked"/> 是</label>
                                <label><input type="radio" name="cat_show" value="0"/> 否</label>
                                <span class="hd-validate-notice">前台使用&lt;channel&gt;标签时是否显示</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div lab="tpl" class="hd-tab-area">
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th class="hd-w120">封面模板 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="index_tpl" required="" class="hd-w200" id="index_tpl" value="article_index.html"/>
                                <button type="button" onclick="selectTemplate('index_tpl');" class="hd-btn hd-btn-xm">选择封面模板</button>
                            </td>
                        </tr>
                        <tr>
                            <th>列表页模板 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="list_tpl" required="" id="list_tpl" class="hd-w200" value="article_list.html"/>
                                <button type="button" onclick="selectTemplate('list_tpl');" class="hd-btn hd-btn-xm">选择列表模板</button>
                            </td>
                        </tr>
                        <tr>
                            <th>内容页模板 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="arc_tpl" required="" id="arc_tpl" class="hd-w200" value="article_default.html"/>
                                <button type="button" onclick="selectTemplate('arc_tpl');" class="hd-btn hd-btn-xm">选择内容页模板</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div lab="html" class="hd-tab-area">
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th class="hd-w120">栏目页URL规则 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="cat_html_url" required="" class="hd-w200" value="{catdir}/{page}.html"/>
                                <span class="hd-validate-notice">{cid} 栏目ID, {catdir} 栏目目录, {page} 列表的页码</span>
                            </td>
                        </tr>
                        <tr>
                            <th>内容页URL规则 <span class="star">*</span></th>
                            <td>
                                <input type="text" name="arc_html_url" required="" class="hd-w200" value="{catdir}/{y}/{m}{d}/{aid}.html"/>
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
                                <input type="text" name="cat_keyworks" class="hd-w400"/>
                            </td>
                        </tr>
                        <tr>
                            <th>描述</th>
                            <td>
                                <textarea name="cat_description" class="hd-w400 h100"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th class="hd-w120">SEO标题</th>
                            <td>
                                <input type="text" name="cat_seo_title" class="hd-w400"/>
                            </td>
                        </tr>
                        <tr>
                            <th>SEO描述</th>
                            <td>
                                <textarea name="cat_seo_description" class="hd-w400 h150"></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
                <div lab="access" class="hd-tab-area">
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th class="hd-w120">
                                投稿不需要审核
                            </th>
                            <td>
                                <label><input type="radio" name="member_send_status" value="1" checked=""/> 是 </label>
                                <label><input type="radio" name="member_send_status" value="0"/> 否 </label>
                            </td>
                        </tr>
                    </table>
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th class="hd-w120">
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
                                    <list from="$roleData.admin" name="$r">
                                        <tr>
                                            <td>
                                                <a href="javascript:" onclick="select_access_checkbox(this)">{$r.rname}</a>
                                                <input type="hidden" name="access[{$r.rid}][rid]" value="{$r.rid}"/>
                                                <input type="hidden" name="access[{$r.rid}][admin]" value="1"/>
                                            </td>
                                            <td><input type="checkbox" name="access[{$r.rid}][content]" value="1"/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][add]" value="1"/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][edit]" value="1"/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][del]" value="1"/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][order]" value="1"/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][move]" value="1"/></td>
                                            <td><input type="checkbox" name="access[{$r.rid}][audit]" value="1"/></td>
                                        </tr>
                                    </list>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th class="hd-w120">
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
                                    <list from="$roleData.user" name="$r">
                                        <tr>
                                            <td>
                                                <a href="javascript:" onclick="select_access_checkbox(this)">{$r.rname}</a>
                                                <input type="hidden" name="access[{$r.rid}][rid]" value="{$r.rid}"/>
                                                <input type="hidden" name="access[{$r.rid}][admin]" value="0"/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][content]" value="1"/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][add]" value="1"/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][edit]" value="1"/>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="access[{$r.rid}][del]" value="1"/>
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
                                <label><input type="radio" name="priv_child" value="1"/> 是 </label>
                                <label><input type="radio" name="priv_child" value="0" checked=""/> 否 </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div lab="charge" class="hd-tab-area">
                    <table class="hd-table hd-table-form">
                        <tr>
                            <th class="hd-w120">阅读金币</th>
                            <td>
                                <input type="text" name="show_credits" required="" class="hd-w120" value="0"/> 金币
                                <span class="hd-validate-notice">当这里设置为0时，发布页设置了，可只对设置的文章收费，生成静态时收费无效</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="hd-w120">重复收费设置</th>
                            <td>
                                <input type="text" name="repeat_charge_day" required="" class="hd-w120" value="1"/> 天
                                    <span class="hd-validate-notice">重复收费天数，最小设置为1天。</span>
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
    })
</script>
</body>
</html>