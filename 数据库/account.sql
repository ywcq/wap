/*
Navicat MySQL Data Transfer

Source Server         : 11
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : account

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2021-11-03 02:21:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for guest
-- ----------------------------
DROP TABLE IF EXISTS `guest`;
CREATE TABLE `guest` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pt_id` char(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `machine_id` char(15) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `login_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of guest
-- ----------------------------

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pt_id` char(30) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `servername` char(15) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of login
-- ----------------------------

-- ----------------------------
-- Table structure for normal
-- ----------------------------
DROP TABLE IF EXISTS `normal`;
CREATE TABLE `normal` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pt_id` char(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `uid` char(10) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `password` char(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `safecode` char(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `login_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `agent` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fenghao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of normal
-- ----------------------------

-- ----------------------------
-- Table structure for ticket
-- ----------------------------
DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pt_id` char(20) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT '',
  `ticket` char(50) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `create_time` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=427 DEFAULT CHARSET=latin1 ROW_FORMAT=FIXED;

-- ----------------------------
-- Records of ticket
-- ----------------------------
