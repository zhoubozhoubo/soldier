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

 Date: 12/08/2020 09:54:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for business_hobby
-- ----------------------------
DROP TABLE IF EXISTS `business_hobby`;
CREATE TABLE `business_hobby` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `sort` bigint(20) DEFAULT 0 COMMENT '排序权重',
  `status` tinyint(1) unsigned DEFAULT 1 COMMENT '状态(0:禁用,1:启用)',
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '删除(1删除,0未删)',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `image` varchar(255) DEFAULT NULL COMMENT '图片',
  `comment` text DEFAULT NULL COMMENT '内容',
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新时间',
  `time` date DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COMMENT='业务-军事爱好';

SET FOREIGN_KEY_CHECKS = 1;
