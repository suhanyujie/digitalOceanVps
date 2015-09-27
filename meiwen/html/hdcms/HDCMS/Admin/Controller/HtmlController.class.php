<?php

/**
 * 静态处理模块
 * Class HtmlControl
 * @author 向军 <houdunwangxj@gmail.com>
 */
class HtmlController extends AuthController
{
    //生成首页
    public function createIndex()
    {
        if (IS_POST) {
            $html = new Html();
            if ($html->index()) {
                $this->success('首页生成完毕', __ACTION__);
            } else {
                $this->error('模板不存在');
            }
        } else {
            $this->display();
        }
    }

    //创建栏目
    public function createCategory()
    {
        if (IS_POST) {
            //没有选择栏目
            if (!isset($_POST['cid']) || count($_POST['cid']) == 1 && $_POST['cid'][0] == 0) {
                //生成所有栏目
                if ($mid = Q('post.mid')) { //生成指定模型栏目
                    $HtmlCategory = M('category')->where(array('mid' => $mid, 'cat_url_type' => 1))->all();
                } else {
                    $HtmlCategory = M('category')->where(array('cat_url_type' => 1))->all();
                }
            } else { //指定栏目
                $HtmlCategory = M('category')->where(array('cid' => $_POST['cid'], 'cat_url_type' => 1))->all();
            }
            if (empty($HtmlCategory)) {
                $this->success('栏目生成完毕', __ACTION__, 0);
            } else {
                $html = new Html();
                //最终生成的栏目
                $createCategory = array();
                foreach ($HtmlCategory as $cat) {
                    $html->category($cat['cid']);
                    $step_row = Q('step_row', 10, 'intval');
                    $cat['pageTotal'] = $GLOBALS['totalPage'];
                    $cat['currentPage'] = 1;
                    $cat['step_row'] = $step_row;
                    $createCategory[$cat['cid']] = $cat;
                }
                S('createCategoryFile', $createCategory);
                $this->success('栏目静态初始化完毕...', U('BatchCategory'), 0);
            }
        } else {
            $this->assign('category', json_encode(S("category")));
            $this->assign('model', S("model"));
            $this->display();
        }
    }

    //批量生成栏目
    public function BatchCategory()
    {
        $createCategory = S('createCategoryFile');
        if (empty($createCategory)) {
            S('createCategoryFile', null);
            $this->success('所有栏目生成完毕', U('createCategory'), 0);
        } else {
            $html = new Html();
            $category = current($createCategory);
            for ($i = 0; $i <= $category['step_row']; $i++) {
                $html->category($category['cid'], $category['currentPage']);
                $category['currentPage']++;
                if ($category['currentPage'] > $category['pageTotal']) {
                    unset($createCategory[$category['cid']]);
                    S('createCategoryFile', $createCategory);
                    $this->success("栏目[{$category['catname']}]生成完毕...", __ACTION__, 0);
                }
            }
            $createCategory[$category['cid']] = $category;
            S('createCategoryFile', $createCategory);
            $message = "生成栏目{$category['catname']}的下" . $category['step_row'] . "页,共有{$category['pageTotal']}页(<font color='red'>" . floor($category['currentPage'] / $category['pageTotal'] * 100) . "%</font>)";
            $this->success($message, __ACTION__, 0);
        }
    }

    //生成内容页
    public function createContent()
    {
        if (IS_POST) {
            //没有选择栏目
            if (empty($_POST['cid']) || count($_POST['cid']) == 1 && $_POST['cid'][0] == 0) {
                //生成所有栏目
                if (empty($_POST['mid']) || $_POST['mid'] == 0) {
                    $HtmlCategory = S('category');;
                } else {
                    $HtmlCategory = M('category')->where(array('mid' => $_POST['mid']))->all();
                }
            } else {
                $HtmlCategory = M('category')->where(array('cid' => $_POST['cid']))->all();
            }
            if (empty($HtmlCategory)) {
                S('createContentFile', null);
                $this->success('所有文章生成完毕', U('create_content'), 0);
            } else {
                //指定条件更新
                $where = array();
                if (isset($_POST['type']) && $_POST['type'] != 'all') {
                    //更新最新发布N条
                    if (!empty($_POST['total_row'])) {
                        $total_row = $_POST['total_row'];
                    }
                    //发布时间
                    if (!empty($_POST['start_time']) && !empty($_POST['end_time'])) {
                        $where[] = 'addtime>=' . strtotime($_POST['start_time']) . " AND addtime<=" . strtotime($_POST['end_time']);
                    }
                    //起始与结束aid
                    if (!empty($_POST['start_id']) && !empty($_POST['end_id'])) {
                        $where[] = 'aid>=' . $_POST['start_id'] . " AND aid<=" . $_POST['end_id'];
                    }
                }
                $modelCache = S('model');;
                //最终生成的栏目
                $createCategory = array();
                foreach ($HtmlCategory as $cat) {
                    $cat['options']['step_row'] = Q('step_row', 20, 'intval');
                    $cat['options']['currentNum'] = 0;
                    $cat['options']['where'] = $where;
                    $cat['options']['where'][] = 'category.cid=' . $cat['cid'];
                    //总条数
                    if (isset($total_row)) {
                        $cat['options']['total_row'] = $total_row;
                    } else {
                        $table = $modelCache[$cat['mid']]['table_name'];
                        $cat['options']['total_row'] = M($table)->count();
                    }
                    $createCategory[$cat['cid']] = $cat;
                }
                S('createContentFile', $createCategory);
                $this->success('生成内容页初始化完毕...', U('BatchContent'), 0);
            }
        } else {
            $this->assign('category', json_encode(S('category')));
            $this->assign('model', S('model'));
            $this->display();
        }
    }

    //指生成内容页
    public function BatchContent()
    {
        $createCategory = S('createContentFile');
        if (empty($createCategory)) {
            $this->success('所有文章生成完毕...', U('createContent'), 0);
        }
        $html = new Html();
        $oldCategory = $createCategory;
        foreach ($oldCategory as $id => $category) {
            $options = $category['options'];
            $contentModel = ContentViewModel::getInstance($category['mid']);
            $limit = $options['currentNum'] . ',' . $options['step_row'];
            $contentData = $contentModel->where($options['where'])->limit($limit)->all();
            if (empty($contentData)) {
                unset($createCategory[$id]);
                S('createContentFile', $createCategory);
                $this->success("[{$category['catname']}]文章生成完毕...", __ACTION__, 0);
            }
            foreach ($contentData as $content) {
                $html->content($content['mid'], $content['aid']);
            }
            $options['currentNum'] = $options['currentNum'] + $options['step_row'] - 1;
            if ($options['currentNum'] >= $options['total_row']) {
                unset($createCategory[$id]);
                S('createContentFile', $createCategory);
                $this->success("[{$category['catname']}] 生成完毕...", __ACTION__, 0);
            } else {
                $createCategory[$id]['options'] = $options;
                S('createContentFile', $createCategory);
                $createCategory[$id]['options'] = $options;
                $message = "[{$category['catname']}]
                                已经更新{$options['currentNum']}条
                                (<font color='red'>" . floor($options['currentNum'] / $options['total_row'] * 100) . "%</font>)";
                $this->success($message, __ACTION__, 0);
            }
        }
    }

}