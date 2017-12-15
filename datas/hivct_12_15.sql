/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50635
 Source Host           : localhost
 Source Database       : hivct

 Target Server Type    : MySQL
 Target Server Version : 50635
 File Encoding         : utf-8

 Date: 12/15/2017 22:46:29 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admins`
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `admins`
-- ----------------------------
BEGIN;
INSERT INTO `admins` VALUES ('1', 'admin', '$2y$10$PKjrqAy3O9F7a4Htbep2du8fN7NpWo08Q96tH7yBznK/VMnNu1aYW', '管理员', '0', '', '1');
COMMIT;

-- ----------------------------
--  Table structure for `answers`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `cache`
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(100) NOT NULL DEFAULT '' COMMENT '键',
  `value` text NOT NULL COMMENT '值',
  `expire_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `feedback`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `fields`
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
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `fields`
-- ----------------------------
BEGIN;
INSERT INTO `fields` VALUES ('18', '收货信息', 'shouhuoxinxi', '', '', '', '', '0', '', '0', '6', '0'), ('19', '免费试剂', 'mianfeishiji', 'product', '', '', '', '1', '', '18', '6', '0'), ('20', '收货人', 'shouhuoren', 'input', '', '', '请输入收货人地址', '1', '', '18', '6', '0'), ('21', '收货手机', 'shouhuoshouji', 'input', '', '', '', '1', '', '18', '6', '0'), ('22', '收货地址', 'shouhuodizhi', 'addrbox', '', '', '', '1', '', '18', '6', '0'), ('23', '收货详细地址', 'shouhuoxiangxidizhi', 'input', '', '', '', '1', '', '18', '6', '0'), ('24', '留言备注', 'liuyanbeizhu', 'textarea', '', '', '', '0', '', '18', '6', '0'), ('25', '个人信息', 'gerenxinxi', '', '', '', '', '0', '', '0', '6', '0'), ('26', '真实姓名', 'zhenshixingming', 'input', '', '', '', '1', '', '25', '6', '0'), ('27', '性别', 'xingbie', 'radio', '男=nan|女=nv', '', '', '1', '', '25', '6', '0'), ('28', '出生年月', 'chushengnianyue', 'date', '', '', '', '1', '', '25', '6', '0'), ('29', '年龄', 'nianling', 'number', '', '', '', '1', '', '25', '6', '0'), ('30', '邮箱', 'youxiang', 'input', '', '', '', '0', '', '25', '6', '0'), ('31', '联系电话', 'lianxidianhua', 'input', '', '', '', '1', '', '25', '6', '0'), ('32', 'QQ', 'QQ', 'input', '', '', '', '0', '', '25', '6', '0'), ('33', '微信', 'weixin', 'input', '', '', '', '0', '', '25', '6', '0'), ('34', '补充信息', 'buchongxinxi', '', '', '', '', '0', '', '0', '6', '0'), ('35', '文化程度', 'wenhuachengdu', 'select', '文盲=wenmang|小学=xiaoxue|初中=chuzhong|高中/中专=gaozhongzhongzhuan|大专/大学=dazhuandaxue|研究生及以上=yanjiushengjiyishang', '', '', '1', '', '34', '6', '0'), ('36', '婚姻状况', 'hunyinzhuangkuang', 'select', '未婚=weihun|男性同居=nanxingtongju|已婚有配偶=yihunyoupeiou|离异或丧偶=liyihuosangou|不详=buxiang', '', '', '1', '', '34', '6', '0'), ('37', '主要职业', 'zhuyaozhiye', 'select', '全职工作（包括自由职业）=quanzhigongzuobaokuoziyouzhiye|钟点工=zhongdiangong|学生=xuesheng|没有工作=meiyougongzuo|离退休=lituixiu', '', '', '1', '', '34', '6', '0'), ('38', '月平均收入', 'yuepingjunshouru', 'select', '无收入=wushouru|学生=xuesheng|1000元以下=1000yuanyixia|1000~2999元=10002999yuan|3000~4999元=30004999yuan|5000~9999元=50009999yuan|10000元及以上=10000yuanjiyishang', '', '', '1', '', '34', '6', '0'), ('81', '您第一次与男性发生性行为的年龄', 'nindiyiciyunanxingfashengxingxingweidenianling', 'input', '', '', '没有请输入无', '1', '', '34', '6', '0'), ('82', '您的性取向', 'nindexingquxiang', 'select', '同性=tongxing|异性=yixing|双性=shuangxing|不确定=buqueding', '', '', '1', '', '34', '6', '0'), ('83', '您有肛交行为吗', 'ninyougangjiaoxingweima', 'select', '有=you|没有=meiyou', '', '', '1', '', '34', '6', '0'), ('84', '您的性角色是', 'nindexingjueseshi', 'select', '完全是主动肛交=wanquanshizhudonggangjiao|主要是主动肛交=zhuyaoshizhudonggangjiao|两者兼有，两者差不多=liangzhejianyouliangzhechabuduo|主要是被动肛交=zhuyaoshibeidonggangjiao|完全被动肛交=wanquanbeidonggangjiao|无肛交=wugangjiao', '', '', '1', '', '34', '6', '0'), ('85', '近三个月您有多少个女性性伴', 'jinsangeyueninyouduoshaogenvxingxingban', 'input', '', '', '没有请输入0或无', '1', '', '34', '6', '0'), ('86', '近三个月您有多少个男性性伴', 'jinsangeyueninyouduoshaogenanxingxingban', 'input', '', '', '', '1', '', '34', '6', '0'), ('87', '最近三个月与男行肛交时是否每次都是用了安全套', 'zuijinsangeyueyunanxinggangjiaoshishifoumeicidoushiyongleanquantao', 'radio', '是=shi|否=fou', '', '', '1', '', '34', '6', '0'), ('88', '最近一次（三个月内）与男性肛交时是否使用了安全套', 'zuijinyicisangeyueneiyunanxinggangjiaoshishifoushiyongleanquantao', 'radio', '是=shi|否=fou', '', '', '1', '', '34', '6', '0'), ('89', '艾滋病快速问卷信息', 'aizibingkuaisuwenjuanxinxi', '', null, '', '', '0', '', '0', '6', '0'), ('90', '你知道当地那里可以检测HIV', 'nizhidaodangdinalikeyijianceHIV', 'checkbox', '社区小组=shequxiaozu|当地疾控中心=dangdijikongzhongxin|医院=yiyuan|不知道=buzhidao', '', '', '1', '', '89', '6', '0'), ('91', '其他可以检测HIV的地方', 'qitakeyijianceHIVdedifang', 'input', '', '', '', '0', '', '89', '6', '0'), ('92', '您是否接受过HIV检测', 'ninshifoujieshouguoHIVjiance', 'input', '', '', '有则输入多少次，没有请输入否', '1', '', '89', '6', '0'), ('93', '您最近一次参加HIV检测时什么时候', 'ninzuijinyicicanjiaHIVjianceshishenmeshihou', 'input', '', '', '', '1', '', '89', '6', '0'), ('94', '最近6个月内做过多少次检测？', 'zuijin6geyueneizuoguoduoshaocijiance', 'number', '', '', '', '1', '', '89', '6', '0'), ('95', '是否知道自己最近一次HIV检测的结果？', 'shifouzhidaozijizuijinyiciHIVjiancedejieguo', 'radio', '是=shi|否=fou|从未检测过=congweijianceguo', '', '', '1', '', '89', '6', '0'), ('96', '最近一次你为什么要参加HIV检测', 'zuijinyiciniweishimeyaocanjiaHIVjiance', 'radio', '一些政府的HIV项目提供检测=yixiezhengfudeHIVxiangmutigongjiance|一些志愿者组织的HIV项目提供检测=yixiezhiyuanzhezuzhideHIVxiangmutigongjiance|自己想去疾控中心的HIV门诊检测=zijixiangqujikongzhongxindeHIVmenzhenjiance|从未检测过=congweijianceguo', '', '', '1', '', '89', '6', '0'), ('97', '参加HIV检测的其他原因', 'canjiaHIVjiancedeqitayuanyin', 'input', '', '', '', '0', '', '89', '6', '0'), ('98', '你对参加HIV检测的主要顾虑是什么', 'niduicanjiaHIVjiancedezhuyaogulvshishenme', 'checkbox', '检测需要提交实名=jiancexuyaotijiaoshiming|因为自己感染HIV的危险小=yinweizijiganranHIVdeweixianxiao|等待检测结果的时间过长=dengdaijiancejieguodeshijianguochang|因为害怕如果检测结果阳性，自己的名字会上报政府=yinweihaiparuguojiancejieguoyangxingzijidemingzihuishangbaozhengfu|无法保护自己隐私=wufabaohuzijiyinsi|因为害怕知道自己已经感染而不愿意去检测=yinweihaipazhidaozijiyijingganranerbuyuanyiqujiance|因为不知道去哪里检测=yinweibuzhidaoqunalijiance|因为到检测地点接受检查交通部方便=yinweidaojiancedidianjieshoujianchajiaotongbufangbian|因为害怕别人认为自己是HIV感染者=yinweihaipabierenrenweizijishiHIVganranzhe|因为没有时间去检测=yinweimeiyoushijianqujiance', '', '', '1', '', '89', '6', '0'), ('99', '对参加HIV检测的主要顾虑其他原因', 'duicanjiaHIVjiancedezhuyaogulvqitayuanyin', 'input', '', '', '', '0', '', '89', '6', '0'), ('100', '您对感染HIV后是否治疗的看法是', 'ninduiganranHIVhoushifouzhiliaodekanfashi', 'checkbox', '积极接受治疗=jijijieshouzhiliao|担心药物副作用，暂不接受=danxinyaowufuzuoyongzanbujieshou|味道治疗标准就不用治疗=weidaozhiliaobiaozhunjiubuyongzhiliao|担心很快耐药=danxinhenkuainaiyao|担心吃药后被人发现=danxinchiyaohoubeirenfaxian|认为无法治愈，治了也没有一样，任其自然=renweiwufazhiyuzhileyemeiyouyiyangrenqiziran', '', '', '1', '', '89', '6', '0'), ('101', '对HIV治疗的其他看法', 'duiHIVzhiliaodeqitakanfa', 'input', '', '', '', '0', '', '89', '6', '0');
COMMIT;

