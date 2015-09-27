<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <css file="__PUBLIC__/static/css/common.css"/>
    <hdjs/>

    <link rel="stylesheet" type="text/css" href="__CONTROLLER_VIEW__/css/user.css?ver=1.0"/>
    <js file="__CONTROLLER_VIEW__/js/cropFace.js"/>
    <script type="text/javascript" src="__STATIC__/jcrop/js/jquery.Jcrop.min.js"></script>
    <link rel="stylesheet" type="text/css" href="__STATIC__/jcrop/css/jquery.Jcrop.min.css"/>

    <script type="text/javascript" src="__STATIC__/uploadify/jquery.uploadify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="__STATIC__/uploadify/uploadify.css"/>
</head>
<body>
<include file="__PUBLIC__/block/top_menu.php"/>
<div class="wrap">
    <div class="menu">
        <include file="__PUBLIC__/block/left_menu.php"/>
    </div>
    <div class="content">
        <div class="list">
            <div class="message">
                <h1>使用帮助</h1>

                <p>
                    （1）请选择图片清晰的png,jpg图像文件
                </p>
            </div>
            <div class="header">
                设置会员头像
            </div>
            <div class="article">
                <div class="form">
                        <div class="source-face">
                            <div
                                style="position:relative;border:solid 1px #999;width: 250px;height: 250px;overflow: hidden;margin-bottom:10px;float:left;margin-right:20px;">
                                <!--上传头像按钮 Start-->
                                <script>
                                    $(function () {
                                        $('#file_upload').uploadify({
                                            'swf': '__CONTROLLER_VIEW__/uploadify/uploadify.swf',
                                            'uploader': '{|U:"uploadFace"}',
                                            'removeCompleted': false,
                                            'buttonImage': '__CONTROLLER_VIEW__/uploadify/select_face.png',
                                            'fileTypeExts': '*.jpg; *.png',
                                            'multi': false,
                                            'fileSizeLimit': '2MB',
                                            'uploadLimit': 1000,
                                            'width': 250,
                                            'height': 250,
                                            'removeCompleted': true,
                                            'formData': {'<?php echo session_name();?>': '<?php echo session_id();?>'},
                                            'onUploadSuccess': function (file, data, response) {
                                                eval('data=' + data);
                                                if (data.status == 1) {
                                                    var img = data.url;
                                                    $("#target").attr("src", img);
                                                    $("div.jcrop-holder img").attr("src", img);
                                                    $("#preview150").attr("src", img);
                                                    $("#preview100").attr("src", img);
                                                    $("#preview50").attr("src", img);
                                                    $("input[name=img_face]").val(data.path);
                                                    $("#buttons").show();
                                                    $("#face_upload").hide();
                                                    $("#SWFUpload_0_0").remove();
                                                } else {
                                                    alert(data.error);
                                                }
                                            }
                                        });
                                    });
                                    //重新上传头像
                                    function reset_upload() {
                                        $("#buttons").hide();
                                        $("#face_upload").show();
                                    }
                                </script>
                                <div id="face_upload">
                                    <input type="file" name="file_upload" id="file_upload"/>
                                </div>
                                <!--上传头像按钮 End-->
                                <img src="__CONTROLLER_VIEW__/images/select_face.png" id="target"
                                     style="display: none"/>
                            </div>
                            <div id="buttons" style="display: none">
                                <form action="" method="post" onsubmit="return hd_submit(this,'__ACTION__','__ACTION__')">
                                        <button type="submit" class="btn btn-primary btn-xs">保存</button>
                                        <button onclick="reset_upload();" type="button" class="btn btn-default btn-xs">重新上传</button>
                                    <input type="hidden" name="img_face" value=""/>
                                    <input type="hidden" size="4" id="x1" name="x1" value="0"/>
                                    <input type="hidden" size="4" id="y1" name="y1" value="0"/>
                                    <input type="hidden" size="4" id="x2" name="x2" value="249"/>
                                    <input type="hidden" size="4" id="y2" name="y2" value="249"/>
                                    <input type="hidden" size="4" id="w" name="w" value="250"/>
                                    <input type="hidden" size="4" id="h" name="h" value="250"/>
                                </form>
                            </div>
                        </div>
                        <div class="face-preview">
                            <h2>头像预览</h2>

                            <div class="help">
                                请注意中小尺寸的头像是否清晰
                            </div>

                            <div class="face">
                                <div style="width:150px;height:150px;overflow:hidden;">
                                    <img src="{$hd.session.user.icon}" id="preview150" alt="Preview"
                                         style="width:150px;">
                                </div>
                                <p>
                                    头像尺寸150X150
                                </p>
                            </div>
                            <div class="face">
                                <div style="width:100px;height:100px;overflow:hidden;">
                                    <img src="{$hd.session.user.icon}" id="preview100" alt="Preview"
                                         style="width:100px;">
                                </div>
                                <p>
                                    头像尺寸100X100
                                </p>
                            </div>
                            <div class="face">
                                <div style="width:50px;height:50px;overflow:hidden;">
                                    <img src="{$hd.session.user.icon}" id="preview50" alt="Preview"
                                         style="width:50px;">
                                </div>
                                <p>
                                    头像尺寸50X50
                                </p>
                            </div>
                        </div>


                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>