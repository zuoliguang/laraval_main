/*
Navicat MySQL Data Transfer

Source Server         : 本机
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-03-26 14:43:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `member`
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `score` float DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `ext_info` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('1', 'aaa', '23', '12345678901', '北京市测试地址', '98', '3-1', '这个只是一个测试信息');
INSERT INTO `member` VALUES ('2', 'ccc', '23', '12345678901', '北京市测试地址', '86', '3-2', '这个只是一个测试信息11111');
INSERT INTO `member` VALUES ('12', 'test_update_agin', '45', '9999999999', 'testkkkkkkkk', '90', '3-5', 'hahahahaha');
INSERT INTO `member` VALUES ('13', 'test_update_agin', '45', '9999999999', 'testkkkkkkkk', '90', '3-5', 'hahahahaha');
INSERT INTO `member` VALUES ('14', 'test_mode', '45', '9999999999', 'testkkkkkkkk', '90', '3-5', 'hahahahaha');
INSERT INTO `member` VALUES ('15', 'model', '40', '88888888', 'peking zhanghao dizhi hahah', '99', '2-9', 'this is a model test model info');

-- ----------------------------
-- Table structure for `m_pwd`
-- ----------------------------
DROP TABLE IF EXISTS `m_pwd`;
CREATE TABLE `m_pwd` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `m_id` int(11) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of m_pwd
-- ----------------------------
INSERT INTO `m_pwd` VALUES ('1', '1', '111111');
INSERT INTO `m_pwd` VALUES ('2', '2', '222222');
INSERT INTO `m_pwd` VALUES ('7', '12', 'cccccccc');
INSERT INTO `m_pwd` VALUES ('8', '13', 'bbbbbb');
INSERT INTO `m_pwd` VALUES ('9', '14', 'aaaaaaa');
INSERT INTO `m_pwd` VALUES ('10', '15', '46556565');

-- ----------------------------
-- Table structure for `say`
-- ----------------------------
DROP TABLE IF EXISTS `say`;
CREATE TABLE `say` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `m_id` int(11) DEFAULT NULL,
  `say` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of say
-- ----------------------------
INSERT INTO `say` VALUES ('1', '2', 'aaaa', null);
INSERT INTO `say` VALUES ('2', '2', 'bbbb', null);
INSERT INTO `say` VALUES ('3', '2', 'ccccc', null);
INSERT INTO `say` VALUES ('4', '2', 'xxxxx', null);
INSERT INTO `say` VALUES ('5', '2', 'yyyyy', null);
INSERT INTO `say` VALUES ('6', '2', 'zzzzz', null);
