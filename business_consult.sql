/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : soldier

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 27/07/2020 01:22:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for business_consult
-- ----------------------------
DROP TABLE IF EXISTS `business_consult`;
CREATE TABLE `business_consult` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新时间',
  `status` tinyint(1) unsigned DEFAULT 1 COMMENT '状态(0:禁用,1:启用)',
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '删除(1删除,0未删)',
  `comment` text DEFAULT NULL COMMENT '内容',
  `answer` text DEFAULT NULL COMMENT '回答',
  `wechat_fans_id` int(11) DEFAULT NULL COMMENT '微信粉丝id',
  `is_answered` tinyint(1) DEFAULT 0 COMMENT '回答(1回答,0未回答)',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='业务-咨询';

-- ----------------------------
-- Records of business_consult
-- ----------------------------
BEGIN;
INSERT INTO `business_consult` VALUES (1, '2020-07-26 17:22:08', '2020-07-26 17:22:08', 1, 0, '退役军人有哪些福利政策？生活补贴和养老补贴的要求是什么？需要服役几年才可以拿到？', '国家对于农村退伍军人也是有补贴的，他们除了可以和其他的农村老人一样能够拿到基础养老金外，他们在交纳养老保险方面也能享受到特殊的待遇。我们知道，养老保险是需要交纳15年的，而退伍军人交纳养老保险和他们的服役年限之间有很大的关系，可以用服役的年限来抵扣交纳养老保险的年限，比如说服役了5年，那么只需要交纳10年的养老保险即可。', NULL, 0);
INSERT INTO `business_consult` VALUES (2, '2020-07-26 17:22:08', '2020-07-26 17:22:08', 1, 0, '退役军人有哪些福利政策？生活补贴和养老补贴的要求是什么？需要服役几年才可以拿到？', '国家对于农村退伍军人也是有补贴的，他们除了可以和其他的农村老人一样能够拿到基础养老金外，他们在交纳养老保险方面也能享受到特殊的待遇。我们知道，养老保险是需要交纳15年的，而退伍军人交纳养老保险和他们的服役年限之间有很大的关系，可以用服役的年限来抵扣交纳养老保险的年限，比如说服役了5年，那么只需要交纳10年的养老保险即可。', NULL, 0);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
