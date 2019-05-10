/*
Navicat MySQL Data Transfer

Source Server         : wamp
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : symfony_test

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-08-01 19:01:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for combos
-- ----------------------------
DROP TABLE IF EXISTS `combos`;
CREATE TABLE `combos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `combo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of combos
-- ----------------------------
INSERT INTO `combos` VALUES ('1', '小白菜', '5.32', '1533120091', '1');
INSERT INTO `combos` VALUES ('2', '青菜', '6.10', '1533120091', '1');

-- ----------------------------
-- Table structure for feedback
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_mark` varchar(50) DEFAULT '',
  `content` varchar(255) DEFAULT '',
  `system` varchar(15) DEFAULT '',
  `ip` varchar(126) DEFAULT '',
  `created` int(11) DEFAULT '0',
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of feedback
-- ----------------------------
INSERT INTO `feedback` VALUES ('1', 'fffff', '2018-03-28 16:32:31', 'ios', '', '1522147231', '1');
INSERT INTO `feedback` VALUES ('2', '23333', 'kafeaipje', 'ios', '', '1522147231', '1');
INSERT INTO `feedback` VALUES ('3', 'JDKLEJ-KDOE-LEM', '不太好用', 'ios', '', '1522147865', '1');
INSERT INTO `feedback` VALUES ('4', '', '不太好用3333', 'ios', '', '1522204623', '1');
INSERT INTO `feedback` VALUES ('5', 'JDKLEJ-KDOE-LE', '不太好用3333', 'ios', '', '1522205801', '1');
INSERT INTO `feedback` VALUES ('6', 'JDKLEJ-KDOE-LEMO', '不太好用3333', 'ios', '192.168.88.1', '1522213047', '1');
INSERT INTO `feedback` VALUES ('7', '1', 'dkkdk', 'ios', '192.168.88.1', '1522224065', '1');
INSERT INTO `feedback` VALUES ('8', '222222', 'dkkdk', 'ios', '192.168.88.1', '1522231316', '1');
INSERT INTO `feedback` VALUES ('9', '3333333333333', 'dkkdk', 'ios', '192.168.88.1', '1522231969', '1');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', '测试', '0');
INSERT INTO `groups` VALUES ('2', '安保', '1');
INSERT INTO `groups` VALUES ('3', '销售', '1');

-- ----------------------------
-- Table structure for order_combos
-- ----------------------------
DROP TABLE IF EXISTS `order_combos`;
CREATE TABLE `order_combos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `combo_id` int(11) DEFAULT NULL,
  `combo_name` varchar(255) DEFAULT '',
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `combo_id` (`combo_id`),
  CONSTRAINT `combo_id` FOREIGN KEY (`combo_id`) REFERENCES `combos` (`id`),
  CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of order_combos
-- ----------------------------
INSERT INTO `order_combos` VALUES ('1', '1', '1', '小白菜', '3.60');
INSERT INTO `order_combos` VALUES ('2', '1', '2', '青菜', '5.36');
INSERT INTO `order_combos` VALUES ('3', '2', '1', '小白菜', '3.60');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '1', '1', '1533120091');
INSERT INTO `orders` VALUES ('2', '2', '1', '1533120092');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pwd` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `device_mark` varchar(50) CHARACTER SET utf8 DEFAULT '',
  `created` datetime DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `groupid` (`group_id`),
  CONSTRAINT `groupid` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'zhangsan', '123456', '1', '1', 'Leeee', '2018-03-28 16:32:26', '1');
INSERT INTO `users` VALUES ('2', 'zhangsan', '987654', '2', '1', 'Leeee', '2018-03-21 13:58:34', '1');
INSERT INTO `users` VALUES ('3', 'xiaohong', 'eeeeee', '2', '2', 'Leeee', '2018-03-21 13:59:05', '1');
INSERT INTO `users` VALUES ('4', '小红', 'ffffff', '2', '3', 'Leeee-0000', '2018-03-21 13:59:52', '1');
INSERT INTO `users` VALUES ('5', 'zhangsan', '123456', '1', '1', '', '2018-04-16 21:15:20', '1');
INSERT INTO `users` VALUES ('6', 'zhangsan', '123456', '2', '1', '', '2018-04-16 21:15:22', '1');
