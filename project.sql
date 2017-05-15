/*
Navicat MySQL Data Transfer

Source Server         : BD
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : project

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-05-14 03:00:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `typeactivite`
-- ----------------------------
DROP TABLE IF EXISTS `typeactivite`;
CREATE TABLE `typeactivite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomactivite` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=ascii;

-- ----------------------------
-- Records of typeactivite
-- ----------------------------
INSERT INTO `typeactivite` VALUES ('1', 'Type 1');
INSERT INTO `typeactivite` VALUES ('2', 'Type 2');
INSERT INTO `typeactivite` VALUES ('3', 'Type 3');
INSERT INTO `typeactivite` VALUES ('4', 'Type 4');
INSERT INTO `typeactivite` VALUES ('5', 'Type 5');
