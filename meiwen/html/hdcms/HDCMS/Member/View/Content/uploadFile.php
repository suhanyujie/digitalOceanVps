<!doctype html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <title>系统后台 - {$hd.config.webname} - by HDCMS</title>
    <hdjs/>
    <jsconst/>
    <script>
        var mid ="{$hd.get.mid}";
    </script>
</head>
<body>
<css file="__CONTROLLER_VIEW__/css/uploadFile.css"/>
<js file="__CONTROLLER_VIEW__/js/uploadFile.js"/>
<script src="__STATIC__/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="__STATIC__/uploadify/uploadify.css"/>
<script>
    var type="{$set.type}";
    var name="{$set.name}";
</script>
<div class="hd-tab">
    <ul class="hd-tab-menu">
        <li lab="uploadFile" class="active">
            <a>上传文件</a>
        </li>
        <li lab="webFile">
            <a>站内文件</a>
        </li>
        <li lab="noUse">
            <a>未使用文件</a>
        </li>
    </ul>
    <div class="hd-tab-content">
        <div lab="uploadFile" class="hd-tab-area">
            <input id="file" type="file" multiple="true">
            <span class="hd-validate-notice">类型: {$set.filetype} 大小: {$set.allow_size}KB 数量: {$set.num}</span>
            <script type="text/javascript">
                $(function() {
                    $('#file').uploadify({
                        'formData'     : {//POST数据
                            '<?php echo session_name();?>' : '<?php echo session_id();?>',
                        },
                        'fileTypeDesc' : '上传文件',//上传描述
                        'fileTypeExts' : '{$set['filetype']}',
                        'swf'      : '__STATIC__/uploadify/uploadify.swf',
                        'uploader' : '{|U:"upload",array("mid"=>$_GET["mid"])}',
                        'buttonText':'选择文件',
                        'fileSizeLimit' : '{$set.allow_size}KB',
                        'uploadLimit' : 1000,//上传文件数
                        'width':65,
                        'height':25,
                        'successTimeout':10,//等待服务器响应时间
                        'removeTimeout' : 0.2,//成功显示时间
                        'onUploadSuccess' : function(file, data, response) {
                            data=$.parseJSON(data);
                            var imageUrl = data.image?data.url:'__STATIC__/image/default.png';
                            var li="<li path='"+data.path+"' url='"+data.url+"'><img src='"+imageUrl+"' class='hd-w80 hd-h70'/></li>";
                            $("#uploadList ul").prepend(li);
                        }
                    });
                });
            </script>
            <div id="uploadList" class="imagelist">
                <ul>

                </ul>
            </div>
        </div>
        <div lab="webFile" id="webFile" class="imagelist  hd-tab-area">

        </div>
        <div lab="noUse" id="noUse" class="imagelist  hd-tab-area">

        </div>
    </div>
</div>

</body>
</html>