<?php

/**
 * 路由设置
 * Class RouteModel
 * @author 后盾向军 <230071698@qq.com>
 */
class RouteModel extends Model
{
    public $table = 'route';

    /**
     * 添加路由
     * @return bool
     */
    public function addRoute()
    {
        //清空
        $this->truncate('route');
        foreach ($_POST['route'] as $id => $route) {
            $data = array(
                'title' => $_POST['title'][$id],
                'route' => $_POST['route'][$id],
                'url' => $_POST['url'][$id]
            );
            if (!$this->add($data)) {
                $this->error = '添加失败';
                return false;
            }
        }
        //配置文件
        $route = $this->getField('route,url');
        $content = "<?php if(!defined('HDPHP_PATH'))exit;\nreturn " . var_export($route,true) . ";\n?>";
        if (file_put_contents('HDCMS/Common/Config/route.inc.php', $content)) {
            return true;
        } else {
            $this->error = '生成配置文件失败';
            return false;
        }
    }
}