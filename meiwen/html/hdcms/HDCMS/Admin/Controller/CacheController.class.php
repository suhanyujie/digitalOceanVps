<?php

/**
 * 更新缓存
 * @author hdxj <houdunwangxj@gmail.com>
 */
class CacheController extends AuthController
{
    public function updateCache()
    {
        $actionCache = S('updateCacheAction');
        if ($actionCache) {
            while ($action = array_shift($actionCache)) {
                switch ($action) {
                    case "Config" :
                        $Model = K("Config");
                        $Model->updateCache();
                        S('updateCacheAction',$actionCache);
                        $this->success('网站配置更新完毕...', U('updateCache'), 0);
                        break;
                    case "Model" :
                        $Model = K("Model");
                        $Model->updateCache();
                        S('updateCacheAction',$actionCache);
                        $this->success('模型更新完毕...', U('updateCache'), 0);
                        break;
                    case "Field" :
                        $ModelCache = S("model");
                        foreach ($ModelCache as $mid => $data) {
                            $_REQUEST['mid'] = $mid;
                            $Model = new FieldModel();
                            $Model->updateCache($mid);
                        }
                        S('updateCacheAction',$actionCache);
                        $this->success('字段更新完毕...', U('updateCache'), 0);
                        break;
                    case "Category" :
                        $Model = K('Category');
                        $Model->updateCache();
                        S('updateCacheAction',$actionCache);
                        $this->success('栏目更新完毕...', U('updateCache'), 0);
                        break;
                    case "Flag" :
                        $ModelCache = S("model");
                        foreach ($ModelCache as $mid => $data) {
                            $_REQUEST['mid'] = $mid;
                            $Model = new FlagModel();
                            $Model->updateCache();
                        }
                        S('updateCacheAction',$actionCache);
                        $this->success('Flag属性更新完毕...', U('updateCache'), 0);
                        break;
                }
            }
            go('updateCache');
        } else {
            S('updateCacheAction', null);
            $this->success('缓存更新成功...<script>setTimeout(function(){top.location.href="' . __MODULE__ . '"},2000);</script>', U('index'));
        }
    }

    //结束
    public function index()
    {
        if (IS_POST) {
            is_file(TEMP_PATH . '~Boot.php') && unlink(TEMP_PATH . '~Boot.php');
            Dir::del('Temp/Compile');
            Dir::del('Temp/Content');
            Dir::del('Temp/Table');
            //缓存更新动作
            S('updateCacheAction', $_POST['Action']);
            $this->success('准备更新...', U('updateCache', array('action' => 'Config')), 1);
        } else {
            $this->display();
        }
    }

}
