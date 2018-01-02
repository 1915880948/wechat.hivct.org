<?php
/**
 * @category BaseService
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 02/01/2018 18:14
 * @since
 */

namespace application\models\service;

use yii\base\Component;

class BaseService extends Component
{
    public $options = [
        'gender'    => ["男", "女"],
        'education' => ["文盲", "小学", "初中", "高中/中专", "大专/大学", "研究生及以上"],
        'marriage'  => ["未婚", "已婚", "同居", "离异或丧偶", "保密"],
        'job'       => ["学生", "餐饮食品业", "商业服务业", "医务人员", "自由职业", "离退休人员", "待业", "其他"],
        'income'    => ["无收入", "0-1000元", "1001-2999元", "3000-4999元", "5000-9999元", "10000-19999元", "2万元以上"],
        'household' => ['本市', '本省外市', '外省', '外籍'],
        'livetime'  => ['<3月', '3-6月', '6月-1年', '1-5年', '5年以上'],
        'nation'    => [
            "汉族",
            "壮族",
            "满族",
            "回族",
            "苗族",
            "维吾尔族",
            "土家族",
            "彝族",
            "蒙古族",
            "藏族",
            "布依族",
            "侗族",
            "瑶族",
            "朝鲜族",
            "白族",
            "哈尼族",
            "哈萨克族",
            "黎族",
            "傣族",
            "畲族",
            "傈僳族",
            "仡佬族",
            "东乡族",
            "高山族",
            "拉祜族",
            "水族",
            "佤族",
            "纳西族",
            "羌族",
            "土族",
            "仫佬族",
            "锡伯族",
            "柯尔克孜族",
            "达斡尔族",
            "景颇族",
            "毛南族",
            "撒拉族",
            "布朗族",
            "塔吉克族",
            "阿昌族",
            "普米族",
            "鄂温克族",
            "怒族",
            "京族",
            "基诺族",
            "德昂族",
            "保安族",
            "俄罗斯族",
            "裕固族",
            "乌孜别克族",
            "门巴族",
            "鄂伦春族",
            "独龙族",
            "塔塔尔族",
            "赫哲族",
            "珞巴族"
        ],
    ];
}
