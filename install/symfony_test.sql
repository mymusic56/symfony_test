/*
Navicat MySQL Data Transfer

Source Server         : wamp
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : symfony_test

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-04-04 12:43:52
*/

SET FOREIGN_KEY_CHECKS=0;

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
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('1', '测试', '1');
INSERT INTO `group` VALUES ('2', '安保', '1');
INSERT INTO `group` VALUES ('3', '销售', '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `device_mark` varchar(50) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'zhangsan', '123456', '1', '1', 'Leeee', '2018-03-28 16:32:26', '1');
INSERT INTO `user` VALUES ('2', 'zhangsan', '987654', '2', '1', 'Leeee', '2018-03-21 13:58:34', '1');
INSERT INTO `user` VALUES ('3', 'xiaohong', 'eeeeee', '2', '2', 'Leeee', '2018-03-21 13:59:05', '1');
INSERT INTO `user` VALUES ('4', '小红', 'ffffff', '2', '3', 'Leeee-0000', '2018-03-21 13:59:52', '1');
