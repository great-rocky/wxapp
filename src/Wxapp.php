<?php

namespace Rocky\Wxapp;


class Wxapp
{
    public static function codeToSession($appId, $appSecret, $code)
    {
        //doc: https://mp.weixin.qq.com/debug/wxadoc/dev/api/api-login.html#wxloginobject
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=$appId&secret=$appSecret&js_code=$code&grant_type=authorization_code";
        return json_decode(file_get_contents($url), true);
    }

    public static function decryptOpenGId($appId, $sessionKey, $encryptedData, $iv)
    {
        $r = self::decrypt($appId, $sessionKey, $encryptedData, $iv);
        $data = json_decode($r['data']);
        return isset($data->openGId) ? $data->openGId : false;
    }

    public static function decryptUserInfo($appId, $sessionKey, $encryptedData, $iv)
    {
        $r = self::decrypt($appId, $sessionKey, $encryptedData, $iv);
        return json_decode($r['data'], true);
    }

    public static function decrypt($appId, $sessionKey, $encryptedData, $iv)
    {
        //doc: https://mp.weixin.qq.com/debug/wxadoc/dev/api/signature.html
        $pc = new WXBizDataCrypt($appId, $sessionKey);
        $errCode = $pc->decryptData($encryptedData, $iv, $data);
        return ['errCode' => $errCode, 'data' => $data];
    }
}