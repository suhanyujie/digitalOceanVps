<?php

/**
 * 水印配置模型
 * Class ConfigModel
 * @author hdxj <2300071698@qq.com>
 */
class WaterModel extends Model
{
    public $table = "config";

    /**
     * 修改
     * @return int
     */
    public function editConfig()
    {
        foreach ($_POST as $name => $value) {
            $map['name'] = array('EQ', $name);
            $data = array('value' => $value);
            $this->where($map)->save($data);
        }
        //更新缓存
        return $this->updateCache();
    }

    /**
     * 更新配置文件
     * @return int
     */
    public function updateCache()
    {
        $configData = $this->order('order_list ASC')->all();
        $data = array();
        foreach ($configData as $c) {
            $name = strtoupper($c['name']);
            $data[$name] = $c['value'];
        }
        //写入配置文件
        $content = "<?php if (!defined('HDPHP_PATH')) exit; \nreturn " . var_export($data, true) . ";\n?>";
        return file_put_contents(APP_CONFIG_PATH . "config.inc.php", $content);
    }
}