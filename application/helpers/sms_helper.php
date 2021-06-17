<?php

/**
 * 获取谷歌验证码“secret”与“二维码链接”
 *
 * @return array
 * @throws Exception
 */
function getQRCodeGoogleUrl(){
    require_once './GoogleAuthenticator.php';
    $ga = new PHPGangsta_GoogleAuthenticator(); //"安全密匙SecretKey" 入库,和账户关系绑定,客户端也是绑定这同一个"安全密匙SecretKey"
    $secret = $ga->createSecret(); //这是生成的密钥，每个用户唯一一个，为用户保存起来用于验证
    $url = $ga->getQRCodeGoogleUrl('谷歌验证器', $secret);
    return array($secret, $url);
}

/**
 * 验证谷歌验证码
 *
 * @param $secret
 * @param $code
 * @return bool
 */
function verifyGoogleCode($secret, $code){
    require_once './GoogleAuthenticator.php';
    $ga = new PHPGangsta_GoogleAuthenticator();
    return $ga->verifyCode($secret, $code, 2);
}