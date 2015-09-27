<include file="__PUBLIC__/header"/>
<body>
<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor1_4_3/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor1_4_3/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="__STATIC__/ueditor1_4_3/lang/zh-cn/zh-cn.js"></script>

<script src="__STATIC__/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="__STATIC__/uploadify/uploadify.css">
    <div class="hd-menu-list">
        <ul>
            <li><a href="{|U:'index'}">插件管理</a></li>
            <li class="active"><a href="javascript:;">添加插件</a></li>
        </ul>
    </div>
    <div class="hd-title-header">
        <strong>{$data.title}</strong>插件设置
    </div>
    <form onsubmit="return hd_submit(this,'__ACTION__','__CONTROLLER__')">
        <input type="hidden" name="id" value="{$hd.get.id}"/>
        <table class="hd-table hd-table-form hd-form">
            <foreach from="$configFile" key="$name" value="$config">
                <?php $formName="config[$name]";?>
                <tr>
                    <th class="hd-w150">{$config.title}</th>
                    <td>
                            <if value="$config.type eq 'text'">
                                <input type="text" name="{$formName}" value="{$config.value}" style="{$config.style}"/>
                            </if>
                            <if value="$config.type eq 'password'">
                                <input type="password" name="{$formName}" value="{$config.value}" style="{$config.style}"/>
                            </if>
                            <if value="$config.type eq 'hidden'">
                                <input type="hidden" name="{$formName}" value="{$config.value}" style="{$config.style}"/>
                            </if>
                            <if value="$config.type eq 'radio'">
                                <foreach from="$config['options']" key="$rvalue" value="$rtitle">
                                    <label>
                                        <input type="radio" name="{$formName}" value="{$rvalue}" style="{$config.style}" <if value="$config.value eq $rvalue">
                                            checked=""</if>/> {$rtitle}
                                    </label>
                                </foreach>
                            </if>
                            <if value="$config.type eq 'checkbox'">
                                <foreach from="$config['options']" key="$rvalue" value="$rtitle">
                                    <label>
                                        <input type="checkbox" name="{$formName}[]" value="{$rvalue}" style="{$config.style}" <if value="in_array($rvalue,$config['value'])">checked=""</if>/>
                                        {$rtitle}
                                    </label>
                                </foreach>
                            </if>
                            <if value="$config.type eq 'select'">
                                <select name="{$formName}">
                                <foreach from="$config['options']" key="$svalue" value="$stitle">
                                    <option value="{$rvalue}" <if value="$config.value eq $svalue">selected=""</if>>{$stitle}</option>
                                </foreach>
                                </select>
                            </if>
                            <if value="$config.type eq 'textarea'">
                                <textarea name="{$formName}" style="{$config.style}" class="w300 h100">{$config.value}</textarea>
                            </if>
                            <if value="$config.type eq 'image'">
                                <input id='{$name}' type='text' name='{$formName}'  value='{$config.value}' src='<if value="$config.value">__ROOT__/{$config.value}</if>' class='w300 images' onmouseover='view_image(this)' readonly=''/>
                                <input id="file" type="file" multiple="true">
                                <script type="text/javascript">
                                    $(function() {
                                        $('#file').uploadify({
                                            'formData'     : {//POST数据
                                                '<?php echo session_name();?>' : '<?php echo session_id();?>',
                                            },
                                            'fileTypeDesc' : '栏目图片',//上传描述
                                            'fileTypeExts' : '*.gif; *.jpg; *.png',
                                            'swf'      : '__STATIC__/uploadify/uploadify.swf',
                                            'uploader' : '{|U:"upload"}',
                                            'buttonText':'上传图片',
                                            'fileSizeLimit' : '1000KB',
                                            'uploadLimit' : 100,//上传文件数
                                            'width':65,
                                            'height':25,
                                            'successTimeout':10,//等待服务器响应时间
                                            'removeTimeout' : 0.5,//成功显示时间
                                            'onUploadSuccess' : function(file, data, response) {
                                                data=$.parseJSON(data);
                                                $("[name='{$formName}']").val(data.path);
                                                $("[name='{$formName}']").attr('src',data.url);
                                            }
                                        });
                                    });
                                </script>
                            </if>
                            <if value="$config.type eq 'group'">
                                <?php $member_role=S('member_role');?>
                                    <foreach from="$member_role" key="$rvalue" value="$role">
                                        <label><input type="checkbox" name="{$formName}[]" value="{$role['rid']}" <if value="in_array($role['rid'],$config['value'])">checked=""</if>/> {$role.rname}</label>
                                    </foreach>
                            </if>
                            <if value="$config.type eq 'editor'">
                                <script id="{$formName}" type="text/plain" style="width:99%;height:300px;" name="{$formName}">{$config['value']}</script>
                                <script>
                                var ue = UE.getEditor("{$formName}");
                                </script>
                            </if>
                        {$config.message}
                    </td>
                </tr>
            </foreach>
        </table>
        <input type="submit" value="确定" class="hd-btn"/>
    </form>
<script>
    //预览单张图片
    function view_image(obj) {
        var src = $(obj).attr('src');
        var id = $(obj).attr('id');
        var viewImg = $('#view_' + id);
        //删除预览图
        if (viewImg.length >= 1) {
            viewImg.remove();
        }
        //鼠标移除时删除预览图
        $(obj).mouseout(function(){
            $('#view_' + id).remove();
        })
        if (src) {
            var offset = $(obj).offset();
            var _left = 320+offset.left+"px";
            var _top = offset.top-75+"px";
            var html = '<img src="' + src + '" style="border:solid 5px #dcdcdc;position:absolute;z-index:1000;height:100px;left:'+_left+';top:'+_top+';" id="view_'+id+'"/>';
            $('body').append(html);
        }
    }
</script>
</body>
</html>