-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-09-24 15:48:06
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
-- 数据库： `shane1`
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
(2, 'EMAIL_USERNAME', '@163.com', '邮箱用户名', 'EMAIL', '邮箱设置', 1),
(3, 'EMAIL_PASSWORD', 'SJWZ', '邮箱密码', 'EMAIL', '邮箱设置', 1),
(4, 'EMAIL_NAME', 'Shane_noreply', '邮件发送人姓名', 'EMAIL', '邮箱设置', 1),
(5, 'EMAIL_ACTIVE_TITLE', '系统--注册激活', '注册激活邮件标题', 'EMAIL', '邮箱设置', 1),
(6, 'EMAIL_ACTIVE_BODY', '<h1>同学你好：</h1><br>&nbsp;&nbsp;Shane帮你想好了你应该去哪里激活你的账号(尽快激活，24小时有效时间)：https://localhost/api/activeRegister?token=', '注册激活邮件内容HTML版', 'EMAIL', '邮箱设置', 1),
(7, 'EMAIL_ACTIVE_ALT_BODY', '同学你好：Shane帮你想好了你应该去哪里激活你的账号(尽快激活，24小时有效时间)：https://localhost/api/activeRegister?token=', '注册激活邮件内容纯文字版', 'EMAIL', '邮箱设置', 1),
(8, 'EMAIL_RANDOM_TITLE', '系统--登陆验证', '验证码邮件标题', 'EMAIL', '邮箱设置', 1),
(9, 'EMAIL_RANDOM_BODY', '<h1>同学你好：</h1><br>&nbsp;&nbsp;验证码Shane帮你想好了(尽快登陆，2分钟有效时间)：', '验证码邮件内容HTML版', 'EMAIL', '邮箱设置', 1),
(10, 'EMAIL_RANDOM_ALT_BODY', '同学你好：验证码Shane帮你想好了(尽快登陆，2分钟有效时间)：', '验证码邮件内容纯文字版', 'EMAIL', '邮箱设置', 1);

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
  `student_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '学号',
  `last_login_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '上次登录IP',
  `last_login_time` int(10) UNSIGNED NOT NULL COMMENT '上次登录时间',
  `last_login_token` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '上次登录Token',
  `create_time` int(10) UNSIGNED NOT NULL COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户';

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
-- 表的索引 `api_user`
--
ALTER TABLE `api_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=11;

--
-- 使用表AUTO_INCREMENT `api_user`
--
ALTER TABLE `api_user`
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