-- ----------------------------
--  Table structure for `forms`
-- ----------------------------
DROP TABLE IF EXISTS `forms`;
CREATE TABLE `forms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '表单名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=删除，1=正常，2=禁用',
  `add_time` int(10) NOT NULL DEFAULT '0',
  `upd_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `forms`
-- ----------------------------
BEGIN;
INSERT INTO `forms` VALUES ('6', '艾滋问卷调查', '1', '1466657203', '1468136486');
COMMIT;

-- ----------------------------
--  Table structure for `input_types`
-- ----------------------------
DROP TABLE IF EXISTS `input_types`;
CREATE TABLE `input_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '普通类型',
  `comment` varchar(255) CHARACTER SET utf8 DEFAULT '' COMMENT '注释',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `input_types`
-- ----------------------------
BEGIN;
INSERT INTO `input_types` VALUES ('1', 'input', '文本框'), ('2', 'number', '数字输入框'), ('3', 'select', '下拉框'), ('4', 'radio', '单选框'), ('5', 'checkbox', '多选框'), ('6', 'textarea', '多行文本框'), ('7', 'date', '日期选择框'), ('8', 'product', '试剂列表'), ('9', 'addrbox', '城市选择框');
COMMIT;

-- ----------------------------
--  Table structure for `logistics`
-- ----------------------------
DROP TABLE IF EXISTS `logistics`;
CREATE TABLE `logistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sign_name` varchar(20) DEFAULT NULL COMMENT '英文名',
  `title` varchar(100) DEFAULT NULL COMMENT '店名',
  `status` tinyint(4) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `logistics`
-- ----------------------------
BEGIN;
INSERT INTO `logistics` VALUES ('2', '上海', '上海', '1', '2017-11-27 21:55:34'), ('3', '不告诉你', '河南省xx市', '1', '2017-11-27 21:55:46'), ('4', 'gx', '广西', '1', '2017-11-27 21:55:58');
COMMIT;

-- ----------------------------
--  Table structure for `order_detail`
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `order_detail`
-- ----------------------------
BEGIN;
INSERT INTO `order_detail` VALUES ('1', '22be728c-d4ee-11e7-810f-3f29ae6628c3', '22b0d1b8-d4ee-11e7-ae01-1bb06ac0cc82', '6f8e45de-d4ed-11e7-a33f-27b3a1684ff7', '血液2222', '10.00', '2017-11-29 18:14:50', null, null, null, null, '2017-11-29 18:14:50', '2017-11-29 18:14:50'), ('2', '22beaf7c-d4ee-11e7-acaf-9b9bf6f9bfac', '22b0d1b8-d4ee-11e7-ae01-1bb06ac0cc82', '71edf126-d4ed-11e7-811f-55481c7b8f90', '血液[雅培/万孚/艾博/英科]', '0.00', '2017-11-29 18:14:50', null, null, null, null, '2017-11-29 18:14:50', '2017-11-29 18:14:50'), ('3', '4e65bee0-d4ee-11e7-8ed3-7743577b376c', '4e5eb352-d4ee-11e7-8b41-394955c5cfdc', '6f8e45de-d4ed-11e7-a33f-27b3a1684ff7', '血液2222', '10.00', '2017-11-29 18:16:04', null, null, null, null, '2017-11-29 18:16:04', '2017-11-29 18:16:04'), ('4', '4e660396-d4ee-11e7-b875-8ddceb9a8679', '4e5eb352-d4ee-11e7-8b41-394955c5cfdc', '71edf126-d4ed-11e7-811f-55481c7b8f90', '血液[雅培/万孚/艾博/英科]', '0.00', '2017-11-29 18:16:04', null, null, null, null, '2017-11-29 18:16:04', '2017-11-29 18:16:04');
COMMIT;

-- ----------------------------
--  Table structure for `order_list`
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
  `ship_status` tinyint(4) DEFAULT NULL COMMENT '配送状态',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `source_type` varchar(10) DEFAULT NULL,
  `source_uuid` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `out_trade_no` (`out_trade_no`) USING BTREE,
  UNIQUE KEY `uuid` (`uuid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `order_list`
