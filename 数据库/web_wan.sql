/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 40111
Source Host           : localhost:3306
Source Database       : web_wan

Target Server Type    : MYSQL
Target Server Version : 40111
File Encoding         : 20936

Date: 2020-02-10 12:12:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `codepay_jie`
-- ----------------------------
DROP TABLE IF EXISTS `codepay_jie`;
CREATE TABLE `codepay_jie` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(255) default NULL,
  `zong` varchar(255) default '0',
  `vip` varchar(255) default NULL,
  `time` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of codepay_jie
-- ----------------------------

-- ----------------------------
-- Table structure for `codepay_order`
-- ----------------------------
DROP TABLE IF EXISTS `codepay_order`;
CREATE TABLE `codepay_order` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `pay_id` varchar(50) NOT NULL default '',
  `money` decimal(6,2) unsigned NOT NULL default '0.00',
  `pay_no` varchar(100) NOT NULL default '',
  `param` varchar(200) default NULL,
  `pay_tag` varchar(100) NOT NULL default '0',
  `status` varchar(255) NOT NULL default '0',
  `up_time` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `uid` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='1';

-- ----------------------------
-- Records of codepay_order
-- ----------------------------

-- ----------------------------
-- Table structure for `codepay_user`
-- ----------------------------
DROP TABLE IF EXISTS `codepay_user`;
CREATE TABLE `codepay_user` (
  `id` int(10) NOT NULL auto_increment,
  `user` varchar(100) NOT NULL default '',
  `money` varchar(255) NOT NULL default '0.00',
  `vip` int(1) NOT NULL default '0',
  `status` int(1) NOT NULL default '0',
  `pass` varchar(255) default NULL,
  `pay` varchar(255) default NULL,
  `name` varchar(255) default NULL,
  `qq` varchar(255) default NULL,
  `zf` varchar(255) default NULL,
  `group` varchar(255) default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of codepay_user
-- ----------------------------
INSERT INTO `codepay_user` VALUES ('1', 'admin', '0.00', '100', '0', 'admin', '123456@qq.com', 'admin', '123456', null, 'admin');

-- ----------------------------
-- Table structure for `codepay_zong`
-- ----------------------------
DROP TABLE IF EXISTS `codepay_zong`;
CREATE TABLE `codepay_zong` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(255) default NULL,
  `jin` varchar(255) default '0',
  `vip` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of codepay_zong
-- ----------------------------
INSERT INTO `codepay_zong` VALUES ('1', 'admin', '0', '100');
