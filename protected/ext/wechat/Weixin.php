<?php
/**
 * @category Weixin
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/6/10 09:37
 * @since
 */

namespace wechat;

use EasyWeChat\Foundation\Application;
use yii\helpers\Json;

/**
 * Class Weixin
 * 与开放平台共用accesstoken
 * @package wechat
 */
class Weixin
{
    const WECHAT_TOKEN_CACHE_KEY = 'cache:wechat_token';

    /**
     * @return Application
     */
    public static function getApp()
    {
        $weixin = new Application(self::getOptions());
        self::getAccessToken($weixin);
        return $weixin;
    }

    /**
     * @param Application|null $weixin
     * @return string
     */
    public static function getAccessToken(Application $weixin = null)
    {
        if($weixin === null || !($weixin instanceof Application)){
            $weixin = new Application(self::getOptions());
        }

        $wxToken = Json::decode(\Yii::$app->rediscache->get(self::WECHAT_TOKEN_CACHE_KEY));
        if(!$wxToken || (time() > $wxToken['expires_in'])){//获取
            $wxToken = $weixin->access_token->getTokenFromServer();
            $wxToken['expires_in'] = time() + $wxToken['expires_in'] - 1200;
            \Yii::$app->rediscache->set(self::WECHAT_TOKEN_CACHE_KEY, Json::encode($wxToken));
        }
        $weixin->access_token->setToken($wxToken['access_token']);
        return $wxToken['access_token'];
        n($token['access_token']);
        return $token['access_token'];
    }

    protected static function getOptions()
    {
        return [
            'debug'       => env('WECHAT_DEBUG'),
            'app_id'      => env('WECHAT_APP_KEY'),
            'secret'      => env('WECHAT_APP_SECRET'),
            'token'       => env('WECHAT_APP_TOKEN'),
            'aes_key'     => env('WECHAT_AES_KEY'), // 可选
            'log'         => [
                'level' => 'debug',
                'file'  => sys_get_temp_dir() . '/easywechat_survey.hivct.org.log', // XXX: 绝对路径！！！！
            ],
            'guzzle'      => [
                'timeout' => 30,
            ],
            'max_retries' => 3

        ];
    }
}
