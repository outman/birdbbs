SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `bbs_admin`
-- ----------------------------
DROP TABLE IF EXISTS `bbs_admin`;
CREATE TABLE `bbs_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `loginIp` varchar(64) DEFAULT '',
  `createTime` int(10) unsigned DEFAULT '0',
  `updateTime` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `bbs_attachment`
-- ----------------------------
DROP TABLE IF EXISTS `bbs_attachment`;
CREATE TABLE `bbs_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `mime` varchar(128) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `table` varchar(64) DEFAULT '',
  `parentId` int(10) unsigned DEFAULT '0',
  `createTime` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parentId_table` (`parentId`,`table`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `bbs_comment`
-- ----------------------------
DROP TABLE IF EXISTS `bbs_comment`;
CREATE TABLE `bbs_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `postId` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `content` longtext NOT NULL,
  `createTime` int(10) unsigned DEFAULT '0',
  `updateTime` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `postid` (`postId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `bbs_log`
-- ----------------------------
DROP TABLE IF EXISTS `bbs_log`;
CREATE TABLE `bbs_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned DEFAULT '1',
  `url` varchar(128) DEFAULT NULL,
  `userKey` varchar(128) DEFAULT NULL,
  `content` longtext NOT NULL,
  `createTime` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `bbs_node`
-- ----------------------------
DROP TABLE IF EXISTS `bbs_node`;
CREATE TABLE `bbs_node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `status` tinyint(2) DEFAULT '1',
  `sort` int(10) unsigned DEFAULT '0',
  `createTime` int(10) unsigned DEFAULT '0',
  `description` varchar(256) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `bbs_outlink`
-- ----------------------------
DROP TABLE IF EXISTS `bbs_outlink`;
CREATE TABLE `bbs_outlink` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `url` varchar(512) NOT NULL,
  `description` varchar(256) DEFAULT '',
  `sort` int(10) unsigned DEFAULT '0',
  `createTime` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `bbs_post`
-- ----------------------------
DROP TABLE IF EXISTS `bbs_post`;
CREATE TABLE `bbs_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `title` varchar(256) NOT NULL,
  `nodeId` int(10) unsigned NOT NULL,
  `content` longtext NOT NULL,
  `status` tinyint(2) unsigned DEFAULT '1',
  `reply` int(10) unsigned DEFAULT '0',
  `sort` int(10) unsigned DEFAULT '0',
  `hits` int(10) unsigned DEFAULT '0',
  `lastUpdateUserId` int(10) unsigned DEFAULT '0',
  `createTime` int(10) unsigned DEFAULT '0',
  `updateTime` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userId_status` (`userId`,`status`),
  KEY `nodeId_status` (`nodeId`,`status`),
  KEY `createTime` (`createTime`)
) ENGINE=InnoDB CHARSET=utf8;

-- ----------------------------
--  Table structure for `bbs_user`
-- ----------------------------
DROP TABLE IF EXISTS `bbs_user`;
CREATE TABLE `bbs_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `siteUrl` varchar(512) DEFAULT '',
  `qq` varchar(20) DEFAULT '',
  `location` varchar(32) DEFAULT '',
  `flag` varchar(128) DEFAULT '',
  `intro` varchar(256) DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `avatar` varchar(512) DEFAULT '',
  `createTime` int(10) unsigned NOT NULL DEFAULT '0',
  `lastIp` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;