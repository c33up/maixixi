-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS user;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`) USING BTREE,
  KEY `password` (`password`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS article;
CREATE TABLE IF NOT EXISTS article (
id INT NOT NULL AUTO_INCREMENT,
title TEXT,
intro TEXT,
content TEXT,
imgurl TEXT,
createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
ishome VARCHAR(50),
num INT DEFAULT '0',
cid VARCHAR(50),
PRIMARY KEY (id),
KEY cid (cid)
)DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS category;
CREATE TABLE IF NOT EXISTS category (
cid INT,
pid INT,
link VARCHAR(80),
cname VARCHAR(50),
PRIMARY KEY (cid),
KEY pid (pid)
)DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1','1','intro','品牌介绍');
INSERT INTO `category` VALUES ('2','1','intro','品牌定位');
INSERT INTO `category` VALUES ('3','1','intro','品牌特色');
INSERT INTO `category` VALUES ('4','1','intro','品牌故事');
INSERT INTO `category` VALUES ('5','1','article','麦西西360°揭秘');
INSERT INTO `category` VALUES ('6','0','article','新闻中心');
INSERT INTO `category` VALUES ('7','2','article','童装搭配秀');
INSERT INTO `category` VALUES ('8','2','article','童装选购技巧');
INSERT INTO `category` VALUES ('9','0','article','家有小儿麦西西');
INSERT INTO `category` VALUES ('10','0','article','麦西西糗事');
INSERT INTO `category` VALUES ('11','3','article','育儿小常识');
INSERT INTO `category` VALUES ('12','3','article','潮物分享');
INSERT INTO `category` VALUES ('21','4','picture','轮播图片');
INSERT INTO `category` VALUES ('22','4','picture','二维码');
INSERT INTO `category` VALUES ('31','5','video','网络视频');
INSERT INTO `category` VALUES ('32','5','video','本地视频');

-- ----------------------------
-- Table structure for `sort`
-- ----------------------------
DROP TABLE IF EXISTS sort;
CREATE TABLE IF NOT EXISTS sort (
pid INT,
pname VARCHAR(50),
PRIMARY KEY (pid),
)DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of sort
-- ----------------------------
INSERT INTO `sort` VALUES ('1','走进麦西西');
INSERT INTO `sort` VALUES ('0','新闻中心');
INSERT INTO `sort` VALUES ('2','穿衣那些事');
INSERT INTO `sort` VALUES ('0','家有小儿麦西西');
INSERT INTO `sort` VALUES ('0','麦西西糗事');
INSERT INTO `sort` VALUES ('3','妈妈育儿经');
INSERT INTO `sort` VALUES ('4','图片管理');
INSERT INTO `sort` VALUES ('5','视频集锦');

-- ----------------------------
-- Table structure for `intro`
-- ----------------------------
DROP TABLE IF EXISTS intro;
CREATE TABLE IF NOT EXISTS intro (
id INT NOT NULL AUTO_INCREMENT, 
title TEXT,
content TEXT,
createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
cid VARCHAR(50),
PRIMARY KEY (id),
KEY cid (cid)
)DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `video`
-- ----------------------------
DROP TABLE IF EXISTS video;
CREATE TABLE IF NOT EXISTS video (
id INT NOT NULL AUTO_INCREMENT, 
title TEXT, 
intro TEXT,
vidurl TEXT,
imgurl TEXT,
createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
ishome VARCHAR(50),
num INT DEFAULT '0',
cid VARCHAR(50),
PRIMARY KEY (id),
KEY cid (cid)
)DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `picture`
-- ----------------------------
DROP TABLE IF EXISTS picture;
CREATE TABLE IF NOT EXISTS picture (
id INT NOT NULL AUTO_INCREMENT, 
title TEXT,
imgurl TEXT,
link TEXT,
cid VARCHAR(50),
PRIMARY KEY (id),
KEY cid (cid)
)DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `contact`
-- ----------------------------
DROP TABLE IF EXISTS contact;
CREATE TABLE IF NOT EXISTS contact (
id INT NOT NULL AUTO_INCREMENT,
address TEXT,
fax VARCHAR(150),
telphone VARCHAR(150),
email VARCHAR(150),
PRIMARY KEY (id)
)DEFAULT CHARSET=utf8;