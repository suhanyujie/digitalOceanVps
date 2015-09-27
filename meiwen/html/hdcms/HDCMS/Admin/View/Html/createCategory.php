<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>生成栏目静态</title>
    <hdjs/>
    <script>
        //栏目缓存数据
        var category = {$category};
    </script>
    <js file="__CONTROLLER_VIEW__/js/category.js"/>
    <css file="__PUBLIC__/common.css"/>
</head>
<body>
<form method="post">
    <div class="hd-title-header">温馨提示</div>
    <div class="help">
        <ul>
            <li>如果生成失败，请将每轮更新条数设置小些</li>
        </ul>
    </div>
    <div class="hd-title-header">规则设置</div>
    <table class="hd-table hd-table-list hd-form">
        <tr>
            <td class="hd-w200">按照模型更新</td>
            <td class="hd-w300">选择栏目范围</td>
            <td>选择操作内容</td>
        </tr>
        <tr>
            <td class="hd-w200" rowspan="5">
                <select name="mid" id="mid" style="height: 200px;width: 99%" size="2">
                    <option value="0" selected="selected">不限模型</option>
                    <list from="$model" name="$m">
                        <option value="{$m.mid}">{$m.model_name}</option>
                    </list>
                </select>
            </td>
            <td class="hd-w300" rowspan="5">
                <select name="cid[]" id="cid" style="height: 200px;width: 99%"
                        title="按住“Ctrl”或“Shift”键可以多选，按住“Ctrl”可取消选择" multiple="multiple">
                    <option value="0" selected="selected">不限栏目</option>

                </select>
            </td>
            <td>
                <font color="red">
                    每轮更新
                    <input class="hd-w100" type="text" value="10" id="row" name="step_row">
                    页
                </font>
            </td>
        </tr>
        <tr>
            <td>
                更新所有信息 <input type="submit" value="开始更新" class="hd-btn"/>
            </td>
        </tr>
    </table>
</form>
</body>
</html>