-- ----------------------------
BEGIN;
INSERT INTO `order_list` VALUES ('1', 'd118a83a-d4e8-11e7-90dc-9bd3bf7cd3f2', '1', '1', '互联网+艾滋病快速自检试剂发放', '血液2222,血液[雅培/万孚/艾博/英科]', '', '10.00', '', null, '0', null, null, null, null, null, '2017-11-29 17:36:46', '2017-11-30 12:40:15', null, null), ('6', '22b0d1b8-d4ee-11e7-ae01-1bb06ac0cc82', '2', '1', '互联网+艾滋病快速自检试剂发放', '血液2222,血液[雅培/万孚/艾博/英科]', '', '10.00', '', null, '0', null, null, null, null, null, '2017-11-29 18:14:50', '2017-11-30 12:40:15', null, null), ('7', '4e5eb352-d4ee-11e7-8b41-394955c5cfdc', '3', '1', '互联网+艾滋病快速自检试剂发放', '血液2222,血液[雅培/万孚/艾博/英科]', '', '10.00', '', null, '0', null, null, null, null, null, '2017-11-29 18:16:04', '2017-11-30 12:40:16', 'survey', 'e6100cf0-d1fb-11e7-bb80-17a0df7d0718');
COMMIT;

-- ----------------------------
--  Table structure for `order_pay_log`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `reagent`
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `reagent`
-- ----------------------------
BEGIN;
INSERT INTO `reagent` VALUES ('1', '7425d5c6-d4ed-11e7-a3cf-d3d4ae4ddd24', '口腔黏膜渗出液金标法检测试剂（唾液试剂）', '', '', 'free', '0.00', '1', '-1', '', ''), ('2', '71edf126-d4ed-11e7-811f-55481c7b8f90', '血液[雅培/万孚/艾博/英科]', '', '', 'gift', '0.00', '1', '-1', '', ''), ('3', '5d74bca2-d4ed-11e7-b53a-dd54d8082bda', '23332', '22', '', 'charge', '0.00', '1', '-1', '', ''), ('4', '6f8e45de-d4ed-11e7-a33f-27b3a1684ff7', '血液2222', '', '', 'charge', '10.00', '1', '-1', '', ''), ('5', '8d4628e0-d4ec-11e7-bbac-03e64ac709fe', '123', '22', '', 'gift', '0.00', '1', '-1', '', ''), ('6', '92753bd0-d4ec-11e7-adda-170105a15384', 'tetxxxx', 'test', '', '0', '0.00', '1', '-1', '', '');
COMMIT;

