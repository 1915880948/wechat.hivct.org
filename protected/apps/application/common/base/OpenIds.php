<?php
/**
 * @category OpenIds
 * @created 2018/9/16 16:36
 * @since
 */

namespace application\common\base;

class OpenIds
{
    public static function getMomoOpenId()
    {
        return 'oVP2NjsmJtw0HQGI41wP9KJ9cW5Q';
    }

    public static function getGoukiOpenId()
    {
        return 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q';
    }

    public static function getDebugOpenIds()
    {
        return [self::getGoukiOpenId(), self::getMomoOpenId()];
    }
}
