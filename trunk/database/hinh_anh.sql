/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : startupdb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-12 01:40:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `hinh_anh`
-- ----------------------------
DROP TABLE IF EXISTS `hinh_anh`;
CREATE TABLE `hinh_anh` (
  `HINH_ANH_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `BDS_NEWS_ID` int(11) NOT NULL,
  `HINH_ANH_PATH` varchar(200) NOT NULL,
  `AVATA_FLG` tinyint(1) DEFAULT NULL,
  `DELETE_YMD` date DEFAULT NULL,
  `PUBLIC_FLG` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`BDS_NEWS_ID`,`HINH_ANH_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hinh_anh
-- ----------------------------
INSERT INTO `hinh_anh` VALUES ('1', '3', 'Upload/24312646_2183872841638182_1692877867171057967_n.jpg', null, null, null);
INSERT INTO `hinh_anh` VALUES ('2', '3', 'Upload/24774824_2183872838304849_6040110120461782304_n.jpg', null, null, null);
INSERT INTO `hinh_anh` VALUES ('3', '3', 'Upload/24899836_2183872794971520_7093230609386108418_n.jpg', null, null, null);
INSERT INTO `hinh_anh` VALUES ('1', '9', 'Upload/24774824_2183872838304849_6040110120461782304_n.jpg', null, null, null);
INSERT INTO `hinh_anh` VALUES ('2', '9', 'Upload/24899836_2183872794971520_7093230609386108418_n.jpg', null, null, null);
INSERT INTO `hinh_anh` VALUES ('3', '9', 'Upload/24312646_2183872841638182_1692877867171057967_n.jpg', null, null, null);
