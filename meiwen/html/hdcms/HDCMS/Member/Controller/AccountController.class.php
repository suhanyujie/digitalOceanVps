<?php

/**
 * 修改个人资料
 * Class AccountController
 * @author 后盾向军 <houdunwangxj@gmail.com>
 */
class AccountController extends AuthController
{
    private $db;

    //构造函数
    public function __init()
    {
        $this->db = K('Account');
    }

    //修改个人资料
    public function personal()
    {
        if (IS_POST) {
            if ($this->db->personal()) {
                $this->success('修改资料成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $field = M('user')->find($_SESSION['user']['uid']);
            $this->assign('field', $field);
            $this->display();
        }
    }

    //设置密码
    public function setPassword()
    {
        if (IS_POST) {
            if ($this->db->setPassword()) {
                $this->success('修改密码成功');
            } else {
                $this->error($this->db->error);
            }
        } else {
            $this->display();
        }
    }

    //设置头像
    public function setIcon()
    {
        if (IS_POST) {
            //头像文件
            $file = $_POST['img_face'];
            $dst_image = imagecreatetruecolor(250, 250);
            $fileInfo = getimagesize($file);
            switch ($fileInfo[2]) {
                case 1://gif
                    $src_image = imagecreatefromgif($file);
                    break;
                case 2://jpeg
                    $src_image = imagecreatefromjpeg($file);
                    break;
                case 3://png
                    $src_image = imagecreatefrompng($file);
                    break;
            }
            //裁切图片
            $dst_x = $dst_y = 0;
            $dst_w = $dst_h = 250;
            $src_x = $_POST['x1'];
            $src_y = $_POST['y1'];
            $src_w = $_POST['w'];
            $src_h = $_POST['h'];
            imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
            switch ($fileInfo[2]) {
                case 1:
                    imagegif($dst_image, $file, 100);
                    break;
                case 2:
                    imagejpeg($dst_image, $file, 100);
                    break;
                case 3:
                    imagepng($dst_image, $file, 100);
                    break;
            }
            if (is_file($file) && getimagesize($file)) {
                //修改用户表
                M("user")->save(array('uid' => $_SESSION['user']['uid'], 'icon' => $file));
                $_SESSION['user']['icon'] = __ROOT__ . '/' . $file;
            }
            $this->success('修改成功');
        } else {
            $this->display();
        }
    }

    //Uploadify上传头像文件
    public function uploadFace()
    {
        //关闭水印
        C('WATER_ON', false);
        $dir = 'upload/user/' . date("Y/m/d/");
        $upload = new Upload($dir);
        $file = $upload->upload();
        if (empty($file)) {
            $this->ajax(array('status' => 0, 'error' => $file->error));
        } else {
            $file = $file[0];
            $img = new Image();
            $img->thumb($file['path'], $file['path'], 250, 250, 6);
            $this->ajax(array('status' => 1, 'url' => $file['url'], 'path' => $file['path']));
        }
    }
}