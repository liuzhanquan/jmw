-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2019 �?10 �?24 �?10:48
-- 服务器版本: 5.5.53
-- PHP 版本: 7.0.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `zzcms`
--

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_about`
--

CREATE TABLE IF NOT EXISTS `zzcms_about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL,
  `content` longtext,
  `link` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_ad`
--

CREATE TABLE IF NOT EXISTS `zzcms_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xuhao` int(11) NOT NULL DEFAULT '0',
  `title` char(50) DEFAULT NULL,
  `titlecolor` char(255) DEFAULT NULL,
  `link` char(255) DEFAULT NULL,
  `dl_id` int(11) DEFAULT NULL COMMENT '代理产品ID',
  `zx_id` int(11) DEFAULT NULL COMMENT '资讯文章ID',
  `sendtime` datetime DEFAULT NULL,
  `bigclassname` char(50) DEFAULT NULL,
  `smallclassname` char(50) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `nextuser` char(50) DEFAULT NULL,
  `elite` tinyint(4) NOT NULL DEFAULT '0',
  `img` char(255) DEFAULT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- 转存表中的数据 `zzcms_ad`
--

INSERT INTO `zzcms_ad` (`id`, `xuhao`, `title`, `titlecolor`, `link`, `dl_id`, `zx_id`, `sendtime`, `bigclassname`, `smallclassname`, `username`, `nextuser`, `elite`, `img`, `starttime`, `endtime`) VALUES
(1, 0, '32111', '', 'javascript:void(0)', 31, 1, '2019-09-29 17:30:45', 'api', '人气品牌', '', '', 0, '/uploadfiles/2019-10/20191016011643491.jpg', '2019-10-15 00:00:00', '2019-10-15 00:00:00'),
(2, 1, '32111', '', 'javascript:void(0)', 1, 0, '2019-09-30 15:31:48', 'api', 'banner', '', NULL, 0, '', '2019-10-16 00:00:00', '2020-10-15 00:00:00'),
(3, 3, '32111', '', 'javascript:void(0)', 2, 0, '2019-09-30 15:31:55', 'api', 'banner', '', NULL, 0, '', '2019-10-16 00:00:00', '2020-10-15 00:00:00'),
(4, 2, '32111', '', 'javascript:void(0)', 31, 0, '2019-09-30 15:32:03', 'api', 'banner', '', NULL, 0, '', '2019-10-16 00:00:00', '2020-10-15 00:00:00'),
(5, 0, '32111', '', 'javascript:void(0)', 33, 0, '2019-09-30 17:39:18', 'api', '人气品牌', '', '', 0, '', '2019-10-16 00:00:00', '2020-10-15 00:00:00'),
(6, 3, '为您推荐', '', 'javascript:void(0)', 29, 1, '2019-09-30 19:01:16', 'api', '为您推荐', '', '', 0, '', '2019-10-16 00:00:00', '2020-10-15 00:00:00'),
(7, 1, '为您推荐', '', 'javascript:void(0)', 33, 0, '2019-09-30 19:01:27', 'api', '为您推荐', '', '', 0, '', '2019-10-16 00:00:00', '2020-10-15 00:00:00'),
(8, 0, '为您推荐', '', 'javascript:void(0)', 0, 2, '2019-10-01 10:25:20', 'api', '首页资讯', '', NULL, 0, '', '2019-10-17 00:00:00', '2020-10-16 00:00:00'),
(9, 0, '32111', '', 'javascript:void(0)', 0, 0, '2019-10-02 16:47:07', '首页', '对联广告左侧', '', '', 0, '/uploadfiles/2019-10/20191018084705658.jpg', '2019-10-18 00:00:00', '2020-10-17 00:00:00'),
(10, 0, '32111', '', 'javascript:void(0)', 33, 0, '2019-10-02 17:47:00', '发现', '优质品牌', '', NULL, 0, '', '2019-10-18 00:00:00', '2020-10-17 00:00:00'),
(11, 0, '32111', '', 'javascript:void(0)', 34, 0, '2019-10-02 17:47:08', '发现', '优质品牌', '', NULL, 0, '', '2019-10-18 00:00:00', '2020-10-17 00:00:00'),
(12, 0, '32111', '', 'javascript:void(0)', 35, 0, '2019-10-02 17:47:31', '发现', '教育专区', '', NULL, 0, '', '2019-10-18 00:00:00', '2020-10-17 00:00:00'),
(13, 0, '32111', '', 'javascript:void(0)', 0, 3, '2019-10-02 18:42:05', '加盟资讯', '加盟资讯', '', NULL, 0, '', '2019-10-18 00:00:00', '2020-10-17 00:00:00'),
(14, 0, '32111', '', 'javascript:void(0)', 0, 2, '2019-10-02 19:23:32', '加盟资讯', '加盟资讯', '', NULL, 0, '', '2019-10-18 00:00:00', '2020-10-17 00:00:00'),
(15, 0, '32111', '', 'javascript:void(0)', 33, 0, '2019-10-02 19:35:16', '加盟排行榜', '餐饮排行榜', '', '', 0, '', '2019-10-18 00:00:00', '2020-10-17 00:00:00'),
(17, 0, '32111', '', 'javascript:void(0)', 35, 0, '2019-10-02 19:36:40', '加盟排行榜', '教育排行榜', '', NULL, 0, '', '2019-10-18 00:00:00', '2020-10-17 00:00:00'),
(18, 0, '32111', '', 'javascript:void(0)', 33, 0, '2019-10-02 20:24:09', '热门行业', '特色美食', '', NULL, 0, '', '2019-10-18 00:00:00', '2020-10-17 00:00:00'),
(19, 0, '32111', '', 'javascript:void(0)', 32, 0, '2019-10-02 20:24:22', '热门行业', '特色美食', '', NULL, 0, '', '2019-10-18 00:00:00', '2020-10-17 00:00:00'),
(20, 0, '3213', '', 'javascript:void(0)', 34, 0, '2019-10-05 09:21:57', '发现', '教育专区', '', NULL, 0, '', '2019-10-21 00:00:00', '2020-10-20 00:00:00'),
(21, 0, '3213', '', 'javascript:void(0)', 34, 0, '2019-10-05 19:48:12', '热门行业', '特色美食', '', NULL, 0, '', '2019-10-21 00:00:00', '2020-10-20 00:00:00'),
(47, 0, NULL, NULL, NULL, 30, NULL, '2019-10-22 19:54:14', 'api', '为您推荐', NULL, NULL, 0, NULL, NULL, NULL),
(46, 0, NULL, NULL, NULL, 34, NULL, '2019-10-22 19:50:51', 'api', 'banner', NULL, NULL, 0, NULL, NULL, NULL),
(45, 0, NULL, NULL, NULL, 34, NULL, '2019-10-22 19:49:15', 'api', '为您推荐', NULL, NULL, 0, NULL, NULL, NULL),
(42, 0, NULL, NULL, NULL, 34, NULL, '2019-10-22 19:47:53', '加盟排行榜', '餐饮排行榜', NULL, NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_adclass`
--

