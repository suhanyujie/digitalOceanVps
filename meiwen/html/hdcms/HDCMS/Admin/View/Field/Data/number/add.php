<table class="hd-table hd-table-form hd-form">
    <tr class="input action">
        <th class="hd-w400">参数</th>
        <td>
            <table class="hd-table hd-table-form hd-form">
            	<tr>
                    <td>类型</td>
                    <td>
                    	<label><input type="radio" name="set[field_type]" value="smallint"/> smallint</label>
                    	<label><input type="radio" name="set[field_type]" value="int" checked=""/> int</label>
                    	<label><input type="radio" name="set[field_type]" value="mediumint"/> mediumint</label>
                    	<label><input type="radio" name="set[field_type]" value="decimal"/> decimal</label>
                    </td>
                </tr>
                <tr>
                    <td class="hd-w100">整数位数</td>
                    <td><input type="text"  name="set[num_integer]" class="hd-w100 num_integer" value="6"/></td>
                </tr>
                <tr>
                    <td class="hd-w100">小数位数</td>
                    <td><input type="text"   name="set[num_decimal]" class="hd-w100 num_decimal" value="2"/></td>
                </tr>
                <tr>
                    <td class="hd-w100">显示长度</td>
                    <td><input type="text"   name="set[size]" class="hd-w100 num_size" value="300"/></td>
                </tr>
                <tr>
                    <td>默认值</td>
                    <td><input type="text" name="set[default]" class="hd-w200"/></td>
                </tr>
            </table>
        </td>
    </tr>
</table>