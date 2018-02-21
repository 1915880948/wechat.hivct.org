<?php
/**
 * @category ${NAME}
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/9/3 23:33
 * @since
 */

use application\web\www\modules\virtual\Module;

return [
    'id'    => basename(__DIR__),//如果需要和目录同名，就这样写
    'class' => Module::class
];
