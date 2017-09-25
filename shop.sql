/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : shop

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-05-31 18:09:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `receiver` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `province_id` int(11) NOT NULL DEFAULT '0' COMMENT '省份ID',
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT '城市ID',
  `area_id` int(11) NOT NULL DEFAULT '0' COMMENT '区县ID',
  `detail_address` varchar(100) NOT NULL DEFAULT '' COMMENT '详细地址',
  `tel` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `is_default` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否默认地址',
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='收货地址';

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('11', '王五', '19', '1', '4', '12', '5345345', '45444444', '1');
INSERT INTO `address` VALUES ('10', '赵六1', '19', '1', '4', '11', '府城大道119999', '13333333333', '0');
INSERT INTO `address` VALUES ('12', '大明', '21', '1', '3', '7', 'aaaaaaa', '18380448380', '0');
INSERT INTO `address` VALUES ('13', '小明', '21', '2', '3', '7', 'bbbbbb', '18380448380', '0');
INSERT INTO `address` VALUES ('18', '大大1', '21', '1', '3', '7', '丢球村', '18323232323', '1');
INSERT INTO `address` VALUES ('19', '大邓', '23', '1', '3', '7', '高新区', '18380448380', '1');

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT 'Email',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '加入时间',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `salt` char(6) NOT NULL DEFAULT '' COMMENT '盐',
  `auto_key` char(6) NOT NULL DEFAULT '' COMMENT '自动登录的KEY',
  `intro` text COMMENT '简介@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='管理员';

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('7', 'zhangsan', 'bc9ca523e747e9780fbcb0d42034fdb4', 'admin@qq.com', '1459747178', '0', 'CzMjrE', '', '测试角色2', '1', '20');
INSERT INTO `admin` VALUES ('6', 'www', '251b740020e9a726d6e228dfa922f11a', 'www@qq.com', '1459747116', '0', 'CXoykH', '', '测试角色', '1', '20');
INSERT INTO `admin` VALUES ('5', 'root', 'ddd5e2af12f818067aca883aedb6f681', 'root@qq.com', '1447308316', '0', 'sUeDdR', 'aVRbgp', '超级管理员', '1', '20');

