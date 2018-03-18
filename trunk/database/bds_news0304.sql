/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : startupdb

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-04 03:07:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bds_news`
-- ----------------------------
DROP TABLE IF EXISTS `bds_news`;
CREATE TABLE `bds_news` (
  `BDSNEWS_ID` int(11) NOT NULL,
  `USER_ID` varchar(50) NOT NULL,
  `DANH_DAU_CODE` varchar(50) DEFAULT NULL,
  `REMOVE_BDS_FLG` tinyint(1) DEFAULT NULL COMMENT 'Loại khỏi định giá',
  `TINH_TRANG_CODE` varchar(50) DEFAULT NULL,
  `BY_GROUP` tinyint(1) DEFAULT NULL COMMENT 'Được bán bởi Group',
  `BDS_NOTE` varchar(2000) DEFAULT NULL,
  `DIEN_THOAI` varchar(100) DEFAULT NULL,
  `HINH_ANH_PATH` varchar(200) DEFAULT NULL,
  `YOUTUBE_ID` varchar(200) DEFAULT NULL,
  `HINH_ANH_ID` int(11) DEFAULT NULL,
  `TYPE_NEWS_CODE` varchar(50) NOT NULL,
  `TIN_DANG_ID_PUBLISHED` int(4) DEFAULT NULL,
  `PUBLISHED_DAY_LIST_CODE` varchar(50) DEFAULT NULL,
  `GROUP_CODE` varchar(50) NOT NULL,
  `BDS_GIA_RE` tinyint(1) DEFAULT NULL,
  `BDS_GIA_RE_DAY_LIST_CODE` varchar(50) DEFAULT NULL,
  `BDS_GIA_RE_BAT_DAU` date DEFAULT NULL,
  `LOAI_BDS_CODE` varchar(50) NOT NULL,
  `BDS_DANG` tinyint(1) DEFAULT NULL,
  `TIN_VIP_CODE` varchar(50) DEFAULT NULL,
  `TIN_VIP_DAY_LIST_CODE` varchar(50) DEFAULT NULL,
  `TIN_VIP_BAT_DAU` date DEFAULT NULL,
  `PROVINCE_CODE` varchar(50) DEFAULT NULL,
  `DISTRICT_CODE` varchar(50) DEFAULT NULL,
  `WARD_CODE` varchar(50) DEFAULT NULL,
  `WARD_OTHER` int(11) DEFAULT NULL,
  `STREET_CODE` varchar(50) DEFAULT NULL,
  `STREET_OTHER` int(11) DEFAULT NULL,
  `SO_NHA` varchar(100) DEFAULT NULL,
  `PUBLISH_ADDRESS` tinyint(2) DEFAULT NULL,
  `PHAP_LY_CODE` varchar(50) DEFAULT NULL,
  `HUONG_CODE` varchar(50) DEFAULT NULL,
  `VI_TRI_CODE` varchar(50) DEFAULT NULL,
  `KHOAN_CACH_DUONG_CHINH` int(11) DEFAULT NULL,
  `SO_LUONG_HEM` int(9) DEFAULT NULL,
  `DIEN_TICH_HEM_DAU` float DEFAULT NULL,
  `DIEN_TICH` float DEFAULT NULL,
  `DIEN_TICH_RONG` float DEFAULT NULL,
  `DIEN_TICH_DAI` float DEFAULT NULL,
  `DIEN_TICH_HAU` float DEFAULT NULL,
  `DIEN_TICH_QH` float DEFAULT NULL,
  `DIEN_TICH_QH_RONG` float DEFAULT NULL,
  `DIEN_TICH_QH_DAI` float DEFAULT NULL,
  `DIEN_TICH_QH_HAU` float DEFAULT NULL,
  `DIEN_TICH_QH_CONG_NHAN` float DEFAULT NULL,
  `DIEN_TICH_XAY` float DEFAULT NULL,
  `DIEN_TICH_SAN` float DEFAULT NULL,
  `SO_TANG_CODE` varchar(50) DEFAULT NULL,
  `SO_PHONG_NGU` int(4) DEFAULT NULL,
  `SO_PHONG_TOLET` int(4) DEFAULT NULL,
  `LOAI_CONG_TRINH_CODE` int(4) DEFAULT NULL,
  `MUC_XAY_CODE` varchar(50) DEFAULT NULL,
  `CHAT_LUONG_NHA` float DEFAULT NULL,
  `DIEM_TOT_ID` int(11) DEFAULT NULL,
  `DIEM_XAU_ID` int(11) DEFAULT NULL,
  `TEN_DIEN_THOAI` varchar(200) DEFAULT NULL,
  `TEN_LIEN_HE` varchar(200) DEFAULT NULL,
  `DIA_CHI_LIEN_HE` varchar(200) DEFAULT NULL,
  `EMAIL_LIEN_HE` varchar(200) DEFAULT NULL,
  `TIN_CHINH_CHU` tinyint(1) DEFAULT NULL,
  `MIEN_TRUNG_GIAN` tinyint(1) DEFAULT NULL,
  `BDS_PHAT_MAI` tinyint(1) DEFAULT NULL,
  `LIEN_HE_DOC_QUYEN` varchar(500) DEFAULT NULL,
  `THUONG_LUONG` tinyint(1) DEFAULT NULL,
  `GIA_RAO` double NOT NULL,
  `DON_VI_TIEN_ID` int(4) DEFAULT '1',
  `DON_VI_DO` int(4) DEFAULT '1',
  `HINH_DANG` varchar(200) DEFAULT NULL,
  `MAT_TIEP_GIAP` int(4) DEFAULT NULL,
  `MOI_TRUONG_SONG` varchar(500) DEFAULT NULL,
  `HA_TANG` varchar(500) DEFAULT NULL,
  `DON_GIA_DAT` double DEFAULT NULL,
  `DON_GIA_XAY` double DEFAULT NULL,
  `GIA_DU_KIEN` double DEFAULT NULL,
  `TITLE` varchar(500) DEFAULT NULL,
  `META_KEYWORDS` varchar(500) DEFAULT NULL,
  `SHARE_FACEBOOK` tinyint(1) DEFAULT NULL,
  `USER_CREATE` int(11) DEFAULT NULL,
  `CREATE_YMD` date DEFAULT NULL,
  `USER_UPDATE` int(11) DEFAULT NULL,
  `UPDATE_YMD` date DEFAULT NULL,
  `DELETE_YMD` date DEFAULT NULL,
  PRIMARY KEY (`BDSNEWS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bds_news
-- ----------------------------
INSERT INTO `bds_news` VALUES ('1', '2', 'deal-very-good', '0', 'st-selling', '0', 'Nhà thấy oke đó', '0903064655', null, null, null, 'ad-selling', '1', 'Day60', 'gp-house', '1', 'Day30', '2018-03-04', '', '1', '', 'Day90', '2018-03-05', '249', '313', '1000', null, null, null, '58', '1', '143053', 'd-north', 'h-front', '0', '0', '0', '100', '9', '11', '10', '10', '10', '1', '10', '90', '90', '180', '2', '2', '3', '274705', '38', '90', '1', '1', 'ngan, 0911112222', 'Ngân', 'Ngân 60 Hai Bà Trưng', 'ngan@gmail.com', '1', '1', '0', '1', '1', '9', '1', '1', 'Vuông', '1', '1', '1', '500', '5', '9', '9 Tỉ', 'Nhà bán 9 tỷ quận 1', null, '1', '2018-03-04', '1', '2018-03-04', null);
