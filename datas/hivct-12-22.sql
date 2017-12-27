/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50635
 Source Host           : localhost:3306
 Source Schema         : hivct

 Target Server Type    : MySQL
 Target Server Version : 50635
 File Encoding         : 65001

 Date: 22/12/2017 19:55:07
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `aid` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(100) NOT NULL DEFAULT '' COMMENT '账号',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `nickname` varchar(100) NOT NULL DEFAULT '' COMMENT '昵称',
  `login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `login_ip` varchar(50) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `is_super` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of admins
-- ----------------------------
BEGIN;
INSERT INTO `admins` VALUES (1, 'admin', '$2y$10$PKjrqAy3O9F7a4Htbep2du8fN7NpWo08Q96tH7yBznK/VMnNu1aYW', '管理员', 0, '', 1);
COMMIT;

-- ----------------------------
-- Table structure for answers
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '订单号',
  `refund_no` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '退款单号',
  `data` text CHARACTER SET utf8 NOT NULL COMMENT '表单 JSON数据',
  `form_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '表单名称',
  `fee` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '押金',
  `postage` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '邮费',
  `other_fee` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '其他费用',
  `status` tinyint(3) NOT NULL DEFAULT '10' COMMENT '订单状态， 0=删除/订单失效，5=未付款，7=付款失败，10=待审核，15=申请审核失败，20=通过申请，25=已反馈待审核，30=反馈审核失败，35=退款中，40=退款失败，45=转入代发，50=未确定，需要商户原退款单号重新发起，60=退款成功，100=已完成',
  `express` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '快递公司',
  `express_no` varchar(200) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '快递单号',
  `reject_apply_cause` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '拒绝申请原因',
  `feedback_fail_cause` varchar(255) CHARACTER SET utf8 DEFAULT '' COMMENT '反馈审核失败原因',
  `add_time` int(10) NOT NULL DEFAULT '0',
  `upd_time` int(10) NOT NULL,
  `uid` int(10) NOT NULL DEFAULT '0' COMMENT '对应用户ID',
  `prepay_id` varchar(64) DEFAULT NULL COMMENT '微信预支付ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(100) NOT NULL DEFAULT '' COMMENT '键',
  `value` text NOT NULL COMMENT '值',
  `expire_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for express
-- ----------------------------
DROP TABLE IF EXISTS `express`;
CREATE TABLE `express` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of express
-- ----------------------------
BEGIN;
INSERT INTO `express` VALUES (1, '中通', '', '', 1, '2017-12-22 10:58:51');
INSERT INTO `express` VALUES (2, '申通', '', '', 1, '2017-12-22 11:00:41');
INSERT INTO `express` VALUES (3, '圆通', '', '', 1, '2017-12-22 11:16:29');
INSERT INTO `express` VALUES (5, '顺风', '', '', 1, '2017-12-22 11:21:25');
INSERT INTO `express` VALUES (6, '韵达', '', '', 1, '2017-12-22 11:23:37');
COMMIT;

-- ----------------------------
-- Table structure for feedback
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ord_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `raw_filename` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '原始文件名',
  `filename` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件名',
  `savepath` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件保存路径',
  `ext` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '文件扩展',
  `size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for fields
-- ----------------------------
DROP TABLE IF EXISTS `fields`;
CREATE TABLE `fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '显示名称',
  `field` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '字段名',
  `type` varchar(255) NOT NULL DEFAULT '' COMMENT '输入框类型',
  `data` text CHARACTER SET utf8 COMMENT '下拉框、单选框、复选框的数据，',
  `default_value` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '默认值',
  `hint` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '输入框提示信息',
  `required` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否必填：0=否，1=是',
  `regex` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '其他验证规则（正则表达式）',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '上级',
  `fm_id` int(10) NOT NULL DEFAULT '0' COMMENT '[FK] forms.id',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of fields
-- ----------------------------
BEGIN;
INSERT INTO `fields` VALUES (18, '收货信息', 'shouhuoxinxi', '', '', '', '', 0, '', 0, 6, 0);
INSERT INTO `fields` VALUES (19, '免费试剂', 'mianfeishiji', 'product', '', '', '', 1, '', 18, 6, 0);
INSERT INTO `fields` VALUES (20, '收货人', 'shouhuoren', 'input', '', '', '请输入收货人地址', 1, '', 18, 6, 0);
INSERT INTO `fields` VALUES (21, '收货手机', 'shouhuoshouji', 'input', '', '', '', 1, '', 18, 6, 0);
INSERT INTO `fields` VALUES (22, '收货地址', 'shouhuodizhi', 'addrbox', '', '', '', 1, '', 18, 6, 0);
INSERT INTO `fields` VALUES (23, '收货详细地址', 'shouhuoxiangxidizhi', 'input', '', '', '', 1, '', 18, 6, 0);
INSERT INTO `fields` VALUES (24, '留言备注', 'liuyanbeizhu', 'textarea', '', '', '', 0, '', 18, 6, 0);
INSERT INTO `fields` VALUES (25, '个人信息', 'gerenxinxi', '', '', '', '', 0, '', 0, 6, 0);
INSERT INTO `fields` VALUES (26, '真实姓名', 'zhenshixingming', 'input', '', '', '', 1, '', 25, 6, 0);
INSERT INTO `fields` VALUES (27, '性别', 'xingbie', 'radio', '男=nan|女=nv', '', '', 1, '', 25, 6, 0);
INSERT INTO `fields` VALUES (28, '出生年月', 'chushengnianyue', 'date', '', '', '', 1, '', 25, 6, 0);
INSERT INTO `fields` VALUES (29, '年龄', 'nianling', 'number', '', '', '', 1, '', 25, 6, 0);
INSERT INTO `fields` VALUES (30, '邮箱', 'youxiang', 'input', '', '', '', 0, '', 25, 6, 0);
INSERT INTO `fields` VALUES (31, '联系电话', 'lianxidianhua', 'input', '', '', '', 1, '', 25, 6, 0);
INSERT INTO `fields` VALUES (32, 'QQ', 'QQ', 'input', '', '', '', 0, '', 25, 6, 0);
INSERT INTO `fields` VALUES (33, '微信', 'weixin', 'input', '', '', '', 0, '', 25, 6, 0);
INSERT INTO `fields` VALUES (34, '补充信息', 'buchongxinxi', '', '', '', '', 0, '', 0, 6, 0);
INSERT INTO `fields` VALUES (35, '文化程度', 'wenhuachengdu', 'select', '文盲=wenmang|小学=xiaoxue|初中=chuzhong|高中/中专=gaozhongzhongzhuan|大专/大学=dazhuandaxue|研究生及以上=yanjiushengjiyishang', '', '', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (36, '婚姻状况', 'hunyinzhuangkuang', 'select', '未婚=weihun|男性同居=nanxingtongju|已婚有配偶=yihunyoupeiou|离异或丧偶=liyihuosangou|不详=buxiang', '', '', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (37, '主要职业', 'zhuyaozhiye', 'select', '全职工作（包括自由职业）=quanzhigongzuobaokuoziyouzhiye|钟点工=zhongdiangong|学生=xuesheng|没有工作=meiyougongzuo|离退休=lituixiu', '', '', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (38, '月平均收入', 'yuepingjunshouru', 'select', '无收入=wushouru|学生=xuesheng|1000元以下=1000yuanyixia|1000~2999元=10002999yuan|3000~4999元=30004999yuan|5000~9999元=50009999yuan|10000元及以上=10000yuanjiyishang', '', '', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (81, '您第一次与男性发生性行为的年龄', 'nindiyiciyunanxingfashengxingxingweidenianling', 'input', '', '', '没有请输入无', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (82, '您的性取向', 'nindexingquxiang', 'select', '同性=tongxing|异性=yixing|双性=shuangxing|不确定=buqueding', '', '', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (83, '您有肛交行为吗', 'ninyougangjiaoxingweima', 'select', '有=you|没有=meiyou', '', '', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (84, '您的性角色是', 'nindexingjueseshi', 'select', '完全是主动肛交=wanquanshizhudonggangjiao|主要是主动肛交=zhuyaoshizhudonggangjiao|两者兼有，两者差不多=liangzhejianyouliangzhechabuduo|主要是被动肛交=zhuyaoshibeidonggangjiao|完全被动肛交=wanquanbeidonggangjiao|无肛交=wugangjiao', '', '', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (85, '近三个月您有多少个女性性伴', 'jinsangeyueninyouduoshaogenvxingxingban', 'input', '', '', '没有请输入0或无', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (86, '近三个月您有多少个男性性伴', 'jinsangeyueninyouduoshaogenanxingxingban', 'input', '', '', '', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (87, '最近三个月与男行肛交时是否每次都是用了安全套', 'zuijinsangeyueyunanxinggangjiaoshishifoumeicidoushiyongleanquantao', 'radio', '是=shi|否=fou', '', '', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (88, '最近一次（三个月内）与男性肛交时是否使用了安全套', 'zuijinyicisangeyueneiyunanxinggangjiaoshishifoushiyongleanquantao', 'radio', '是=shi|否=fou', '', '', 1, '', 34, 6, 0);
INSERT INTO `fields` VALUES (89, '艾滋病快速问卷信息', 'aizibingkuaisuwenjuanxinxi', '', NULL, '', '', 0, '', 0, 6, 0);
INSERT INTO `fields` VALUES (90, '你知道当地那里可以检测HIV', 'nizhidaodangdinalikeyijianceHIV', 'checkbox', '社区小组=shequxiaozu|当地疾控中心=dangdijikongzhongxin|医院=yiyuan|不知道=buzhidao', '', '', 1, '', 89, 6, 0);
INSERT INTO `fields` VALUES (91, '其他可以检测HIV的地方', 'qitakeyijianceHIVdedifang', 'input', '', '', '', 0, '', 89, 6, 0);
INSERT INTO `fields` VALUES (92, '您是否接受过HIV检测', 'ninshifoujieshouguoHIVjiance', 'input', '', '', '有则输入多少次，没有请输入否', 1, '', 89, 6, 0);
INSERT INTO `fields` VALUES (93, '您最近一次参加HIV检测时什么时候', 'ninzuijinyicicanjiaHIVjianceshishenmeshihou', 'input', '', '', '', 1, '', 89, 6, 0);
INSERT INTO `fields` VALUES (94, '最近6个月内做过多少次检测？', 'zuijin6geyueneizuoguoduoshaocijiance', 'number', '', '', '', 1, '', 89, 6, 0);
INSERT INTO `fields` VALUES (95, '是否知道自己最近一次HIV检测的结果？', 'shifouzhidaozijizuijinyiciHIVjiancedejieguo', 'radio', '是=shi|否=fou|从未检测过=congweijianceguo', '', '', 1, '', 89, 6, 0);
INSERT INTO `fields` VALUES (96, '最近一次你为什么要参加HIV检测', 'zuijinyiciniweishimeyaocanjiaHIVjiance', 'radio', '一些政府的HIV项目提供检测=yixiezhengfudeHIVxiangmutigongjiance|一些志愿者组织的HIV项目提供检测=yixiezhiyuanzhezuzhideHIVxiangmutigongjiance|自己想去疾控中心的HIV门诊检测=zijixiangqujikongzhongxindeHIVmenzhenjiance|从未检测过=congweijianceguo', '', '', 1, '', 89, 6, 0);
INSERT INTO `fields` VALUES (97, '参加HIV检测的其他原因', 'canjiaHIVjiancedeqitayuanyin', 'input', '', '', '', 0, '', 89, 6, 0);
INSERT INTO `fields` VALUES (98, '你对参加HIV检测的主要顾虑是什么', 'niduicanjiaHIVjiancedezhuyaogulvshishenme', 'checkbox', '检测需要提交实名=jiancexuyaotijiaoshiming|因为自己感染HIV的危险小=yinweizijiganranHIVdeweixianxiao|等待检测结果的时间过长=dengdaijiancejieguodeshijianguochang|因为害怕如果检测结果阳性，自己的名字会上报政府=yinweihaiparuguojiancejieguoyangxingzijidemingzihuishangbaozhengfu|无法保护自己隐私=wufabaohuzijiyinsi|因为害怕知道自己已经感染而不愿意去检测=yinweihaipazhidaozijiyijingganranerbuyuanyiqujiance|因为不知道去哪里检测=yinweibuzhidaoqunalijiance|因为到检测地点接受检查交通部方便=yinweidaojiancedidianjieshoujianchajiaotongbufangbian|因为害怕别人认为自己是HIV感染者=yinweihaipabierenrenweizijishiHIVganranzhe|因为没有时间去检测=yinweimeiyoushijianqujiance', '', '', 1, '', 89, 6, 0);
INSERT INTO `fields` VALUES (99, '对参加HIV检测的主要顾虑其他原因', 'duicanjiaHIVjiancedezhuyaogulvqitayuanyin', 'input', '', '', '', 0, '', 89, 6, 0);
INSERT INTO `fields` VALUES (100, '您对感染HIV后是否治疗的看法是', 'ninduiganranHIVhoushifouzhiliaodekanfashi', 'checkbox', '积极接受治疗=jijijieshouzhiliao|担心药物副作用，暂不接受=danxinyaowufuzuoyongzanbujieshou|味道治疗标准就不用治疗=weidaozhiliaobiaozhunjiubuyongzhiliao|担心很快耐药=danxinhenkuainaiyao|担心吃药后被人发现=danxinchiyaohoubeirenfaxian|认为无法治愈，治了也没有一样，任其自然=renweiwufazhiyuzhileyemeiyouyiyangrenqiziran', '', '', 1, '', 89, 6, 0);
INSERT INTO `fields` VALUES (101, '对HIV治疗的其他看法', 'duiHIVzhiliaodeqitakanfa', 'input', '', '', '', 0, '', 89, 6, 0);
COMMIT;

-- ----------------------------
-- Table structure for forms
-- ----------------------------
DROP TABLE IF EXISTS `forms`;
CREATE TABLE `forms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '表单名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=删除，1=正常，2=禁用',
  `add_time` int(10) NOT NULL DEFAULT '0',
  `upd_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of forms
-- ----------------------------
BEGIN;
INSERT INTO `forms` VALUES (6, '艾滋问卷调查', 1, 1466657203, 1468136486);
COMMIT;

-- ----------------------------
-- Table structure for input_types
-- ----------------------------
DROP TABLE IF EXISTS `input_types`;
CREATE TABLE `input_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '普通类型',
  `comment` varchar(255) CHARACTER SET utf8 DEFAULT '' COMMENT '注释',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of input_types
