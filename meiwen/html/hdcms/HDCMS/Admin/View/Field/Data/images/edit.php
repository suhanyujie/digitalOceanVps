<table class="hd-table hd-table-form hd-form">
    <tr class="input action">
        <th class="hd-w400">参数</th>
        <td>
            <table class="hd-table hd-table-form hd-form">
                <tr>
                    <td class="hd-w100">允许上传大小</td>
                    <td>
                        <label><input type="text" class="hd-w100" name="set[allow_size]" value="<?php echo $field['set']['allow_size'];?>"/> MB</label>
                    </td>
                </tr>
                <tr>
                    <td>允许上传的个数</td>
                    <td>
                        <input type="text" class="hd-w100" name="set[num]" value="<?php echo $field['set']['num'];?>"/>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>