CREATE TABLE IF NOT EXISTS `zzcms_adclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) NOT NULL,
  `parentid` char(50) NOT NULL,
  `xuhao` int(11) NOT NULL DEFAULT '0',
  `nav_show` tinyint(4) DEFAULT '0' COMMENT '加入发现导航栏',
  `photo` varchar(100) DEFAULT NULL COMMENT '标签背景图片',
  `dl_classid` int(11) DEFAULT '0' COMMENT '关联产品ID',
  `remarks` varchar(20) DEFAULT NULL COMMENT '备注',
  `isedit` tinyint(4) DEFAULT '1' COMMENT '能否修改添加 1 可以 0 不可以',
  `isdel` tinyint(4) DEFAULT '1' COMMENT '能否删除1可以  0不可以',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

--
-- 转存表中的数据 `zzcms_adclass`
--

INSERT INTO `zzcms_adclass` (`classid`, `classname`, `parentid`, `xuhao`, `nav_show`, `photo`, `dl_classid`, `remarks`, `isedit`, `isdel`) VALUES
(1, '对联广告右侧', '首页', 0, 0, NULL, 0, NULL, 1, 1),
(2, '对联广告左侧', '首页', 0, 0, NULL, 0, NULL, 1, 1),
(3, '漂浮广告', '首页', 0, 0, NULL, 0, NULL, 1, 1),
(4, '首页顶部', '首页', 0, 0, NULL, 0, NULL, 1, 1),
(5, '品牌招商', '首页', 0, 0, NULL, 0, NULL, 1, 1),
(6, 'banner', '首页', 0, 0, NULL, 0, NULL, 1, 1),
(7, '轮显广告', '展会页', 0, 0, NULL, 0, NULL, 1, 1),
(8, '第二行', '首页', 0, 0, NULL, 0, NULL, 1, 1),
(9, '轮显广告', '首页', 0, 0, NULL, 0, NULL, 1, 1),
(10, '第一行', '首页', 0, 0, NULL, 0, NULL, 1, 1),
(11, 'B', '首页', 0, 0, NULL, 0, NULL, 1, 1),
(12, 'A', '首页', 0, 0, NULL, 0, NULL, 1, 1),
(13, '首页', 'A', 0, 0, NULL, 0, NULL, 1, 1),
(14, 'api', 'A', 0, 0, NULL, 0, NULL, 0, 0),
(15, '为您推荐', 'api', 0, 0, NULL, 0, NULL, 1, 0),
(16, '人气品牌', 'api', 0, 0, NULL, 0, NULL, 1, 0),
(17, '猜你喜欢', 'api', 0, 0, NULL, 0, NULL, 1, 0),
(49, '加盟资讯', '加盟资讯', 0, 1, '', 0, '', 1, 1),
(46, '教育专区', '发现', 0, 1, '', 0, '', 1, 0),
(45, '优质品牌', '发现', 0, 1, '', 0, '', 1, 0),
(44, '发现', 'A', 0, 1, NULL, 0, NULL, 0, 0),
(28, '加盟排行榜', 'A', 0, 1, NULL, 0, NULL, 1, 0),
(26, 'banner', 'api', 0, 0, NULL, 0, NULL, 1, 0),
(29, '热门行业', 'A', 0, 1, NULL, 0, NULL, 1, 0),
(30, '小类别名称', '', 0, 0, NULL, 0, NULL, 1, 1),
(31, '餐饮排行榜', '加盟排行榜', 0, 1, '/uploadfiles/2019-10/20191018114947342.png', 1, '好吃赚钱', 1, 1),
(32, '教育排行榜', '加盟排行榜', 0, 1, '/uploadfiles/2019-10/20191018114934320.jpg', 2, '名师外教', 1, 1),
(35, '分类-为您推荐', 'A', 0, 0, NULL, 0, NULL, 1, 0),
(36, '分类-热门分类', 'A', 0, 0, NULL, 0, NULL, 1, 0),
(37, '机器人教育', '分类-为您推荐', 0, 0, '', 8, '', 1, 1),
(38, '教育', '分类-为您推荐', 0, 0, '', 2, '', 1, 1),
(39, '小吃', '分类-为您推荐', 0, 0, '', 3, '', 1, 1),
(40, '快餐', '分类-为您推荐', 0, 0, '', 4, '', 1, 1),
(41, '教育', '分类-热门分类', 0, 0, '', 2, '', 1, 1),
(42, '化妆', '分类-热门分类', 0, 0, '', 6, '', 1, 1),
(43, '小吃', '分类-热门分类', 0, 0, '', 3, '', 1, 1),
(47, '大众美食', '发现', 0, 1, '', 0, '', 1, 0),
(48, '加盟资讯', 'A', 0, 1, NULL, 0, NULL, 1, 0),
(50, '特色美食', '热门行业', 0, 1, '/uploadfiles/2019-10/20191018121955127.jpg', 1, '盟妹力荐', 1, 1),
(51, '教育辅导', '热门行业', 0, 1, '/uploadfiles/2019-10/20191018122125861.jpg', 2, '最热行业', 1, 1),
(61, '餐饮', '分类-为您推荐', 0, 0, NULL, 1, NULL, 1, 1),
(60, '快餐', '分类-热门分类', 0, 0, NULL, 4, NULL, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_admin`
--

CREATE TABLE IF NOT EXISTS `zzcms_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) DEFAULT NULL,
  `admin` char(50) DEFAULT NULL,
  `pass` char(50) DEFAULT NULL,
  `logins` int(11) DEFAULT '0',
  `loginip` char(50) DEFAULT NULL,
  `lastlogintime` datetime DEFAULT NULL,
  `showloginip` char(50) DEFAULT NULL,
  `showlogintime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `zzcms_admin`
--

INSERT INTO `zzcms_admin` (`id`, `groupid`, `admin`, `pass`, `logins`, `loginip`, `lastlogintime`, `showloginip`, `showlogintime`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 2, '127.0.0.1', '2019-10-15 09:14:26', '127.0.0.1', '2019-10-14 16:44:41');

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_admingroup`
--

CREATE TABLE IF NOT EXISTS `zzcms_admingroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` char(50) DEFAULT NULL,
  `config` varchar(1000) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `zzcms_admingroup`
--

INSERT INTO `zzcms_admingroup` (`id`, `groupname`, `config`) VALUES
(1, '超级管理员', 'zs#zs_modify#zs_del#zsclass#zskeyword#dl#dl_add#dl_modify#dl_del#guestbook#zh#zh_add#zh_modify#zh_del#zhclass#zx#zx_add#zx_modify#zx_del#zxclass#zxpinglun#zxtag#pp#pp_modify#pp_del#job#job_modify#job_del#jobclass#special#special_add#special_modify#special_del#specialclass#wangkan#wangkan_add#wangkan_modify#wangkan_del#wangkanclass#baojia#baojia_modify#baojia_del#ask#ask_add#ask_modify#ask_del#askclass#adv#adv_add#adv_modify#adv_del#advclass#adv_user#user#user_modify#user_del#usernoreg#userclass#usergroup#friendlink#friendlink_add#friendlink_modify#friendlink_del#about#about_add#about_modify#about_del#label#label_add#label_modify#label_del#licence#fankui#badusermessage#uploadfiles#sendmessage#sendmail#sendsms#announcement#helps#siteconfig#adminmanage#admingroup'),
(2, '管理员(演示用)', 'zs#zs_modify#zskeyword#dl#dl_add#dl_modify#guestbook#zh#zh_add#zh_modify#zx#zx_add#zx_modify#zxpinglun#zxtag#pp#pp_modify#job#job_modify#special#special_add#special_modify#wangkan#wangkan_add#wangkan_modify#baojia#baojia_modify#ask#ask_add#ask_modify#adv#user#usernoreg#friendlink#about#label#licence#fankui#badusermessage#sendmessage#sendmail#sendsms');

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_answer`
--

CREATE TABLE IF NOT EXISTS `zzcms_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `about` int(11) DEFAULT '0',
  `content` longtext,
  `face` char(50) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `ip` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `caina` tinyint(4) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_ask`
--

