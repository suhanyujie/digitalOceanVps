<table class="hd-table hd-table-form hd-form">
    <tr class="input action">
        <th class="hd-w400">参数</th>
        <td>
            <table class="hd-table hd-table-form hd-form">
                <tr>
                    <td class="hd-w100">显示长度</td>
                    <td><input type="text" name="set[size]" class="hd-w100 input_size" value="<?php echo $field['set']['size'];?>"/> px</td>
                </tr>
                <tr>
                    <td>默认值</td>
                    <td><input type="text" name="set[default]" class="hd-w200" value="<?php echo $field['set']['default'];?>"/></td>
                </tr>
                <tr>
                    <td>是否为密码</td>
                    <td>
                        <label><input type="radio" name="set[ispasswd]" value="1" <?php if($field['set']['ispasswd'] == 1){?>checked=""<?php }?>/> 是</label>
                        <label><input type="radio" name="set[ispasswd]" value="0" <?php if($field['set']['ispasswd'] == 0){?>checked=""<?php }?>/> 否</label>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
</table>