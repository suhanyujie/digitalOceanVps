<table class="hd-table hd-table-form hd-form">
    <tr class="input action">
        <th class="hd-w400">参数</th>
        <td>
            <table class="table1">
                <tr>
                    <td class="hd-w100">选项列表</td>
                    <td>
                        <textarea name="set[options]" class="hd-w300 h100"><?php echo $field['set']['options'];?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="hd-w100">选项类型</td>
                    <td>
                    	<label><input type="radio" name="set[form_type]" value="radio" <?php if($field['set']['form_type']=='radio'){?>checked=""<?php }?>/> 单选框</label>
                        <label><input type="radio" name="set[form_type]" value="checkbox" <?php if($field['set']['form_type']=='checkbox'){?>checked=""<?php }?>/> 复选框</label>
                        <label><input type="radio" name="set[form_type]" value="select" <?php if($field['set']['form_type']=='select'){?>checked=""<?php }?>/> 下拉框</label>
                    </td>
                </tr>
                <tr>
                    <td>默认值</td>
                    <td><input type="text" name="set[default]" class="hd-w100 select_default" value="<?php echo $field['set']['default'];?>"/></td>
                </tr>
            </table>
        </td>
    </tr>
</table>