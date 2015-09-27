<table class="hd-table hd-table-form hd-form">
    <tr class="input action">
        <th class="hd-w400">参数</th>
        <td>
            <table class="table1">
                <tr>
                    <td class="hd-w100">选项列表</td>
                    <td>
                        <textarea name="set[options]" class="hd-w300 hd-h100 select_options">选项值1|选项名称1</textarea>
                        <span class="hd-validate-notice">例：1|男,2|女</span>
                    </td>
                </tr>
                <tr>
                    <td class="hd-w100">选项类型</td>
                    <td>
                        <label><input type="radio" name="set[form_type]" value="radio" checked="checked"/> 单选按钮</label>
                        <label><input type="radio" name="set[form_type]" value="checkbox"/> 复选框</label>
                        <label><input type="radio" name="set[form_type]" value="select"/> 下拉框</label>
                    </td>
                </tr>
                <tr>
                    <td>默认值</td>
                    <td><input type="text" name="set[default]" class="hd-w100 select_default"/></td>
                </tr>
            </table>
        </td>
    </tr>
</table>