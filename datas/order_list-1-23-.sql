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

 Date: 23/01/2018 19:36:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
  `order_status` tinyint(4) DEFAULT '0' COMMENT '订单状态：0未处理，1处理中，2已支付，21已发货，22已收货，23用户不存在，29发货完成，11申请退款，12退款审核，13退款成功，14退款失败，18退款处理中，19退款完成，99订单完成，100未知状态',
  `order_updated_at` datetime DEFAULT NULL COMMENT '订单更新时间',
  `ship_name` varchar(20) DEFAULT NULL COMMENT '快递名称',
  `ship_code` varchar(30) DEFAULT NULL COMMENT '快递单号',
  `ship_uuid` varchar(36) DEFAULT NULL COMMENT '快递公司UUID',
  `ship_status` tinyint(4) DEFAULT NULL COMMENT '配送状态: 1:已发货',
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `source_type` varchar(10) DEFAULT NULL COMMENT '来源',
  `source_uuid` varchar(36) DEFAULT NULL COMMENT '来源ID',
  `logistic_id` tinyint(4) DEFAULT NULL COMMENT '发货地ID',
  `address_uuid` varchar(36) DEFAULT NULL,
  `address_contact` varchar(50) DEFAULT NULL,
  `address_mobile` varchar(20) DEFAULT NULL,
  `address_detail` varchar(200) DEFAULT NULL,
  `alipay` varchar(50) DEFAULT NULL COMMENT '支付宝 和pay_images的支付宝一致',
  `is_up_result` tinyint(4) DEFAULT '0' COMMENT '是否上传自检结果：1:是，0:否',
  `adis_result` tinyint(4) DEFAULT NULL COMMENT '艾滋病检测结果:1阴性，2：阳性',
  `syphilis_result` tinyint(4) DEFAULT NULL COMMENT '梅毒检测结果:1阴性，2：阳性',
  `hepatitis_b_result` tinyint(4) DEFAULT NULL COMMENT '乙肝检测结果:1阴性，2：阳性',
  `hepatitis_c_result` tinyint(4) DEFAULT NULL COMMENT '丙肝检测结果:1阴性，2：阳性',
  PRIMARY KEY (`id`),
  UNIQUE KEY `out_trade_no` (`out_trade_no`) USING BTREE,
  UNIQUE KEY `uuid` (`uuid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

SET FOREIGN_KEY_CHECKS = 1;
