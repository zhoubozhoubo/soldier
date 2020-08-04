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

 Date: 02/08/2020 00:16:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for business_activity_resource
-- ----------------------------
DROP TABLE IF EXISTS `business_activity_resource`;
CREATE TABLE `business_activity_resource` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `sort` bigint(20) DEFAULT 0 COMMENT '排序权重',
  `status` tinyint(1) unsigned DEFAULT 1 COMMENT '状态(0:禁用,1:启用)',
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '删除(1删除,0未删)',
  `activity_type_id` int(11) DEFAULT NULL COMMENT '活动类型id',
  `resource_type` tinyint(1) DEFAULT 1 COMMENT '资源类型(1视频,2图片)',
  `content` text DEFAULT NULL COMMENT '内容',
  `author` varchar(20) DEFAULT NULL COMMENT '作者',
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='业务-活动资源';

-- ----------------------------
-- Table structure for business_activity_type
-- ----------------------------
DROP TABLE IF EXISTS `business_activity_type`;
CREATE TABLE `business_activity_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `sort` bigint(20) DEFAULT 0 COMMENT '排序权重',
  `status` tinyint(1) unsigned DEFAULT 1 COMMENT '状态(0:禁用,1:启用)',
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '删除(1删除,0未删)',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `image` varchar(255) DEFAULT NULL COMMENT '图片',
  `comment` varchar(255) DEFAULT NULL COMMENT '描述',
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新时间',
  `activity_time` date DEFAULT NULL COMMENT '活动时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='业务-活动类型';

-- ----------------------------
-- Table structure for business_banner
-- ----------------------------
DROP TABLE IF EXISTS `business_banner`;
CREATE TABLE `business_banner` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `sort` bigint(20) DEFAULT 0 COMMENT '排序权重',
  `status` tinyint(1) unsigned DEFAULT 1 COMMENT '状态(0:禁用,1:启用)',
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '删除(1删除,0未删)',
  `image` varchar(255) DEFAULT NULL COMMENT '图片',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `banner_type` tinyint(1) DEFAULT NULL COMMENT 'banner类型(1政策解读,2军人风采,3法律咨询,4心理咨询)',
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC COMMENT='业务-banner';

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='业务-咨询';

-- ----------------------------
-- Table structure for business_help_spot
-- ----------------------------
DROP TABLE IF EXISTS `business_help_spot`;
CREATE TABLE `business_help_spot` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `sort` bigint(20) DEFAULT 0 COMMENT '排序权重',
  `status` tinyint(1) unsigned DEFAULT 1 COMMENT '状态(0:禁用,1:启用)',
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '删除(1删除,0未删)',
  `spot_type` tinyint(1) DEFAULT 1 COMMENT '点位类型(1法律咨询,2心理咨询)',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `image` varchar(255) DEFAULT NULL COMMENT '图片',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `phone` varchar(20) DEFAULT NULL COMMENT '电话',
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新时间',
  `work_time` varchar(255) DEFAULT NULL COMMENT '工作时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='业务-咨询点位';

-- ----------------------------
-- Table structure for business_policy
-- ----------------------------
DROP TABLE IF EXISTS `business_policy`;
CREATE TABLE `business_policy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `sort` bigint(20) DEFAULT 0 COMMENT '排序权重',
  `status` tinyint(1) unsigned DEFAULT 1 COMMENT '状态(0:禁用,1:启用)',
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '删除(1删除,0未删)',
  `policy_type` tinyint(1) DEFAULT 1 COMMENT '政策类型(1中央,2地方)',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `image` varchar(255) DEFAULT NULL COMMENT '图片',
  `comment` text DEFAULT NULL COMMENT '内容',
  `from` varchar(50) DEFAULT NULL COMMENT '来源',
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新时间',
  `is_hot` tinyint(1) DEFAULT 0 COMMENT '热点(1是,0否)',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='业务-政策';

-- ----------------------------
-- Table structure for business_recruit
-- ----------------------------
DROP TABLE IF EXISTS `business_recruit`;
CREATE TABLE `business_recruit` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `sort` bigint(20) DEFAULT 0 COMMENT '排序权重',
  `status` tinyint(1) unsigned DEFAULT 1 COMMENT '状态(0:禁用,1:启用)',
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '删除(1删除,0未删)',
  `image` varchar(255) DEFAULT NULL COMMENT '图片',
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `comment` text DEFAULT NULL COMMENT '职位详情',
  `number` varchar(20) DEFAULT NULL COMMENT '人数',
  `money` varchar(20) DEFAULT NULL COMMENT '薪资',
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新时间',
  `company_name` varchar(50) DEFAULT NULL COMMENT '公司名称',
  `company_address` varchar(255) DEFAULT NULL COMMENT '公司地址',
  `work_address` varchar(255) DEFAULT NULL COMMENT '工作地点',
  `contact_email` varchar(255) DEFAULT NULL COMMENT '联系邮箱',
  `contact_phone` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `end_date` date DEFAULT NULL COMMENT '结束日期',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='业务-招聘';

