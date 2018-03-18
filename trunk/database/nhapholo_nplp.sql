/*
Navicat MySQL Data Transfer

Source Server         : nhapholocphat.com
Source Server Version : 50505
Source Host           : 103.243.174.10:3306
Source Database       : nhapholo_nplp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-08 04:22:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bds_news`
-- ----------------------------
DROP TABLE IF EXISTS `bds_news`;
CREATE TABLE `bds_news` (
  `BDSNEWS_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `TYPE_NEWS_CODE` varchar(50) DEFAULT NULL,
  `TIN_DANG_ID_PUBLISHED` int(4) DEFAULT NULL,
  `PUBLISHED_DAY_LIST_CODE` varchar(50) DEFAULT NULL,
  `PUBLISHED_BAT_DAU` date DEFAULT NULL,
  `GROUP_CODE` varchar(50) DEFAULT NULL,
  `BDS_GIA_RE` tinyint(1) DEFAULT NULL,
  `BDS_GIA_RE_DAY_LIST_CODE` varchar(50) DEFAULT NULL,
  `BDS_GIA_RE_BAT_DAU` date DEFAULT NULL,
  `LOAI_BDS_CODE` varchar(50) DEFAULT NULL,
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
  `CO_HAM` tinyint(1) DEFAULT NULL,
  `CO_LUNG` tinyint(1) DEFAULT NULL,
  `CO_SAN_THUONG` tinyint(1) DEFAULT NULL,
  `CO_GARA_OTO` tinyint(1) DEFAULT NULL,
  `CO_THANG_MAY` tinyint(1) DEFAULT NULL,
  `CO_HO_BOI` tinyint(1) DEFAULT NULL,
  `DIEM_TOT_ID` int(11) DEFAULT NULL,
  `DIEM_XAU_ID` int(11) DEFAULT NULL,
  `TEN_DIEN_THOAI` varchar(200) DEFAULT NULL,
  `CHO_HIEN_TEN_DIEN_THOAI` tinyint(1) DEFAULT NULL,
  `TEN_LIEN_HE` varchar(200) DEFAULT NULL,
  `DIA_CHI_LIEN_HE` varchar(200) DEFAULT NULL,
  `EMAIL_LIEN_HE` varchar(200) DEFAULT NULL,
  `TIN_CHINH_CHU` tinyint(1) DEFAULT NULL,
  `MIEN_TRUNG_GIAN` tinyint(1) DEFAULT NULL,
  `BDS_PHAT_MAI` tinyint(1) DEFAULT NULL,
  `LIEN_HE_DOC_QUYEN` varchar(500) DEFAULT NULL,
  `THUONG_LUONG` tinyint(1) DEFAULT NULL,
  `GIA_RAO` double DEFAULT NULL,
  `LOAI_TIEN_CODE` varchar(50) DEFAULT '1',
  `DON_VI_DO_CODE` varchar(50) DEFAULT '1',
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bds_news
-- ----------------------------
INSERT INTO `bds_news` VALUES ('1', 'admin', 'deal-very-good', '0', 'st-selling', '0', 'Nhà thấy oke đó', '0903064655', null, null, null, 'ad-selling', '1', 'Day60', null, 'gp-house', '1', 'Day30', '2018-03-04', 'nha_dat', '1', 'VIP2', 'Day90', '2018-03-05', '249', '313', '1000', null, '4673', null, '58', '1', '143053', 'd-north', 'h-front', '4', '0', '0', '100', '9', '11', '10', '10', '10', '1', '10', '90', '90', '180', '2', '2', '3', '274705', '38', '90', null, '1', null, '1', null, null, '1', '1', 'ngan, 0911112222', null, 'Ngân', 'Ngân 60 Hai Bà Trưng', 'ngan@gmail.com', '1', '1', '0', 'Chỉ mình Vũ giới thiệu mới dc', '1', '9.56', 'pm-vnd-b', 'unit-m2', 'Vuông', '1', '1', '1', '500', '5', '9.5', '9 Tỉ', 'Nhà bán 9 tỷ quận 1', null, '1', '2018-03-04', '1', '2018-03-04', null);

-- ----------------------------
-- Table structure for `common`
-- ----------------------------
DROP TABLE IF EXISTS `common`;
CREATE TABLE `common` (
  `COMMON_ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMMON_KEY` varchar(50) NOT NULL,
  `COMMON_VALUE` varchar(100) NOT NULL,
  `COMMON_NOTE` varchar(500) DEFAULT NULL,
  `DELETE_YMD` date DEFAULT NULL,
  PRIMARY KEY (`COMMON_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of common
-- ----------------------------
INSERT INTO `common` VALUES ('1', 'HAI_MAT_DUONG', '15', null, null);
INSERT INTO `common` VALUES ('2', 'HEM_BEN_HONG', '7', null, null);
INSERT INTO `common` VALUES ('3', 'HEM_SAU_NHA', '6', null, null);
INSERT INTO `common` VALUES ('4', 'GAN_CHO_SIEU_THI', '2', null, null);
INSERT INTO `common` VALUES ('5', 'GAN_CONG_VIEN_MALL', '2', null, null);
INSERT INTO `common` VALUES ('6', 'VI_TRI_DEP', '5', null, null);
INSERT INTO `common` VALUES ('7', 'TIEN_MO_QUAN', '2', null, null);
INSERT INTO `common` VALUES ('8', 'HEM_THONG', '5', 'Hẻm thông', null);
INSERT INTO `common` VALUES ('11', 'DUONG_DAM_VAO_NHA', '-20', null, null);
INSERT INTO `common` VALUES ('12', 'GAN_CHUA_NHA_THO', '-15', null, null);
INSERT INTO `common` VALUES ('13', 'GAN_NHA_TANG_LE', '-20', null, null);
INSERT INTO `common` VALUES ('14', 'CHAN_CAU_CAO_THE', '-30', null, null);
INSERT INTO `common` VALUES ('15', 'CONG_TRUOC_NHA', '-5', 'Cống', null);
INSERT INTO `common` VALUES ('16', 'TRU_DIEN_TRUOC_NHA', '-5', null, null);
INSERT INTO `common` VALUES ('17', 'CAY_LON_TRUOC_NHA', '-5', null, null);
INSERT INTO `common` VALUES ('18', 'KHONG_THE_XAY_MOI', '-10', null, null);
INSERT INTO `common` VALUES ('19', 'QUY_HOACH_TREO', '-30', null, null);
INSERT INTO `common` VALUES ('22', 'CONG_BAO_VE', '5', null, null);

-- ----------------------------
-- Table structure for `danh_dau`
-- ----------------------------
DROP TABLE IF EXISTS `danh_dau`;
CREATE TABLE `danh_dau` (
  `DANH_DAU_ID` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `DANH_DAU_CODE` varchar(50) NOT NULL,
  `DANH_DAU_NAME` varchar(50) NOT NULL,
  `DELETE_YMD` date DEFAULT NULL,
  PRIMARY KEY (`DANH_DAU_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of danh_dau
-- ----------------------------
INSERT INTO `danh_dau` VALUES ('1', 'deal-good', 'Nhà rẻ', null);
INSERT INTO `danh_dau` VALUES ('2', 'deal-very-good', 'Nhà rất rẻ', null);
INSERT INTO `danh_dau` VALUES ('3', 'deal-normal', 'Bình thường', null);
INSERT INTO `danh_dau` VALUES ('4', 'deal-unknow', 'Chưa định giá được', null);
INSERT INTO `danh_dau` VALUES ('5', 'deal-bad', 'Nhà giá cao', null);

-- ----------------------------
-- Table structure for `day_list`
-- ----------------------------
DROP TABLE IF EXISTS `day_list`;
CREATE TABLE `day_list` (
  `DAY_LIST_ID` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `DAY_LIST_CODE` varchar(50) NOT NULL,
  `DAY_LIST_NAME` varchar(50) NOT NULL,
  `DELETE_YMD` date DEFAULT NULL,
  PRIMARY KEY (`DAY_LIST_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of day_list
-- ----------------------------
INSERT INTO `day_list` VALUES ('1', 'Day10', '10 ngày', null);
INSERT INTO `day_list` VALUES ('2', 'Day20', '20 ngày', null);
INSERT INTO `day_list` VALUES ('3', 'Day30', '30 ngày', null);
INSERT INTO `day_list` VALUES ('4', 'Day60', '60 ngày', null);
INSERT INTO `day_list` VALUES ('5', 'Day90', '90 ngày', null);
INSERT INTO `day_list` VALUES ('6', 'Day180', '180 ngày', null);

-- ----------------------------
-- Table structure for `diem_tot`
-- ----------------------------
DROP TABLE IF EXISTS `diem_tot`;
CREATE TABLE `diem_tot` (
  `DIEM_TOT_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `HAI_MAT_DUONG` tinyint(1) DEFAULT '0',
  `HEM_BEN_HONG` tinyint(1) DEFAULT '0',
  `HEM_SAU_NHA` tinyint(1) DEFAULT '0',
  `GAN_CHO_SIEU_THI` tinyint(1) DEFAULT '0',
  `GAN_CONG_VIEN_MALL` tinyint(1) DEFAULT '0',
  `CONG_BAO_VE` tinyint(1) DEFAULT '0',
  `VI_TRI_DEP` tinyint(1) DEFAULT '0',
  `TIEN_MO_QUAN` tinyint(1) DEFAULT '0',
  `HEM_THONG` tinyint(1) DEFAULT '0',
  `DIEM_TOT_KHAC` varchar(500) DEFAULT NULL,
  `PHAN_TRAM_TANG` float(10,0) DEFAULT NULL,
  `DELETE_YMD` date DEFAULT NULL,
  PRIMARY KEY (`DIEM_TOT_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of diem_tot
-- ----------------------------
INSERT INTO `diem_tot` VALUES ('1', '1', '0', '1', '0', '0', '1', '1', '0', '0', 'Ngôi nhà phù hợp trung lưu', '58', null);

-- ----------------------------
-- Table structure for `diem_xau`
-- ----------------------------
DROP TABLE IF EXISTS `diem_xau`;
CREATE TABLE `diem_xau` (
  `DIEM_XAU_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `DUONG_DAM_VAO_NHA` tinyint(1) DEFAULT '0',
  `GAN_CHUA_NHA_THO` tinyint(1) DEFAULT '0',
  `GAN_NHA_TANG_LE` tinyint(1) DEFAULT '0',
  `CHAN_CAU_CAO_THE` tinyint(1) DEFAULT '0' COMMENT 'Dưới chân cầu hoặc dưới đường dây điện cao thế (-30%)',
  `CONG_TRUOC_NHA` tinyint(1) DEFAULT '0' COMMENT 'Cổng trước nhà',
  `TRU_DIEN_TRUOC_NHA` tinyint(1) DEFAULT '0',
  `CAY_LON_TRUOC_NHA` tinyint(1) DEFAULT '0',
  `KHONG_THE_XAY_MOI` tinyint(1) DEFAULT '0',
  `QUY_HOACH_TREO` tinyint(1) DEFAULT '0',
  `DIEM_XAU_KHAC` varchar(500) DEFAULT NULL,
  `PHAN_TRAM_GIAM` float(10,0) DEFAULT NULL,
  `DELETE_YMD` date DEFAULT NULL,
  PRIMARY KEY (`DIEM_XAU_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of diem_xau
-- ----------------------------
INSERT INTO `diem_xau` VALUES ('1', '0', '0', '0', '0', '1', '0', '1', '0', '0', null, null, null);

-- ----------------------------
-- Table structure for `district`
-- ----------------------------
DROP TABLE IF EXISTS `district`;
CREATE TABLE `district` (
  `DISTRICT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DISTRICT_CODE` int(11) NOT NULL,
  `DISTRICT_NAME` varchar(100) NOT NULL,
  `PROVINCE_CODE` int(11) NOT NULL,
  `DISTRICT_STATUS` tinyint(1) NOT NULL,
  PRIMARY KEY (`DISTRICT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=698 DEFAULT CHARSET=utf16;

-- ----------------------------
-- Records of district
-- ----------------------------
INSERT INTO `district` VALUES ('1', '313', 'Quận 1', '249', '1');
INSERT INTO `district` VALUES ('2', '314', 'Quận 2', '249', '1');
INSERT INTO `district` VALUES ('3', '315', 'Quận 3', '249', '1');
INSERT INTO `district` VALUES ('4', '316', 'Quận 4', '249', '1');
INSERT INTO `district` VALUES ('5', '317', 'Quận 5', '249', '1');
INSERT INTO `district` VALUES ('6', '318', 'Quận 6', '249', '1');
INSERT INTO `district` VALUES ('7', '319', 'Quận 7', '249', '1');
INSERT INTO `district` VALUES ('8', '320', 'Quận 8', '249', '1');
INSERT INTO `district` VALUES ('9', '321', 'Quận 9', '249', '1');
INSERT INTO `district` VALUES ('10', '322', 'Quận 10', '249', '1');
INSERT INTO `district` VALUES ('11', '323', 'Quận 11', '249', '1');
INSERT INTO `district` VALUES ('12', '324', 'Quận 12', '249', '1');
INSERT INTO `district` VALUES ('13', '325', 'Quận Bình Tân', '249', '1');
INSERT INTO `district` VALUES ('14', '326', 'Quận Bình Thạnh', '249', '1');
INSERT INTO `district` VALUES ('15', '327', 'Quận Gò Vấp', '249', '1');
INSERT INTO `district` VALUES ('16', '328', 'Quận Phú Nhuận', '249', '1');
INSERT INTO `district` VALUES ('17', '329', 'Quận Tân Bình', '249', '1');
INSERT INTO `district` VALUES ('18', '330', 'Quận Tân Phú', '249', '1');
INSERT INTO `district` VALUES ('19', '331', 'Quận Thủ Đức', '249', '1');
INSERT INTO `district` VALUES ('20', '332', 'Huyện Bình Chánh', '249', '1');
INSERT INTO `district` VALUES ('21', '333', 'Huyện Cần Giờ', '249', '1');
INSERT INTO `district` VALUES ('22', '334', 'Huyện Củ Chi', '249', '1');
INSERT INTO `district` VALUES ('23', '335', 'Huyện Hóc Môn', '249', '1');
INSERT INTO `district` VALUES ('24', '336', 'Huyện Nhà Bè', '249', '1');
INSERT INTO `district` VALUES ('25', '337', 'Quận Ba Đình', '250', '1');
INSERT INTO `district` VALUES ('26', '338', 'Huyện Ba Vì', '250', '1');
INSERT INTO `district` VALUES ('27', '339', 'Quận Cầu Giấy', '250', '1');
INSERT INTO `district` VALUES ('28', '340', 'Huyện Chương Mỹ', '250', '1');
INSERT INTO `district` VALUES ('29', '341', 'Huyện Đan Phượng', '250', '1');
INSERT INTO `district` VALUES ('30', '342', 'Huyện Đông Anh', '250', '1');
INSERT INTO `district` VALUES ('31', '343', 'Quận Đống Đa', '250', '1');
INSERT INTO `district` VALUES ('32', '344', 'Huyện Gia Lâm', '250', '1');
INSERT INTO `district` VALUES ('33', '345', 'Quận Hà Đông', '250', '1');
INSERT INTO `district` VALUES ('34', '346', 'Quận Hai Bà Trưng', '250', '1');
INSERT INTO `district` VALUES ('35', '347', 'Huyện Hoài Đức', '250', '1');
INSERT INTO `district` VALUES ('36', '348', 'Quận Hoàn Kiếm', '250', '1');
INSERT INTO `district` VALUES ('37', '349', 'Quận Hoàng Mai', '250', '1');
INSERT INTO `district` VALUES ('38', '350', 'Quận Long Biên', '250', '1');
INSERT INTO `district` VALUES ('39', '351', 'Huyện Mê Linh', '250', '1');
INSERT INTO `district` VALUES ('40', '352', 'Huyện Mỹ Đức', '250', '1');
INSERT INTO `district` VALUES ('41', '353', 'Huyện Phú Xuyên', '250', '1');
INSERT INTO `district` VALUES ('42', '354', 'Huyện Phúc Thọ', '250', '1');
INSERT INTO `district` VALUES ('43', '355', 'Huyện Quốc Oai', '250', '1');
INSERT INTO `district` VALUES ('44', '356', 'Huyện Sóc Sơn', '250', '1');
INSERT INTO `district` VALUES ('45', '357', 'Thị Xã Sơn Tây', '250', '1');
INSERT INTO `district` VALUES ('46', '358', 'Quận Tây Hồ', '250', '1');
INSERT INTO `district` VALUES ('47', '359', 'Huyện Thạch Thất', '250', '1');
INSERT INTO `district` VALUES ('48', '360', 'Huyện Thanh Oai', '250', '1');
INSERT INTO `district` VALUES ('49', '361', 'Huyện Thanh Trì.', '250', '1');
INSERT INTO `district` VALUES ('50', '362', 'Thanh Xuân', '250', '1');
INSERT INTO `district` VALUES ('51', '363', 'Huyện Thường Tín', '250', '1');
INSERT INTO `district` VALUES ('52', '364', 'Quận Từ Liêm', '250', '1');
INSERT INTO `district` VALUES ('53', '365', 'Huyện Ứng Hòa', '250', '1');
INSERT INTO `district` VALUES ('54', '366', 'Quận Vân Điền', '250', '1');
INSERT INTO `district` VALUES ('55', '367', 'Quận Cẩm Lệ', '251', '1');
INSERT INTO `district` VALUES ('56', '368', 'Quận Hải Châu', '251', '1');
INSERT INTO `district` VALUES ('57', '369', 'Quận Liên Chiểu', '251', '1');
INSERT INTO `district` VALUES ('58', '370', 'Quận Ngũ Hành Sơn', '251', '1');
INSERT INTO `district` VALUES ('59', '371', 'Quận Sơn Trà', '251', '1');
INSERT INTO `district` VALUES ('60', '372', 'Quận Thanh Khê', '251', '1');
INSERT INTO `district` VALUES ('61', '373', 'Huyện Hòa Vang', '251', '1');
INSERT INTO `district` VALUES ('62', '374', 'Huyện đảo Hoàng Sa', '251', '1');
INSERT INTO `district` VALUES ('63', '375', 'TP Yên Bái', '252', '1');
INSERT INTO `district` VALUES ('64', '376', 'Huyện Lục Yên', '252', '1');
INSERT INTO `district` VALUES ('65', '377', 'Huyện Mù Cang Chải', '252', '1');
INSERT INTO `district` VALUES ('66', '378', 'Huyện Trấn Yên', '252', '1');
INSERT INTO `district` VALUES ('67', '379', 'Huyện Trạm Tấu', '252', '1');
INSERT INTO `district` VALUES ('68', '380', 'Huyện Văn Chấn', '252', '1');
INSERT INTO `district` VALUES ('69', '381', 'Huyện Văn Yên', '252', '1');
INSERT INTO `district` VALUES ('70', '382', 'Huyện Yên Bình', '252', '1');
INSERT INTO `district` VALUES ('71', '383', 'Thành Phố Vĩnh Yên', '253', '1');
INSERT INTO `district` VALUES ('72', '384', 'Thị Xã Phúc Yên', '253', '1');
INSERT INTO `district` VALUES ('73', '385', 'Huyện Bình Xuyên', '253', '1');
INSERT INTO `district` VALUES ('74', '386', 'Huyện Lập Thạch', '253', '1');
INSERT INTO `district` VALUES ('75', '387', 'Huyện Sông Lô', '253', '1');
INSERT INTO `district` VALUES ('76', '388', 'Huyện Tam Dương', '253', '1');
INSERT INTO `district` VALUES ('77', '389', 'Huyện Tam Đảo', '253', '1');
INSERT INTO `district` VALUES ('78', '390', 'Huyện Vĩnh Tường', '253', '1');
INSERT INTO `district` VALUES ('79', '391', 'Huyện Yên Lạc', '253', '1');
INSERT INTO `district` VALUES ('80', '392', 'Thành Phố Vĩnh Long', '254', '1');
INSERT INTO `district` VALUES ('81', '393', 'Huyện Bình Minh', '254', '1');
INSERT INTO `district` VALUES ('82', '394', 'Huyện Bình Tân', '254', '1');
INSERT INTO `district` VALUES ('83', '395', 'Huyện Long Hồ', '254', '1');
INSERT INTO `district` VALUES ('84', '396', 'Huyện Mang Thít', '254', '1');
INSERT INTO `district` VALUES ('85', '397', 'Huyện Tam Bình', '254', '1');
INSERT INTO `district` VALUES ('86', '398', 'Huyện Trà Ôn', '254', '1');
INSERT INTO `district` VALUES ('87', '399', 'Huyện Vũng Liêm', '254', '1');
INSERT INTO `district` VALUES ('88', '400', 'Thành Phố Tuyên Quang', '255', '1');
INSERT INTO `district` VALUES ('89', '401', 'Huyện Chiêm Hóa', '255', '1');
INSERT INTO `district` VALUES ('90', '402', 'Huyện Hàm Yên', '255', '1');
INSERT INTO `district` VALUES ('91', '403', 'Huyện Na Hang', '255', '1');
INSERT INTO `district` VALUES ('92', '404', 'Huyện Sơn Dương', '255', '1');
INSERT INTO `district` VALUES ('93', '405', 'Huyện Yên Sơn', '255', '1');
INSERT INTO `district` VALUES ('94', '406', 'Huyện Lâm Bình', '255', '1');
INSERT INTO `district` VALUES ('95', '407', 'Thành Phố Trà Vinh', '256', '1');
INSERT INTO `district` VALUES ('96', '408', 'Huyện Càng Long', '256', '1');
INSERT INTO `district` VALUES ('97', '409', 'Huyện Cầu Kè', '256', '1');
INSERT INTO `district` VALUES ('98', '410', 'Huyện Tiểu Cần', '256', '1');
INSERT INTO `district` VALUES ('99', '411', 'Huyện Châu Thành', '256', '1');
INSERT INTO `district` VALUES ('100', '412', 'Huyện Cầu Ngang', '256', '1');
INSERT INTO `district` VALUES ('101', '413', 'Huyện Trà Cú', '256', '1');
INSERT INTO `district` VALUES ('102', '414', 'Huyện Duyên Hải', '256', '1');
INSERT INTO `district` VALUES ('103', '415', 'Thành Phố Mỹ Tho', '257', '1');
INSERT INTO `district` VALUES ('104', '416', 'TX Gò Công', '257', '1');
INSERT INTO `district` VALUES ('105', '417', 'Huyện Cái Bè', '257', '1');
INSERT INTO `district` VALUES ('106', '418', 'Huyện Cai Lậy', '257', '1');
INSERT INTO `district` VALUES ('107', '419', 'Huyện Châu Thành', '257', '1');
INSERT INTO `district` VALUES ('108', '420', 'Huyện Chợ Gạo', '257', '1');
INSERT INTO `district` VALUES ('109', '421', 'Huyện Gò Công Tây', '257', '1');
INSERT INTO `district` VALUES ('110', '422', 'Huyện Gò Công Đông', '257', '1');
INSERT INTO `district` VALUES ('111', '423', 'Huyện Tân Phước', '257', '1');
INSERT INTO `district` VALUES ('112', '424', 'Huyện Tân Phú Đông', '257', '1');
INSERT INTO `district` VALUES ('113', '425', 'TP Huế', '258', '1');
INSERT INTO `district` VALUES ('114', '426', 'Huyện Phong Điền', '258', '1');
INSERT INTO `district` VALUES ('115', '427', 'Huyện Quảng Điền', '258', '1');
INSERT INTO `district` VALUES ('116', '428', 'Hương Trà', '258', '1');
INSERT INTO `district` VALUES ('117', '429', 'Huyện Phú Vang', '258', '1');
INSERT INTO `district` VALUES ('118', '430', 'Huyện Hương Thủy', '258', '1');
INSERT INTO `district` VALUES ('119', '431', 'Huyện Phú Lộc', '258', '1');
INSERT INTO `district` VALUES ('120', '432', 'Huyện Nam Đông', '258', '1');
INSERT INTO `district` VALUES ('121', '433', 'Huyện A Lưới', '258', '1');
INSERT INTO `district` VALUES ('122', '434', 'TP Thanh Hóa', '259', '1');
INSERT INTO `district` VALUES ('123', '435', 'TX Bỉm Sơn', '259', '1');
INSERT INTO `district` VALUES ('124', '436', 'TX Sầm Sơn', '259', '1');
INSERT INTO `district` VALUES ('125', '437', 'Huyện Quan Hóa', '259', '1');
INSERT INTO `district` VALUES ('126', '438', 'Huyện Quan Sơn', '259', '1');
INSERT INTO `district` VALUES ('127', '439', 'Huyện Mường Lát', '259', '1');
INSERT INTO `district` VALUES ('128', '440', 'Huyện Bá Thước', '259', '1');
INSERT INTO `district` VALUES ('129', '441', 'Huyện Thường Xuân', '259', '1');
INSERT INTO `district` VALUES ('130', '442', 'Huyện Như Xuân', '259', '1');
INSERT INTO `district` VALUES ('131', '443', 'Huyện Như Thanh', '259', '1');
INSERT INTO `district` VALUES ('132', '444', 'Huyện Lang Chánh', '259', '1');
INSERT INTO `district` VALUES ('133', '445', 'Huyện Ngọc Lặc', '259', '1');
INSERT INTO `district` VALUES ('134', '446', 'Huyện Thạch Thành', '259', '1');
INSERT INTO `district` VALUES ('135', '447', 'Huyện Cẩm Thủy', '259', '1');
INSERT INTO `district` VALUES ('136', '448', 'Huyện Thọ Xuân', '259', '1');
INSERT INTO `district` VALUES ('137', '449', 'Huyện Vĩnh Lộc', '259', '1');
INSERT INTO `district` VALUES ('138', '450', 'Huyện Thiệu Hóa', '259', '1');
INSERT INTO `district` VALUES ('139', '451', 'Huyện Triệu Sơn', '259', '1');
INSERT INTO `district` VALUES ('140', '452', 'Huyện Nông Cống', '259', '1');
INSERT INTO `district` VALUES ('141', '453', 'Huyện Đông Sơn', '259', '1');
INSERT INTO `district` VALUES ('142', '454', 'Huyện Hà Trung', '259', '1');
INSERT INTO `district` VALUES ('143', '455', 'Huyện Hoằng Hóa', '259', '1');
INSERT INTO `district` VALUES ('144', '456', 'Huyện Nga Sơn', '259', '1');
INSERT INTO `district` VALUES ('145', '457', 'Huyện Hậu Lộc', '259', '1');
INSERT INTO `district` VALUES ('146', '458', 'Huyện Quảng Xương', '259', '1');
INSERT INTO `district` VALUES ('147', '459', 'Huyện Tĩnh Gia', '259', '1');
INSERT INTO `district` VALUES ('148', '460', 'Huyện Yên Định', '259', '1');
INSERT INTO `district` VALUES ('149', '461', 'TP Thái Nguyên', '260', '1');
INSERT INTO `district` VALUES ('150', '462', 'TX Sông Công', '260', '1');
INSERT INTO `district` VALUES ('151', '463', 'Huyện Định Hóa', '260', '1');
INSERT INTO `district` VALUES ('152', '464', 'Huyện Phú Lương', '260', '1');
INSERT INTO `district` VALUES ('153', '465', 'Huyện Võ Nhai', '260', '1');
INSERT INTO `district` VALUES ('154', '466', 'Huyện Đại Từ', '260', '1');
INSERT INTO `district` VALUES ('155', '467', 'Huyện Đồng Hỷ', '260', '1');
INSERT INTO `district` VALUES ('156', '468', 'Huyện Phú Bình', '260', '1');
INSERT INTO `district` VALUES ('157', '469', 'Huyện Phổ Yên', '260', '1');
INSERT INTO `district` VALUES ('158', '470', 'TP Thái Bình', '261', '1');
INSERT INTO `district` VALUES ('159', '471', 'Huyện Quỳnh Phụ', '261', '1');
INSERT INTO `district` VALUES ('160', '472', 'Huyện Hưng Hà', '261', '1');
INSERT INTO `district` VALUES ('161', '473', 'Huyện Đông Hưng', '261', '1');
INSERT INTO `district` VALUES ('162', '474', 'Huyện Vũ Thư', '261', '1');
INSERT INTO `district` VALUES ('163', '475', 'Huyện Kiến Xương', '261', '1');
INSERT INTO `district` VALUES ('164', '476', 'Huyện Tiền Hải', '261', '1');
INSERT INTO `district` VALUES ('165', '477', 'Huyện Thái Thụy', '261', '1');
INSERT INTO `district` VALUES ('166', '478', 'TX Tây Ninh', '262', '1');
INSERT INTO `district` VALUES ('167', '479', 'Huyện Tân Biên', '262', '1');
INSERT INTO `district` VALUES ('168', '480', 'Huyện Tân Châu', '262', '1');
INSERT INTO `district` VALUES ('169', '481', 'Huyện Dương Minh Châu', '262', '1');
INSERT INTO `district` VALUES ('170', '482', 'Huyện Châu Thành', '262', '1');
INSERT INTO `district` VALUES ('171', '483', 'Huyện Hòa Thành', '262', '1');
INSERT INTO `district` VALUES ('172', '484', 'Huyện Bến Cầu', '262', '1');
INSERT INTO `district` VALUES ('173', '485', 'Huyện Gò Dầu', '262', '1');
INSERT INTO `district` VALUES ('174', '486', 'Huyện Trảng Bàng', '262', '1');
INSERT INTO `district` VALUES ('175', '487', 'TX Sơn La', '263', '1');
INSERT INTO `district` VALUES ('176', '488', 'HUyện Quỳnh Nhai', '263', '1');
INSERT INTO `district` VALUES ('177', '489', 'Huyện Mường La', '263', '1');
INSERT INTO `district` VALUES ('178', '490', 'Huyện Thuận Châu', '263', '1');
INSERT INTO `district` VALUES ('179', '491', 'Huyện Bắc Yên', '263', '1');
INSERT INTO `district` VALUES ('180', '492', 'Huyện Phù Yên', '263', '1');
INSERT INTO `district` VALUES ('181', '493', 'Huyện Mai Sơn', '263', '1');
INSERT INTO `district` VALUES ('182', '494', 'Huyện Yên Châu', '263', '1');
INSERT INTO `district` VALUES ('183', '495', 'Huyện Sông Mã', '263', '1');
INSERT INTO `district` VALUES ('184', '496', 'Huyện Mộc Châu', '263', '1');
INSERT INTO `district` VALUES ('185', '497', 'Huyện Sốp Cộp', '263', '1');
INSERT INTO `district` VALUES ('186', '498', 'TP Sóc Trăng', '264', '1');
INSERT INTO `district` VALUES ('187', '499', 'Huyện Kế Sách', '264', '1');
INSERT INTO `district` VALUES ('188', '500', 'Huyện Mỹ Tú', '264', '1');
INSERT INTO `district` VALUES ('189', '501', 'Huyện Mỹ Xuyên', '264', '1');
INSERT INTO `district` VALUES ('190', '502', 'Huyện Thạnh Trị', '264', '1');
INSERT INTO `district` VALUES ('191', '503', 'Huyện Long Phú', '264', '1');
INSERT INTO `district` VALUES ('192', '504', 'Huyện Vĩnh Châu', '264', '1');
INSERT INTO `district` VALUES ('193', '505', 'Huyện Cù Lao Dung', '264', '1');
INSERT INTO `district` VALUES ('194', '506', 'Huyện Ngã Năm', '264', '1');
INSERT INTO `district` VALUES ('195', '507', 'Huyện Châu Thành', '264', '1');
INSERT INTO `district` VALUES ('196', '508', 'Huyện Trần Đề', '264', '1');
INSERT INTO `district` VALUES ('197', '509', 'TX Đông Hà', '265', '1');
INSERT INTO `district` VALUES ('198', '510', 'TX Quảng Trị', '265', '1');
INSERT INTO `district` VALUES ('199', '511', 'Huyện Vĩnh Linh', '265', '1');
INSERT INTO `district` VALUES ('200', '512', 'Huyện Gio Linh', '265', '1');
INSERT INTO `district` VALUES ('201', '513', 'Huyện Cam Lộ', '265', '1');
INSERT INTO `district` VALUES ('202', '514', 'Huyện Triệu Phong', '265', '1');
INSERT INTO `district` VALUES ('203', '515', 'Huyện Hải Lăng', '265', '1');
INSERT INTO `district` VALUES ('204', '516', 'Huyện Hướng Hóa', '265', '1');
INSERT INTO `district` VALUES ('205', '517', 'Huyện Đăk Rông', '265', '1');
INSERT INTO `district` VALUES ('206', '518', 'Huyện đảo Cồn Cỏ', '265', '1');
INSERT INTO `district` VALUES ('207', '519', 'TP Hạ Long', '266', '1');
INSERT INTO `district` VALUES ('208', '520', 'TX Cẩm Phả', '266', '1');
INSERT INTO `district` VALUES ('209', '521', 'TX Uông Bí', '266', '1');
INSERT INTO `district` VALUES ('210', '522', 'TX Móng Cái', '266', '1');
INSERT INTO `district` VALUES ('211', '523', 'Huyện Bình Liêu', '266', '1');
INSERT INTO `district` VALUES ('212', '524', 'Huyện Đầm Hà', '266', '1');
INSERT INTO `district` VALUES ('213', '525', 'Huyện Hải Hà', '266', '1');
INSERT INTO `district` VALUES ('214', '526', 'Huyện Tiên Yên', '266', '1');
INSERT INTO `district` VALUES ('215', '527', 'Huyện Ba Chẽ', '266', '1');
INSERT INTO `district` VALUES ('216', '528', 'Huyện Đông Triều', '266', '1');
INSERT INTO `district` VALUES ('217', '529', 'Huyện Yên Hưng', '266', '1');
INSERT INTO `district` VALUES ('218', '530', 'Huyện Hoành Bồ', '266', '1');
INSERT INTO `district` VALUES ('219', '531', 'Huyện Vân Đồn', '266', '1');
INSERT INTO `district` VALUES ('220', '532', 'Huyện Cô Tô', '266', '1');
INSERT INTO `district` VALUES ('221', '533', 'TP Quãng Ngãi', '267', '1');
INSERT INTO `district` VALUES ('222', '534', 'Huyện Lý Sơn', '267', '1');
INSERT INTO `district` VALUES ('223', '535', 'Huyện Bình Sơn', '267', '1');
INSERT INTO `district` VALUES ('224', '536', 'Huyện Trà Bồng', '267', '1');
INSERT INTO `district` VALUES ('225', '537', 'Huyện Sơn Tịnh', '267', '1');
INSERT INTO `district` VALUES ('226', '538', 'Huyện Sơn Hà', '267', '1');
INSERT INTO `district` VALUES ('227', '539', 'Huyện Tư Nghĩa', '267', '1');
INSERT INTO `district` VALUES ('228', '540', 'Huyện Nghĩa Hành ', '267', '1');
INSERT INTO `district` VALUES ('229', '541', 'Huyện Minh Long', '267', '1');
INSERT INTO `district` VALUES ('230', '542', 'Huyện Mộ Đức', '267', '1');
INSERT INTO `district` VALUES ('231', '543', 'Huyện Đức Phổ', '267', '1');
INSERT INTO `district` VALUES ('232', '544', 'Huyện Ba Tơ', '267', '1');
INSERT INTO `district` VALUES ('233', '545', 'Huyện Sơn Tây', '267', '1');
INSERT INTO `district` VALUES ('234', '546', 'Huyện Tây Trà', '267', '1');
INSERT INTO `district` VALUES ('235', '547', 'TP Tam Kỳ', '268', '1');
INSERT INTO `district` VALUES ('236', '548', 'TX Hội An', '268', '1');
INSERT INTO `district` VALUES ('237', '549', 'Huyện Duy Xuyên', '268', '1');
INSERT INTO `district` VALUES ('238', '550', 'Huyện Điện Bàn', '268', '1');
INSERT INTO `district` VALUES ('239', '551', 'Huyện Đại Lộc', '268', '1');
INSERT INTO `district` VALUES ('240', '552', 'Huyện Quế Sơn', '268', '1');
INSERT INTO `district` VALUES ('241', '553', 'Huyện Hiệp Đức', '268', '1');
INSERT INTO `district` VALUES ('242', '554', 'Huyện Thăng Bình', '268', '1');
INSERT INTO `district` VALUES ('243', '555', 'Huyện Núi Thành', '268', '1');
INSERT INTO `district` VALUES ('244', '556', 'Huyện Tiên Phước', '268', '1');
INSERT INTO `district` VALUES ('245', '557', 'Huyện Bắc Trà My', '268', '1');
INSERT INTO `district` VALUES ('246', '558', 'Huyện Đông Giang', '268', '1');
INSERT INTO `district` VALUES ('247', '559', 'Huyện Nam Giang', '268', '1');
INSERT INTO `district` VALUES ('248', '560', 'Huyện Phước Sơn', '268', '1');
INSERT INTO `district` VALUES ('249', '561', 'Huyện Nam Trà My', '268', '1');
INSERT INTO `district` VALUES ('250', '562', 'Huyện Tây Giang', '268', '1');
INSERT INTO `district` VALUES ('251', '563', 'Huyện Phú Ninh', '268', '1');
INSERT INTO `district` VALUES ('252', '564', 'TP Đồng Hới', '269', '1');
INSERT INTO `district` VALUES ('253', '565', 'Huyện Tuyên Hóa', '269', '1');
INSERT INTO `district` VALUES ('254', '566', 'Huyện Minh Hóa', '269', '1');
INSERT INTO `district` VALUES ('255', '567', 'Huyện Quảng Trạch', '269', '1');
INSERT INTO `district` VALUES ('256', '568', 'Huyện Bố Trạch', '269', '1');
INSERT INTO `district` VALUES ('257', '569', 'Huyện Quảng Ninh', '269', '1');
INSERT INTO `district` VALUES ('258', '570', 'Huyện Lệ Thủy', '269', '1');
INSERT INTO `district` VALUES ('259', '571', 'TX Tuy Hòa', '270', '1');
INSERT INTO `district` VALUES ('260', '572', 'Huyện Đồng Xuân', '270', '1');
INSERT INTO `district` VALUES ('261', '573', 'Huyện Sông Cầu', '270', '1');
INSERT INTO `district` VALUES ('262', '574', 'Huyện Tuy An', '270', '1');
INSERT INTO `district` VALUES ('263', '575', 'Huyện Sơn Hòa', '270', '1');
INSERT INTO `district` VALUES ('264', '576', 'Huyện Sông Hinh', '270', '1');
INSERT INTO `district` VALUES ('265', '577', 'Huyện Đông Hòa', '270', '1');
INSERT INTO `district` VALUES ('266', '578', 'Huyện Phú Hòa', '270', '1');
INSERT INTO `district` VALUES ('267', '579', 'Huyện Tây Hòa', '270', '1');
INSERT INTO `district` VALUES ('268', '580', 'TP Việt Trì', '271', '1');
INSERT INTO `district` VALUES ('269', '581', 'TX Phú Thọ', '271', '1');
INSERT INTO `district` VALUES ('270', '582', 'Huyện Đoan Hùng', '271', '1');
INSERT INTO `district` VALUES ('271', '583', 'Huyện Thanh Ba', '271', '1');
INSERT INTO `district` VALUES ('272', '584', 'Huyện Hạ Hòa', '271', '1');
INSERT INTO `district` VALUES ('273', '585', 'Huyện Cẩm Khê', '271', '1');
INSERT INTO `district` VALUES ('274', '586', 'Huyện Yên Lập', '271', '1');
INSERT INTO `district` VALUES ('275', '587', 'Huyện Thanh Sơn', '271', '1');
INSERT INTO `district` VALUES ('276', '588', 'Huyện Phù Ninh', '271', '1');
INSERT INTO `district` VALUES ('277', '589', 'Huyện Lâm Thao', '271', '1');
INSERT INTO `district` VALUES ('278', '590', 'Huyện Tam Nông', '271', '1');
INSERT INTO `district` VALUES ('279', '591', 'Huyện Thanh Thủy', '271', '1');
INSERT INTO `district` VALUES ('280', '592', 'Huyện Tân Sơn', '271', '1');
INSERT INTO `district` VALUES ('281', '593', 'TP Phan Rang-Tháp Chàm', '272', '1');
INSERT INTO `district` VALUES ('282', '594', 'Huyện Ninh Sơn', '272', '1');
INSERT INTO `district` VALUES ('283', '595', 'Huyện Ninh Phước', '272', '1');
INSERT INTO `district` VALUES ('284', '596', 'Huyện Bác Ái', '272', '1');
INSERT INTO `district` VALUES ('285', '597', 'Huyện Thuận Bắc', '272', '1');
INSERT INTO `district` VALUES ('286', '598', 'Huyện Ninh Hải', '272', '1');
INSERT INTO `district` VALUES ('287', '599', 'TP Ninh Bình', '273', '1');
INSERT INTO `district` VALUES ('288', '600', 'TX Tam Điệp', '273', '1');
INSERT INTO `district` VALUES ('289', '601', 'Huyện Nho Quan', '273', '1');
INSERT INTO `district` VALUES ('290', '602', 'Huyện Gia Viễn', '273', '1');
INSERT INTO `district` VALUES ('291', '603', 'Huyện Hoa Lư', '273', '1');
INSERT INTO `district` VALUES ('292', '604', 'Huyện Yên Mô', '273', '1');
INSERT INTO `district` VALUES ('293', '605', 'Huyện Kim Sơn', '273', '1');
INSERT INTO `district` VALUES ('294', '606', 'Huyện Yên Khánh', '273', '1');
INSERT INTO `district` VALUES ('295', '607', 'TP Vinh', '274', '1');
INSERT INTO `district` VALUES ('296', '608', 'TX Cửa Lò', '274', '1');
INSERT INTO `district` VALUES ('297', '609', 'TX Thái Hòa', '274', '1');
INSERT INTO `district` VALUES ('298', '610', 'Huyện Nam Đàn', '274', '1');
INSERT INTO `district` VALUES ('299', '611', 'Huyện Nghi Lộc', '274', '1');
INSERT INTO `district` VALUES ('300', '612', 'Huyện Nghĩa Đàn', '274', '1');
INSERT INTO `district` VALUES ('301', '613', 'Huyện Anh Sơn', '274', '1');
INSERT INTO `district` VALUES ('302', '614', 'Huyện Con Cuông', '274', '1');
INSERT INTO `district` VALUES ('303', '615', 'Huyện Diễn Châu', '274', '1');
INSERT INTO `district` VALUES ('304', '616', 'Huyện Đô Lương', '274', '1');
INSERT INTO `district` VALUES ('305', '617', 'Huyện Hưng Nguyên', '274', '1');
INSERT INTO `district` VALUES ('306', '618', ' Huyện Quỳ Châu', '274', '1');
INSERT INTO `district` VALUES ('307', '619', 'Huyện Kỳ Sơn', '274', '1');
INSERT INTO `district` VALUES ('308', '620', 'Huyện Quế Phong', '274', '1');
INSERT INTO `district` VALUES ('309', '621', 'Huyện Quỳ Hợp', '274', '1');
INSERT INTO `district` VALUES ('310', '622', 'Huyện Quỳnh Lưu', '274', '1');
INSERT INTO `district` VALUES ('311', '623', 'Huyện Tân Kỳ', '274', '1');
INSERT INTO `district` VALUES ('312', '624', 'Huyện Thanh Chương', '274', '1');
INSERT INTO `district` VALUES ('313', '625', 'Huyện Tương Dương', '274', '1');
INSERT INTO `district` VALUES ('314', '626', 'Huyện Yên Thành', '274', '1');
INSERT INTO `district` VALUES ('315', '627', 'TP Nam Định', '275', '1');
INSERT INTO `district` VALUES ('316', '628', 'Huyện Giao Thủy', '275', '1');
INSERT INTO `district` VALUES ('317', '629', 'Huyện Hải Hậu', '275', '1');
INSERT INTO `district` VALUES ('318', '630', 'Huyện Mỹ Lộc', '275', '1');
INSERT INTO `district` VALUES ('319', '631', 'Huyện Nam Trực', '275', '1');
INSERT INTO `district` VALUES ('320', '632', 'Huyện Nghĩa Hưng', '275', '1');
INSERT INTO `district` VALUES ('321', '633', 'Huyện Trực Ninh', '275', '1');
INSERT INTO `district` VALUES ('322', '634', 'Huyện Vụ Bản', '275', '1');
INSERT INTO `district` VALUES ('323', '635', 'Huyện Xuân Trường', '275', '1');
INSERT INTO `district` VALUES ('324', '636', 'Huyện Ý Yên', '275', '1');
INSERT INTO `district` VALUES ('325', '637', 'TP Tân An', '276', '1');
INSERT INTO `district` VALUES ('326', '638', 'Huyện Vĩnh Hưng', '276', '1');
INSERT INTO `district` VALUES ('327', '639', 'Huyện Mộc Hóa', '276', '1');
INSERT INTO `district` VALUES ('328', '640', 'Huyện Tân Thạnh', '276', '1');
INSERT INTO `district` VALUES ('329', '641', 'Huyện Thạnh Hóa', '276', '1');
INSERT INTO `district` VALUES ('330', '642', 'Huyện Đức Huệ', '276', '1');
INSERT INTO `district` VALUES ('331', '643', 'Huyện Đức Hòa', '276', '1');
INSERT INTO `district` VALUES ('332', '644', 'Huyện Bến Lức', '276', '1');
INSERT INTO `district` VALUES ('333', '645', 'Huyện Thủ Thừa', '276', '1');
INSERT INTO `district` VALUES ('334', '646', 'Huyện Châu Thành', '276', '1');
INSERT INTO `district` VALUES ('335', '647', 'Huyện Tân Trụ', '276', '1');
INSERT INTO `district` VALUES ('336', '648', 'Huyện Cần Đước', '276', '1');
INSERT INTO `district` VALUES ('337', '649', 'Huyện Cần Giuộc', '276', '1');
INSERT INTO `district` VALUES ('338', '650', 'Huyện Tân Hưng', '276', '1');
INSERT INTO `district` VALUES ('339', '651', 'TP Lào Cai', '277', '1');
INSERT INTO `district` VALUES ('340', '652', 'Huyện Xi Ma Cai', '277', '1');
INSERT INTO `district` VALUES ('341', '653', 'Huyện Bát Xát', '277', '1');
INSERT INTO `district` VALUES ('342', '654', 'Huyện Bảo Thắng', '277', '1');
INSERT INTO `district` VALUES ('343', '655', 'Huyện Sa Pa', '277', '1');
INSERT INTO `district` VALUES ('344', '656', 'Huyện Văn Bàn', '277', '1');
INSERT INTO `district` VALUES ('345', '657', 'Huyện Bảo Yên', '277', '1');
INSERT INTO `district` VALUES ('346', '658', 'Huyện Bắc Hà', '277', '1');
INSERT INTO `district` VALUES ('347', '659', 'Huyện Mường Khương', '277', '1');
INSERT INTO `district` VALUES ('348', '660', 'TP Lạng Sơn', '278', '1');
INSERT INTO `district` VALUES ('349', '661', 'Huyện Tràng Định', '278', '1');
INSERT INTO `district` VALUES ('350', '662', 'Huyện Bình Gia', '278', '1');
INSERT INTO `district` VALUES ('351', '663', 'Huyện Văn Lãng', '278', '1');
INSERT INTO `district` VALUES ('352', '664', 'Huyện Bắc Sơn', '278', '1');
INSERT INTO `district` VALUES ('353', '665', 'Huyện Văn Quan', '278', '1');
INSERT INTO `district` VALUES ('354', '666', 'Huyện Cao Lộc', '278', '1');
INSERT INTO `district` VALUES ('355', '667', 'Huyện Lộc Bình', '278', '1');
INSERT INTO `district` VALUES ('356', '668', 'Huyện Chi Lăng', '278', '1');
INSERT INTO `district` VALUES ('357', '669', 'Huyện Đình Lập', '278', '1');
INSERT INTO `district` VALUES ('358', '670', 'Huyện Hữu Lũng', '278', '1');
INSERT INTO `district` VALUES ('359', '671', 'TP Đà Lạt', '279', '1');
INSERT INTO `district` VALUES ('360', '672', 'TX Bảo Lộc', '279', '1');
INSERT INTO `district` VALUES ('361', '673', 'Huyện Đức Trọng', '279', '1');
INSERT INTO `district` VALUES ('362', '674', 'Huyện Di Linh', '279', '1');
INSERT INTO `district` VALUES ('363', '675', 'Huyện Đơn Dương', '279', '1');
INSERT INTO `district` VALUES ('364', '676', 'Huyện Lạc Dương', '279', '1');
INSERT INTO `district` VALUES ('365', '677', 'Huyện Đạ Huoai', '279', '1');
INSERT INTO `district` VALUES ('366', '678', 'Huyện Đạ Tẻh', '279', '1');
INSERT INTO `district` VALUES ('367', '679', 'Huyện Cát Tiên', '279', '1');
INSERT INTO `district` VALUES ('368', '680', 'Huyện Lâm Hà', '279', '1');
INSERT INTO `district` VALUES ('369', '681', 'Huyện Bảo Lâm', '279', '1');
INSERT INTO `district` VALUES ('370', '682', 'Huyện Đam Rông', '279', '1');
INSERT INTO `district` VALUES ('371', '683', 'TX Lai Châu', '280', '1');
INSERT INTO `district` VALUES ('372', '684', 'Huyện Tam Đường', '280', '1');
INSERT INTO `district` VALUES ('373', '685', 'Huyện Phong Thổ', '280', '1');
INSERT INTO `district` VALUES ('374', '686', 'Huyện Sìn Hồ', '280', '1');
INSERT INTO `district` VALUES ('375', '687', 'Huyện Mường Tè', '280', '1');
INSERT INTO `district` VALUES ('376', '688', 'Huyện Than Uyên', '280', '1');
INSERT INTO `district` VALUES ('377', '689', 'TX Kon Tum', '281', '1');
INSERT INTO `district` VALUES ('378', '690', 'Huyện Đăk Glei', '281', '1');
INSERT INTO `district` VALUES ('379', '691', 'Huyện Ngọc Hồi', '281', '1');
INSERT INTO `district` VALUES ('380', '692', 'Huyện Đăk Tô', '281', '1');
INSERT INTO `district` VALUES ('381', '693', 'Huyện Sa Thầy', '281', '1');
INSERT INTO `district` VALUES ('382', '694', 'Huyện Kon Plong', '281', '1');
INSERT INTO `district` VALUES ('383', '695', 'Huyện Đăk Hà', '281', '1');
INSERT INTO `district` VALUES ('384', '696', 'Huyện Kon Rộy', '281', '1');
INSERT INTO `district` VALUES ('385', '697', 'Huyện Tu Mơ Rông', '281', '1');
INSERT INTO `district` VALUES ('386', '698', 'TP Rạch Giá', '282', '1');
INSERT INTO `district` VALUES ('387', '699', 'TX Hà Tiên', '282', '1');
INSERT INTO `district` VALUES ('388', '700', 'Huyện Kiên Lương', '282', '1');
INSERT INTO `district` VALUES ('389', '701', 'Huyện Hòn Đất', '282', '1');
INSERT INTO `district` VALUES ('390', '702', 'Huyện Tân Hiệp', '282', '1');
INSERT INTO `district` VALUES ('391', '703', 'Huyện Châu Thành', '282', '1');
INSERT INTO `district` VALUES ('392', '704', 'Huyện Giồng Riềng', '282', '1');
INSERT INTO `district` VALUES ('393', '705', 'Huyện Gò Quao', '282', '1');
INSERT INTO `district` VALUES ('394', '706', 'Huyện An Biên', '282', '1');
INSERT INTO `district` VALUES ('395', '707', 'Huyện An Minh', '282', '1');
INSERT INTO `district` VALUES ('396', '708', 'Huyện Vĩnh Thuận', '282', '1');
INSERT INTO `district` VALUES ('397', '709', 'Huyện Phú Quốc', '282', '1');
INSERT INTO `district` VALUES ('398', '710', 'Huyện Kiên Hải', '282', '1');
INSERT INTO `district` VALUES ('399', '711', 'Huyện U Minh Thượng', '282', '1');
INSERT INTO `district` VALUES ('400', '712', 'Nha Trang', '283', '1');
INSERT INTO `district` VALUES ('401', '713', 'Huyện Vạn Ninh', '283', '1');
INSERT INTO `district` VALUES ('402', '714', 'Huyện Ninh Hòa', '283', '1');
INSERT INTO `district` VALUES ('403', '715', 'Huyện Diên Khánh', '283', '1');
INSERT INTO `district` VALUES ('404', '716', 'Huyện Khánh Vĩnh', '283', '1');
INSERT INTO `district` VALUES ('405', '717', 'TX Cam Ranh', '283', '1');
INSERT INTO `district` VALUES ('406', '718', 'Huyện Khánh Sơn', '283', '1');
INSERT INTO `district` VALUES ('407', '719', 'Huyện Trường Sa', '283', '1');
INSERT INTO `district` VALUES ('408', '720', 'Huyện Cam Lâm', '283', '1');
INSERT INTO `district` VALUES ('409', '721', 'TX Hưng Yên', '284', '1');
INSERT INTO `district` VALUES ('410', '722', 'Huyện Kim Động', '284', '1');
INSERT INTO `district` VALUES ('411', '723', 'Huyện Ân Thi', '284', '1');
INSERT INTO `district` VALUES ('412', '724', 'Huyện Khoái Châu', '284', '1');
INSERT INTO `district` VALUES ('413', '725', 'Huyện Yên Tiên Lữ', '284', '1');
INSERT INTO `district` VALUES ('414', '726', 'Huyện Phù Cừ', '284', '1');
INSERT INTO `district` VALUES ('415', '727', 'Huyện Mỹ Hào', '284', '1');
INSERT INTO `district` VALUES ('416', '728', 'Huyện Văn Lâm', '284', '1');
INSERT INTO `district` VALUES ('417', '729', 'Huyện Văn Giang', '284', '1');
INSERT INTO `district` VALUES ('418', '730', 'TP Hòa Bình', '285', '1');
INSERT INTO `district` VALUES ('419', '731', 'Huyện Đà Bắc', '285', '1');
INSERT INTO `district` VALUES ('420', '732', 'Huyện Mai Châu', '285', '1');
INSERT INTO `district` VALUES ('421', '733', 'Huyện Tân Lạc', '285', '1');
INSERT INTO `district` VALUES ('422', '734', 'Huyện Lạc Sơn', '285', '1');
INSERT INTO `district` VALUES ('423', '735', 'Huyện Kỳ Sơn', '285', '1');
INSERT INTO `district` VALUES ('424', '736', 'Huyện Lương Sơn', '285', '1');
INSERT INTO `district` VALUES ('425', '737', 'Huyện Kim Bôi', '285', '1');
INSERT INTO `district` VALUES ('426', '738', 'Huyện Lạc Thủy', '285', '1');
INSERT INTO `district` VALUES ('427', '739', 'Huyện Yên Thủy', '285', '1');
INSERT INTO `district` VALUES ('428', '740', 'Huyện Cao Phong', '285', '1');
INSERT INTO `district` VALUES ('429', '741', 'TP Vị Thanh', '286', '1');
INSERT INTO `district` VALUES ('430', '742', 'Huyện Vị Thủy', '286', '1');
INSERT INTO `district` VALUES ('431', '743', 'Huyện Long Mỹ', '286', '1');
INSERT INTO `district` VALUES ('432', '744', 'Huyện Phụng Hiệp', '286', '1');
INSERT INTO `district` VALUES ('433', '745', 'Huyện Châu Thành', '286', '1');
INSERT INTO `district` VALUES ('434', '746', 'Huyện Châu Thành A', '286', '1');
INSERT INTO `district` VALUES ('435', '747', 'TX Ngã Bảy', '286', '1');
INSERT INTO `district` VALUES ('436', '748', 'TP Hải Dương', '287', '1');
INSERT INTO `district` VALUES ('437', '749', 'Huyện Chí Linh', '287', '1');
INSERT INTO `district` VALUES ('438', '750', 'Huyện Nam Sách', '287', '1');
INSERT INTO `district` VALUES ('439', '751', 'Huyện Kinh Môn', '287', '1');
INSERT INTO `district` VALUES ('440', '752', 'Huyện Gia Lộc', '287', '1');
INSERT INTO `district` VALUES ('441', '753', 'Huyện Tứ Kỳ', '287', '1');
INSERT INTO `district` VALUES ('442', '754', 'Huyện Thanh Miện', '287', '1');
INSERT INTO `district` VALUES ('443', '755', 'Huyện Ninh Giang', '287', '1');
INSERT INTO `district` VALUES ('444', '756', 'Huyện Cẩm Giàng', '287', '1');
INSERT INTO `district` VALUES ('445', '757', 'Huyện Thanh Hà', '287', '1');
INSERT INTO `district` VALUES ('446', '758', 'Huyện Kim Thành', '287', '1');
INSERT INTO `district` VALUES ('447', '759', 'Huyện Bình Giang', '287', '1');
INSERT INTO `district` VALUES ('448', '760', 'TP Hà Tĩnh', '288', '1');
INSERT INTO `district` VALUES ('449', '761', 'TX Hồng Lĩnh', '288', '1');
INSERT INTO `district` VALUES ('450', '762', 'Huyện Cẩm Xuyên', '288', '1');
INSERT INTO `district` VALUES ('451', '763', 'Huyện Can Lộc', '288', '1');
INSERT INTO `district` VALUES ('452', '764', 'Huyện Đức Thọ', '288', '1');
INSERT INTO `district` VALUES ('453', '765', 'Huyện Hương Khê', '288', '1');
INSERT INTO `district` VALUES ('454', '766', 'Huyện Hương Sơn', '288', '1');
INSERT INTO `district` VALUES ('455', '767', 'Huyện Kỳ Anh', '288', '1');
INSERT INTO `district` VALUES ('456', '768', 'Huyện Nghi Xuân', '288', '1');
INSERT INTO `district` VALUES ('457', '769', 'Huyện Thạch Hà', '288', '1');
INSERT INTO `district` VALUES ('458', '770', 'Huyện Vũ Quang', '288', '1');
INSERT INTO `district` VALUES ('459', '771', 'Huyện Lộc Hà', '288', '1');
INSERT INTO `district` VALUES ('460', '772', 'TX Phủ Lý', '289', '1');
INSERT INTO `district` VALUES ('461', '773', 'Huyện Duy Tiên', '289', '1');
INSERT INTO `district` VALUES ('462', '774', 'Huyện Kim Bảng', '289', '1');
INSERT INTO `district` VALUES ('463', '775', 'Huyện Lý Nhân', '289', '1');
INSERT INTO `district` VALUES ('464', '776', 'Huyện Thanh Liêm', '289', '1');
INSERT INTO `district` VALUES ('465', '777', 'Huyện Bình Lục', '289', '1');
INSERT INTO `district` VALUES ('466', '778', 'TP Hà Giang', '290', '1');
INSERT INTO `district` VALUES ('467', '779', 'Huyện Đồng Văn', '290', '1');
INSERT INTO `district` VALUES ('468', '780', 'Huyện Mèo Vạc', '290', '1');
INSERT INTO `district` VALUES ('469', '781', 'Huyện Yên Minh', '290', '1');
INSERT INTO `district` VALUES ('470', '782', 'Huyện Quảng Bạ', '290', '1');
INSERT INTO `district` VALUES ('471', '783', 'Huyện Vị Xuyên', '290', '1');
INSERT INTO `district` VALUES ('472', '784', 'Huyện Bắc Mê', '290', '1');
INSERT INTO `district` VALUES ('473', '785', 'Huyện Hoàng Su Phì', '290', '1');
INSERT INTO `district` VALUES ('474', '786', 'Huyện Xín Mần', '290', '1');
INSERT INTO `district` VALUES ('475', '787', 'Huyện Bắc Quang', '290', '1');
INSERT INTO `district` VALUES ('476', '788', 'Huyện Quang Bình', '290', '1');
INSERT INTO `district` VALUES ('477', '789', 'TP Pleiku', '291', '1');
INSERT INTO `district` VALUES ('478', '790', 'Huyện Chư Păh', '291', '1');
INSERT INTO `district` VALUES ('479', '791', 'Huyện Mang Yang', '291', '1');
INSERT INTO `district` VALUES ('480', '792', 'Huyện Kbang', '291', '1');
INSERT INTO `district` VALUES ('481', '793', 'TX An Khê', '291', '1');
INSERT INTO `district` VALUES ('482', '794', 'Huyện Kông Chro', '291', '1');
INSERT INTO `district` VALUES ('483', '795', 'Huyện Đức Cơ', '291', '1');
INSERT INTO `district` VALUES ('484', '796', 'Huyện Chưprông', '291', '1');
INSERT INTO `district` VALUES ('485', '797', 'Huyện Chư Sê', '291', '1');
INSERT INTO `district` VALUES ('486', '798', 'Huyện Ayunpa', '291', '1');
INSERT INTO `district` VALUES ('487', '799', 'Huyện Krông Pa', '291', '1');
INSERT INTO `district` VALUES ('488', '800', 'Huyện Ia Grai', '291', '1');
INSERT INTO `district` VALUES ('489', '801', 'Huyện Đăk Đoa', '291', '1');
INSERT INTO `district` VALUES ('490', '802', 'Huyện Ia Pa', '291', '1');
INSERT INTO `district` VALUES ('491', '803', 'Huyện Đăk Pơ', '291', '1');
INSERT INTO `district` VALUES ('492', '804', 'Huyện Phú Thiện', '291', '1');
INSERT INTO `district` VALUES ('493', '805', 'TP Cao Lãnh', '292', '1');
INSERT INTO `district` VALUES ('494', '806', 'TX Sa Đéc', '292', '1');
INSERT INTO `district` VALUES ('495', '807', 'Huyện Tân Hồng', '292', '1');
INSERT INTO `district` VALUES ('496', '808', 'Huyện Hồng Ngự', '292', '1');
INSERT INTO `district` VALUES ('497', '809', 'Huyện Tam Nông', '292', '1');
INSERT INTO `district` VALUES ('498', '810', 'Huyện Thanh Bình', '292', '1');
INSERT INTO `district` VALUES ('499', '811', 'Huyện Cao Lãnh', '292', '1');
INSERT INTO `district` VALUES ('500', '812', 'Huyện Lắp Vò', '292', '1');
INSERT INTO `district` VALUES ('501', '813', 'Huyện Tháp Mười', '292', '1');
INSERT INTO `district` VALUES ('502', '814', 'Huyện Lai Vung', '292', '1');
INSERT INTO `district` VALUES ('503', '815', 'Huyện Châu Thành', '292', '1');
INSERT INTO `district` VALUES ('504', '816', 'TP Biên Hòa', '293', '1');
INSERT INTO `district` VALUES ('505', '817', 'Huyện Vĩnh Cửu', '293', '1');
INSERT INTO `district` VALUES ('506', '818', 'Huyện Tân Phú', '293', '1');
INSERT INTO `district` VALUES ('507', '819', 'Huyện Định Quán', '293', '1');
INSERT INTO `district` VALUES ('508', '820', 'Huyện Thống Nhất', '293', '1');
INSERT INTO `district` VALUES ('509', '821', 'TX Long Khánh', '293', '1');
INSERT INTO `district` VALUES ('510', '822', 'Huyện Xuân Lộc', '293', '1');
INSERT INTO `district` VALUES ('511', '823', 'Huyện Long Thành', '293', '1');
INSERT INTO `district` VALUES ('512', '824', 'Huyện Nhơn Trạch', '293', '1');
INSERT INTO `district` VALUES ('513', '825', 'Huyện Trảng Bom', '293', '1');
INSERT INTO `district` VALUES ('514', '826', 'Huyện Cẩm Mỹ', '293', '1');
INSERT INTO `district` VALUES ('515', '827', 'TP Điện Biên Phủ', '294', '1');
INSERT INTO `district` VALUES ('516', '828', 'TX Mường Lay', '294', '1');
INSERT INTO `district` VALUES ('517', '829', 'Huyện Điện Biên Đông', '294', '1');
INSERT INTO `district` VALUES ('518', '830', 'Huyện Tuần Giáo', '294', '1');
INSERT INTO `district` VALUES ('519', '831', 'Huyện Mường Chà', '294', '1');
INSERT INTO `district` VALUES ('520', '832', 'Huyện Tủa Chùa', '294', '1');
INSERT INTO `district` VALUES ('521', '833', 'Huyện Điện Biên.', '294', '1');
INSERT INTO `district` VALUES ('522', '834', 'Huyện Mường Nhé', '294', '1');
INSERT INTO `district` VALUES ('523', '835', 'Huyện Mường Ảng', '294', '1');
INSERT INTO `district` VALUES ('524', '836', 'TX Gia Nghĩa', '295', '1');
INSERT INTO `district` VALUES ('525', '837', 'Huyện Dăk RLấp', '295', '1');
INSERT INTO `district` VALUES ('526', '838', 'Huyện Dăk Mil', '295', '1');
INSERT INTO `district` VALUES ('527', '839', 'Huyện Cư Jút', '295', '1');
INSERT INTO `district` VALUES ('528', '840', 'Huyện Dăk Song', '295', '1');
INSERT INTO `district` VALUES ('529', '841', 'Huyện Krông Nô', '295', '1');
INSERT INTO `district` VALUES ('530', '842', 'Huyện Dăk GLong', '295', '1');
INSERT INTO `district` VALUES ('531', '843', 'Huyện Tuy Đức', '295', '1');
INSERT INTO `district` VALUES ('532', '844', 'TP Buôn Ma Thuột', '296', '1');
INSERT INTO `district` VALUES ('533', '845', 'Huyện Ea H Leo', '296', '1');
INSERT INTO `district` VALUES ('534', '846', 'Huyện Krông Buk', '296', '1');
INSERT INTO `district` VALUES ('535', '847', 'Huyện Krông Năng', '296', '1');
INSERT INTO `district` VALUES ('536', '848', 'Huyện Ea Súp', '296', '1');
INSERT INTO `district` VALUES ('537', '849', 'Huyện Cư M gar', '296', '1');
INSERT INTO `district` VALUES ('538', '850', 'Huyện Krông Pắc', '296', '1');
INSERT INTO `district` VALUES ('539', '851', 'Huyện Ea Kar', '296', '1');
INSERT INTO `district` VALUES ('540', '852', 'Huyện M\'Đrăk', '296', '1');
INSERT INTO `district` VALUES ('541', '853', 'Huyện Krông Ana', '296', '1');
INSERT INTO `district` VALUES ('542', '854', 'Huyện Krông Bông', '296', '1');
INSERT INTO `district` VALUES ('543', '855', 'Huyện Lăk', '296', '1');
INSERT INTO `district` VALUES ('544', '856', 'Huyện Buôn Đôn', '296', '1');
INSERT INTO `district` VALUES ('545', '857', 'Huyện Cư Kuin', '296', '1');
INSERT INTO `district` VALUES ('546', '858', 'TX Cao Bằng', '297', '1');
INSERT INTO `district` VALUES ('547', '859', 'Huyện Bảo Lạc', '297', '1');
INSERT INTO `district` VALUES ('548', '860', 'Huyện Thông Nông', '297', '1');
INSERT INTO `district` VALUES ('549', '861', 'Huyện Hà Quảng', '297', '1');
INSERT INTO `district` VALUES ('550', '862', 'Huyện Trà Lĩnh', '297', '1');
INSERT INTO `district` VALUES ('551', '863', 'Huyện Trùng Khánh', '297', '1');
INSERT INTO `district` VALUES ('552', '864', 'Huyện Nguyên Bình', '297', '1');
INSERT INTO `district` VALUES ('553', '865', 'Huyện Hòa An', '297', '1');
INSERT INTO `district` VALUES ('554', '866', 'Huyện Quảng Uyên', '297', '1');
INSERT INTO `district` VALUES ('555', '867', 'Huyện Thạch An', '297', '1');
INSERT INTO `district` VALUES ('556', '868', 'Huyện Hạ Lang', '297', '1');
INSERT INTO `district` VALUES ('557', '869', 'Huyện Bảo Lâm', '297', '1');
INSERT INTO `district` VALUES ('558', '870', 'Huyện Phục Hòa', '297', '1');
INSERT INTO `district` VALUES ('559', '871', 'TP Cà Mau', '298', '1');
INSERT INTO `district` VALUES ('560', '872', 'Huyện Thới Bình', '298', '1');
INSERT INTO `district` VALUES ('561', '873', 'Huyện U Minh', '298', '1');
INSERT INTO `district` VALUES ('562', '874', 'Huyện Trần Văn Thời', '298', '1');
INSERT INTO `district` VALUES ('563', '875', 'Huyện Cái Nước', '298', '1');
INSERT INTO `district` VALUES ('564', '876', 'Huyện Đầm Dơi', '298', '1');
INSERT INTO `district` VALUES ('565', '877', 'Huyện Ngọc Hiển', '298', '1');
INSERT INTO `district` VALUES ('566', '878', 'Huyện Năm Căn', '298', '1');
INSERT INTO `district` VALUES ('567', '879', 'Huyện Phú Tân', '298', '1');
INSERT INTO `district` VALUES ('568', '880', 'TP Phan Thiết', '299', '1');
INSERT INTO `district` VALUES ('569', '881', 'Huyện Tuy Phong', '299', '1');
INSERT INTO `district` VALUES ('570', '882', 'Huyện Bắc Bình', '299', '1');
INSERT INTO `district` VALUES ('571', '883', 'Huyện Hàm Thuận Bắc', '299', '1');
INSERT INTO `district` VALUES ('572', '884', 'Huyện Hàm Thuận Nam', '299', '1');
INSERT INTO `district` VALUES ('573', '885', 'Huyện Hàm Tân', '299', '1');
INSERT INTO `district` VALUES ('574', '886', 'Huyện Đức Linh', '299', '1');
INSERT INTO `district` VALUES ('575', '887', 'Huyện Tánh Linh', '299', '1');
INSERT INTO `district` VALUES ('576', '888', 'Huyện đảo Phú Quý', '299', '1');
INSERT INTO `district` VALUES ('577', '889', 'TX LaGi', '299', '1');
INSERT INTO `district` VALUES ('578', '890', 'TX Đồng Xoài', '300', '1');
INSERT INTO `district` VALUES ('579', '891', 'Huyện Đồng Phú', '300', '1');
INSERT INTO `district` VALUES ('580', '892', 'Huyện Chơn Thành', '300', '1');
INSERT INTO `district` VALUES ('581', '893', 'Huyện Bình Long', '300', '1');
INSERT INTO `district` VALUES ('582', '894', 'Huyện Lộc Ninh', '300', '1');
INSERT INTO `district` VALUES ('583', '895', 'Huyện Bù Đốp', '300', '1');
INSERT INTO `district` VALUES ('584', '896', 'Huyện Phước Long', '300', '1');
INSERT INTO `district` VALUES ('585', '897', 'Huyện Bù Đăng', '300', '1');
INSERT INTO `district` VALUES ('586', '898', 'Tp. Thủ Dầu Một', '301', '1');
INSERT INTO `district` VALUES ('587', '899', 'Huyện Bến Cát', '301', '1');
INSERT INTO `district` VALUES ('588', '900', 'Huyện Tân Uyên', '301', '1');
INSERT INTO `district` VALUES ('589', '901', 'Huyện Thuận An', '301', '1');
INSERT INTO `district` VALUES ('590', '902', 'Thị xã Dĩ An', '301', '1');
INSERT INTO `district` VALUES ('591', '903', 'Huyện Phú Giáo', '301', '1');
INSERT INTO `district` VALUES ('592', '904', 'Huyện Dầu Tiếng', '301', '1');
INSERT INTO `district` VALUES ('593', '905', 'TP Quy Nhơn', '302', '1');
INSERT INTO `district` VALUES ('594', '906', 'Huyện An Lão', '302', '1');
INSERT INTO `district` VALUES ('595', '907', 'Huyện Hoài Ân', '302', '1');
INSERT INTO `district` VALUES ('596', '908', 'Huyện Hoài Nhơn', '302', '1');
INSERT INTO `district` VALUES ('597', '909', 'Huyện Phù Mỹ', '302', '1');
INSERT INTO `district` VALUES ('598', '910', 'Huyện Phù Cát', '302', '1');
INSERT INTO `district` VALUES ('599', '911', 'Huyện Vĩnh Thạnh', '302', '1');
INSERT INTO `district` VALUES ('600', '912', 'Huyện Tây Sơn', '302', '1');
INSERT INTO `district` VALUES ('601', '913', 'Huyện Vân Canh', '302', '1');
INSERT INTO `district` VALUES ('602', '914', 'Huyện An Nhơn', '302', '1');
INSERT INTO `district` VALUES ('603', '915', 'Huyện Tuy Phước', '302', '1');
INSERT INTO `district` VALUES ('604', '916', 'TX Bến Tre', '303', '1');
INSERT INTO `district` VALUES ('605', '917', 'Huyện Châu Thành', '303', '1');
INSERT INTO `district` VALUES ('606', '918', 'Huyện Chợ Lách', '303', '1');
INSERT INTO `district` VALUES ('607', '919', 'Huyện Mỏ Cày', '303', '1');
INSERT INTO `district` VALUES ('608', '920', 'Huyện Giồng Trôm', '303', '1');
INSERT INTO `district` VALUES ('609', '921', 'Huyện Bình Đại', '303', '1');
INSERT INTO `district` VALUES ('610', '922', 'Huyện Ba Tri', '303', '1');
INSERT INTO `district` VALUES ('611', '923', 'Huyện Thạnh Phú', '303', '1');
INSERT INTO `district` VALUES ('612', '924', 'TP Bắc Ninh', '304', '1');
INSERT INTO `district` VALUES ('613', '925', 'Huyện Yên Phong', '304', '1');
INSERT INTO `district` VALUES ('614', '926', 'Huyện Quế Võ', '304', '1');
INSERT INTO `district` VALUES ('615', '927', 'Huyện Tiên Du', '304', '1');
INSERT INTO `district` VALUES ('616', '928', 'Huyện Từ Sơn', '304', '1');
INSERT INTO `district` VALUES ('617', '929', 'Huyện Thuận Thành', '304', '1');
INSERT INTO `district` VALUES ('618', '930', 'Huyện Gia Bình', '304', '1');
INSERT INTO `district` VALUES ('619', '931', 'Huyện Lương Tài', '304', '1');
INSERT INTO `district` VALUES ('620', '932', 'TP Bạc Liêu', '305', '1');
INSERT INTO `district` VALUES ('621', '933', 'Huyện Phước Long', '305', '1');
INSERT INTO `district` VALUES ('622', '934', 'Huyện Hồng Dân', '305', '1');
INSERT INTO `district` VALUES ('623', '935', 'Huyện Vĩnh Lợi', '305', '1');
INSERT INTO `district` VALUES ('624', '936', 'Huyện Giá Rai', '305', '1');
INSERT INTO `district` VALUES ('625', '937', 'Huyện Đông Hải', '305', '1');
INSERT INTO `district` VALUES ('626', '938', 'Huyện Hòa Bình', '305', '1');
INSERT INTO `district` VALUES ('627', '939', 'TX Bắc Kạn', '306', '1');
INSERT INTO `district` VALUES ('628', '940', 'Huyện Chợ Đồn', '306', '1');
INSERT INTO `district` VALUES ('629', '941', 'Huyện Bạch Thông', '306', '1');
INSERT INTO `district` VALUES ('630', '942', 'Huyện Na Rì', '306', '1');
INSERT INTO `district` VALUES ('631', '943', 'Huyện Ngân Sơn', '306', '1');
INSERT INTO `district` VALUES ('632', '944', 'Huyện Ba Bể', '306', '1');
INSERT INTO `district` VALUES ('633', '945', 'Huyện Chợ Mới', '306', '1');
INSERT INTO `district` VALUES ('634', '946', 'Huyện Pác Nặm', '306', '1');
INSERT INTO `district` VALUES ('635', '947', 'TP Bắc Giang', '307', '1');
INSERT INTO `district` VALUES ('636', '948', 'Huyện Yên Thế', '307', '1');
INSERT INTO `district` VALUES ('637', '949', 'Huyện Lục Ngạn', '307', '1');
INSERT INTO `district` VALUES ('638', '950', 'Huyện Sơn Động', '307', '1');
INSERT INTO `district` VALUES ('639', '951', 'Huyện Lục Nam', '307', '1');
INSERT INTO `district` VALUES ('640', '952', 'Huyện Tân Yên', '307', '1');
INSERT INTO `district` VALUES ('641', '953', 'Huyện Hiệp Hòa', '307', '1');
INSERT INTO `district` VALUES ('642', '954', 'Huyện Lạng Giang', '307', '1');
INSERT INTO `district` VALUES ('643', '955', 'Huyện Việt Yên', '307', '1');
INSERT INTO `district` VALUES ('644', '956', 'Huyện Yên Dũng', '307', '1');
INSERT INTO `district` VALUES ('645', '957', 'TP Vũng Tàu', '308', '1');
INSERT INTO `district` VALUES ('646', '958', 'TX Bà Rịa', '308', '1');
INSERT INTO `district` VALUES ('647', '959', 'Huyện Xuyên Mộc', '308', '1');
INSERT INTO `district` VALUES ('648', '960', 'Huyện Long Điền', '308', '1');
INSERT INTO `district` VALUES ('649', '961', 'Huyện Côn Đảo', '308', '1');
INSERT INTO `district` VALUES ('650', '962', 'Huyện Tân Thành', '308', '1');
INSERT INTO `district` VALUES ('651', '963', 'Huyện Châu Đức', '308', '1');
INSERT INTO `district` VALUES ('652', '964', 'Huyện Đất Đỏ', '308', '1');
INSERT INTO `district` VALUES ('653', '965', 'TP Long Xuyên', '309', '1');
INSERT INTO `district` VALUES ('654', '966', 'TX Châu Đốc', '309', '1');
INSERT INTO `district` VALUES ('655', '967', 'Huyện An Phú', '309', '1');
INSERT INTO `district` VALUES ('656', '968', 'Huyện Tân Châu', '309', '1');
INSERT INTO `district` VALUES ('657', '969', 'Huyện Phú Tân', '309', '1');
INSERT INTO `district` VALUES ('658', '970', 'Huyện Tịnh Biên', '309', '1');
INSERT INTO `district` VALUES ('659', '971', 'Huyện Tri Tôn', '309', '1');
INSERT INTO `district` VALUES ('660', '972', 'Huyện Châu Phú', '309', '1');
INSERT INTO `district` VALUES ('661', '973', 'Huyện Chợ Mới', '309', '1');
INSERT INTO `district` VALUES ('662', '974', 'Huyện Châu Thành', '309', '1');
INSERT INTO `district` VALUES ('663', '975', 'Huyện Thoại Sơn', '309', '1');
INSERT INTO `district` VALUES ('664', '976', 'Quận Hồng Bàng', '310', '1');
INSERT INTO `district` VALUES ('665', '977', 'Quận Lê Chân', '310', '1');
INSERT INTO `district` VALUES ('666', '978', 'Quận Ngô Quyền', '310', '1');
INSERT INTO `district` VALUES ('667', '979', 'Quận Kiến An', '310', '1');
INSERT INTO `district` VALUES ('668', '980', 'Quận Hải An', '310', '1');
INSERT INTO `district` VALUES ('669', '981', 'Quận Đồ Sơn', '310', '1');
INSERT INTO `district` VALUES ('670', '982', 'Huyện An Lão', '310', '1');
INSERT INTO `district` VALUES ('671', '983', 'Huyện Kiến Thụy', '310', '1');
INSERT INTO `district` VALUES ('672', '984', 'Huyện Thủy Nguyên', '310', '1');
INSERT INTO `district` VALUES ('673', '985', 'Huyện An Dương', '310', '1');
INSERT INTO `district` VALUES ('674', '986', 'Huyện Tiên Lãng', '310', '1');
INSERT INTO `district` VALUES ('675', '987', 'Huyện Vĩnh Bảo', '310', '1');
INSERT INTO `district` VALUES ('676', '988', 'Huyện Cát Hải', '310', '1');
INSERT INTO `district` VALUES ('677', '989', 'Huyện Bạch Long Vĩ', '310', '1');
INSERT INTO `district` VALUES ('678', '990', 'Quận Dương Kinh', '310', '1');
INSERT INTO `district` VALUES ('679', '991', 'Quận Ninh Kiều', '311', '1');
INSERT INTO `district` VALUES ('680', '992', 'Quận Bình Thủy', '311', '1');
INSERT INTO `district` VALUES ('681', '993', 'Quận Cái Răng', '311', '1');
INSERT INTO `district` VALUES ('682', '994', 'Quận Ô Môn', '311', '1');
INSERT INTO `district` VALUES ('683', '995', 'Huyện Phong Điền', '311', '1');
INSERT INTO `district` VALUES ('684', '996', 'Huyện Cờ Đỏ', '311', '1');
INSERT INTO `district` VALUES ('685', '997', 'Huyện Vĩnh Thạnh', '311', '1');
INSERT INTO `district` VALUES ('686', '998', 'Quận Thốt Nốt', '311', '1');
INSERT INTO `district` VALUES ('687', '999', 'Huyện Thới Lai', '311', '1');
INSERT INTO `district` VALUES ('688', '141359', 'TX. An Bình', '301', '1');
INSERT INTO `district` VALUES ('689', '142034', 'TX. Nghĩa Lộ', '252', '1');
INSERT INTO `district` VALUES ('690', '144543', 'Huyện Nông Sơn', '268', '1');
INSERT INTO `district` VALUES ('691', '150366', 'H.Yên Mỹ', '284', '1');
INSERT INTO `district` VALUES ('692', '153968', 'TX. Buôn Hồ', '296', '1');
INSERT INTO `district` VALUES ('693', '155440', 'H. Hớn Quản', '300', '1');
INSERT INTO `district` VALUES ('694', '155441', 'H. Bù Gia Mập', '300', '1');
INSERT INTO `district` VALUES ('695', '679267', 'Thị xã Hương Thủy', '258', '1');
INSERT INTO `district` VALUES ('696', '1340399', 'Quận Bắc Từ Liêm', '250', '1');
INSERT INTO `district` VALUES ('697', '1340404', 'Quận Nam Từ Liêm', '250', '1');

-- ----------------------------
-- Table structure for `don_vi_do`
-- ----------------------------
DROP TABLE IF EXISTS `don_vi_do`;
CREATE TABLE `don_vi_do` (
  `DON_VI_DO_ID` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `DON_VI_DO_CODE` varchar(50) DEFAULT NULL,
  `DON_VI_DO_NAME` varchar(200) DEFAULT NULL,
  `DELETE_YMD` date DEFAULT NULL,
  PRIMARY KEY (`DON_VI_DO_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of don_vi_do
-- ----------------------------
INSERT INTO `don_vi_do` VALUES ('1', 'unit-total', 'Tổng diện tích', null);
INSERT INTO `don_vi_do` VALUES ('2', 'unit-m2', 'm2', null);

-- ----------------------------
-- Table structure for `hinh_anh`
-- ----------------------------
DROP TABLE IF EXISTS `hinh_anh`;
CREATE TABLE `hinh_anh` (
  `BDS_NEWS_ID` int(11) NOT NULL,
  `HINH_ANH_ID` int(11) NOT NULL,
  `HINH_ANH_PATH` varchar(200) NOT NULL,
  `DELETE_YMD` date DEFAULT NULL,
  PRIMARY KEY (`BDS_NEWS_ID`,`HINH_ANH_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hinh_anh
-- ----------------------------
