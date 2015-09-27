<?php
/**
 * Created by PhpStorm.
 * User: uctoo
 * Date: 15-4-7
 * Time: 上午11:26
 * @author:patrick admin@uctoo.com
 */

function addWeixinLog($data, $data_post = '') {
    $log ['cTime'] = time ();
    $log ['cTime_format'] = date ( 'Y-m-d H:i:s', $log ['cTime'] );
    $log ['data'] = is_array ( $data ) ? serialize ( $data ) : $data;
    $log ['data_post'] = is_array ( $data_post ) ? serialize ( $data_post ) : $data_post;
    M ( 'weixin_log' )->add ( $log );
}

// 获取当前用户的Token
function get_token($token = NULL) {
    if ($token !== NULL) {
        session ( 'token', $token );
    } elseif (! empty ( $_REQUEST ['token'] )) {
        session ( 'token', $_REQUEST ['token'] );
    }
    $token = session ( 'token' );
    if (empty ( $token )) {
        $token = session('user_auth.token');
    }
    if (empty ( $token )) {
        return - 1;
    }

    return $token;
}

// 获取公众号的信息   TODO:有bug隐患，存在不同管理员在系统中添加了相同公众号的情况
function get_token_appinfo($token = '') {
    empty ( $token ) && $token = get_token ();
    $map ['public_id'] = $token;
    $info = M ( 'member_public' )->where ( $map )->find ();
    return $info;
}

function get_mpid_appinfo($mp_id = '') {
    empty ( $mp_id ) && $mp_id = get_mpid ();
    $map ['id'] = $mp_id;
    $info = M ( 'member_public' )->where ( $map )->find ();
    return $info;
}
// 获取公众号的信息
function get_token_appname($token = '') {
    empty ( $token ) && $token = get_token ();
    $map ['public_id'] = $token;
    $info = M ( 'member_public' )->where ( $map )->find ();
    return $info['public_name'];
}

// 判断是否是在微信浏览器里
function isWeixinBrowser() {
    $agent = $_SERVER ['HTTP_USER_AGENT'];
    if (! strpos ( $agent, "icroMessenger" )) {
        return false;
    }
    return true;
}

// php获取当前访问的完整url地址
function GetCurUrl() {
    $url = 'http://';
    if (isset ( $_SERVER ['HTTPS'] ) && $_SERVER ['HTTPS'] == 'on') {
        $url = 'https://';
    }
    if ($_SERVER ['SERVER_PORT'] != '80') {
        $url .= $_SERVER ['HTTP_HOST'] . ':' . $_SERVER ['SERVER_PORT'] . $_SERVER ['REQUEST_URI'];
    } else {
        $url .= $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
    }
    // 兼容后面的参数组装
    if (stripos ( $url, '?' ) === false) {
        $url .= '?t=' . time ();
    }
    return $url;
}
// 获取当前用户的OpenId
function get_openid($openid = NULL) {
    $mp_id = get_mpid ();
    if ($openid !== NULL) {
        session ( 'openid_' . $mp_id, $openid );
    } elseif (! empty ( $_REQUEST ['openid'] )) {
        session ( 'openid_' . $mp_id, $_REQUEST ['openid'] );
    }
    $openid = session ( 'openid_' . $mp_id );
    trace($mp_id.'wechat：openid'.$openid,'微信','DEBUG',true);
    $isWeixinBrowser = isWeixinBrowser ();
    //下面这段应该逻辑没问题，如果公众号配置信息错误或者没有snsapi_base作用域的获取信息权限可能会出现死循环，注释掉以下if可治愈
    if ( $openid <= 0 && $isWeixinBrowser) {
        trace('wechat：openid1'.$openid,'微信','DEBUG',true);
        $callback = GetCurUrl ();
       // OAuthWeixin ( $callback );
        $info = get_mpid_appinfo ();
        trace('wechat：OAuthWeixin'.$info['id'],'微信','DEBUG',true);

        $options['token'] = APP_TOKEN;
        $options['appid'] = $info['appid'];    //初始化options信息
        $options['appsecret'] = $info['secret'];
        $options['encodingaeskey'] = $info['encodingaeskey'];
        $auth = new Com\Wxauth($options);
        $openid =  $auth->open_id;
        trace('wechat：openid3'.$openid,'微信','DEBUG',true);
    }

    if (empty ( $openid )) {
        return - 1;
    }
    trace($mp_id.'wechat：openid2'.$openid,'微信','DEBUG',true);
    return $openid;
}

function OAuthWeixin($callback) {
    $isWeixinBrowser = isWeixinBrowser ();
    $info = get_mpid_appinfo ();
    trace('wechat：OAuthWeixin'.$info['id'],'微信','DEBUG',true);
    if (! $isWeixinBrowser || $info ['type'] != 2 || empty ( $info ['appid'] )) {
        redirect ( $callback . '&openid=-1' );
    }
    $param ['appid'] = $info ['appid'];

    if (! isset ( $_GET ['getOpenId'] )) {
        $param ['redirect_uri'] = $callback . '&getOpenId=1';
        $param ['response_type'] = 'code';
        $param ['scope'] = 'snsapi_base';
        $param ['state'] = 123;
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?' . http_build_query ( $param ) . '#wechat_redirect';
        trace('OAuthWeixin111'.$url,'微信','DEBUG',true);
        redirect ( $url );
    } elseif ($_GET ['state']) {
        $param ['secret'] = $info ['secret'];
        $param ['code'] = I ( 'code' );
        $param ['grant_type'] = 'authorization_code';

        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?' . http_build_query ( $param );
        $content = file_get_contents ( $url );
        $content = json_decode ( $content, true );
        trace('wechat：OAuthWeixin222'.arr2str($param),'微信','DEBUG',true);
        trace('wechat：OAuthWeixin333'.$content ['openid'] ,'微信','DEBUG',true);
        redirect ( $callback . '&openid=' . $content ['openid'] );
    }
}

// 获取当前上下文的公众号id
function get_mpid($mp_id = NULL) {
    if ($mp_id !== NULL) {
        session ( 'mp_id', $mp_id );
    } elseif (! empty ( $_REQUEST ['mp_id'] )) {
        session ( 'mp_id', $_REQUEST ['mp_id'] );
    }
    $mp_id = session ( 'mp_id' );
    if (empty ( $mp_id )) {
        $mp_id = session('user_auth.mp_id');
    }
    if (empty ( $mp_id )) {
        $map['uid'] = is_login();
        $map['public_id'] = get_token();
        $mp =  D('Mpbase/MemberPublic')->where($map)->find();  //所登陆会员帐号当前管理的公众号
        $mp_id = $mp['id'];
    }
    if (empty ( $mp_id )) {
        return - 1;
    }

    return $mp_id;
}