-- ----------------------------
BEGIN;
INSERT INTO `input_types` VALUES (1, 'input', '文本框');
INSERT INTO `input_types` VALUES (2, 'number', '数字输入框');
INSERT INTO `input_types` VALUES (3, 'select', '下拉框');
INSERT INTO `input_types` VALUES (4, 'radio', '单选框');
INSERT INTO `input_types` VALUES (5, 'checkbox', '多选框');
INSERT INTO `input_types` VALUES (6, 'textarea', '多行文本框');
INSERT INTO `input_types` VALUES (7, 'date', '日期选择框');
INSERT INTO `input_types` VALUES (8, 'product', '试剂列表');
INSERT INTO `input_types` VALUES (9, 'addrbox', '城市选择框');
COMMIT;

-- ----------------------------
-- Table structure for logistics
-- ----------------------------
DROP TABLE IF EXISTS `logistics`;
CREATE TABLE `logistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sign_name` varchar(20) DEFAULT NULL COMMENT '英文名',
  `title` varchar(100) DEFAULT NULL COMMENT '店名',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of logistics
-- ----------------------------
BEGIN;
INSERT INTO `logistics` VALUES (1, 'beijing_1', '北京-彩虹公共卫生服务中心', 1, '2017-11-21 22:50:48');
INSERT INTO `logistics` VALUES (3, 'shanxi_1', '临汾-蓝翔心语', 1, '2017-11-27 21:55:46');
INSERT INTO `logistics` VALUES (4, 'shenyang_1', '沈阳-阳光工作组彩虹港湾', 1, '2017-11-27 21:55:58');
INSERT INTO `logistics` VALUES (5, 'tianjing_1', '天津-天津艾馨家园', 1, '2017-11-28 15:44:34');
INSERT INTO `logistics` VALUES (6, 'zhejiang_1', '浙江-阳光海岸彩虹服务中心', 1, '2017-11-28 15:45:18');
INSERT INTO `logistics` VALUES (7, 'henan_1', '南阳-南阳市心灵港湾工作组', 1, '2017-11-28 15:45:29');
INSERT INTO `logistics` VALUES (8, 'hunan_1', '湖南-左岸彩虹', 1, '2017-11-28 15:45:39');
INSERT INTO `logistics` VALUES (9, 'guangxi_1', '广西-广西碧云湖社区', 1, '2017-11-28 15:45:48');
INSERT INTO `logistics` VALUES (10, 'hainan_1', '海南-三亚明日工作组', 1, '2017-11-28 15:45:59');
INSERT INTO `logistics` VALUES (11, 'chongqing_1', '重庆-心连心工作组', 1, '2017-11-28 15:46:09');
INSERT INTO `logistics` VALUES (12, 'sichuan_1', '四川-宜宾市蓝梦健康咨询服务中心', 1, '2017-11-28 15:46:23');
INSERT INTO `logistics` VALUES (13, 'yunan_1', '云南-彩云天空', 1, '2017-11-28 15:46:43');
INSERT INTO `logistics` VALUES (14, 'yunan_2', '昭通', 1, '2017-11-28 15:46:55');
INSERT INTO `logistics` VALUES (15, 'tianjing_1', '天津-天津艾馨家园', 1, '2017-12-08 17:37:34');
COMMIT;

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) DEFAULT NULL,
  `order_uuid` varchar(36) DEFAULT NULL,
  `goods_uuid` varchar(36) DEFAULT NULL,
  `goods_title` varchar(50) DEFAULT NULL,
  `goods_price` decimal(10,2) DEFAULT NULL,
  `order_time` datetime DEFAULT NULL,
  `is_shipped` tinyint(4) DEFAULT NULL,
  `ship_type` varchar(50) DEFAULT NULL,
  `ship_code` varchar(50) DEFAULT NULL,
  `ship_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of order_detail
-- ----------------------------
BEGIN;
INSERT INTO `order_detail` VALUES (1, 'e0d60aa0-d417-11e7-aae2-00163e01ddfd', '22b0d1b8-d4ee-11e7-ae01-1bb06ac0cc82', '6f8e45de-d4ed-11e7-a33f-27b3a1684ff7', '血液2222', 10.00, '2017-11-29 18:14:50', NULL, NULL, NULL, NULL, '2017-11-29 18:14:50', '2017-12-22 15:33:28');
INSERT INTO `order_detail` VALUES (2, '22beaf7c-d4ee-11e7-acaf-9b9bf6f9bfac', '22b0d1b8-d4ee-11e7-ae01-1bb06ac0cc82', '71edf126-d4ed-11e7-811f-55481c7b8f90', '血液[雅培/万孚/艾博/英科]', 0.00, '2017-11-29 18:14:50', NULL, NULL, NULL, NULL, '2017-11-29 18:14:50', '2017-11-29 18:14:50');
INSERT INTO `order_detail` VALUES (3, '4e65bee0-d4ee-11e7-8ed3-7743577b376c', '4e5eb352-d4ee-11e7-8b41-394955c5cfdc', '6f8e45de-d4ed-11e7-a33f-27b3a1684ff7', '血液2222', 10.00, '2017-11-29 18:16:04', NULL, NULL, NULL, NULL, '2017-11-29 18:16:04', '2017-11-29 18:16:04');
INSERT INTO `order_detail` VALUES (4, '4e660396-d4ee-11e7-b875-8ddceb9a8679', '4e5eb352-d4ee-11e7-8b41-394955c5cfdc', '71edf126-d4ed-11e7-811f-55481c7b8f90', '血液[雅培/万孚/艾博/英科]', 0.00, '2017-11-29 18:16:04', NULL, NULL, NULL, NULL, '2017-11-29 18:16:04', '2017-11-29 18:16:04');
INSERT INTO `order_detail` VALUES (5, 'a6ae0300-dbfb-11e7-a32c-00163e01ddfd', 'f216638e-dbf9-11e7-95a1-00163e01ddfd', 'fa9be8e8-dbfa-11e7-913e-00163e01ddfd', '梅毒试剂(50元)', 50.00, '2017-12-08 17:39:13', NULL, NULL, NULL, NULL, '2017-12-08 17:39:13', '2017-12-08 17:39:13');
INSERT INTO `order_detail` VALUES (6, 'a6ae3faa-dbfb-11e7-ad5c-00163e01ddfd', 'f216638e-dbf9-11e7-95a1-00163e01ddfd', '0359a5b0-dbfb-11e7-85c9-00163e01ddfd', '安全套', 10.00, '2017-12-08 17:39:13', NULL, NULL, NULL, NULL, '2017-12-08 17:39:13', '2017-12-08 17:39:13');
INSERT INTO `order_detail` VALUES (7, 'db8c3088-e54c-11e7-a4e0-0c4de9c9a8d8', '5efd2608-e54c-11e7-aa35-0c4de9c9a8d8', 'fa9be8e8-dbfa-11e7-913e-00163e01ddfd', '梅毒试剂(50元)', 50.00, '2017-12-20 14:13:12', NULL, NULL, NULL, NULL, '2017-12-20 14:13:12', '2017-12-20 18:41:45');
INSERT INTO `order_detail` VALUES (8, 'db8c6850-e54c-11e7-8a7d-0c4de9c9a8d8', '5efd2608-e54c-11e7-aa35-0c4de9c9a8d8', '7fd736de-dbfb-11e7-b2b9-00163e01ddfd', '末梢血检测试剂（指尖血）', 0.00, '2017-12-20 14:13:12', NULL, NULL, NULL, NULL, '2017-12-20 14:13:12', '2017-12-20 18:41:46');
INSERT INTO `order_detail` VALUES (9, 'db8c96fe-e54c-11e7-8f85-0c4de9c9a8d8', '5efd2608-e54c-11e7-aa35-0c4de9c9a8d8', '0359a5b0-dbfb-11e7-85c9-00163e01ddfd', '安全套', 10.00, '2017-12-20 14:13:12', NULL, NULL, NULL, NULL, '2017-12-20 14:13:12', '2017-12-20 18:42:05');
INSERT INTO `order_detail` VALUES (10, 'db8cc386-e54c-11e7-819a-0c4de9c9a8d8', 'db82c8d6-e54c-11e7-ace5-0c4de9c9a8d8', 'fec8d8cc-dbfa-11e7-abb0-00163e01ddfd', '润滑剂', 0.00, '2017-12-20 14:13:12', NULL, NULL, NULL, NULL, '2017-12-20 14:13:12', '2017-12-20 14:13:12');
INSERT INTO `order_detail` VALUES (11, '0ce494ac-e54f-11e7-a9c3-0c4de9c9a8d8', 'db82c8d6-e54c-11e7-ace5-0c4de9c9a8d8', 'fa9be8e8-dbfa-11e7-913e-00163e01ddfd', '梅毒试剂(50元)', 50.00, '2017-12-20 14:28:53', NULL, NULL, NULL, NULL, '2017-12-20 14:28:53', '2017-12-20 14:28:53');
INSERT INTO `order_detail` VALUES (12, '0ce78608-e54f-11e7-93c6-0c4de9c9a8d8', 'db82c8d6-e54c-11e7-ace5-0c4de9c9a8d8', '7fd736de-dbfb-11e7-b2b9-00163e01ddfd', '末梢血检测试剂（指尖血）', 0.00, '2017-12-20 14:28:53', NULL, NULL, NULL, NULL, '2017-12-20 14:28:53', '2017-12-20 14:28:53');
INSERT INTO `order_detail` VALUES (13, '5efd2608-e54c-11e7-aa35-0c4de9c9a8d8', 'db82c8d6-e54c-11e7-ace5-0c4de9c9a8d8', '0359a5b0-dbfb-11e7-85c9-00163e01ddfd', '安全套', 10.00, '2017-12-20 14:28:53', NULL, NULL, NULL, NULL, '2017-12-20 14:28:53', '2017-12-20 17:21:50');
INSERT INTO `order_detail` VALUES (14, '0ce7eca6-e54f-11e7-a90d-0c4de9c9a8d8', 'db82c8d6-e54c-11e7-ace5-0c4de9c9a8d8', 'fec8d8cc-dbfa-11e7-abb0-00163e01ddfd', '润滑剂', 0.00, '2017-12-20 14:28:53', NULL, NULL, NULL, NULL, '2017-12-20 14:28:53', '2017-12-20 14:28:53');
INSERT INTO `order_detail` VALUES (15, '4c0cdd5a-e573-11e7-9931-0c4de9c9a8d8', '4c0c25f4-e573-11e7-998b-0c4de9c9a8d8', '069bb22c-dbfb-11e7-a13e-00163e01ddfd', '口腔黏膜渗出液检测试剂（唾液试剂）', 0.00, '2017-12-20 18:48:21', NULL, NULL, NULL, NULL, '2017-12-20 18:48:21', '2017-12-20 18:48:21');
INSERT INTO `order_detail` VALUES (16, '4c0d285a-e573-11e7-ad2a-0c4de9c9a8d8', '4c0c25f4-e573-11e7-998b-0c4de9c9a8d8', 'fec8d8cc-dbfa-11e7-abb0-00163e01ddfd', '润滑剂', 0.00, '2017-12-20 18:48:21', NULL, NULL, NULL, NULL, '2017-12-20 18:48:21', '2017-12-20 18:48:21');
INSERT INTO `order_detail` VALUES (17, '57fd1fc0-e574-11e7-94cb-0c4de9c9a8d8', '4c0c25f4-e573-11e7-998b-0c4de9c9a8d8', '069bb22c-dbfb-11e7-a13e-00163e01ddfd', '口腔黏膜渗出液检测试剂（唾液试剂）', 0.00, '2017-12-20 18:55:51', NULL, NULL, NULL, NULL, '2017-12-20 18:55:51', '2017-12-20 18:55:51');
INSERT INTO `order_detail` VALUES (18, '57fd757e-e574-11e7-b5f5-0c4de9c9a8d8', '4c0c25f4-e573-11e7-998b-0c4de9c9a8d8', 'fec8d8cc-dbfa-11e7-abb0-00163e01ddfd', '润滑剂', 0.00, '2017-12-20 18:55:51', NULL, NULL, NULL, NULL, '2017-12-20 18:55:51', '2017-12-20 18:55:51');
INSERT INTO `order_detail` VALUES (19, '95ccb34c-e574-11e7-9351-0c4de9c9a8d8', '4c0c25f4-e573-11e7-998b-0c4de9c9a8d8', '069bb22c-dbfb-11e7-a13e-00163e01ddfd', '口腔黏膜渗出液检测试剂（唾液试剂）', 0.00, '2017-12-20 18:57:35', NULL, NULL, NULL, NULL, '2017-12-20 18:57:35', '2017-12-20 18:57:35');
INSERT INTO `order_detail` VALUES (20, '95ccfda2-e574-11e7-9890-0c4de9c9a8d8', '4c0c25f4-e573-11e7-998b-0c4de9c9a8d8', 'fec8d8cc-dbfa-11e7-abb0-00163e01ddfd', '润滑剂', 0.00, '2017-12-20 18:57:35', NULL, NULL, NULL, NULL, '2017-12-20 18:57:35', '2017-12-20 18:57:35');
INSERT INTO `order_detail` VALUES (21, '2dfdef48-e578-11e7-a071-0c4de9c9a8d8', '4c0c25f4-e573-11e7-998b-0c4de9c9a8d8', '069bb22c-dbfb-11e7-a13e-00163e01ddfd', '口腔黏膜渗出液检测试剂（唾液试剂）', 0.00, '2017-12-20 19:23:18', NULL, NULL, NULL, NULL, '2017-12-20 19:23:18', '2017-12-20 19:23:18');
INSERT INTO `order_detail` VALUES (22, '2dfe38fe-e578-11e7-98c8-0c4de9c9a8d8', '4c0c25f4-e573-11e7-998b-0c4de9c9a8d8', 'fec8d8cc-dbfa-11e7-abb0-00163e01ddfd', '润滑剂', 0.00, '2017-12-20 19:23:18', NULL, NULL, NULL, NULL, '2017-12-20 19:23:18', '2017-12-20 19:23:18');
INSERT INTO `order_detail` VALUES (23, '1617a438-e6f3-11e7-8955-0c4de9c9a8d8', '160ef0ea-e6f3-11e7-9a5b-0c4de9c9a8d8', 'fa9be8e8-dbfa-11e7-913e-00163e01ddfd', '梅毒试剂(50元)', 50.00, '2017-12-22 16:35:37', NULL, NULL, NULL, NULL, '2017-12-22 16:35:38', '2017-12-22 16:35:38');
INSERT INTO `order_detail` VALUES (24, '1617dbe2-e6f3-11e7-8b48-0c4de9c9a8d8', '160ef0ea-e6f3-11e7-9a5b-0c4de9c9a8d8', '069bb22c-dbfb-11e7-a13e-00163e01ddfd', '口腔黏膜渗出液检测试剂（唾液试剂）', 0.00, '2017-12-22 16:35:38', NULL, NULL, NULL, NULL, '2017-12-22 16:35:38', '2017-12-22 16:35:38');
INSERT INTO `order_detail` VALUES (25, '16180dec-e6f3-11e7-9edd-0c4de9c9a8d8', '160ef0ea-e6f3-11e7-9a5b-0c4de9c9a8d8', '0359a5b0-dbfb-11e7-85c9-00163e01ddfd', '安全套', 10.00, '2017-12-22 16:35:38', NULL, NULL, NULL, NULL, '2017-12-22 16:35:38', '2017-12-22 16:35:38');
INSERT INTO `order_detail` VALUES (26, '16183f06-e6f3-11e7-9d6f-0c4de9c9a8d8', '160ef0ea-e6f3-11e7-9a5b-0c4de9c9a8d8', 'fec8d8cc-dbfa-11e7-abb0-00163e01ddfd', '润滑剂', 0.00, '2017-12-22 16:35:38', NULL, NULL, NULL, NULL, '2017-12-22 16:35:38', '2017-12-22 16:35:38');
COMMIT;

-- ----------------------------
-- Table structure for order_list
-- ----------------------------
DROP TABLE IF EXISTS `order_list`;
CREATE TABLE `order_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) DEFAULT NULL,
  `out_trade_no` varchar(36) NOT NULL COMMENT '内部流水号',
  `uid` int(11) DEFAULT NULL,
  `info` varchar(50) DEFAULT NULL COMMENT '订单标题',
  `description` varchar(250) DEFAULT NULL COMMENT '订单说明',
  `memo` varchar(100) DEFAULT NULL COMMENT '订单备注',
  `total_price` decimal(10,2) DEFAULT NULL,
  `wx_transaction_id` varchar(36) NOT NULL DEFAULT '' COMMENT '微信订单号',
  `pay_status` tinyint(4) DEFAULT NULL COMMENT '支付状态，0待支付，1已支付，-1支付失败',
  `order_status` tinyint(4) DEFAULT '0' COMMENT '订单状态：0未处理，1处理中，2已支付，3已发货，4已收货，11申请退款，12退款中，13退款完成，99已完成',
  `order_updated_at` datetime DEFAULT NULL COMMENT '订单更新时间',
  `ship_name` varchar(20) DEFAULT NULL,
  `ship_code` varchar(30) DEFAULT NULL COMMENT '快递单号',
  `ship_uuid` varchar(36) DEFAULT NULL COMMENT '快递公司UUID',
  `ship_status` tinyint(4) DEFAULT NULL COMMENT '配送状态: 1:已发货',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `source_type` varchar(10) DEFAULT NULL,
  `source_uuid` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `out_trade_no` (`out_trade_no`) USING BTREE,
  UNIQUE KEY `uuid` (`uuid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of order_list
-- ----------------------------
BEGIN;
INSERT INTO `order_list` VALUES (1, 'd118a83a-d4e8-11e7-90dc-9bd3bf7cd3f2', '11', 1, '互联网+艾滋病快速自检试剂发放', '血液2222,血液[雅培/万孚/艾博/英科]', '', 10.00, '1234123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-29 17:36:46', '2017-12-22 15:47:31', 'survey', NULL);
INSERT INTO `order_list` VALUES (6, '22beaf7c-d4ee-11e7-acaf-9b9bf6f9bfac', '33', 1, '互联网+艾滋病快速自检试剂发放', '血液2222,血液[雅培/万孚/艾博/英科]', '', 10.00, '564575', NULL, 2, NULL, NULL, NULL, NULL, NULL, '2017-11-29 18:14:50', '2017-12-22 15:47:29', 'survey', NULL);
INSERT INTO `order_list` VALUES (7, '4e5eb352-d4ee-11e7-8b41-394955c5cfdc', '22', 1, '互联网+艾滋病快速自检试剂发放', '血液2222,血液[雅培/万孚/艾博/英科]', '', 10.00, '4567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-29 18:16:04', '2017-12-21 13:47:33', 'survey', 'e6100cf0-d1fb-11e7-bb80-17a0df7d0719');
INSERT INTO `order_list` VALUES (8, '5efd2608-e54c-11e7-aa35-0c4de9c9a8d8', 'SUR201712010109530000000023', 1, '互联网+艾滋病快速自检试剂发放', '梅毒试剂(50元),末梢血检测试剂（指尖血）,血液[雅培/万孚/艾博/英科],安全套', '', 1.00, '99999', 0, 0, NULL, NULL, NULL, NULL, NULL, '2017-12-01 13:09:53', '2017-12-21 12:43:20', 'survey', '9a4e2fd4-d572-11e7-a0e6-00163e01ddf2');
INSERT INTO `order_list` VALUES (9, '45b4c64c-d656-11e7-ad9b-00163e01ddfd', 'SUR201712010112480000000023', 1, '互联网+艾滋病快速自检试剂发放', '梅毒试剂(50元),末梢血检测试剂（指尖血）,血液[雅培/万孚/艾博/英科],安全套', '', 1.00, '8888', 0, 2, NULL, NULL, NULL, NULL, NULL, '2017-12-01 13:12:48', '2017-12-21 12:43:20', 'survey', '9a4e2fd4-d572-11e7-a0e6-00163e01ddfd');
INSERT INTO `order_list` VALUES (10, 'e0d60aa0-d417-11e7-aae2-00163e01ddfd', 'SUR201712030402290000000020', 3, '互联网+艾滋病快速自检试剂发放', '血液[雅培/万孚/艾博/英科],安全套', '', 1.00, '333333', 1, 3, NULL, '圆通', '34523532353', '3', 1, '2017-12-03 16:02:29', '2017-12-22 15:38:44', 'survey', 'e6100cf0-d1fb-11e7-bb80-17a0df7d0718');
INSERT INTO `order_list` VALUES (11, 'aac85fbe-dbf9-11e7-8512-00163e01ddfd', 'SUR201712080525010000000024', 1, '互联网+艾滋病快速自检试剂发放', '梅毒试剂(50元),末梢血检测试剂（指尖血）,血液[雅培/万孚/艾博/英科]', '', 1.00, '44444', 0, 0, NULL, NULL, NULL, NULL, NULL, '2017-12-08 17:25:01', '2017-12-21 12:43:21', 'survey', '927f45a8-dbf9-11e7-ba79-00163e01ddfd');
INSERT INTO `order_list` VALUES (12, 'f216638e-dbf9-11e7-95a1-00163e01ddfd', 'SUR201712080527010000000025', 1, '互联网+艾滋病快速自检试剂发放', '梅毒试剂(50元),安全套', '', 1.00, '55555', 0, 0, NULL, NULL, NULL, NULL, NULL, '2017-12-08 17:27:01', '2017-12-21 12:43:22', 'survey', 'e0a556f0-dbf9-11e7-98ff-00163e01ddfd');
INSERT INTO `order_list` VALUES (13, 'db82c8d6-e54c-11e7-ace5-0c4de9c9a8d8', 'SUR201712200213110000000028', 1, '互联网+艾滋病快速自检试剂发放', '梅毒试剂(50元),末梢血检测试剂（指尖血）,安全套,润滑剂', '', 1.00, '66666', 0, 0, NULL, NULL, NULL, NULL, NULL, '2017-12-20 14:13:12', '2017-12-21 12:43:23', 'survey', '3ffb74d0-e54c-11e7-a6f2-0c4de9c9a8d8');
INSERT INTO `order_list` VALUES (14, '4c0c25f4-e573-11e7-998b-0c4de9c9a8d8', 'SUR201712200648210000000029', 1, '互联网+艾滋病快速自检试剂发放', '口腔黏膜渗出液检测试剂（唾液试剂）,润滑剂', '', 1.00, '777777', 1, 2, NULL, '圆通', '1111111', '3', 0, '2017-12-20 18:48:21', '2017-12-22 16:22:48', 'survey', '1b7b56d0-e573-11e7-87b7-0c4de9c9a8d8');
INSERT INTO `order_list` VALUES (15, '160ef0ea-e6f3-11e7-9a5b-0c4de9c9a8d8', 'SUR201712220435370000000030', 1, '互联网+艾滋病快速自检试剂发放', '梅毒试剂(50元),口腔黏膜渗出液检测试剂（唾液试剂）,安全套,润滑剂', '', 1.00, '', NULL, 0, NULL, NULL, NULL, NULL, NULL, '2017-12-22 16:35:37', '2017-12-22 16:35:37', 'survey', 'f083b3c4-e6f2-11e7-8525-0c4de9c9a8d8');
COMMIT;

-- ----------------------------
-- Table structure for order_pay_log
-- ----------------------------
DROP TABLE IF EXISTS `order_pay_log`;
CREATE TABLE `order_pay_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `device_info` varchar(255) NOT NULL DEFAULT 'WEB',
  `trade_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '交易类型，1=付款，2=退款',
  `bank_type` varchar(255) NOT NULL DEFAULT '' COMMENT '付款银行',
  `out_trade_no` varchar(32) NOT NULL COMMENT '商户内部订单号 [FK: orders.out_trade_no]',
  `transaction_id` varchar(32) NOT NULL COMMENT '微信支付订单号',
  `out_refund_no` varchar(32) NOT NULL DEFAULT '' COMMENT '商户内部退款单号',
  `refund_id` varchar(32) NOT NULL DEFAULT '' COMMENT '微信退款单号',
  `result_code` varchar(32) NOT NULL DEFAULT 'SUCCESS' COMMENT '处理结果',
  `err_code` varchar(255) CHARACTER SET utf16 NOT NULL DEFAULT '',
  `err_code_des` varchar(255) NOT NULL DEFAULT '',
  `total_fee` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额',
  `cash_fee` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '现金支付金额',
  `refund_fee` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '申请退款金额',
  `time_end` varchar(20) NOT NULL DEFAULT '0' COMMENT '完成时间',
  `client_ip` varchar(20) NOT NULL DEFAULT '0' COMMENT '操作终端IP',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for pay_log
-- ----------------------------
DROP TABLE IF EXISTS `pay_log`;
CREATE TABLE `pay_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `device_info` varchar(255) NOT NULL DEFAULT 'WEB',
  `trade_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '交易类型，1=付款，2=退款',
  `bank_type` varchar(255) NOT NULL DEFAULT '' COMMENT '付款银行',
  `out_trade_no` varchar(32) NOT NULL COMMENT '商户内部订单号 [FK: orders.out_trade_no]',
  `transaction_id` varchar(32) NOT NULL COMMENT '微信支付订单号',
  `out_refund_no` varchar(32) NOT NULL DEFAULT '' COMMENT '商户内部退款单号',
  `refund_id` varchar(32) NOT NULL DEFAULT '' COMMENT '微信退款单号',
  `result_code` varchar(32) NOT NULL DEFAULT 'SUCCESS' COMMENT '处理结果',
  `err_code` varchar(255) CHARACTER SET utf16 NOT NULL DEFAULT '',
  `err_code_des` varchar(255) NOT NULL DEFAULT '',
  `total_fee` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '订单金额',
  `cash_fee` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '现金支付金额',
  `refund_fee` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '申请退款金额',
  `time_end` varchar(20) NOT NULL DEFAULT '0' COMMENT '完成时间',
  `client_ip` varchar(20) NOT NULL DEFAULT '0' COMMENT '操作终端IP',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for reagent
-- ----------------------------
DROP TABLE IF EXISTS `reagent`;
CREATE TABLE `reagent` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) DEFAULT NULL,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '试剂名称',
  `subname` varchar(100) DEFAULT NULL COMMENT '附加名称',
  `description` varchar(500) DEFAULT NULL COMMENT '说明',
  `type` varchar(10) NOT NULL COMMENT 'free/charge/gift',
  `price` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=删除，1=正常',
  `stock` int(10) NOT NULL DEFAULT '0' COMMENT '库存，-1无限',
  `comment` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `image` varchar(200) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of reagent
-- ----------------------------
BEGIN;
INSERT INTO `reagent` VALUES (1, '7fd736de-dbfb-11e7-b2b9-00163e01ddfd', '末梢血检测试剂（指尖血）', '指尖血', '', 'free', 0.00, 1, -1, '', '');
INSERT INTO `reagent` VALUES (3, '069bb22c-dbfb-11e7-a13e-00163e01ddfd', '口腔黏膜渗出液检测试剂（唾液试剂）', '唾液试剂', '', 'free', 0.00, 1, -1, '', '');
INSERT INTO `reagent` VALUES (4, '0359a5b0-dbfb-11e7-85c9-00163e01ddfd', '安全套', '安全套', '', 'gift', 10.00, 1, -1, '', '');
INSERT INTO `reagent` VALUES (5, 'fec8d8cc-dbfa-11e7-abb0-00163e01ddfd', '润滑剂', '润滑剂', '', 'gift', 0.00, 1, -1, '', '');
INSERT INTO `reagent` VALUES (6, 'fa9be8e8-dbfa-11e7-913e-00163e01ddfd', '梅毒试剂(50元)', '', '', 'charge', 50.00, 1, -1, '', '');
COMMIT;

-- ----------------------------
-- Table structure for relation_reagent_logistics
-- ----------------------------
DROP TABLE IF EXISTS `relation_reagent_logistics`;
CREATE TABLE `relation_reagent_logistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) DEFAULT NULL,
  `reagent_id` smallint(6) NOT NULL,
  `logistics_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of relation_reagent_logistics
-- ----------------------------
BEGIN;
INSERT INTO `relation_reagent_logistics` VALUES (9, 'b947b084-d411-11e7-8a82-00163e01ddfd', 0, 1);
INSERT INTO `relation_reagent_logistics` VALUES (10, 'feca8582-dbfa-11e7-a6fd-00163e01ddfd', 5, 1);
INSERT INTO `relation_reagent_logistics` VALUES (11, 'fecaf62a-dbfa-11e7-8ae8-00163e01ddfd', 5, 3);
COMMIT;

-- ----------------------------
-- Table structure for survey_list
-- ----------------------------
DROP TABLE IF EXISTS `survey_list`;
CREATE TABLE `survey_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) DEFAULT '' COMMENT '唯一ID',
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `create_time` date NOT NULL COMMENT '填表日期，也是标题',
  `name` varchar(20) DEFAULT NULL COMMENT '姓名或称呼',
  `nation` varchar(20) DEFAULT NULL COMMENT '民族',
  `gender` varchar(3) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `education` varchar(20) DEFAULT NULL COMMENT '文化程度',
  `marriage` varchar(20) DEFAULT NULL,
  `job` varchar(20) DEFAULT NULL COMMENT '职业',
  `job_other` varchar(20) DEFAULT NULL COMMENT '其他职业（当job填其他的时候）',
  `income` varchar(20) DEFAULT NULL COMMENT '月平均收入',
  `household` varchar(20) DEFAULT NULL COMMENT '户籍所在地',
  `livecity` varchar(20) DEFAULT NULL COMMENT '现居地',
  `livecity_code` varchar(20) DEFAULT NULL COMMENT '居住地代码',
  `livetime` varchar(20) DEFAULT NULL COMMENT '当地居住时长',
  `has_sex` tinyint(4) DEFAULT '0' COMMENT '是否有过性行为。1:是，0:否',
  `sex_age` mediumint(9) DEFAULT NULL COMMENT '您第一次发生性行为的年龄',
  `partner` varchar(20) DEFAULT NULL COMMENT '寻找其他性伴侣的方式',
  `partner_sns` tinyint(4) DEFAULT NULL COMMENT '互联网（社交软件等）',
  `partner_bar` tinyint(4) DEFAULT NULL COMMENT '酒吧',
  `partner_ktv` tinyint(4) DEFAULT NULL COMMENT 'KTV\nKTV\nKTV\nKTV',
  `partner_park` tinyint(4) DEFAULT NULL COMMENT '公园',
  `partner_other` varchar(50) DEFAULT NULL COMMENT '其他',
  `sex_type` varchar(20) DEFAULT NULL COMMENT '常用性行为方式',
  `sex_type_other` varchar(20) DEFAULT NULL,
  `sex_direction` varchar(20) DEFAULT NULL COMMENT '性取向',
  `hetero_partner_num` smallint(6) DEFAULT NULL COMMENT '近3个月内您有多少个异性伙伴',
  `condom_full_use` tinyint(4) DEFAULT NULL COMMENT '是否全程使用安全套',
  `condom_percent` varchar(20) DEFAULT NULL COMMENT '在最近3个月没有全程使用安全套的比例：',
  `condom_near` varchar(20) DEFAULT NULL COMMENT '最近一次与异性发生性行为是否使用安全套',
  `condom_full_use_not` tinyint(4) DEFAULT NULL COMMENT '是否未全程使用安全套',
  `anal_sex` tinyint(4) DEFAULT NULL COMMENT '是否有肛交行为吗',
  `anal_sex_role` varchar(20) DEFAULT NULL,
  `anal_sex_partner_num` smallint(6) DEFAULT NULL COMMENT '近3个月内您有多少个同性伙伴',
  `anal_sex_full_use` tinyint(4) DEFAULT NULL COMMENT '同性间是否全程使用安全套',
  `anal_sex_percent` varchar(20) DEFAULT NULL COMMENT '没有全程使用安全套比例',
  `anal_sex_near` varchar(20) DEFAULT NULL,
  `anal_sex_full_use_not` tinyint(4) DEFAULT NULL,
  `is_use_drug` tinyint(4) DEFAULT NULL COMMENT '是否使用过毒品',
  `drug_type` varchar(20) DEFAULT NULL COMMENT '毒品类型',
  `drug_rate` varchar(20) DEFAULT NULL COMMENT '毒品使用频率',
  `is_use_drug_near_month` varchar(255) DEFAULT NULL COMMENT '近一个月使用过毒品',
  `drug_near_month_num` smallint(6) DEFAULT NULL COMMENT '近一个月使用毒品的频率',
  `is_use_inject` tinyint(4) DEFAULT NULL COMMENT '注射过毒品',
  `is_use_inject_near_month` tinyint(4) DEFAULT NULL COMMENT '最近一个月是否注射过毒品',
  `inject_near_month_num` smallint(6) DEFAULT NULL COMMENT '最近一个月注射毒品的频率',
  `is_use_pinhead` tinyint(4) DEFAULT NULL COMMENT '曾经与别人是否共用过针具',
  `is_use_pinhead_near_month` tinyint(4) DEFAULT NULL COMMENT '最近一个月，注射毒品时是否与别人共用过针具',
  `pinhead_near_month_num` varchar(20) DEFAULT NULL COMMENT '最近一个月注射毒品时，与别人共用针具的频率如何。',
  `is_sex_after_drug_3month` tinyint(4) DEFAULT NULL COMMENT '最近3个月,是否有过吸食毒品后发生性行为',
  `sex_after_drug_3month_num` smallint(6) DEFAULT NULL COMMENT '在最近3个月与多少人是在吸食毒品后发生的性行为',
  `is_sex_after_drug_1month` tinyint(4) DEFAULT NULL COMMENT '最近1个月,是否有过吸食毒品后发生性行为',
  `sex_after_drug_1month_num` smallint(6) DEFAULT NULL COMMENT '最近1个月与多少人是在吸食毒品后发生的性行为',
  `cough_2week` tinyint(4) DEFAULT NULL COMMENT '咳嗽、咳痰持续2周以上',
  `cough_withblood` tinyint(4) DEFAULT NULL COMMENT '反复咳出的痰中带血',
  `sweat_on_night` tinyint(4) DEFAULT NULL COMMENT '夜间经常出汗',
  `weight_downgrade` tinyint(4) DEFAULT NULL COMMENT '无法解思的体重明显下降',
  `always_tired` tinyint(4) DEFAULT NULL COMMENT '经常容易疲劳或呼吸短促',
  `fever_2week` tinyint(4) DEFAULT NULL COMMENT '反复发热持续2周以上',
  `lymphadenectasis` tinyint(4) DEFAULT NULL COMMENT '淋巴结肿大',
  `tuberculosis_contact_history` tinyint(4) DEFAULT NULL COMMENT '结核病人接触史',
  `no_tuberculosis` tinyint(4) DEFAULT NULL,
  `is_phthisic_checked` tinyint(4) DEFAULT NULL COMMENT '最近是否做过结核检查（痰检或X胸片）',
  `phthisic_result` varchar(20) DEFAULT NULL COMMENT '结核检测结果',
  `is_syphilis` tinyint(4) DEFAULT NULL COMMENT '是否做过梅毒检查 ',
  `syphilis_result` varchar(20) DEFAULT NULL COMMENT '梅毒检测结果',
  `is_hepatitis_b` tinyint(4) DEFAULT NULL COMMENT '最近是否做过乙肝检测',
  `hepatitis_b_result` varchar(20) DEFAULT NULL COMMENT '乙肝检测结果',
  `is_hepatitis_c` tinyint(4) DEFAULT NULL COMMENT '最近是否做过丙肝检测',
  `hepatitis_c_result` varchar(20) DEFAULT NULL COMMENT '丙肝检测结果',
  `detect_hospital` tinyint(4) DEFAULT NULL COMMENT '医院',
  `detect_jk_center` tinyint(4) DEFAULT NULL COMMENT '疾控中心\n疾控中心疾控中心疾控中心\n疾控中心\n疾控中心\n疾控中心\n疾控中心',
  `detect_community` tinyint(4) DEFAULT NULL COMMENT '社区小组',
  `detect_drugstore` tinyint(4) DEFAULT NULL COMMENT '药店',
  `detect_clinic` tinyint(4) DEFAULT NULL COMMENT '个体诊所\n个体诊所',
  `detect_other` varchar(50) DEFAULT NULL COMMENT '其他',
  `is_accept_detect_hiv` tinyint(4) DEFAULT NULL COMMENT '您是否接受过HIV检测',
  `detect_num` smallint(6) DEFAULT NULL COMMENT '接受过几次HIV检测',
  `detect_num_near_1year` smallint(6) DEFAULT NULL COMMENT '最近一年内接受过几次HIV检测',
  `detect_num_near_6month` smallint(6) DEFAULT NULL COMMENT '最近6个月内接受过几次HIV检测',
  `last_hiv_checkdate` date DEFAULT NULL COMMENT '最近一次参加HIV检测日期',
  `last_hiv_checkdate_choose` varchar(20) DEFAULT NULL,
  `is_know_detect_result` tinyint(4) DEFAULT NULL COMMENT '否知道自己最近一次的HIV检测结果',
  `hiv_check_mode` varchar(10) DEFAULT NULL COMMENT '最近一次主动检测HIV还是被动员检测',
  `hiv_check_reason` varchar(20) DEFAULT NULL COMMENT '最近一次参加检测的原因',
  `hiv_check_reason_other` varchar(50) DEFAULT NULL COMMENT '最近一次参加检测的其他原因',
  `last_hiv_check_mode` varchar(20) DEFAULT NULL COMMENT '最近一次通过何种方式参加HIV检测',
  `last_hiv_check_mode_other` varchar(255) DEFAULT NULL COMMENT '最近一次通过其他方式参加HIV检测',
  `is_detect_care` tinyint(4) DEFAULT NULL COMMENT '对于参加HIV检测是否有顾虑',
  `hiv_check_care` varchar(20) DEFAULT NULL COMMENT 'HIV检测的主要顾虑是什么',
  `hiv_check_care_other` varchar(50) DEFAULT NULL COMMENT 'HIV检测的其他顾虑是什么',
  `detect_channel_hospital` tinyint(4) DEFAULT NULL COMMENT '期望获得HIV检测的渠道-医院',
  `detect_channel_jk_center` tinyint(4) DEFAULT NULL COMMENT '期望获得HIV检测的渠道-疾控中心',
  `detect_channel_community` tinyint(4) DEFAULT NULL COMMENT '期望获得HIV检测的渠道-社区小组',
  `detect_channel_drugstore` tinyint(4) DEFAULT NULL COMMENT '期望获得HIV检测的渠道-药店',
  `detect_channel_clinic` tinyint(4) DEFAULT NULL COMMENT '期望获得HIV检测的渠道-个体诊所',
  `detect_channel_other` varchar(50) DEFAULT NULL COMMENT '期望获得HIV检测的渠道-其他',
  `detect_by_self` tinyint(4) DEFAULT NULL COMMENT '是否愿意获自费购买HIV检测试剂',
  `hiv_check_time` varchar(20) DEFAULT NULL COMMENT '再次申请获得一次项目邮寄免费检测试剂',
  `apply_for_free` tinyint(4) DEFAULT NULL COMMENT '本次是否申请梅毒检测试剂',
  `partner_is_check_hiv` varchar(10) DEFAULT NULL COMMENT '配偶/性伴是否检测过HIV',
  `partner_check_result` varchar(20) DEFAULT NULL COMMENT '配偶/性伴的检测结果',
  `partner_mobilize` tinyint(4) DEFAULT NULL COMMENT '是否愿意动员配偶/性伴进行HIV检测',
  `fast_detect_service` tinyint(4) DEFAULT NULL COMMENT '提供进一步快检服务',
  `org_for_cd4` tinyint(4) DEFAULT NULL COMMENT '提供确证和CD4检测机构信息',
  `org_therapy` tinyint(4) DEFAULT NULL COMMENT '提供抗病毒治疗或相关医疗机构信息',
  `org_syphilis` tinyint(4) DEFAULT NULL COMMENT '提供性病诊断治疗机构信息',
  `org_syphilis_other` tinyint(4) DEFAULT NULL COMMENT '提供机会性感染治疗及其他相关治疗机构信息',
  `org_psychological` tinyint(4) DEFAULT NULL COMMENT '提供心理咨询和帮助机构信息',
  `org_pmtct` tinyint(4) DEFAULT NULL COMMENT '提供母婴阻断机构信息',
  `org_phthisis` tinyint(4) DEFAULT NULL COMMENT '提供结核诊断治疗机构信息',
  `org_other` varchar(50) DEFAULT NULL COMMENT '其他服务',
  `active_treatment` tinyint(4) DEFAULT NULL COMMENT '积极接受治疗',
  `unaccept_medical` tinyint(4) DEFAULT NULL COMMENT '担心药物副作用，暂不接受\n担心药物副作用，暂不接受',
  `treatment_until_standard` tinyint(4) DEFAULT NULL COMMENT '未到治疗标准就不用治疗',
  `resistant_care` tinyint(4) DEFAULT NULL COMMENT '担心很快耐药',
  `explore_care` tinyint(4) DEFAULT NULL COMMENT '担心吃药后被人发现',
  `not_treatment` tinyint(4) DEFAULT NULL COMMENT '认为无法治愈，不治疗，任其自然',
  `treatment_other` varchar(50) DEFAULT NULL COMMENT '其他看法',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of survey_list
