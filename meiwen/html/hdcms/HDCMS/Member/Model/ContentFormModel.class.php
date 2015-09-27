<?php

/**
 * 添加、删除文章时表单显示处理
 * @author hdxj <houdunwangxj@gmail.com>
 */
class ContentFormModel extends Model
{
    //表
    public $table = "field";
    //模型mid
    private $mid;
    //栏目cid
    private $cid;
    //文章aid
    private $aid;
    //字段缓存
    private $field;
    //模型缓存
    private $model;
    //表单验证
    public $formValidate = array();
    //编辑时的字段数据
    private $editData;

    //构造函数
    public function __init()
    {
        $this->mid = Q("mid", 0, "intval");
        $this->cid = Q("cid", 0, "intval");
        $this->aid = Q("aid", 0, "intval");
        //字段所在表模型信息
        $this->model = S("model");
        //字段缓存
        $this->field = S('field' . $this->mid);
    }

    /**
     * 编辑与修改动作时根据不同字段类型获取界面
     * @param array $data 编辑数据时的数据
     * @return string
     */
    public function get($data = array())
    {
        //编辑时的字段数据
        $this->editData = $data;
        //所有字段信息
        $form = array();
        foreach ($this->field as $field) {
            if ($field['required']) {
                $field['title'] = $field['title'] . ' <span class="star">*</span>';
            }
            //禁用字段不处理
            if ($field['status'] == 0) {
                continue;
            }
            //前台投稿字段过滤
            if ($field['isadd'] == 0 && MODULE == 'Member') {
                continue;
            }
            /**
             * 表单值
             * a) 添加时使用set['default']
             * b) 编辑时使用已有数据
             */
            if (!empty($this->editData[$field['field_name']])) {
                $value = $this->editData[$field['field_name']];
            } else if (!empty($field['set']['default'])) {
                $value = $field['set']['default'];
            } else {
                $value = '';
            }
            //处理函数
            $function = $field['field_type'];
            //是否为基本字段，基本字段在左侧显示
            $isbase = intval($field['isbase']) ? 'base' : 'nobase';
            $field['form'] = $this->$function($field, $value);
            //设置验证规则
            $this->setValidateRule($field, $value);
            /**
             * 后台有左右两列显示
             * 前台一列表显示
             * 所以组合不同数组结构
             */
            $form[] = $field;
        }
        //JS验证代码
        $this->validateCompileJs();
        return $form;
    }

    /**
     * JS验证数据
     * @param $field 字段信息
     * @param $value 字段值
     */
    protected function setValidateRule($field, $value)
    {
        //设置验证规则
        $validate = array('rule' => array(), 'error' => array(), 'message' => '');
        //必须输入项
        if ((int)$field['required']) {
            $validate['rule']['required'] = 1;
            $validate['error']['required'] = $field['title'] . '不能为空';
        }
        //有验证规则
        if (!empty($field['validate'])) {
            $validate['rule']['regexp'] = '/' . str_replace('/', '\/', (substr($field['validate'], 1, -1))) . '/';
            $validate['error']['regexp'] = empty($field['error']) ? '输入错误' : $field['error'];
        }
        //最小长度
        if (!empty($field['minlength'])) {
            $validate['rule']['minlen'] = (int)$field['minlength'];
            $validate['error']['minlen'] = '不能少于' . (int)$field['minlength'] . '个字';
        }
        //最大长度
        if (!empty($field['maxlength'])) {
            $validate['rule']['maxlen'] = (int)$field['maxlength'];
            $validate['error']['maxlen'] = '不能超过' . (int)$field['maxlength'] . '个字';
        }
        //字段提示
        if (!empty($field['tips'])) {
            $validate['message'] = $field['tips'];
        }
        $this->formValidate[$field['field_name']] = $validate;
    }


    //Input字段
    private function input($field, $value)
    {
        $set = $field['set'];
        //表单类型
        $type = $set['ispasswd'] == 1 ? "password" : "text";
        return "<input style=\"width:{$set['size']}px\" type=\"{$type}\" class=\"{$field['css']}\" name=\"{$field['field_name']}\" value=\"$value\"/>";
    }

