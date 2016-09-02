-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS user;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `last_login_ip` varchar(100) DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `expire_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
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
link VARCHAR(80),
icon VARCHAR(50),
cname VARCHAR(50),
PRIMARY KEY (cid)
)DEFAULT CHARSET=utf8;
-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('0' ,'index/index'  ,'icon-home','首页');
INSERT INTO `category` VALUES ('1' ,'intro/index'  ,'icon-th'  ,'公司介绍');
INSERT INTO `category` VALUES ('6' ,'article/index','icon-th'  ,'新闻中心');
INSERT INTO `category` VALUES ('7' ,'article/index','icon-th'  ,'招商加盟');
INSERT INTO `category` VALUES ('9' ,'article/index','icon-th'  ,'家有小儿麦西西');
INSERT INTO `category` VALUES ('20','picture/index','icon-th'  ,'产品展示');
INSERT INTO `category` VALUES ('21','picture/index','icon-th'  ,'轮播图片');
INSERT INTO `category` VALUES ('22','picture/index','icon-th'  ,'二维码');
INSERT INTO `category` VALUES ('23','picture/index','icon-th'  ,'店铺形象');
INSERT INTO `category` VALUES ('31','video/index'  ,'icon-th'  ,'视频集锦');
INSERT INTO `category` VALUES ('32','video/index'  ,'icon-th'  ,'宝贝麦西西');
INSERT INTO `category` VALUES ('40','contact/index'  ,'icon-th'  ,'联系我们');

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
flag VARCHAR(50),
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
imgurl TEXT,
PRIMARY KEY (id)
)DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for `message`
-- ----------------------------
DROP TABLE IF EXISTS message;
CREATE TABLE IF NOT EXISTS message (
id INT NOT NULL AUTO_INCREMENT,
NickName VARCHAR(150),
Tel VARCHAR(150),
Email VARCHAR(150),
comment TEXT,
createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id)
)DEFAULT CHARSET=utf8;