-- ----------------------------
BEGIN;
INSERT INTO `survey_list` VALUES (1, '', 1, '2017-10-26', '3333', '', '', NULL, '', '', '', '', '', '', '', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `survey_list` VALUES (2, '', 1, '2017-10-23', 'ss', '', '', NULL, '', '', '', '', '', '', '', NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `survey_list` VALUES (3, '', 1, '2017-11-19', 'xx', '', '', NULL, '', '', '', '', '', '', '', NULL, '', 0, NULL, '', 1, 1, NULL, NULL, '', '', '', '', NULL, NULL, '', NULL, NULL, 1, '', NULL, 1, NULL, '', 1, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '是', '不知道', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-19 15:31:39');
INSERT INTO `survey_list` VALUES (4, 'e0d60aa0-d417-11e7-aae2-00163e01ddfd', 1, '2017-11-22', '好', '', '', NULL, '初中', '离异或丧偶', '商业服务业', '', '5000-9999元', '外省', '', NULL, '6月-1年', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-22 19:55:35');
INSERT INTO `survey_list` VALUES (5, '', 1, '2017-11-24', '3333', '满族', '男', '1990-01-17', '初中', '同居', '其他', '好吧', '5000-9999元', '本省外市', '北京 北京市', '110000', '5年以上', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-24 19:20:45');
INSERT INTO `survey_list` VALUES (6, 'f8d243e4-d1fb-11e7-a888-73eef3a3cbee', 1, '2017-11-26', '33', '满族', '男', '1990-01-05', '小学', '同居', '医务人员', '', '3000-4999元', '外省', '北京 北京市', '110000', '1-5年', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-26 00:16:19');
INSERT INTO `survey_list` VALUES (7, '5af61b84-d1fe-11e7-b26a-69f6e1ab259d', 1, '2017-11-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', NULL, NULL, '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-26 00:33:23');
INSERT INTO `survey_list` VALUES (8, '746b8482-d1fe-11e7-b854-ed97b16f82ad', 1, '2017-11-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '', NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', NULL, NULL, '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-26 00:34:06');
INSERT INTO `survey_list` VALUES (9, '3ee08522-d200-11e7-9560-a3cfe0a7acf3', 1, '2017-11-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '摇头丸', '1-3次/月', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-26 00:46:55');
INSERT INTO `survey_list` VALUES (10, '14cd636c-d201-11e7-bafd-4faf3b193a99', 1, '2017-11-26', '11', '壮族', '男', '1990-01-01', '小学', '同居', '医务人员', '', '5000-9999元', '外省', '北京 北京市', '110000', '1-5年', 0, NULL, '', NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', NULL, NULL, '', NULL, NULL, '', '', NULL, 1, '大麻', '1-3次/月', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '不知道', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', '2017-11-26 00:52:54');
INSERT INTO `survey_list` VALUES (11, 'fc041ea2-d386-11e7-a180-9547a26ee9c5', 1, '2017-11-27', '33', '壮族', '男', '1990-01-20', '初中', '同居', '自由职业', '', '5000-9999元', '本市', '吉林省 长春市', '220100', '1-5年', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-27 23:23:56');
INSERT INTO `survey_list` VALUES (12, '804d7d16-d387-11e7-89d3-ef2692b4872f', 1, '2017-11-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 333, '主动', NULL, NULL, NULL, NULL, '', '', '', '不确定', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-27 23:27:38');
INSERT INTO `survey_list` VALUES (13, 'e640b188-d387-11e7-8ec8-a3d79151295a', 1, '2017-11-28', '33', '满族', '男', '1990-01-20', '文盲', '未婚', '餐饮食品业', '', '1001-2999元', '本省外市', '吉林省 长春市', '110000', '6月-1年', 1, 22, '主动', NULL, 1, 1, NULL, '', '手淫', '', '同性', NULL, NULL, '', '', NULL, 1, '', NULL, NULL, '', '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-11-27 23:30:29');
INSERT INTO `survey_list` VALUES (14, '431a8640-d572-11e7-8c70-00163e01ddfd', 2, '2017-11-30', 'jdhd', '鄂伦春族', '男', '1990-01-13', '研究生及以上', '离异或丧偶', '医务人员', '', '5000-9999元', '本省外市', '福建省 福州市', '350100', '6月-1年', 1, 10, '被动', NULL, NULL, 1, NULL, '', '', '', '异性', 37, 1, '60-79%', '否', 1, NULL, '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, '', 0, 0, NULL, NULL, NULL, '', NULL, '', '', '', '', '', 0, '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '不知道', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', '2017-11-30 10:00:38');
INSERT INTO `survey_list` VALUES (15, 'a6829f60-d572-11e7-a213-00163e01ddfd', 1, '2017-11-30', '21', '壮族', '男', '1990-01-01', '小学', '已婚', '自由职业', '', '3000-4999元', '本市', '北京 北京市', '110000', '1-5年', 0, NULL, '', NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', NULL, NULL, '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, '', 0, 0, NULL, NULL, NULL, '', NULL, '', '', '', '', '', 0, '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '不知道', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', '2017-11-30 10:03:25');
INSERT INTO `survey_list` VALUES (16, 'a0ee4b84-dbf9-11e7-8b12-00163e01ddfd', 1, '2017-12-08', 'jbd', '蒙古族', '男', '1990-01-01', '初中', '已婚', '自由职业', '', '5000-9999元', '本市', '安徽省 合肥市', '340100', '6月-1年', 0, NULL, '', NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', NULL, NULL, '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, '', 0, 0, NULL, NULL, NULL, '', NULL, '', '', '', '', '', 0, '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '否', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', '2017-12-08 17:24:45');
INSERT INTO `survey_list` VALUES (17, 'eb0ddc02-dbf9-11e7-9283-00163e01ddfd', 1, '2017-12-08', 'sxn', '彝族', '男', '1990-01-01', '高中/中专', '同居', '待业', '', '5000-9999元', '外省', '江西省 景德镇市', '360200', '6月-1年', 0, NULL, '', NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', NULL, NULL, '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, '', 0, 0, NULL, NULL, NULL, '', NULL, '', '', '', '', '', 0, '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '否', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', '2017-12-08 17:26:49');
INSERT INTO `survey_list` VALUES (18, 'a46d968c-e49d-11e7-9412-0c4de9c9a8d8', 1, '2017-12-19', '12', '满族', '男', '1990-01-01', '初中', '保密', '商业服务业', '', '3000-4999元', '本省外市', '北京 北京市', '110000', '1-5年', 1, 21, '主动', 1, 1, 1, 1, '', '阴道交', 'qwer', '异性', 1, 1, '60-79%', '否', 1, NULL, '', NULL, NULL, '', '', NULL, 1, '零号胶囊', '>=1次/天', '1', 1, 1, 1, 1, 1, 1, '未共用', 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '阴性', 1, '不知道', NULL, 1, 1, NULL, NULL, '123', 1, 2, 2, 12, '2017-12-14', '', 1, '主动', '其他', '', '其他', '', 1, '', '', NULL, NULL, 1, 1, NULL, '', 1, '3个月', 1, '否', '', 1, 1, 1, 1, 1, NULL, 1, NULL, NULL, '', 1, 1, 1, NULL, NULL, 1, '', '2017-12-19 17:18:57');
INSERT INTO `survey_list` VALUES (19, 'f4d5c6fa-e4aa-11e7-b4b4-0c4de9c9a8d8', 1, '2017-12-19', '赵钱孙', '满族', '男', '1990-01-01', '初中', '同居', '商业服务业', '', '3000-4999元', '本省外市', '北京 北京市', '110000', '1-5年', 0, NULL, '', NULL, NULL, NULL, NULL, '', '阴道交', '', '异性', NULL, NULL, '', '', NULL, NULL, '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-12-19 18:54:16');
INSERT INTO `survey_list` VALUES (20, '5efd2608-e54c-11e7-aa35-0c4de9c9a8d8', 1, '2017-12-20', '姓名测试', '汉族', '男', '1990-01-01', '小学', '未婚', '餐饮食品业', '', '5000-9999元', '外省', '香港特别行政区 香港岛', '810100', '6月-1年', 1, 21, '主动', 1, 1, 1, 1, '', '阴道交', '', '异性', 2, 1, '80-99%', '是', 1, NULL, '', NULL, NULL, '', '', NULL, 1, '海洛因', '>=1次/天', '1', 2, 1, 1, 2, 1, NULL, '未共用', NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, '', NULL, '', 1, '阴性', 1, '不知道', 1, NULL, 1, 1, NULL, '测试地带呢', 1, 1, 1, 1, '2017-12-14', '', 1, '被动', '配偶/固定性伴阳性史', '', '疾控中心', '', 1, '担心检测阳性后信息暴露', '', 1, NULL, 1, NULL, 1, '好久好久', 1, '6个月', 1, '是', '阴性', 1, 1, NULL, 1, NULL, NULL, 1, NULL, 1, '女孩公园', 1, NULL, 1, 1, 1, NULL, '参加', '2017-12-20 14:09:43');
INSERT INTO `survey_list` VALUES (21, '327aeaa8-e573-11e7-beed-0c4de9c9a8d8', 1, '2017-12-20', 'test', '苗族', '男', '1990-01-15', '初中', '未婚', '学生', '', '0-1000元', '本市', '北京 北京市', '110000', '<3月', 0, NULL, '', NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', NULL, NULL, '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '不知道', NULL, '', NULL, '', NULL, '', 1, NULL, NULL, 1, NULL, '', 0, 0, NULL, NULL, NULL, '', NULL, '', '', '', '', '', 0, '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '否', '', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, '', 1, 1, 1, 1, 1, NULL, '', '2017-12-20 18:47:38');
INSERT INTO `survey_list` VALUES (22, 'fecc27f4-e6f2-11e7-b039-0c4de9c9a8d8', 1, '2017-12-22', '青海', '满族', '男', '1990-01-01', '初中', '未婚', '医务人员', '', '3000-4999元', '本省外市', '河南省 郑州市', '410100', '3-6月', 0, NULL, '', NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, '', '', NULL, NULL, '', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 1, NULL, NULL, '', NULL, '', NULL, '', 1, '阴性', 1, 1, NULL, 1, NULL, '', 0, 0, NULL, NULL, NULL, '', NULL, '', '', '', '', '', 0, '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL, '否', '', NULL, 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, '', NULL, 1, 1, NULL, 1, NULL, '', '2017-12-22 16:34:58');
COMMIT;

-- ----------------------------
-- Table structure for system_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_menu`;
CREATE TABLE `system_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `action` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单链接',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '上级ID',
  `icon` varchar(20) DEFAULT '',
  `ordinal` tinyint(3) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态,是否禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of system_menu
-- ----------------------------
BEGIN;
INSERT INTO `system_menu` VALUES (1, '后台首页', 'site/index', 0, 'fa-dashboard', 0, 1);
INSERT INTO `system_menu` VALUES (2, '菜单管理', '/system/menu', 12, '', 20, 1);
INSERT INTO `system_menu` VALUES (3, '调研管理', '', 0, 'fa-file', 10, 1);
INSERT INTO `system_menu` VALUES (4, '调研列表', '/survey/site', 3, '', 0, 1);
INSERT INTO `system_menu` VALUES (8, '项目JS列表', '/user/project/view', 3, '', 10, 1);
INSERT INTO `system_menu` VALUES (9, '订单管理', '', 0, 'icon-envelope-alt', 20, 1);
INSERT INTO `system_menu` VALUES (10, '用户管理', '', 0, 'icon-user', 30, 1);
INSERT INTO `system_menu` VALUES (11, '用户列表', '/user/lists', 10, 'icon-group', 0, 1);
INSERT INTO `system_menu` VALUES (12, '系统管理', '', 0, 'fa-gears', 40, 1);
INSERT INTO `system_menu` VALUES (13, '商品管理', '/system/reagent', 12, 'icon-ban-circle', 10, 1);
INSERT INTO `system_menu` VALUES (15, '发货地管理', '/system/logistics', 12, '', 0, 1);
INSERT INTO `system_menu` VALUES (21, '订单列表', '/order/site', 9, 'icon-comment', 0, 1);
INSERT INTO `system_menu` VALUES (22, '快递公司管理', '/system/express', 12, '', 50, 1);
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) DEFAULT NULL COMMENT 'uuid,唯一ID',
  `openid` varchar(50) NOT NULL DEFAULT '' COMMENT '微信openid',
  `unionid` varchar(50) DEFAULT NULL,
  `nickname` varchar(255) NOT NULL DEFAULT '' COMMENT '微信昵称',
  `realname` varchar(255) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1：男，2：女',
  `birthdate` varchar(50) NOT NULL DEFAULT '',
  `nation` varchar(50) NOT NULL DEFAULT '' COMMENT '民族',
  `province` varchar(200) NOT NULL DEFAULT '' COMMENT '用户在微信个人资料填写的省份',
  `city` varchar(200) NOT NULL DEFAULT '' COMMENT '普通用户在微信个人资料填写的城市',
  `country` varchar(200) NOT NULL DEFAULT '' COMMENT '用户在微信个人资料填写的国家，如中国为CN',
  `headimgurl` varchar(255) NOT NULL DEFAULT '' COMMENT '用户微信头像',
  `age` int(3) NOT NULL DEFAULT '18' COMMENT '年龄',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `qq` varchar(11) NOT NULL DEFAULT '' COMMENT 'QQ',
  `telephone` varchar(15) NOT NULL DEFAULT '' COMMENT '手机号码',
  `address` varchar(100) NOT NULL DEFAULT '',
  `is_updated` tinyint(4) NOT NULL DEFAULT '0',
  `is_subscribe` tinyint(4) DEFAULT '-1',
  `subscribe_time` int(11) DEFAULT '0',
  `tags` varchar(255) NOT NULL DEFAULT '{}',
  `created_at` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (1, 'e0d60aa0-d417-11e7-aae2-00163e01ddfd', 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q', 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q', '膘叔', '膘叔', 1, '', '', '', '', '', 'http://wx.qlogo.cn/mmopen/vi_32/Q3auHgzwzM4K9ArFKuIJGtZqH8II5JAS8XCdSTuOahmGLFS24uQyqZqGYy8OKzct7o91M3RIe4YgrDrweRUIOg/0', 18, '', '', '', '', 0, 0, 0, '[]', '2017-11-28 16:41:07', '2017-11-30 09:58:51');
INSERT INTO `user` VALUES (2, NULL, '1', '1', '12', '3', 1, '', '', '', '', '', '', 18, '', '', '', '', 0, -1, 0, '{}', '0000-00-00 00:00:00', '2017-11-30 09:58:53');
INSERT INTO `user` VALUES (3, '', '', NULL, '测试', '', 1, '', '', '', '', '', '', 18, '', '', '', '', 0, -1, 0, '{}', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

-- ----------------------------
-- Table structure for user_address
-- ----------------------------
DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) DEFAULT NULL COMMENT '唯一ID',
  `uid` int(11) NOT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `city_code` varchar(6) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of user_address
-- ----------------------------
BEGIN;
INSERT INTO `user_address` VALUES (3, '498f1d8e-d1a2-11e7-89ed-7d2a012e2664', 1, '11', '123', '黑龙江省 哈尔滨市 道里区', '', 'adf', '2017-11-25 13:34:20', 0);
INSERT INTO `user_address` VALUES (4, '3e161da8-d1a3-11e7-97ce-510de852e2e7', 1, '1', '23', '北京 北京市 东城区', '', '33', '2017-11-25 13:41:10', 0);
INSERT INTO `user_address` VALUES (5, '80f43cae-d1a3-11e7-a5f5-193ed3b63bd7', 1, '3344', '442', '北京 北京市 东城区', '', '123', '2017-11-25 13:43:03', 0);
INSERT INTO `user_address` VALUES (14, '351f7806-d1a4-11e7-b6cb-01d5cf31448c', 1, '3344', '442', '北京 北京市 东城区', '', '123', '2017-11-25 13:48:05', 0);
INSERT INTO `user_address` VALUES (15, '5255cc9a-d1a4-11e7-a0c5-f94afebbebbc', 1, '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:48:54', 0);
INSERT INTO `user_address` VALUES (16, '74412304-d1a4-11e7-9244-f9ee89ddb9f8', 1, '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:49:51', 0);
INSERT INTO `user_address` VALUES (17, '7a5beb52-d1a4-11e7-bf90-93f403193961', 1, '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:50:01', 0);
INSERT INTO `user_address` VALUES (18, '9951538a-d1a4-11e7-921f-c71304dac593', 1, '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:50:53', 0);
INSERT INTO `user_address` VALUES (19, 'ac768502-d1a4-11e7-aef6-d379d22c0e57', 1, '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:51:25', 0);
INSERT INTO `user_address` VALUES (20, 'b98d467c-d1a4-11e7-8684-1fa140b88c7a', 1, '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:51:47', 0);
INSERT INTO `user_address` VALUES (21, 'dba46d1a-d1a6-11e7-8353-3b9b8e0150f7', 1, '22333', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 14:07:03', 0);
INSERT INTO `user_address` VALUES (22, 'dbe7b512-d1aa-11e7-9083-31ee90d7184d', 1, '33123', '111', '吉林省 长春市 南关区', '', '22123', '2017-11-25 14:35:42', 0);
INSERT INTO `user_address` VALUES (23, 'c32b9344-d1fb-11e7-95eb-53f8e4bbb080', 1, '22', '111', '内蒙古自治区 呼和浩特市 新城区', '', '123', '2017-11-26 00:14:49', 0);
INSERT INTO `user_address` VALUES (24, 'e60fc6f0-d1fb-11e7-acab-cd9f76cde625', 1, '22', '111', '内蒙古自治区 呼和浩特市 新城区', '', '123', '2017-11-26 00:15:48', 0);
INSERT INTO `user_address` VALUES (25, 'ce770cba-d386-11e7-be97-5be2c5e49661', 1, 'aa', '11', '黑龙江省 哈尔滨市 道里区', '', '1122', '2017-11-27 23:22:40', 0);
INSERT INTO `user_address` VALUES (26, '30b06c90-d572-11e7-b7b0-00163e01ddfd', 2, 'cejshd', '13012345678', '辽宁省 沈阳市 和平区', '', 'hdhhdhd', '2017-11-30 10:00:07', 1);
INSERT INTO `user_address` VALUES (27, '9a4dfc6c-d572-11e7-89cc-00163e01ddfd', 1, '123', '123', '吉林省 长春市 南关区', '', '22', '2017-11-30 10:03:04', 0);
INSERT INTO `user_address` VALUES (28, 'e0a524f0-dbf9-11e7-99db-00163e01ddfd', 1, 'sz', '139', '江苏省 南京市 玄武区', '', 'whjxhx', '2017-12-08 17:26:32', 0);
INSERT INTO `user_address` VALUES (29, '957b56c8-e49d-11e7-9714-0c4de9c9a8d8', 1, 'sf', '15555555555', '北京 北京市 东城区', '', '123', '2017-12-19 17:18:32', 0);
INSERT INTO `user_address` VALUES (30, 'fb3e48de-e4a8-11e7-b994-0c4de9c9a8d8', 1, '1234', '1555555555', '北京 北京市 东城区', '', '123', '2017-12-19 18:40:07', 0);
INSERT INTO `user_address` VALUES (31, '3fe31836-e54c-11e7-b809-0c4de9c9a8d8', 1, '测试测试', '15555555555', '广东省 广州市 荔湾区', '', '广州市大街1220号', '2017-12-20 14:08:51', 0);
INSERT INTO `user_address` VALUES (32, 'f07dcc2a-e6f2-11e7-bea2-0c4de9c9a8d8', 1, '订单测试', '15555555555', '青海省 西宁市 城东区', '', '青海的', '2017-12-22 16:34:34', 0);
COMMIT;

-- ----------------------------
-- Table structure for user_event
-- ----------------------------
DROP TABLE IF EXISTS `user_event`;
CREATE TABLE `user_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `event_type` varchar(20) DEFAULT NULL COMMENT '参与的活动类型：如survey/xxxx',
  `event_type_uuid` varchar(36) DEFAULT NULL,
  `event_type_step_total` tinyint(4) DEFAULT NULL COMMENT '参与活动的步骤',
  `event_type_step_current` tinyint(4) DEFAULT NULL COMMENT '当前步骤，用于确认是否已完成',
  `event_memo` varchar(100) DEFAULT NULL COMMENT '备注，这个同时会写到订单的备住里',
  `order_temporary` varchar(200) DEFAULT NULL COMMENT '订单暂存。如果最后选择支付了。就处理掉。否则就存在这里。供后续查看用户的选择',
  `order_uuid` varchar(36) DEFAULT NULL COMMENT '参与活动时是否购物。购物的UUID',
  `order_is_paid` tinyint(4) DEFAULT NULL COMMENT '是否支付',
  `order_is_shipped` tinyint(4) DEFAULT NULL,
  `user_address_uuid` varchar(36) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of user_event
-- ----------------------------
BEGIN;
INSERT INTO `user_event` VALUES (1, 'adf2cf0c-d1a0-11e7-9544-01a82e43381f', 1, NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, NULL, NULL, '2017-11-25 13:22:50', '2017-11-26 00:14:08');
INSERT INTO `user_event` VALUES (2, '498f6122-d1a2-11e7-bd34-3943a072874d', 1, NULL, NULL, NULL, NULL, NULL, '{\"products\":{\"free\":\"1\",\"gift\":{\"2\":\"1\"}},\"logistics\":\"北京-彩虹公共卫生服务中心\"}', NULL, NULL, NULL, '498f1d8e-d1a2-11e7-89ed-7d2a012e2664', '2017-11-25 13:34:20', '2017-11-26 00:14:09');
INSERT INTO `user_event` VALUES (3, '3e1675b4-d1a3-11e7-8af7-795cbc072867', 1, NULL, NULL, NULL, NULL, NULL, '{\"products\":null,\"logistics\":\"1\"}', NULL, NULL, NULL, '3e161da8-d1a3-11e7-97ce-510de852e2e7', '2017-11-25 13:41:10', '2017-11-26 00:14:10');
INSERT INTO `user_event` VALUES (4, '80f48060-d1a3-11e7-bb57-c1f29b732078', 1, NULL, NULL, NULL, NULL, NULL, '{\"products\":{\"free\":\"1\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, '80f43cae-d1a3-11e7-a5f5-193ed3b63bd7', '2017-11-25 13:43:03', '2017-11-26 00:14:11');
INSERT INTO `user_event` VALUES (5, '352009e2-d1a4-11e7-872e-b99a8bb22ed5', 1, NULL, NULL, NULL, NULL, NULL, '{\"products\":{\"free\":\"1\",\"gift\":{\"2\":\"on\"},\"charge\":{\"3\":\"on\",\"4\":\"on\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, '351f7806-d1a4-11e7-b6cb-01d5cf31448c', '2017-11-25 13:48:05', '2017-11-26 00:14:11');
INSERT INTO `user_event` VALUES (6, '525630c2-d1a4-11e7-9bbd-6d3ce9d66f89', 1, NULL, NULL, NULL, NULL, NULL, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, '5255cc9a-d1a4-11e7-a0c5-f94afebbebbc', '2017-11-25 13:48:54', '2017-11-26 00:14:11');
INSERT INTO `user_event` VALUES (7, '744181b4-d1a4-11e7-87e8-8fe8e8dee091', 1, NULL, NULL, NULL, NULL, NULL, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, '74412304-d1a4-11e7-9244-f9ee89ddb9f8', '2017-11-25 13:49:51', '2017-11-26 00:14:12');
INSERT INTO `user_event` VALUES (8, '7a5c48f4-d1a4-11e7-80d9-5b70f41580d9', 1, NULL, NULL, NULL, NULL, NULL, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, '7a5beb52-d1a4-11e7-bf90-93f403193961', '2017-11-25 13:50:01', '2017-11-26 00:14:12');
INSERT INTO `user_event` VALUES (9, '9951a858-d1a4-11e7-aa6b-cbb108ba6468', 1, NULL, NULL, NULL, NULL, NULL, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, '9951538a-d1a4-11e7-921f-c71304dac593', '2017-11-25 13:50:53', '2017-11-26 00:14:12');
INSERT INTO `user_event` VALUES (10, 'ac76ead8-d1a4-11e7-b85b-2d0cc20af6da', 11, NULL, NULL, NULL, NULL, NULL, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, 'ac768502-d1a4-11e7-aef6-d379d22c0e57', '2017-11-25 13:51:25', '2017-11-26 00:14:13');
INSERT INTO `user_event` VALUES (11, 'b98dbf6c-d1a4-11e7-b9fc-cb5cb6112a5f', 1, NULL, NULL, NULL, NULL, NULL, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, 'b98d467c-d1a4-11e7-8684-1fa140b88c7a', '2017-11-25 13:51:47', '2017-11-26 00:14:13');
INSERT INTO `user_event` VALUES (12, 'dba4f0fa-d1a6-11e7-a9c2-33244edfef1a', 1, NULL, NULL, NULL, NULL, NULL, '{\"products\":null,\"logistics\":\"1\"}', NULL, NULL, NULL, 'dba46d1a-d1a6-11e7-8353-3b9b8e0150f7', '2017-11-25 14:07:03', '2017-11-26 00:14:13');
INSERT INTO `user_event` VALUES (13, '6a77520a-d1a7-11e7-a25d-c5e307bc0b72', 1, NULL, NULL, NULL, NULL, NULL, '{\"products\":null,\"logistics\":\"1\"}', NULL, NULL, NULL, 'dba46d1a-d1a6-11e7-8353-3b9b8e0150f7', '2017-11-25 14:11:03', '2017-11-26 00:14:14');
INSERT INTO `user_event` VALUES (14, 'dbe837bc-d1aa-11e7-87e4-dde4e96d7144', 1, NULL, NULL, NULL, NULL, '', '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"on\"},\"charge\":{\"3\":\"on\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, 'dbe7b512-d1aa-11e7-9083-31ee90d7184d', '2017-11-25 14:35:42', '2017-11-26 00:14:14');
INSERT INTO `user_event` VALUES (15, '30466ce2-d1f7-11e7-85ab-d9fd7748ddb9', 1, NULL, NULL, NULL, NULL, '', '{\"products\":{\"free\":\"1\",\"gift\":{\"2\":\"1\"},\"charge\":{\"4\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, 'dbe7b512-d1aa-11e7-9083-31ee90d7184d', '2017-11-25 23:42:05', '2017-11-26 00:14:27');
INSERT INTO `user_event` VALUES (16, 'a79dd316-d1f7-11e7-8a36-1f61410b28d5', 11, NULL, NULL, NULL, NULL, '', '{\"products\":{\"gift\":{\"2\":\"1\"},\"charge\":{\"4\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, 'dbe7b512-d1aa-11e7-9083-31ee90d7184d', '2017-11-25 23:45:25', '2017-11-26 00:14:15');
INSERT INTO `user_event` VALUES (19, 'c32bdc50-d1fb-11e7-8279-1d3afaf4123c', 1, NULL, NULL, NULL, NULL, '1', '{\"products\":{\"gift\":{\"2\":\"1\"},\"charge\":{\"4\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, 'c32b9344-d1fb-11e7-95eb-53f8e4bbb080', '2017-11-26 00:14:49', '2017-11-26 00:52:59');
INSERT INTO `user_event` VALUES (20, 'e6100cf0-d1fb-11e7-bb80-17a0df7d0718', 1, 'survey', '14cd636c-d201-11e7-bafd-4faf3b193a99', 7, 6, '1', '{\"products\":{\"gift\":{\"2\":\"on\"},\"charge\":{\"4\":\"on\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, 'e60fc6f0-d1fb-11e7-acab-cd9f76cde625', '2017-11-26 00:15:48', '2017-11-26 01:05:26');
INSERT INTO `user_event` VALUES (21, 'ce7790fe-d386-11e7-8a14-a7e0c78470c3', 1, 'survey', 'e640b188-d387-11e7-8ec8-a3d79151295a', 7, 4, '', '{\"products\":{\"gift\":{\"2\":\"1\"}},\"logistics\":\"2\"}', NULL, NULL, NULL, 'ce770cba-d386-11e7-be97-5be2c5e49661', '2017-11-27 23:22:40', '2017-11-28 00:22:37');
INSERT INTO `user_event` VALUES (22, '30b09d78-d572-11e7-a855-00163e01ddfd', 2, 'survey', '431a8640-d572-11e7-8c70-00163e01ddfd', 7, 6, 'dndihd', '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"on\",\"4\":\"on\"},\"charge\":{\"6\":\"on\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, '30b06c90-d572-11e7-b7b0-00163e01ddfd', '2017-11-30 10:00:07', '2017-11-30 10:02:23');
INSERT INTO `user_event` VALUES (23, '9a4e2fd4-d572-11e7-a0e6-00163e01ddfd', 1, 'survey', 'a6829f60-d572-11e7-a213-00163e01ddfd', 7, 6, '123', '{\"products\":{\"free\":\"1\",\"gift\":{\"2\":\"on\",\"4\":\"on\"},\"charge\":{\"6\":\"on\"}},\"logistics\":\"2\"}', NULL, NULL, NULL, '9a4dfc6c-d572-11e7-89cc-00163e01ddfd', '2017-11-30 10:03:04', '2017-11-30 10:03:45');
INSERT INTO `user_event` VALUES (24, '927f45a8-dbf9-11e7-ba79-00163e01ddfd', 1, 'survey', 'a0ee4b84-dbf9-11e7-8b12-00163e01ddfd', 7, 6, '', '{\"products\":{\"free\":\"1\",\"gift\":{\"2\":\"1\"},\"charge\":{\"6\":\"1\"}},\"logistics\":\"2\"}', NULL, NULL, NULL, '9a4dfc6c-d572-11e7-89cc-00163e01ddfd', '2017-12-08 17:24:20', '2017-12-08 17:25:01');
INSERT INTO `user_event` VALUES (25, 'e0a556f0-dbf9-11e7-98ff-00163e01ddfd', 1, 'survey', 'eb0ddc02-dbf9-11e7-9283-00163e01ddfd', 7, 6, '', '{\"products\":{\"free\":\"0\",\"gift\":{\"4\":\"1\"},\"charge\":{\"6\":\"1\"}},\"logistics\":\"5\"}', NULL, NULL, NULL, 'e0a524f0-dbf9-11e7-99db-00163e01ddfd', '2017-12-08 17:26:32', '2017-12-08 17:27:01');
INSERT INTO `user_event` VALUES (26, '9586a870-e49d-11e7-ac66-0c4de9c9a8d8', 1, 'survey', 'a46d968c-e49d-11e7-9412-0c4de9c9a8d8', 7, 6, '123', '{\"products\":null,\"logistics\":\"4\"}', NULL, NULL, NULL, '957b56c8-e49d-11e7-9714-0c4de9c9a8d8', '2017-12-19 17:18:32', '2017-12-19 18:36:45');
INSERT INTO `user_event` VALUES (27, 'fb3e870e-e4a8-11e7-ab97-0c4de9c9a8d8', 1, 'survey', 'f4d5c6fa-e4aa-11e7-b4b4-0c4de9c9a8d8', 7, 1, '', '{\"products\":null,\"logistics\":\"5\"}', NULL, NULL, NULL, 'fb3e48de-e4a8-11e7-b994-0c4de9c9a8d8', '2017-12-19 18:40:07', '2017-12-19 19:44:52');
INSERT INTO `user_event` VALUES (28, '3ffb74d0-e54c-11e7-a6f2-0c4de9c9a8d8', 1, 'survey', '5efd2608-e54c-11e7-aa35-0c4de9c9a8d8', 7, 6, '备注信息', '{\"products\":{\"free\":\"1\",\"gift\":{\"4\":\"1\",\"5\":\"1\"},\"charge\":{\"6\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, '3fe31836-e54c-11e7-b809-0c4de9c9a8d8', '2017-12-20 14:08:51', '2017-12-20 14:13:11');
INSERT INTO `user_event` VALUES (29, '1b7b56d0-e573-11e7-87b7-0c4de9c9a8d8', 1, 'survey', '327aeaa8-e573-11e7-beed-0c4de9c9a8d8', 7, 6, '', '{\"products\":{\"free\":\"3\",\"gift\":{\"5\":\"1\"}},\"logistics\":\"1\"}', NULL, NULL, NULL, '3fe31836-e54c-11e7-b809-0c4de9c9a8d8', '2017-12-20 18:47:00', '2017-12-20 18:48:21');
INSERT INTO `user_event` VALUES (30, 'f083b3c4-e6f2-11e7-8525-0c4de9c9a8d8', 1, 'survey', 'fecc27f4-e6f2-11e7-b039-0c4de9c9a8d8', 7, 6, '', '{\"products\":{\"free\":\"3\",\"gift\":{\"4\":\"1\",\"5\":\"1\"},\"charge\":{\"6\":\"1\"}},\"logistics\":\"3\"}', NULL, NULL, NULL, 'f07dcc2a-e6f2-11e7-bea2-0c4de9c9a8d8', '2017-12-22 16:34:34', '2017-12-22 16:35:37');
COMMIT;

-- ----------------------------
-- Table structure for user_online
-- ----------------------------
DROP TABLE IF EXISTS `user_online`;
CREATE TABLE `user_online` (
  `openid` char(28) NOT NULL,
  `token` char(32) DEFAULT NULL,
  `verify_code` char(6) DEFAULT NULL,
  `verify_time` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for user_profile
-- ----------------------------
DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE `user_profile` (
  `uid` int(11) NOT NULL,
  `uuid` varchar(36) NOT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `city_code` varchar(6) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL DEFAULT '' COMMENT '微信openid',
  `unionid` varchar(50) DEFAULT NULL,
  `nickname` varchar(255) NOT NULL DEFAULT '' COMMENT '微信昵称',
  `realname` varchar(255) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `gender` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1：男，2：女',
  `birthdate` varchar(50) NOT NULL DEFAULT '',
  `nation` varchar(50) NOT NULL DEFAULT '' COMMENT '民族',
  `province` varchar(200) NOT NULL DEFAULT '' COMMENT '用户在微信个人资料填写的省份',
  `city` varchar(200) NOT NULL DEFAULT '' COMMENT '普通用户在微信个人资料填写的城市',
  `country` varchar(200) NOT NULL DEFAULT '' COMMENT '用户在微信个人资料填写的国家，如中国为CN',
  `headimgurl` varchar(255) NOT NULL DEFAULT '' COMMENT '用户微信头像',
  `age` int(3) NOT NULL DEFAULT '18' COMMENT '年龄',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `qq` varchar(11) NOT NULL DEFAULT '' COMMENT 'QQ',
  `telephone` varchar(15) NOT NULL DEFAULT '' COMMENT '手机号码',
  `address` varchar(100) NOT NULL DEFAULT '',
  `is_updated` tinyint(4) NOT NULL DEFAULT '0',
  `is_subscribe` tinyint(4) DEFAULT '-1',
  `subscribe_time` int(11) DEFAULT '0',
  `tags` varchar(255) NOT NULL DEFAULT '{}',
  `created_at` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q', 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q', '膘叔', '膘叔', 1, '', '', '', '', '', 'http://wx.qlogo.cn/mmopen/vi_32/Q3auHgzwzM4K9ArFKuIJGtZqH8II5JAS8XCdSTuOahmGLFS24uQyqZqGYy8OKzct7o91M3RIe4YgrDrweRUIOg/0', 18, '', '', '', '', 0, 1, 0, '[]', '2017-11-22 00:51:01', '2017-11-22 00:51:01');
COMMIT;

-- ----------------------------
-- Table structure for wx_notify_log
-- ----------------------------
DROP TABLE IF EXISTS `wx_notify_log`;
CREATE TABLE `wx_notify_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `data` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '异步通知数据',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '通知时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;
