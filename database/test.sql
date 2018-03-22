/*
Navicat MySQL Data Transfer

Source Server         : 本机
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-03-22 16:41:36
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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES ('1', 'aaa', '23', '12345678901', '北京市测试地址', '98', '3-1', '这个只是一个测试信息');
INSERT INTO `member` VALUES ('2', 'ccc', '23', '12345678901', '北京市测试地址', '86', '3-2', '这个只是一个测试信息11111');
INSERT INTO `member` VALUES ('6', 'ddd', '33', '09876533122', 'ceshi', '87', '3-2', 'hahah');
INSERT INTO `member` VALUES ('7', 'eee', '23', '1111111111', 'dccdc', '65', '3-3', 'fffff');
INSERT INTO `member` VALUES ('8', 'zlhkk', '45', '9999999999', 'testkkkkkkkk', '90', '3-5', 'hahahahaha');
INSERT INTO `member` VALUES ('12', 'zlhppppp', '45', '9999999999', 'testkkkkkkkk', '90', '3-5', 'hahahahaha');
INSERT INTO `member` VALUES ('13', 'zlhxxxxx', '45', '9999999999', 'testkkkkkkkk', '90', '3-5', 'hahahahaha');
INSERT INTO `member` VALUES ('14', 'zlhzzzzz', '45', '9999999999', 'testkkkkkkkk', '90', '3-5', 'hahahahaha');

-- ----------------------------
-- Table structure for `m_pwd`
-- ----------------------------
DROP TABLE IF EXISTS `m_pwd`;
CREATE TABLE `m_pwd` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `m_id` int(11) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of m_pwd
-- ----------------------------
INSERT INTO `m_pwd` VALUES ('1', '1', '111111');
INSERT INTO `m_pwd` VALUES ('2', '2', '222222');
INSERT INTO `m_pwd` VALUES ('4', '6', '666666');