-- ----------------------------
-- Table structure for admin_permission
-- ----------------------------
DROP TABLE IF EXISTS `admin_permission`;
CREATE TABLE `admin_permission` (
  `admin_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `permission_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '权限ID',
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='额外权限';

-- ----------------------------
-- Records of admin_permission
-- ----------------------------
INSERT INTO `admin_permission` VALUES ('3', '6');
INSERT INTO `admin_permission` VALUES ('3', '2');
INSERT INTO `admin_permission` VALUES ('3', '1');
INSERT INTO `admin_permission` VALUES ('4', '12');
INSERT INTO `admin_permission` VALUES ('4', '13');
INSERT INTO `admin_permission` VALUES ('4', '15');
INSERT INTO `admin_permission` VALUES ('4', '16');
INSERT INTO `admin_permission` VALUES ('4', '14');

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `admin_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `role_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  KEY `admin_id` (`admin_id`),
  KEY `role_id` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户和角色关系表';

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES ('3', '3');
INSERT INTO `admin_role` VALUES ('2', '1');
INSERT INTO `admin_role` VALUES ('6', '7');
INSERT INTO `admin_role` VALUES ('7', '8');

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '标题',
  `article_category_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文章分类',
  `content` text COMMENT '内容@text',
  `times` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `inputtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '录入时间',
  `intro` text COMMENT '摘要@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `article_category_id` (`article_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='文章分类';

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', '123', '2', '<p><strong>123123123123</strong></p>', '0', '0', '1231231', '1', '127');
INSERT INTO `article` VALUES ('2', '双十一', '7', '<p>双十一</p>', '0', '1446968725', '双十一', '1', '20');
INSERT INTO `article` VALUES ('3', '双十二', '7', '<p>双十二</p>', '0', '1446968795', '双十二', '1', '20');
INSERT INTO `article` VALUES ('4', '双11', '7', '<p>双11</p>', '0', '1446968808', '双11', '1', '20');
INSERT INTO `article` VALUES ('5', '双老大', '7', '<p>双老大</p>', '0', '1446968821', '双老大', '1', '20');
INSERT INTO `article` VALUES ('6', '购物流程', '1', '<ul style=\"list-style-type: none;\" class=\" list-paddingleft-2\"><li><p><a href=\"http://www.shop.com/Index/index\" style=\"color: rgb(51, 51, 51); text-decoration: none;\">购物流程</a></p></li></ul><p><br/></p>', '0', '1447472888', '购物流程', '1', '20');
INSERT INTO `article` VALUES ('7', '上门自提', '2', '<ul style=\"list-style-type: none;\" class=\" list-paddingleft-2\"><li><p><a href=\"http://www.shop.com/Index/index\" style=\"color: rgb(51, 51, 51); text-decoration: none;\">上门自提</a></p></li></ul><p><br/></p>', '0', '1447472901', '上门自提', '1', '20');
INSERT INTO `article` VALUES ('8', '货到付款', '3', '<ul style=\"list-style-type: none;\" class=\" list-paddingleft-2\"><li><p><a href=\"http://www.shop.com/Index/index\" style=\"color: rgb(51, 51, 51); text-decoration: none;\">货到付款</a></p></li></ul><p><br/></p>', '0', '1447472912', '货到付款', '1', '20');
INSERT INTO `article` VALUES ('9', '退换货政策', '4', '<ul style=\"list-style-type: none;\" class=\" list-paddingleft-2\"><li><p><a href=\"http://www.shop.com/Index/index\" style=\"color: rgb(51, 51, 51); text-decoration: none;\">退换货政策</a></p></li></ul><p><br/></p>', '0', '1447472922', '退换货政策', '1', '20');
INSERT INTO `article` VALUES ('10', '夺宝岛', '5', '<ul style=\"list-style-type: none;\" class=\" list-paddingleft-2\"><li><p><a href=\"http://www.shop.com/Index/index\" style=\"color: rgb(51, 51, 51); text-decoration: none;\">夺宝岛</a></p></li></ul><p><br/></p>', '0', '1447472935', '夺宝岛', '1', '20');
INSERT INTO `article` VALUES ('11', '电脑数码双11爆品抢不停', '6', '<p><a href=\"http://www.shop.com/Index/index\" style=\"color: rgb(102, 102, 102); text-decoration: none; font-family: Simsun; font-size: 12px; line-height: 25px; white-space: normal;\">电脑数码双11爆品抢不停</a></p>', '0', '1447549908', '电脑数码双11爆品抢不停', '1', '20');
INSERT INTO `article` VALUES ('12', '享生活 疯狂周期购！', '6', '<p><a href=\"http://www.shop.com/Index/index\" style=\"color: rgb(102, 102, 102); text-decoration: none; font-family: Simsun; font-size: 12px; line-height: 25px; white-space: normal;\">享生活 疯狂周期购！</a></p>', '0', '1447550001', '', '1', '20');
INSERT INTO `article` VALUES ('13', '家具家装全场低至3折', '6', '<p><a href=\"http://www.shop.com/Index/index\" style=\"color: rgb(102, 102, 102); text-decoration: none; font-family: Simsun; font-size: 12px; line-height: 25px; white-space: normal;\">家具家装全场低至3折</a></p>', '0', '1447550020', '家具家装全场低至3折', '1', '20');
INSERT INTO `article` VALUES ('14', '买韩束，志玲邀您看电影', '6', '<p><a href=\"http://www.shop.com/Index/index\" style=\"color: rgb(102, 102, 102); text-decoration: none; font-family: Simsun; font-size: 12px; line-height: 25px; white-space: normal;\">买韩束，志玲邀您看电影</a></p>', '0', '1447550033', '买韩束，志玲邀您看电影', '1', '20');

-- ----------------------------
-- Table structure for article_category
-- ----------------------------
DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '分类名称',
  `is_help` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否帮助@radio|1=是&0=否',
  `intro` text COMMENT '简介@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='文章分类';

-- ----------------------------
-- Records of article_category
-- ----------------------------
INSERT INTO `article_category` VALUES ('1', '购物指南', '1', '购物指南', '1', '20');
INSERT INTO `article_category` VALUES ('2', '配送方式', '1', '配送方式', '1', '20');
INSERT INTO `article_category` VALUES ('3', '支付方式', '1', '支付方式', '1', '20');
INSERT INTO `article_category` VALUES ('4', '售后服务', '1', '售后服务', '1', '20');
INSERT INTO `article_category` VALUES ('5', '特色服务', '1', '特色服务', '1', '20');
INSERT INTO `article_category` VALUES ('6', '网站快报', '0', '网站快报', '1', '20');
INSERT INTO `article_category` VALUES ('7', '商品新闻', '0', '商品新闻', '1', '20');

-- ----------------------------
-- Table structure for attribute
-- ----------------------------
DROP TABLE IF EXISTS `attribute`;
CREATE TABLE `attribute` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '属性名称',
  `goods_type_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '商品类型ID',
  `attribute_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '属性类型@radio|1=单值&2=多值',
  `attribute_input_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '录入方式@radio|1=手工录入&2=从下面的列表中选择&3=多行文本框',
  `option_values` text COMMENT '可选值@text',
  `intro` text COMMENT '属性@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` smallint(6) NOT NULL DEFAULT '20' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `goods_type_id` (`goods_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='属性';

-- ----------------------------
-- Records of attribute
-- ----------------------------
INSERT INTO `attribute` VALUES ('1', '颜色', '2', '2', '2', '红色\r\n蓝色\r\n白色', '', '1', '20');
INSERT INTO `attribute` VALUES ('2', '尺码', '2', '2', '2', 'S\r\nM\r\nL\r\nXL', '', '1', '20');
INSERT INTO `attribute` VALUES ('3', '材质', '2', '1', '1', null, '', '1', '20');
INSERT INTO `attribute` VALUES ('4', '样式', '2', '1', '3', null, '', '1', '20');
INSERT INTO `attribute` VALUES ('5', '生产年份', '2', '1', '2', '2014\r\n2015\r\n2016', '', '1', '20');
INSERT INTO `attribute` VALUES ('6', '功效', '3', '2', '2', '补水\r\n保湿\r\n美白\r\n抗皱\r\n紧致', '', '1', '20');
INSERT INTO `attribute` VALUES ('7', '适合肤质', '3', '2', '2', '正常肤质\r\n敏感肤质\r\n油性肤质\r\n干性肤质', '', '1', '20');
INSERT INTO `attribute` VALUES ('8', '产地', '3', '2', '2', '韩国\r\n日本\r\n英国\r\n美国\r\n澳大利亚\r\n新西兰\r\n中国', '', '1', '20');
INSERT INTO `attribute` VALUES ('9', '保质期', '3', '1', '1', null, '', '1', '20');
INSERT INTO `attribute` VALUES ('10', '生产日期', '3', '1', '1', null, '', '1', '20');
INSERT INTO `attribute` VALUES ('11', '11_del', '3', '1', '2', 'ee\r\nww', '', '-1', '20');

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '品牌名称',
  `url` varchar(50) NOT NULL DEFAULT '' COMMENT '品牌网址',
  `logo` varchar(50) NOT NULL DEFAULT '' COMMENT '品牌LOGO@file',
  `intro` text COMMENT '品牌描述@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` smallint(6) NOT NULL DEFAULT '20' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='品牌';

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES ('6', '兰芝', 'http://www.laneige.com', '请登录!', '', '1', '20');
INSERT INTO `brand` VALUES ('7', '城野医生', 'www.chengye.com', 'brand/2016-05-22/5741b8bd7f46a.jpg', '', '1', '20');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 未评价 1已评价  -1删除',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `replay` text COMMENT '回复',
  `create_at` int(255) NOT NULL COMMENT '创建时间',
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `start` tinyint(1) DEFAULT NULL COMMENT '1 好评 2 中评 3 差评',
  `goods_ids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`) USING BTREE,
  KEY `goods_id` (`order_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='评论';

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('3', '46', '21', '-1', '1111111', '3334444', '1464620607', '2016-05-31 14:13:53', '1', '41,36');

-- ----------------------------
-- Table structure for delivery
-- ----------------------------
DROP TABLE IF EXISTS `delivery`;
CREATE TABLE `delivery` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '送货方式名称',
  `price` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `intro` text COMMENT '送货方式描述@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` smallint(6) NOT NULL DEFAULT '20' COMMENT '排序',
  `is_default` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否默认地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='送货方式';

-- ----------------------------
-- Records of delivery
-- ----------------------------
INSERT INTO `delivery` VALUES ('1', '普通快递送货上门', '0.00', '', '1', '20', '1');
INSERT INTO `delivery` VALUES ('2', '特快专递', '0.00', '', '1', '20', '0');
INSERT INTO `delivery` VALUES ('3', '加急快递送货上门', '0.00', '', '0', '20', '0');
INSERT INTO `delivery` VALUES ('4', '平邮', '0.00', '', '0', '20', '0');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `sn` varchar(50) NOT NULL DEFAULT '' COMMENT '货号',
  `goods_category_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '父分类',
  `brand_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '品牌',
  `supplier_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '供货商',
  `stock_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '库存类型@radio|0=单库存&1=多库存',
  `goods_type_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '商品类型',
  `shop_price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '本店价格',
  `market_price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `is_on_sale` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否上架',
  `goods_status` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品状态 热销等',
  `keyword` varchar(20) NOT NULL DEFAULT '' COMMENT '关键字',
  `logo` varchar(100) NOT NULL DEFAULT '' COMMENT 'LOGO',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '记录状态@radio|1=是&0=否 展示  -1在回收站',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `goods_category_id` (`goods_category_id`),
  KEY `brand_id` (`brand_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `name` (`name`),
  KEY `sn` (`sn`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='商品';

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '兰芝凝露', '2016051500000035', '51', '6', '15', '0', '2', '180.00', '200.00', '10', '1', '1', '补水 兰芝 凝露', 'goods/2016-05-31/574d5c3976c52.jpg', '1', '10', '2016-05-31 17:42:27');
INSERT INTO `goods` VALUES ('2', 'aa', '2016052000000036', '51', '6', '15', '0', '3', '12.00', '13.00', '0', '1', '7', '1', 'goods/2016-05-20/573f0a5170076.png', '1', '10', '2016-05-29 22:05:11');
INSERT INTO `goods` VALUES ('3', 'bbb', '2016052000000037', '51', '6', '15', '0', '2', '22.00', '22.00', '22', '1', '3', '22', 'goods/2016-05-20/573f1c8ecc9c4.png', '1', '10', '2016-05-20 22:18:17');
INSERT INTO `goods` VALUES ('4', '兰芝精华露', '2016052200000041', '46', '6', '15', '0', '3', '0.01', '0.02', '13', '1', '31', '精华', 'goods/2016-05-22/574134d9f2b65.jpg', '1', '10', '2016-05-31 14:50:59');
INSERT INTO `goods` VALUES ('5', '城野医生', '2016052200000042', '51', '7', '15', '0', '3', '112.00', '132.00', '12', '1', '2', '去角质，爽肤水', 'goods/2016-05-22/5741b8ecc2f11.jpg', '1', '10', '2016-05-22 21:50:23');

-- ----------------------------
-- Table structure for goods_album
-- ----------------------------
DROP TABLE IF EXISTS `goods_album`;
CREATE TABLE `goods_album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `path` varchar(100) NOT NULL DEFAULT '' COMMENT '图片路径',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='商品相册';

-- ----------------------------
-- Records of goods_album
-- ----------------------------
INSERT INTO `goods_album` VALUES ('1', '9', '2015-11-08/563ee9041e4c2.png');
INSERT INTO `goods_album` VALUES ('3', '9', '2015-11-08/563eecaa6b2eb.jpg');
INSERT INTO `goods_album` VALUES ('8', '20', '2015-11-14/5646dd38393ba.jpg');
INSERT INTO `goods_album` VALUES ('9', '21', '2015-11-14/5646dd6cbf392.jpg');
INSERT INTO `goods_album` VALUES ('10', '21', '2015-11-14/5646dd6d2632f.jpg');
INSERT INTO `goods_album` VALUES ('11', '21', '2015-11-14/5646dd6d767b1.jpg');
INSERT INTO `goods_album` VALUES ('12', '21', '2015-11-14/5646dd6dc951a.jpg');
INSERT INTO `goods_album` VALUES ('13', '22', '2015-11-14/5646dd9d99181.jpg');
INSERT INTO `goods_album` VALUES ('14', '22', '2015-11-14/5646dd9df000e.jpg');
INSERT INTO `goods_album` VALUES ('15', '22', '2015-11-14/5646dd9e4f1c9.jpg');
INSERT INTO `goods_album` VALUES ('16', '23', '2015-11-14/5646ddc7a4562.jpg');
INSERT INTO `goods_album` VALUES ('17', '23', '2015-11-14/5646ddc8102a7.jpg');
INSERT INTO `goods_album` VALUES ('18', '23', '2015-11-14/5646ddc873120.jpg');
INSERT INTO `goods_album` VALUES ('22', '24', '2015-11-14/5646ddfde6bc6.jpg');
INSERT INTO `goods_album` VALUES ('23', '24', '2015-11-14/5646ddfe500e4.jpg');
INSERT INTO `goods_album` VALUES ('24', '24', '2015-11-14/5646ddfe9fe3b.jpg');
INSERT INTO `goods_album` VALUES ('25', '24', '2015-11-14/5646ddfef074a.jpg');
INSERT INTO `goods_album` VALUES ('26', '25', '2015-11-14/5646ded947f47.jpg');
INSERT INTO `goods_album` VALUES ('27', '25', '2015-11-14/5646ded9e21a1.jpg');
INSERT INTO `goods_album` VALUES ('28', '25', '2015-11-14/5646deda5ca88.jpg');
INSERT INTO `goods_album` VALUES ('29', '31', '请登录!');
INSERT INTO `goods_album` VALUES ('30', '31', '请登录!');
INSERT INTO `goods_album` VALUES ('31', '33', 'goods/2016-04-10/570a053b664eb.JPG');
INSERT INTO `goods_album` VALUES ('32', '33', 'goods/2016-04-10/570a053b860c2.JPG');
INSERT INTO `goods_album` VALUES ('33', '36', 'goods/2016-05-20/573f0ab0ddc23.png');
INSERT INTO `goods_album` VALUES ('34', '36', 'goods/2016-05-20/573f0ab4b4e58.png');
INSERT INTO `goods_album` VALUES ('35', '37', 'goods/2016-05-20/573f1c985f24f.png');
INSERT INTO `goods_album` VALUES ('36', '41', 'goods/2016-05-22/57416079aaaf4.jpg');
INSERT INTO `goods_album` VALUES ('37', '41', 'goods/2016-05-22/5741607d40b7b.jpg');
INSERT INTO `goods_album` VALUES ('38', '41', 'goods/2016-05-22/5741608009706.jpg');
INSERT INTO `goods_album` VALUES ('39', '42', 'goods/2016-05-22/5741baa2766f7.jpg');
INSERT INTO `goods_album` VALUES ('40', '42', 'goods/2016-05-22/5741baa5de10d.jpg');
INSERT INTO `goods_album` VALUES ('41', '42', 'goods/2016-05-22/5741baa8c7fc1.jpg');
INSERT INTO `goods_album` VALUES ('42', '43', 'goods/2016-05-31/574cfcbd3d82b.jpg');

-- ----------------------------
-- Table structure for goods_article
-- ----------------------------
DROP TABLE IF EXISTS `goods_article`;
CREATE TABLE `goods_article` (
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `article_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关联文章';

-- ----------------------------
-- Records of goods_article
-- ----------------------------
INSERT INTO `goods_article` VALUES ('11', '3');
INSERT INTO `goods_article` VALUES ('11', '2');
INSERT INTO `goods_article` VALUES ('36', '11');

-- ----------------------------
-- Table structure for goods_attribute
-- ----------------------------
DROP TABLE IF EXISTS `goods_attribute`;
CREATE TABLE `goods_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `attribute_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '属性ID',
  `value` text COMMENT '属性的值',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COMMENT='商品属性';

-- ----------------------------
-- Records of goods_attribute
-- ----------------------------
INSERT INTO `goods_attribute` VALUES ('5', '30', '3', '真丝1');
INSERT INTO `goods_attribute` VALUES ('6', '30', '4', '大裙子1');
INSERT INTO `goods_attribute` VALUES ('7', '30', '5', '2016');
INSERT INTO `goods_attribute` VALUES ('10', '30', '1', '红色');
INSERT INTO `goods_attribute` VALUES ('13', '30', '2', 'S');
INSERT INTO `goods_attribute` VALUES ('14', '30', '2', 'M');
INSERT INTO `goods_attribute` VALUES ('17', '30', '1', '白色');
INSERT INTO `goods_attribute` VALUES ('18', '30', '2', 'XL');
INSERT INTO `goods_attribute` VALUES ('40', '40', '6', '保湿');
INSERT INTO `goods_attribute` VALUES ('41', '40', '6', '美白');
INSERT INTO `goods_attribute` VALUES ('42', '40', '7', '正常肤质');
INSERT INTO `goods_attribute` VALUES ('43', '40', '8', '韩国');
INSERT INTO `goods_attribute` VALUES ('44', '40', '9', '3年');
INSERT INTO `goods_attribute` VALUES ('45', '40', '10', '2016');
INSERT INTO `goods_attribute` VALUES ('46', '41', '6', '保湿');
INSERT INTO `goods_attribute` VALUES ('47', '41', '6', '美白');
INSERT INTO `goods_attribute` VALUES ('48', '41', '7', '正常肤质');
INSERT INTO `goods_attribute` VALUES ('50', '41', '9', '3年');
INSERT INTO `goods_attribute` VALUES ('51', '41', '10', '2015年');
INSERT INTO `goods_attribute` VALUES ('52', '41', '8', '中国');
INSERT INTO `goods_attribute` VALUES ('53', '42', '6', '补水');
INSERT INTO `goods_attribute` VALUES ('54', '42', '6', '美白');
INSERT INTO `goods_attribute` VALUES ('55', '42', '7', '敏感肤质');
INSERT INTO `goods_attribute` VALUES ('56', '42', '8', '韩国');
INSERT INTO `goods_attribute` VALUES ('57', '42', '9', '3年');
INSERT INTO `goods_attribute` VALUES ('58', '42', '10', '2015年');

-- ----------------------------
-- Table structure for goods_category
-- ----------------------------
DROP TABLE IF EXISTS `goods_category`;
CREATE TABLE `goods_category` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '父分类',
  `lft` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '左边界',
  `rgt` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '右边界',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '级别',
  `intro` text COMMENT '简介@textarea',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  `type` tinyint(4) DEFAULT NULL COMMENT '所属种类',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `lft` (`lft`,`rgt`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='商品分类';

-- ----------------------------
-- Records of goods_category
-- ----------------------------
INSERT INTO `goods_category` VALUES ('43', '爽肤水_del', '0', '1', '2', '1', '', '-1', '20', null);
INSERT INTO `goods_category` VALUES ('44', '乳液', '48', '10', '11', '2', '', '1', '20', '3');
INSERT INTO `goods_category` VALUES ('45', '眼霜', '48', '12', '13', '2', '', '1', '20', '3');
INSERT INTO `goods_category` VALUES ('46', '精华液', '48', '14', '15', '2', '', '1', '20', '3');
INSERT INTO `goods_category` VALUES ('47', '面霜', '48', '8', '9', '2', '', '1', '20', null);
INSERT INTO `goods_category` VALUES ('48', '护肤品', '0', '7', '18', '1', '', '1', '20', '0');
INSERT INTO `goods_category` VALUES ('49', '彩妆', '0', '3', '4', '1', '', '1', '20', null);
INSERT INTO `goods_category` VALUES ('50', '洗护用品', '0', '5', '6', '1', '', '1', '20', null);
INSERT INTO `goods_category` VALUES ('51', '爽肤水', '48', '16', '17', '2', '', '1', '20', '3');

-- ----------------------------
-- Table structure for goods_intro
-- ----------------------------
DROP TABLE IF EXISTS `goods_intro`;
CREATE TABLE `goods_intro` (
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `intro` text COMMENT '商品描述',
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品描述';

-- ----------------------------
-- Records of goods_intro
-- ----------------------------
INSERT INTO `goods_intro` VALUES ('5', '&lt;p&gt;&lt;strong&gt;dasdfasdfasdfadfasdfa&lt;/strong&gt;&lt;/p&gt;');
INSERT INTO `goods_intro` VALUES ('6', '<p>666666666666666666666</p>');
INSERT INTO `goods_intro` VALUES ('7', '');
INSERT INTO `goods_intro` VALUES ('9', '');
INSERT INTO `goods_intro` VALUES ('10', '');
INSERT INTO `goods_intro` VALUES ('11', '');
INSERT INTO `goods_intro` VALUES ('16', '');
INSERT INTO `goods_intro` VALUES ('30', '<p>eee</p>');
INSERT INTO `goods_intro` VALUES ('31', '<p>asdadada<img src=\"http://img.baidu.com/hi/jx2/j_0002.gif\"/></p>');
INSERT INTO `goods_intro` VALUES ('17', '<p>222</p>');
INSERT INTO `goods_intro` VALUES ('26', '');
INSERT INTO `goods_intro` VALUES ('25', '');
INSERT INTO `goods_intro` VALUES ('24', '');
INSERT INTO `goods_intro` VALUES ('23', '');
INSERT INTO `goods_intro` VALUES ('22', '');
INSERT INTO `goods_intro` VALUES ('21', '');
INSERT INTO `goods_intro` VALUES ('20', '');
INSERT INTO `goods_intro` VALUES ('19', '');
INSERT INTO `goods_intro` VALUES ('18', '');
INSERT INTO `goods_intro` VALUES ('34', '');
INSERT INTO `goods_intro` VALUES ('33', '');
INSERT INTO `goods_intro` VALUES ('37', '');
INSERT INTO `goods_intro` VALUES ('41', '');
INSERT INTO `goods_intro` VALUES ('43', '');
INSERT INTO `goods_intro` VALUES ('36', '');
INSERT INTO `goods_intro` VALUES ('35', '<p>韩国原装进口哦，手慢无。<img src=\"http://img.baidu.com/hi/jx2/j_0002.gif\"/></p><p><img src=\"/ueditor/php/upload/image/20160531/1464687738394601.gif\" title=\"1464687738394601.gif\" alt=\"贪玩.gif\"/></p><p><img src=\"/ueditor/php/upload/image/20160531/1464687744304320.jpg\" title=\"1464687744304320.jpg\" alt=\"2.jpg\"/></p><p><br/></p>');
INSERT INTO `goods_intro` VALUES ('42', '<p>城野医生棒棒哒</p><p><img src=\"/ueditor/php/upload/image/20160531/1464688147114541.gif\" title=\"1464688147114541.gif\" alt=\"兔子.gif\"/></p>');

-- ----------------------------
-- Table structure for goods_member_price
-- ----------------------------
DROP TABLE IF EXISTS `goods_member_price`;
CREATE TABLE `goods_member_price` (
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `member_level_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '级别ID',
  `price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '会员价格',
  KEY `goods_id` (`goods_id`),
  KEY `member_level_id` (`member_level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品会员价格';

-- ----------------------------
-- Records of goods_member_price
-- ----------------------------
INSERT INTO `goods_member_price` VALUES ('16', '1', '30.00');
INSERT INTO `goods_member_price` VALUES ('16', '2', '20.00');
INSERT INTO `goods_member_price` VALUES ('16', '3', '10.00');
INSERT INTO `goods_member_price` VALUES ('30', '1', '0.00');
INSERT INTO `goods_member_price` VALUES ('30', '2', '0.00');
INSERT INTO `goods_member_price` VALUES ('30', '3', '0.00');
INSERT INTO `goods_member_price` VALUES ('31', '1', '40.00');
INSERT INTO `goods_member_price` VALUES ('31', '2', '30.00');
INSERT INTO `goods_member_price` VALUES ('31', '3', '20.00');
INSERT INTO `goods_member_price` VALUES ('17', '1', '0.00');
INSERT INTO `goods_member_price` VALUES ('17', '2', '0.00');
INSERT INTO `goods_member_price` VALUES ('17', '3', '0.00');
INSERT INTO `goods_member_price` VALUES ('26', '1', '0.00');
INSERT INTO `goods_member_price` VALUES ('26', '2', '0.00');
INSERT INTO `goods_member_price` VALUES ('26', '3', '0.00');
INSERT INTO `goods_member_price` VALUES ('25', '1', '0.00');
INSERT INTO `goods_member_price` VALUES ('25', '2', '0.00');
INSERT INTO `goods_member_price` VALUES ('25', '3', '0.00');
INSERT INTO `goods_member_price` VALUES ('24', '1', '0.00');
INSERT INTO `goods_member_price` VALUES ('24', '2', '0.00');
INSERT INTO `goods_member_price` VALUES ('24', '3', '0.00');
INSERT INTO `goods_member_price` VALUES ('23', '1', '0.00');
INSERT INTO `goods_member_price` VALUES ('23', '2', '0.00');
INSERT INTO `goods_member_price` VALUES ('23', '3', '0.00');
INSERT INTO `goods_member_price` VALUES ('22', '1', '0.00');
INSERT INTO `goods_member_price` VALUES ('22', '2', '0.00');
INSERT INTO `goods_member_price` VALUES ('22', '3', '0.00');
INSERT INTO `goods_member_price` VALUES ('21', '1', '0.00');
INSERT INTO `goods_member_price` VALUES ('21', '2', '0.00');
INSERT INTO `goods_member_price` VALUES ('21', '3', '0.00');
INSERT INTO `goods_member_price` VALUES ('20', '1', '0.00');
INSERT INTO `goods_member_price` VALUES ('20', '2', '0.00');
INSERT INTO `goods_member_price` VALUES ('20', '3', '0.00');
INSERT INTO `goods_member_price` VALUES ('19', '1', '0.00');
INSERT INTO `goods_member_price` VALUES ('19', '2', '0.00');
INSERT INTO `goods_member_price` VALUES ('19', '3', '0.00');
INSERT INTO `goods_member_price` VALUES ('18', '1', '0.00');
INSERT INTO `goods_member_price` VALUES ('18', '2', '0.00');
INSERT INTO `goods_member_price` VALUES ('18', '3', '0.00');
INSERT INTO `goods_member_price` VALUES ('34', '1', '344.00');
INSERT INTO `goods_member_price` VALUES ('34', '2', '211.00');
INSERT INTO `goods_member_price` VALUES ('34', '3', '200.00');
INSERT INTO `goods_member_price` VALUES ('33', '1', '46.00');
INSERT INTO `goods_member_price` VALUES ('33', '2', '42.00');
INSERT INTO `goods_member_price` VALUES ('33', '3', '39.00');
INSERT INTO `goods_member_price` VALUES ('37', '1', '1.00');
INSERT INTO `goods_member_price` VALUES ('37', '2', '1.00');
INSERT INTO `goods_member_price` VALUES ('37', '3', '1.00');
INSERT INTO `goods_member_price` VALUES ('41', '1', '3.00');
INSERT INTO `goods_member_price` VALUES ('41', '2', '2.00');
INSERT INTO `goods_member_price` VALUES ('41', '3', '1.00');
INSERT INTO `goods_member_price` VALUES ('43', '1', '1.00');
INSERT INTO `goods_member_price` VALUES ('43', '2', '1.00');
INSERT INTO `goods_member_price` VALUES ('43', '3', '1.00');
INSERT INTO `goods_member_price` VALUES ('36', '1', '1.00');
INSERT INTO `goods_member_price` VALUES ('36', '2', '2.00');
INSERT INTO `goods_member_price` VALUES ('36', '3', '3.00');
INSERT INTO `goods_member_price` VALUES ('35', '1', '180.00');
INSERT INTO `goods_member_price` VALUES ('35', '2', '160.00');
INSERT INTO `goods_member_price` VALUES ('35', '3', '140.00');
INSERT INTO `goods_member_price` VALUES ('42', '1', '112.00');
INSERT INTO `goods_member_price` VALUES ('42', '2', '103.00');
INSERT INTO `goods_member_price` VALUES ('42', '3', '90.00');

-- ----------------------------
-- Table structure for goods_times
-- ----------------------------
DROP TABLE IF EXISTS `goods_times`;
CREATE TABLE `goods_times` (
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `times` int(11) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品浏览次数';

-- ----------------------------
-- Records of goods_times
-- ----------------------------
INSERT INTO `goods_times` VALUES ('17', '21');
INSERT INTO `goods_times` VALUES ('18', '2');
INSERT INTO `goods_times` VALUES ('19', '2');
INSERT INTO `goods_times` VALUES ('20', '12');

-- ----------------------------
-- Table structure for goods_type
-- ----------------------------
DROP TABLE IF EXISTS `goods_type`;
CREATE TABLE `goods_type` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '类型名称',
  `intro` text COMMENT '类型描述@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` smallint(6) NOT NULL DEFAULT '20' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='商品类型';

-- ----------------------------
-- Records of goods_type
-- ----------------------------
INSERT INTO `goods_type` VALUES ('1', '手机', '', '1', '20');
INSERT INTO `goods_type` VALUES ('2', '衣服', '', '1', '20');
INSERT INTO `goods_type` VALUES ('3', '护肤品', '', '1', '20');
INSERT INTO `goods_type` VALUES ('4', '美妆', '', '1', '20');
INSERT INTO `goods_type` VALUES ('5', '洗护用品', '', '1', '20');

-- ----------------------------
-- Table structure for invoice
-- ----------------------------
DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_info_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `name` varchar(50) NOT NULL DEFAULT '0' COMMENT '发票的抬头',
  `content` text COMMENT '发票内容',
  `price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '明细价格总和',
  PRIMARY KEY (`id`),
  KEY `order_info_id` (`order_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='发票';

-- ----------------------------
-- Records of invoice
-- ----------------------------
INSERT INTO `invoice` VALUES ('2', '13', '444444444444', 'HTC&nbsp;1&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '700.00');
INSERT INTO `invoice` VALUES ('3', '14', '444444444444', 'HTC&nbsp;1&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '700.00');
INSERT INTO `invoice` VALUES ('4', '15', '444444444444', 'HTC&nbsp;1&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '700.00');
INSERT INTO `invoice` VALUES ('5', '16', 'zhangsan', 'HTC&nbsp;1&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '700.00');
INSERT INTO `invoice` VALUES ('6', '17', 'zhangsan', 'HTC&nbsp;1&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '700.00');
INSERT INTO `invoice` VALUES ('7', '18', 'zhangsan', 'HTC&nbsp;1&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '700.00');
INSERT INTO `invoice` VALUES ('8', '19', 'zhangsan', 'HTC&nbsp;1&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '700.00');
INSERT INTO `invoice` VALUES ('9', '20', 'zhangsan', 'HTC&nbsp;1&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '700.00');
INSERT INTO `invoice` VALUES ('10', '21', 'zhangsan', 'HTC&nbsp;1&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '700.00');
INSERT INTO `invoice` VALUES ('11', '22', 'zhangsan', 'HTC&nbsp;2&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '800.00');
INSERT INTO `invoice` VALUES ('12', '23', 'zhangsan', 'HTC&nbsp;2&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '800.00');
INSERT INTO `invoice` VALUES ('13', '24', 'zhangsan', 'HTC&nbsp;2&nbsp;100.00<br/>iphone6&nbsp;1&nbsp;200.00<br/>LG&nbsp;1&nbsp;400.00<br/>', '800.00');
INSERT INTO `invoice` VALUES ('14', '25', '21', 'bbb244<br/>', '44.00');

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(50) DEFAULT '' COMMENT 'Email',
  `tel` int(11) NOT NULL,
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '加入时间',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `salt` char(6) NOT NULL DEFAULT '' COMMENT '盐',
  `mail_key` char(32) NOT NULL DEFAULT '' COMMENT '邮件激活时的key',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  `auto_key` varchar(255) DEFAULT NULL COMMENT '随机串',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('19', 'zhangsan', 'c0732bd2d1d8bd1e613293320bc53e12', 'itsource520@126.com', '0', '1447743247', '0', 'bFGWPU', 'c1931c679a246c2fe7d349039f20ff16', '1', '20', null);
INSERT INTO `member` VALUES ('20', 'lisi', '4256e2682901741c6395d716806eb16e', 'lisi@qq.com', '0', '1448091118', '0', 'vLbpFA', 'b8059fe52ac84f1cc4e0df0922f443ad', '1', '20', null);
INSERT INTO `member` VALUES ('21', '大大大大', '892bc01cdf4d7e8c088aa07dc2a9df64', 'dada@qqcom', '0', '1463304845', '0', 'kVOuoB', '94fd3302d1134609a8fcd7292951ec65', '1', '20', 'dUKlIN');
INSERT INTO `member` VALUES ('22', 'aaa', '6fc5cb12d37048fde3fbcd4964c807bf', '', '0', '1464521149', '0', 'DkuvEG', '751bdd193102bdd16079f86f9fdf078e', '-1', '20', null);
INSERT INTO `member` VALUES ('23', '邓颖', '38e7ad8092b2f90b25c3433f8f428676', '', '0', '1464521909', '0', 'XcHrWT', '135651308d11cc2ca85072c517130993', '1', '20', 'SjWfQc');

-- ----------------------------
-- Table structure for member_level
-- ----------------------------
DROP TABLE IF EXISTS `member_level`;
CREATE TABLE `member_level` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `bottom` int(11) NOT NULL DEFAULT '0' COMMENT '经验值下限',
  `top` int(11) NOT NULL DEFAULT '0' COMMENT '经验值上限',
  `discount` tinyint(4) NOT NULL DEFAULT '0' COMMENT '折扣率',
  `intro` text COMMENT '摘要@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `bottom` (`bottom`,`top`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='会员级别';

-- ----------------------------
-- Records of member_level
-- ----------------------------
INSERT INTO `member_level` VALUES ('1', '注册会员', '0', '10000', '90', '注册会员', '1', '20');
INSERT INTO `member_level` VALUES ('2', '金牌会员', '10001', '30000', '80', '金牌会员', '1', '20');
INSERT INTO `member_level` VALUES ('3', '钻石会员', '30001', '2147483647', '50', '钻石会员', '1', '20');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `url` varchar(50) NOT NULL DEFAULT '' COMMENT '菜单URL',
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '父菜单',
  `lft` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '左边界',
  `rgt` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '右边界',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '级别',
  `intro` text COMMENT '简介@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `lft` (`lft`,`rgt`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='菜单';

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '商品管理', '', '0', '1', '20', '1', '', '1', '1');
INSERT INTO `menu` VALUES ('2', '订单管理', '', '0', '21', '22', '1', '', '1', '2');
INSERT INTO `menu` VALUES ('3', '会员管理', '', '0', '23', '28', '1', '', '1', '3');
INSERT INTO `menu` VALUES ('4', '系统管理', '', '0', '33', '42', '1', '', '1', '5');
INSERT INTO `menu` VALUES ('5', '商品列表', 'Goods/index', '1', '8', '9', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('6', '添加商品', 'Goods/add', '1', '2', '3', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('7', '商品分类', 'GoodsCategory/index', '1', '4', '5', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('8', '商品品牌', 'Brand/index', '1', '10', '11', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('9', '商品类型', 'GoodsType/index', '1', '6', '7', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('10', '管理员管理', 'Admin/index', '4', '40', '41', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('11', '角色管理', 'Role/index', '4', '34', '35', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('12', '权限管理', 'Permission/index', '4', '36', '37', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('13', '文章管理', '', '0', '29', '32', '1', '', '1', '4');
INSERT INTO `menu` VALUES ('14', '文章列表', 'Article/Index', '13', '30', '31', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('15', '用户评论_del', 'User/comment', '1', '12', '13', '2', '', '-1', '20');
INSERT INTO `menu` VALUES ('16', '用户评论', 'User/comment', '1', '14', '15', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('17', '商品回收站', 'Goods/delete', '1', '16', '17', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('18', '会员列表_del', 'Member/index', '3', '24', '25', '2', '', '-1', '20');
INSERT INTO `menu` VALUES ('19', '会员列表', 'Member/index', '3', '26', '27', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('20', '菜单管理', 'Menu/index', '4', '38', '39', '2', '', '1', '20');
INSERT INTO `menu` VALUES ('21', '商品供应商', 'Suppler/index', '1', '18', '19', '2', '', '1', '20');

-- ----------------------------
-- Table structure for menu_permission
-- ----------------------------
DROP TABLE IF EXISTS `menu_permission`;
CREATE TABLE `menu_permission` (
  `menu_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '菜单ID',
  `permission_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '权限ID',
  KEY `permission_id` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='菜单权限';

-- ----------------------------
-- Records of menu_permission
-- ----------------------------
INSERT INTO `menu_permission` VALUES ('14', '16');
INSERT INTO `menu_permission` VALUES ('14', '15');
INSERT INTO `menu_permission` VALUES ('14', '13');
INSERT INTO `menu_permission` VALUES ('14', '12');
INSERT INTO `menu_permission` VALUES ('5', '1');
INSERT INTO `menu_permission` VALUES ('5', '2');
INSERT INTO `menu_permission` VALUES ('5', '3');
INSERT INTO `menu_permission` VALUES ('5', '6');
INSERT INTO `menu_permission` VALUES ('8', '1');
INSERT INTO `menu_permission` VALUES ('8', '4');
INSERT INTO `menu_permission` VALUES ('8', '5');

-- ----------------------------
-- Table structure for order_info
-- ----------------------------
DROP TABLE IF EXISTS `order_info`;
CREATE TABLE `order_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sn` char(20) NOT NULL DEFAULT '' COMMENT '订单编号',
  `receiver` varchar(20) NOT NULL DEFAULT '' COMMENT '收货人',
  `province_id` int(11) NOT NULL DEFAULT '0' COMMENT '省份ID',
  `province_name` varchar(20) NOT NULL DEFAULT '' COMMENT '省份名字',
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT '城市ID',
  `city_name` varchar(20) NOT NULL DEFAULT '' COMMENT '省份名字',
  `area_id` int(11) NOT NULL DEFAULT '0' COMMENT '区县ID',
  `area_name` varchar(50) NOT NULL DEFAULT '' COMMENT '区县名字',
  `detail_address` varchar(100) NOT NULL DEFAULT '' COMMENT '详细地址',
  `tel` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `delivery_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '送货方式ID',
  `delivery_name` varchar(20) NOT NULL DEFAULT '' COMMENT '送货方式',
  `delivery_price` decimal(5,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `pay_type_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '支付方式ID',
  `pay_type_name` varchar(20) NOT NULL DEFAULT '' COMMENT '支付方式',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员Id',
  `inputtime` int(11) NOT NULL DEFAULT '0' COMMENT '下单时间',
  `order_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '订单状态   0未确认 1已确认 2退货中 3 已退货',
  `shipping_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '物流状态 0未发货 1 配货中  2 已发货',
  `pay_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '支付状态 0=未支付 1=已付款',
  `price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '订单价格',
  `invoice_id` int(11) NOT NULL DEFAULT '0' COMMENT '发票ID',
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `operator_id` tinyint(4) DEFAULT NULL COMMENT '操作者编号',
  `status` tinyint(2) DEFAULT '1' COMMENT '订单是否存在  1 存在 -1 不存在',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sn` (`sn`),
  KEY `province_id` (`province_id`),
  KEY `city_id` (`city_id`),
  KEY `area_id` (`area_id`),
  KEY `delivery_id` (`delivery_id`),
  KEY `pay_type_id` (`pay_type_id`),
  KEY `inputtime` (`inputtime`),
  KEY `member_id` (`member_id`),
  KEY `order_status` (`order_status`),
  KEY `shipping_status` (`shipping_status`),
  KEY `pay_status` (`pay_status`),
  KEY `invoice_id` (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='订单';

-- ----------------------------
-- Records of order_info
-- ----------------------------
INSERT INTO `order_info` VALUES ('46', '20160528000000000046', '大明', '1', '四川', '3', '成都', '7', '青羊区', 'aaaaaaa', '18380448380', '1', '普通快递送货上门', '0.00', '1', '货到付款', '21', '1464398757', '1', '2', '1', '12.01', '0', '2016-05-30 22:08:11', null, '1');
INSERT INTO `order_info` VALUES ('47', '20160528000000000047', '小明', '2', '河南', '3', '成都', '7', '青羊区', 'bbbbbb', '18380448380', '1', '普通快递送货上门', '0.00', '2', '在线支付', '21', '1464400037', '0', '0', '1', '112.00', '0', '2016-05-30 22:07:38', null, '1');
INSERT INTO `order_info` VALUES ('48', '20160529000000000048', '大邓', '1', '四川', '3', '成都', '7', '青羊区', '高新区', '18380448380', '1', '普通快递送货上门', '0.00', '1', '货到付款', '23', '1464530711', '0', '0', '0', '12.00', '0', '2016-05-29 22:05:11', null, '1');
INSERT INTO `order_info` VALUES ('49', '20160531000000000049', '大大1', '1', '四川', '3', '成都', '7', '青羊区', '丢球村', '18323232323', '1', '普通快递送货上门', '0.00', '1', '货到付款', '21', '1464677459', '0', '0', '0', '0.01', '0', '2016-05-31 14:50:59', null, '1');

-- ----------------------------
-- Table structure for order_info_item
-- ----------------------------
DROP TABLE IF EXISTS `order_info_item`;
CREATE TABLE `order_info_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_info_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品的名字',
  `logo` varchar(50) NOT NULL DEFAULT '' COMMENT '商品的LOGO',
  `shop_price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '明细中的价格',
  PRIMARY KEY (`id`),
  KEY `order_info_id` (`order_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COMMENT='订单明细';

-- ----------------------------
-- Records of order_info_item
-- ----------------------------
INSERT INTO `order_info_item` VALUES ('79', '46', '41', '兰芝精华露', 'goods/2016-05-22/574134d9f2b65.jpg', '0.01', '1', '0.01');
INSERT INTO `order_info_item` VALUES ('80', '46', '36', 'aa', 'goods/2016-05-20/573f0a5170076.png', '12.00', '1', '12.00');
INSERT INTO `order_info_item` VALUES ('81', '47', '42', '城野医生', 'goods/2016-05-22/5741b8ecc2f11.jpg', '112.00', '1', '112.00');
INSERT INTO `order_info_item` VALUES ('82', '48', '36', 'aa', 'goods/2016-05-20/573f0a5170076.png', '12.00', '1', '12.00');
INSERT INTO `order_info_item` VALUES ('83', '49', '41', '兰芝精华露', 'goods/2016-05-22/574134d9f2b65.jpg', '0.01', '1', '0.01');

-- ----------------------------
-- Table structure for pay_type
-- ----------------------------
DROP TABLE IF EXISTS `pay_type`;
CREATE TABLE `pay_type` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '支付方式名称',
  `intro` text COMMENT '支付方式描述@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` smallint(6) NOT NULL DEFAULT '20' COMMENT '排序',
  `is_default` tinyint(4) NOT NULL DEFAULT '0' COMMENT '默认@radio|1=是&0=否',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='支付方式';

-- ----------------------------
-- Records of pay_type
-- ----------------------------
INSERT INTO `pay_type` VALUES ('1', '货到付款', '送货上门后再收款，支持现金、POS机刷卡、支票支付', '1', '20', '1');
INSERT INTO `pay_type` VALUES ('2', '在线支付', '即时到帐，支持绝大数银行借记卡及部分银行信用卡', '1', '20', '0');
INSERT INTO `pay_type` VALUES ('3', '上门自提', '自提时付款，支持现金、POS刷卡、支票支付', '0', '20', '0');
INSERT INTO `pay_type` VALUES ('4', '邮局汇款', '通过快钱平台收款 汇款后1-3个工作日到账', '0', '20', '0');

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '权限名称',
  `url` varchar(50) NOT NULL DEFAULT '' COMMENT '权限的URL',
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '父分类',
  `lft` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '左边界',
  `rgt` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '右边界',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '级别',
  `intro` text COMMENT '简介@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` tinyint(4) NOT NULL DEFAULT '20' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `lft` (`lft`,`rgt`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='权限';

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES ('17', '商品管理', '', '0', '1', '26', '1', '', '1', '20');
INSERT INTO `permission` VALUES ('18', '商品管理', 'Goods/index', '17', '18', '19', '2', '', '1', '20');
INSERT INTO `permission` VALUES ('19', '添加商品_del', 'Goods/add', '17', '10', '11', '2', '通用信息，相册，文章等', '-1', '20');
INSERT INTO `permission` VALUES ('20', '编辑商品_del', 'Goods/edit', '17', '2', '3', '2', '修改商品资料', '-1', '20');
INSERT INTO `permission` VALUES ('21', '删除商品_del', 'Goods/changeStatus', '17', '4', '5', '2', '', '-1', '20');
INSERT INTO `permission` VALUES ('22', '商品分类', 'GoodsCategory/index', '17', '12', '13', '2', '增，删，改，查', '1', '1');
INSERT INTO `permission` VALUES ('23', '商品品牌', 'Brand/index', '17', '6', '7', '2', '增，删，改，查', '1', '20');
INSERT INTO `permission` VALUES ('24', '商品类型', 'GoodsType/index', '17', '20', '21', '2', '增，删，改，查', '1', '20');
INSERT INTO `permission` VALUES ('25', '商品回收站', 'Recycle/Index', '17', '22', '23', '2', '并未从数据库真正移除，回收站中删除才是真正移除', '1', '20');
INSERT INTO `permission` VALUES ('26', '文章管理', '', '0', '27', '38', '1', '', '1', '20');
INSERT INTO `permission` VALUES ('27', '文章列表', 'Article/index', '26', '34', '35', '2', '增，删，改，查', '1', '20');
INSERT INTO `permission` VALUES ('28', '添加文章_del', 'Article/add', '26', '28', '29', '2', '', '-1', '20');
INSERT INTO `permission` VALUES ('29', '修改文章_del', 'Article/edit', '26', '30', '31', '2', '', '-1', '20');
INSERT INTO `permission` VALUES ('30', '文章删除_del', 'Article/changeStatus', '26', '32', '33', '2', '', '-1', '20');
INSERT INTO `permission` VALUES ('31', '文章分类', 'ArticleCategory/index', '26', '36', '37', '2', '增，删，改，查', '1', '20');
INSERT INTO `permission` VALUES ('32', '会员管理', '', '0', '39', '42', '1', '', '0', '20');
INSERT INTO `permission` VALUES ('33', '会员列表', 'Member/index', '32', '40', '41', '2', '增，删，改，查', '0', '20');
INSERT INTO `permission` VALUES ('34', '删除商品_del', 'Goods/changeStatus', '17', '8', '9', '2', '加入回收站', '-1', '20');
INSERT INTO `permission` VALUES ('35', '用户评论', 'Comment/index', '17', '24', '25', '2', '', '1', '20');
INSERT INTO `permission` VALUES ('36', '通用权限(必选)', '', '0', '59', '68', '1', '', '0', '20');
INSERT INTO `permission` VALUES ('37', '后台首页', 'Index/index', '36', '60', '61', '2', '', '0', '20');
INSERT INTO `permission` VALUES ('38', '后台顶部', 'Index/top', '36', '66', '67', '2', '', '0', '20');
INSERT INTO `permission` VALUES ('39', '后台左侧菜单', 'Index/menu', '36', '62', '63', '2', '', '0', '20');
INSERT INTO `permission` VALUES ('40', '后台中间版心', 'Index/main', '36', '64', '65', '2', '', '0', '20');
INSERT INTO `permission` VALUES ('41', '系统权限', '', '0', '43', '58', '1', '', '1', '20');
INSERT INTO `permission` VALUES ('42', '角色管理', 'Role/index', '41', '44', '45', '2', '', '1', '20');
INSERT INTO `permission` VALUES ('43', '管理员管理', 'Admin/index', '41', '46', '47', '2', '', '1', '20');
INSERT INTO `permission` VALUES ('44', '权限管理', 'Permission/index', '41', '48', '49', '2', '', '1', '20');
INSERT INTO `permission` VALUES ('45', '商品供货商', 'Supplier/index', '17', '14', '15', '2', '', '1', '20');
INSERT INTO `permission` VALUES ('46', '商品属性', 'Attribute/index', '17', '16', '17', '2', '', '1', '20');
INSERT INTO `permission` VALUES ('47', '订单管理', '', '0', '69', '72', '1', '', '1', '20');
INSERT INTO `permission` VALUES ('48', '订单列表', 'OrderInfo/index', '47', '70', '71', '2', '', '1', '20');
INSERT INTO `permission` VALUES ('49', '属性管理', 'Attribute/index', '41', '50', '51', '2', '', '1', '20');
INSERT INTO `permission` VALUES ('50', '送货方式', 'Delivery/index', '41', '52', '53', '2', '', '1', '20');
INSERT INTO `permission` VALUES ('51', '支付方式', 'PayType/index', '41', '54', '55', '2', '', '1', '20');
INSERT INTO `permission` VALUES ('52', '代码生成器', 'Gii/index', '41', '56', '57', '2', '按照规则输入表名', '1', '20');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `goods_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `goods_attribute_ids` varchar(20) NOT NULL DEFAULT '0' COMMENT '属性组合ID',
  `price` decimal(9,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  KEY `goods_id` (`goods_id`),
  KEY `goods_attribute_ids` (`goods_attribute_ids`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='产品';

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('30', '10#18', '2.00', '2');
INSERT INTO `product` VALUES ('30', '10#14', '2.00', '22');
INSERT INTO `product` VALUES ('30', '10#13', '2.00', '2');

-- ----------------------------
-- Table structure for region
-- ----------------------------
DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父地区',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='地区';

-- ----------------------------
-- Records of region
-- ----------------------------
INSERT INTO `region` VALUES ('1', '四川', '0');
INSERT INTO `region` VALUES ('2', '河南', '0');
INSERT INTO `region` VALUES ('3', '成都', '1');
INSERT INTO `region` VALUES ('4', '绵阳', '1');
INSERT INTO `region` VALUES ('5', '德阳', '1');
INSERT INTO `region` VALUES ('6', '资阳', '1');
INSERT INTO `region` VALUES ('7', '青羊区', '3');
INSERT INTO `region` VALUES ('8', '金牛区', '3');
INSERT INTO `region` VALUES ('9', '高新区', '3');
INSERT INTO `region` VALUES ('10', '武侯区', '3');
INSERT INTO `region` VALUES ('11', '三台', '4');
INSERT INTO `region` VALUES ('12', '江油', '4');
INSERT INTO `region` VALUES ('13', '洛阳', '2');
INSERT INTO `region` VALUES ('14', '郑州', '2');
INSERT INTO `region` VALUES ('15', '濮阳', '2');
INSERT INTO `region` VALUES ('16', '嵩县', '13');
INSERT INTO `region` VALUES ('17', '伊川', '13');
INSERT INTO `region` VALUES ('18', '偃师', '13');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '角色名称',
  `intro` text COMMENT '角色描述@text',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态@radio|1=是&0=否',
  `sort` smallint(6) NOT NULL DEFAULT '20' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='角色';

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('7', '测试角色', '商品管理', '1', '20');
INSERT INTO `role` VALUES ('8', '测试角色2', '文章管理', '1', '20');

-- ----------------------------
-- Table structure for role_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission` (
  `role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `permission_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '权限ID',
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色权限关系表';

-- ----------------------------
-- Records of role_permission
-- ----------------------------
INSERT INTO `role_permission` VALUES ('2', '5');
INSERT INTO `role_permission` VALUES ('2', '4');
INSERT INTO `role_permission` VALUES ('2', '1');
INSERT INTO `role_permission` VALUES ('1', '6');
INSERT INTO `role_permission` VALUES ('1', '2');
INSERT INTO `role_permission` VALUES ('1', '1');
INSERT INTO `role_permission` VALUES ('3', '9');
INSERT INTO `role_permission` VALUES ('3', '8');
INSERT INTO `role_permission` VALUES ('3', '7');
INSERT INTO `role_permission` VALUES ('3', '3');
INSERT INTO `role_permission` VALUES ('3', '2');
INSERT INTO `role_permission` VALUES ('3', '1');
INSERT INTO `role_permission` VALUES ('3', '10');
INSERT INTO `role_permission` VALUES ('3', '11');
INSERT INTO `role_permission` VALUES ('4', '18');
INSERT INTO `role_permission` VALUES ('4', '19');
INSERT INTO `role_permission` VALUES ('4', '20');
INSERT INTO `role_permission` VALUES ('4', '17');
INSERT INTO `role_permission` VALUES ('5', '33');
INSERT INTO `role_permission` VALUES ('5', '32');
INSERT INTO `role_permission` VALUES ('5', '22');
INSERT INTO `role_permission` VALUES ('5', '24');
INSERT INTO `role_permission` VALUES ('5', '23');
INSERT INTO `role_permission` VALUES ('5', '17');
INSERT INTO `role_permission` VALUES ('6', '31');
INSERT INTO `role_permission` VALUES ('6', '27');
INSERT INTO `role_permission` VALUES ('6', '26');
INSERT INTO `role_permission` VALUES ('7', '45');
INSERT INTO `role_permission` VALUES ('7', '35');
INSERT INTO `role_permission` VALUES ('7', '22');
INSERT INTO `role_permission` VALUES ('7', '25');
INSERT INTO `role_permission` VALUES ('8', '40');
INSERT INTO `role_permission` VALUES ('8', '39');
INSERT INTO `role_permission` VALUES ('7', '24');
INSERT INTO `role_permission` VALUES ('7', '23');
INSERT INTO `role_permission` VALUES ('7', '17');
INSERT INTO `role_permission` VALUES ('4', '36');
INSERT INTO `role_permission` VALUES ('4', '37');
INSERT INTO `role_permission` VALUES ('4', '38');
INSERT INTO `role_permission` VALUES ('4', '39');
INSERT INTO `role_permission` VALUES ('4', '40');
INSERT INTO `role_permission` VALUES ('5', '36');
INSERT INTO `role_permission` VALUES ('5', '37');
INSERT INTO `role_permission` VALUES ('5', '38');
INSERT INTO `role_permission` VALUES ('5', '39');
INSERT INTO `role_permission` VALUES ('5', '40');
INSERT INTO `role_permission` VALUES ('6', '36');
INSERT INTO `role_permission` VALUES ('6', '37');
INSERT INTO `role_permission` VALUES ('6', '38');
INSERT INTO `role_permission` VALUES ('6', '39');
INSERT INTO `role_permission` VALUES ('6', '40');
INSERT INTO `role_permission` VALUES ('8', '37');
INSERT INTO `role_permission` VALUES ('8', '36');
INSERT INTO `role_permission` VALUES ('8', '31');
INSERT INTO `role_permission` VALUES ('8', '27');
INSERT INTO `role_permission` VALUES ('8', '26');
INSERT INTO `role_permission` VALUES ('7', '46');
INSERT INTO `role_permission` VALUES ('7', '18');
INSERT INTO `role_permission` VALUES ('7', '36');
INSERT INTO `role_permission` VALUES ('7', '37');
INSERT INTO `role_permission` VALUES ('7', '39');
INSERT INTO `role_permission` VALUES ('7', '40');
INSERT INTO `role_permission` VALUES ('7', '38');
INSERT INTO `role_permission` VALUES ('8', '38');

-- ----------------------------
-- Table structure for shopping_car
-- ----------------------------
DROP TABLE IF EXISTS `shopping_car`;
CREATE TABLE `shopping_car` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '货品ID',
  `num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '数量',
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='购物车表';

-- ----------------------------
-- Records of shopping_car
-- ----------------------------

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `intro` text COMMENT '简介',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` smallint(6) NOT NULL DEFAULT '20' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES ('15', '韩国供应商', '韩国供应商', '1', '20');