-- ----------------------------
-- Table structure for business_soldier
-- ----------------------------
DROP TABLE IF EXISTS `business_soldier`;
CREATE TABLE `business_soldier` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `sort` bigint(20) DEFAULT 0 COMMENT '排序权重',
  `status` tinyint(1) unsigned DEFAULT 1 COMMENT '状态(0:禁用,1:启用)',
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '删除(1删除,0未删)',
  `image` varchar(255) DEFAULT NULL COMMENT '图片',
  `name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `comment` text DEFAULT NULL COMMENT '内容',
  `update_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='业务-军人';

-- ----------------------------
-- Table structure for system_auth
-- ----------------------------
DROP TABLE IF EXISTS `system_auth`;
CREATE TABLE `system_auth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT '' COMMENT '权限名称',
  `desc` varchar(500) DEFAULT '' COMMENT '备注说明',
  `sort` bigint(20) unsigned DEFAULT 0 COMMENT '排序权重',
  `status` tinyint(1) unsigned DEFAULT 1 COMMENT '权限状态(1使用,0禁用)',
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_system_auth_title` (`title`) USING BTREE,
  KEY `idx_system_auth_status` (`status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统-权限';

-- ----------------------------
-- Table structure for system_auth_node
-- ----------------------------
DROP TABLE IF EXISTS `system_auth_node`;
CREATE TABLE `system_auth_node` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth` bigint(20) unsigned DEFAULT 0 COMMENT '角色',
  `node` varchar(200) DEFAULT '' COMMENT '节点',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_system_auth_auth` (`auth`) USING BTREE,
  KEY `idx_system_auth_node` (`node`(191)) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统-授权';

-- ----------------------------
-- Table structure for system_config
-- ----------------------------
DROP TABLE IF EXISTS `system_config`;
CREATE TABLE `system_config` (
  `type` varchar(20) DEFAULT '' COMMENT '分类',
  `name` varchar(100) DEFAULT '' COMMENT '配置名',
  `value` varchar(2048) DEFAULT '' COMMENT '配置值',
  KEY `idx_system_config_type` (`type`) USING BTREE,
  KEY `idx_system_config_name` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统-配置';

-- ----------------------------
-- Records of system_config
-- ----------------------------
BEGIN;
INSERT INTO `system_config` VALUES ('base', 'site_name', '军人e家');
INSERT INTO `system_config` VALUES ('base', 'site_icon', 'https://v6.thinkadmin.top/upload/f47b8fe06e38ae99/08e8398da45583b9.png');
INSERT INTO `system_config` VALUES ('base', 'site_copy', '©版权所有 2019-2020 楚才科技');
INSERT INTO `system_config` VALUES ('base', 'app_name', '军人e家管理后台');
INSERT INTO `system_config` VALUES ('base', 'app_version', 'v1.0');
INSERT INTO `system_config` VALUES ('base', 'miitbeian', '');
INSERT INTO `system_config` VALUES ('storage', 'qiniu_http_protocol', 'http');
INSERT INTO `system_config` VALUES ('storage', 'type', 'local');
INSERT INTO `system_config` VALUES ('storage', 'allow_exts', 'doc,gif,icon,jpg,mp3,mp4,p12,pem,png,rar,xls,xlsx');
INSERT INTO `system_config` VALUES ('storage', 'qiniu_region', '华东');
INSERT INTO `system_config` VALUES ('storage', 'qiniu_bucket', '');
INSERT INTO `system_config` VALUES ('storage', 'qiniu_http_domain', '');
INSERT INTO `system_config` VALUES ('storage', 'qiniu_access_key', '');
INSERT INTO `system_config` VALUES ('storage', 'qiniu_secret_key', '');
INSERT INTO `system_config` VALUES ('wechat', 'type', 'api');
INSERT INTO `system_config` VALUES ('wechat', 'token', 'weixin');
INSERT INTO `system_config` VALUES ('wechat', 'appid', 'wx631f3706f8be7f91');
INSERT INTO `system_config` VALUES ('wechat', 'appsecret', 'e602791c38f2bb053821b33f5db01c05');
INSERT INTO `system_config` VALUES ('wechat', 'encodingaeskey', '');
INSERT INTO `system_config` VALUES ('wechat', 'thr_appid', '');
INSERT INTO `system_config` VALUES ('wechat', 'thr_appkey', '');
INSERT INTO `system_config` VALUES ('wechat', 'mch_id', '');
INSERT INTO `system_config` VALUES ('wechat', 'mch_key', '');
INSERT INTO `system_config` VALUES ('wechat', 'mch_ssl_type', 'pem');
INSERT INTO `system_config` VALUES ('wechat', 'mch_ssl_p12', '');
INSERT INTO `system_config` VALUES ('wechat', 'mch_ssl_key', '');
INSERT INTO `system_config` VALUES ('wechat', 'mch_ssl_cer', '');
INSERT INTO `system_config` VALUES ('storage', 'alioss_http_protocol', 'http');
INSERT INTO `system_config` VALUES ('storage', 'alioss_point', 'oss-cn-hangzhou.aliyuncs.com');
INSERT INTO `system_config` VALUES ('storage', 'alioss_bucket', '');
INSERT INTO `system_config` VALUES ('storage', 'alioss_http_domain', '');
INSERT INTO `system_config` VALUES ('storage', 'alioss_access_key', '');
INSERT INTO `system_config` VALUES ('storage', 'alioss_secret_key', '');
INSERT INTO `system_config` VALUES ('base', 'about', '关于我们123123123wecwvqr');
COMMIT;

-- ----------------------------
-- Table structure for system_data
-- ----------------------------
DROP TABLE IF EXISTS `system_data`;
CREATE TABLE `system_data` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '' COMMENT '配置名',
  `value` longtext DEFAULT NULL COMMENT '配置值',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_system_data_name` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统-数据';

-- ----------------------------
-- Table structure for system_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_menu`;
CREATE TABLE `system_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) unsigned DEFAULT 0 COMMENT '上级ID',
  `title` varchar(100) DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(100) DEFAULT '' COMMENT '菜单图标',
  `node` varchar(100) DEFAULT '' COMMENT '节点代码',
  `url` varchar(400) DEFAULT '' COMMENT '链接节点',
  `params` varchar(500) DEFAULT '' COMMENT '链接参数',
  `target` varchar(20) DEFAULT '_self' COMMENT '打开方式',
  `sort` int(11) unsigned DEFAULT 0 COMMENT '排序权重',
  `status` tinyint(1) unsigned DEFAULT 1 COMMENT '状态(0:禁用,1:启用)',
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_system_menu_node` (`node`) USING BTREE,
  KEY `idx_system_menu_status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COMMENT='系统-菜单';

