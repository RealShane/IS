-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-04-08 09:23:49
-- 服务器版本： 5.7.26-log
-- PHP 版本： 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `shane`
--

-- --------------------------------------------------------

--
-- 表的结构 `api_app_config`
--

CREATE TABLE `api_app_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `key` varchar(255) NOT NULL COMMENT '设置索引',
  `value` text NOT NULL COMMENT '设置',
  `statement` text COMMENT '注释',
  `type` text NOT NULL COMMENT '设置类型',
  `type_name` varchar(255) NOT NULL COMMENT '设置分类名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全局设置';

--
-- 转存表中的数据 `api_app_config`
--

INSERT INTO `api_app_config` (`id`, `key`, `value`, `statement`, `type`, `type_name`, `status`) VALUES
(1, 'EMAIL_HOST', 'smtp.163.com', '邮箱地址', 'EMAIL', '邮箱设置', 1),
(2, 'EMAIL_USERNAME', 'redleafshane@163.com', '邮箱用户名', 'EMAIL', '邮箱设置', 1),
(3, 'EMAIL_PASSWORD', 'XGLEKTLMMDFEAPAF', '邮箱密码', 'EMAIL', '邮箱设置', 1),
(4, 'EMAIL_NAME', 'Shane_noreply', '邮件发送人姓名', 'EMAIL', '邮箱设置', 1),
(5, 'EMAIL_ACTIVE_TITLE', '工学部综合系统--注册激活', '注册激活邮件标题', 'EMAIL', '邮箱设置', 1),
(6, 'EMAIL_ACTIVE_BODY', '<h1>汇华的同学你好：</h1><br>&nbsp;&nbsp;Shane帮你想好了你应该去哪里激活你的账号(尽快激活，24小时有效时间)：https://serv.huihuagongxue.top/api/activeRegister?token=', '注册激活邮件内容HTML版', 'EMAIL', '邮箱设置', 1),
(7, 'EMAIL_ACTIVE_ALT_BODY', '汇华的同学你好：Shane帮你想好了你应该去哪里激活你的账号(尽快激活，24小时有效时间)：https://serv.huihuagongxue.top/api/activeRegister?token=', '注册激活邮件内容纯文字版', 'EMAIL', '邮箱设置', 1),
(8, 'EMAIL_RANDOM_TITLE', '工学部综合系统--登陆验证', '验证码邮件标题', 'EMAIL', '邮箱设置', 1),
(9, 'EMAIL_RANDOM_BODY', '<h1>汇华的同学你好：</h1><br>&nbsp;&nbsp;验证码Shane帮你想好了(尽快登陆，2分钟有效时间)：', '验证码邮件内容HTML版', 'EMAIL', '邮箱设置', 1),
(10, 'EMAIL_RANDOM_ALT_BODY', '汇华的同学你好：验证码Shane帮你想好了(尽快登陆，2分钟有效时间)：', '验证码邮件内容纯文字版', 'EMAIL', '邮箱设置', 1),
(11, 'UPLOAD_TYPE_LIMIT', '[\"jpeg\", \"jpg\", \"png\", \"pdf\", \"doc\"]', '上传文件类型', 'UPLOAD', '上传设置', 1),
(12, 'UPLOAD_SIZE_LIMIT', '2mb', '上传文件大小', 'UPLOAD', '上传设置', 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_class`
--

CREATE TABLE `api_class` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `grade` varchar(255) NOT NULL COMMENT '年级',
  `name` varchar(255) NOT NULL COMMENT '专业班级',
  `major` varchar(255) NOT NULL COMMENT '专业',
  `charge` varchar(255) DEFAULT NULL COMMENT '辅导员',
  `depart_id` int(10) UNSIGNED NOT NULL COMMENT '学部',
  `invite_code` text COMMENT '加入班级代码',
  `join_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '加入班级状态',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='班级';

--
-- 转存表中的数据 `api_class`
--

INSERT INTO `api_class` (`id`, `grade`, `name`, `major`, `charge`, `depart_id`, `invite_code`, `join_status`, `status`) VALUES
(1, '2018', '18级计算机科学与技术一班', '计算机科学与技术', '张洁', 1, 'admi', 1, 1),
(2, '2018', '18级计算机科学与技术二班', '计算机科学与技术', '张洁', 2, 'admin', 1, 1),
(3, '2018', '18级计算机科学与技术三班', '计算机科学与技术', '张洁', 3, NULL, 0, 1),
(4, '2018', '18级通信工程', '通信工程', '张洁', 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_department`
--

CREATE TABLE `api_department` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '学部',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='学部';

--
-- 转存表中的数据 `api_department`
--

