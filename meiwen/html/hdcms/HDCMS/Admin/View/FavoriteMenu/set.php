<include file="__PUBLIC__/header"/>
<body>
<div class="hd-title-header">
    设置常用菜单
</div>
<form onsubmit="return hd_submit(this,'__ACTION__','__ACTION__')">
    <table class="hd-table hd-table-form hd-form">
        <list from="$data" name="$n">
            <list from="$n._data" name="$d">
                <tr>
                    <th class="hd-w150">
                        <div class="level2">
                            {$d.title}
                        </div>
                    </th>
                    <td class="hd-h30">
                        <ul>
                            <list from="$d._data" name="$m">
                                <li class="hd-w110" style="float: left;">
                                    <label>
                                        <input type="checkbox" name="nid[]" value="{$m.nid}"
                                        <if value="!empty($m['uid'])">checked=""</if>
                                        />
                                        {$m.title}
                                    </label>
                                </li>
                            </list>
                        </ul>
                    </td>
                </tr>
            </list>
        </list>
    </table>
    <input type='submit' class="hd-btn" value="确定"/>
</form>
</body>
</html>