    //tag字段
    private function tag($field, $value)
    {
        //编辑文章时获取TAG
        if ($this->aid) {
            $map['mid'] = $this->mid;
            $map['aid'] = $this->aid;
            $tag = M()->join('__tag__ t JOIN __content_tag__ ct ON t.tid=ct.tid')->where($map)->group('t.tid')->getField('tag', true);
            $value = $tag ? implode(',', $tag) : '';
        }
        $set = $field['set'];
        //表单类型
        return "<input style=\"width:{$set['size']}px\" type=\"text\" class=\"{$field['css']}\" name=\"{$field['field_name']}\" value=\"$value\"/><span class='hd-validate-notice'>请用逗号分隔</span>";
    }

    //Input字段
    private function number($field, $value)
    {
        $set = $field['set'];
        //表单类型
        return "<input style=\"width:{$set['size']}px\" type=\"text\" class=\"{$field['css']}\" name=\"{$field['field_name']}\" value=\"$value\"/>";
    }

    //Title标题字段
    private function title($field, $value)
    {
        $set = $field['set'];
        $color = isset($this->editData['color']) ? $this->editData['color'] : '';
        //新窗口打开
        if (isset($this->editData['new_window']) && $this->editData['new_window'] == 1) {
            $new_window = 'checked=""';
        } else {
            $new_window = '';
        }
        return '<input id="title" type="text" name="' . $field['field_name'] . '" style="width:600px" class="title ' . $field['css'] . '" value="' . $value . '">

                        <span id="hd_' . $field['field_name'] . '"></span>';
    }

    //文章Flag属性如推荐、置顶等
    private function flag($field, $value)
    {
        $flag = S('flag' . $this->mid);
        $set = $field['set'];
        if (!empty($value)) {
            $value = explode(',', $value);
        }
        $form = '';
        foreach ($flag as $N => $f) {
            $checked = "";
            if (!empty($value)) {
                if (in_array($f, $value)) {
                    $checked = 'checked=""';
                }
            }
            $form .= '<label class="checkbox inline">
					<input type="checkbox" name="flag[]" value="' . $f . '" ' . $checked . '> 
                                	' . $f . '[' . ($N + 1) . ']</label>';
        }
        return $form;
    }

    //栏目cid
    private function cid($field, $value)
    {
        //栏目权限模型
        $categoryData = M('category')->all();
        $category = Data::tree($categoryData, 'catname');
        $html = "<select name='cid'>";
        $html .= "<option value='0'>==选择栏目==</option>";
        foreach ($category as $cat) {
            //外部链接关闭投稿
            if (in_array($cat['cattype'], array(3))) {
                continue;
            }
            //非本模型栏目不显示
            if ($this->mid != $cat['mid']) {
                continue;
            }
            //执行动作
            if (isset($_GET['aid'])) {
                $action = 'edit';
            } else {
                $action = 'add';
            }
            //超级管理员不限或没有权限信息时允许操作
            if (IS_SUPER_ADMIN || IS_WEBMASTER || empty($access)) {
            } else {
                $map['rid'] = $_SESSION['user']['rid'];
                $map['cid'] = $cat['cid'];
                $access = M('category_access')->where($map)->find();
                if (!empty($access) && !$access[$access]) {
                    continue;
                }
            }
            //除单文章与普通栏目外不可以发表
            if (in_array($cat['cattype'], array(1, 4))) {
                $disabled = '';
            } else {
                $disabled = ' disabled="" ';
            }
            //当前栏目默认选中
            if ($this->cid == $cat['cid']) {
                $selected = ' selected="" ';
            } else {
                $selected = '';
            }
            $html .= "<option value='{$cat['cid']}' $disabled $selected>{$cat['_name']}</option>";
        }
        $html .= "</select>";
        return $html;
    }

    //栏目文本域
    private function textarea($field, $value)
    {
        $set = $field['set'];
        return "<textarea class=\"{$field['css']}\" name=\"{$field['field_name']}\" style=\"width:{$set['width']}px;height:{$set['height']}px\">{$value}</textarea>";
    }

    //文章正文
    private function content($field, $value)
    {
        $html = '<script id="' . $field["field_name"] . '" type="text/plain" style="width:99%;height:300px;" name="' . $field["field_name"] . '">' . $value . '</script>
                 <script type="text/javascript">
                        var ue = UE.getEditor("' . $field["field_name"] . '",{
            toolbars:[[ "fullscreen", "source", "|", "undo", "redo", "|",
            "bold", "italic", "underline","blockquote", "forecolor",  "|","simpleupload","link", "insertcode"]],
            //关闭字数统计
            wordCount:false,
            //关闭elementPath
            elementPathEnabled:false,
            //默认的编辑区域高度
            initialFrameHeight:300
        });
                 </script>';
        return $html;
    }