INSERT INTO `api_department` (`id`, `name`, `status`) VALUES
(1, '工学部', 1),
(2, '理学部', 1),
(3, '英语学部', 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_dormitory_floor`
--

CREATE TABLE `api_dormitory_floor` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `name` varchar(32) NOT NULL COMMENT '楼名',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='宿舍楼表';

--
-- 转存表中的数据 `api_dormitory_floor`
--

INSERT INTO `api_dormitory_floor` (`id`, `name`, `status`) VALUES
(1, '1号楼', 1),
(2, '2号楼', 1),
(3, '3号楼', 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_dormitory_number`
--

CREATE TABLE `api_dormitory_number` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `number` int(10) UNSIGNED NOT NULL COMMENT '宿舍号',
  `class_id` int(10) UNSIGNED NOT NULL COMMENT '班级id',
  `floor_id` int(11) NOT NULL COMMENT '宿舍楼id',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='宿舍表';

--
-- 转存表中的数据 `api_dormitory_number`
--

INSERT INTO `api_dormitory_number` (`id`, `number`, `class_id`, `floor_id`, `status`) VALUES
(1, 100, 1, 1, 1),
(2, 201, 1, 1, 1),
(3, 102, 3, 2, 1),
(4, 203, 4, 2, 1),
(5, 204, 5, 3, 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_dormitory_score`
--

CREATE TABLE `api_dormitory_score` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `number_id` int(10) UNSIGNED NOT NULL COMMENT '宿舍id',
  `scorer_id` int(10) UNSIGNED NOT NULL COMMENT '打分人id',
  `grade` int(11) NOT NULL COMMENT '成绩',
  `image` text COMMENT '图片',
  `time_index` date NOT NULL COMMENT '时间索引',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='打分表';

--
-- 转存表中的数据 `api_dormitory_score`
--

INSERT INTO `api_dormitory_score` (`id`, `number_id`, `scorer_id`, `grade`, `image`, `time_index`, `create_time`, `update_time`, `status`) VALUES
(1, 2, 6, 9, '/uploads//dormitory/li-11343546/2020/11/18/30455bc917d80df09c02f3ed00e8ec33b6a148c1/QQ图片20200521075116.jpg', '2020-11-18', 1605661950, 1605662628, 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_dormitory_scorer`
--

CREATE TABLE `api_dormitory_scorer` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL COMMENT '打分人的名字',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='打分人';

--
-- 转存表中的数据 `api_dormitory_scorer`
--

INSERT INTO `api_dormitory_scorer` (`id`, `user_id`, `name`, `status`) VALUES
(1, 1, 'li', 1),
(2, 6, 'li', 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_forum_article`
--

CREATE TABLE `api_forum_article` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '文章id',
  `name` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '文章名',
  `modular_id` int(11) NOT NULL COMMENT '模块id',
  `content` text CHARACTER SET utf8 NOT NULL COMMENT '文章内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='论坛文章';

--
-- 转存表中的数据 `api_forum_article`
--

INSERT INTO `api_forum_article` (`id`, `name`, `modular_id`, `content`) VALUES
(1, '诗', 1, '十大撒大双方的规定 广告广告公司能付款少年分开分开是技术开发和动画格式的回复好 ghdkjhkjhkjhgkj.skl过得好快决定环境的风格就是快到家空间房管局的疯狂攻击肯定 决定分开过就是快解放'),
(2, '书', 1, '蜂王浆拉姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐福建文科快快快快快快'),
(3, '礼记', 3, '阿尔姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐姐你才能和人口会恶化几点上课介绍客户尽快恢复快说上的伤口 费附加的空间看几点就是犯贱犯贱');

-- --------------------------------------------------------

--
-- 表的结构 `api_forum_comment`
--

CREATE TABLE `api_forum_comment` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '评论id',
  `content` varchar(255) NOT NULL COMMENT '评论内容',
  `article_id` int(11) NOT NULL COMMENT '文章id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';

--
-- 转存表中的数据 `api_forum_comment`
--

INSERT INTO `api_forum_comment` (`id`, `content`, `article_id`) VALUES
(1, '共和国和结果', 1),
(2, '回国后', 1),
(3, '结果将黄瓜该好好干', 2);

-- --------------------------------------------------------

--
-- 表的结构 `api_forum_modular`
--

CREATE TABLE `api_forum_modular` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '模块id',
  `name` varchar(25) NOT NULL COMMENT '模块名',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '模块状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='论坛板块';

--
-- 转存表中的数据 `api_forum_modular`
--

INSERT INTO `api_forum_modular` (`id`, `name`, `status`) VALUES
(1, 'php板块', 1),
(2, 'java板块', 1),
(3, 'c板块', 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_graduation_config`
--

CREATE TABLE `api_graduation_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `key` varchar(255) NOT NULL COMMENT '设置索引',
  `value` text NOT NULL COMMENT '设置',
  `statement` text COMMENT '注释',
  `type` text NOT NULL COMMENT '设置类型',
  `type_name` varchar(255) NOT NULL COMMENT '设置分类名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='综合测评设置';

--
-- 转存表中的数据 `api_graduation_config`
--

INSERT INTO `api_graduation_config` (`id`, `key`, `value`, `statement`, `type`, `type_name`, `status`) VALUES
(1, 'GRADUATION_SIGN_STATUS', '1', '毕业生去向填写开关', 'GRADUATION', '毕业生去向设置', 1),
(2, 'GRADUATION_DESTINATION_CODE', '[10, 11, 12, 27, 50, 51, 46, 75, 80, 85]', '毕业去向代码', 'GRADUATION', '毕业生去向设置', 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_graduation_destination`
--

CREATE TABLE `api_graduation_destination` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户id',
  `examinee_number` varchar(255) DEFAULT NULL COMMENT '考生号',
  `destination_code` int(11) UNSIGNED DEFAULT NULL COMMENT '毕业去向代码',
  `unit_code` varchar(255) DEFAULT NULL COMMENT '单位组织机构代码',
  `unit_name` varchar(255) DEFAULT NULL COMMENT '单位名称',
  `unit_property_code` int(11) UNSIGNED DEFAULT NULL COMMENT '单位性质代码',
  `unit_location_code` int(11) UNSIGNED DEFAULT NULL COMMENT '单位所在地代码',
  `job_category_code` int(11) UNSIGNED DEFAULT NULL COMMENT '工作职位类别代码',
  `unit_contact` varchar(32) DEFAULT NULL COMMENT '单位联系人',
  `contact_phone` varchar(20) DEFAULT NULL COMMENT '联系人电话',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='毕业生毕业去向表';

--
-- 转存表中的数据 `api_graduation_destination`
--

INSERT INTO `api_graduation_destination` (`id`, `uid`, `examinee_number`, `destination_code`, `unit_code`, `unit_name`, `unit_property_code`, `unit_location_code`, `job_category_code`, `unit_contact`, `contact_phone`, `create_time`, `update_time`, `status`) VALUES
(1, 6, '15131181151992', 46, '91130104MA08Y7FL6L', '河北念初网络科技有限公司', 39, 130104, 13, '邢世恩', '18732952000', 0, 1605491237, 1),
(2, 1, '15131181151991', 2, '91130104MA08Y7FL6L', '河北念初网络科技有限公司', 39, 130104, 13, '邢世恩', '18732952000', 0, 0, 1),
(3, 8, '15131181151992', 2, '91130104MA08Y7FL6L', '河北念初网络科技有限公司', 39, 130104, 13, '邢世恩', '18732952000', 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_source`
--

CREATE TABLE `api_source` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户id',
  `id_number` varchar(255) NOT NULL COMMENT '身份证号',
  `graduate_school` varchar(255) NOT NULL COMMENT '毕业中学',
  `source` varchar(255) NOT NULL COMMENT '生源所在地',
  `poor_code` varchar(10) NOT NULL COMMENT '困难生类别代码',
  `mobile_phone` int(255) UNSIGNED NOT NULL COMMENT '移动电话',
  `qq` int(255) UNSIGNED NOT NULL COMMENT 'qq',
  `home_address` varchar(255) NOT NULL COMMENT '家庭地址',
  `home_phone` int(255) UNSIGNED NOT NULL COMMENT '家庭电话',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='生源库' ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `api_source`
--

INSERT INTO `api_source` (`id`, `uid`, `id_number`, `graduate_school`, `source`, `poor_code`, `mobile_phone`, `qq`, `home_address`, `home_phone`, `create_time`, `update_time`, `status`) VALUES
(1, 6, '131025200001273046', '大城市', '河北省大城县', 'H', 1594968479, 2949794718, '河北省廊坊市大城县', 5783082, 1605842377, 1605842377, 1),
(2, 1, '131025200001273046', '大城市', '河北省大城县', 'H', 1594968479, 2949794718, '河北省廊坊市大城县', 5783082, 1605842377, 1605842377, 1),
(3, 8, '131025200001273046', '大城市', '河北省大城县', 'H', 1594968479, 2949794718, '河北省廊坊市大城县', 5783082, 1605842377, 1605842377, 1),
(4, 3, '131025200001273046', '大城市', '河北省大城县', 'H', 1594968479, 2949794718, '河北省廊坊市大城县', 5783082, 1605842377, 1605842377, 1),
(5, 2, '131025200001273046', '大城市', '河北省大城县', 'H', 1594968479, 2949794718, '河北省廊坊市大城县', 5783082, 1605842377, 1605842377, 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_source_config`
--

CREATE TABLE `api_source_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `key` varchar(255) NOT NULL COMMENT '设置索引',
  `value` text NOT NULL COMMENT '设置',
  `statement` text COMMENT '注释',
  `type` text NOT NULL COMMENT '设置类型',
  `type_name` varchar(255) NOT NULL COMMENT '设置分类名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='综合测评设置';

--
-- 转存表中的数据 `api_source_config`
--

INSERT INTO `api_source_config` (`id`, `key`, `value`, `statement`, `type`, `type_name`, `status`) VALUES
(1, 'SOURCE_SIGN_STATUS', '0', '生源库开关', 'SOURCE', '生源库设置', 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_synthesize_auth`
--

CREATE TABLE `api_synthesize_auth` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='综测权限表';

-- --------------------------------------------------------

--
-- 表的结构 `api_synthesize_config`
--

CREATE TABLE `api_synthesize_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `key` varchar(255) NOT NULL COMMENT '设置索引',
  `value` text NOT NULL COMMENT '设置',
  `statement` text COMMENT '注释',
  `type` text NOT NULL COMMENT '设置类型',
  `type_name` varchar(255) NOT NULL COMMENT '设置分类名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='综合测评设置';

--
-- 转存表中的数据 `api_synthesize_config`
--

INSERT INTO `api_synthesize_config` (`id`, `key`, `value`, `statement`, `type`, `type_name`, `status`) VALUES
(1, 'POOR_SIGN_OPTION', '[\"家庭遭受家庭遭受自然灾害\", \"家庭遭受突发意外事件\", \"家庭成员因残疾\", \"年迈而劳动能力弱情况\", \"家庭适龄就学子女较多\", \"家庭成员失业\", \"家庭欠债\", \"其他\", \"建档立卡家庭\", \"低保\"]', '贫困生认定原因选项', 'POOR', '贫困生设置', 1),
(2, 'POOR_SIGN_STATUS', '1', '贫困生报名开关', 'POOR', '贫困生设置', 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_synthesize_poor_score`
--

CREATE TABLE `api_synthesize_poor_score` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户',
  `target` int(10) UNSIGNED NOT NULL COMMENT '打分/投票目标',
  `mark` text CHARACTER SET utf8 NOT NULL COMMENT '打分/投票',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='贫困生打分/投票';

-- --------------------------------------------------------

--
-- 表的结构 `api_synthesize_poor_sign`
--

CREATE TABLE `api_synthesize_poor_sign` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户',
  `political_outlook` enum('群众','共青团员','中共党员') NOT NULL DEFAULT '群众' COMMENT '政治面貌',
  `id_card_type` enum('居民身份证') NOT NULL DEFAULT '居民身份证' COMMENT '身份证件类型',
  `id_card_number` varchar(255) NOT NULL COMMENT '身份证件号',
  `confirm_level` enum('特殊困难','困难','一般困难') DEFAULT NULL COMMENT '认定困难级别',
  `poor_type_one` tinyint(1) NOT NULL COMMENT '是否建档立卡贫困家庭',
  `poor_type_two` tinyint(1) NOT NULL COMMENT '是否低保家庭',
  `poor_type_three` tinyint(1) NOT NULL COMMENT '是否特困供养学生',
  `poor_type_four` tinyint(1) NOT NULL COMMENT '是否孤残学生',
  `poor_type_five` tinyint(1) NOT NULL COMMENT '是否烈士子女',
  `poor_type_six` tinyint(1) NOT NULL COMMENT '本人是否残疾',
  `poor_type_seven` tinyint(1) NOT NULL COMMENT '是否家庭经济困难残疾人子女',
  `poor_type_eight` tinyint(1) NOT NULL COMMENT '是否单亲家庭',
  `confirm_time` int(10) UNSIGNED DEFAULT NULL COMMENT '认定时间',
  `confirm_reason` text NOT NULL COMMENT '认定原因',
  `confirm_reason_explain` varchar(200) NOT NULL COMMENT '认定原因补充说明',
  `address` text NOT NULL COMMENT '家庭住址',
  `home_phone` varchar(255) NOT NULL COMMENT '家庭电话',
  `contact_phone` varchar(255) NOT NULL COMMENT '联系方式',
  `remark` text COMMENT '备注',
  `supporting_document` text NOT NULL COMMENT '证明文件',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='贫困生报名';

--
-- 转存表中的数据 `api_synthesize_poor_sign`
--

INSERT INTO `api_synthesize_poor_sign` (`id`, `uid`, `political_outlook`, `id_card_type`, `id_card_number`, `confirm_level`, `poor_type_one`, `poor_type_two`, `poor_type_three`, `poor_type_four`, `poor_type_five`, `poor_type_six`, `poor_type_seven`, `poor_type_eight`, `confirm_time`, `confirm_reason`, `confirm_reason_explain`, `address`, `home_phone`, `contact_phone`, `remark`, `supporting_document`, `create_time`, `status`) VALUES
(1, 1, '共青团员', '居民身份证', '130503200001100639', NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '其他', 'test', 'test', '13315926692', '13315926692', '', '/uploads/synthesize/poor/Shane2018510500/2020/09/29/a9ff54ad438006184d41be5fce8151e81d95ca0a/timg.jpg', 1601388754, 1),
(2, 2, '共青团员', '居民身份证', '130503200001100638', NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '其他', 'test', 'test', '13363706633', '13315926693', '', '/uploads/synthesize/poor/Shane2018510500/2020/09/29/a9ff54ad438006184d41be5fce8151e81d95ca0a/timg.jpg', 1601946922, 1),
(3, 3, '共青团员', '居民身份证', '130503200001100637', NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '其他', 'test', 'test', '13363706634', '13315926694', '', '/uploads/synthesize/poor/Shane2018510500/2020/09/29/a9ff54ad438006184d41be5fce8151e81d95ca0a/timg.jpg', 1602052247, 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_user`
--

CREATE TABLE `api_user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `password` char(32) NOT NULL COMMENT '密码',
  `password_salt` varchar(5) NOT NULL COMMENT '密码盐',
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `sex` tinyint(1) NOT NULL DEFAULT '-1' COMMENT '性别',
  `student_id` varchar(255) NOT NULL COMMENT '学号',
  `last_login_ip` varchar(255) NOT NULL COMMENT '上次登录IP',
  `last_login_time` int(10) UNSIGNED NOT NULL COMMENT '上次登录时间',
  `last_login_token` text COMMENT '上次登录Token',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户';

--
-- 转存表中的数据 `api_user`
--

INSERT INTO `api_user` (`id`, `email`, `password`, `password_salt`, `name`, `sex`, `student_id`, `last_login_ip`, `last_login_time`, `last_login_token`, `create_time`, `update_time`, `status`) VALUES
(1, '1109571639@qq.com', '2d1aeb5bc725046ee02ce4bd4df09c5d', '25e8i', '申正', -1, '2018510500', '27.129.225.2', 1612276647, NULL, 1580291145, 1612276647, 1),
(2, '2949794718@qq.com', '9b64308adae3502ecce9e9033edf7feb', 'gtQOu', '李晨颍', -1, '2018510672', '223.104.13.147', 1600861799, NULL, 1599140896, 1600861799, 1),
(3, '1191560545@qq.com', '4e7461a331eb1ecc6190cff015c9ddc8', 'PLkSL', '陈啸', -1, '2017510552', '183.197.118.144', 1580699095, NULL, 1580295440, 1580699095, 1),
(4, '1294922809@qq.com', 'e48ea75934e0fbe9b3fa2d3c07e2bf56', 'rOfKr', '翟鹏程', -1, '2018510453', '221.192.179.180', 1600786576, NULL, 1580312486, 1600786576, 1),
(5, '3047914695@qq.com', '36eedc9ded32b9ddbe43cfbd506f8ac2', 'qyP60', '刘琛', -1, '2018510669', '106.119.4.201', 1600788200, NULL, 1580459945, 1600788200, 1),
(6, '1805866306@qq.com', 'c3929f011b36656b80c568c3b5aa567e', 'aCs0k', '曹玲茹', -1, '2017510465', '27.184.84.107', 1580646896, NULL, 1580546132, 1580646896, 1),
(7, '3614473795@qq.com', '337aca6a6ccace1ddfbeba980ce565cb', 'rohCf', '王冯', -1, '2017510557', '119.249.8.121', 1580625810, NULL, 1580625739, 1580625810, 1),
(8, '1246302217@qq.com', '6b31362d4e4ebda6c63143282cfa2f40', 'xPk3l', '徐萌萌', -1, '2018510707', '110.240.148.169', 1583396901, NULL, 1580648388, 1583396901, 1),
(9, '1738882823@qq.com', 'e3e6048f572c1a2c2ee4b91e5c0ab1ff', '13AhM', '窦于泽', -1, '2019510724', '183.197.244.214', 1584156384, NULL, 1580648401, 1584156384, 1),
(10, '570072571@qq.com', 'b8e710e7da351904cdf838e83f5f2124', 'isrvx', '端欣雨', -1, '2018510768', '223.104.102.33', 1584147502, NULL, 1580649216, 1584147502, 1),
(11, '452275454@qq.com', 'cf5947c90135590be93f585761c3c418', 'pZrET', '王芊芊', -1, '2019510762', '183.199.199.137', 1584146606, NULL, 1580649462, 1584146606, 1),
(12, '1594968479@qq.com', '93d9be86bcbf1820b6277c4e96b5d5b6', 'c388Y', '张俊雨', -1, '2019510611', '223.104.103.179', 1599140611, NULL, 1580650290, 1599140611, 1),
(13, '1018627180@qq.com', '79ef2a1c52cfc1fae75bf3bf6e980a3b', 'kj0ME', '滑婷婷', -1, '2019510641', '183.197.144.148', 1584146751, NULL, 1580651191, 1584146751, 1),
(14, '2350374539@qq.com', 'e22b383a729875f70145f9594ae5329e', 'q23OF', '周君阳', -1, '2019510810', '183.199.128.91', 1584145855, NULL, 1580652839, 1584145855, 1),
(15, '2422364184@qq.com', 'fa05b35cf0eda5e89cecd4d2bcf2e28b', 'SI7Xi', '宋琳琳', -1, '2017510791', '101.26.194.51', 1586417676, NULL, 1580737604, 1586417676, 1),
(16, '1131919670@qq.com', 'a793b9533aab3ead424e9251c6171c52', '0cQhS', '袁晓萌', -1, '2017510781', '183.199.145.207', 1588154016, NULL, 1580737705, 1588154016, 1),
(17, '1312248127@qq.com', '09b25a5abf8733a328df69884746d71f', 'W3AGv', '王晓坤', -1, '2017510809', '60.5.33.204', 1588866013, NULL, 1580739222, 1588866013, 1),
(18, '1557509399@qq.com', '41aec8e1d0d1604db885618344782312', 'LGTHr', '李彦睿', -1, '2017510817', '221.192.179.236', 1588927045, NULL, 1580739229, 1588927045, 1),
(19, '1633822727@qq.com', '57e72a76645895be2013019b9f8977a0', 'gt83e', '崔冬青', -1, '2017510777', '183.199.138.210', 1587903976, NULL, 1580739250, 1587903976, 1),
(20, '3088159930@qq.com', '346b4fd7dcee5ae2ca9b805e6057ca4e', 'PQQB3', '许世磊', -1, '2017510800', '183.199.150.42', 1590284393, NULL, 1580739279, 1590284393, 1),
(21, '837099443@qq.com', '87c96bed5daa7ec63f093278c344188a', 'gTKAD', '殷一伟', -1, '2017510770', '106.9.73.4', 1588912834, NULL, 1580739384, 1588912834, 1),
(22, '2606955224@qq.com', '82b8f709ea694829d8885238599db2d7', 'kBxB7', '陈梦娇', -1, '2017510804', '121.24.67.101', 1588071384, NULL, 1580739647, 1588071384, 1),
(23, '457957492@qq.com', 'c633e4af3c7be2ff32ace94348502f1d', '6t99L', '孙琦', -1, '2017510797', '119.249.2.4', 1588465980, NULL, 1580739764, 1588465980, 1),
(24, '704208946@qq.com', 'c0ad1d2d8338d8303dfc61899de72f0a', 'MvUb1', '张博林', -1, '2017510813', '110.240.62.64', 1588061141, NULL, 1580740406, 1588061141, 1),
(25, '2443314774@qq.com', '1d9a55dc2e3fca1921f98d93a07fc7e7', 'HqKXM', '张兰', -1, '2017510787', '36.98.111.90', 1590446352, NULL, 1580740507, 1590446352, 1),
(26, '1286374751@qq.com', '4f268632bb93d4791824abdc626a4c4c', 'TbRyA', '李彦坪', -1, '2017510814', '110.244.4.133', 1588068266, NULL, 1580741039, 1588068266, 1),
(27, '1751324320@qq.com', '425c787e5515dedc94846c75545bd9fc', 'ecBUm', '许亚妹', -1, '2017510774', '106.117.234.253', 1588864214, NULL, 1580741309, 1588864214, 1),
(28, '2441463706@qq.com', 'aa225bff8b0e49eb1853c91f0f23961f', 'pg9In', '赵晴', -1, '2017510816', '27.187.21.6', 1588811536, NULL, 1580741550, 1588811536, 1),
(29, '3579325534@qq.com', '83098a5f727245eaaafabaeb4c663b5d', 'mbxPY', '张舒蕾', -1, '2017510808', '221.192.180.65', 1590285074, NULL, 1580742307, 1590285074, 1),
(30, '2638214086@qq.com', '4a544c1ee83576d34020d4c960a96453', 'B6XJv', '闫建军', -1, '2017510765', '221.192.178.154', 1588132937, NULL, 1580743609, 1588132937, 1),
(31, '1528817204@qq.com', '2e8a5ef995c246966deec2c13a92965b', 'QyUrG', '王倩倩', -1, '2017510798', '124.239.101.197', 1588889465, NULL, 1580746710, 1588889465, 1),
(32, '1454277054@qq.com', '4232d9cf29c9de7475db40750936083c', 'skEFG', '甄华', -1, '2017512910', '183.196.160.66', 1588894991, NULL, 1580747019, 1588894991, 1),
(33, '2241504688@qq.com', '92d4e94116f019552107c234aeced1d6', 'v1sm8', '张华', -1, '2017510785', '223.104.102.89', 1588895163, NULL, 1580774867, 1588895163, 1),
(34, '1097028965@qq.com', 'b2edde23e6196adbfc3f5061e347abab', '88Z1G', '刘鑫', -1, '2017510780', '120.0.112.170', 1590366872, NULL, 1580778034, 1590366872, 1),
(35, '1343763314@qq.com', 'cb82fe3bd4654a60c8c9c74a47ee5ca6', 'TfDUO', '罗紫君', -1, '2017510815', '123.182.118.78', 1588582753, NULL, 1580778587, 1588582753, 1),
(36, '1375539782@qq.com', '422928bc0f4c240b25d6d3d115ba8ffc', 'LZn4J', '李雨昕', -1, '2017510786', '123.180.56.4', 1590478815, NULL, 1580781123, 1590478815, 1),
(37, '1084345774@qq.com', '0c123e2594df061d20f3eb29269ddfa6', 'ahqBh', '高铭悦', -1, '2017510799', '27.186.125.227', 1590286971, NULL, 1580782723, 1590286971, 1),
(38, '2500341833@qq.com', 'd18fedd67385b0dd493789b61d379bc4', 'Zfbht', '刘子微', -1, '2017510802', '110.247.88.196', 1591683431, NULL, 1580784332, 1591683431, 1),
(39, '2722947279@qq.com', '608ba543d6467914894036624b6ce994', 'xBGQk', '郭爽', -1, '2017510764', '183.199.216.0', 1588239727, NULL, 1580909201, 1588239727, 1),
(40, '2529622549@qq.com', '4086db5faa66ebdbddb626105bb8e8c3', 'gzMfh', '王兰策', -1, '2017510771', '36.98.247.196', 1588839461, NULL, 1580909337, 1588839461, 1),
(41, '1531377833@qq.com', 'dc8962ee978d43c7cb5bbc9eb8d23c7d', 'u2mHH', '涂建锋', -1, '2017510766', '118.212.158.232', 1588730722, NULL, 1580909523, 1588730722, 1),
(42, '188510454@qq.com', '82e7f1bf3d284122df45b77ed6a504e4', 'E9jlj', '杨晴文', -1, '2017510796', '27.190.89.128', 1588065242, NULL, 1580909968, 1588065242, 1),
(43, '1164190821@qq.com', 'd3af6a4b2379d72855b22d352a537ffc', 'zDZg0', '梁岩', -1, '2017510772', '182.51.86.238', 1588136038, NULL, 1580910408, 1588136038, 1),
(44, '2071905509@qq.com', '91da679ceec89a2d9a4fc179f4061e06', '45rLR', '李爱琳', -1, '2017512909', '124.238.65.134', 1588924787, NULL, 1580910729, 1588924787, 1),
(45, 'liny0916@qq.com', '97f58233d2e0b36953e024a70a983ed1', 'NtyQH', '张琳悦', -1, '2017510788', '27.186.10.136', 1588061393, NULL, 1580910795, 1588061393, 1),
(46, '1638696553@qq.com', 'ea77225008b4049351d18576aca18baa', 'iu8q8', '郭凯迪', -1, '2017510775', '123.196.161.238', 1590418341, NULL, 1580910933, 1590418341, 1),
(47, '1404251506@qq.com', 'ab943f176d7ae81c7bc74d12104a47e0', 'YBqEq', '王乐鑫', -1, '2017510789', '221.192.178.0', 1588843980, NULL, 1580911059, 1588843980, 1),
(48, '2358606094@qq.com', 'e76ba656cd746ff0d3f6400998b0e840', '0LjnO', '赵天骁', -1, '2017510773', '27.186.225.35', 1588902944, NULL, 1580911626, 1588902944, 1),
(49, '1277371050@qq.com', '8333cf644c0b9b924bf0642f997694a2', 'uLJ7d', '董浩', -1, '2017510768', '183.199.251.42', 1586917591, NULL, 1580917336, 1586917591, 1),
(50, '919354514@qq.com', '645f5622a201c1b24d0070c4ad281771', 'Jtnr0', '武世宽', -1, '2017510769', '60.1.180.96', 1612325518, NULL, 1580917780, 1612325518, 1),
(51, '2529355943@qq.com', 'ef3d749d412451f3ccc5a5e36bf1883a', 'hEBKg', '李智慧', -1, '2017510792', '182.51.86.7', 1587457608, NULL, 1580953729, 1587457608, 1),
(52, '953740020@qq.com', '3803af0a38d010c70e2d34f6b1ac27fa', 'MSapQ', '刘素素', -1, '2017510810', '221.192.179.120', 1589254843, NULL, 1580954952, 1589254843, 1),
(53, '1665182468@qq.com', '6ae5ac3143754659fa8889b20bcc2dd4', 'Dh8Bo', '赵倩', -1, '2017510795', '221.192.179.126', 1588893820, NULL, 1580955173, 1588893820, 1),
(54, '1142913769@qq.com', '75b16ec28f8b116d82e7efb3315f91ff', 'iwmY0', '李甜', -1, '2017510818', '183.199.172.49', 1588907252, NULL, 1580967139, 1588907252, 1),
(55, '1653500025@qq.com', '3f96e36abf55f0020984648bd20874fe', 'PMvoF', '刘聪', -1, '2017510811', '110.242.216.117', 1588905493, NULL, 1580967378, 1588905493, 1),
(56, '1761980300@qq.com', 'dec7fa4f4f9f174b7f54585d4ac6d976', 'isaTE', '卢玲玲', -1, '2017510805', '221.192.179.45', 1590156400, NULL, 1580971609, 1590156400, 1),
(57, '1677645927@qq.com', '7280154b04cd465240dd81e7ad7058d2', 'br8i5', '马艺萌', -1, '2017510782', '112.224.132.110', 1588072244, NULL, 1580977301, 1588072244, 1),
(58, '1277656183@qq.com', '5ccd1969a3533284455ab6f6021e30a9', 'oQj4H', '郭京京', -1, '2017510783', '121.24.51.83', 1590218990, NULL, 1581065752, 1590218990, 1),
(59, '1042777055@qq.com', 'aea08bcb1fbe34840ee1362a189d7111', 'cwvui', '杨淑辉', -1, '2017510793', '182.51.86.2', 1588470230, NULL, 1581755799, 1588470230, 1),
(60, '1160499112@qq.com', '2efcbf3baced1af74e102766309f945a', '42rY1', '田茂村', -1, '2017510767', '106.113.30.100', 1588913043, NULL, 1582025778, 1588913043, 1),
(61, '2424548841@qq.com', '67cab58115059a993bf563885d9fa380', 'Haz1Q', '甫非凡', -1, '2017510806', '106.9.119.2', 1590114864, NULL, 1582787214, 1590114864, 1),
(62, '1670127522@qq.com', '2311678bb69bfc92241d7a590333af86', 'XoQEm', '烟昊月', -1, '2019510707', '110.228.134.162', 1584256085, NULL, 1583396002, 1584256085, 1),
(63, '1059835465@qq.com', 'da06dca285072c5f050fee5766841f3a', 'UjBGw', '殷嘉乐', -1, '2018510802', '221.192.180.147', 1600863067, NULL, 1583403618, 1600863067, 1),
(64, '1273409278@qq.com', 'abf3bf2604621d1b78c9b451d0a7afb9', '7guS6', '张凯', -1, '2019510749', '221.192.180.114', 1584148974, NULL, 1583404405, 1584148974, 1),
(65, '1914402338@qq.com', '981ae2e42bad4cb1d63fe6fa3e58cfdd', 'DXA7P', '边雪', -1, '2019510820', '101.25.249.202', 1584146243, NULL, 1583404781, 1584146243, 1),
(66, '1834809227@qq.com', 'fc5df9b819ee45fdd5dc3df5430a86e1', 'Q8gNa', '翁凯旋', -1, '2018510449', '36.98.76.237', 1583406062, NULL, 1583405981, 1583406062, 1),
(67, '1205293336@qq.com', '8f88283754fe18021896c722a28580c6', '0kRoZ', '张紫硕', -1, '2018510813', '36.98.175.145', 1600819030, NULL, 1583834904, 1600819030, 1),
(68, '1023856414@qq.com', '981d98397a9a5fc6af5f96135e918720', '5PY3o', '隋江帅', -1, '2019510805', '183.199.121.207', 1584146994, NULL, 1584098827, 1584146994, 1),
(69, '1972209594@qq.com', '092dde5ae07d03a6d5bb84f72eab9f89', 'l8Qp2', '马璐琪', -1, '2019510666', '183.199.36.66', 1584144052, NULL, 1584098895, 1584144052, 1),
(70, '1695689601@qq.com', 'ad70ce621b711b020145e53453a00c66', 'vYYXF', '靳宴勋', -1, '2019510501', '221.192.180.77', 1584147800, NULL, 1584098912, 1584147800, 1),
(71, '913888597@qq.com', 'bd35918271984e871943c0c3dbcf84d1', 'V80GO', '赵嘉豪', -1, '2019510618', '120.11.123.190', 1584144093, NULL, 1584098952, 1584144093, 1),
(72, '2386410780@qq.com', 'ddc4c553c9abd3622d3ab44bb8b4bc6a', '7bIoC', '靳笑悦', -1, '2019510581', '27.186.203.41', 1584099021, NULL, 1584098957, 1584099021, 1),
(73, '1571384978@qq.com', '0d3dedc1bbe4a6224e090e536c045ed9', 'C4W59', '周新悦', -1, '2019510474', '111.227.183.185', 1584144780, NULL, 1584098961, 1584144780, 1),
(74, '3193981590@qq.com', '311133cdf27bcd328160e8999369b829', '3IhFV', '刘智斌', -1, '2018510431', '223.104.13.165', 1600927245, NULL, 1584099046, 1600927245, 1),
(75, '885128676@qq.com', '51429a3d7525d7a7c9889a6e025b649f', 'H6Osh', '秦双', -1, '2019510842', '120.3.227.84', 1584144362, NULL, 1584099058, 1584144362, 1),
(76, '885722708@qq.com', '8aefe11587901a6767438e22953e304f', 'khLSk', '田旭阳', -1, '2019510798', '106.115.13.218', 1584144769, NULL, 1584099065, 1584144769, 1),
(77, '1807967614@qq.com', '691d34655911d96e833decd16bffb2bd', 'pypD7', '强秋曦', -1, '2018510839', '183.197.96.70', 1599469403, NULL, 1584099065, 1599469403, 1),
(78, '1272803840@qq.com', '23237a151f2c015f20e2e7a45583f4ff', 'v4klH', '胡宗宇', -1, '2018512964', '223.104.103.144', 1600786367, NULL, 1584099078, 1600786367, 1),
(79, '1365786326@qq.com', 'ecbd0f5a10ca61c015a8971e10839506', 'R0N4Y', '刘可欣', -1, '2019510701', '27.191.28.86', 1584146701, NULL, 1584099087, 1584146701, 1),
(80, '250532336@qq.com', '6f28e5c2dcf32dcb0e4a8a7e782a3983', 'ioByJ', '刘子涵', -1, '2019510678', '36.98.24.53', 1584143902, NULL, 1584099093, 1584143902, 1),
(81, '724700252@qq.com', '299ad8bb5bfbf5ef4bd2144d2ce176a2', 'mun4G', '常竟甜', -1, '2019510834', '120.14.138.165', 1584144193, NULL, 1584099096, 1584144193, 1),
(82, '507841586@qq.com', '5274788d25fec0ff7c97e9dc138496c1', 'vt85i', '祝佳璇', -1, '2019510836', '27.190.96.36', 1584144952, NULL, 1584099120, 1584144952, 1),
(83, '2661092998@qq.com', 'c26d216ff2583c639959432e4b091c04', 'VFx8D', '马慧娟', -1, '2019510839', '101.21.173.132', 1584145309, NULL, 1584099134, 1584145309, 1),
(84, '2226343561@qq.com', '4d4154cbbeb31387f42a660ccfd83e70', 'Xpgaq', '李俊宇', -1, '2019510827', '221.192.178.54', 1584144767, NULL, 1584099150, 1584144767, 1),
(85, '813691792@qq.com', 'dfb59d4c2ecb73a774d57d3caf524411', 'MnRYg', '王然', -1, '2019512963', '106.8.188.16', 1584145320, NULL, 1584099155, 1584145320, 1),
(86, '2218852837@qq.com', '6a96c96ca749fc286f61b4aea2000150', 'WXiwL', '董雪菲', -1, '2019510785', '123.182.6.154', 1586258270, NULL, 1584099162, 1586258270, 1),
(87, '2758499189@qq.com', 'd27000e8478001e49459931b365b01ee', 'N429I', '刘佳琪', -1, '2018510486', '223.104.13.27', 1600920122, NULL, 1584099163, 1600920122, 1),
(88, '1971059286@qq.com', 'a824f387a4d1b9670d7f9f4315472b75', 'dYvhO', '康杰龙', -1, '2018510808', '117.136.2.39', 1600764586, NULL, 1584099183, 1600764586, 1),
(89, '2536191874@qq.com', '0321148d174eb2d30ec489375f78523e', 'AddQJ', '李燕君', -1, '2018510842', '36.98.190.53', 1600765130, NULL, 1584099201, 1600765130, 1),
(90, '2418008959@qq.com', '2c25cdf9c20e76595d1763489f043dec', 'Ym7CQ', '郭雨婷', -1, '2019510579', '36.98.216.188', 1584149978, NULL, 1584099201, 1584149978, 1),
(91, '1349020098@qq.com', 'eb831e0cfd978238aba6849b99521f55', '04bMv', '温佳鑫', -1, '2019510645', '106.117.4.1', 1584145536, NULL, 1584099202, 1584145536, 1),
(92, '3284502797@qq.com', '6d272693851ddc71787c0f9f862ced51', 'aXJxf', '蔡瑜婷', -1, '2019510825', '27.186.9.119', 1584144756, NULL, 1584099204, 1584144756, 1),
(93, 'sjsdwyyx@163.com', 'c80776089bd20bdcb88983a1203f6de0', 'AqQtW', '史佳晟', -1, '2018510469', '221.192.178.138', 1600872878, NULL, 1584099225, 1600872878, 1),
(94, '1924330081@qq.com', '0f3bb859f12abfad2f2cd5c180be88ef', 'JpMMZ', '刘明正', -1, '2019510566', '60.3.91.232', 1584144244, NULL, 1584099244, 1584144244, 1),
(95, '1987319162@qq.com', '3b88a65a22300ebeae0052f836b22173', '8WHwQ', '魏烨涵', -1, '2019510845', '106.114.157.114', 1584144877, NULL, 1584099248, 1584144877, 1),
(96, '2359625350@qq.com', 'fc7f4a11db7ff34c673007c6401a4206', 'Mehf8', '李晓迪', -1, '2019510835', '223.104.101.250', 1584148729, NULL, 1584099251, 1584148729, 1),
(97, '2895907376@qq.com', '4df71ddf1354cda9a81d4c2fb1b2a5cc', 'LGp8Z', '赵浩', -1, '2019510675', '223.104.37.9', 1584099256, NULL, 1584099256, 1584099256, 1),
(98, '1254076392@qq.com', 'b3e65a55f0d483aac1420651f84bcd2e', '2oSld', '刘恺征', -1, '2018510448', '36.98.16.54', 1600864029, NULL, 1584099259, 1600864029, 1),
(99, '3090590358@qq.com', 'e88391307ada2ac43e4e607d8a05ab85', 'rXVLv', '张荟', -1, '2019510822', '221.192.179.86', 1584146388, NULL, 1584099296, 1584146388, 1),
(100, '2794361424@qq.com', '5a5e6fbd74b970cb9efb1b4beaa88add', 'foZ9l', '宋雪静', -1, '2019510589', '111.226.54.112', 1584144623, NULL, 1584099308, 1584144623, 1),
(101, '1694261441@qq.com', 'e931c9cefc155f73d7ce0ff92080a98b', 'jfdcE', '李瑶', -1, '2019510602', '183.197.208.131', 1584144283, NULL, 1584099313, 1584144283, 1),
(102, '2062894242@qq.com', '601d6d83cbfaf37337b96f97bdcc68cf', '90vtw', '李晓娟', -1, '2019510796', '221.192.179.76', 1584145654, NULL, 1584099318, 1584145654, 1),
(103, '1360754188@qq.com', 'b60f7a4fc5e247b0c5658a6ab55af8ef', 'A5Hsf', '赵轩艺', -1, '2018510568', '36.98.40.32', 1600762780, NULL, 1584099367, 1600762780, 1),
(104, '2455886908@qq.com', '57d469ef4dfe38437036733f24ea1638', 'oiis1', '王倩倩', -1, '2019510521', '124.236.177.111', 1584144116, NULL, 1584099378, 1584144116, 1),
(105, '2417778067@qq.com', 'c93129585fc6da2359f7d8f9b83fc144', '5PHxz', '郑傲梅', -1, '2018510531', '36.98.17.6', 1600938005, NULL, 1584099380, 1600938005, 1),
(106, '1060093871@qq.com', '2e94a0972d8b0d1baeda93e6393ea632', 'w8A01', '班航', -1, '2019510612', '101.19.52.212', 1584143864, NULL, 1584099381, 1584143864, 1),
(107, '1927779664@qq.com', 'ac907923caef9b9a134bb166d6c9d1a9', '4eJbQ', '李彤彤', -1, '2019510700', '183.199.198.182', 1584144492, NULL, 1584099444, 1584144492, 1),
(108, '2237829295@qq.com', 'e8751369561763e8fbfe7d2b5cf083f0', 'WoPeQ', '豆旭梦', -1, '2019510512', '183.199.196.224', 1584146707, NULL, 1584099457, 1584146707, 1),
(109, '1195066311@qq.com', '05f514ef7a3cfc326905a5e33074de6d', 'ZlxRB', '李静静', -1, '2019510572', '106.119.44.115', 1584144028, NULL, 1584099483, 1584144028, 1),
(110, '2393547013@qq.com', '3a970df889778e2b4aa7d67b7c2e2a0b', 'Gjsee', '唐迈', -1, '2019510848', '106.114.140.158', 1584150739, NULL, 1584099494, 1584150739, 1),
(111, '2283846484@qq.com', '4bcbb9d1f919f6e989e90c929686b1ec', '3PMtX', '张任愿', -1, '2018510659', '223.104.13.43', 1600770602, NULL, 1584099496, 1600770602, 1),
(112, '1824411981@qq.com', 'c9e4178c89a1255b83009a2207a9881b', 'EPBKH', '霍胜俊', -1, '2019510683', '183.197.181.0', 1585265623, NULL, 1584099507, 1585265623, 1),
(113, '2022567036@qq.com', '5e29579880fe8394958100595181f453', 'oLzZu', '尹博美', -1, '2018510836', '223.104.13.31', 1600848189, NULL, 1584099507, 1600848189, 1),
(114, '413910405@qq.com', '7f8d1a00f4475c31808d20ea94d759f6', '2ZG6A', '孟妍', -1, '2018510722', '221.192.179.230', 1600863262, NULL, 1584099518, 1600863262, 1),
(115, '3063006960@qq.com', '98941c36f5818c2ba56116c1bdd42b31', 'oQGy7', '谢婧雯', -1, '2019510847', '110.248.40.96', 1584146281, NULL, 1584099553, 1584146281, 1),
(116, '1464830283@qq.com', 'bcddf31729bedaf877dabdc9cb140c83', 'Beh9v', '菅旭峰', -1, '2019510614', '223.104.102.11', 1584144088, NULL, 1584099561, 1584144088, 1),
(117, '2849674644@qq.com', 'e8b7bfae8cbb3265c206867c5c12fa13', 'wP2yK', '杨志钦', -1, '2019510850', '182.51.86.26', 1584148791, NULL, 1584099574, 1584148791, 1),
(118, '1425368428@qq.com', '91029c032f2884dbaa5dfa5591cbe658', 'ZeEHQ', '刘夏洁', -1, '2019510851', '111.226.147.223', 1584144790, NULL, 1584099581, 1584144790, 1),
(119, '1830901797@qq.com', '4dcac0905ee7380e224ab3307b588473', 'VK1VT', '申依贤', -1, '2019510524', '120.14.128.51', 1584144060, NULL, 1584099584, 1584144060, 1),
(120, '2916332159@qq.com', 'aea4d4b3c440e54b04c758f4900f92f5', '3yiQA', '谢薇薇', -1, '2019510468', '27.189.213.203', 1584144599, NULL, 1584099590, 1584144599, 1),
(121, '1987740690@qq.com', 'ad9d3bfd9c0fb4367232e8ea3f8319bd', 'qOszE', '田雪', -1, '2019510846', '223.104.103.224', 1584144808, NULL, 1584099624, 1584144808, 1),
(122, '483861393@qq.com', '076a31fdc98719b30e10906fa843586a', 'CtHIz', '任玎', -1, '2018510689', '111.13.93.76', 1600765751, NULL, 1584099641, 1600765751, 1),
(123, '2017300918@qq.com', 'a8f2db00e8d5497d6441b7e6082fcb40', 'tKrq3', '李建鑫', -1, '2019510634', '106.119.62.86', 1584144158, NULL, 1584099682, 1584144158, 1),
(124, '3495034293@qq.com', '319df81e252047b499e3df6397dcfbef', 'PscT3', '刘赛达', -1, '2019510802', '60.5.68.111', 1584145101, NULL, 1584099689, 1584145101, 1),
(125, '1873826228@qq.com', 'cac1d6f4c5afe180cf38e2ce537a6e68', 'jKhZy', '王颖', -1, '2019510698', '121.27.61.48', 1584144736, NULL, 1584099726, 1584144736, 1),
(126, '497100232@qq.com', 'e42245de3754d3b1f79f81ea944e94b2', 'XCgdZ', '师晓雨', -1, '2019510636', '111.226.4.187', 1584144105, NULL, 1584099742, 1584144105, 1),
(127, '2256731671@qq.com', 'f2606c0bbf94403cd5cf8000841e3089', 'STDBW', '王兴甜', -1, '2019510841', '221.192.178.196', 1584148516, NULL, 1584099752, 1584148516, 1),
(128, '1749034755@qq.com', '5339c4de3fc28582eed3f3005f104cc6', 'VWPMI', '张茹庚', -1, '2019510804', '120.11.192.154', 1590029429, NULL, 1584099780, 1590029429, 1),
(129, '1431839249@qq.com', 'f50552c53ff576f052bbb86ea2139e35', 'NKzzI', '王珊珊', -1, '2019510651', '36.98.54.85', 1584144005, NULL, 1584099794, 1584144005, 1),
(130, '563377164@qq.com', 'e9df136c972c41a4e13a4ccf182438dc', 'Dx36l', '王东印', -1, '2019510752', '121.21.75.13', 1584144186, NULL, 1584099808, 1584144186, 1),
(131, '2632776529@qq.com', '3db171e1cb97450afaab1f807dea3b47', 'yYYaY', '毕雪健', -1, '2019510507', '110.245.154.135', 1584144071, NULL, 1584099808, 1584144071, 1),
(132, '484557862@qq.com', 'f57eaf331df3ae302ded735fff244686', 'C3Usf', '王然', -1, '2019510646', '106.114.124.99', 1584144021, NULL, 1584099816, 1584144021, 1),
(133, '1608597374@qq.com', '7174e4a16ed439298e7fcdadf55ba849', 'B0tJh', '胡佳雨', -1, '2018510779', '223.104.102.55', 1584147320, NULL, 1584099822, 1584147320, 1),
(134, '3487708847@qq.com', '6c2295d32fecd5f66e69842244650641', 'X3te6', '魏阁阁', -1, '2019510570', '106.34.6.161', 1584144692, NULL, 1584099828, 1584144692, 1),
(135, '3394530552@qq.com', '9c25941a957aa47e7be58589eca2ea65', 'mcN1u', '梁红丽', -1, '2019510578', '123.181.155.87', 1584149855, NULL, 1584099844, 1584149855, 1),
(136, '1029151546@qq.com', 'cc944d25fb4575d3f196bd07f9947eaf', 'wSTAf', '李婷', -1, '2019510648', '120.14.153.40', 1584144563, NULL, 1584099853, 1584144563, 1),
(137, '1123810440@qq.com', '23b5561c01f06c919b9a53e17c99c348', 'm3JLl', '乔晓彤', -1, '2019510800', '111.225.177.114', 1585472341, NULL, 1584099895, 1585472341, 1),
(138, '2606381394@qq.com', 'a14d64141a972416bac7872910b102e0', 'Kmtbf', '崔月英', -1, '2018510820', '183.198.1.131', 1600763116, NULL, 1584099897, 1600763116, 1),
(139, '2571257730@qq.com', 'fa01e644666d33ac025bc1e62e2e6b94', '5qhcC', '佟海琳', -1, '2019510792', '36.98.141.169', 1584144946, NULL, 1584099919, 1584144946, 1),
(140, '2603028695@qq.com', '9a4c1a61ad19e4eadced74a0295833b9', 'l9ljP', '郭艳新', -1, '2019510811', '183.198.237.33', 1596191364, NULL, 1584099936, 1596191364, 1),
(141, '2428055475@qq.com', 'eb0122b411512b72745ac6cfe221f9b3', 'KmX9j', '张晨旭', -1, '2018510730', '36.98.56.167', 1600764195, NULL, 1584099958, 1600764195, 1),
(142, '2011232343@qq.com', 'ef7179eb4a997f98963a8e4706553766', 'dUkUz', '米冬雪', -1, '2019510568', '110.229.184.215', 1584144274, NULL, 1584099960, 1584144274, 1),
(143, '2929208656@qq.com', '21b00b033bcc2646679135c2a1718594', 'awzQA', '田静', -1, '2019510838', '101.20.134.191', 1584150814, NULL, 1584099970, 1584150814, 1),
(144, '2315802024@qq.com', '8cbe509284d16b1b83eb45011499f7b1', 'UCgZ1', '崔静', -1, '2019510671', '61.134.140.162', 1584147382, NULL, 1584099970, 1584147382, 1),
(145, '2144623762@qq.com', '23362ef2010dd22725afa94b35ce8dd5', 'y80hn', '杨欣茹', -1, '2019510705', '27.187.39.221', 1584146434, NULL, 1584099975, 1584146434, 1),
(146, '3500408037@qq.com', '6b0afe3c6d81bbdcbf42e7dab78969ce', 'Es49r', '梁宁宁', -1, '2019510734', '183.197.109.254', 1584144829, NULL, 1584100022, 1584144829, 1),
(147, '3486287759@qq.com', '18d38b6d41b5c25bdbbfe570595302a3', 'SdMma', '杜硕', -1, '2019510687', '183.199.124.151', 1584144300, NULL, 1584100039, 1584144300, 1),
(148, '2870798690@qq.com', 'b0fe009087c07b9338a507c21208a6f0', 'p4ra1', '吕占欣', -1, '2019510547', '106.112.20.72', 1584145359, NULL, 1584100075, 1584145359, 1),
(149, '2657104279@qq.com', '3d43d0e3e2df11f0a0558b5b20213fc4', '2KhIf', '马奥运', -1, '2018510828', '183.198.1.131', 1600782214, NULL, 1584100079, 1600782214, 1),
(150, '112458718@qq.com', '4481eed6a6de8d9f27f6438c61e1a6db', 'LU23Z', '李炳朝', -1, '2019510496', '124.238.4.162', 1584100082, NULL, 1584100082, 1584100082, 1),
(151, '1403011201@qq.com', '57362ba60262ba785d138815be7065aa', 'utmLa', '孙蕾', -1, '2019510638', '123.181.74.29', 1584144670, NULL, 1584100098, 1584144670, 1),
(152, '2054255912@qq.com', '6f66db5438b5c7b3105d3d5af8c8d530', 'PocWH', '白雪宁', -1, '2019510457', '27.186.125.18', 1584100114, NULL, 1584100114, 1584100114, 1),
(153, '2384250007@qq.com', 'c4bda5133860e2bbf67de63ad5df1dc5', '3yj1g', '郭艳蕊', -1, '2018510631', '42.237.94.117', 1584144330, NULL, 1584100137, 1584144330, 1),
(154, '1310327556@qq.com', 'be9a0b297654f5783e258ccbf4ae337b', '2oiVp', '刘子梦', -1, '2019510765', '36.98.141.169', 1584144027, NULL, 1584100153, 1584144027, 1),
(155, '2641077977@QQ.com', 'c6bf414eadd0c0383ff167b213c92888', 'u8CHG', '王敏亭', -1, '2019510488', '110.243.221.93', 1584175603, NULL, 1584100154, 1584175603, 1),
(156, '2750546620@qq.com', '3aec573d7826ac6f49aa39d1835a642f', 'gPwm9', '郭临腾', -1, '2019510686', '106.117.140.1', 1584144849, NULL, 1584100165, 1584144849, 1),
(157, '2847238314@qq.com', '3f3aed761a5a0627f6c3a1fd9790a886', 'I0xmm', '张雅莉', -1, '2019510758', '101.24.80.235', 1584147025, NULL, 1584100195, 1584147025, 1),
(158, '2450844972@99.com', 'be1709c564ee97a168d344026fb3e748', 'YujoH', '康义帆', -1, '2019510472', '60.5.29.3', 1584100211, NULL, 1584100211, 1584100211, 1),
(159, '1428472790@qq.com', '7c6d63682f6e50659b0bc54ca27357e4', 'aKY96', '江淼', -1, '2019510494', '223.104.101.244', 1584144288, NULL, 1584100215, 1584144288, 1),
(160, '1961648737@qq.com', 'a62ab4d86714500d4f8f6623c1c1b683', 'dggZ1', '陈建涛', -1, '2018510761', '182.51.86.94', 1584155478, NULL, 1584100268, 1584155478, 1),
(161, '1272980727@qq.com', '88920b69b4544eb5a13d393ed06ed459', 'OAboF', '耿紫鑫', -1, '2018510692', '60.1.146.50', 1584100292, NULL, 1584100292, 1584100292, 1),
(162, '2332074977@qq.com', '62ca07dd21d4c440fc7e1af87a82225b', 'doihX', '耿官莹', -1, '2019510527', '116.132.123.20', 1584144390, NULL, 1584100311, 1584144390, 1),
(163, '861256361@qq.com', 'ce0cafcac4e754dcfebf05849fedb0e2', 'F2aCH', '吕江策', -1, '2019510771', '36.98.71.179', 1584147496, NULL, 1584100329, 1584147496, 1),
(164, '2536856159@qq.com', '3493b5576f6c2018e5bf997739cbc77a', 'E8f3L', '张珂珂', -1, '2019510650', '218.11.127.41', 1584144603, NULL, 1584100335, 1584144603, 1),
(165, '1319497293@qq.com', 'e88e842166c98932a76e0e2346767292', '2Ueme', '昂康', -1, '2019510676', '124.236.161.88', 1584145495, NULL, 1584100348, 1584145495, 1),
(166, '648371732@qq.com', 'f067b69172bbf08bf5190e9851a6fc54', 'L7IRF', '张梓涵', -1, '2019510622', '223.104.103.46', 1584144025, NULL, 1584100399, 1584144025, 1),
(167, '1090154607@qq.com', '0c15913e65c4c68e879c32859f631db3', '0uNFP', '李雨萌', -1, '2019510710', '183.199.219.240', 1584144362, NULL, 1584100479, 1584144362, 1),
(168, '1091384813@qq.com', 'c8f6f26570adcd2687f9b8b4faee4e4f', '3mwPm', '刘硕', -1, '2018510756', '111.13.93.86', 1584144062, NULL, 1584100488, 1584144062, 1),
(169, '2413989479@qq.com', '0217c841180f3796c59b81ff183ba535', 'Dl0PK', '方梦雪', -1, '2019510545', '183.196.250.30', 1584144290, NULL, 1584100491, 1584144290, 1),
(170, '3108506598@qq.com', '024c02308094de916cdd8505abe24c8b', 'Zsnrs', '张哲', -1, '2019510787', '124.238.42.183', 1584146225, NULL, 1584100492, 1584146225, 1),
(171, '1395726200@qq.com', '5fd7d3791d0a66fb9b2048868e06a9a6', 'ZRjC5', '郝佳美', -1, '2019510606', '221.192.178.25', 1584144437, NULL, 1584100506, 1584144437, 1),
(172, '3160469487@qq.com', 'd76e701f5704534c0df435792b58713c', 'kRpDq', '张灿', -1, '2019510605', '60.9.115.72', 1584148004, NULL, 1584100511, 1584148004, 1),
(173, '1964447684@qq.com', '696b9cb4fd7d6be720b0b2a97749c00b', 'JM2FB', '宋润陶', -1, '2019510830', '183.198.94.223', 1584144755, NULL, 1584100513, 1584144755, 1),
(174, '2779255968@qq.com', 'e8542e0cbe30db6185f8f6df53a31203', 'rFG7q', '陈家棋', -1, '2019510828', '106.9.123.217', 1584144916, NULL, 1584100530, 1584144916, 1),
(175, '2954186986@qq.com', '798088eb2243710a07b0760ea644d1f7', 'fIi6S', '张会敏', -1, '2019510699', '121.24.6.48', 1584144431, NULL, 1584100559, 1584144431, 1),
(176, '798171343@qq.com', '45de61a495df0a54e65c35e011d79e09', 'MAFxk', '王亭锦', -1, '2019510517', '106.119.60.248', 1584144548, NULL, 1584100581, 1584144548, 1),
(177, '2236125355@qq.com', 'ab28b6cdd6757f21264723164140dc51', 'wISL1', '朱胜寒', -1, '2019510654', '106.118.122.6', 1584144973, NULL, 1584100592, 1584144973, 1),
(178, '1270344354@qq.com', '80255226b920776c0fa45d76fe1df4b9', '6o0Sb', '孟子怡', -1, '2019510770', '36.98.171.38', 1584146525, NULL, 1584100595, 1584146525, 1),
(179, '1765794990@qq.com', '920345289fc83ca910d5fef77461dc92', 'fEJvz', '王硕菲', -1, '2018510596', '223.104.103.152', 1600762602, NULL, 1584100606, 1600762602, 1),
(180, '473177943@qq.com', '6063eb4c7a15de2cbd4d400e3c02e2c8', '1kvZX', '梁安妮', -1, '2019510516', '119.250.233.240', 1584146836, NULL, 1584100616, 1584146836, 1),
(181, '2689912792@qq.com', 'd780b47e5ddf5a84ba30cc7dac2707bd', 'oPLQZ', '童爱华', -1, '2019510767', '110.253.216.194', 1584144326, NULL, 1584100633, 1584144326, 1),
(182, '287975549@qq.com', '50b2b74018518c42ac4d3d25d8763e2f', 'SIUSg', '吉桐', -1, '2019510744', '110.248.121.25', 1584143899, NULL, 1584100633, 1584143899, 1),
(183, '1584914571@qq.com', 'd539a39f0a236da39cfff09e935b7e80', 'wATdv', '张霄', -1, '2019510518', '27.187.216.61', 1584147651, NULL, 1584100634, 1584147652, 1),
(184, '2471278953@qq.com', '137dfd470c40904a85c7233dbb574dbb', 'pOYwm', '沈晓龙', -1, '2019510505', '117.59.84.67', 1584144081, NULL, 1584100664, 1584144081, 1),
(185, '1609399202@qq.com', '6af41cffc9bc98194a748cbecf83f2dc', '14DeD', '赵颖', -1, '2019510711', '106.115.114.52', 1584144144, NULL, 1584100696, 1584144144, 1),
(186, '1056895003@qq.com', 'be642787f1cc914f00a1070bf7a37534', 'Mfa5O', '刘畅', -1, '2019510757', '183.199.157.182', 1584145221, NULL, 1584100697, 1584145221, 1),
(187, '1561312672@qq.com', '1559c267ace973927b87c16cb8d33062', 'EgvGM', '高可桐', -1, '2019510538', '183.199.235.110', 1584144872, NULL, 1584100744, 1584144872, 1),
(188, '2783631844@qq.com', 'cd88a429dec6aa31adb938b058deb825', 'JshMU', '杨晓璐', -1, '2019510769', '183.199.148.15', 1584146355, NULL, 1584100744, 1584146355, 1),
(189, '347589308@qq.com', 'dbcea0d5b0f2a7c2671e4cdc2927790b', 'ccf4w', '赵玉颖', -1, '2019510766', '120.2.30.96', 1584144751, NULL, 1584100753, 1584144751, 1),
(190, '1505698707@qq.com', '57ed90f7e2c78af7564f7ed7c2ba6434', 'zpFAp', '戈红玉', -1, '2018510569', '106.117.89.121', 1600771904, NULL, 1584100771, 1600771904, 1),
(191, '2023451818@qq.com', 'a4ca5535b893edce06a1d31b55ea5c3b', '49fuR', '王丹丹', -1, '2019510476', '182.51.86.116', 1584149307, NULL, 1584100794, 1584149307, 1),
(192, '2329493687@qq.com', '18c723f02142150d30e606bf1b90ec17', 'INtbU', '陈天姿', -1, '2019510778', '123.181.83.176', 1584146873, NULL, 1584100803, 1584146873, 1),
(193, '2316437864@qq.com', 'fe51eb36a445a4891b928f894b9f39b2', 'MrNm2', '赵颖', -1, '2019510513', '221.192.179.37', 1584144285, NULL, 1584100824, 1584144285, 1),
(194, '1584713347@qq.com', '3d5794e12bcb1b04274294e10d4c4423', 'gTdfb', '张玲玲', -1, '2019510484', '221.178.126.194', 1584144609, NULL, 1584100824, 1584144609, 1),
(195, '2698325747@qq.com', '36a267931767d156d317cbb3d50d0187', 'fqRdE', '李博', -1, '2019510801', '183.199.26.115', 1584145233, NULL, 1584100825, 1584145233, 1),
(196, '2157704707@qq.com', '6c56620fd6f83ea68a7daeb06a98f6d1', 'Zp27A', '马亚平', -1, '2019510726', '110.252.129.248', 1584144301, NULL, 1584100832, 1584144301, 1),
(197, '3058974149@qq.com', '2518d1301d6ad2e6ca7b5dde6754cdc7', 'IvahF', '张莹', -1, '2019510529', '183.197.234.230', 1584144547, NULL, 1584100855, 1584144547, 1),
(198, '1483727456@qq.com', 'c2796e16bf548d69c23aee4588c604b4', 'pdXPS', '刘佳', -1, '2019510795', '121.25.122.53', 1584149101, NULL, 1584100857, 1584149101, 1),
(199, '2331509639@qq.com', '5308119b969a7cc32537e1fced069c23', 'I5Zhq', '江云达', -1, '2018510462', '223.104.103.161', 1600769649, NULL, 1584100903, 1600769649, 1),
(200, '2076789173@qq.com', '9fcb02f39b83505534161e85711e49f8', 'ORYgf', '贾立婕', -1, '2019510478', '27.186.14.176', 1584143821, NULL, 1584100921, 1584143821, 1),
(201, '2963547627@qq.com', '3e3a9b6fe67eaa0bcca4a4a09f46e673', 'P9MJD', '刘苏真', -1, '2019510727', '60.6.173.35', 1584144986, NULL, 1584100934, 1584144986, 1),
(202, '2489961537@qq.com', '7f3b9ec98a44eacb1b85e5f176beac27', 'Ow6s9', '黄佳鑫', -1, '2019510826', '27.189.206.162', 1584148887, NULL, 1584100957, 1584148887, 1),
(203, '1042658599@qq.com', '82b2316f48499475243e4888935bdd66', 'Y0uiM', '苏佳慧', -1, '2019510763', '101.17.157.56', 1584147100, NULL, 1584100982, 1584147100, 1),
(204, '2656743243@qq.com', 'eac0589b03f11d054094392d517324b4', 'tXQEm', '王莹', -1, '2019510526', '183.199.181.77', 1584147297, NULL, 1584100991, 1584147297, 1),
(205, '3461159837@qq.com', '1d4b2405a52c1853824c717ee75e71bd', 'KtPsi', '朱袁', -1, '2019510543', '106.47.251.255', 1584147194, NULL, 1584100997, 1584147194, 1),
(206, '2205741460@qq.com', '5fa20293aba35e139b834c273d989006', 'wV791', '隋洪达', -1, '2019510443', '39.87.16.64', 1584707255, NULL, 1584101023, 1584707255, 1),
(207, '360150416@qq.com', 'c7ae9d2d10dbd8314d24b21d0bdb41f0', 'Brw2n', '张婧', -1, '2019510656', '183.197.194.215', 1584144418, NULL, 1584101033, 1584144418, 1),
(208, '2937076195@qq.com', '659e6894f23f562be7cdd61f7025f723', 'x8ls0', '雷庆宾', -1, '2019510808', '60.0.0.233', 1584147598, NULL, 1584101034, 1584147598, 1),
(209, '2232506922@qq.com', '7e7ffd9d71e1fb6217981f796b9ed02d', 'q5WDR', '贾秋泽', -1, '2018510434', '110.244.221.209', 1584148543, NULL, 1584101041, 1584148543, 1),
(210, '1256829089@qq.com', 'b270ab35ecae5380a147ca60e8aadeba', 'XPlBn', '马璐瑶', -1, '2019510461', '60.1.46.129', 1584144207, NULL, 1584101047, 1584144207, 1),
(211, '17731507944@163.com', '928e2323544f21a57f5794ce549fcbd0', 'Arqij', '刘鑫鹏', -1, '2019510500', '106.9.104.37', 1584149800, NULL, 1584101050, 1584149800, 1),
(212, '2152211565@qq.com', '86c2b0d2099ce23f24c64a68d41e229f', 'QpRvi', '安杉杉', -1, '2019510719', '106.113.49.45', 1584145165, NULL, 1584101054, 1584145165, 1),
(213, '1754600205@qq.com', '48bdcf934d008718f786ad53b7a15945', 'yHnDX', '姚晔', -1, '2019510469', '183.198.253.192', 1584147024, NULL, 1584101070, 1584147024, 1),
(214, '1772362333@qq.com', '55bc10b76b0e5cd36b780dca4d386bff', 'hGnkW', '王薇', -1, '2019510454', '106.8.103.251', 1584149844, NULL, 1584101083, 1584149844, 1),
(215, '1513088234@qq.com', 'dc0e7879e6ac1d5bffb77e88ad7dbb82', 'iXhTm', '马朔', -1, '2019510441', '120.14.132.39', 1584150319, NULL, 1584101095, 1584150319, 1),
(216, '1348323621@qq.com', 'f18f053fca0555a4a21cf2f4ef61cf4c', 'ktUvC', '李雯文', -1, '2019510647', '60.1.110.58', 1584144430, NULL, 1584101100, 1584144430, 1),
(217, '2487164940@qq.com', 'eba833020797a261dce748809c20acbe', 'i6Xh4', '范玮娜', -1, '2019510525', '221.220.14.180', 1584148356, NULL, 1584101102, 1584148356, 1),
(218, '1311821848@qq.com', '74bb2b3c6fa897c66370080ac8b2ff6d', 'ug6GO', '汪晓琛', -1, '2019510712', '106.119.120.88', 1584146380, NULL, 1584101118, 1584146380, 1),
(219, '2062545797@qq.com', '1691a4fab45022c32e66d6f337661a22', 'ug8NG', '王焕婷', -1, '2018510787', '120.2.38.194', 1584147834, NULL, 1584101119, 1584147834, 1),
(220, '2791733758@qq.com', '2bbbb3b247b73a09cb0ca4199a195158', 'NBPgg', '周芳', -1, '2019510644', '182.51.86.196', 1584144306, NULL, 1584101121, 1584144306, 1),
(221, '2766529349@qq.com', '3bf63042aa8e5cca599d7508a6246fc8', 'BKpA7', '梁家璇', -1, '2018510705', '106.117.85.181', 1600772180, NULL, 1584101129, 1600772180, 1),
(222, '2420354966@qq.com', '5839437a4f895b6b95e2188ddcd32043', 'YFn70', '魏向前', -1, '2019510806', '124.238.14.2', 1584144763, NULL, 1584101139, 1584144763, 1),
(223, '1297580205@qq.com', 'a767be9e099ec3415f5612e261527040', 'n8eWe', '闫国丽', -1, '2019510523', '60.9.201.119', 1585204075, NULL, 1584101147, 1585204075, 1),
(224, '1836037772@qq.com', '9aae75ac7f212997d7f7fec8c77f23da', '7GlYK', '吉向荣', -1, '2019510720', '223.104.13.158', 1584145605, NULL, 1584101155, 1584145605, 1),
(225, '874515766@qq.com', '3a572dfb3d53453ef30ac93325e8de47', 'ZgXvE', '常佳文', -1, '2018510762', '183.197.226.229', 1584147562, NULL, 1584101160, 1584147562, 1),
(226, '1163468376@qq.com', 'd592053f53eca07636260fa9fd8829d2', 'DPL9x', '巨晴晴', -1, '2019510506', '106.114.40.69', 1584144661, NULL, 1584101164, 1584144661, 1),
(227, '1240311529@qq.com', '4beec56f8579c9ebae09b7eef8c1e5b6', 'pZ6pU', '范冰颖', -1, '2019512994', '120.208.0.21', 1584146387, NULL, 1584101193, 1584146387, 1),
(228, '731780533@qq.com', '2dfb622fe8084c9c23f4482703b35f66', 'Yp1Xh', '毕令琪', -1, '2018510664', '36.98.51.99', 1600873444, NULL, 1584101303, 1600873444, 1),
(229, '2834125124@qq.com', '2e4ed1c69d07900cf8a465f6e6675bc3', 'Fjxo3', '杨海艳', -1, '2019512992', '171.124.198.160', 1584149351, NULL, 1584101321, 1584149351, 1),
(230, 'yexuba70294654@qq.com', '1af450bb46f9587ccfa4366930ec35a4', 'V9vTZ', '田亦泽', -1, '2018510488', '36.98.177.58', 1600927134, NULL, 1584101323, 1600927134, 1),
(231, '1461852770@qq.com', 'cc924c1baa8e7f6439c62d756a350342', 'O4j28', '唐惠敏', -1, '2018510593', '223.104.102.116', 1584147632, NULL, 1584101326, 1584147632, 1),
(232, '3468200880@qq.com', '80a8df40bad706cbc915e52ec3ae069d', 'WV0w9', '马月荣', -1, '2019510709', '60.9.244.147', 1584144058, NULL, 1584101328, 1584144058, 1),
(233, '1424348884@qq.com', 'eeee4bca1c57d919d49c6bd91adc6d31', 'EDSeA', '张静静', -1, '2019510761', '183.197.84.115', 1584147038, NULL, 1584101331, 1584147038, 1),
(234, '3191085607@qq.com', 'ae879076f51fe1c5625f1f035163734e', 'sHf8x', '牛晨静', -1, '2019512955', '36.98.108.2', 1584150623, NULL, 1584101339, 1584150623, 1),
(235, '1164917227@qq.com', '92c04d78f6cf4c0c46e264576a37cc6f', 'oCmCo', '高宇硕', -1, '2019510499', '183.197.147.17', 1584101714, NULL, 1584101357, 1584101714, 1),
(236, '1250818091@qq.com', 'b9c0eadc8b905641cf4cfd4facd18ef9', 'H3xYd', '杨可欣', -1, '2019510668', '183.197.24.218', 1584149713, NULL, 1584101358, 1584149713, 1),
(237, '2938635401@qq.com', 'ecc5c298d4babbd34399b16e7c959115', 'pB0vm', '张一惠', -1, '2019510781', '120.0.242.2', 1584149295, NULL, 1584101371, 1584149295, 1),
(238, '2870170589@qq.com', '15aa5a47cbac907198d11c5230e0dd61', 'NbPWV', '白玉泽', -1, '2019510807', '121.19.108.200', 1584144808, NULL, 1584101376, 1584144808, 1),
(239, '1276169901@qq.com', '6e21e872c9359530928fe5a65cb1c0d3', '7kD1g', '张楠', -1, '2019510812', '223.72.47.34', 1584145851, NULL, 1584101397, 1584145851, 1),
(240, '17631510171@163.com', '8f6449a72e5a2fc9c18b0b9849134a12', 'siFOU', '张越', -1, '2018510470', '223.104.103.120', 1584145971, NULL, 1584101408, 1584145971, 1),
(241, '3250666566@qq.com', '712b2b74625d11af5c724ab525fbe3aa', 'ZqwSX', '高俊杰', -1, '2019510489', '123.182.19.90', 1584144884, NULL, 1584101422, 1584144884, 1),
(242, '1525166672@qq.com', 'eb0f461dce77a28df98244cbc10381a6', '1BRAG', '刘琳', -1, '2019510482', '124.236.161.11', 1586482997, NULL, 1584101463, 1586482997, 1),
(243, '2197309592@qq.com', '11b7650dd1733dbb5d592c44105dc381', 'TFDEh', '肖通', -1, '2019510613', '221.192.178.146', 1584143998, NULL, 1584101466, 1584143998, 1),
(244, '1662383038@qq.com', 'ab8d5f290d7ed45b132f87a1d7a2a5ec', '68Jlx', '王甜甜', -1, '2019510486', '27.188.173.44', 1584756555, NULL, 1584101474, 1584756555, 1),
(245, '1499290012@qq.com', 'f71751360d55e5db6ab60f32aa9502f8', 'wo8c3', '徐乐涵', -1, '2019510491', '221.192.178.207', 1584148522, NULL, 1584101544, 1584148522, 1),
(246, '1347264774@qq.com', 'f80f0d92758885795be01c30415d8c11', '4lwdG', '王蕊蕊', -1, '2019510520', '223.104.102.104', 1584148120, NULL, 1584101551, 1584148120, 1),
(247, '3058627485@qq.com', 'e6c98345188ee2f64d0ad16fabd99a83', 'dh2TW', '常远萌', -1, '2019510584', '106.114.2.199', 1584147029, NULL, 1584101608, 1584147029, 1),
(248, '2654846231@qq.com', '79618e21947ae94026603291209a6416', '5uqQp', '王佳雯', -1, '2019510510', '106.118.209.71', 1584144298, NULL, 1584101624, 1584144298, 1),
(249, '2495197949@qq.com', '2c7414936d8c7bf03d99e40777b64418', 'uXp7t', '王爱看', -1, '2019510585', '183.199.178.135', 1584675107, NULL, 1584101637, 1584675107, 1),
(250, '836326161@qq.com', '743d53ede83f6b5aeeea6adfdb148938', 'w2wlm', '史冰洁', -1, '2018510452', '124.236.226.144', 1600864297, NULL, 1584101668, 1600864297, 1),
(251, '2207667301@qq.com', '8a012680568b60f0ef5967ab881faaa9', 'ZHUh1', '刘佳辉', -1, '2018510530', '221.192.178.240', 1600866590, NULL, 1584101675, 1600866590, 1),
(252, '1466348448@qq.com', 'f0ed8d16ec9c85b6908ae1c9a9b2a38c', 'A420M', '李金泉', -1, '2019510560', '183.197.145.142', 1584101726, NULL, 1584101726, 1584101726, 1),
(253, '2154591660@qq.com', '8afe1d52dca39c1af9fe594cb8a47075', 'pvXqc', '杨欣如', -1, '2019510448', '106.119.42.237', 1584149515, NULL, 1584101810, 1584149515, 1),
(254, '3164749431@qq.com', 'cfa6c329ee69c82ed7c3be272c8edd6b', 'q9w4M', '吴玉均', -1, '2019510832', '221.192.179.186', 1584146247, NULL, 1584101866, 1584146247, 1),
(255, '1533255357@qq.com', '724be7ae7d80934fe60b32f9d9b8b7df', 'LQUn0', '要祎硕', -1, '2019510460', '221.192.179.61', 1584149437, NULL, 1584101943, 1584149437, 1),
(256, '1411236293@qq.com', '4fe5f4196ea42883fc741c0c2ea65ca3', 'RIYe2', '魏小雨', -1, '2019510546', '27.186.254.115', 1584145147, NULL, 1584101943, 1584145147, 1),
(257, '3051018522@qq.com', '9b7c2a8d9faab7f86f954235427021fa', 'h2ZMA', '宋子洋', -1, '2019510586', '183.197.255.202', 1584146014, NULL, 1584101953, 1584146014, 1),
(258, '1687314106@qq.com', '96e40113f4ec07ed5b8807f7b5e6480c', 'liYzw', '魏圆圆', -1, '2019510815', '183.198.231.59', 1584144286, NULL, 1584101957, 1584144286, 1),
(259, '1730509637@qq.com', 'b6d507ee2eb77abdbd820655c84f94e7', 'y62QK', '韩东博', -1, '2019510691', '223.104.101.58', 1584145130, NULL, 1584101968, 1584145130, 1),
(260, '2961812686@qq.com', '8ced6650c77d32259664f78640c00cfb', 'MGBjr', '罗津津', -1, '2019510481', '60.27.95.3', 1584162495, NULL, 1584101971, 1584162495, 1),
(261, '2628180976@qq.com', 'e799c05dbce3a7af2c0f924ed7ef0177', 'Q7op7', '张二玲', -1, '2019510664', '101.19.187.101', 1584144950, NULL, 1584101989, 1584144950, 1),
(262, '2088798635@qq.com', '8b9eb3695f400dad708a1b159bc0ee5d', 'Injgg', '李欣童', -1, '2019510549', '106.8.249.32', 1584102000, NULL, 1584102000, 1584102000, 1),
(263, '2315627147@qq.com', 'f43974e3b45df35dbf83cc08d175be42', 'dmUMO', '刘佳澳', -1, '2018510724', '36.98.143.130', 1600762632, NULL, 1584102014, 1600762632, 1),
(264, '1875502826@qq.com', '2d972f38fbb88e3ce4b43762f8c61d4b', 'VgjHT', '张鑫鑫', -1, '2019510817', '221.192.180.172', 1584144820, NULL, 1584102015, 1584144820, 1),
(265, '2391738971@qq.com', '731c12b2941f2d792effe761d21fefb5', 'xMJek', '张旭茹', -1, '2019510768', '123.115.121.172', 1584148698, NULL, 1584102018, 1584148698, 1),
(266, '1057560395@qq.com', '47a51a720de3a481c6b7d877a8420a63', 'XXEwo', '韩飞', -1, '2019510615', '120.10.93.78', 1584144569, NULL, 1584102022, 1584144569, 1),
(267, '918679816@qq.com', 'eca6b2b011da56805de8b31bf9e3f207', 'hQ2lD', '代依洋', -1, '2018510563', '221.192.178.92', 1600765934, NULL, 1584102032, 1600765934, 1),
(268, '1791040982@qq.com', 'e08cd9323a8ae94c0f31413efdfdeb76', 's8gkV', '苑腾镝', -1, '2019510695', '106.114.145.39', 1584145446, NULL, 1584102034, 1584145446, 1),
(269, '2466645629@qq.com', 'f8255cef96f97682e7871cdee8b565d8', 'RzLN9', '孙臣红', -1, '2019510657', '223.104.102.66', 1584144024, NULL, 1584102035, 1584144024, 1),
(270, '3058362533@qq.com', '8d0eafea02b66c109044a40e95e729ee', 'RCc6A', '党寒冰', -1, '2019510843', '36.98.214.181', 1584149335, NULL, 1584102063, 1584149335, 1),
(271, '740681009@qq.com', '6b2f80f45cac49467438e2dc469ceeb3', 'ILyLT', '鞠昇佳', -1, '2019510599', '221.192.180.97', 1584145341, NULL, 1584102068, 1584145341, 1),
(272, '3479682742@qq.com', '3cd6156f89ce80c030c6273511154d86', 'w0NBM', '董华晴', -1, '2019510760', '183.199.210.63', 1584144074, NULL, 1584102106, 1584144074, 1),
(273, '1586124628@qq.com', 'd08a33eb5c65a37173d50e2b2367d2ea', 'whBiF', '赵奕', -1, '2019510794', '117.136.106.28', 1584144334, NULL, 1584102107, 1584144334, 1),
(274, '1652872282@qq.com', '8aa4d47d694987c4dd9c92a08cdb4dc6', 'O9FfC', '许宇豪', -1, '2019510616', '119.248.123.143', 1584144909, NULL, 1584102120, 1584144909, 1),
(275, '1012088912@qq.com', '033d44de513f9fbe78b5c22ea3d10c16', 'eLjyN', '李冠豪', -1, '2019510617', '183.199.104.255', 1584144100, NULL, 1584102162, 1584144100, 1),
(276, '394017598@qq.com', '16318b02d86332257983be2f29b594c6', 'hFF1m', '闫欣然', -1, '2019510591', '183.197.235.32', 1584146368, NULL, 1584102170, 1584146368, 1),
(277, '2065125296@qq.com', 'e508c42c9ce5d80c642e2aef3c466491', 'ly8si', '荀露琪', -1, '2019510519', '221.192.180.218', 1585205419, NULL, 1584102198, 1585205419, 1),
(278, '1779927165@qq.com', '493d3e9b27b3b7445c6bb74fc45ad6c6', 'u9Ysa', '王一诺', -1, '2019510754', '124.239.119.68', 1584144413, NULL, 1584102200, 1584144413, 1),
(279, '895767797@qq.com', 'bd972c05c8581fdcdcaf17b63b83ae0e', 'JtWtW', '李东蔚', -1, '2019510561', '120.6.227.176', 1584148211, NULL, 1584102210, 1584148211, 1),
(280, '1720311281@qq.com', 'c4f148ec1d1b543e47d54b4eb8799b93', '5J7RR', '邹建莹', -1, '2019510477', '183.198.43.175', 1584146549, NULL, 1584102226, 1584146549, 1),
(281, '1078859838@qq.com', '40d65c4568953ac728a7b1547587b6fd', 'eqKvx', '郭佳', -1, '2019510667', '121.19.251.243', 1584144088, NULL, 1584102281, 1584144088, 1),
(282, '1270042276@qq.com', '1616932fdc480aa5ef4ed663fa74879f', 'fH7SS', '李琼', -1, '2019512993', '183.189.24.201', 1584144015, NULL, 1584102286, 1584144015, 1),
(283, '3264942346@qq.com', '62cb611604201d25f344c3cfc3717b20', 'O2PNk', '董文', -1, '219510620', '223.210.140.141', 1584144732, NULL, 1584102307, 1584144732, 1),
(284, '15731812565@163.com', '811fb3bcc9a12bb3fe9704f510a2cd31', 'yiXik', '齐一帆', -1, '2018510763', '221.192.178.66', 1584151792, NULL, 1584102307, 1584151792, 1),
(285, '963214445@qq.com', 'e4936aeeff3947c8a12567201e04ef04', 'PaBRF', '蔡欣怡', -1, '2018510783', '27.190.62.163', 1584148485, NULL, 1584102328, 1584148485, 1),
(286, '1610375485@qq.com', '5c630f96147d4891cbe6a3fb6194f1f2', 'rgWgz', '乔若雨', -1, '2019510697', '106.9.77.129', 1584143979, NULL, 1584102378, 1584143979, 1),
(287, '3040105395@qq.com', '660c1b4e40e99300eeed72efb863ade5', 'AIygs', '张雅倩', -1, '2019510640', '117.136.47.137', 1584145456, NULL, 1584102385, 1584145456, 1),
(288, 'jinquit666@qq.com', 'e3517d221a1e3d77d50ba5ec10d66475', 'eCTMF', '吕津', -1, '2019510818', '183.197.115.248', 1584145329, NULL, 1584102404, 1584145329, 1),
(289, '2111757703@qq.com', '552aa3c4edab4a17a984719a80d3b197', 'wz1JE', '邱冰倩', -1, '2019510670', '183.199.176.50', 1584148929, NULL, 1584102444, 1584148929, 1),
(290, '3330725510@qq.com', 'dad6c3cf443fbbd4288bcc4d0c395ce5', 'Dlvig', '李小雨', -1, '2019510653', '183.199.126.89', 1584150441, NULL, 1584102459, 1584150441, 1),
(291, '1137562837@qq.com', '1ff3ec60ffc352783a54b849329e00e2', 'Yh87Y', '要若滢', -1, '2019510733', '111.226.134.182', 1584148652, NULL, 1584102475, 1584148652, 1),
(292, '2826083996@qq.com', 'f51088ce6f563a27dc09c62f572657d4', 'ZjYUz', '韩玥辉', -1, '2019510706', '183.198.251.179', 1584145864, NULL, 1584102508, 1584145864, 1),
(293, '2224851528@qq.com', '297ab90bea3448e086b9a8ac66cc53f4', 'v5MjP', '牛江玉', -1, '2019510755', '27.187.105.224', 1584147589, NULL, 1584102537, 1584147589, 1),
(294, '1424111256@qq.com', '670b94ba900bed42fc1b606b8b9d68cb', 'ih5wy', '李晓亮', -1, '2019510753', '60.1.29.5', 1584154289, NULL, 1584102540, 1584154289, 1),
(295, '1923036741@qq.com', '8e98bcf049925ff649dfcc95c1e6351a', 'VBCci', '李硕然', -1, '2019510540', '60.4.41.167', 1584102568, NULL, 1584102568, 1584102608, 1),
(296, '15097650919@sina.cn', '91d8f2db3389241a3fd951d05f8f03a1', 'OT2XI', '杨博腾', -1, '2019510556', '106.115.218.43', 1584145836, NULL, 1584102569, 1584145836, 1),
(297, '1664025462@qq.com', '15d8f6eba892857f172cf171172740b6', 'FoxQm', '杨楚楚', -1, '2019510528', '121.24.65.11', 1584144426, NULL, 1584102569, 1584144426, 1),
(298, '986100202@qq.com', '1c52287bb3a1b26f64dad85f201d7f81', 'OKUxl', '许佳慧', -1, '2019510597', '183.199.245.198', 1584145135, NULL, 1584102585, 1584145135, 1),
(299, '1356144225@qq.com', '0cfe9cf3706e20b6d6dc4f99e11b930e', 'Mu8V6', '王美玲', -1, '2019510577', '121.16.209.2', 1584145136, NULL, 1584102709, 1584145136, 1),
(300, '2320881526@qq.com', 'c087a5bc44a71116bdda2c8718948de0', 'Aurln', '陈坤莹', -1, '2019510455', '221.192.179.56', 1584144186, NULL, 1584102726, 1584144186, 1),
(301, '1570385080@qq.com', '3ac15bfdbee5d4d783b0973adf626651', 'FN0tp', '王紫璇', -1, '2018510791', '36.98.245.135', 1584257710, NULL, 1584102854, 1584257710, 1),
(302, '1841540570@qq.com', '4b66568bd4dc17a4dec0f24afa19fd80', 'FtJZF', '王曼羽', -1, '2019510662', '221.192.178.61', 1584144101, NULL, 1584102881, 1584144101, 1),
(303, '2814497506@qq.com', '86e765efcff82697028e218c3dc5c74b', 'dmBck', '尚思棋', -1, '2019510789', '183.199.233.26', 1584152505, NULL, 1584102938, 1584152505, 1),
(304, '2815419243@qq.com', '15a7d7287eaedc71efec14b87df611ab', 'KbTxL', '李静', -1, '2019510449', '123.180.80.85', 1584150367, NULL, 1584102943, 1584150367, 1),
(305, '2806310695@qq.com', 'be4cfb59fe532344b6b1e8857639d9f1', 'geZsH', '张晓茹', -1, '2019510665', '36.98.207.33', 1584147954, NULL, 1584103073, 1584147954, 1),
(306, '1679759773@qq.com', '9e6938d139fa0044e6345c963bf05465', 'iQ3Vl', '王泽雨', -1, '2018510793', '118.74.244.193', 1584147680, NULL, 1584103106, 1584147680, 1),
(307, '1092030588@qq.com', 'bd4d78de7d2e60df428a74bd99748cb8', 'QW0xV', '魏一帆', -1, '2019510428', '221.192.178.96', 1584145061, NULL, 1584103127, 1584145061, 1),
(308, '848596526@qq.com', 'b0bae6a5a15d0ce2f26c470422745efa', 'ilm70', '董瑞轩', -1, '2019510677', '124.238.205.83', 1584150703, NULL, 1584103142, 1584150703, 1),
(309, '2919185008@qq.com', '41def712802569c8ab4056597d77e825', 'KhLsh', '穆书伟', -1, '2019510722', '183.197.235.213', 1584146455, NULL, 1584103143, 1584146455, 1),
(310, '1838061988@qq.com', '0c2c739d307598ba74b1891d7c101ebd', 'puw8i', '张杉', -1, '2019510788', '110.244.90.204', 1584146273, NULL, 1584103148, 1584146273, 1),
(311, '3256425619@qq.com', '0441a5f8ca216a560f32584af9d296a2', 'GGS28', '贾雯瞳', -1, '2019510814', '106.117.76.95', 1584145856, NULL, 1584103201, 1584145856, 1),
(312, 'fmy1135602544@qq.com', '5c0a917bf53a55608c8625460652f1c3', 'AwWyc', '冯明月', -1, '2019510639', '223.104.101.28', 1584144274, NULL, 1584103287, 1584144274, 1),
(313, '1198552489@qq.com', '218b033cb0c8e5eaa98fbe3acb34572f', 'UY6hF', '候晓堃', -1, '2019510562', '120.9.116.62', 1584147449, NULL, 1584103307, 1584147449, 1),
(314, '2106541836@qq.com', '8e4b9af0c3d1354fd25b9482f7f6d4b2', '7Otrc', '丁文颖', -1, '2019510693', '106.118.250.80', 1584489330, NULL, 1584103328, 1584489330, 1),
(315, '1583952727@qq.com', '099983697800217c61390c0763262cfc', '0mPZG', '刘浩添', -1, '2019510625', '36.98.182.24', 1584144199, NULL, 1584103331, 1584144199, 1);
INSERT INTO `api_user` (`id`, `email`, `password`, `password_salt`, `name`, `sex`, `student_id`, `last_login_ip`, `last_login_time`, `last_login_token`, `create_time`, `update_time`, `status`) VALUES
(316, '1203349996@qq.com', '32f11fd0fec3b90ce62490415ac3dc19', 'hhxBD', '赵玉晗', -1, '2019510823', '221.192.178.233', 1584145207, NULL, 1584103381, 1584145207, 1),
(317, '2675262394@qq.com', 'c2929e1101e3713cb060fd79a7c7be0c', 'Ozg9G', '刘敏', -1, '2019510582', '106.118.151.94', 1584151788, NULL, 1584103388, 1584151789, 1),
(318, '1406510443@qq.com', 'd0e5e70ac59567ea96de261a9ad94ee6', 'uQMdq', '邢跃', -1, '2019510821', '27.189.161.147', 1584145911, NULL, 1584103391, 1584145911, 1),
(319, '1365281282@qq.com', 'f4dda6e3dd962fe9957735cafa0f3363', 'YBoaF', '康泽霖', -1, '2019510593', '110.230.137.188', 1584144346, NULL, 1584103403, 1584144347, 1),
(320, '2476613295@qq.com', '239ee45ade82411ef59f5ca62cab9e46', 'TArvT', '马星宇', -1, '2019510780', '101.27.235.174', 1585206517, NULL, 1584103406, 1585206517, 1),
(321, '1990513529@qq.com', '9409591dfbfcfdaf5c380417465a8b36', '3D0bS', '夏一曾', -1, '2019510739', '111.227.246.206', 1584144078, NULL, 1584103411, 1584144078, 1),
(322, '2544970037@qq.com', '4579ae3c31f4ca51b09ac48aa62fc527', 'QrChd', '路子梁', -1, '2019510431', '121.27.124.31', 1584149295, NULL, 1584103433, 1584149295, 1),
(323, '2075448248@qq.com', 'd098140b39035b27b1c7d0ecd6dde497', 'zvndP', '王轩', -1, '2019510601', '183.199.181.158', 1584153405, NULL, 1584103462, 1584153405, 1),
(324, '2310199489@qq.com', '47d04d2c0b168080614686c15948e528', 'NqH5w', '严萧彤', -1, '2019510592', '221.192.178.148', 1584144108, NULL, 1584103470, 1584144108, 1),
(325, '2712666391@qq.com', 'a0f599974ab16420ea0d2c97fd558d33', '8v8yD', '刘颖', -1, '2019510467', '124.238.65.25', 1584144648, NULL, 1584103482, 1584144648, 1),
(326, '1756454052@qq.com', '2f8d67d69ebc1f4b3136a099dcd51cfb', 'iSoJe', '李天豪', -1, '2019510567', '101.23.22.124', 1584145153, NULL, 1584103483, 1584145153, 1),
(327, '3145141667@qq.com', 'ff209a875891039a98bedeb75e86e8aa', 'WHVNY', '张泽逸', -1, '2019510607', '221.192.180.167', 1584149579, NULL, 1584103521, 1584149579, 1),
(328, '2217765136@qq.com', '1bbe7ace3cbc264edf939526b297879b', 'ULtLC', '王天瑶', -1, '2019510608', '27.186.161.122', 1584146386, NULL, 1584103546, 1584146386, 1),
(329, '1967751098@qq.com', 'f344433c69f02e353e905cca3182a0c4', 'mrhfh', '刘胜楠', -1, '2019510782', '111.226.133.200', 1584146114, NULL, 1584103553, 1584146114, 1),
(330, '2382720047@qq.com', 'de72e74348db840fb6e319c97bdc8c58', 'MNKbk', '王思佳', -1, '2019510580', '27.186.131.230', 1584145328, NULL, 1584103557, 1584145328, 1),
(331, '1765144127@qq.com', '62a2ff3ca8516b9b9e17f8427cd0a0eb', 'cYyGn', '王利莎', -1, '2019510829', '120.1.88.84', 1584144874, NULL, 1584103590, 1584144874, 1),
(332, '2533436852@qq.com', '8c61614ab023e021525a157f5fbc3c59', 'MgN6A', '李豪雪', -1, '2019510450', '101.28.230.144', 1584185637, NULL, 1584103594, 1584185637, 1),
(333, '1922424411@qq.com', 'dc2e8992461a8ccb4142fb6aa4772522', '5j3O1', '蔡俊景', -1, '2019510446', '111.62.214.19', 1584146462, NULL, 1584103619, 1584146462, 1),
(334, '1543952201@qq.com', '21418bd084139184149ad98424de3e94', 'HTL3u', '屈圣云', -1, '2019510514', '111.226.225.243', 1584147002, NULL, 1584103648, 1584147002, 1),
(335, '932785592@qq.com', '58335c2b04983585b45ef8e299acc76f', 'cCS8S', '曹燊颖', -1, '2019510790', '182.51.86.197', 1584105007, NULL, 1584103648, 1584105007, 1),
(336, '3241981746@qq.com', '9c1160f994431cbe3edb1a9bb73e25ce', 'Qnpd7', '葛长奥', -1, '2019510555', '223.104.102.39', 1584145120, NULL, 1584103667, 1584145120, 1),
(337, '2923502750@qq.com', '4d6554b330b73e3e240ce8e7366c4b24', 'Qi6N6', '邢广阔', -1, '2019510438', '124.238.204.97', 1584148555, NULL, 1584103731, 1584148555, 1),
(338, '2656197302@qq.com', 'd0d65837aac56da0e83221aa49cef27b', 'NEpA3', '刘晓旭', -1, '2019510652', '110.244.132.130', 1584145256, NULL, 1584103741, 1584145256, 1),
(339, '328856124@qq.com', '686e4ffb878213a452ff989f25f8a77d', 'U0Xz4', '贾智博', -1, '2019510557', '221.192.180.150', 1584146517, NULL, 1584103765, 1584146517, 1),
(340, '384896476@qq.com', 'fcd7e8c33f378f167e0a7f8e7fc62c86', 'OFUuq', '刘学', -1, '2019510451', '223.104.103.209', 1584145132, NULL, 1584103780, 1584145132, 1),
(341, '1479958215@qq.com', 'b0ab0bab56601cd2409fb733cf2c0638', 'NhoQM', '杨海燕', -1, '2019510837', '183.197.169.90', 1584145937, NULL, 1584103791, 1584145937, 1),
(342, '1315032485@qq.com', '097ecb5364e62abe4102076619479cf9', 'ddpgK', '李梦轩', -1, '2019510530', '27.189.164.153', 1584144569, NULL, 1584103821, 1584144569, 1),
(343, '1972254148@qq.com', 'e9752a84a6bf6f541b6767fd8ca05137', 'NUQZK', '韩雨泽', -1, '2019510522', '119.248.142.0', 1584144424, NULL, 1584103823, 1584144424, 1),
(344, '2038736843@qq.com', '48932c008bbe7eb3c75327976a52616e', 'BkL4C', '习天旭', -1, '2019510732', '223.104.13.54', 1584144570, NULL, 1584103829, 1584144570, 1),
(345, '209511693@qq.com', 'cd7fbaa3d6eb286b644e35d06b41f2c5', 'aiLPP', '安芸培', -1, '2019510504', '27.187.197.208', 1584151230, NULL, 1584103834, 1584151230, 1),
(346, '2995568263@qq.com', 'abfa420df648f242bc0c1861a07dc427', '9U4JF', '刘洋', -1, '2019510541', '36.98.187.169', 1584144303, NULL, 1584103840, 1584144303, 1),
(347, '2434038824@qq.com', '364ff6545771dcf7e11a616f63e1f70c', 'EsAPN', '赵文思', -1, '2019510574', '123.180.0.248', 1584145155, NULL, 1584103843, 1584145155, 1),
(348, '961300194@qq.com', 'f516b4a66641cbea09a5dec1e59ae10f', '2tUwd', '翟青林', -1, '2019510610', '119.182.154.174', 1584145818, NULL, 1584103870, 1584145818, 1),
(349, '843093785@qq.com', '0df6f68069f1389556119958a12cbd31', 'iQv6N', '梁辉', -1, '2019510773', '36.98.227.177', 1584149071, NULL, 1584103878, 1584149071, 1),
(350, '3531263016@qq.com', 'de66a97b4202aafb9be50d4ea9885070', 'Dfb1z', '卢杰', -1, '2019510532', '36.98.189.239', 1584145078, NULL, 1584103887, 1584145078, 1),
(351, '2412751686@qq.com', 'dd6ad155ff29e4e396f25e54b4666d88', 'IspK5', '李玟', -1, '2019510569', '101.30.124.114', 1584146815, NULL, 1584103918, 1584146815, 1),
(352, '1764862090@qq.com', 'e4e33b26de7bffd35d8dcab17a477e39', 'wFdrk', '张若曦', -1, '2018510786', '183.199.229.195', 1584146849, NULL, 1584103947, 1584146849, 1),
(353, '2522454004@qq.com', '261ee03c0f7f6c84513def5fa31388da', '4Bln0', '王焕格', -1, '2019510485', '182.51.86.90', 1584145189, NULL, 1584103957, 1584145189, 1),
(354, '1971787264@qq.com', 'bb63ea0c1344bae36a46aa6607d55301', 'ZDUeS', '刘玉明', -1, '2019510515', '124.238.27.207', 1584145415, NULL, 1584103962, 1584145415, 1),
(355, '1502541400@qq.com', '7caf4cace447db9dbb80eccd00c33559', 'gqiM8', '赵国栋', -1, '2019510623', '124.237.62.108', 1584146082, NULL, 1584103963, 1584146082, 1),
(356, '2458306881@qq.com', '268c9cf2d7d8634f48921d6e632caf97', 'WNoqF', '朱昊', -1, '2018510623', '106.118.128.160', 1584144394, NULL, 1584103964, 1584144394, 1),
(357, '3498149858@qq.com', 'd90b54d5ef7376b59a7972bd82107e24', 'MnZDC', '尹杰', -1, '2019510466', '221.192.179.234', 1584103969, NULL, 1584103969, 1584103969, 1),
(358, '1463619045@qq.com', '39f34ee7da005a2939d9af2495cc7d35', '238jF', '牛子云', -1, '2019510590', '223.104.101.210', 1584144092, NULL, 1584103997, 1584144092, 1),
(359, '483898240@qq.com', '75c585d4ba73c667850698e794b4e73a', 'mT2Pr', '王佳欢', -1, '2019510704', '27.187.201.4', 1584145162, NULL, 1584104078, 1584145162, 1),
(360, '1346922489@qq.com', 'ada73d7281b4e524d14f31cf748d94ab', 'nYCPK', '王杨美慧', -1, '2019510598', '183.197.213.220', 1584146061, NULL, 1584104117, 1584146061, 1),
(361, '1536697754@qq.com', '7eac3de3eaf5e077ca914174376918dc', 'pLv9H', '邓子凯', -1, '2019510503', '221.192.179.141', 1584144440, NULL, 1584104157, 1584144440, 1),
(362, '2648766471@qq.com', 'b8aba92d804962298859de8d9c90be1e', 'A6OtM', '王壮壮', -1, '2019510751', '183.198.85.122', 1584151427, NULL, 1584104165, 1584151427, 1),
(363, '2548628598@qq.com', 'afca96cbc5fb5ff4d0bb7c0f938dc94b', 'zHm09', '杨瑞洁', -1, '2019510718', '183.199.109.118', 1584148869, NULL, 1584104227, 1584148869, 1),
(364, '2654651518@qq.com', '22edb8b41203f93f0c60b59311c51435', 'e4zUd', '刘玉莹', -1, '2019510631', '119.249.79.92', 1584144208, NULL, 1584104307, 1584144208, 1),
(365, '1037077704@qq.com', '58e081fc61a03446ec5f599f146b9ae9', 'nCH7G', '阳澄', -1, '2019510626', '106.121.163.239', 1584144416, NULL, 1584104342, 1584144416, 1),
(366, '1769459674@qq.com', '8131ce5fd0827e052cc6d7c9d67bddd0', 'lMAxs', '王悦然', -1, '2019510542', '101.31.167.36', 1584150943, NULL, 1584104371, 1584150943, 1),
(367, '1772498610@qq.com', '488548b250fff2a1856a4a88d376dd84', 'ue93F', '尉玲娜', -1, '2018510789', '36.98.43.13', 1584147549, NULL, 1584104380, 1584147549, 1),
(368, '2205153649@qq.com', 'a97d8710d5f0dd89e2d6580193aa0991', 'dmucc', '廉祺', -1, '2019510682', '120.9.41.217', 1584146031, NULL, 1584104396, 1584146031, 1),
(369, '1526803495@qq.com', '0d9a91ac095dfbf96b329e6ba82e80ec', 'oGFld', '赵杏淼', -1, '2019511877', '124.236.250.70', 1584159841, NULL, 1584104420, 1584159841, 1),
(370, '2855100438@qq.com', '6e40660ec3815d9714b03cd1a1c6c449', 'rGKMn', '韦梦月', -1, '2019510708', '36.98.31.127', 1584149536, NULL, 1584104662, 1584149536, 1),
(371, '593235593@qq.com', '87f8d444b1eab083881ced35c34532ae', 'uBQvV', '蒋琦璇', -1, '2019510533', '123.196.242.225', 1584146146, NULL, 1584104735, 1584146146, 1),
(372, '1165465006@qq.com', '4a67fd5c4241961917665f0e034f0fcf', '2SAnh', '王拂晓', -1, '2019510552', '60.1.99.36', 1584104793, NULL, 1584104793, 1584104793, 1),
(373, '1443817236@qq.com', 'd358eb92916e495aab29aa756d58378b', '4kaZs', '石辉', -1, '2018510482', '223.104.13.38', 1600786960, NULL, 1584105061, 1600786960, 1),
(374, '593429053@qq.com', 'bf841159314d0d1f9716eb2723d88d82', 'kg603', '贺少茜', -1, '2019510714', '218.11.108.17', 1584146283, NULL, 1584105064, 1584146283, 1),
(375, '1533329580@qq.com', '78624604f0489f1c22b525995f9aead0', 'EHEJk', '李杰', -1, '2019510629', '111.225.178.187', 1584187135, NULL, 1584105066, 1584187135, 1),
(376, '1742313941@qq.com', '136efa5c4f56623093ce502b8ea70fc9', 'knkuz', '郭然', -1, '2019510776', '27.188.170.17', 1584145319, NULL, 1584105124, 1584145319, 1),
(377, '2224822044@qq.com', '55831b58d8f3039aa983504bcb014991', 'LyAB3', '王佳瑶', -1, '2019510576', '183.199.112.33', 1584145462, NULL, 1584105133, 1584145462, 1),
(378, '2770735650@qq.com', 'e36d9953a1f433cc774030b576bd3594', 'ZfV3A', '王宁', -1, '2019510681', '183.197.25.181', 1584148142, NULL, 1584105140, 1584148142, 1),
(379, '1954527806@qq.com', 'cff61f3d54324766d031aeb0880a52e4', '0hRIM', '刘嘉诚', -1, '2019510565', '101.75.182.47', 1584145349, NULL, 1584105141, 1584145349, 1),
(380, '1553861342@qq.com', 'de55da87756ddd3c78d30378f84c011a', 'CQfH3', '袁可心', -1, '2019510637', '183.197.82.104', 1584145022, NULL, 1584105165, 1584145022, 1),
(381, '2352369803@qq.com', 'b09deaf7bebcc54173c59bf390c25273', 'fihkA', '祝甲玉', -1, '2019510649', '223.104.13.248', 1584148455, NULL, 1584105177, 1584148455, 1),
(382, '2456873564@qq.com', 'b79ee6b257090c14811afa5400f1e5d1', 'F86FG', '张亚宽', -1, '2019512958', '223.104.101.206', 1584772119, NULL, 1584105188, 1584772119, 1),
(383, '2504393805@qq.com', '9ba92e58b82dbfc26c08f5b3809f9002', 'KXs3u', '李欣', -1, '2019510786', '106.113.3.210', 1584146423, NULL, 1584105207, 1584146423, 1),
(384, '1735271266@qq.com', 'a151a34e71e57272f8e855f6b1292251', 'RpY4b', '崔丽美', -1, '2019510692', '124.64.17.100', 1584145895, NULL, 1584105421, 1584145895, 1),
(385, '1905269394@qq.com', '710abdc0c23ab1254244abd459c165f9', 'ZOBWm', '陈梦冉', -1, '2019510759', '121.27.225.117', 1584147800, NULL, 1584105601, 1584147800, 1),
(386, '798922855@qq.com', 'ab85b5abcbc09422430bb465e50669c4', 'MU3Hg', '王佳音', -1, '2019510702', '110.250.198.52', 1584144062, NULL, 1584105648, 1584144062, 1),
(387, '857446152@qq.com', '9acca7a8c68f43d3b727476a14fd05a7', 'ZzJgW', '王一凡', -1, '2019510688', '36.98.227.177', 1584149239, NULL, 1584105782, 1584149239, 1),
(388, '1026118283@qq.com', '6aff823f892c0cfd372e52eeff03dd1d', 'Bdlos', '肖笛', -1, '2019510715', '120.11.128.6', 1584151887, NULL, 1584105801, 1584151887, 1),
(389, '1910298732@qq.com', '7c681fcfc95cc77b8ce26c62c2b5e9ce', 'QEDRT', '王一凡', -1, '2018510499', '36.98.181.206', 1600766005, NULL, 1584105824, 1600766005, 1),
(390, '2226067845@qq.com', 'c6b6afd377e0bd90d1ec30bb6d7f2b7c', 'JVyFo', '王子涵', -1, '2019510728', '106.117.171.180', 1584147147, NULL, 1584105871, 1584147147, 1),
(391, '1049534260@qq.com', 'bc50b3e87ab60809c72b30274bdcac68', '8Pg2Q', '曹志', -1, '2018512944', '123.180.252.91', 1584106719, NULL, 1584105905, 1584106719, 1),
(392, '1005454904@qq.com', 'ed7662edbc4182cdf6d2cd7f6714dc8d', '6Us7p', '沈莹莹', -1, '2019510473', '183.197.74.235', 1584145957, NULL, 1584105992, 1584145957, 1),
(393, '2215325343@qq.com', '1f693a4b23735e65a7f0d069b60510f4', 'Q6A59', '陈晶晶', -1, '2019510630', '183.197.75.166', 1584144090, NULL, 1584105997, 1584144090, 1),
(394, '2731277452@qq.com', 'c2ba423cfda187f08dc81d20665d2f15', 'bpjJr', '卢月圆', -1, '2019510660', '183.199.29.38', 1584147382, NULL, 1584106044, 1584147382, 1),
(395, '1294729264@qq.com', 'f8058dded678d54c91ee0bebd58c9ece', '7Ndqc', '周思佳', -1, '2018510594', '223.104.13.133', 1600847044, NULL, 1584106095, 1600847044, 1),
(396, '1693432597@qq.com', '536630c75586f7ecabe80db028e4a554', 'MdlK4', '宋瑞姿', -1, '2019510831', '183.197.115.68', 1584146215, NULL, 1584106157, 1584146215, 1),
(397, '1526144623@qq.com', 'ea1bc5223f474a5f346ccc99b252f004', 'g5665', '王沼静', -1, '2019510600', '106.117.59.185', 1584146690, NULL, 1584106280, 1584146690, 1),
(398, '1371882554@qq.com', 'c5e9dff9e96ac8f311297c2888197ed4', 'AVsLg', '李笑雨', -1, '2019510534', '116.132.110.132', 1584144941, NULL, 1584106283, 1584144941, 1),
(399, '2676821652@qq.com', 'd8af761ac8dac2cc4ce1a657f22528f3', 'QKzLk', '赵梦娜', -1, '2019510661', '221.192.179.170', 1584145145, NULL, 1584106484, 1584145145, 1),
(400, '2660854899@qq.com', '6ff52c975abd3b75976a811a800d7ce5', 'pK7OC', '赵月', -1, '2019510537', '182.51.86.210', 1584146964, NULL, 1584106550, 1584146964, 1),
(401, '973967591@qq.com', '4274123ce01788522b8841e1f3fff372', 'EqHDI', '姜奥琦', -1, '2019510669', '106.119.67.209', 1584149117, NULL, 1584106578, 1584149117, 1),
(402, '2537618080@qq.com', 'ed7d3bb4491fee11a27d0ec6b3d11bb9', 'WTUz4', '段佳佳', -1, '2019510721', '221.192.180.218', 1584144454, NULL, 1584106873, 1584144454, 1),
(403, '2455462633@qq.com', 'decad514ed6191eab219c0d31b6ddd5d', 'Gd4Pt', '郑梦飞', -1, '2019510511', '183.197.10.48', 1584147157, NULL, 1584106951, 1584147157, 1),
(404, '1838282381@qq.com', '7337f29a1126ae81e6b7f77c21370a28', '5RiNv', '顾雯鑫', -1, '2019510849', '221.192.179.158', 1584144906, NULL, 1584106989, 1584144906, 1),
(405, '3042069806@qq.com', '4d72aa9e44ed60b6d953a5c50f095d67', 'asjBj', '裴静雨', -1, '2019510713', '183.199.187.43', 1584147882, NULL, 1584107107, 1584147882, 1),
(406, '1515195385@qq.com', '3aac23b8f3e83b27d7e45f154f78d03d', 'iJM5H', '王磊', -1, '2018510804', '36.98.246.148', 1600923720, NULL, 1584107147, 1600923720, 1),
(407, '2279832765@qq.com', 'c35f5ca447bf3c39e6e47a1058fe1476', '4Fvpy', '马子涵', -1, '2018510726', '223.104.13.135', 1600769623, NULL, 1584107375, 1600769623, 1),
(408, '2378127328@qq.com', '3434c0100df971f7d187c6f6bf3623b0', 'jHZ3Q', '李芳芳', -1, '2019510609', '183.197.32.6', 1584146471, NULL, 1584107426, 1584146471, 1),
(409, '1798219074@qq.com', '5f57f3d9bd09e6b2d54b184b0da133fd', 'pGeZY', '张佳佳', -1, '2019510772', '101.26.130.156', 1584584669, NULL, 1584107537, 1584584669, 1),
(410, '2684329403@qq.com', '46f5f5e43dadc0f797ef74ed74e019fd', 'FyNoI', '潘岚', -1, '2019510444', '120.15.118.209', 1584148288, NULL, 1584107798, 1584148288, 1),
(411, 'www.1264459196@qq.com', '82955e2399ab53879c7da8134daaae11', 'fO7KF', '苗然', -1, '2018510605', '183.197.18.212', 1600786268, NULL, 1584107845, 1600786268, 1),
(412, '1824743824@qq.com', 'ecb6de226c09b1dd6348f4323b266eea', 'ufkhF', '魏叶茹', -1, '2018510752', '117.136.2.35', 1600744146, NULL, 1584107888, 1600744146, 1),
(413, '1904827513@qq.com', '594366c11f24c76f8cd8a94901522eb9', 'YA3gz', '韩子阳', -1, '2019510471', '1.94.39.58', 1584148663, NULL, 1584108201, 1584148663, 1),
(414, '1850265999@qq.com', 'b381a65f65f6ea5cc49dbe4bbda943f3', '75jlB', '张田田', -1, '2019510464', '121.24.89.94', 1584145189, NULL, 1584109214, 1584145189, 1),
(415, '1259202641@qq.com', 'a70892fa7f329a5192b052ed15869701', 'oTzQY', '叶京', -1, '2019510741', '223.104.101.211', 1584109384, NULL, 1584109384, 1584109384, 1),
(416, '2549368094@qq.com', '8cd328685d09e5c8fe6b5d0ea199d9b7', 'an4z8', '白雯华', -1, '2018510716', '221.192.180.96', 1600767737, NULL, 1584109634, 1600767737, 1),
(417, '604117753@qq.com', '8ba592f033d16ba6d217f2fa29238965', 'TW9vB', '周炳坤', -1, '2019510791', '183.199.118.169', 1584145235, NULL, 1584110004, 1584145235, 1),
(418, '1344823833@qq.com', 'd636817ea101414ae1dff60a340c33e4', 'cY3Vq', '姜赵元', -1, '2017510421', '36.98.142.6', 1584110432, NULL, 1584110432, 1584110432, 1),
(419, '578883209@qq.com', 'b6e769ccccb93ae2ffcd9e8ff53558e0', 'EBAJM', '赵培松', -1, '2017510415', '121.27.61.41', 1584110557, NULL, 1584110557, 1584110557, 1),
(420, '1844248536@qq.com', 'b09c15b02c0809813ee8713fcadc6152', '0Dvmy', '李思萌', -1, '2019510550', '183.199.208.125', 1584152364, NULL, 1584110690, 1584152364, 1),
(421, '1574325903@qq.com', 'd8cf3a36ece60bb3306ec03e3456b752', 'pqukt', '王佳兴', -1, '2019510559', '183.199.35.90', 1584146467, NULL, 1584110948, 1584146467, 1),
(422, '2720294113@qq.com', '5b94d27f455d7c56ef454c815f02f438', '4E5s5', '高聪慧', -1, '2019510853', '106.114.0.46', 1584111400, NULL, 1584111400, 1584111400, 1),
(423, '1677554556@qq.com', 'b9aad6a85322938640c0d61049960c2f', '2Qaj6', '赵运杰', -1, '2019510497', '183.199.230.205', 1584144428, NULL, 1584114064, 1584144428, 1),
(424, '1054733950@qq.com', 'a79a0506343995157e1843f5bf77614b', 'WJHzR', '王真', -1, '2019510628', '101.26.164.195', 1584145698, NULL, 1584114305, 1584145698, 1),
(425, '2584642770@qq.com', '9b26a98dfa8f315b1ea6089821dd3c3f', '2uzAj', '常冉冉', -1, '2019510447', '123.196.130.52', 1584144280, NULL, 1584119565, 1584144280, 1),
(426, '2328234740@qq.com', 'e54b42eaa07fc3ee9181c7f0047990e5', 'aksrY', '苏佳', -1, '2019510453', '106.119.48.175', 1584151777, NULL, 1584120766, 1584151777, 1),
(427, '2371640620@qq.com', '14b9d62334b7e178357249359301d13f', 'lumXQ', '刘涛', -1, '2019510658', '106.115.10.14', 1584146141, NULL, 1584122537, 1584146141, 1),
(428, '1829046788@qq.com', '0d21ed694c1274a417443e9be52d5c99', 'uJZrJ', '王丹阳', -1, '2019510604', '182.51.86.98', 1584144688, NULL, 1584141061, 1584144688, 1),
(429, '1750734158@qq.com', '0f068e0f05a5d8c2fa9a4eb5f769000c', 'Oiq4l', '王子腾', -1, '2019510799', '117.136.2.131', 1584144795, NULL, 1584141471, 1584144795, 1),
(430, '1498717731@qq.com', '37718a039c9f1e0ea6e46580dd2055ed', '2lISA', '李玉蕊', -1, '2019510487', '111.224.122.156', 1584149525, NULL, 1584141977, 1584149525, 1),
(431, '2577750601@qq.com', '79c9637ee2ed47470656116376ddbb29', 'vrmMJ', '赵熙龙', -1, '2019510432', '106.119.49.80', 1584146223, NULL, 1584141992, 1584146223, 1),
(432, '1151516925@qq.com', '811c074ae55ff524c2b106076f4d515d', '1gVaA', '王宏瑄', -1, '2019510747', '110.247.236.254', 1584147283, NULL, 1584142645, 1584147283, 1),
(433, '2394857495@qq.com', 'fd195aed4160217fcce2bbc823244474', '2ZC4z', '郑渊', -1, '2018510667', '101.29.238.66', 1584146999, NULL, 1584143337, 1584146999, 1),
(434, '2313274948@qq.com', 'aa2aa28ee5afab7e2427f5269935efe9', 'GsoB3', '白佳莹', -1, '2019510643', '183.198.202.54', 1584144964, NULL, 1584143416, 1584144964, 1),
(435, '726857241@qq.com', 'bb084b03165dcf1bdf736c3ab0589eed', 'VmliQ', '宋心怡', -1, '2019510531', '183.197.88.173', 1584144054, NULL, 1584143733, 1584144054, 1),
(436, '1401766210@qq.com', 'd58c449768601f58fbd0ce9f9c249297', 'lC39x', '王宏婧', -1, '2018510553', '36.98.50.186', 1600765628, NULL, 1584144259, 1600765628, 1),
(437, '2011358460@qq.com', '429741706a70a6a92a766cb3c97a44ea', 'UG2vq', '郝诗雯', -1, '2019510573', '223.104.102.36', 1584151854, NULL, 1584144334, 1584151854, 1),
(438, '3058698643@qq.com', '360a90a0a05770e9b45e6eaeef495ac9', 'loiwk', '张利达', -1, '2019510736', '27.189.186.63', 1584237205, NULL, 1584144473, 1584237205, 1),
(439, '243550166@qq.com', '8a948d3b4f7a6ea81dc086b40a2d749d', 'GnMlF', '周润', -1, '2017510534', '183.197.242.38', 1584144524, NULL, 1584144524, 1584144524, 1),
(440, '962372244@qq.com', '78c2f31a2977c532161482370379880c', 'gwm1U', '张亚坤', -1, '2019510492', '120.0.230.97', 1584144685, NULL, 1584144563, 1584144685, 1),
(441, '346810388@qq.com', '048ba314d47f5a55d376813c532e5bae', 'Ujsf2', '秦霖煊', -1, '2019510632', '106.114.198.164', 1584144957, NULL, 1584144567, 1584144957, 1),
(442, '1363811240@qq.com', '597d0bf1172a58dd2d55492d094fe6f1', 'hH3t3', '王俊富', -1, '2019510684', '182.51.86.49', 1584145399, NULL, 1584144613, 1584145399, 1),
(443, '2696495323@qq.com', '6e05c47889b1c69e048d3e3d76117db8', '8XxFb', '杜晓彤', -1, '2018510663', '36.98.61.181', 1600864440, NULL, 1584144657, 1600864440, 1),
(444, '2319031556@qq.com', '2733f64d5f880999d6cef0a8b14359e6', 'eWBVK', '王文选', -1, '2019512957', '218.11.124.187', 1584145257, NULL, 1584144879, 1584145257, 1),
(445, '3121916034@qq.com', '943263dc9605cb1c7d0b7a3363bec018', 'Pukwq', '韩慈', -1, '2019510783', '223.104.103.227', 1584144998, NULL, 1584144895, 1584144998, 1),
(446, '984727089@qq.com', '5c3a1b80c4ea96c2ecd82079a5de1fe0', 'SpLA8', '刘晨彪', -1, '2018510428', '221.192.179.28', 1600931915, NULL, 1584144901, 1600931915, 1),
(447, '3117036576@qq.com', 'ef93ca6036691db62e45c1441b968ec0', '4OZrp', '陈雪纯', -1, '2019510596', '106.117.142.37', 1584145051, NULL, 1584144916, 1584145051, 1),
(448, '2913450339@qq.com', '0c0547c160dd6247aed459d1185209e4', 'WAUYj', '武佳梦', -1, '2019510544', '183.198.7.153', 1584147105, NULL, 1584144958, 1584147105, 1),
(449, '2960781167@qq.com', '1b766f439832b510d7db04a1380c9db0', 'I6NQr', '冯艺', -1, '2019510635', '110.247.210.9', 1584145148, NULL, 1584145148, 1584145148, 1),
(450, '2285126610@qq.com', 'c6f1322f37d1810028aa48464acfe2bd', 'PjzuH', '胡一帆', -1, '2018510476', '223.104.13.138', 1600929983, NULL, 1584145159, 1600929983, 1),
(451, '1154666409@qq.com', '7056a40975b5673a1e660ac26037ec95', 'g2jb5', '曹向坤', -1, '2016512381', '27.187.59.75', 1584152509, NULL, 1584145161, 1584152509, 1),
(452, '2085225163@qq.com', 'f2803b024e91129f6e13befe0ee80e8e', 'p5pbw', '李琳', -1, '2019510480', '183.197.24.60', 1584146067, NULL, 1584145177, 1584146067, 1),
(453, '2841994860@qq.com', 'e6d833076b0831539a0f8fc12cb7e56c', 'pkalt', '孙楠', -1, '2018510822', '221.192.178.116', 1600782391, NULL, 1584145185, 1600782391, 1),
(454, '2071568231@qq.com', '24de46564643cb6b1c264522fa2e89be', '29UlO', '贾若辰', -1, '2019510490', '36.98.71.24', 1584145284, NULL, 1584145212, 1584145284, 1),
(455, '1031860608@qq.com', '4d099ecb46912f4981a7a871de770476', '3YJp3', '蒋官正', -1, '2018510435', '221.192.180.243', 1600863367, NULL, 1584145244, 1600863367, 1),
(456, '2901639255@qq.com', 'fd0476e330f9abbc3ac24ca73b38c26d', 'NxZuh', '胡晶晶', -1, '2019510694', '223.89.129.228', 1584145347, NULL, 1584145272, 1584145347, 1),
(457, '2661351437@qq.com', 'af694d9324848ddb69232cef398bef07', 'TYWnD', '郭昱婕', -1, '2019510479', '183.198.25.134', 1585202664, NULL, 1584145278, 1585202664, 1),
(458, '2328916201@qq.com', '01187b8b1ec9420eb814881edfa5796b', 'ec1vG', '王新瑶', -1, '2018510723', '182.51.86.92', 1584145399, NULL, 1584145399, 1584145399, 1),
(459, '205006445@qq.com', '0233fe7ef32b0ee9b97850bd0664f384', 'LGrpE', '汲恒龙', -1, '2018510438', '36.98.54.236', 1600766250, NULL, 1584145416, 1600766250, 1),
(460, '1498490527@qq.com', 'e76b455d261b82ee7faca7676efa7150', 'ZspLR', '穆泽本', -1, '2019510745', '183.197.24.60', 1584145778, NULL, 1584145450, 1584145778, 1),
(461, '1246097604@qq.com', '34f1455d3d7096e15471c977dada4b09', 'q8XSn', '孙浩方', -1, '2018510474', '223.104.103.162', 1600559612, NULL, 1584145462, 1600559612, 1),
(462, '2638810967@qq.com', '2e74ef3346728f85258d7e3d3348e4ca', 'xMTyw', '闫瑾', -1, '2018510524', '223.104.103.188', 1600847358, NULL, 1584145544, 1600847358, 1),
(463, '2770853517@qq.com', 'cfbaff20fcce2f844b51ebfe07a37ed8', 'LhTHa', '崔慧', -1, '2018510794', '221.192.178.225', 1600864640, NULL, 1584145598, 1600864640, 1),
(464, '2512086039@qq.com', 'f0551ad158adfec1867e9e81261bea77', 'OFT0b', '梁宇', -1, '2019510633', '106.117.80.84', 1584146012, NULL, 1584145651, 1584146012, 1),
(465, '2497002126@qq.com', '52b60bdd130d4718fadcf7e2a88bbd2d', 'bDLDk', '杨立雪', -1, '2019510548', '112.224.21.8', 1584146070, NULL, 1584145792, 1584146070, 1),
(466, '1341915131@qq.com', 'db6b6cb0db4f81eb8e54dbd3876ce992', 'N0jn3', '孙凯', -1, '2019510737', '120.244.144.3', 1584149821, NULL, 1584145965, 1584149821, 1),
(467, '2977407530@qq.com', '95239f6ab4504f7b23b2b22c412f8d36', 'i82Xm', '杜佳宁', -1, '2018510574', '221.192.178.235', 1584146174, NULL, 1584146174, 1584146174, 1),
(468, '2306734297@qq.com', 'b489e8bbcb47f704bd269542a166fad4', 'j3vDG', '任梦妍', -1, '2018510848', '223.104.13.168', 1600818945, NULL, 1584146227, 1600818945, 1),
(469, '2663667494@qq.com', 'c8b3edb6f52e56d352dc5a92747b1af2', 'eDEeW', '李池', -1, '2019510659', '183.197.70.139', 1584146474, NULL, 1584146268, 1584146474, 1),
(470, '1847946764@qq.com', 'c2e0859a14abad054eebba726d96fa66', 'jSrHY', '臧熊奥', -1, '2019510655', '27.186.156.43', 1584146492, NULL, 1584146288, 1584146492, 1),
(471, '2088798935@qq.com', '34e210e681718f6ef595134e9729c5f9', 'HV49r', '李欣童', -1, '2019518549', '27.187.216.61', 1584147591, NULL, 1584146418, 1584147591, 1),
(472, 'zhaoyibing2001@outlook.com', '7209d7fed4f36942ca4a890008202d29', 'HcqoN', '赵一冰', -1, '2019510564', '223.104.102.143', 1584146554, NULL, 1584146494, 1584146554, 1),
(473, '826672498@qq.com', '3bc7627c1dbf28d4b6328d5651abfa45', 'U1869', '杨宜萌', -1, '2019510427', '124.237.173.1', 1584149713, NULL, 1584146658, 1584149713, 1),
(474, '1919559583@qq.com', '9db8eb721b550dfe1af9a58b083cdac3', 'i7AB2', '朱孟泽', -1, '2019510430', '106.9.82.164', 1584148799, NULL, 1584146659, 1584148799, 1),
(475, '1352720874@qq.com', '2f4776d6e925c84fb22ae84df1d0ea75', 'Ih61L', '何世龙', -1, '2019510803', '223.104.103.249', 1584146782, NULL, 1584146782, 1584146782, 1),
(476, '1046684883@qq.com', '9ee34be42d3f4a315d3e14658a2f9fe9', 'WTJ1y', '高延', -1, '2019510624', '27.189.210.14', 1584146824, NULL, 1584146824, 1584146824, 1),
(477, '1270251273@qq.com', '857dc7cc4e2e3ea1d9b932b5a7574ba8', 'Z46QK', '杨星宇', -1, '2018510492', '221.192.179.203', 1600856419, NULL, 1584146825, 1600856419, 1),
(478, '2466904783@qq.com', 'ffd49cca673b8733610aa0e5b9a6665c', 'RZE2z', '杨少宁', -1, '2019510588', '120.8.42.6', 1584147934, NULL, 1584146929, 1584147934, 1),
(479, '940447663@qq.com', '587bf91e86c11e8c062269c031b0b9bb', '5qJCB', '闫晓露', -1, '2018510742', '112.224.132.236', 1584146929, NULL, 1584146929, 1584146929, 1),
(480, '1455032663@qq.com', '7a279fc2455266511c5bcf90654a0b69', 'Jp0ka', '夏琳', -1, '2019510833', '27.129.230.154', 1584147823, NULL, 1584146989, 1584147823, 1),
(481, '1209190397@qq.com', 'dbf444423085f00f8a0431df7b79b8d9', 'idoYg', '李思雨', -1, '2019510463', '121.27.139.218', 1584147572, NULL, 1584146995, 1584147572, 1),
(482, '2120015148@qq.com', '669fa6a908def76c43d93701e1332c37', 'cx3NB', '周欣然', -1, '2019510775', '101.23.148.233', 1584147938, NULL, 1584147087, 1584147938, 1),
(483, '2413947162@qq.com', '6d5094b357740e5f1a72911f56130ec8', 'vrnpm', '王永康', -1, '2018510433', '182.51.86.73', 1584148282, NULL, 1584147187, 1584148282, 1),
(484, '1045892972@qq.com', 'b76951781b9702c3c6a3a5dff7cbaf5e', '7gGnq', '蔡全英', -1, '2019510456', '183.197.5.63', 1584147695, NULL, 1584147217, 1584147695, 1),
(485, '623117352@qq.com', '5314e4dfbb6b8ecb9442703b9f65e96c', '54hJ8', '陈书美', -1, '2018510670', '221.192.178.92', 1584151847, NULL, 1584147234, 1584151847, 1),
(486, '835635732@qq.com', '3356088d4e8df1813e221907573d8dd4', 'Rauao', '李帅潮', -1, '2019510742', '183.198.10.250', 1584147862, NULL, 1584147333, 1584147862, 1),
(487, '1394504191@qq.com', '3db91eaea9919e4a6480677c76ec5262', 'Kw0Bg', '高洋洋', -1, '2019510729', '183.199.245.61', 1584147690, NULL, 1584147440, 1584147690, 1),
(488, '2226189736@qq.com', '0ea194d512a9d35aecddd42c6b5e4b75', '9vAIx', '韩钰涛', -1, '2019510493', '223.104.102.34', 1584147505, NULL, 1584147505, 1584147505, 1),
(489, '885260787@qq.com', 'cd46dc5bed5224f919f106e99bebf7ef', 'CMHzP', '白玉杰', -1, '2019510748', '183.199.215.168', 1584147925, NULL, 1584147520, 1584147925, 1),
(490, '3294693498@qq.com', 'aa6684128b077d09cde7d8523d4f96ca', 'gJK52', '王志广', -1, '2019510442', '120.10.122.100', 1584147612, NULL, 1584147612, 1584147612, 1),
(491, '2386447643@qq.com', '9ab36e20754da53bd0627e158fcf4d19', 'atGFr', '刘祎达', -1, '2019510429', '119.251.216.52', 1584148674, NULL, 1584147637, 1584148674, 1),
(492, '3402338762@qq.com', '2383ade95b5c9661594613cc39103c80', 'ispzp', '陈春蕾', -1, '2019510462', '223.104.102.30', 1584149096, NULL, 1584147651, 1584149096, 1),
(493, '1666254688@qq.com', '32c0c2243901ba647b38e3b6fe1efdce', 'x7aU7', '刘增涛', -1, '2018510460', '223.104.103.139', 1600762831, NULL, 1584147730, 1600762831, 1),
(494, '910842632@qq.com', '1389c32494aef062ee75ba8974c9dde8', 'QE9bp', '田雪', -1, '2018510788', '101.27.87.72', 1584148938, NULL, 1584147765, 1584148938, 1),
(495, '3311604076@qq.com', '03d468bb626fd3e935aca88ba1f3ee91', 'hWG5b', '梁梦梦', -1, '2019510508', '1.197.185.239', 1584148399, NULL, 1584147856, 1584148399, 1),
(496, '1427980190@qq.com', 'ebf6b9efb7c94570a0f3354f3638f66b', 'HT5hF', '刘羽佳', -1, '2018510775', '223.104.13.16', 1585619867, NULL, 1584147890, 1585619867, 1),
(497, '2918444345@qq.com', '9b44d3cdff8c1a1a2772b3e95df3bcad', 'UlY4X', '胡靖', -1, '2019510436', '183.199.62.192', 1584148382, NULL, 1584147900, 1584148382, 1),
(498, '1363442380@qq.com', '20c2e6cfa7e32a5831dc203879161e3a', 'vh1r8', '马荧', -1, '2019510672', '123.189.177.239', 1584148415, NULL, 1584148133, 1584148415, 1),
(499, '2668716403@qq.com', '40f58b8c6db28eca506659e3dae3745f', 'hx6yY', '王悦', -1, '2018510853', '36.98.57.206', 1600775624, NULL, 1584148158, 1600775624, 1),
(500, '1749938304@qq.com', 'a9b4800d1fcf72b5766baffb099636e4', 'af6Ts', '孔晨凯', -1, '2019510680', '106.115.38.104', 1584148410, NULL, 1584148410, 1584148410, 1),
(501, '870745770@qq.com', 'cd0ae29ee078e77ec9c69b8e60e9eeff', '9zrCE', '李茹媛', -1, '2019510583', '183.199.154.162', 1584148432, NULL, 1584148432, 1584148432, 1),
(502, '2713747107@qq.com', '306e51e19ee979c2eb603bbb22653a60', 'TLOLQ', '任吉玉', -1, '2018510758', '223.104.104.195', 1584148594, NULL, 1584148502, 1584148594, 1),
(503, '2468913524@qq.com', 'cb585bb0ade774a306941e05ec5fe1e6', 'ybS7g', '马子轩', -1, '2018510736', '223.104.13.51', 1600871333, NULL, 1584148504, 1600871333, 1),
(504, '1583981798@qq.com', 'aba88beb609f6f14175989bad03670ff', 'SRnts', '杨会宾', -1, '2019512956', '223.104.102.6', 1584148698, NULL, 1584148596, 1584148698, 1),
(505, '510495249@qq.com', 'daa8f03c6a80d6ae588528d5a4dbf118', 'lKsjj', '李龙飞', -1, '2019510495', '27.187.87.17', 1584148721, NULL, 1584148631, 1584148721, 1),
(506, '1830650922@qq.com', 'bec308a6fb6de4f874e8504e6b1f9039', 'XfaTl', '郭唯一', -1, '2018510838', '117.136.2.62', 1600863399, NULL, 1584148686, 1600863399, 1),
(507, '2557298460@qq.com', '4780b2a5e5ada4f7e9e07d09070aca4a', 'y9nnM', '郑雪宇', -1, '2019510689', '183.197.244.110', 1584148966, NULL, 1584148853, 1584148966, 1),
(508, '2039921431@qq.com', '52e8a1b9c4f93e467d416eef5b95ae02', 'RAeyE', '王祎坤', -1, '2018510759', '223.104.102.55', 1584149198, NULL, 1584148874, 1584149198, 1),
(509, '751584454@qq.com', 'e99eb619e151fcb691904d51f34e8928', 'aj06C', '王天纯', -1, '2018510771', '183.197.50.93', 1584149446, NULL, 1584148890, 1584149446, 1),
(510, '2727652506@qq.com', 'a01927a2305f4db2493e4747747d21e1', 'QBRFX', '李天翼', -1, '2019510685', '182.51.86.4', 1584149060, NULL, 1584148974, 1584149060, 1),
(511, '2941200900@qq.com', 'd32ac26756cf2613dba811be39cd5c86', '9JCVN', '张凯歌', -1, '2019510536', '183.199.62.199', 1584149005, NULL, 1584149005, 1584149005, 1),
(512, '2292693482@qq.com', '218624af70c2ba76f4c3045c34bb773c', 'tR8af', '李杨', -1, '2019510690', '27.129.255.88', 1584149122, NULL, 1584149122, 1584149122, 1),
(513, '631356271@qq.com', '3cf9e99c899900bf0372d7cd1b419f4c', 'tExZW', '梁耀辉', -1, '2018510439', '223.104.13.35', 1600990805, NULL, 1584149157, 1600990805, 1),
(514, '1261904450@qq.com', 'f1191fc2166a3332ab855dbea92423f8', 'ixKri', '马涵钰', -1, '2019510470', '183.197.221.164', 1584149205, NULL, 1584149205, 1584149205, 1),
(515, '19933199860@163.com', '84947cf8bde7ccf352ab640390ce3b00', 'E2LdU', '张新雨', -1, '2018510777', '123.180.207.73', 1584149215, NULL, 1584149215, 1584149215, 1),
(516, '2408163103@qq.com', 'e31da6bb721263ff3c847eb6ea2e3975', 'WAJft', '赵倩', -1, '2019510784', '221.192.180.77', 1584149260, NULL, 1584149260, 1584149260, 1),
(517, '502191753@qq.com', '3e62edd357241cf76090bbcc93089a32', 'dibdo', '陈星', -1, '2019510475', '36.98.45.46', 1584149293, NULL, 1584149293, 1584149293, 1),
(518, '545366844@qq.com', '32ca44debc3e4775485b3e22701a67ae', 'k7HAV', '张思哲', -1, '2019510483', '183.197.68.119', 1584149516, NULL, 1584149516, 1584149516, 1),
(519, '2568403453@qq.com', '11f9864bdcc90000969c46690b3eaee5', 'Ah4sk', '田丰琳', -1, '2019510774', '221.192.178.51', 1584149599, NULL, 1584149599, 1584149599, 1),
(520, '978138225@qq.com', 'bcfaefcf2cb757080ff96629414b65e4', 'tmpkQ', '杨宜霖', -1, '2019510435', '121.19.244.131', 1584149649, NULL, 1584149649, 1584149649, 1),
(521, '1664228352@qq.com', 'c6b72deb509e083bd506459acfb97e4f', 'VsQWE', '张辰泽', -1, '2019510746', '123.181.71.105', 1584149684, NULL, 1584149684, 1584149684, 1),
(522, '3028441861@qq.com', '7b4a48852f2a17f641456c39d527f3bc', 'Wv0gw', '董鑫言', -1, '2019510703', '182.51.86.102', 1584149690, NULL, 1584149690, 1584149690, 1),
(523, '279141935@qq.com', 'db8fe35e1dda4d0f4239e23cc6382254', 'nPviX', '张永旺', -1, '2019510740', '60.24.91.96', 1584149808, NULL, 1584149808, 1584149808, 1),
(524, '1066334028@qq.com', '54e30c05251f663aacc87ef6f0bfcdc6', 'Muhme', '杨明运', -1, '2019510437', '36.98.25.134', 1584149814, NULL, 1584149814, 1584149814, 1),
(525, '1842515661@qq.com', '18e1fe56acab5757c82c448927fd2541', 'iXThO', '娄雪怡', -1, '2019510445', '36.98.0.165', 1584149906, NULL, 1584149906, 1584149906, 1),
(526, '1955356511@qq.com', 'a01edf2096a681892ef514d7812a12fd', 'zU4Dj', '王美娜', -1, '2019510717', '110.230.67.253', 1584150007, NULL, 1584150007, 1584150007, 1),
(527, '1776451202@qq.com', 'a193e3c69042eec27bebfb68d2d945f1', 'KMMZt', '王海文', -1, '2019510539', '221.192.180.177', 1584150037, NULL, 1584150037, 1584150037, 1),
(528, '1921573492@qq.com', '48bfb608f82fff69eac09b5c9efbcb5d', 'dmeiY', '孙静怡', -1, '2018510532', '120.11.195.45', 1584150155, NULL, 1584150155, 1584150155, 1),
(529, '2252694163@qq.com', '84d9eb0fe5d8804f03e839cd492490b2', 'inr7x', '张萌萌', -1, '2018510634', '117.136.2.137', 1584150228, NULL, 1584150228, 1584150228, 1),
(530, '2575045869@qq.com', '4d2a6b9a6eec8acbef56ea924dee4327', '0jodX', '王晰哲', -1, '2019510439', '121.25.171.216', 1584150256, NULL, 1584150256, 1584150256, 1),
(531, '1871949702@qq.com', '7b4ebb8432a59f5c7d0e20d18830b8e0', '4UeXf', '王程欣', -1, '2018510619', '36.98.168.165', 1600846416, NULL, 1584150416, 1600846416, 1),
(532, '212830724@qq.com', '1aba853c72228e9203d7748ee6df67a4', 'M5CFh', '栗东静', -1, '2019510725', '106.9.65.81', 1584150519, NULL, 1584150519, 1584150519, 1),
(533, '2454457561@qq.com', '69995f23cdb8f5939a93f0fac85f767b', 'dsidt', '霍雅倩', -1, '2018510837', '117.136.2.52', 1600848226, NULL, 1584150729, 1600848226, 1),
(534, '1280258980@qq.com', 'd6f082ec031383b6680a362178fce2ee', 'aCbC5', '席震', -1, '2018510806', '36.98.180.47', 1600923701, NULL, 1584151350, 1600923701, 1),
(535, '572522657@qq.com', '1d7cc69fddab4e46cab591998e9eeb82', '2dKcJ', '张天朔', -1, '2019510426', '27.187.36.63', 1584152017, NULL, 1584151446, 1584152017, 1),
(536, '1911195320@qq.com', 'df89ce9233bbca3c9c1a2139db3e570b', 'rANWY', '郑明策', -1, '2018510467', '223.104.13.48', 1600920336, NULL, 1584152685, 1600920336, 1),
(537, '540633601@qq.com', 'f8f234620b1715f2b5beb11809b989fd', '4IhnB', '郭旭', -1, '2019510674', '36.98.71.91', 1584152972, NULL, 1584152868, 1584152972, 1),
(538, '2468286914@qq.com', '24a80aebbd7c4a5117170b9ffdebd66e', 'La9pE', '赵明阳', -1, '2016512171', '110.254.154.149', 1584153026, NULL, 1584152893, 1584153026, 1),
(539, '2286254048@qq.com', '8476a06995fd19ca7a062cb9b96faed2', 'GQJwl', '郭紫阳', -1, '2018510463', '106.114.162.201', 1600924199, NULL, 1584153945, 1600924199, 1),
(540, '2810485292@qq.com', 'f92e92eca46630cd793b2040b7563c48', 'T2hhm', '梁红波', -1, '2019510756', '115.59.41.100', 1584156448, NULL, 1584156341, 1584156448, 1),
(541, '1946137923@qq.com', 'b94ed1651742db8886030461ad9d5e17', '353qS', '张艳磊', -1, '2017510395', '110.254.165.21', 1584181656, NULL, 1584181336, 1584181656, 1),
(542, '897652836@qq.com', '7e9187d4a5ce8dc442ed5ae1916fc3d2', 'Xgtqb', '付豪', -1, '2015512352', '36.98.178.52', 1584192779, NULL, 1584192598, 1584192779, 1),
(543, '757034203@qq.com', '14591779a1ad23237859c0ac138a3382', 'jJQal', 'lly', -1, '123456', '58.212.120.51', 1586916012, NULL, 1586915930, 1586916012, 1),
(544, '2965022287@qq.com', '303fdcb23a7d2c2148f57894b2bdc6f2', 'Q4EvJ', '郝梦男', -1, '2018510546', '221.192.179.165', 1600765697, NULL, 1599140192, 1600765697, 1),
(545, '2723639145@qq.com', 'e8f1afa9a0feb64c8a0faade11c5e22e', 'POpKH', '王智明', -1, '2018510805', '106.114.241.183', 1600769525, NULL, 1599140312, 1600769525, 1),
(546, 'a244835316@qq.com', '3ff70fcf28de3fa80db1ececcb963482', '3nEI7', '董妍', -1, '2018510599', '221.192.180.174', 1600864418, NULL, 1599140433, 1600864418, 1),
(547, '2280718279@qq.com', '9580739d28987b27552a1dc3a15715eb', 'TIeif', '常晓露', -1, '2018510597', '223.104.13.19', 1600765868, NULL, 1599140447, 1600765868, 1),
(548, '2983977147@qq.com', '25873d9b47335052d907a0c04a215191', 'KTwWv', '马佳琪', -1, '2018510564', '36.98.167.185', 1600763164, NULL, 1599140474, 1600763164, 1),
(549, '1101364231@qq.com', 'dbc107b3c76f021b25f46b52330098d6', 'QPdpf', '刘冬梅', -1, '2018510560', '223.104.103.175', 1600766045, NULL, 1599140554, 1600766045, 1),
(550, '1801125784@qq.com', 'c558d1c28da9ce4ceb5575156382e9a0', 'jL1sE', '史程程', -1, '2018510554', '221.192.178.3', 1600767904, NULL, 1599140558, 1600767904, 1),
(551, '1448726897@qq.com', '79cb76c36b1f016bf6f472313cefbce6', 'w6pPj', '杨文杰', -1, '2018510675', '223.104.13.31', 1600763207, NULL, 1599140657, 1600763207, 1),
(552, '1772240825@qq.com', '9ae4312b34649340fdfe314de0bcc4fa', 'LyswJ', '吉红瑞', -1, '2018510587', '223.104.13.33', 1600864397, NULL, 1599141314, 1600864397, 1),
(553, '2952061799@qq.com', '8774023fe89af7250c059241e4113711', 'aL0Ba', '宋莹慧', -1, '2018510533', '221.192.178.90', 1600765643, NULL, 1599143156, 1600765643, 1),
(554, '1623359835@qq.com', '29e8f23babb3b727df006e47a41522db', 'EMYZi', '闫格', -1, '2018510542', '223.104.13.139', 1600780874, NULL, 1599143582, 1600780874, 1),
(555, '3286822059@qq.com', '3bcb071a673e16891f73648392b83e15', 'Xdrnx', '汪桓宇', -1, '2018510646', '223.104.13.148', 1600865016, NULL, 1599143959, 1600865016, 1),
(556, '1649909817@qq.com', 'd7c96bcdc768e72e0e1d3156cff6d2b7', 'IheE6', '吴生祥', -1, '2018510456', '124.236.226.160', 1600864865, NULL, 1599144477, 1600864865, 1),
(557, '2586763608@qq.com', 'da3d840562de1194006fb27d12db271c', 'HCg9J', '刘迎', -1, '2018510496', '124.236.225.233', 1600866039, NULL, 1599144498, 1600866039, 1),
(558, '3298299639@qq.com', '94440de4ba6709ec55e0546bf2dd5de2', '3u4sV', '张倩', -1, '2018512962', '223.104.103.133', 1600924004, NULL, 1599144840, 1600924004, 1),
(559, '1011291053@qq.com', 'b1643c1b8fb0f14312765e50d5f05cf0', 'ENnmA', '张银月', -1, '2018510566', '36.98.189.7', 1600767014, NULL, 1599153265, 1600767014, 1),
(560, '1552581730@qq.com', '6867561099eb689b5bfc782bb5a4ddc5', 'xuiQ1', '韩天宇', -1, '2018510809', '223.104.13.165', 1600863391, NULL, 1599173781, 1600863391, 1),
(561, '2691471929@qq.com', '2ca61e1e06d54ebbf947a0871b02ca8b', 'XtjCo', '张雅婷', -1, '2018510583', '223.104.103.174', 1600763281, NULL, 1599174553, 1600763281, 1),
(562, '952045636@qq.com', '5061a2543ff5ce3f8f14a1227c431de0', 'b8JGw', '郭治成', -1, '2018510800', '106.114.241.183', 1600762595, NULL, 1599185958, 1600762595, 1),
(563, '1721769160@qq.com', '42f7d6aedd5a539771db4bcb23b2dc0a', 'KV1ah', '赵紫澳', -1, '2018510635', '36.98.57.162', 1600762962, NULL, 1599186491, 1600762962, 1),
(564, '3487724387@qq.com', 'b88c430fbbf2c5d7cf61ea3bbf398a5a', 'a3Scs', '方迎澳', -1, '2018510731', '106.119.31.142', 1600762588, NULL, 1599188373, 1600762588, 1),
(565, '1808667030@qq.com', 'bf4041521f9ac6a9558a74d5663546af', 'HD0kq', '赵梦凡', -1, '2018510622', '223.104.13.43', 1600769031, NULL, 1599188514, 1600769031, 1),
(566, '1366353460@qq.com', 'a519af5e96c0df7ac77ebfef8a46f00a', 'ucrEZ', '王紫婷', -1, '2018510727', '221.192.179.55', 1600770348, NULL, 1599188571, 1600770348, 1),
(567, '2246325064@qq.com', '9d7bfd22472cb81a3f41d25ade1cb048', 'zL5p2', '肖赛', -1, '2018510444', '223.104.103.154', 1600818014, NULL, 1599189440, 1600818014, 1),
(568, '1572036759@qq.com', 'd8d6b6b53c8dc7692768215bbf21db22', 'zKe1C', '戴金宏', -1, '2018510552', '124.236.227.179', 1600870591, NULL, 1599189450, 1600870591, 1),
(569, '2544208445@qq.com', 'c2363e2f1f3c1aba62c8e8c30d310426', 'yr5lY', '姚越华', -1, '2018510540', '223.104.13.15', 1600772084, NULL, 1599189497, 1600772084, 1),
(570, '1185114711@qq.com', '53da49ec48927ec197012c8088fdc311', 'Weuuj', '张玉晴', -1, '2018510617', '117.136.2.42', 1600763773, NULL, 1599189592, 1600763773, 1),
(571, '2369190637@qq.com', '0ff6d1593d5732a4dc55af09e40d8a6f', 'ZNL9N', '陈敏', -1, '2018510651', '36.98.138.114', 1600773110, NULL, 1599189663, 1600773110, 1),
(572, '1002095509@qq.com', 'aab18d69d7a6c351fa625dcf81f0ce76', '7AX5D', '杨毅', -1, '2018510720', '106.9.77.49', 1600767675, NULL, 1599189933, 1600767675, 1),
(573, '1213307724@qq.com', '303bc3152d3800c15b52f5badd7aa711', 'y7phf', '冯胜怡', -1, '2018510744', '221.192.179.60', 1600756652, NULL, 1599190097, 1600756652, 1),
(574, '2391372908@qq.com', '8c9c74f00f252bb48d75b70865096667', 'T1UFG', '张二达', -1, '2018510475', '36.98.31.31', 1600927265, NULL, 1599190751, 1600927265, 1),
(575, '2857206257@qq.com', '7d0bab5e6b33a09556f0aedb543297e6', 'tIPFv', '梁梦超', -1, '2018510588', '36.98.137.37', 1600927087, NULL, 1599197804, 1600927087, 1),
(576, '1002048416@qq.com', '96fb8d62ee792278d02f36be7298436e', '1XA01', '霍星潼', -1, '2018510666', '221.192.180.172', 1600765555, NULL, 1599199951, 1600765555, 1),
(577, '1609797413@qq.com', '5eb088fc7296c23c86b4ea81e3cd34d9', 'WzFi9', '段非凡', -1, '2018510498', '223.104.103.159', 1600869163, NULL, 1599200365, 1600869163, 1),
(578, '303899871@qq.com', '2239babee937d850118d937ee49c7520', 'LqtYZ', '钟欣', -1, '2018510746', '221.192.178.42', 1600862992, NULL, 1599201194, 1600862992, 1),
(579, '3172769511@qq.com', 'cb93cfca7ef0a3b253405e87032652a0', 'i7E5I', '王坦', -1, '2018510695', '221.192.179.71', 1600786710, NULL, 1599207979, 1600786710, 1),
(580, '2935495658@qq.com', '6a4de3ddef2956362d00a35a477ded48', 'Wazoa', '张怡凡', -1, '2018510618', '106.113.9.180', 1600779369, NULL, 1599208227, 1600779369, 1),
(581, '1766520124@qq.com', 'a124b0dcd58f2d3f7ce87236a9569c73', 'VVYKR', '王帅', -1, '2018510637', '223.104.13.4', 1600772471, NULL, 1599208859, 1600772471, 1),
(582, '2938113745@qq.com', '59c8b0f6e02dfb199082efa2e4d7a8e6', 'yGslh', '袁佳怡', -1, '2018510636', '223.104.103.181', 1600847519, NULL, 1599213693, 1600847519, 1),
(583, '1831273202@qq.com', '71c017be2d51f7d26f29f2519e6d169c', 'NjYve', '王鹏飞', -1, '2018510471', '223.104.13.190', 1600763567, NULL, 1599264700, 1600763567, 1),
(584, '3291732146@qq.com', 'e7eca59fab0c0791a52d0d6c17956a3d', 's4z9X', '秦征', -1, '2018510814', '183.198.0.127', 1600763285, NULL, 1599273306, 1600763285, 1),
(585, '2431487115@qq.com', '8610653307e008bc7bb8e94f628930a5', 'POeso', '白西亚', -1, '2018510818', '117.136.2.36', 1600819094, NULL, 1599273673, 1600819094, 1),
(586, '2640310990@qq.com', '192a488a0f56e8167c620dca56da6184', 'LFlbQ', '李小玉', -1, '2018510833', '36.98.128.233', 1600768414, NULL, 1599274094, 1600768414, 1),
(587, '1176714996@qq.com', 'bb901a3874eedcc448915e313bfe067a', 'dv9nV', '边慧峰', -1, '2018510835', '36.98.128.233', 1600848040, NULL, 1599274374, 1600848040, 1),
(588, '2475025609@qq.com', 'd0412f6ce4bbbb44a44128f01a198219', 'sq83l', '贺莉媛', -1, '2018510840', '223.104.13.156', 1600854500, NULL, 1599275909, 1600854500, 1),
(589, '1316449665@qq.com', '548484103e8556e5855a7b3d4e3a3a90', 'g4TCU', '常然然', -1, '2018510846', '223.104.13.177', 1600863454, NULL, 1599276284, 1600863454, 1),
(590, '990151917@qq.com', '6054d633b6c5309934ea8fd5aad8be9c', 'IpXGh', '崔忠康', -1, '2018510472', '125.39.46.59', 1600764078, NULL, 1599288652, 1600764078, 1),
(591, '3083537185@qq.com', '23036c51a66e05b9a50d7489ddbbdf49', 'GwbBl', '张海龙', -1, '2018510477', '221.192.180.94', 1600932048, NULL, 1599288682, 1600932048, 1),
(592, '2685810505@qq.com', '301d8d17cec95723dcfa18ecac77e58d', '1BcKg', '李荣洽', -1, '2018510441', '221.192.179.4', 1599290319, NULL, 1599290166, 1599290319, 1),
(593, '1571962933@qq.com', 'e181ce4a9712ee4d1c835608573bb8f1', 'pd8TV', '刘亚坤', -1, '2018510844', '221.192.178.117', 1600847838, NULL, 1599292721, 1600847838, 1),
(594, '1819632237@qq.com', '94c122b627ba9876a36177ae6e380916', '2d6fY', '刘怡璇', -1, '2018510845', '223.104.13.19', 1600763427, NULL, 1599292855, 1600763427, 1),
(595, '2290441551@qq.com', 'e78f2709539dfc6c56326fd08a16cc17', 'oBDT0', '廉晓慧', -1, '2018510843', '223.104.13.183', 1600762333, NULL, 1599294151, 1600762333, 1),
(596, '2022181804@qq.com', 'f7dea97e6eb0d383297248e207e54801', 't2SLi', '黄志浩', -1, '2018510493', '223.104.103.130', 1600856478, NULL, 1599300932, 1600856478, 1),
(597, '1366283864@qq.com', '72ef27be6560ad0882bff76e6e921dd1', 'QSk10', '刘贵杰', -1, '2018510459', '221.192.181.32', 1600920217, NULL, 1599303049, 1600920217, 1),
(598, '1574893412@qq.com', '52a310d63603157bcbc198489514c7ab', 'RSUoG', '高欣', -1, '2018510819', '122.97.174.233', 1600762225, NULL, 1599317134, 1600762225, 1),
(599, '1810349456@qq.com', 'c3aaed9efaafafb682592f5b76c4120c', 'S7rnj', '单烁', -1, '2018510520', '106.119.10.17', 1600763050, NULL, 1599353001, 1600763050, 1),
(600, '1337521871@qq.com', '52ee970d9e740b6a0b1ce867a57e482d', 'biTHp', '逯辰祺', -1, '2018510543', '223.104.13.175', 1600873285, NULL, 1599356597, 1600873285, 1),
(601, '3261778573@qq.com', 'e6e0ed9bdd0e700353f68ba13c623ebb', 'EzJGQ', '蔡静美', -1, '2018510600', '36.98.141.200', 1600766996, NULL, 1599365685, 1600766996, 1),
(602, '1953234207@qq.com', 'e2a5d62b22af3c3153850154e476b033', 'UHHD8', '刘会芳', -1, '2018510823', '223.104.13.54', 1600763394, NULL, 1599365989, 1600763394, 1),
(603, '1656891881@qq.com', 'fc4845c996ddee87790d13e7ef743a3d', 'LUGpD', '徐寒', -1, '2018510829', '222.30.253.21', 1600854270, NULL, 1599366031, 1600854270, 1),
(604, '820398323@qq.com', '2e0bcebe180feba20f488300ed25c095', 'MQyGS', '郭立', -1, '2018510440', '223.104.13.144', 1600857854, NULL, 1599378966, 1600857854, 1),
(605, '1205907359@qq.com', '684b9615023125f3040835f1a2f53ee1', 'buVV0', '张旭', -1, '2018510483', '106.119.1.98', 1600920037, NULL, 1599406015, 1600920037, 1),
(606, '1635829478@qq.com', 'bbaa5cd545e4bdfacfedbe2cabd1c15f', '123TI', '张颖月', -1, '2018510681', '112.224.150.188', 1600863085, NULL, 1599437440, 1600863085, 1),
(607, '2394876269@qq.com', '15f7bfdb9bc1ec26f757a9deed749240', 'qawr3', '李婷', -1, '2018510550', '223.104.13.138', 1600762602, NULL, 1599439207, 1600762602, 1),
(608, '3560125819@qq.com', 'cf55d35426673297f83ab452cf56cb23', 'Z9Svg', '周水漫', -1, '2018510591', '223.104.103.136', 1600873042, NULL, 1599444529, 1600873042, 1),
(609, '2517381694@qq.com', 'a964090bcecf5257e9965267ca590f9d', 'dPakE', '张倩', -1, '2018510671', '223.104.103.133', 1600780790, NULL, 1599461678, 1600780790, 1),
(610, '3481365970@qq.com', '566fb385b75585ea5e0fa93cb759c289', 'xxA1h', '王畔月', -1, '2018510739', '221.192.179.18', 1599461900, NULL, 1599461874, 1599461900, 1),
(611, '2476258889@qq.com', 'f3eda1b28ef0a4468d0e63d2075b843a', '32fIY', '孙诗雨', -1, '2018510658', '36.98.181.121', 1600763047, NULL, 1599461997, 1600763047, 1),
(612, '2771639214@qq.com', 'd4ddefbe0f2060eaee93fafae266984e', 'jMpJJ', '张祥萌', -1, '2018510847', '183.198.1.125', 1600768412, NULL, 1599461998, 1600768412, 1),
(613, '1505255134@qq.com', '6661670a150a46dcbbbe387002dc8460', '712BK', '刘佳雪', -1, '2018510682', '223.104.103.177', 1600864232, NULL, 1599462057, 1600864232, 1),
(614, '1309086302@qq.com', '534890b31357e7fa31e6afc8c9b10e7e', 'flxYr', '马辰婧', -1, '2018510686', '106.114.243.47', 1600763519, NULL, 1599462135, 1600763519, 1),
(615, '1361113748@qq.com', 'e3feedad19c5ffb48d7cd6ea3b91787b', 'B2qEL', '甘恺林', -1, '2018510687', '223.104.103.156', 1600762791, NULL, 1599462277, 1600762791, 1),
(616, '1710197304@qq.com', '24b062b60e8484ec916168af9c44e6a3', 'ojI7Y', '尚慧倩', -1, '2018510648', '223.104.103.158', 1600763924, NULL, 1599462473, 1600763924, 1),
(617, '972338805@qq.com', 'ad3c2ffeddbf8fac2b96d09418fd72c2', 'dQk42', '郜添浩', -1, '2018510803', '106.114.241.183', 1600769294, NULL, 1599462635, 1600769294, 1),
(618, '1241536222@qq.com', 'edf680dfd277fe15471dd165a256c72f', '280HF', '侯珂', -1, '2018510523', '223.104.13.179', 1600772053, NULL, 1599462663, 1600772053, 1),
(619, '978915201@qq.com', '2c7254bb01256e32ad43c3904f51d0fe', 'trqg8', '孔国荣', -1, '2018510798', '117.136.2.63', 1600762869, NULL, 1599462932, 1600762869, 1),
(620, '2532256113@qq.com', '923a268eb6ddff50409c6ad67c637c17', 'X492q', '李佳琦', -1, '2018510590', '221.192.180.123', 1600763952, NULL, 1599463051, 1600763952, 1),
(621, '1173464044@qq.com', 'fff678c9c6a2f7f9663ef88c851cdeed', 'dS0de', '顾梓琨', -1, '2018510429', '124.236.229.211', 1600865047, NULL, 1599463065, 1600865047, 1),
(622, '2274446350@qq.com', 'ff845d970a067e3b4bceb1a439808c1c', 'etvcz', '吕志萌', -1, '2018510513', '221.192.179.84', 1600785288, NULL, 1599463165, 1600785288, 1),
(623, '2824217949@qq.com', '12128da81ae9f26e942da46251086e85', 'uoRWg', '田晓彤', -1, '2018510684', '36.98.190.141', 1600765919, NULL, 1599463198, 1600765919, 1),
(624, '1029296153@qq.com', '881c03e10529f915d726b7bb4aaf03b5', 'Yk5TU', '魏婷婷', -1, '2018510504', '223.104.13.174', 1600767896, NULL, 1599463336, 1600767896, 1),
(625, '2296383411@qq.com', '88a153ccffd5eaa19e21a6e96921cddd', 'JdYiH', '李佳惠', -1, '2018510691', '36.98.131.180', 1600868474, NULL, 1599463409, 1600868474, 1),
(626, '1078680848@qq.com', '110a85e60bfbacfe0f79c548b1a0eec1', 'IvYYu', '路谢欢', -1, '2018510721', '106.117.84.106', 1600771884, NULL, 1599463453, 1600771884, 1),
(627, '1711231563@qq.com', 'add8e0dbf9cd263198742b5d6b292380', 'sptMH', '张宁', -1, '2018510696', '106.113.6.23', 1600772063, NULL, 1599463462, 1600772063, 1),
(628, '2530992716@qq.com', '91c262c0d64c3106dfcff40ef694ba05', 'tpPce', '马瑞', -1, '2018510510', '223.104.13.63', 1600771274, NULL, 1599463651, 1600771274, 1),
(629, '253563971@qq.com', 'b5f2d7a419598a954d27337d1c18f1ac', 'Yxv14', '郑亚彤', -1, '2018510620', '106.9.78.134', 1600762906, NULL, 1599463876, 1600762906, 1);
INSERT INTO `api_user` (`id`, `email`, `password`, `password_salt`, `name`, `sex`, `student_id`, `last_login_ip`, `last_login_time`, `last_login_token`, `create_time`, `update_time`, `status`) VALUES
(630, '1643473820@qq.com', '6a2d19a1616a4bccec03aa7acd164159', 'gjlHz', '王晶晶', -1, '2018510537', '106.114.21.28', 1600786909, NULL, 1599463936, 1600786909, 1),
(631, '2225469017@qq.com', '060e43ce91bed1393c2a8de765fc77a7', 'nbAMe', '岳恺峻', -1, '2018510479', '124.236.229.211', 1600864759, NULL, 1599463945, 1600864759, 1),
(632, '2858154078@qq.com', '250bdb16b767fa007b6db04af16a2391', 'vlcdC', '李雅娴', -1, '2018510750', '223.104.13.36', 1600776653, NULL, 1599463956, 1600776653, 1),
(633, '2470433631@qq.com', '37183dec3d0cd1e32526575c2798b413', '39jDo', '崔苗苗', -1, '2018510708', '106.113.7.210', 1600868381, NULL, 1599464152, 1600868381, 1),
(634, '1126377635@qq.com', '9cc71a866fe8efb021193f394e665ea2', 'U6Lpa', '高磊', -1, '2018510489', '124.236.229.126', 1600765575, NULL, 1599464157, 1600765575, 1),
(635, '975597002@qq.com', '32223cde1938e6a613d42b927f983cb2', 'VfXiD', '陈涵', -1, '2018510753', '106.114.17.52', 1600786412, NULL, 1599464173, 1600786412, 1),
(636, '1694813902@qq.com', '83cf743c6a740468b070fac9973d394c', 'jdsfj', '房晓闯', -1, '2018510458', '106.114.163.36', 1600762794, NULL, 1599464428, 1600762794, 1),
(637, '845978823@qq.com', '602592470859b9c3c3a0aa4362bb7408', '1X8Ww', '毕天硕', -1, '2018510466', '106.114.23.42', 1600930202, NULL, 1599464481, 1600930202, 1),
(638, '2316326392@qq.com', 'f18c092c4ada67a993c60ffd2cdfbfb5', 'ooQik', '刘湘', -1, '2018510628', '124.236.148.119', 1600763000, NULL, 1599464792, 1600763000, 1),
(639, '2456395440@qq.com', 'fc150a4100fd6586c69e2833b2d98f28', 'XH7Bv', '赵天资', -1, '2018510436', '223.104.13.140', 1600772414, NULL, 1599464916, 1600772414, 1),
(640, '1307243640@qq.com', '4bf3ff81b46fb266e21c6ce6ec6245ce', 'i5Kxy', '杨卓云', -1, '2018510581', '106.119.8.212', 1600823001, NULL, 1599464961, 1600823001, 1),
(641, '1043677204@qq.com', '49e91297c428658f1df50774d9e1d240', 'fWD9C', '刘晓莎', -1, '2018510615', '223.104.13.130', 1600786698, NULL, 1599464966, 1600786698, 1),
(642, '1394761771@qq.com', '3baa9de42629a837ac8bba8bf574f29c', '7nSd8', '张萌', -1, '2018510584', '112.224.152.23', 1600766249, NULL, 1599465348, 1600766249, 1),
(643, '279268026@qq.com', '21b0a02d5c48e8c086d89a11d06c9dea', 'bIXyK', '郑渊', -1, '2018510667', '106.119.4.153', 1600846709, NULL, 1599465969, 1600846709, 1),
(644, '1350193251@qq.com', '776e2de1755caefb143d842887631c94', 'GrvQr', '师琦', -1, '2018510830', '183.198.1.131', 1600763548, NULL, 1599467363, 1600763548, 1),
(645, '1469027734@qq.com', '25471a6cc66a49ed01b6fbbe14a74972', 'ZVNT5', '郝辰宇', -1, '2018510660', '183.197.18.212', 1600776678, NULL, 1599467662, 1600776678, 1),
(646, '742790103@qq.com', '321e3a37e01df8d7ddf9e421078e6e09', 'cga3I', '朱敬满', -1, '2018510464', '36.98.177.48', 1600817982, NULL, 1599468574, 1600817982, 1),
(647, '389826118@qq.com', '4604339526a1f5b58df9344b2b561f36', 'fZI5Q', '廉一凡', -1, '2018510481', '106.114.23.127', 1600927480, NULL, 1599468587, 1600927480, 1),
(648, '1649423278@qq.com', '4835db6d80da29cef1d1601b61a5a895', 'dFcOy', '李若彤', -1, '2018510541', '106.9.74.130', 1600785138, NULL, 1599468625, 1600785138, 1),
(649, '2716808425@qq.com', '876a1640d32c7abe062854117a3e171b', 'Q5nZD', '黄匀艺', -1, '2018510832', '221.192.179.196', 1600924201, NULL, 1599472609, 1600924201, 1),
(650, '242610836@qq.com', '34d06662d52d4f7a551f93d0b0f3e5a3', 'irqbC', '李荣洽', -1, '2018510441', '221.192.179.28', 1600870487, NULL, 1599476159, 1600870487, 1),
(651, '3246811792@qq.com', '154edaa3edc1405695259177f1f7d25b', 'XJrzF', '郭奕佳', -1, '2018510582', '223.104.13.32', 1600857714, NULL, 1599478280, 1600857714, 1),
(652, '1936188123@qq.com', '4a1a74af15b3f58490f2c376cc045423', '5c5MM', '齐奥聪', -1, '2018510796', '223.104.13.54', 1600787497, NULL, 1599481626, 1600787497, 1),
(653, '1511603206@qq.com', 'd4432df2fed6277fb055081a9e932457', '4G4AY', '沈少阳', -1, '2018510795', '106.114.241.183', 1600762894, NULL, 1599482611, 1600762894, 1),
(654, '2529308565@qq.com', '566e942fb5db17173a990f8a078a642d', 'F91mJ', '王鑫怡', -1, '2018510624', '223.104.103.177', 1600864389, NULL, 1599485888, 1600864389, 1),
(655, '2225084490@qq.com', '4368d878df8f83b9c3db735e066f9be4', 'wZU3s', '何乾乾', -1, '2018510729', '36.98.48.23', 1600863454, NULL, 1599486060, 1600863454, 1),
(656, '1982244049@qq.com', 'a14b54165ebc9741d572cc06af1432a2', '7Fkhi', '纪思萌', -1, '2018510625', '221.192.179.133', 1600786497, NULL, 1599486302, 1600786497, 1),
(657, '2707078740@qq.com', '8ea0b707d6d8ed7b6e38c6b421b02aa6', 'NgZ8D', '李腾飞', -1, '2018510450', '223.104.13.3', 1600872616, NULL, 1599487162, 1600872616, 1),
(658, '1044625045@qq.com', '315bc9c0747cbb0b7fcbf8ad7479b3fc', 'JPxBq', '闫禹杉', -1, '2018510490', '124.236.226.144', 1600864020, NULL, 1599487189, 1600864020, 1),
(659, '1136070732@qq.com', '9e836efe893518791b8949e059d46d8d', 'oSnnR', '徐晓倩', -1, '2018510738', '223.104.103.159', 1600762940, NULL, 1599489267, 1600762940, 1),
(660, '2298968117@qq.com', 'cb95a2ccd67fb2e434a52e5761012f67', 'EgxWQ', '张迎雪', -1, '2018510725', '223.104.103.191', 1600762358, NULL, 1599489294, 1600762358, 1),
(661, '916306108@qq.com', 'ac57713c2218189d20e7a142dba6e2c0', '2OjUc', '任爽', -1, '2018510576', '223.104.13.17', 1600767272, NULL, 1599489345, 1600767272, 1),
(662, '978003436@qq.com', '92117d2c3665451637940d9c092dde2b', 'ylqn0', '景灿', -1, '2018510650', '221.192.178.23', 1600767260, NULL, 1599489370, 1600767260, 1),
(663, '1339445176@qq.com', 'ccd8182ec94763ac5f01de4598ec1196', 'mI8x0', '任洪业', -1, '2018510548', '221.192.178.138', 1600763256, NULL, 1599489510, 1600763256, 1),
(664, '1902015650@qq.com', 'ca5c659daec0e7910c0631b79f37c2d3', 'RzZcv', '魏明月', -1, '2018510728', '36.98.49.5', 1600863635, NULL, 1599489585, 1600863635, 1),
(665, '2047636800@qq.com', 'b79e1411779b36fbf3d89ef37a0e3299', '8lDnw', '冯昱娟', -1, '2018510821', '36.98.178.105', 1600819022, NULL, 1599491236, 1600819022, 1),
(666, '1920511877@qq.com', '92a07434cf0cc0f980d8448b03e964bd', 'TDBl3', '张静', -1, '2018510817', '106.114.22.247', 1600765450, NULL, 1599491790, 1600765450, 1),
(667, '844460753@qq.com', '1db1d54524e297ea226fd80a025fe5f9', 'EBqsT', '孔雨薇', -1, '2018510851', '223.104.13.41', 1600851212, NULL, 1599491856, 1600851212, 1),
(668, '1263592707@qq.com', '2acb551371982686e62bfd493f117e76', 'gesH8', '董连凤', -1, '2018510825', '183.198.1.120', 1600863335, NULL, 1599491861, 1600863335, 1),
(669, '1224683732@qq.com', '418e3812c08c11807504d0cfdf219772', 'FLdlq', '李家哲', -1, '2018510447', '223.104.13.1', 1600869014, NULL, 1599522533, 1600869014, 1),
(670, '1721441358@qq.com', 'edef0c675dd6269dcf4bb14652fff027', 'cdNo1', '阮佳慧', -1, '2018510737', '221.192.179.165', 1600763334, NULL, 1599531217, 1600763334, 1),
(671, '1092485919@qq.com', '1ed3f22c9bb72519fcccb08019fd722c', 'LcosU', '姜心悦', -1, '2018510621', '106.9.75.17', 1600869642, NULL, 1599538017, 1600869642, 1),
(672, '1065229335@qq.com', 'd8ef03c03b5e46e4762e93d167ce9de6', 'QCKzI', '张文珊', -1, '2018510827', '221.192.178.127', 1600763307, NULL, 1599618004, 1600763307, 1),
(673, '2352083632@qq.com', '6f7f8ce22172274bf29c678a33199ae6', 'URwKz', '宋晶晶', -1, '2018510534', '223.104.103.135', 1600863114, NULL, 1599619110, 1600863114, 1),
(674, '1437416362@qq.com', '775bcf4e598cdbdc5714a8f702cb2664', '4b1dn', '李佳琪', -1, '2018510647', '122.97.174.247', 1600863134, NULL, 1599619520, 1600863134, 1),
(675, '1309530687@qq.com', '729c1deeb07cb274c81baccce4ab37b2', 'OBNag', '靳维华', -1, '2018510559', '106.114.164.125', 1600786303, NULL, 1599619810, 1600786303, 1),
(676, '1263602136@qq.com', 'a7f45a9aa962ba829ee653f1fa9638c1', 'Jsg5Q', '李晴晴', -1, '2018510677', '36.98.50.181', 1600924065, NULL, 1599620783, 1600924065, 1),
(677, '3261866513@qq.com', '738bb7f7b2a1c31123a771b9b9ed6e2c', 'ha5J6', '王畔月', -1, '2018510739', '221.192.179.147', 1600785313, NULL, 1599621086, 1600785313, 1),
(678, '1186301877@qq.com', '87735f3706e2b24997f683cba3b76b64', 'QeIae', '霍一儒', -1, '2018510432', '36.98.61.72', 1600786640, NULL, 1599621257, 1600786640, 1),
(679, '874411434@qq.com', '0512e1135ab82f25ffb7f6719bc1aa9c', 'mAmIp', '王烨文', -1, '2018510748', '36.98.132.48', 1600767498, NULL, 1599621851, 1600767498, 1),
(680, '2514240824@qq.com', '3d87a7ca16e1f3ad96b190ef0656725c', 'mG4Yt', '马建云', -1, '2018510755', '223.104.103.144', 1600849713, NULL, 1599622643, 1600849713, 1),
(681, '1195247497@qq.com', '1b07e02c5eac8169a11e6499c140fcaa', 'yQE6L', '杨艺腾', -1, '2018510824', '36.98.163.192', 1600782262, NULL, 1599623147, 1600782262, 1),
(682, '2802024440@qq.com', '97f0db166d70b50e3981e7b4d680973e', 'aSw7v', '王春林', -1, '2018510712', '36.98.136.26', 1600923961, NULL, 1599624526, 1600923961, 1),
(683, '1571336440@qq.com', '72172f4f31e52f07d72b324683221c8c', 'tEKc3', '李华', -1, '2018510703', '221.192.178.128', 1600871728, NULL, 1599624540, 1600871728, 1),
(684, '2929490505@qq.com', '3834f3dd2f8b94d4b08724678e6c8f9c', 'cUIsz', '李佳辉', -1, '2018510561', '221.192.179.46', 1600871564, NULL, 1599624875, 1600871564, 1),
(685, '2440430644@qq.com', 'edfe69ff63b12a1d26b18bf73c97b09c', 'tzR7R', '白佳薇', -1, '2018510595', '183.197.18.212', 1600779661, NULL, 1599631406, 1600779661, 1),
(686, '284193577@qq.com', 'deaecf7420aa1033d3227eec073c830e', 'bafzy', '高蕊', -1, '2018510693', '223.104.13.191', 1600864405, NULL, 1599632025, 1600864405, 1),
(687, '1139596385@qq.com', 'ec922fb18554a19e6a2c3433fb690cad', '5HXTO', '杨梦媛', -1, '2018510673', '223.104.103.159', 1600864768, NULL, 1599632278, 1600864768, 1),
(688, '823107282@qq.com', '36264288c8a064380831d3a3fb0039d5', 'ATiRB', '王颖', -1, '2018510665', '223.104.13.191', 1600865397, NULL, 1599632351, 1600865397, 1),
(689, '2366561558@qq.com', 'bc2c7cd7ebef309b224ad7b81d40180f', 'KcTSZ', '孙超越', -1, '2018510547', '223.104.13.36', 1600865041, NULL, 1599632482, 1600865041, 1),
(690, '2728627087@qq.com', 'ab5496b88c14c350e130a1bd52cdc6c8', 'xsf4c', '张佳媛', -1, '2018510577', '223.104.13.163', 1600865293, NULL, 1599632502, 1600865293, 1),
(691, '2668805309@qq.com', '52a1a72339d802a23a3dbbf432655dfb', 'A4oOx', '闫伊明', -1, '2018510643', '223.104.13.178', 1600864129, NULL, 1599645041, 1600864129, 1),
(692, '1595945625@qq.com', '42e98839040e780cec315e341fc7c2c5', 'qCcbO', '康佳璇', -1, '2018510579', '223.104.13.185', 1600864188, NULL, 1599645458, 1600864188, 1),
(693, '314042747@qq.com', '4d25f59ed26c92fe1efbeb1148b24d41', '244Cq', '赵琪', -1, '2018510535', '221.192.179.196', 1600785016, NULL, 1599645935, 1600785016, 1),
(694, '2078991857@qq.com', 'cb09b2114e6e6021378ee925535196ae', 'Au4LP', '丁慧慧', -1, '2018510745', '221.192.181.41', 1600785383, NULL, 1599646208, 1600785383, 1),
(695, '504770540@qq.com', 'fb7172f824b1b0580a5d23a74bd561e6', 'La9cm', '李伊丹', -1, '2018510592', '106.113.6.21', 1600863191, NULL, 1599692571, 1600863191, 1),
(696, '1599664818@qq.com', '3f2c84aea5f201276420d6203b8c1d7c', 'IagYN', '彭慧敏', -1, '2018510640', '106.9.78.11', 1600862998, NULL, 1599692908, 1600862998, 1),
(697, '1669542771@qq.com', '31fcddfad18f1f774f2d915e82afd92a', 'VjXhN', '李欣阅', -1, '2018510616', '106.117.85.23', 1600863198, NULL, 1599693067, 1600863198, 1),
(698, '2641059255@qq.com', 'fa8801161cec7ce274ce81c2ca05a530', 'HXNou', '张一斌', -1, '2018510465', '36.98.62.26', 1600863509, NULL, 1599694810, 1600863509, 1),
(699, '1669573936@qq.com', '7f37fd9030702edd11a7c3dfd0373ae1', 'qRni6', '孙金海', -1, '2018510799', '111.13.93.76', 1600819022, NULL, 1599702378, 1600819022, 1),
(700, '1285145372@qq.com', '5b5d54747a7783dc1495e7ef19082d75', 'anZPO', '郝思洁', -1, '2018510834', '183.198.0.8', 1600780975, NULL, 1599728761, 1600780975, 1),
(701, '1106700394@qq.com', 'bc80184bda5826322602f86e7cebcdba', 'GbI6Q', '白晨阳', -1, '2018510589', '111.13.93.79', 1600869106, NULL, 1599728854, 1600869106, 1),
(702, '1554387470@qq.com', '666c3c767f61e0ff08363e29b01a36e3', 'AmYge', '李晓雯', -1, '2018510713', '221.192.179.182', 1600863125, NULL, 1599728911, 1600863125, 1),
(703, '1106512162@qq.com', 'cdab7f69ed587b9079b282475248c9b8', 'DZUNn', '李淑静', -1, '2018510699', '221.192.180.201', 1600786319, NULL, 1599728933, 1600786319, 1),
(704, '517894875@qq.com', 'ef029106901e5eb2a2e7ce012f2dad48', 'BQ8Uo', '石祎玮', -1, '2018510668', '101.24.192.197', 1600863367, NULL, 1599728986, 1600863367, 1),
(705, '1359064567@qq.com', '090105e0e7915d1fd8e5892c05ff7820', 'BJPTQ', '全昊月', -1, '2018510527', '223.104.13.173', 1600772424, NULL, 1599729038, 1600772424, 1),
(706, '1401045350@qq.com', '06f627c45e862ea03044bd253be4805f', 'YUWj4', '王平', -1, '2018510826', '223.104.13.150', 1600848979, NULL, 1599729056, 1600848979, 1),
(707, '703461964@qq.com', 'bba2cffe6667d8b2fff1f2a1a286dd9f', 'GvpCw', '强秋曦', -1, '2018510839', '117.136.2.43', 1600767708, NULL, 1599729076, 1600767708, 1),
(708, '2493755933@qq.com', 'd3d632549934224ac07d9b1b56781220', 'HI64O', '段亦婷', -1, '2018510601', '106.117.83.36', 1600862959, NULL, 1599729090, 1600862959, 1),
(709, '1944421484@qq.com', '4b99f03c3b8792815a13637a19c4435b', '7m33Q', '郭月', -1, '2018510816', '223.104.13.150', 1600870092, NULL, 1599729098, 1600870092, 1),
(710, '1163362424@qq.com', '71eb61110a858ebfa6522cf0028cd53c', '3XgO8', '张世纪', -1, '2018510849', '223.104.13.191', 1600904757, NULL, 1599729098, 1600904757, 1),
(711, '3221842849@qq.com', '7196a181c40412ec038a12ef8e002925', '39blr', '梁静', -1, '2018512998', '221.192.178.101', 1600766195, NULL, 1599729234, 1600766195, 1),
(712, '1027154322@qq.com', 'ed61b887f2e02c8a4bfe4698cd58ad1d', 'ZxtIo', '袁帅', -1, '2018510801', '223.104.103.177', 1600864126, NULL, 1599729245, 1600864126, 1),
(713, '575596350@qq.com', '3d0a4f7b53ac27874e4da4f8ae9fc9e0', 'JiFiE', '陈晓慧', -1, '2018510740', '106.9.73.40', 1600765758, NULL, 1599729269, 1600765758, 1),
(714, '1461857340@qq.com', '4701c04559518ab52bde429998332e7b', 'aILGT', '李云清', -1, '2018510521', '223.104.13.2', 1600765104, NULL, 1599729299, 1600765104, 1),
(715, '2215439375@qq.com', '4d2a9508b0a5591424d1c456da6d61b9', '3z2xo', '白晓璐', -1, '2018510606', '124.236.228.75', 1600763735, NULL, 1599729524, 1600763735, 1),
(716, '2858774689@qq.com', 'e3b2a052123b2734b9e4382bf6efd8c9', 'rlkTq', '单梦凡', -1, '2018510679', '223.104.13.145', 1600863605, NULL, 1599729733, 1600863605, 1),
(717, '35820445@qq.com', 'ab88409c4f738beec1235835e07d04f6', '0JVb5', '李佳然', -1, '2018510632', '221.192.178.34', 1600847546, NULL, 1599730176, 1600847546, 1),
(718, '806725931@qq.com', 'e4e26d744d7d0b878dc0f20670d47cc2', 'QiOt5', '郭丹', -1, '2018510676', '221.192.179.69', 1599730380, NULL, 1599730314, 1599730380, 1),
(719, '1599122997@qq.com', '1ee6e65d47dc5a3802c889a2b7070151', 'VquYA', '刘畅', -1, '2018510570', '223.104.13.15', 1600776634, NULL, 1599730464, 1600776634, 1),
(720, '1270017584@qq.com', 'fde9d75b34be9076c4d3876beadd5228', 'BP5E4', '李文丽', -1, '2018510613', '221.192.181.8', 1600771651, NULL, 1599730675, 1600771651, 1),
(721, '2389574842@qq.com', '4ebfbcc884de8ab5521687b8a596cde8', 'wjTgi', '孙欣如', -1, '2018510598', '223.104.13.46', 1600848386, NULL, 1599730796, 1600848386, 1),
(722, '3112574153@qq.com', '1e8d187e48625c74acba485dddcf29f4', 'nYtub', '胡炳旭', -1, '2018510497', '106.114.207.49', 1600920548, NULL, 1599731034, 1600920548, 1),
(723, '2450028049@qq.com', 'f4179460f61d71c5b2d473ee0da3939c', 'X2m5j', '王妍', -1, '2018510654', '223.104.13.136', 1600847931, NULL, 1599731257, 1600847931, 1),
(724, '210681814@qq.com', '79c64f7998e785c6b32c373695e054a1', 'v63hT', '邓铮', -1, '210681814', '221.192.180.191', 1600905382, NULL, 1599738511, 1600905382, 1),
(725, '540457250@qq.com', '032c728de7798a5dd4399f96d145e9bf', '6DF9w', '韩欣宇', -1, '2018510683', '36.98.57.170', 1600923843, NULL, 1599746175, 1600923843, 1),
(726, '1482033255@qq.com', 'ca2363ae204ee256d1f3b7f84f968238', 'oLzRs', '何鑫祺', -1, '2018510603', '223.104.13.131', 1600924968, NULL, 1599746563, 1600924968, 1),
(727, '2145992307@qq.com', 'dcfbb69f4d2574b0c3ded5901159bb2a', 'AIZmY', '李志君', -1, '2018510612', '36.98.171.24', 1600846598, NULL, 1599746640, 1600846598, 1),
(728, '751736352@qq.com', 'bee78b00166537dbaa102c1a73cfbb51', 'rpsGV', '李春滢', -1, '2018510656', '36.98.171.24', 1600846897, NULL, 1599746687, 1600846897, 1),
(729, '1428149865@qq.com', '32b302510603788db70a54e72eb490e7', 'HuwO2', '赵博伦', -1, '2018510485', '221.192.178.188', 1600959461, NULL, 1599748069, 1600959461, 1),
(730, '664547724@qq.com', 'f7b406c082657ce932b3f84fc004cbfa', 'ReeMT', '刘国良', -1, '2018510812', '106.114.23.28', 1600923723, NULL, 1600235994, 1600923723, 1),
(731, '2669597918@qq.com', '08639c0fdd7088e78cb7d2d5489a23f8', 'CoXs8', '袁子洋', -1, '2018510807', '106.114.242.87', 1600863790, NULL, 1600236640, 1600863790, 1),
(732, '1092471102@qq.com', 'a833b27cf765276ca78bd310368462ac', '96HCE', '郭丹', -1, '2018510676', '221.192.180.251', 1600766816, NULL, 1600562443, 1600766816, 1),
(733, '2071929080@qq.com', 'f84bc880ac6ea2445a3d0d883e9536bc', '8gWUs', '刘旭', -1, '2018510841', '36.98.170.48', 1600767348, NULL, 1600676954, 1600767348, 1),
(734, '970445954@qq.com', '3651dcafecf4ddf46027fdff1808cb8a', 'Ishmu', '付晓杰', -1, '2018510811', '47.157.229.190', 1600765077, NULL, 1600765016, 1600765077, 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_user_class`
--

CREATE TABLE `api_user_class` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户',
  `class_id` int(10) UNSIGNED NOT NULL COMMENT '班级',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户班级关系';

-- --------------------------------------------------------

--
-- 表的结构 `z_admin_auth_access`
--

CREATE TABLE `z_admin_auth_access` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '管理员',
  `group` int(10) UNSIGNED NOT NULL COMMENT '权限组所属'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员权限分配';

--
-- 转存表中的数据 `z_admin_auth_access`
--

INSERT INTO `z_admin_auth_access` (`id`, `uid`, `group`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `z_admin_auth_group`
--

CREATE TABLE `z_admin_auth_group` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '组名',
  `rules` text NOT NULL COMMENT '规则ID',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员权限组' ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `z_admin_auth_group`
--

INSERT INTO `z_admin_auth_group` (`id`, `name`, `rules`, `create_time`, `update_time`, `status`) VALUES
(1, '超级权限组', '*', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `z_admin_auth_rule`
--

CREATE TABLE `z_admin_auth_rule` (
  `id` int(10) NOT NULL COMMENT '自增id',
  `name` varchar(255) NOT NULL COMMENT '规则名',
  `path` varchar(255) DEFAULT NULL COMMENT '接口路径',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `pid` int(11) DEFAULT NULL COMMENT '父ID',
  `is_menu` tinyint(1) NOT NULL COMMENT '是否为目录',
  `is_view` tinyint(1) NOT NULL COMMENT '是否为页面',
  `weigh` int(10) UNSIGNED NOT NULL COMMENT '权重',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台权限规则';

--
-- 转存表中的数据 `z_admin_auth_rule`
--

INSERT INTO `z_admin_auth_rule` (`id`, `name`, `path`, `icon`, `pid`, `is_menu`, `is_view`, `weigh`, `status`) VALUES
(1, '权限管理', NULL, '&#xe6b8;', NULL, 1, 0, 0, 1),
(2, '管理员管理', 'View/Admin/adminManageView', '&#xe6f5;', 1, 0, 1, 1, 1),
(3, '权限分配', 'View/Auth/authAccessManageView', '&#xe723;', 1, 0, 1, 2, 1),
(4, '权限组', 'View/Group/authGroupManageView', '&#xe6b4;', 1, 0, 1, 3, 1),
(5, '权限规则', 'View/Rule/authRuleManageView', '&#xe699;', 1, 0, 1, 4, 1),
(6, '添加管理员', 'addAdmin', NULL, 2, 0, 0, 0, 1),
(7, '更改管理员密码', 'changePassword', NULL, 2, 0, 0, 0, 1),
(8, '更新管理员', 'updateAdmin', NULL, 2, 0, 0, 0, 1),
(9, '查看全部管理员(分页)', 'viewAllAdmin', NULL, 2, 0, 0, 0, 1),
(10, '查询管理员(用户名)', 'getTargetAdmin', NULL, 2, 0, 0, 0, 1),
(11, '删除管理员(权限分配一同删除)', 'deleteAdmin', NULL, 2, 0, 0, 0, 1),
(12, '查询管理员(编辑显示用)', 'getAdmin', NULL, 2, 0, 0, 0, 1),
(13, '添加权限分配', 'addAccess', NULL, 3, 0, 0, 0, 1),
(14, '删除权限分配', 'deleteAccess', NULL, 3, 0, 0, 0, 1),
(15, '查看全部权限分配(分页)', 'viewAllAccess', NULL, 3, 0, 0, 0, 1),
(16, '权限分配选择管理员和权限组', 'addAccessComment', NULL, 3, 0, 0, 0, 1),
(17, '添加权限组', 'addGroup', NULL, 4, 0, 0, 0, 1),
(18, '删除权限组', 'deleteGroup', NULL, 4, 0, 0, 0, 1),
(19, '查看全部权限组(分页)', 'viewAllGroup', NULL, 4, 0, 0, 0, 1),
(20, '权限组选择规则', 'addGroupComment', NULL, 4, 0, 0, 0, 1),
(21, '更新权限规则', 'updateRule', NULL, 5, 0, 0, 0, 1),
(22, '查看权限规则(分页)', 'viewRule', NULL, 5, 0, 0, 0, 1),
(23, '查找权限规则(编辑显示用)', 'getRule', NULL, 5, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `z_admin_user`
--

CREATE TABLE `z_admin_user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `password_salt` char(10) NOT NULL DEFAULT '' COMMENT '密码盐',
  `last_login_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '上次登陆IP',
  `last_login_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上次登陆时间',
  `last_login_token` text COMMENT '上次登录Token',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员用户表';

--
-- 转存表中的数据 `z_admin_user`
--

INSERT INTO `z_admin_user` (`id`, `username`, `password`, `password_salt`, `last_login_ip`, `last_login_time`, `last_login_token`, `create_time`, `update_time`, `status`) VALUES
(1, 'admin', '7a06543f83b717722d79d60aa3800aad', 'ETSLP', '36.98.133.232', 1617844964, 'b99a1f617cad91030eb53b05e5339d6f610d4922', 0, 1617844964, 1);

--
-- 转储表的索引
--

--
-- 表的索引 `api_app_config`
--
ALTER TABLE `api_app_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`key`);

--
-- 表的索引 `api_class`
--
ALTER TABLE `api_class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 表的索引 `api_department`
--
ALTER TABLE `api_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 表的索引 `api_dormitory_floor`
--
ALTER TABLE `api_dormitory_floor`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `api_dormitory_number`
--
ALTER TABLE `api_dormitory_number`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `api_dormitory_score`
--
ALTER TABLE `api_dormitory_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_index` (`time_index`),
  ADD KEY `number_id` (`number_id`);

--
-- 表的索引 `api_dormitory_scorer`
--
ALTER TABLE `api_dormitory_scorer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- 表的索引 `api_forum_article`
--
ALTER TABLE `api_forum_article`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `api_forum_comment`
--
ALTER TABLE `api_forum_comment`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `api_forum_modular`
--
ALTER TABLE `api_forum_modular`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `api_graduation_config`
--
ALTER TABLE `api_graduation_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`key`);

--
-- 表的索引 `api_graduation_destination`
--
ALTER TABLE `api_graduation_destination`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- 表的索引 `api_source`
--
ALTER TABLE `api_source`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `api_source_config`
--
ALTER TABLE `api_source_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`key`);

--
-- 表的索引 `api_synthesize_auth`
--
ALTER TABLE `api_synthesize_auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- 表的索引 `api_synthesize_config`
--
ALTER TABLE `api_synthesize_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`key`);

--
-- 表的索引 `api_synthesize_poor_score`
--
ALTER TABLE `api_synthesize_poor_score`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `api_synthesize_poor_sign`
--
ALTER TABLE `api_synthesize_poor_sign`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- 表的索引 `api_user`
--
ALTER TABLE `api_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `student_id` (`student_id`);

--
-- 表的索引 `api_user_class`
--
ALTER TABLE `api_user_class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- 表的索引 `z_admin_auth_access`
--
ALTER TABLE `z_admin_auth_access`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- 表的索引 `z_admin_auth_group`
--
ALTER TABLE `z_admin_auth_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 表的索引 `z_admin_auth_rule`
--
ALTER TABLE `z_admin_auth_rule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `path` (`path`),
  ADD KEY `weigh` (`weigh`),
  ADD KEY `pid` (`pid`);

--
-- 表的索引 `z_admin_user`
--
ALTER TABLE `z_admin_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `api_app_config`
--
ALTER TABLE `api_app_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `api_class`
--
ALTER TABLE `api_class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `api_department`
--
ALTER TABLE `api_department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `api_dormitory_floor`
--
ALTER TABLE `api_dormitory_floor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `api_dormitory_number`
--
ALTER TABLE `api_dormitory_number`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `api_dormitory_score`
--
ALTER TABLE `api_dormitory_score`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `api_dormitory_scorer`
--
ALTER TABLE `api_dormitory_scorer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `api_forum_article`
--
ALTER TABLE `api_forum_article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '文章id', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `api_forum_comment`
--
ALTER TABLE `api_forum_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '评论id', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `api_forum_modular`
--
ALTER TABLE `api_forum_modular`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '模块id', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `api_graduation_config`
--
ALTER TABLE `api_graduation_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `api_graduation_destination`
--
ALTER TABLE `api_graduation_destination`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `api_source`
--
ALTER TABLE `api_source`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `api_source_config`
--
ALTER TABLE `api_source_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `api_synthesize_auth`
--
ALTER TABLE `api_synthesize_auth`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id';

--
-- 使用表AUTO_INCREMENT `api_synthesize_config`
--
ALTER TABLE `api_synthesize_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `api_synthesize_poor_score`
--
ALTER TABLE `api_synthesize_poor_score`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id';

--
-- 使用表AUTO_INCREMENT `api_synthesize_poor_sign`
--
ALTER TABLE `api_synthesize_poor_sign`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `api_user`
--
ALTER TABLE `api_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=735;

--
-- 使用表AUTO_INCREMENT `api_user_class`
--
ALTER TABLE `api_user_class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id';

--
-- 使用表AUTO_INCREMENT `z_admin_auth_access`
--
ALTER TABLE `z_admin_auth_access`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `z_admin_auth_group`
--
ALTER TABLE `z_admin_auth_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `z_admin_auth_rule`
--
ALTER TABLE `z_admin_auth_rule`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=24;

--
-- 使用表AUTO_INCREMENT `z_admin_user`
--
ALTER TABLE `z_admin_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