-- ----------------------------
-- Records of system_menu
-- ----------------------------
BEGIN;
INSERT INTO `system_menu` VALUES (2, 0, '系统管理', '', '', '#', '', '_self', 100, 1, '2018-09-06 02:04:52');
INSERT INTO `system_menu` VALUES (3, 4, '系统菜单管理', 'layui-icon layui-icon-layouts', '', 'admin/menu/index', '', '_self', 1, 1, '2018-09-06 02:05:26');
INSERT INTO `system_menu` VALUES (4, 2, '系统配置', '', '', '#', '', '_self', 20, 1, '2018-09-06 02:07:17');
INSERT INTO `system_menu` VALUES (5, 12, '系统用户管理', 'layui-icon layui-icon-username', '', 'admin/user/index', '', '_self', 1, 1, '2018-09-06 19:10:42');
INSERT INTO `system_menu` VALUES (7, 12, '访问权限管理', 'layui-icon layui-icon-vercode', '', 'admin/auth/index', '', '_self', 2, 1, '2018-09-06 23:17:14');
INSERT INTO `system_menu` VALUES (11, 4, '系统参数配置', 'layui-icon layui-icon-set', '', 'admin/config/index', '', '_self', 4, 1, '2018-09-07 00:43:47');
INSERT INTO `system_menu` VALUES (12, 2, '权限管理', '', '', '#', '', '_self', 10, 1, '2018-09-07 02:01:31');
INSERT INTO `system_menu` VALUES (27, 4, '系统任务管理', 'layui-icon layui-icon-log', '', 'admin/queue/index', '', '_self', 3, 0, '2018-11-29 19:13:34');
INSERT INTO `system_menu` VALUES (49, 4, '系统日志管理', 'layui-icon layui-icon-form', '', 'admin/oplog/index', '', '_self', 2, 1, '2019-02-18 20:56:56');
INSERT INTO `system_menu` VALUES (56, 0, '微信管理', '', '', '#', '', '_self', 200, 1, '2019-12-09 19:00:37');
INSERT INTO `system_menu` VALUES (58, 56, '微信接口配置', 'layui-icon layui-icon-set', '', 'wechat/config/options', '', '_self', 0, 1, '2019-12-09 21:57:28');
INSERT INTO `system_menu` VALUES (60, 56, '微信管理', '', '', '#', '', '_self', 0, 1, '2019-12-10 02:35:16');
INSERT INTO `system_menu` VALUES (61, 60, '微信粉丝管理', 'layui-icon layui-icon-username', '', 'wechat/fans/index', '', '_self', 0, 1, '2019-12-10 02:35:37');
INSERT INTO `system_menu` VALUES (62, 2, '军人服务管理', '', '', '#', '', '_self', 0, 1, '2020-06-26 01:32:52');
INSERT INTO `system_menu` VALUES (63, 62, '咨询列表管理', 'layui-icon layui-icon-spread-left', '', 'admin/consult/index', '', '_self', 0, 1, '2020-07-07 02:04:12');
INSERT INTO `system_menu` VALUES (64, 62, '点位列表管理', 'layui-icon layui-icon-shrink-right', '', 'admin/help_spot/index', '', '_self', 0, 1, '2020-07-07 02:04:12');
INSERT INTO `system_menu` VALUES (65, 62, '政策列表管理', 'layui-icon layui-icon-form', '', 'admin/policy/index', '', '_self', 0, 1, '2020-07-07 02:04:12');
INSERT INTO `system_menu` VALUES (66, 62, '招聘列表管理', 'layui-icon layui-icon-form', '', 'admin/recruit/index', '', '_self', 0, 1, '2020-06-26 01:34:06');
INSERT INTO `system_menu` VALUES (67, 2, '军人动态管理', '', '', '#', '', '_self', 0, 1, '2020-06-26 01:32:52');
INSERT INTO `system_menu` VALUES (68, 67, '活动系列管理', 'layui-icon layui-icon-form', '', 'admin/activity_type/index', '', '_self', 0, 1, '2020-07-07 02:04:12');
INSERT INTO `system_menu` VALUES (69, 67, '活动资源管理', 'layui-icon layui-icon-form', '', 'admin/activity_resource/index', '', '_self', 0, 1, '2020-07-07 02:04:12');
INSERT INTO `system_menu` VALUES (70, 67, '退役军人管理', 'layui-icon layui-icon-form', '', 'admin/soldier/index', '', '_self', 0, 1, '2020-07-07 02:04:12');
INSERT INTO `system_menu` VALUES (72, 2, '前端配置', '', '', '#', '', '_self', 0, 1, '2020-07-07 02:51:46');
INSERT INTO `system_menu` VALUES (73, 72, 'banner管理', 'layui-icon layui-icon-form', '', 'admin/banner/index', '', '_self', 0, 1, '2020-07-24 17:58:56');
INSERT INTO `system_menu` VALUES (74, 72, '关于军人e家', 'layui-icon layui-icon-form', '', 'admin/about/index', '', '_self', 0, 1, '2020-07-07 02:52:46');
COMMIT;

