<?php

use application\models\base\SystemMenu;
use qiqi\helper\TreeHelper;
use yii\helpers\ArrayHelper;

/**
 * @category ${NAME}
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/28 14:08
 * @since
 */
function adminMenuData()
{
    $query = SystemMenu::find()
                       ->andWhere(['status' => 1]);
    return TreeHelper::getInstance(['model' => $query])
                     ->tree();
}

function adminMenuActive($menus, $isFirst = false)
{
    if($isFirst == true){
        return true;
    }
    $url = yRequest()->getPathInfo();
    $urls = explode("/", $url);
    $urlprefix = $urls[0];
    if(count($urls) == 1){
        $url .= "/index";
    }
    $actions = [];
    foreach($menus as $menu){
        $actions[] = $menu['action'];
        list($actions[]) = explode("/", $menu['action']);
    }
    if(in_array($url, $actions)){
        return true;
    }
    return false;
}

function adminGetAidsStatus($aidsResult = null)
{
    $checkArr = [
        '0' => '未检测',
        '1' => '阴性',
        '2' => '阳性',
        '3' => '检测失败'
    ];
    if($aidsResult === null){
        return $checkArr;
    }
    return ArrayHelper::getValue($checkArr, $aidsResult, '未知');
}

function adminConfirmStatus($status)
{
    $arr = [0 => '否', 1 => '是'];
    return ArrayHelper::getValue($arr, $status, '否');
}
