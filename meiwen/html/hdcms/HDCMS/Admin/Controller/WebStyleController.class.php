<?php

/**
 * 模板风格选择
 * @author hdxj<houdunwangxj@gmail.com>
 */
class WebStyleController extends AuthController
{
    //模板列表
    public function styleList()
    {
        $style = array();
        $dirs = Dir::tree('Template');
        foreach ($dirs as $tpl) {
            $xml = $tpl['path'] . '/config.xml';
            if (!is_file($xml)){
                continue;
            }
            if (!$config = Xml::toArray(file_get_contents($xml))){
                continue;
            }
            $tpl['name'] = isset($config['name']) ? $config['name'][0] : ''; //模型名
            $tpl['author'] = isset($config['author']) ? $config['author'][0] : ''; //作者
            $tpl['image'] = isset($config['image']) ? __ROOT__.'/Template/'.$tpl['filename'].'/'.$config['image'][0] : __CONTROLLER_TPL__ . '/img/preview.jpg'; //预览图
            $tpl['email'] = isset($config['email']) ? $config['email'][0] : ''; //邮箱
            $tpl['current'] = C("WEB_STYLE") == $tpl['filename'] ? 1 : 0; //正在使用的模板
            $style[] = $tpl;
        }
        $this->assign('style', $style);
        $this->display();
    }

    //选择模板
    public function selectStyle()
    {
        $dir_name = Q("dirName");
        if ($dir_name) {
            import('Config.Model.ConfigModel');
            $Model = K("Config");
            $Model->where("name='WEB_STYLE'")->save(array("value" => $dir_name));
            //更新配置文件
            $Model->updateCache();
            //删除前台编译文件
            is_dir("./temp/hdcms/Content/Compile") and Dir::del("./temp/hdcms/Content/Compile");
            //删除编译文件
            is_dir('temp/Hdcms/Index') and dir::del('temp/Hdcms/Index');
            $this->success('操作成功');
        }
    }

}