-- ----------------------------
-- Table structure for system_oplog
-- ----------------------------
DROP TABLE IF EXISTS `system_oplog`;
CREATE TABLE `system_oplog` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `node` varchar(200) NOT NULL DEFAULT '' COMMENT '当前操作节点',
  `geoip` varchar(15) NOT NULL DEFAULT '' COMMENT '操作者IP地址',
  `action` varchar(200) NOT NULL DEFAULT '' COMMENT '操作行为名称',
  `content` varchar(1024) NOT NULL DEFAULT '' COMMENT '操作内容描述',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '操作人用户名',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统-日志';

-- ----------------------------
-- Table structure for system_queue
-- ----------------------------
DROP TABLE IF EXISTS `system_queue`;
CREATE TABLE `system_queue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '任务编号',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '任务名称',
  `command` varchar(500) DEFAULT '' COMMENT '执行指令',
  `exec_pid` bigint(20) DEFAULT 0 COMMENT '执行进程',
  `exec_data` longtext DEFAULT NULL COMMENT '执行参数',
  `exec_time` bigint(20) DEFAULT 0 COMMENT '执行时间',
  `exec_desc` varchar(500) DEFAULT '' COMMENT '执行描述',
  `enter_time` decimal(20,4) DEFAULT 0.0000 COMMENT '开始时间',
  `outer_time` decimal(20,4) DEFAULT 0.0000 COMMENT '结束时间',
  `loops_time` bigint(20) DEFAULT 0 COMMENT '循环时间',
  `attempts` bigint(20) DEFAULT 0 COMMENT '执行次数',
  `rscript` tinyint(1) DEFAULT 1 COMMENT '任务类型(0单例,1多例)',
  `status` tinyint(1) DEFAULT 1 COMMENT '任务状态(1新任务,2处理中,3成功,4失败)',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_system_queue_code` (`code`) USING BTREE,
  KEY `idx_system_queue_title` (`title`) USING BTREE,
  KEY `idx_system_queue_status` (`status`) USING BTREE,
  KEY `idx_system_queue_rscript` (`rscript`) USING BTREE,
  KEY `idx_system_queue_create_at` (`create_at`) USING BTREE,
  KEY `idx_system_queue_exec_time` (`exec_time`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='系统-任务';

-- ----------------------------
-- Table structure for system_user
-- ----------------------------
DROP TABLE IF EXISTS `system_user`;
CREATE TABLE `system_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT '' COMMENT '用户账号',
  `password` varchar(32) DEFAULT '' COMMENT '用户密码',
  `nickname` varchar(50) DEFAULT '' COMMENT '用户昵称',
  `headimg` varchar(255) DEFAULT '' COMMENT '头像地址',
  `authorize` varchar(255) DEFAULT '' COMMENT '权限授权',
  `contact_qq` varchar(20) DEFAULT '' COMMENT '联系QQ',
  `contact_mail` varchar(20) DEFAULT '' COMMENT '联系邮箱',
  `contact_phone` varchar(20) DEFAULT '' COMMENT '联系手机',
  `login_ip` varchar(255) DEFAULT '' COMMENT '登录地址',
  `login_at` varchar(20) DEFAULT '' COMMENT '登录时间',
  `login_num` bigint(20) DEFAULT 0 COMMENT '登录次数',
  `describe` varchar(255) DEFAULT '' COMMENT '备注说明',
  `status` tinyint(1) DEFAULT 1 COMMENT '状态(0禁用,1启用)',
  `sort` bigint(20) DEFAULT 0 COMMENT '排序权重',
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '删除(1删除,0未删)',
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `idx_system_user_username` (`username`) USING BTREE,
  KEY `idx_system_user_deleted` (`is_deleted`) USING BTREE,
  KEY `idx_system_user_status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10002 DEFAULT CHARSET=utf8mb4 COMMENT='系统-用户';

-- ----------------------------
-- Records of system_user
-- ----------------------------
BEGIN;
INSERT INTO `system_user` VALUES (10000, 'admin', '21232f297a57a5a743894a0e4a801fc3', '系统管理员', '', '', '', '', '', '127.0.0.1', '2020-07-31 20:23:14', 1096, '', 1, 0, 0, '2015-11-13 23:14:22');
COMMIT;

-- ----------------------------
-- Table structure for wechat_fans
-- ----------------------------
DROP TABLE IF EXISTS `wechat_fans`;
CREATE TABLE `wechat_fans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unionid` varchar(100) DEFAULT '' COMMENT '粉丝unionid',
  `openid` varchar(100) DEFAULT '' COMMENT '粉丝openid',
  `nickname` varchar(200) DEFAULT '' COMMENT '用户昵称',
  `headimgurl` varchar(500) DEFAULT '' COMMENT '用户头像',
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `is_realname` tinyint(1) DEFAULT 0 COMMENT '是否实名(1是,0否)',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `index_wechat_fans_openid` (`openid`) USING BTREE,
  KEY `index_wechat_fans_unionid` (`unionid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='微信-粉丝';

-- ----------------------------
-- Table structure for wechat_fans_info
-- ----------------------------
DROP TABLE IF EXISTS `wechat_fans_info`;
CREATE TABLE `wechat_fans_info` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `create_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `wechat_fans_id` int(11) DEFAULT NULL COMMENT '微信粉丝id',
  `name` varchar(20) DEFAULT NULL COMMENT '姓名',
  `phone` varchar(11) DEFAULT NULL COMMENT '手机号',
  `id_number` varchar(20) DEFAULT NULL COMMENT '身份证号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='微信-粉丝信息';

SET FOREIGN_KEY_CHECKS = 1;
