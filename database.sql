/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : ci

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2013-02-27 00:19:50
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `ci_auth_users`
-- ----------------------------
DROP TABLE IF EXISTS `ci_auth_users`;
CREATE TABLE `ci_auth_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `activation` varchar(40) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ci_auth_users
-- ----------------------------

-- ----------------------------
-- Table structure for `ci_blog`
-- ----------------------------
DROP TABLE IF EXISTS `ci_blog`;
CREATE TABLE `ci_blog` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `body` text,
  `datetime` datetime DEFAULT NULL,
  `author` varchar(300) DEFAULT NULL,
  `userid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ci_blog
-- ----------------------------
