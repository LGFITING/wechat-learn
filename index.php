<?php

include './wechat-php-sdk/wechat.class.php';

$options = array(
    'token' => 'LG', //填写你设定的key
    'encodingaeskey' => '', //填写加密用的EncodingAESKey
    'appid' => 'wxd8e911e6cf0b7ed0', //填写高级调用功能的app id
    'appsecret' => '87dc05c99d168869fd9ecd6f213196ef' //填写高级调用功能的密钥
);
$weObj = new Wechat($options);
$weObj->valid(); //明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
$type = $weObj->getRev()->getRevType();
switch ($type) {
    case Wechat::MSGTYPE_TEXT:
        $weObj->text("hello, I'm wechat")->reply();
        exit;
        break;
    case Wechat::MSGTYPE_EVENT:
        break;
    case Wechat::MSGTYPE_IMAGE:
        break;
    default:
        $weObj->text("help info")->reply();
}
$data = ' {
     "button":[
     {	
          "type":"click",
          "name":"今日歌曲",
          "key":"V1001_TODAY_MUSIC"
      },
      {
           "name":"菜单",
           "sub_button":[
           {	
               "type":"view",
               "name":"搜索",
               "url":"http://www.soso.com/"
            },
            {
               "type":"view",
               "name":"视频",
               "url":"http://v.qq.com/"
            },
            {
               "type":"click",
               "name":"赞一下我们",
               "key":"V1001_GOOD"
            }]
       }]
 }';
$weObj->createMenu($data);