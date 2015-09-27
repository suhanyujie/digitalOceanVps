<?php

/**
 * 文章附件上传(Thumb,Image,Images)
 * Class IndexControl
 * @author hdxj<houdunwangxj@gmail.com>
 */
class ContentUploadController extends Controller
{
    private $db;//模型

    //构造函数
    public function __init()
    {
        if (empty($_SESSION['user'])) {
            go("Index/Index/index");
        }
        $this->db = M('upload');
    }

    /**
     * Uploadify上传文件处理
     */
    public function hd_uploadify()
    {
        $uploadModel = M('upload');
        //上传文件类型
        if(isset($_POST['type'])){
            $type = str_replace('*.','',$_POST['type']);
            $type=explode(';',$type);
        }else{
            $type=array();
        }
        $size = Q('size') ? Q('size') : C('allow_size');
        $upload = new Upload(Q('upload_dir'),$type, $size);
        $file = $upload->upload();
        if (!empty($file)) {
            $file = $file[0];
            $file['uid'] = $_SESSION['user']['uid'];
            //图片加水印
            if ($file['image'] && Q('water')) {
                $img = new Image();
                $img->water($file['path']);
            }
            //写入upload表
            $uploadModel->add($file);
            $data = $file;
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
            $data['message'] = $upload->error;
        }
        echo json_encode($data);
        exit;
    }

    /**
     * 当修改图片的alt表单数据时，Ajax更改upload表中的name字段值
     */
    public function update_file_name()
    {
        $name = Q('name');
        $id = Q('id', null, 'intval');
        $this->db->save(array(
            "id" => $id,
            "name" => $name
        ));
    }

    //显示文件列表
    public function index()
    {
        //允许上传大小
        if ($allow_size = Q('allow_size', 0, 'intval')) {
            $allow_size = intval($allow_size) . 'MB';
        } else {
            $allow_size = intval(C('UPLOAD_ALLOW_SIZE') / pow(1024, 2)) . 'MB';
        }
        //水印按钮
        $waterbtn = $_SESSION['user']['admin'] ? 1 : 0;
        switch ($_GET['type']) {
            case 'thumb':
                $tag = array(
                    'type' => 'jpg,png,gif,jpeg',
                    'name' => "hdcms",
                    'limit' => 1,
                    'width' => 88,
                    'height' => 78,
                    'water' => C('WATER_ON'),
                    'waterbtn' => $waterbtn,
                    'dir'=>C('UPLOAD_PATH').'/Content/Thumb/'.date('y/m/d/')
                );
                break;
            case 'image':
                $tag = array(
                    'type' => 'jpg,png,gif,jpeg',
                    'size' => $allow_size,
                    'name' => "hdcms",
                    'limit' => 1,
                    'width' => 88,
                    'height' => 78,
                    'alt' => 1,
                    'water' => C('WATER_ON'),
                    'waterbtn' => $waterbtn,
                    'dir'=>C('UPLOAD_PATH').'/Content/Image/'.date('y/m/d/')
                );
                break;
            case 'images';
                $tag = array(
                    'type' => 'jpg,png,gif,jpeg',
                    'size' => $allow_size,
                    'name' => "hdcms",
                    'limit' => Q('num', 1),
                    'width' => 88,
                    'height' => 78,
                    'alt' => 1,
                    'water' => C('WATER_ON'),
                    'waterbtn' => $waterbtn,
                    'dir'=>C('UPLOAD_PATH').'/Content/Image/'.date('y/m/d/')
                );
                break;
            case 'files':
                $tag = array(
                    "type" => Q('filetype'),
                    'size' => $allow_size,
                    "name" => "hdcms",
                    "width" => 88,
                    "height" => 78,
                    'alt' => 1,
                    "limit" => Q('num', 1),
                    "waterbtn" => 0,
                    'dir'=>C('UPLOAD_PATH').'/Content/File/'.date('y/m/d/')
                );
                break;
            default:
                $this->error('参数错误');
        }
        $upload = tag("upload", $tag);
        $get = '';
        foreach ($_GET as $name => $v) {
            $get .= "var $name='$v';\n";
        }
        $this->assign('get', $get);
        $this->assign('upload', $upload);
        $this->site(); //站内图片
        $this->untreated(); //未使用图片
        $this->display();
    }

    /**
     * 站内文件
     */
    public function site()
    {
        //图片文件
        $isimage = in_array(Q('type'), array('image', 'images', 'thumb')) ? 1 : 0;
        //只查找自己的图片
        $where = 'uid=' . $_SESSION['user']['uid'] . " AND image={$isimage} AND status=1";
        $count = $this->db->where($where)->count();
        $page = new Page($count, 10, 8, '', '', __WEB__ . '?c=Admin&c=ContentUpload&a=site&type=' . Q('type'));
        $this->site_data = $this->db->where($where)->order("id DESC")->limit($page->limit())->all();
        $this->site_page = $page->show();
        if (ACTION == 'site') {
            $this->display('site');
        }
    }

    /**
     * 未使用的文件
     */
    public function untreated()
    {
        //图片文件
        $isimage = in_array(Q('type'), array('image', 'images', 'thumb')) ? 1 : 0;
        //只查找自己的图片
        $where = 'uid=' . $_SESSION['user']['uid'] . " AND image={$isimage} AND status=0";
        $count = $this->db->where($where)->count();
        $page = new Page($count, 10, 8, '', '', __WEB__ . '?m=Admin&c=ContentUpload&a=untreated&type=' . Q('type'));
        $this->untreated_data = $this->db->where($where)->order("id DESC")->limit($page->limit())->all();
        $this->untreated_page = $page->show();
        if (ACTION == 'untreated') {
            $this->display('untreated');
        }
    }

}