-- ----------------------------
--  Table structure for `relation_reagent_logistics`
-- ----------------------------
DROP TABLE IF EXISTS `relation_reagent_logistics`;
CREATE TABLE `relation_reagent_logistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) DEFAULT NULL,
  `reagent_id` smallint(6) NOT NULL,
  `logistics_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `relation_reagent_logistics`
-- ----------------------------
BEGIN;
INSERT INTO `relation_reagent_logistics` VALUES ('12', '8d4f418c-d4ec-11e7-b042-3b069406a2bc', '5', '3');
COMMIT;

-- ----------------------------
--  Table structure for `survey_list`
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `survey_list`
-- ----------------------------
BEGIN;
INSERT INTO `survey_list` VALUES ('1', '', '1', '2017-10-26', '3333', '', '', null, '', '', '', '', '', '', '', null, '', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null), ('2', '', '1', '2017-10-23', 'ss', '', '', null, '', '', '', '', '', '', '', null, '', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null), ('3', '', '1', '2017-11-19', 'xx', '', '', null, '', '', '', '', '', '', '', null, '', '0', null, '', '1', '1', null, null, '', '', '', '', null, null, '', null, null, '1', '', null, '1', null, '', '1', null, '', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '', null, '', null, '', null, '', null, null, null, null, null, '', null, null, null, null, null, '', null, null, '', '', '', '', null, '', '', null, null, null, null, null, '', null, '', null, '是', '不知道', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2017-11-19 15:31:39'), ('4', '', '1', '2017-11-22', '好', '', '', null, '初中', '离异或丧偶', '商业服务业', '', '5000-9999元', '外省', '', null, '6月-1年', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2017-11-22 19:55:35'), ('5', '', '1', '2017-11-24', '3333', '满族', '男', '1990-01-17', '初中', '同居', '其他', '好吧', '5000-9999元', '本省外市', '北京 北京市', '110000', '5年以上', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2017-11-24 19:20:45'), ('6', 'f8d243e4-d1fb-11e7-a888-73eef3a3cbee', '1', '2017-11-26', '33', '满族', '男', '1990-01-05', '小学', '同居', '医务人员', '', '3000-4999元', '外省', '北京 北京市', '110000', '1-5年', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2017-11-26 00:16:19'), ('7', '5af61b84-d1fe-11e7-b26a-69f6e1ab259d', '1', '2017-11-26', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', null, '', null, null, null, null, '', '', '', '', null, null, '', '', null, null, '', null, null, '', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2017-11-26 00:33:23'), ('8', '746b8482-d1fe-11e7-b854-ed97b16f82ad', '1', '2017-11-26', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', null, '', null, null, null, null, '', '', '', '', null, null, '', '', null, null, '', null, null, '', '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2017-11-26 00:34:06'), ('9', '3ee08522-d200-11e7-9560-a3cfe0a7acf3', '1', '2017-11-26', null, null, null, null, null, null, null, null, null, null, null, null, null, '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1', '摇头丸', '1-3次/月', null, null, null, null, null, null, null, '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2017-11-26 00:46:55'), ('10', '14cd636c-d201-11e7-bafd-4faf3b193a99', '1', '2017-11-26', '11', '壮族', '男', '1990-01-01', '小学', '同居', '医务人员', '', '5000-9999元', '外省', '北京 北京市', '110000', '1-5年', '0', null, '', null, null, null, null, '', '', '', '', null, null, '', '', null, null, '', null, null, '', '', null, '1', '大麻', '1-3次/月', null, null, null, null, null, null, null, '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '', null, '', null, '', null, '', null, null, null, null, null, '', null, null, null, null, null, '', null, '', '', '', '', '', null, '', '', null, null, null, null, null, '', null, '', null, '不知道', '', '1', null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, '', '2017-11-26 00:52:54'), ('11', 'fc041ea2-d386-11e7-a180-9547a26ee9c5', '1', '2017-11-27', '33', '壮族', '男', '1990-01-20', '初中', '同居', '自由职业', '', '5000-9999元', '本市', '吉林省 长春市', '220100', '1-5年', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2017-11-27 23:23:56'), ('12', '804d7d16-d387-11e7-89d3-ef2692b4872f', '1', '2017-11-27', null, null, null, null, null, null, null, null, null, null, null, null, null, '1', '333', '主动', null, null, null, null, '', '', '', '不确定', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2017-11-27 23:27:38'), ('13', 'e640b188-d387-11e7-8ec8-a3d79151295a', '1', '2017-11-28', '33', '满族', '男', '1990-01-20', '文盲', '未婚', '餐饮食品业', '', '1001-2999元', '本省外市', '吉林省 长春市', '110000', '6月-1年', '1', '22', '主动', null, '1', '1', null, '', '手淫', '', '同性', null, null, '', '', null, '1', '', null, null, '', '', null, null, '', '', null, null, null, null, null, null, null, '', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '', null, '', null, '', null, '', null, null, null, null, null, '', '0', null, null, null, null, '', null, '', '', '', '', '', null, '', '', null, null, null, null, null, '', null, '', null, '是', '不知道', null, null, null, null, null, null, null, null, null, '', null, null, null, null, null, null, '', '2017-11-27 23:30:29');
COMMIT;

