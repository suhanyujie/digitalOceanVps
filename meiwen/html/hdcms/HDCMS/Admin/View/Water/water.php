<include file="__PUBLIC__/header"/>
<body>
<div class="hd-title-header">温馨提示</div>
<div class="help">
    图片类型为jpg或png格式，图片不存在使用文字水印
</div>
<form class="hd-form" onsubmit="return hd_submit(this,'__ACTION__','__ACTION__')">
    <table class="hd-table hd-table-form">
        <thead>
        <tr style="background: #E6E6E6;">
            <td class="hd-w200">标题</td>
            <td>配置</th>
            <td class="hd-w300">变量</td>
        </tr>
        </thead>
        <foreach from="$config" key="$key" value="$val">
            <if value="$key eq 'WATER_ON'">
                <tr>
                    <td>{$val.title}</td>
                    <td>
                        <label><input type="radio" name="{$val.name}" value="1" <if value="$val.value eq 1">checked=""</if>/> 开启</label>
                        <label><input type="radio" name="{$val.name}" value="0" <if value="$val.value eq 0">checked=""</if>/> 关闭</label>
                        {$var.message}
                    </td>
                    <td>{$val.name}</td>
                </tr>
            <elseif value="$key neq 'WATER_POS'"/>
                <tr>
                    <td>{$val.title}</td>
                    <td>
                        <input type="text" name="{$val.name}" value="{$val.value}" class="hd-w200"/>
                        <span class="hd-validate-notice">{$val.message}</span>
                    </td>
                    <td>{$val.name}</td>
                </tr>
            <else/>
                <tr>
                    <td>{$val.title}</td>
                    <td>
                        <table class="hd-w300">
                            <tr>
                                <td>
                                    <label><input type="radio" name="WATER_POS" value="1"
                                                  <?php if ($val['value'] == 1){ ?>checked="checked"<?php } ?>/>
                                        左上</label>
                                </td>
                                <td>
                                    <label><input type="radio" name="WATER_POS" value="2"
                                                  <?php if ($val['value'] == 2){ ?>checked="checked"<?php } ?>/>
                                        上中</label>
                                </td>
                                <td>
                                    <label><input type="radio" name="WATER_POS" value="3"
                                                  <?php if ($val['value'] == 3){ ?>checked="checked"<?php } ?>/>
                                        上右</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="radio" name="WATER_POS" value="4"
                                                  <?php if ($val['value'] == 4){ ?>checked="checked"<?php } ?>/>
                                        中左</label>
                                </td>
                                <td>
                                    <label><input type="radio" name="WATER_POS" value="5"
                                                  <?php if ($val['value'] == 5){ ?>checked="checked"<?php } ?>/>
                                        中间</label>
                                </td>
                                <td>
                                    <label><input type="radio" name="WATER_POS" value="6"
                                                  <?php if ($val['value'] == 6){ ?>checked="checked"<?php } ?>/>
                                        中右</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><input type="radio" name="WATER_POS" value="7"
                                                  <?php if ($val['value'] == 7){ ?>checked="checked"<?php } ?>/>
                                        下左</label>
                                </td>
                                <td>
                                    <label><input type="radio" name="WATER_POS" value="8"
                                                  <?php if ($val['value'] == 8){ ?>checked="checked"<?php } ?>/>
                                        下中</label>
                                </td>
                                <td>
                                    <label><input type="radio" name="WATER_POS" value="9"
                                                  <?php if ($val['value'] == 9){ ?>checked="checked"<?php } ?>/>
                                        下右</label>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>{$val.name}</td>
                    <td>{$val.message}</td>
                </tr>
            </if>
        </foreach>
    </table>

    <input type="submit" class="hd-btn" value="确定"/>
</form>
</body>
</html>