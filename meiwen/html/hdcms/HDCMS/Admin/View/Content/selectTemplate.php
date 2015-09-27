<include file="__PUBLIC__/header"/>
<body>
<if value="Q('dir')">
    <a href="javascript:window.history.go(-1)" class="hd-btn hd-btn-xm">后退</a>
</if>
<css file="__CONTROLLER_VIEW__/css/selectTemplate.css"/>
<table class="hd-table hd-table-list">
    <tbody>
    <list from="$file" name="$f">
        <tr>
            <td>
                <if value="$f.type eq file">
                    <b class="file"></b>
                    <else/>
                    <b class="dir"></b>
                </if>
            </td>
            <td>
                <if value="$f.type eq file">
                    <a href="javascript:;"
                       onclick="selectFile('<?php echo str_replace('Template/' . C('WEB_STYLE') . '/', '', $f['spath']); ?>')">{$f.filename}</a>
                    <else/>
                    <a href="{|U:'selectTemplate',array('id'=>$_GET['id'],'dir'=>str_replace(ROOT_PATH,'',$f['spath']))}">
                        {$f.filename}
                    </a>
                </if>
            </td>
            <td>
                {$f.size|get_size}
            </td>
            <td>
                {$f.filemtime|date:'Y-m-d',@@}
            </td>
        </tr>
    </list>
    </tbody>
</table>
<script>
    /**
     * 选择模板文件
     * @param file
     */
    function selectFile(file){
        var id = '{$hd.get.id}';
        $(window.parent.document).find("#"+id).val(file);
        window.parent.hd_modal_close();
    }
</script>
</body>
</html>