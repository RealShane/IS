-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-09-29 21:16:07
-- 服务器版本： 8.0.12
-- PHP 版本： 7.4.3

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
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '设置索引',
  `value` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '设置',
  `statement` text COMMENT '注释',
  `type` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '设置类型',
  `type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '设置分类名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='全局设置';

--
-- 转存表中的数据 `api_app_config`
--

INSERT INTO `api_app_config` (`id`, `key`, `value`, `statement`, `type`, `type_name`, `status`) VALUES
(1, 'EMAIL_HOST', 'smtp.163.com', '邮箱地址', 'EMAIL', '邮箱设置', 1),
(2, 'EMAIL_USERNAME', 'redleafshane@163.com', '邮箱用户名', 'EMAIL', '邮箱设置', 1),
(3, 'EMAIL_PASSWORD', 'SJWZyHHf3sYxcSGN', '邮箱密码', 'EMAIL', '邮箱设置', 1),
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
  `grade` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '年级',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '班级',
  `charge` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '辅导员',
  `depart_id` int(10) UNSIGNED NOT NULL COMMENT '学部',
  `invite_code` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '加入班级代码',
  `join_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '加入班级状态',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='班级';

--
-- 转存表中的数据 `api_class`
--

INSERT INTO `api_class` (`id`, `grade`, `name`, `charge`, `depart_id`, `invite_code`, `join_status`, `status`) VALUES
(1, '2018', '18级计算机科学与技术一班', NULL, 1, NULL, 0, 1),
(2, '2018', '18级计算机科学与技术二班', '张洁', 1, 'admin', 1, 1),
(3, '2018', '18级计算机科学与技术三班', NULL, 1, NULL, 0, 1),
(4, '2018', '18级通信工程', NULL, 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_department`
--

CREATE TABLE `api_department` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学部/系',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='学部/系';

--
-- 转存表中的数据 `api_department`
--

INSERT INTO `api_department` (`id`, `name`, `status`) VALUES
(1, '工学部', 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_synthesize_config`
--

CREATE TABLE `api_synthesize_config` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '设置索引',
  `value` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '设置',
  `statement` text COMMENT '注释',
  `type` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '设置类型',
  `type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '设置分类名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='综合测评设置';

--
-- 转存表中的数据 `api_synthesize_config`
--

INSERT INTO `api_synthesize_config` (`id`, `key`, `value`, `statement`, `type`, `type_name`, `status`) VALUES
(1, 'POOR_SIGN_OPTION', '[\"家庭遭受家庭遭受自然灾害\", \"家庭遭受突发意外事件\", \"家庭成员因残疾\", \"年迈而劳动能力弱情况\", \"家庭适龄就学子女较多\", \"家庭成员失业\", \"家庭欠债\", \"其他\", \"建档立卡家庭\", \"低保\"]', '贫困生报名选项', 'POOR', '贫困生设置', 1),
(2, 'POOR_SIGN_STATUS', '1', '贫困生报名开关', 'POOR', '贫困生设置', 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_synthesize_poor_score`
--

CREATE TABLE `api_synthesize_poor_score` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `uid` int(10) UNSIGNED NOT NULL COMMENT '用户',
  `target` int(10) UNSIGNED NOT NULL COMMENT '打分/投票目标',
  `mark` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '打分/投票',
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
  `political_outlook` enum('群众','共青团员','中共党员') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '群众' COMMENT '政治面貌',
  `id_card_type` enum('居民身份证') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '居民身份证' COMMENT '身份证件类型',
  `id_card_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '身份证件号',
  `confirm_level` enum('特殊困难','困难','一般困难') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '认定困难级别',
  `poor_type_one` tinyint(1) NOT NULL COMMENT '是否建档立卡贫困家庭',
  `poor_type_two` tinyint(1) NOT NULL COMMENT '是否低保家庭',
  `poor_type_three` tinyint(1) NOT NULL COMMENT '是否特困供养学生',
  `poor_type_four` tinyint(1) NOT NULL COMMENT '是否孤残学生',
  `poor_type_five` tinyint(1) NOT NULL COMMENT '是否烈士子女',
  `poor_type_six` tinyint(1) NOT NULL COMMENT '本人是否残疾',
  `poor_type_seven` tinyint(1) NOT NULL COMMENT '是否家庭经济困难残疾人子女',
  `poor_type_eight` tinyint(1) NOT NULL COMMENT '是否单亲家庭',
  `confirm_time` int(10) UNSIGNED DEFAULT NULL COMMENT '认定时间',
  `confirm_reason` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '认定原因',
  `confirm_reason_explain` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '认定原因补充说明',
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '家庭住址',
  `home_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '家庭电话',
  `contact_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '联系方式',
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '备注',
  `supporting_document` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '证明文件',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='贫困生报名';

--
-- 转存表中的数据 `api_synthesize_poor_sign`
--

INSERT INTO `api_synthesize_poor_sign` (`id`, `uid`, `political_outlook`, `id_card_type`, `id_card_number`, `confirm_level`, `poor_type_one`, `poor_type_two`, `poor_type_three`, `poor_type_four`, `poor_type_five`, `poor_type_six`, `poor_type_seven`, `poor_type_eight`, `confirm_time`, `confirm_reason`, `confirm_reason_explain`, `address`, `home_phone`, `contact_phone`, `remark`, `supporting_document`, `create_time`, `status`) VALUES
(1, 1, '共青团员', '居民身份证', '130503200001100639', NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '其他', 'test', 'test', '13363706632', '13315926692', '', '/uploads/synthesize/poor/Shane2018510500/2020/09/29/a9ff54ad438006184d41be5fce8151e81d95ca0a/timg.jpg', 1601380420, 1);

-- --------------------------------------------------------

--
-- 表的结构 `api_user`
--

CREATE TABLE `api_user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮箱',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `password_salt` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码盐',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '姓名',
  `sex` tinyint(1) NOT NULL DEFAULT '-1' COMMENT '性别',
  `student_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学号',
  `last_login_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '上次登录IP',
  `last_login_time` int(10) UNSIGNED NOT NULL COMMENT '上次登录时间',
  `last_login_token` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '上次登录Token',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户';

--
-- 转存表中的数据 `api_user`
--

INSERT INTO `api_user` (`id`, `email`, `password`, `password_salt`, `name`, `sex`, `student_id`, `last_login_ip`, `last_login_time`, `last_login_token`, `create_time`, `update_time`, `status`) VALUES
(1, '1109571639@qq.com', 'c7dff777ae9f431aa32791f205b20f91', 'oFzwX', 'Shane', 1, '2018510500', '127.0.0.1', 1601380412, '42af6a1995ef7494c0025425493cbd2d3728430a', 1601349819, 1601380412, 1);

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
  `username` varchar(20) NOT NULL COMMENT '管理员名',
  `group` int(10) UNSIGNED NOT NULL COMMENT '权限组所属'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员权限分配';

--
-- 转存表中的数据 `z_admin_auth_access`
--

INSERT INTO `z_admin_auth_access` (`id`, `username`, `group`) VALUES
(1, 'admin', 1);

-- --------------------------------------------------------

--
-- 表的结构 `z_admin_auth_group`
--

CREATE TABLE `z_admin_auth_group` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '组名',
  `rules` text NOT NULL COMMENT '规则ID',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员权限组' ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `z_admin_auth_group`
--

INSERT INTO `z_admin_auth_group` (`id`, `name`, `rules`, `create_time`, `update_time`) VALUES
(1, '超级权限组', '*', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `z_admin_generator`
--

CREATE TABLE `z_admin_generator` (
  `id` int(10) NOT NULL COMMENT '自增id',
  `table_name` varchar(20) NOT NULL COMMENT '生成表名',
  `table_comment` varchar(20) NOT NULL COMMENT '表注释',
  `catalogue_bind` varchar(50) NOT NULL DEFAULT '' COMMENT '二级目录所属',
  `executor` varchar(20) NOT NULL COMMENT '执行人',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='代码生成记录';

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
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员用户表';

--
-- 转存表中的数据 `z_admin_user`
--

INSERT INTO `z_admin_user` (`id`, `username`, `password`, `password_salt`, `last_login_ip`, `last_login_time`, `create_time`, `update_time`) VALUES
(1, 'admin', '7a06543f83b717722d79d60aa3800aad', 'ETSLP', '127.0.0.1', 1593277926, 1579237406, 1593277926);

-- --------------------------------------------------------

--
-- 表的结构 `z_catalogue`
--

CREATE TABLE `z_catalogue` (
  `id` int(10) NOT NULL COMMENT '自增id',
  `catalogue_name` varchar(20) NOT NULL COMMENT '目录名',
  `icon` varchar(10) NOT NULL COMMENT '图标',
  `executor` varchar(20) NOT NULL DEFAULT 'admin' COMMENT '执行人',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='生成表目录';

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
  ADD UNIQUE KEY `student_id` (`student_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `z_admin_auth_group`
--
ALTER TABLE `z_admin_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `z_admin_generator`
--
ALTER TABLE `z_admin_generator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_name` (`table_name`);

--
-- 表的索引 `z_admin_user`
--
ALTER TABLE `z_admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `username` (`username`),
  ADD KEY `create_time` (`create_time`);

--
-- 表的索引 `z_catalogue`
--
ALTER TABLE `z_catalogue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalogue_name` (`catalogue_name`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `api_department`
--
ALTER TABLE `api_department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `api_user`
--
ALTER TABLE `api_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;

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
-- 使用表AUTO_INCREMENT `z_admin_generator`
--
ALTER TABLE `z_admin_generator`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id';

--
-- 使用表AUTO_INCREMENT `z_admin_user`
--
ALTER TABLE `z_admin_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `z_catalogue`
--
ALTER TABLE `z_catalogue`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