CREATE TABLE IF NOT EXISTS `zzcms_ask` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT NULL,
  `bigclassname` char(50) DEFAULT NULL,
  `smallclassid` int(11) DEFAULT NULL,
  `smallclassname` char(50) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `content` longtext,
  `img` char(255) DEFAULT NULL,
  `jifen` int(11) DEFAULT '0',
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  `typeid` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bigclassid` (`bigclassid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_askclass`
--

CREATE TABLE IF NOT EXISTS `zzcms_askclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) DEFAULT '0',
  `classname` char(50) DEFAULT NULL,
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT NULL,
  `xuhao` int(11) DEFAULT '0',
  `isshow` tinyint(4) DEFAULT '1',
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_bad`
--

CREATE TABLE IF NOT EXISTS `zzcms_bad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) DEFAULT NULL,
  `ip` char(50) DEFAULT NULL,
  `dose` char(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `lockip` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_baojia`
--

CREATE TABLE IF NOT EXISTS `zzcms_baojia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classid` tinyint(4) DEFAULT '0',
  `cp` char(50) DEFAULT NULL,
  `province` char(50) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `xiancheng` char(50) DEFAULT NULL,
  `price` char(50) DEFAULT NULL,
  `danwei` char(50) DEFAULT NULL,
  `companyname` char(50) DEFAULT NULL,
  `truename` char(50) DEFAULT NULL,
  `address` char(50) DEFAULT NULL,
  `tel` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `ip` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `province` (`province`,`city`,`xiancheng`),
  KEY `classid` (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_config`
--

CREATE TABLE IF NOT EXISTS `zzcms_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `title_list` varchar(100) DEFAULT NULL COMMENT '副标题',
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='系统设置' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `zzcms_config`
--

INSERT INTO `zzcms_config` (`id`, `name`, `title`, `title_list`, `add_time`) VALUES
(1, 'phone1', '加盟管家', '400-0000-0001', 0),
(2, 'phone2', '广告投放', '010-1234-1234', 0);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_dl`
--

CREATE TABLE IF NOT EXISTS `zzcms_dl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classid` tinyint(4) DEFAULT '0',
  `cpid` int(11) DEFAULT '0',
  `cp` char(50) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL COMMENT '副标题',
  `photo` varchar(255) DEFAULT NULL COMMENT '产品图片',
  `province` char(50) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `xiancheng` char(50) DEFAULT NULL,
  `content` text COMMENT '产品详细介绍',
  `company` char(50) DEFAULT NULL,
  `companyname` char(50) DEFAULT NULL,
  `dlsname` char(50) DEFAULT NULL,
  `address` char(255) DEFAULT NULL,
  `tel` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `saver` char(50) DEFAULT NULL,
  `savergroupid` int(11) DEFAULT '0',
  `ip` char(50) DEFAULT NULL,
  `xuhao` int(11) DEFAULT '0' COMMENT '排序越小越靠前',
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `looked` tinyint(4) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `del` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `province` (`province`,`city`,`xiancheng`),
  KEY `classid` (`classid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `zzcms_dl`
--

INSERT INTO `zzcms_dl` (`id`, `classid`, `cpid`, `cp`, `title`, `photo`, `province`, `city`, `xiancheng`, `content`, `company`, `companyname`, `dlsname`, `address`, `tel`, `email`, `editor`, `saver`, `savergroupid`, `ip`, `xuhao`, `sendtime`, `hit`, `looked`, `passed`, `del`) VALUES
(37, 4, 0, '炒牛奶', '炒牛奶炒牛奶炒牛奶', '/uploadfiles/2019-10/20191023042143425.png', '广东', '', '市辖区', '范德萨发的沙发大师傅打双方都阿范德萨', '个人', '', '益范德萨', '发范德萨范德萨', '15112212223', '456@456.com', NULL, NULL, 0, NULL, 0, '2019-10-23 12:22:40', 0, 0, 1, 0),
(36, 4, 0, '冻牛奶搽', '冻牛奶搽冻牛奶搽冻牛奶搽冻牛奶搽', '/uploadfiles/2019-10/20191023041909836.jpg', '天津', '', '', '范德萨发打范德萨啊&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191023041921570.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191023041934841.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191023041942726.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;', '个人', '', '随时随地', '国防生的给对方', '15114444421', '', NULL, NULL, 0, NULL, 0, '2019-10-23 12:20:59', 0, 0, 1, 0),
(26, 7, 0, '发放发放付', NULL, NULL, '天津', '', NULL, '广大发大水发过的', '个人', '', 'fdsaf', '的飞洒范德萨范德萨啊', '15118921111', '456@456.com', NULL, NULL, 0, NULL, 0, '2019-10-15 14:46:40', 0, 0, 1, 0),
(27, 7, 0, '发放发放付', NULL, NULL, '天津', '', NULL, '广大发大水发过的', '个人', '', 'fdsaf', '的飞洒范德萨范德萨啊', '15118921111', '456@456.com', NULL, NULL, 0, NULL, 0, '2019-10-15 14:46:46', 0, 0, 1, 0),
(28, 8, 0, '放到', NULL, NULL, '北京', '', NULL, '发洒范德萨范德萨', '个人', '', '范德萨', '的飞洒范德萨范德萨啊', '15118921112', '456@456.com', NULL, NULL, 0, NULL, 0, '2019-10-15 14:50:54', 0, 0, 1, 0),
(29, 4, 0, '广告费', '', '/uploadfiles/2019-10/20191023083201348.png', '北京', '', NULL, '噶发送放到昂发大水的飞洒发送', '个人', '', '滚滚滚', '的飞洒范德萨范德萨啊', '121121111121', '456@456.com', NULL, NULL, 0, NULL, 0, '2019-10-23 16:32:05', 2, 0, 1, 0),
(30, 4, 0, '广告费1', '', '/uploadfiles/2019-10/20191023083147475.jpg', '北京', '', NULL, '噶发送放到昂发大水的飞洒发送', '个人', '', '滚滚滚', '的飞洒范德萨范德萨啊', '12112111112', '456@456.com', NULL, NULL, 0, NULL, 0, '2019-10-23 16:31:52', 1, 0, 1, 0),
(31, 2, 0, '发送噶奶茶', '委屈额', '/uploadfiles/2019-10/20191015084747913.jpg,/uploadfiles/2019-10/20191015084726413.jpg', '天津', '', '宁河县', '范德萨给第三方&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191022120220391.jpg&quot; style=&quot;width: 1081px; height: 1080px;&quot; /&gt;范德萨发大水发大厦范德萨发的洒发的洒&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191022120236990.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;发大水发大厦范德萨发的洒fdsa范德萨发打&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191022120248702.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;', '个人', '', '随时随地', '国防生的给对方', '15114444424', '', NULL, NULL, 0, NULL, 0, '2019-10-22 20:02:53', 112, 0, 1, 0),
(32, 4, 0, '新奶茶', '奶茶一号', '/uploadfiles/2019-10/20191017063016694.png,/uploadfiles/2019-10/20191017063021500.png', '天津', '静海县,宁河县', '蓟县', '范德萨范德萨范德萨高峰打', '个人', '', '范德萨', '432fdsa', '12321', 'fdsafdas', NULL, NULL, 0, NULL, 0, '2019-10-18 11:24:45', 26, 0, 1, 0),
(33, 4, 0, '小外卖', '超级小外卖', '/uploadfiles/2019-10/20191017074503786.png', '内蒙古', '达尔罕茂明安联合旗,昆都仑区', '昆都仑区', '发大水发大厦股份第三个FDASF DAS F', '个人', '', '发洒范德萨', '发送', '股份第三个', '股份十多个', NULL, NULL, 0, NULL, 0, '2019-10-18 11:24:24', 138, 0, 1, 0),
(34, 3, 0, '大奶茶', '一杯大奶茶', '/uploadfiles/2019-10/20191018032539799.jpg,/uploadfiles/2019-10/20191018032543417.png', '河北', '古冶区,丰南区,迁西县,滦县,玉田县', '玉田县', '范德萨发的方大化工放到持续出现Z从润肺安慰法人他沟通石油化工客户数道森股份发过火凤凰zsdffdsfdhguttrqewrfrgv', '个人', '', '范德萨发11111', '发大水啊', '18815554462', '股份第三个范德萨', NULL, NULL, 0, NULL, 0, '2019-10-23 17:03:43', 39, 0, 1, 0),
(35, 4, 0, '烧烤店', '美味烧烤', '/uploadfiles/2019-10/20191018063858364.jpg,/uploadfiles/2019-10/20191018063905654.png', '辽宁', '西岗区,甘井子区', '甘井子区', '爱上f答复打算范德萨割发代首电饭锅打放到阿范德萨刚恢复到花港饭店好刚发的', '公司', '范德萨', '范德萨发的啊', '发的啊', '范德萨', '范德萨', NULL, NULL, 0, NULL, 0, '2019-10-18 16:45:49', 6, 0, 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_dladvantag`
--

CREATE TABLE IF NOT EXISTS `zzcms_dladvantag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL COMMENT '标签名',
  `xuhao` int(11) DEFAULT '0' COMMENT '排序',
  `list` varchar(30) DEFAULT NULL,
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='代理商优势标签' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `zzcms_dladvantag`
--

INSERT INTO `zzcms_dladvantag` (`id`, `title`, `xuhao`, `list`, `update_time`) VALUES
(1, '加盟扶持', 0, NULL, 1571367958),
(2, '时尚生活', 0, NULL, 1571367991),
(3, '娱乐精神', 0, NULL, 1571368007),
(4, '真人在线', 0, NULL, 1571368020),
(5, '开业明星代言', 0, NULL, 1571368032);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_dlfootprint`
--

CREATE TABLE IF NOT EXISTS `zzcms_dlfootprint` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL COMMENT 'dl ID',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `up_device` tinyint(4) NOT NULL DEFAULT '0' COMMENT '设备0电脑 1手机',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户足迹' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_dlje`
--

CREATE TABLE IF NOT EXISTS `zzcms_dlje` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price_min` int(11) DEFAULT NULL COMMENT '价格区间',
  `xuhao` int(11) DEFAULT '0' COMMENT '排序',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '1' COMMENT '是否启用',
  `price_max` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='投资金额区间表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `zzcms_dlje`
--

INSERT INTO `zzcms_dlje` (`id`, `price_min`, `xuhao`, `update_time`, `status`, `price_max`) VALUES
(1, 10, 5, 1571292327, 1, 50),
(2, 50, 6, 1571292316, 1, 60),
(3, 0, 0, 1571292381, 1, 10);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_dllist`
--

CREATE TABLE IF NOT EXISTS `zzcms_dllist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(11) DEFAULT NULL COMMENT 'dl  ID',
  `name` varchar(100) DEFAULT NULL COMMENT '项目名称',
  `title_list` varchar(100) DEFAULT NULL COMMENT '主营项目',
  `reg_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `store_num` int(11) DEFAULT NULL COMMENT '直营店数量',
  `join_num` int(11) DEFAULT NULL COMMENT '加盟数量',
  `join_people` int(11) DEFAULT NULL COMMENT '申请加盟人数',
  `price_min` int(11) DEFAULT NULL COMMENT '最小投资金额',
  `price_max` int(11) NOT NULL COMMENT '最大投资金额',
  `dl_tag` varchar(100) DEFAULT NULL COMMENT '代理支持标签',
  `dl_advantag` varchar(50) DEFAULT NULL COMMENT '代理优势标签',
  `price_total` int(11) DEFAULT NULL COMMENT '投资总资金',
  `price_list` varchar(255) DEFAULT NULL COMMENT '资金简介',
  `boss_name` varchar(50) DEFAULT NULL COMMENT 'boss名称',
  `boss_addr` varchar(100) DEFAULT NULL COMMENT 'boss地址',
  `boss_birthday` varchar(20) DEFAULT NULL COMMENT 'boss生日',
  `boss_nature` varchar(50) DEFAULT NULL COMMENT 'boss性格',
  `boss_job` varchar(100) DEFAULT NULL COMMENT 'boss曾经做过的工作',
  `boss_interst` varchar(100) DEFAULT NULL COMMENT 'boss兴趣',
  `boss_content` text COMMENT 'boss演讲',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '是否启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='代理信息详细表' AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `zzcms_dllist`
--

INSERT INTO `zzcms_dllist` (`id`, `did`, `name`, `title_list`, `reg_time`, `store_num`, `join_num`, `join_people`, `price_min`, `price_max`, `dl_tag`, `dl_advantag`, `price_total`, `price_list`, `boss_name`, `boss_addr`, `boss_birthday`, `boss_nature`, `boss_job`, `boss_interst`, `boss_content`, `update_time`, `status`) VALUES
(1, 22, '项目名称', '项目1  项目2  项目3 项目4', 2019, NULL, NULL, NULL, 1, 55, '1,2', NULL, 8, '', '', '', '', '', '', '', '', 1571121538, 0),
(2, 28, '打发的撒', '123 范德萨 1234 发给', 2019, 23, 11, 4213, 2, 15, '1,3', NULL, 8, '加盟-22-44/入股-22-11', '', '', '', '', '', '', '', 1571122254, 0),
(3, 29, '大幅度', '111 111 范德萨', 1970, 22, 33, 111, 3, 16, '1,3,2', '', 10, '加盟费-2-2/装修-5-6/入股-3-3', '', '', '', '', '', '', '', 1571819525, 0),
(4, 30, '大幅度2', '111 111 范德萨', 1970, 22, 33, 111, 1, 18, '1,3,2', '', 10, '培训-8-8/招标-9-9', '发顺丰达', '3213', '1999', '深沉', '总经理', '吃零食', '大洒范德萨嘎达的 打范德萨', 1571819512, 0),
(5, 31, '滚滚滚 是是是2', '发发发1', 1970, 14, 26, 36, 56, 80, '1,3,2', '', 24, '加盟1-12-30/加盟2-13-22', '范德萨1', '股份第三个1', '1985', '打1', '范德萨范德萨1', '灌灌灌灌1', '发放发放付付付付付付付方法11231321', 1571745773, 0),
(6, 32, '奶茶', '奶茶奶茶', 1970, 33, 55, 4456, 3, 8, '1,2', '1,3,5', 10, '加盟-10-10/加盟2-10-15', '', '', '', '', '', '', '', 1571369085, 0),
(7, 33, '小快餐', '中餐 晚餐', 1970, 120, 333, 5511, 3, 10, '3,2', '2,4,5', 24, '材料费-4-4/加盟费-20-20', '烟火', '天津', '1999', '不知', '不说', '没有', '随便说说吧', 1571369064, 0),
(8, 34, '大奶茶', '奶茶  饮品  冻饮', 1970, 35, 58, 6465, 2, 8, '3,2', '1,3,4', 10, '加盟-8-8/装修-2-2', '', '', '', '', '', '', '', 1571821423, 0),
(9, 35, '超级烧烤', '烧烤  啤酒 炸鸡', 1970, 14, 88, 666, 0, 1, '1,2', '1,5', 1, '加盟费-1-1', '发生', '发生', '2002', '开朗', 'ceo', '开车', '的考虑撒娇龙卷风第三款啦理发店拉萨会计法', 1571388349, 0),
(10, 36, '随时随地滚滚滚', '冻牛奶搽 冻牛奶搽1', 1970, 14, 16, 333, 20, 22, '3,2', '1,3,4', 18, '加盟培训-18-0', '', '', '', '', '', '', '', 1571804459, 0),
(11, 37, '炒牛奶 炒牛奶1', '炒牛奶炒牛奶炒牛奶炒牛奶炒牛奶炒牛奶炒牛奶', 1970, 44, 33, 141, 2, 6, '3,2', '1,2', 6, '加盟-6-0', '', '', '', '', '', '', '', 1571804560, 0),
(12, 23, '项目名称', '项目1  项目2  项目3 项目4', 2019, NULL, NULL, NULL, 1, 55, '1,2', NULL, 8, '', '', '', '', '', '', '', '', 1571121538, 0);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_dlmessage`
--

CREATE TABLE IF NOT EXISTS `zzcms_dlmessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` bigint(20) DEFAULT NULL COMMENT '手机号',
  `title` char(50) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `sendtime` int(11) DEFAULT NULL,
  `up_device` tinyint(4) DEFAULT '0' COMMENT '设备0电脑 1手机',
  `editor` char(50) DEFAULT NULL,
  `uid` int(11) DEFAULT '0' COMMENT '用户iD',
  `did` int(11) DEFAULT '0' COMMENT '代理商品iD',
  `username` varchar(50) DEFAULT NULL COMMENT '用户姓名',
  `sex` tinyint(4) DEFAULT '0' COMMENT '性别0女  1男',
  `aid` int(11) DEFAULT '0' COMMENT '管理员iD',
  `reply` varchar(255) DEFAULT NULL COMMENT '回复内容',
  `replytime` int(11) DEFAULT NULL COMMENT '回复时间',
  `state` int(11) NOT NULL DEFAULT '0' COMMENT '信息状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `zzcms_dlmessage`
--

INSERT INTO `zzcms_dlmessage` (`id`, `phone`, `title`, `content`, `sendtime`, `up_device`, `editor`, `uid`, `did`, `username`, `sex`, `aid`, `reply`, `replytime`, `state`) VALUES
(1, 15118888844, NULL, '范德萨范德萨发的说法', 1571629413, 1, NULL, 1, 32, '辅导费', 1, 0, NULL, NULL, 0),
(2, 15118888844, NULL, '范德萨范德萨发的说法fdafdsafdsafd', 1571629413, 0, NULL, 1, 33, '辅导费', 1, 0, NULL, NULL, 3),
(7, 18335903534, NULL, '我想了解小外卖项目的开店详情与方案', 1571813739, 1, NULL, 4, 33, '测试', 1, 0, NULL, NULL, 0),
(6, 18335903534, NULL, '测试版内容', 1571813138, 1, NULL, 4, 31, '测试', 1, 0, NULL, NULL, 0),
(8, 15118888844, NULL, '范德萨范德萨发的说法', 1571903741, 1, NULL, 4, 32, '辅导费', 1, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_dltag`
--

CREATE TABLE IF NOT EXISTS `zzcms_dltag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL COMMENT '标签名',
  `xuhao` int(11) DEFAULT '0' COMMENT '排序',
  `list` varchar(30) DEFAULT NULL,
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='代理商标签' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `zzcms_dltag`
--

INSERT INTO `zzcms_dltag` (`id`, `title`, `xuhao`, `list`, `update_time`) VALUES
(1, '装修指导', 0, NULL, 1571296787),
(2, '带店培训', 5, NULL, 1571296836),
(3, '选址培训', 3, NULL, 1571296990);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_footprint`
--

CREATE TABLE IF NOT EXISTS `zzcms_footprint` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL COMMENT 'dl ID',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `up_device` tinyint(4) NOT NULL DEFAULT '0' COMMENT '设备0电脑 1手机',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户足迹' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `zzcms_footprint`
--

INSERT INTO `zzcms_footprint` (`id`, `did`, `uid`, `up_device`, `add_time`) VALUES
(17, 34, 4, 1, 1571903775),
(16, 29, 4, 1, 1571821437),
(15, 32, 4, 1, 1571821392),
(14, 35, 4, 1, 1571884525),
(13, 33, 1, 1, 1571817790),
(12, 34, 1, 1, 1571817805),
(11, 33, 4, 1, 1571885897),
(8, 34, 2, 1, 1571725025),
(10, 31, 4, 1, 1571882892);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_guestbook`
--

CREATE TABLE IF NOT EXISTS `zzcms_guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL,
  `content` longtext,
  `sendtime` datetime DEFAULT NULL,
  `linkmen` char(50) DEFAULT NULL,
  `phone` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `saver` char(50) DEFAULT NULL,
  `looked` tinyint(4) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_help`
--

CREATE TABLE IF NOT EXISTS `zzcms_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classid` int(11) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `content` longtext,
  `img` char(255) DEFAULT NULL,
  `elite` tinyint(4) DEFAULT '0',
  `sendtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_job`
--

CREATE TABLE IF NOT EXISTS `zzcms_job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT '0',
  `bigclassname` char(50) DEFAULT NULL,
  `smallclassid` int(11) DEFAULT '0',
  `smallclassname` char(50) DEFAULT NULL,
  `jobname` char(50) DEFAULT NULL,
  `province` char(50) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `xiancheng` char(50) DEFAULT NULL,
  `sm` varchar(1000) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `comane` char(50) DEFAULT NULL,
  `userid` int(11) DEFAULT '0',
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_jobclass`
--

CREATE TABLE IF NOT EXISTS `zzcms_jobclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `parentid` int(11) DEFAULT '0',
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT NULL,
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `xuhao` int(11) DEFAULT '0',
  `isshow` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_licence`
--

CREATE TABLE IF NOT EXISTS `zzcms_licence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL,
  `img` char(255) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `passed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_link`
--

CREATE TABLE IF NOT EXISTS `zzcms_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT '0',
  `sitename` char(50) DEFAULT NULL,
  `url` char(255) DEFAULT NULL,
  `content` char(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `logo` char(255) DEFAULT NULL,
  `elite` tinyint(4) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_linkclass`
--

CREATE TABLE IF NOT EXISTS `zzcms_linkclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `xuhao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `zzcms_linkclass`
--

INSERT INTO `zzcms_linkclass` (`classid`, `classname`, `xuhao`) VALUES
(1, '合作网站', 0),
(2, '友链网站', 0);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_login_times`
--

CREATE TABLE IF NOT EXISTS `zzcms_login_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` char(50) DEFAULT NULL,
  `count` int(11) DEFAULT '0',
  `sendtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_looked_dls`
--

CREATE TABLE IF NOT EXISTS `zzcms_looked_dls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dlsid` int(11) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_looked_dls_number_oneday`
--

CREATE TABLE IF NOT EXISTS `zzcms_looked_dls_number_oneday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `looked_dls_number_oneday` int(11) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_main`
--

CREATE TABLE IF NOT EXISTS `zzcms_main` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `proname` char(50) DEFAULT NULL,
  `link` char(255) DEFAULT NULL,
  `szm` char(100) DEFAULT NULL,
  `prouse` char(255) DEFAULT NULL,
  `procompany` char(50) DEFAULT NULL,
  `tz` char(25) DEFAULT NULL,
  `sm` text,
  `xuhao` int(4) DEFAULT NULL,
  `bigclassid` tinyint(4) DEFAULT '0',
  `smallclassid` tinyint(4) DEFAULT '0',
  `smallclassids` char(50) DEFAULT NULL,
  `img` char(255) DEFAULT NULL,
  `flv` char(255) DEFAULT NULL,
  `province` char(50) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `xiancheng` char(50) DEFAULT NULL,
  `province_user` char(50) DEFAULT NULL,
  `city_user` char(50) DEFAULT NULL,
  `xiancheng_user` char(50) DEFAULT NULL,
  `zc` char(255) DEFAULT NULL,
  `yq` char(255) DEFAULT NULL,
  `other` char(255) DEFAULT NULL,
  `shuxing_value` char(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `timefororder` char(50) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `elitestarttime` datetime DEFAULT NULL,
  `eliteendtime` datetime DEFAULT NULL,
  `title` char(255) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `refresh` int(11) DEFAULT '0',
  `hit` int(11) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `userid` int(11) DEFAULT '0',
  `comane` char(255) DEFAULT NULL,
  `qq` char(50) DEFAULT NULL,
  `groupid` int(11) DEFAULT '0',
  `renzheng` tinyint(4) DEFAULT '0',
  `ppid` int(11) DEFAULT '0',
  `gjzpm` tinyint(4) DEFAULT '0',
  `tag` char(255) DEFAULT NULL,
  `skin` char(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `province` (`province`,`city`,`xiancheng`),
  KEY `bigclassid` (`bigclassid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_message`
--

CREATE TABLE IF NOT EXISTS `zzcms_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(50) DEFAULT NULL,
  `content` char(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `sendto` char(50) NOT NULL,
  `looked` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_msg`
--

CREATE TABLE IF NOT EXISTS `zzcms_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) NOT NULL,
  `elite` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_pay`
--

CREATE TABLE IF NOT EXISTS `zzcms_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) DEFAULT NULL,
  `dowhat` char(50) DEFAULT NULL,
  `RMB` char(50) DEFAULT '0',
  `mark` char(255) DEFAULT NULL,
  `sendtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `zzcms_pay`
--

INSERT INTO `zzcms_pay` (`id`, `username`, `dowhat`, `RMB`, `mark`, `sendtime`) VALUES
(1, '123456', '每天登录用送积分', '+10', '', '2019-10-16 11:23:00'),
(2, '123456', '每天登录用户中心送积分', '+10', '', '2019-10-17 17:44:22'),
(3, '123456', '每天登录用户中心送积分', '+10', '', '2019-10-22 16:48:38'),
(4, '123456', '每天登录用送积分', '+10', '', '2019-10-23 15:44:08');

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_pinglun`
--

CREATE TABLE IF NOT EXISTS `zzcms_pinglun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `about` int(11) DEFAULT '0',
  `pid` int(11) DEFAULT '0' COMMENT '父评论id',
  `content` char(255) DEFAULT NULL,
  `face` char(50) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0' COMMENT '用户id',
  `up_device` tinyint(4) DEFAULT '0' COMMENT '0电脑 1手机',
  `ip` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `zzcms_pinglun`
--

INSERT INTO `zzcms_pinglun` (`id`, `about`, `pid`, `content`, `face`, `username`, `user_id`, `up_device`, `ip`, `sendtime`, `passed`) VALUES
(1, 2, 0, '发打发的撒放到范德萨', '', '未登录用户', NULL, 0, '127.0.0.1', '2019-10-16 11:26:09', 1),
(2, 5, 0, '文章品论', '', '未登录用户', 4, 0, '127.0.0.1', '2019-10-21 15:54:22', 1),
(3, 5, 2, '文章品论fdsaf', '', '未登录用户', 4, 0, '127.0.0.1', '2019-10-21 15:54:22', 1),
(4, 5, 3, '文章品论fdsafsfdaf', '', '未登录用户', 2, 0, '127.0.0.1', '2019-10-21 15:54:22', 1),
(5, 5, 0, '文章品论ffffff', '', '未登录用户', 4, 0, '127.0.0.1', '2019-10-21 15:54:22', 1),
(6, 16, 0, 'fdsafdsafdsaf', NULL, NULL, 2, 1, NULL, '2019-10-22 10:44:38', 0),
(7, 2, 0, 'fdsafdsafdsaf', NULL, NULL, 2, 1, NULL, '2019-10-22 10:44:54', 0),
(8, 2, 0, 'fdsafdsafdsaf', NULL, NULL, 2, 1, '127.0.0.1', '2019-10-22 10:49:31', 0),
(9, 17, 0, '说点什么吧', NULL, NULL, 4, 1, '192.168.31.196', '2019-10-23 18:34:52', 1),
(10, 17, 0, '再提交一条', NULL, NULL, 4, 1, '192.168.31.196', '2019-10-23 18:35:54', 1),
(11, 17, 0, '为什么呢，不弹提示框', NULL, NULL, 4, 1, '192.168.31.196', '2019-10-23 19:29:14', 0),
(12, 17, 0, '还要审核，渣渣', NULL, NULL, 4, 1, '192.168.31.196', '2019-10-23 19:31:15', 0);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_plzan`
--

CREATE TABLE IF NOT EXISTS `zzcms_plzan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '评论 ID',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `up_device` tinyint(4) NOT NULL DEFAULT '0' COMMENT '设备0电脑 1手机',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户评论点赞' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `zzcms_plzan`
--

INSERT INTO `zzcms_plzan` (`id`, `pid`, `uid`, `up_device`, `add_time`) VALUES
(3, 3, 1, 1, 1571650384),
(4, 2, 1, 1, 1571650406);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_pp`
--

CREATE TABLE IF NOT EXISTS `zzcms_pp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ppname` char(255) DEFAULT NULL,
  `bigclassid` tinyint(4) DEFAULT '0',
  `smallclassid` tinyint(4) DEFAULT '0',
  `sm` longtext,
  `img` char(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `comane` char(50) DEFAULT NULL,
  `userid` int(11) DEFAULT '0',
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bigclassid` (`bigclassid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_sms`
--

CREATE TABLE IF NOT EXISTS `zzcms_sms` (
  `phone` bigint(20) NOT NULL,
  `code` int(11) NOT NULL,
  `add_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `zzcms_sms`
--

INSERT INTO `zzcms_sms` (`phone`, `code`, `add_time`) VALUES
(15118955544, 429407, 1571709911),
(15118955543, 695824, 1571904138);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_special`
--

CREATE TABLE IF NOT EXISTS `zzcms_special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT NULL,
  `bigclassname` char(50) DEFAULT NULL,
  `smallclassid` int(11) DEFAULT NULL,
  `smallclassname` char(50) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `link` char(255) DEFAULT NULL,
  `laiyuan` char(50) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `content` longtext,
  `img` char(255) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  `groupid` int(11) DEFAULT '1',
  `jifen` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bigclassid` (`bigclassid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_specialclass`
--

CREATE TABLE IF NOT EXISTS `zzcms_specialclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT NULL,
  `parentid` int(11) DEFAULT '0',
  `xuhao` int(11) DEFAULT '0',
  `isshow` tinyint(4) DEFAULT '1',
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `zzcms_specialclass`
--

INSERT INTO `zzcms_specialclass` (`classid`, `classname`, `classzm`, `img`, `skin`, `parentid`, `xuhao`, `isshow`, `title`, `keyword`, `description`) VALUES
(1, '2015广西药交会', '', '', '', 0, 0, 1, '', '', ''),
(2, '访谈', '', '', '', 1, 1, 1, '', '', ''),
(3, '名企直击', '', '', '', 1, 1, 1, '', '', ''),
(4, '展会现场', '', '', '', 1, 1, 1, '', '', ''),
(5, '展会简介', '', '', '', 1, 1, 1, '', '', ''),
(6, '大背景图', '', '', '', 1, 1, 1, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_tagzs`
--

CREATE TABLE IF NOT EXISTS `zzcms_tagzs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` char(50) DEFAULT NULL,
  `url` char(50) DEFAULT NULL,
  `xuhao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_tagzx`
--

CREATE TABLE IF NOT EXISTS `zzcms_tagzx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xuhao` int(11) DEFAULT '0',
  `keyword` char(50) DEFAULT NULL,
  `url` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_textadv`
--

CREATE TABLE IF NOT EXISTS `zzcms_textadv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adv` char(50) DEFAULT NULL,
  `company` char(50) NOT NULL,
  `advlink` char(50) DEFAULT NULL,
  `img` char(255) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `gxsj` datetime DEFAULT NULL,
  `newsid` int(11) NOT NULL DEFAULT '0',
  `passed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `adv` (`adv`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_user`
--

CREATE TABLE IF NOT EXISTS `zzcms_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `passwordtrue` char(50) DEFAULT NULL,
  `qqid` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `sex` char(50) DEFAULT NULL,
  `comane` char(50) DEFAULT NULL,
  `content` longtext,
  `bigclassid` int(11) DEFAULT '0',
  `smallclassid` int(11) DEFAULT '0',
  `province` char(50) DEFAULT NULL,
  `city` char(50) DEFAULT NULL,
  `xiancheng` char(50) DEFAULT NULL,
  `img` char(255) DEFAULT NULL,
  `flv` char(255) DEFAULT NULL,
  `address` char(100) DEFAULT NULL,
  `somane` char(50) DEFAULT NULL,
  `diyname` varchar(30) DEFAULT NULL COMMENT '用户昵称',
  `phone` char(50) DEFAULT NULL,
  `mobile` char(50) DEFAULT NULL,
  `fox` char(50) DEFAULT NULL,
  `qq` char(50) DEFAULT NULL,
  `regdate` datetime DEFAULT NULL,
  `loginip` char(50) DEFAULT NULL,
  `logins` int(11) NOT NULL DEFAULT '0',
  `homepage` char(50) DEFAULT NULL,
  `lastlogintime` datetime DEFAULT NULL,
  `lockuser` tinyint(4) NOT NULL DEFAULT '0',
  `groupid` int(11) NOT NULL DEFAULT '1',
  `totleRMB` int(11) NOT NULL DEFAULT '0',
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `showloginip` char(50) DEFAULT NULL,
  `showlogintime` datetime DEFAULT NULL,
  `elite` tinyint(4) NOT NULL DEFAULT '0',
  `renzheng` tinyint(4) NOT NULL DEFAULT '0',
  `usersf` char(20) DEFAULT NULL,
  `passed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `zzcms_user`
--

INSERT INTO `zzcms_user` (`id`, `username`, `password`, `passwordtrue`, `qqid`, `email`, `sex`, `comane`, `content`, `bigclassid`, `smallclassid`, `province`, `city`, `xiancheng`, `img`, `flv`, `address`, `somane`, `diyname`, `phone`, `mobile`, `fox`, `qq`, `regdate`, `loginip`, `logins`, `homepage`, `lastlogintime`, `lockuser`, `groupid`, `totleRMB`, `startdate`, `enddate`, `showloginip`, `showlogintime`, `elite`, `renzheng`, `usersf`, `passed`) VALUES
(1, '123456', 'e10adc3949ba59abbe56e057f20f883e', '123456', '', '123@123.com', '1', '', '', 0, 0, '', '', '', '', '', '', '真名1', '123213', '15118955544', '', '', '', '2019-10-23 15:48:44', '127.0.0.1', 5, '', '2019-10-23 19:19:50', 0, 1, 90, NULL, NULL, '127.0.0.1', '2019-10-23 15:44:18', 0, 0, '个人', 1),
(2, 'zhangsan', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, NULL, '0', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15118955543', NULL, NULL, NULL, '2019-10-22 16:47:08', NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, 0),
(3, 'zhangsan1', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, 'fdsafd@wq.com', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'zhangsan', NULL, '15118888888', NULL, NULL, NULL, '2019-10-22 16:47:08', NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '个人', 0),
(4, 'ceshi', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, '798812201@qq.com', '1', NULL, NULL, 0, 0, NULL, NULL, NULL, '/uploadfiles/2019-10/20191016095442598.png', NULL, NULL, '真的大佬', '一个大佬', '18335903534', NULL, NULL, NULL, '2019-10-22 16:40:15', NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, '2019-10-24 16:04:53', 0, 0, '个人', 0),
(6, 'lisi', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, 'fdsafd@wq.com', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'zhangsan', '用户1006', '15118888889', NULL, NULL, NULL, '2019-10-22 16:47:08', NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '个人', 0),
(7, 'lisi1', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, 'fdsafd@wq.com', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'zhangsan', '用户101007', '15118888887', NULL, NULL, NULL, '2019-10-22 16:47:08', NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '个人', 0),
(8, 'wangwu', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, 'fdsafd@wq.com', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'zhangsan', '用户101008', '15118888886', NULL, NULL, NULL, '2019-10-22 16:47:08', NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, '个人', 0);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_userclass`
--

CREATE TABLE IF NOT EXISTS `zzcms_userclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) DEFAULT '0',
  `classname` char(50) NOT NULL,
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT NULL,
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `isshow` tinyint(4) DEFAULT '0',
  `xuhao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `zzcms_userclass`
--

INSERT INTO `zzcms_userclass` (`classid`, `parentid`, `classname`, `classzm`, `img`, `skin`, `title`, `keyword`, `description`, `isshow`, `xuhao`) VALUES
(1, 0, '生产单位', '', '', '', '', '', '', 1, 0),
(2, 0, '经销单位', '', '', '', '', '', '', 1, 0),
(4, 0, '展会承办单位', '', '', '', '', '', '', 1, 0),
(5, 0, '其它相关行业', '', '', '', '', '', '', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_usercollect`
--

CREATE TABLE IF NOT EXISTS `zzcms_usercollect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL COMMENT 'dl ID',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `up_device` tinyint(4) NOT NULL DEFAULT '0' COMMENT '设备0电脑 1手机',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户收藏' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `zzcms_usercollect`
--

INSERT INTO `zzcms_usercollect` (`id`, `did`, `uid`, `up_device`, `add_time`) VALUES
(3, 31, 1, 1, 1571389956),
(4, 30, 1, 1, 1571390393),
(5, 32, 1, 1, 1571639518),
(18, 35, 4, 1, 1571821184),
(9, 8, 4, 1, 1571811355),
(13, 31, 4, 1, 1571812483),
(21, 23, 4, 1, 1571903754),
(17, 32, 4, 1, 1571821130);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_userdomain`
--

CREATE TABLE IF NOT EXISTS `zzcms_userdomain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) DEFAULT NULL,
  `domain` char(50) DEFAULT NULL,
  `passed` tinyint(4) DEFAULT '0',
  `del` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_usergroup`
--

CREATE TABLE IF NOT EXISTS `zzcms_usergroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL DEFAULT '1',
  `groupname` char(50) NOT NULL,
  `grouppic` char(50) NOT NULL,
  `RMB` int(11) NOT NULL DEFAULT '0',
  `config` varchar(1000) NOT NULL DEFAULT '0',
  `looked_dls_number_oneday` int(11) NOT NULL DEFAULT '0',
  `refresh_number` int(11) NOT NULL DEFAULT '0',
  `addinfo_number` int(11) NOT NULL DEFAULT '0',
  `addinfototle_number` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `zzcms_usergroup`
--

INSERT INTO `zzcms_usergroup` (`id`, `groupid`, `groupname`, `grouppic`, `RMB`, `config`, `looked_dls_number_oneday`, `refresh_number`, `addinfo_number`, `addinfototle_number`) VALUES
(1, 1, '普通会员', '/image/level1.gif', 0, 'showad_inzt', 10, 1, 50, 100),
(2, 2, 'vip会员', '/image/level2.gif', 1999, 'look_dls_data#look_dls_liuyan', 100, 3, 100, 500),
(3, 3, '高级会员', '/image/level3.gif', 2999, 'look_dls_data#look_dls_liuyan', 999, 999, 999, 999);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_usermessage`
--

CREATE TABLE IF NOT EXISTS `zzcms_usermessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` bigint(20) DEFAULT NULL COMMENT '手机号',
  `title` char(50) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `uid` int(11) DEFAULT '0' COMMENT '用户iD',
  `username` varchar(50) DEFAULT NULL COMMENT '用户姓名',
  `reply` varchar(255) DEFAULT NULL,
  `replytime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `zzcms_usermessage`
--

INSERT INTO `zzcms_usermessage` (`id`, `phone`, `title`, `content`, `sendtime`, `editor`, `uid`, `username`, `reply`, `replytime`) VALUES
(1, NULL, NULL, '好激动 不知道说什么', '2019-10-16 11:46:46', '123456', 1, NULL, '我的天', '2019-10-16 11:47:09'),
(2, NULL, NULL, '再来一条', '2019-10-16 11:48:27', '123456', 1, NULL, '还来', '2019-10-16 11:48:43'),
(3, 15118855544, NULL, 'fdsafdsafda', NULL, NULL, 1, NULL, NULL, NULL),
(4, 15118855544, NULL, 'fdsafdsafda', '0000-00-00 00:00:00', NULL, 1, '1234444', NULL, NULL),
(5, 15118855544, NULL, 'fdsafdsafda', '2019-10-17 20:01:30', NULL, 1, '1234444', NULL, NULL),
(6, 15118855544, NULL, 'fdsafdsafda', '2019-10-24 16:03:18', NULL, 4, '1234444', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_usernoreg`
--

CREATE TABLE IF NOT EXISTS `zzcms_usernoreg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usersf` char(50) DEFAULT NULL,
  `username` char(50) NOT NULL,
  `password` char(50) DEFAULT NULL,
  `comane` char(50) DEFAULT NULL,
  `kind` int(11) NOT NULL DEFAULT '0',
  `somane` char(50) DEFAULT NULL,
  `phone` char(50) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `checkcode` char(50) DEFAULT NULL,
  `regdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_usersetting`
--

CREATE TABLE IF NOT EXISTS `zzcms_usersetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT '1',
  `skin_mobile` char(50) DEFAULT '1',
  `tongji` char(255) DEFAULT NULL,
  `baidu_map` char(50) DEFAULT NULL,
  `mobile` char(50) DEFAULT NULL,
  `daohang` char(50) DEFAULT NULL,
  `bannerbg` char(50) DEFAULT NULL,
  `bannerheight` int(11) NOT NULL DEFAULT '160',
  `comanestyle` char(50) DEFAULT NULL,
  `comanecolor` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_wangkan`
--

CREATE TABLE IF NOT EXISTS `zzcms_wangkan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `content` longtext,
  `img` char(255) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_wangkanclass`
--

CREATE TABLE IF NOT EXISTS `zzcms_wangkanclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `xuhao` int(11) DEFAULT '0',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_zh`
--

CREATE TABLE IF NOT EXISTS `zzcms_zh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `address` char(100) DEFAULT NULL,
  `timestart` datetime DEFAULT NULL,
  `timeend` datetime DEFAULT NULL,
  `content` longtext,
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_zhclass`
--

CREATE TABLE IF NOT EXISTS `zzcms_zhclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `xuhao` int(11) DEFAULT '0',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_zsclass`
--

CREATE TABLE IF NOT EXISTS `zzcms_zsclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) NOT NULL DEFAULT '0',
  `classname` char(50) NOT NULL,
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) NOT NULL DEFAULT '0',
  `skin` char(50) DEFAULT NULL,
  `xuhao` int(11) NOT NULL DEFAULT '0',
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `isshow` tinyint(4) NOT NULL DEFAULT '1',
  `showindex` tinyint(4) DEFAULT '0' COMMENT '首页导航显示',
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `zzcms_zsclass`
--

INSERT INTO `zzcms_zsclass` (`classid`, `parentid`, `classname`, `classzm`, `img`, `skin`, `xuhao`, `title`, `keyword`, `description`, `isshow`, `showindex`) VALUES
(1, 0, '餐饮', 'canyin', '', 'zs_class.htm|zs_list.htm', 0, '餐饮', '餐饮', '餐饮', 1, 1),
(2, 0, '教育', 'jiaoyu', '/uploadfiles/2019-10/20191016084259524.png', 'zs_class.htm|zs_list.htm', 0, '教育', '教育', '教育', 1, 1),
(3, 1, '小吃', 'xiaochi', '/uploadfiles/2019-10/20191016103443573.png', NULL, 4, '小吃', '小吃', '小吃', 1, 1),
(4, 1, '快餐', 'kuaican', '/uploadfiles/2019-10/20191016103222746.png', NULL, 0, '快餐', '快餐', '快餐', 1, 1),
(5, 0, '美容', 'meirong', '/uploadfiles/2019-10/20191016103726300.png', 'zs_class.htm|zs_list.htm', 0, '美容', '美容', '美容', 1, 1),
(6, 5, '化妆', 'huazhuang', '/uploadfiles/2019-10/20191016103626157.png', NULL, 0, '化妆', '化妆', '化妆', 1, 1),
(7, 5, '保养', 'baoyang', '/uploadfiles/2019-10/20191016103652697.png', NULL, 0, '保养', '保养', '保养', 1, 1),
(8, 2, '机器人', 'jiqiren', '/uploadfiles/2019-10/20191016103455697.png', NULL, 0, '机器人', '机器人', '机器人', 1, 1),
(9, 2, '早教', 'zaojiao', '/uploadfiles/2019-10/20191016103556712.png', NULL, 0, '早教', '早教', '早教', 1, 0),
(10, 0, '五金', 'wujin', '/uploadfiles/2019-10/20191016083855443.png', 'zs_class.htm|zs_list.htm', 5, '五金', '五金', '五金', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_ztad`
--

CREATE TABLE IF NOT EXISTS `zzcms_ztad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classname` char(50) DEFAULT NULL,
  `title` char(50) DEFAULT NULL,
  `link` char(255) DEFAULT NULL,
  `img` char(255) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `passed` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_zx`
--

CREATE TABLE IF NOT EXISTS `zzcms_zx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bigclassid` int(11) DEFAULT NULL,
  `bigclassname` char(50) DEFAULT NULL,
  `smallclassid` int(11) DEFAULT NULL,
  `smallclassname` char(50) DEFAULT NULL,
  `did` int(11) DEFAULT '0' COMMENT '关联代理产品id',
  `title` char(50) DEFAULT NULL,
  `link` char(255) DEFAULT NULL,
  `laiyuan` char(50) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  `content` longtext,
  `img` char(255) DEFAULT NULL,
  `editor` char(50) DEFAULT NULL,
  `sendtime` datetime DEFAULT NULL,
  `hit` int(11) DEFAULT '0',
  `passed` tinyint(4) DEFAULT '0',
  `elite` tinyint(4) DEFAULT '0',
  `groupid` int(11) DEFAULT '1',
  `jifen` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `bigclassid` (`bigclassid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `zzcms_zx`
--

INSERT INTO `zzcms_zx` (`id`, `bigclassid`, `bigclassname`, `smallclassid`, `smallclassname`, `did`, `title`, `link`, `laiyuan`, `keywords`, `description`, `content`, `img`, `editor`, `sendtime`, `hit`, `passed`, `elite`, `groupid`, `jifen`) VALUES
(8, 1, '加盟资讯', 2, '加盟攻略', 0, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', NULL, '2019-10-16 17:54:59', 52, 1, 0, 0, 0),
(6, 1, '加盟资讯', 2, '加盟攻略', 0, 'fdddddd', '', '娃哈哈', 'fdddddd', '', 'fdsafdsadsfdsagsafdsaf fdsa fd afds afdsasdfdafdsasf&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191022124715141.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;', '/uploadfiles/2019-10/20191022124715141.png', '', '2019-10-23 18:17:50', 0, 1, 0, 0, 0),
(7, 1, '加盟资讯', 2, '加盟攻略', 0, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', NULL, '2019-10-16 17:54:59', 50, 1, 0, 0, 0),
(4, 1, '加盟资讯', 2, '加盟攻略', 0, '又来一篇文章', '', '范德萨范德萨', '不知道有什么东西', '', '给答复的安抚打发打放到爱上范德萨', '', NULL, '2019-10-17 10:30:36', 90, 1, 30, 0, 0),
(5, 1, '加盟资讯', 2, '加盟攻略', 0, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', NULL, '2019-10-16 17:54:59', 52, 1, 0, 0, 0),
(19, 1, '加盟资讯', 2, '加盟攻略', 0, 'gggggggg', '', 'zzcms', 'gggggggg', '', '&lt;p&gt;\r\n	&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191023111939577.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;fdsagfdsfdsafdsafdsa&lt;/p&gt;', '/uploadfiles/2019-10/20191023111939577.png', '123456', '2019-10-23 19:19:46', 0, 0, 0, 0, 0),
(9, 1, '加盟资讯', 2, '加盟攻略', 0, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', NULL, '2019-10-16 17:54:59', 72, 1, 0, 0, 0),
(10, 1, '加盟资讯', 2, '加盟攻略', 0, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', NULL, '2019-10-16 17:54:59', 50, 1, 0, 0, 0),
(11, 1, '加盟资讯', 2, '加盟攻略', 0, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', NULL, '2019-10-16 17:54:59', 50, 1, 0, 0, 0),
(12, 1, '加盟资讯', 2, '加盟攻略', 0, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', NULL, '2019-10-16 17:54:59', 50, 1, 0, 0, 0),
(13, 1, '加盟资讯', 2, '加盟攻略', 0, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', NULL, '2019-10-16 17:54:59', 50, 1, 0, 0, 0),
(14, 1, '加盟资讯', 2, '加盟攻略', 0, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', NULL, '2019-10-16 17:54:59', 50, 1, 0, 0, 0),
(15, 1, '加盟资讯', 2, '加盟攻略', 0, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', NULL, '2019-10-16 17:54:59', 51, 1, 0, 0, 0),
(16, 1, '加盟资讯', 2, '加盟攻略', 34, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', NULL, '2019-10-23 10:56:31', 52, 1, 0, 0, 0),
(17, 3, '项目精选', 4, '项目精选', 34, '再来一篇文章', '', '娃哈哈', '万亿市场，超多受众，赚钱的机会来了！', '', '范德萨范德萨范德萨&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095442598.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;af发大水发大厦范德萨发打放&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191016095450842.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;到sa沙发范德萨发打算放到发', '/uploadfiles/2019-10/20191016095442598.png', '又一个蜘蛛侠', '2019-10-23 18:15:47', 117, 1, 68, 0, 0),
(18, 3, '项目精选', 4, '项目精选', 34, '再来一篇文章', '123', '娃哈哈1', '万亿市场，超多受众，赚钱的机会来了！', '1112', 'fasfdsafdsaf&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191023014544587.jpg&quot; style=&quot;width: 1081px; height: 1080px;&quot; /&gt;&lt;br /&gt;\r\ndfasfdsa fdsa fd saf dsa fd sa&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191023014605880.png&quot; style=&quot;width: 70px; height: 70px;&quot; /&gt;fdsaf dsaf ds af&lt;br /&gt;\r\n&lt;img alt=&quot;&quot; src=&quot;/uploadfiles/2019-10/20191023014619195.jpg&quot; style=&quot;width: 1081px; height: 1080px;&quot; /&gt;&lt;br /&gt;\r\nfdsafdsa fdsa fd saf&lt;br /&gt;', '/uploadfiles/2019-10/20191016095442598.png', '蜘蛛侠', '2019-10-23 18:18:36', 57, 1, 66, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_zxclass`
--

CREATE TABLE IF NOT EXISTS `zzcms_zxclass` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(11) DEFAULT '0',
  `classname` char(50) DEFAULT NULL,
  `classzm` char(50) DEFAULT NULL,
  `img` char(50) DEFAULT NULL,
  `skin` char(50) DEFAULT NULL,
  `xuhao` int(11) DEFAULT '0',
  `isshow` tinyint(4) DEFAULT '1',
  `title` char(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL,
  `description` char(255) DEFAULT NULL,
  PRIMARY KEY (`classid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `zzcms_zxclass`
--

INSERT INTO `zzcms_zxclass` (`classid`, `parentid`, `classname`, `classzm`, `img`, `skin`, `xuhao`, `isshow`, `title`, `keyword`, `description`) VALUES
(1, 0, '加盟资讯', 'jiamengzixun', '', 'zx_class.htm|zx_list.htm', 0, 1, '加盟资讯', '加盟资讯', '加盟资讯'),
(2, 1, '加盟攻略', NULL, NULL, NULL, 0, 1, NULL, NULL, NULL),
(3, 0, '项目精选', 'xiangmujingxuan', NULL, NULL, 0, 1, NULL, NULL, NULL),
(4, 3, '项目精选', 'xiangmujingxuan11', '', NULL, 0, 1, '项目精选11', '项目精选11', '项目精选11');

-- --------------------------------------------------------

--
-- 表的结构 `zzcms_zxcollect`
--

CREATE TABLE IF NOT EXISTS `zzcms_zxcollect` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zid` int(11) NOT NULL COMMENT 'zx ID',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `up_device` tinyint(4) NOT NULL DEFAULT '0' COMMENT '设备0电脑 1手机',
  `add_time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='资讯收藏' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `zzcms_zxcollect`
--

INSERT INTO `zzcms_zxcollect` (`id`, `zid`, `uid`, `up_device`, `add_time`) VALUES
(2, 5, 1, 1, 1571645679),
(3, 4, 1, 1, 1571645688),
(6, 2, 1, 1, 1571645749),
(7, 18, 1, 1, 1571645749),
(11, 17, 4, 1, 1571830074);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