    //编辑器
    private function editor($field, $value)
    {
        $html = '<script id="' . $field["field_name"] . '" type="text/plain" style="width:99%;height:300px;" name="' . $field["field_name"] . '">' . $value . '</script>
                 <script type="text/javascript">
                        var ue = UE.getEditor("' . $field["field_name"] . '",{
            toolbars:[[ "fullscreen", "source", "|", "undo", "redo", "|",
            "bold", "italic", "underline","blockquote", "forecolor",  "|","simpleupload","link", "insertcode"]],
            //关闭字数统计
            wordCount:false,
            //关闭elementPath
            elementPathEnabled:false,
            //默认的编辑区域高度
            initialFrameHeight:300
        });
                 </script>';
        return $html;
    }

    //选项radio,select,checkbox
    private function box($field, $value)
    {
        $set = $field['set'];
        //表单值
        $_v = explode(",", $set['options']);
        $options = array();
        foreach ($_v as $p) {
            $p = explode("|", $p);
            $options[$p[0]] = $p[1];
        }
        $h = '';
        //select添加select
        if ($set['form_type'] == 'select') {
            $h .= "<select name='{$field['field_name']}'>";
        }
        foreach ($options as $v => $text) {
            switch ($set['form_type']) {
                case "radio" :
                    $checked = $value == $v ? 'checked=""' : '';
                    $h .= "<label><input type='radio' name=\"{$field['field_name']}\" value=\"{$v}\" {$checked}/> {$text}</label>&nbsp;&nbsp;";
                    break;
                case "checkbox" :
                    $s = explode(",", $value);
                    $checked = in_array($v, $s) ? 'checked=""' : '';
                    $h .= "<label><input type='checkbox' name=\"{$field['field_name']}[]\" value=\"{$v}\" {$checked}/> {$text}</label> ";
                    break;
                case "select" :
                    $selected = $value == $v ? 'selected=""' : "";
                    $h .= "<option name=\"{$field['field_name']}\" value=\"{$v}\" {$selected}> {$text}</option>";
                    break;
            }
        }
        if ($set['form_type'] == 'select') {
            $h .= "</select>";
        }
        return $h;
    }

    //日期Date
    private function datetime($field, $value)
    {
        $set = $field['set'];
        $format = array("Y-m-d", "Y/m/d H:i:s", "H:i:s");
        $value = empty($value) ? date($format[$set['format']]) : date($format[$set['format']], $value);
        //默认值
        $h = "<input type='text' id='{$field['field_name']}' name='{$field['field_name']}' value='$value' class='w150'/>";
        $format = array("yyyy-MM-dd", "yyyy/MM/dd HH:mm:ss", "HH:mm:ss");
        $h .= "<script>$('#{$field['field_name']}').calendar({format: '" . $format[$set['format']] . "'});</script>";
        return $h;
    }

    //缩略图
    private function thumb($field, $value)
    {
        $name = $field['field_name'];
        $path = isset($value) ? $value : "";

        $h = "<input type='hidden' name='thumb' value='$path' class='w300' readonly=''/> ";
        $h .= "<button class='hd-btn hd-btn-sm' onclick='UploadThumb(".$this->mid.",\"thumb\")' type='button'>上传图片</button>&nbsp;&nbsp;";
        if(empty($value)){
            $h .= "<button class='hd-btn hd-btn-sm' onclick='removeThumb(\"thumb\")' type='button' style='display: none'>移除图片</button>";
            $h .= "<span class='hd-validate-notice'>{$field['tips']}</span>";
            $h.="<br/><img src='' class='hd-w140 hd-h110' id='{$name}Img' style='display: none'/>";
        }else{
            $h .= "<button class='hd-btn hd-btn-sm' onclick='removeThumb(\"thumb\")' type='button'>移除图片</button>";
            $h .= "<span class='hd-validate-notice'>{$field['tips']}</span>";
            $src = __ROOT__ . '/' . $value ;
            $h.="<br/><img src='{$src}' class='hd-w140 hd-h110' id='{$name}Img'/>";
        }
        return $h;
    }