-- ----------------------------
--  Table structure for `system_menu`
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `system_menu`
-- ----------------------------
BEGIN;
INSERT INTO `system_menu` VALUES ('1', '后台首页', 'site/index', '0', 'fa-dashboard', '0', '1'), ('2', '菜单管理', '/system/menu', '12', '', '20', '1'), ('3', '调研管理', '', '0', 'fa-file', '10', '1'), ('4', '调研列表', '/survey/site', '3', '', '0', '1'), ('8', '项目JS列表', '/user/project/view', '3', '', '10', '1'), ('9', '订单管理', '', '0', 'icon-envelope-alt', '20', '1'), ('10', '用户管理', '', '0', 'icon-user', '30', '1'), ('11', '用户列表', '/user/list', '10', 'icon-group', '0', '1'), ('12', '系统管理', '', '0', 'fa-gears', '40', '1'), ('13', '商品管理', '/system/reagent', '12', 'icon-ban-circle', '10', '1'), ('15', '发货地管理', '/system/logistics', '12', '', '0', '1'), ('21', '订单列表', '/order', '9', 'icon-comment', '0', '1');
COMMIT;

-- ----------------------------
--  Table structure for `user`
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
  UNIQUE KEY `uuid` (`uuid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', null, 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q', 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q', '12', '3', '1', '', '', '', '', '', '', '18', '', '', '', '', '0', '-1', '0', '{}', '0000-00-00 00:00:00', '2017-11-30 09:59:29');
COMMIT;

-- ----------------------------
--  Table structure for `user_address`
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
  UNIQUE KEY `uuid` (`uuid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `user_address`
-- ----------------------------
BEGIN;
INSERT INTO `user_address` VALUES ('3', '498f1d8e-d1a2-11e7-89ed-7d2a012e2664', '1', '11', '123', '黑龙江省 哈尔滨市 道里区', '', 'adf', '2017-11-25 13:34:20', '0'), ('4', '3e161da8-d1a3-11e7-97ce-510de852e2e7', '1', '1', '23', '北京 北京市 东城区', '', '33', '2017-11-25 13:41:10', '0'), ('5', '80f43cae-d1a3-11e7-a5f5-193ed3b63bd7', '1', '3344', '442', '北京 北京市 东城区', '', '123', '2017-11-25 13:43:03', '0'), ('14', '351f7806-d1a4-11e7-b6cb-01d5cf31448c', '1', '3344', '442', '北京 北京市 东城区', '', '123', '2017-11-25 13:48:05', '0'), ('15', '5255cc9a-d1a4-11e7-a0c5-f94afebbebbc', '1', '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:48:54', '0'), ('16', '74412304-d1a4-11e7-9244-f9ee89ddb9f8', '1', '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:49:51', '0'), ('17', '7a5beb52-d1a4-11e7-bf90-93f403193961', '1', '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:50:01', '0'), ('18', '9951538a-d1a4-11e7-921f-c71304dac593', '1', '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:50:53', '0'), ('19', 'ac768502-d1a4-11e7-aef6-d379d22c0e57', '1', '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:51:25', '0'), ('20', 'b98d467c-d1a4-11e7-8684-1fa140b88c7a', '1', '22', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 13:51:47', '0'), ('21', 'dba46d1a-d1a6-11e7-8353-3b9b8e0150f7', '1', '22333', '3344', '北京 北京市 东城区', '', '22', '2017-11-25 14:07:03', '0'), ('22', 'dbe7b512-d1aa-11e7-9083-31ee90d7184d', '1', '33123', '111', '吉林省 长春市 南关区', '', '22123', '2017-11-25 14:35:42', '0'), ('23', 'c32b9344-d1fb-11e7-95eb-53f8e4bbb080', '1', '22', '111', '内蒙古自治区 呼和浩特市 新城区', '', '123', '2017-11-26 00:14:49', '0'), ('24', 'e60fc6f0-d1fb-11e7-acab-cd9f76cde625', '1', '22', '111', '内蒙古自治区 呼和浩特市 新城区', '', '123', '2017-11-26 00:15:48', '0'), ('25', 'ce770cba-d386-11e7-be97-5be2c5e49661', '1', 'aa', '11', '黑龙江省 哈尔滨市 道里区', '', '1122', '2017-11-27 23:22:40', '0');
COMMIT;

-- ----------------------------
--  Table structure for `user_event`
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Records of `user_event`
-- ----------------------------
BEGIN;
INSERT INTO `user_event` VALUES ('1', 'adf2cf0c-d1a0-11e7-9544-01a82e43381f', '1', null, null, null, null, null, 'null', null, null, null, null, '2017-11-25 13:22:50', '2017-11-26 00:14:08'), ('2', '498f6122-d1a2-11e7-bd34-3943a072874d', '1', null, null, null, null, null, '{\"products\":{\"free\":\"1\",\"gift\":{\"2\":\"1\"}},\"logistics\":\"北京-彩虹公共卫生服务中心\"}', null, null, null, '498f1d8e-d1a2-11e7-89ed-7d2a012e2664', '2017-11-25 13:34:20', '2017-11-26 00:14:09'), ('3', '3e1675b4-d1a3-11e7-8af7-795cbc072867', '1', null, null, null, null, null, '{\"products\":null,\"logistics\":\"1\"}', null, null, null, '3e161da8-d1a3-11e7-97ce-510de852e2e7', '2017-11-25 13:41:10', '2017-11-26 00:14:10'), ('4', '80f48060-d1a3-11e7-bb57-c1f29b732078', '1', null, null, null, null, null, '{\"products\":{\"free\":\"1\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', null, null, null, '80f43cae-d1a3-11e7-a5f5-193ed3b63bd7', '2017-11-25 13:43:03', '2017-11-26 00:14:11'), ('5', '352009e2-d1a4-11e7-872e-b99a8bb22ed5', '1', null, null, null, null, null, '{\"products\":{\"free\":\"1\",\"gift\":{\"2\":\"on\"},\"charge\":{\"3\":\"on\",\"4\":\"on\"}},\"logistics\":\"1\"}', null, null, null, '351f7806-d1a4-11e7-b6cb-01d5cf31448c', '2017-11-25 13:48:05', '2017-11-26 00:14:11'), ('6', '525630c2-d1a4-11e7-9bbd-6d3ce9d66f89', '1', null, null, null, null, null, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', null, null, null, '5255cc9a-d1a4-11e7-a0c5-f94afebbebbc', '2017-11-25 13:48:54', '2017-11-26 00:14:11'), ('7', '744181b4-d1a4-11e7-87e8-8fe8e8dee091', '1', null, null, null, null, null, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', null, null, null, '74412304-d1a4-11e7-9244-f9ee89ddb9f8', '2017-11-25 13:49:51', '2017-11-26 00:14:12'), ('8', '7a5c48f4-d1a4-11e7-80d9-5b70f41580d9', '1', null, null, null, null, null, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', null, null, null, '7a5beb52-d1a4-11e7-bf90-93f403193961', '2017-11-25 13:50:01', '2017-11-26 00:14:12'), ('9', '9951a858-d1a4-11e7-aa6b-cbb108ba6468', '1', null, null, null, null, null, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', null, null, null, '9951538a-d1a4-11e7-921f-c71304dac593', '2017-11-25 13:50:53', '2017-11-26 00:14:12'), ('10', 'ac76ead8-d1a4-11e7-b85b-2d0cc20af6da', '11', null, null, null, null, null, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', null, null, null, 'ac768502-d1a4-11e7-aef6-d379d22c0e57', '2017-11-25 13:51:25', '2017-11-26 00:14:13'), ('11', 'b98dbf6c-d1a4-11e7-b9fc-cb5cb6112a5f', '1', null, null, null, null, null, '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"1\"},\"charge\":{\"3\":\"1\",\"4\":\"1\"}},\"logistics\":\"1\"}', null, null, null, 'b98d467c-d1a4-11e7-8684-1fa140b88c7a', '2017-11-25 13:51:47', '2017-11-26 00:14:13'), ('12', 'dba4f0fa-d1a6-11e7-a9c2-33244edfef1a', '1', null, null, null, null, null, '{\"products\":null,\"logistics\":\"1\"}', null, null, null, 'dba46d1a-d1a6-11e7-8353-3b9b8e0150f7', '2017-11-25 14:07:03', '2017-11-26 00:14:13'), ('13', '6a77520a-d1a7-11e7-a25d-c5e307bc0b72', '1', null, null, null, null, null, '{\"products\":null,\"logistics\":\"1\"}', null, null, null, 'dba46d1a-d1a6-11e7-8353-3b9b8e0150f7', '2017-11-25 14:11:03', '2017-11-26 00:14:14'), ('14', 'dbe837bc-d1aa-11e7-87e4-dde4e96d7144', '1', null, null, null, null, '', '{\"products\":{\"free\":\"0\",\"gift\":{\"2\":\"on\"},\"charge\":{\"3\":\"on\"}},\"logistics\":\"1\"}', null, null, null, 'dbe7b512-d1aa-11e7-9083-31ee90d7184d', '2017-11-25 14:35:42', '2017-11-26 00:14:14'), ('15', '30466ce2-d1f7-11e7-85ab-d9fd7748ddb9', '1', null, null, null, null, '', '{\"products\":{\"free\":\"1\",\"gift\":{\"2\":\"1\"},\"charge\":{\"4\":\"1\"}},\"logistics\":\"1\"}', null, null, null, 'dbe7b512-d1aa-11e7-9083-31ee90d7184d', '2017-11-25 23:42:05', '2017-11-26 00:14:27'), ('16', 'a79dd316-d1f7-11e7-8a36-1f61410b28d5', '11', null, null, null, null, '', '{\"products\":{\"gift\":{\"2\":\"1\"},\"charge\":{\"4\":\"1\"}},\"logistics\":\"1\"}', null, null, null, 'dbe7b512-d1aa-11e7-9083-31ee90d7184d', '2017-11-25 23:45:25', '2017-11-26 00:14:15'), ('19', 'c32bdc50-d1fb-11e7-8279-1d3afaf4123c', '1', null, null, null, null, '1', '{\"products\":{\"gift\":{\"2\":\"1\"},\"charge\":{\"4\":\"1\"}},\"logistics\":\"1\"}', null, null, null, 'c32b9344-d1fb-11e7-95eb-53f8e4bbb080', '2017-11-26 00:14:49', '2017-11-26 00:52:59'), ('20', 'e6100cf0-d1fb-11e7-bb80-17a0df7d0718', '1', 'survey', '14cd636c-d201-11e7-bafd-4faf3b193a99', '7', '6', '1', '{\"products\":{\"gift\":{\"2\":\"on\"},\"charge\":{\"4\":\"on\"}},\"logistics\":\"1\"}', null, null, null, 'e60fc6f0-d1fb-11e7-acab-cd9f76cde625', '2017-11-26 00:15:48', '2017-11-26 01:05:26'), ('21', 'ce7790fe-d386-11e7-8a14-a7e0c78470c3', '1', 'survey', 'e640b188-d387-11e7-8ec8-a3d79151295a', '7', '6', '', '{\"products\":{\"gift\":{\"2\":\"1\"}},\"logistics\":\"2\"}', null, null, null, 'ce770cba-d386-11e7-be97-5be2c5e49661', '2017-11-27 23:22:40', '2017-11-28 11:10:44');
COMMIT;

-- ----------------------------
--  Table structure for `user_online`
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
--  Table structure for `user_profile`
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
  UNIQUE KEY `uuid` (`uuid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
--  Table structure for `wx_notify_log`
-- ----------------------------
DROP TABLE IF EXISTS `wx_notify_log`;
CREATE TABLE `wx_notify_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `data` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '异步通知数据',
  `add_time` int(10) NOT NULL DEFAULT '0' COMMENT '通知时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