    //单张图
    private function image($field, $value)
    {
        $name = $field['field_name'];
        $path = isset($value) ? $value : "";
        $src = !empty($value) ? __ROOT__ . '/' . $value : "";
        $h = "<input type='text' name='{$name}' value='{$path}' src='{$src}' class='hd-w300' onmouseover='viewImage(this)' readonly=''/> ";
        $h .= "<button class='hd-btn hd-btn-sm' onclick='imageOne(".$this->mid.",\"{$name}\")' type='button'>上传图片</button>";
        $h .= "<button class='hd-btn hd-btn-sm' onclick='removeImage(\"{$name}\")' type='button'>移除</button>";
        $h .= "<span class='hd-validate-notice'>{$field['tips']}</span>";
        return $h;
    }

    //多图上传
    private function images($field, $value)
    {
        $name = $field['field_name'];
        $set = $field['set'];
        //允许上传数量
        $num = $set['num'];

        $h = "<fieldset class='img_list'>
<legend style='color:#666;font-size: 12px;line-height: 25px;padding: 0px 10px; text-align:center;margin: 0px;'>图片列表</legend>
<center>
<div style='color:#666;font-size:12px;margin-bottom: 5px;'>
您最多可以同时上传
<span style='color:red' id='{$name}NumText'>{$field['set']['num']}</span> 张图片
</div>
</center>
<div id='{$name}Box' class='picList'>";
        $h .= '<ul>';
        if (!empty($value)) {
            $imgData = unserialize($value);
            if (!empty($imgData) && is_array($imgData)) {
                foreach ($imgData as $img) {
                    $h .= "<li><div class='img'><img src='" . __ROOT__ . "/" . $img['path'] . "' style='width:135px;height:135px;'/>";
                    $h .= "<a href='javascript:;' onclick='removeImages(this)'>X</a>";
                    $h .= "</div>";
                    $h .= "<input type='hidden' name='{$name}[path][]'  value='{$img['path']}' class='w400 images'/> ";
                    $h .= "<input type='text' name='{$name}[alt][]' value='" . $img['alt'] . "' placeholder='图片描述...'/>";
                    $h .= "</li>";
                }
            }
        }
        $h .= "</ul></div>
</fieldset>
<button class='hd-btn hd-btn-sm' onclick='imagesUpload(".$this->mid.",\"{$name}\",{$num})' type='button'>上传图片</button>";
        $h .= "<span class='hd-validate-notice'>{$field['tips']}</span>";
        return $h;
    }

    //多文件上传
    private function files($field, $value)
    {
        $name = $field['field_name'];
        $set = $field['set'];
        //允许上传数量
        $num = $set['num'];

        $h = "<fieldset class='img_list'>
<legend style='color:#666;font-size: 12px;line-height: 25px;padding: 0px 10px; text-align:center;margin: 0px;'>文件列表</legend>
<center>
<div style='color:#666;font-size:12px;margin-bottom: 5px;'>
您最多可以同时上传
<span style='color:red' id='{$name}NumText'>{$field['set']['num']}</span> 个文件
</div>
</center>
<div id='{$name}Box' class='fileList'>";
        $h .= '<ul>';
        if (!empty($value)) {
            $imgData = unserialize($value);
            if (!empty($imgData) && is_array($imgData)) {
                foreach ($imgData as $img) {
                    $h.="<li style='width:98%'>";
                    $h.="<img src='".__STATIC__."/image/default.png' style='width:50px;height:50px;vertical-align:middle'>&nbsp;&nbsp;";
                    $h.="地址: <input name='{$name}[path][]' value='{$img['path']}' style='width:35%' readonly='' type='text'> &nbsp;&nbsp;";
                    $h.="描述: <input name='{$name}[alt][]' style='width:35%;' value='{$img['alt']}' type='text'>&nbsp;&nbsp;";
                    $h.="<a href='javascript:;' onclick='removeFiles(this)'>删除</a>";
                    $h.="</li>";
                }
            }
        }
        $h .= "</ul></div>
</fieldset>
<button class='hd-btn hd-btn-sm' onclick='filesUpload(".$this->mid.",\"{$name}\",{$num})' type='button'>上传文件</button>";
        $h .= "<span class='hd-validate-notice'>{$field['tips']}</span>";
        return $h;
    }

}