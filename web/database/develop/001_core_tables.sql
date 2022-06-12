/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  nguyenpt
 * Created: Feb 28, 2020
 */
DROP TABLE IF EXISTS `admin_modules`;
CREATE TABLE `admin_modules` (
    `id`            smallint(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `name`          varchar(63) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Name',
    `description`   text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Description',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='Modules';

INSERT INTO `admin_modules` (`id`, `name`, `description`, `status`, `created_date`, `created_by`) VALUES
(1, 'admin', 'Admin module', 1, '2019-03-25 16:01:17', 0),
(2, 'api', 'API module', 1, '2019-03-25 16:01:17', 0),
(4, 'hr', 'Human resource module', 1, '2019-04-16 09:45:25', 0),
(5, 'administrative', 'Administrative module', 1, '2019-06-17 21:21:07', 0),
(6, 'accounting', 'Accounting module', 1, '2019-06-17 21:21:39', 0),
(7, 'dental', 'Dental module', 1, '2019-06-17 21:36:12', 0),
(8, 'department', 'Department module', 1, '2019-06-17 21:45:50', 0),
(9, 'asset', 'Asset Management module', 1, '2019-06-17 22:04:47', 0),
(10, 'product', 'Product module', 1, '2019-06-17 22:09:37', 0),
(11, 'report', 'Report Module', 1, '2019-06-17 22:12:19', 0),
(12, 'medical', 'Medical module', 1, '2019-07-12 11:31:56', 0);

DROP TABLE IF EXISTS `admin_controllers`;
CREATE TABLE `admin_controllers` (
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `name`          varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Name',
    `module_id`     smallint(11) UNSIGNED DEFAULT NULL COMMENT 'Id of module',
    `description`   text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Description',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='Controllers';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(1, 'admin-modules', 1, 'Module', 1, '2019-03-25 16:01:30', 0),
(2, 'admin-controllers', 1, 'Controller', 1, '2019-03-25 16:01:30', 0);

DROP TABLE IF EXISTS `admin_controller_actions`;
CREATE TABLE `admin_controller_actions` (
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `controller_id` int(11) UNSIGNED NOT NULL COMMENT 'Id of controller',
    `action`        varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Key of action',
    `name`          text CHARACTER SET utf8 NOT NULL COMMENT 'Name of action',
    `permission`    tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1-Private, 2-Protected, 3-Public',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='Controller actions';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(3, 'admin-controller-actions', 1, 'Action', 1, '2019-04-06 16:10:26', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(1, 1, 'index', 'List', 1, 1, '2019-03-25 16:01:55', 0),
(2, 1, 'create', 'Create', 1, 1, '2019-03-25 16:01:55', 0),
(3, 1, 'update', 'Update', 1, 1, '2019-03-25 16:01:55', 0),
(4, 1, 'delete', 'Delete', 1, 1, '2019-03-25 16:01:55', 0),
(5, 2, 'index', 'List', 1, 1, '2019-03-25 16:01:55', 0),
(6, 2, 'create', 'Create', 1, 1, '2019-03-25 16:01:55', 0),
(7, 2, 'update', 'Update', 1, 1, '2019-03-25 16:01:55', 0),
(8, 2, 'delete', 'Delete', 1, 1, '2019-03-25 16:01:55', 0),
(9, 3, 'index', 'List', 1, 1, '2019-04-06 16:45:13', 0),
(10, 3, 'create', 'Create', 1, 1, '2019-04-06 17:06:30', 0),
(11, 3, 'update', 'Update', 1, 1, '2019-04-06 16:45:40', 0),
(12, 3, 'delete', 'Delete', 1, 1, '2019-04-06 17:06:40', 0);

DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles` (
    `id`            smallint(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `name`          varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name',
    `code`          varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Code',
    `working_type`  tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Type working: 1 - Office hours, 2 - Shift work, 3 - Other',
    `isStaff`       tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Is staff',
    `weight`        smallint(11) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Weight of role',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='Roles';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(4, 'admin-roles', 1, 'Role', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(13, 4, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(14, 4, 'create', 'Create', 1, 1, '2019-04-06 17:11:56', 0),
(15, 4, 'update', 'Update', 1, 1, '2019-04-06 17:12:27', 0),
(16, 4, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0);

INSERT INTO `admin_roles` (`id`, `name`, `code`, `working_type`, `isStaff`, `weight`, `status`, `created_date`, `created_by`) VALUES
(1, 'Super admin', 'SUPER_ADMIN', 1, 0, 1, 1, '2019-03-25 16:50:31', 0),
(2, 'Administrator', 'ADMIN', 1, 0, 2, 1, '2019-03-25 16:56:24', 0);

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `username`      varchar(50) NOT NULL COMMENT 'Username use for login',
    `phone`         varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Phone number',
    `email`         varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Email',
    `gender`        tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Gender',
    `password_hash` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Password hash',
    `temp_password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Temp password',
    `fullname`      varchar(150) DEFAULT NULL COMMENT 'User fullname',
    `address`       text,
    `house_numbers` text COMMENT 'House number',
    `city_id`       smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'City/Province',
    `district_id`   mediumint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'District',
    `ward_id`       mediumint(7) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Ward',
    `street_id`     mediumint(7) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Streets',
    `role_id`       smallint(11) UNSIGNED NOT NULL COMMENT 'Id of roles',
    `birthday`      date DEFAULT NULL COMMENT 'Birthday',
    `career_id`     smallint(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Id of careed',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='Users';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(5, 'admin-users', 1, 'Users', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(17, 5, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(18, 5, 'view', 'Detail', 1, 1, '2019-04-06 17:11:56', 0),
(19, 5, 'create', 'Create', 1, 1, '2019-04-06 17:11:56', 0),
(20, 5, 'update', 'Update', 1, 1, '2019-04-06 17:12:27', 0),
(21, 5, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0);

INSERT INTO `admin_users` (`id`, `username`, `phone`, `email`, `gender`, `password_hash`, `temp_password`, `fullname`, `address`, `house_numbers`, `city_id`, `district_id`, `ward_id`, `street_id`, `role_id`, `birthday`, `career_id`, `status`, `created_date`, `created_by`) VALUES
(1, 'superadmin', '0123456789', 'superadmin@system.com', 1, 'bc4f26a7b672f987c37138ac778dfec4', ' 5dc0ec382aff00.29235343', 'Super Admin', '1', '1', 1, 1, 1, 1, 1, '2019-03-01', NULL, 1, '2019-03-31 21:05:15', 100),
(2, 'admin', '-', '-', 1, 'bc4f26a7b672f987c37138ac778dfec4', ' 5dc0ec382aff00.29235343', '-', '1', '62', 2, 1, 1, 34, 2, '1996-03-27', NULL, 1, '2019-04-05 17:42:57', 1);

DROP TABLE IF EXISTS `admin_settings`;
CREATE TABLE `admin_settings` (
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `updated`       datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Updated time',
    `key`           varchar(255) NOT NULL COMMENT 'Key',
    `value`         text NOT NULL COMMENT 'Value',
    `description`   text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Description',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='Setting values';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(6, 'admin-settings', 1, 'Settings', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(22, 6, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(23, 6, 'view', 'Detail', 1, 1, '2019-04-06 17:11:56', 0),
(24, 6, 'create', 'Create', 1, 1, '2019-04-06 17:11:56', 0),
(25, 6, 'update', 'Update', 1, 1, '2019-04-06 17:12:27', 0),
(26, 6, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0),
(27, 6, 'change-language', 'Change language', 3, 1, '2019-04-06 17:12:40', 0);

INSERT INTO `admin_settings` (`id`, `updated`, `key`, `value`, `description`) VALUES
(1, '2019-10-28 17:57:52', 'OTP_LIMIT_TIME', '5000', 'OTP timeout'),
(2, '2019-10-28 17:57:52', 'OTP_LEN', '6', 'OTP length'),
(3, '2019-10-28 17:57:52', 'DOMAIN', 'https://betech-vn.com/', 'Domain'),
(4, '2019-10-28 17:57:52', 'LANGUAGE', 'ja-JP', 'Language'),
(5, '2019-10-28 17:57:52', 'LIST_PAGE_SIZE', '30', 'Number of item page'),
(6, '2019-04-05 13:42:17', 'LOGGER_SETTINGS', '1', 'On/Off feature logger'),
(7, '2019-04-10 22:55:52', 'IS_PUBLIC_SITE', '0', 'Flag check site is public'),
(8, '2019-10-28 17:57:52', 'THEME', 'immortal', 'Back-end theme'),
(9, '2019-10-28 17:57:52', 'LOG_ACTIVE_RECORD', '1', 'Active records logger'),
(10, '2019-10-28 17:57:52', 'USER_ACTIVITY_LOG', '1', 'User activities logger'),
(11, '2019-10-28 17:57:52', 'API_REQUEST_LOG', '1', 'Request API logger'),
(12, '2019-10-28 17:57:52', 'LOG_RESPONSE_MAX_LENGTH', '500', 'Response max length'),
(13, '2019-10-28 17:57:52', 'SMS_FUNC_ON_OFF', '1', 'On/Off feature SMS'),
(14, '2019-10-28 17:57:52', 'SMS_PROVIDER', '1', 'SMS provider'),
(15, '2019-10-28 17:57:52', 'EMAIL_PROVIDER', '2', 'Email provider'),
(16, '2019-10-28 17:57:52', 'EMAIL_FUNC_ON_OFF', '1', 'On/Off feature Email'),
(17, '2019-10-28 17:57:52', 'EMAIL_TRANSPORT_PASSWORD', '', 'Password email'),
(18, '2019-10-28 17:57:52', 'GENERAL_LOG', '1', 'Logger'),
(19, '2019-10-28 17:57:52', 'THEME_FRONT', 'university', 'Front-end theme'),
(20, '2019-10-28 17:57:52', 'ADMIN_EMAIL', 'oouchi@bisync.co.jp', 'Admin Email'),
(21, '2019-10-28 17:57:52', 'EMAIL_TRANSPORT_USERNAME', 'oouchi@bisync.co.jp', 'Username'),
(22, '2019-10-28 17:57:52', 'EMAIL_MAIN_SUBJECT', 'O2O', 'Mail subject'),
(23, '2019-10-28 17:57:52', 'ADMIN_PHONE', '(+84) 28 7305 6560', 'Admin phone'),
(24, '2019-10-28 17:57:52', 'ADMIN_ADDRESS', '137/30 Nguyễn Cư Trinh, Phường Nguyễn Cư Trinh, Quận 1, TP HCM', 'Company address'),
(25, '2019-10-28 17:57:52', 'THEME_LOGIN', 'university', 'Login theme'),
(26, '2019-10-28 17:57:52', 'PASSWORD_LEN_MIN', '6', 'Min length of password');

DROP TABLE IF EXISTS `admin_loggers`;
CREATE TABLE `admin_loggers` (
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `ip_address`    varchar(50) DEFAULT NULL COMMENT 'IP address',
    `country`       varchar(100) DEFAULT NULL COMMENT 'Country',
    `message`       text COMMENT 'Message content',
    `description`   varchar(250) DEFAULT NULL COMMENT 'Message description',
    `level`         varchar(128) DEFAULT NULL COMMENT 'Level of log: 0-Info, 1-Warning, 2-Error',
    `logtime`       int(11) DEFAULT NULL COMMENT 'Time as millisecond',
    `category`      varchar(128) DEFAULT NULL COMMENT 'Location of log',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 COMMENT='Loggers';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(7, 'admin-loggers', 1, 'Loggers', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(28, 7, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(29, 7, 'view', 'Detail', 1, 1, '2019-04-06 17:11:56', 0),
(30, 7, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0);

DROP TABLE IF EXISTS `admin_page_counts`;
CREATE TABLE `admin_page_counts` (
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `module`        varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Module',
    `controller`    varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Controller',
    `action`        varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Action',
    `view`          varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'View',
    `count`         int(11) NOT NULL DEFAULT '0' COMMENT 'Count',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `updated_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Updated date',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 COMMENT='Page counts';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(8, 'admin-page-counts', 1, 'Page counts', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(31, 8, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0);

DROP TABLE IF EXISTS `admin_record_logs`;
CREATE TABLE `admin_record_logs` (
    `id`            bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `description`   varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Description',
    `action`        varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Action',
    `model`         varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Model',
    `model_id`      int(10) UNSIGNED DEFAULT NULL COMMENT 'Id of model',
    `field`         varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Field name',
    `old_value`     text COLLATE utf8_unicode_ci COMMENT 'Old value',
    `new_value`     text COLLATE utf8_unicode_ci COMMENT 'New value',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 COMMENT='Active record logs';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(9, 'admin-record-logs', 1, 'Record logs', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(32, 9, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0);

DROP TABLE IF EXISTS `admin_activity_logs`;
CREATE TABLE `admin_activity_logs` (
    `id`            bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `session`       varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Session',
    `ipaddress`     varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'IP address',
    `module`        varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Module',
    `controller`    varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Controller',
    `action`        varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Action',
    `browser`       varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Browser',
    `os`            varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Operation system',
    `details`       text COLLATE utf8_unicode_ci COMMENT 'Details',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 COMMENT='Activity logs';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(10, 'admin-activity-logs', 1, 'Activity Logs', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(33, 10, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0);

DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
    `id`            mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `name`          varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Name',
    `description`   text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Description',
    `module_id`     smallint(11) UNSIGNED DEFAULT NULL COMMENT 'Id of module',
    `controller_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'Id of controller',
    `action`        varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Key of action',
    `view`          varchar(255) DEFAULT NULL COMMENT 'View',
    `link`          varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'External link',
    `icon`          varchar(255) NOT NULL DEFAULT '' COMMENT 'Icon',
    `icon_thumb`    varchar(255) NOT NULL DEFAULT '' COMMENT 'Icon small size',
    `display_order` tinyint(3) UNSIGNED NOT NULL COMMENT 'display order',
    `type`          tinyint(3) UNSIGNED NOT NULL COMMENT 'Type of menu',
    `parent_id`     mediumint(6) UNSIGNED DEFAULT NULL COMMENT 'Parent id',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 COMMENT='Menu';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(11, 'admin-menu', 1, 'Menu', 1, '2019-04-06 16:11:12', 0),
(12, 'default', 1, 'Default admin', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(34, 11, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(35, 11, 'view', 'Detail', 1, 1, '2019-04-06 17:11:56', 0),
(36, 11, 'create', 'Create', 1, 1, '2019-04-06 17:11:56', 0),
(37, 11, 'update', 'Update', 1, 1, '2019-04-06 17:12:27', 0),
(38, 11, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0),
(39, 12, 'index', 'Default admin index', 1, 1, '2019-04-06 17:12:40', 0);

INSERT INTO `admin_menu` (`id`, `name`, `description`, `module_id`, `controller_id`, `action`, `view`, `link`, `icon`, `icon_thumb`, `display_order`, `type`, `parent_id`, `status`, `created_date`, `created_by`) VALUES
(1, 'Admin',        'Admin',        1, 12, 'index', '', '', 'ic-backend-1', 'ic-backend-10',    1, 1, NULL, 1, '2019-04-16 15:39:16', 1),
(2, 'Module',       'Module',       1, 1, 'index', '', '', 'ic-backend-16', '',                 1, 1, 1, 1, '2019-04-16 22:11:45', 1),
(3, 'Controller',   'Controller',   1, 2, 'index', '', '', 'ic-backend-12', '',                 2, 1, 1, 1, '2019-04-16 22:19:21', 1),
(4, 'Action',       'Action',       1, 3, 'index', '', '', 'ic-backend-12', '',                 3, 1, 1, 1, '2019-04-16 22:20:49', 1),
(5, 'Role',         'Role',         1, 4, 'index', '', '', 'ic-backend-14', '',                 4, 1, 1, 1, '2019-04-16 22:22:52', 1),
(6, 'Account',      'Account',      1, 5, 'index', '', '', 'ic-backend-13', '',                 5, 1, 1, 1, '2019-04-16 22:37:19', 1),
(7, 'Settings',     'Setting',      1, 6, 'index', '', '', 'ic-backend-15', '',                 6, 1, 1, 1, '2019-04-16 22:37:47', 1),
(8, 'Logger',       'Logger',       1, 7, 'index', '', '', 'ic-backend-32', '',                 7, 1, 1, 1, '2019-04-16 22:38:14', 1),
(9, 'Page count',   'Page count',   1, 8, 'index', '', '', 'ic-backend-59', '',                 8, 1, 1, 1, '2019-04-16 22:38:39', 1),
(10, 'Record log',  'Record log',   1, 9, 'index', '', '', 'ic-backend-34', '',                 9, 1, 1, 1, '2019-04-16 22:39:16', 1),
(11, 'Activity log', 'Activity log', 1, 10, 'index', '', '', 'ic-backend-33', '',               10, 1, 1, 1, '2019-04-16 22:39:41', 1),
(12, 'Menu',        'Menu',         1, 11, 'index', '', '', 'ic-backend-17', '',                11, 1, 1, 1, '2019-04-16 22:42:16', 1);

DROP TABLE IF EXISTS `admin_one_many`;
CREATE TABLE `admin_one_many` (
    `id`        bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `one_id`    int(11) UNSIGNED NOT NULL COMMENT 'One id',
    `many_id`   int(11) UNSIGNED NOT NULL COMMENT 'Many id',
    `type`      tinyint(3) UNSIGNED NOT NULL COMMENT 'Type of relation',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 COMMENT='one_many';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(13, 'admin-one-many', 1, 'One Many', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(40, 13, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(41, 13, 'view', 'Detail', 1, 1, '2019-04-06 17:11:56', 0),
(42, 13, 'create', 'Create', 1, 1, '2019-04-06 17:11:56', 0),
(43, 13, 'update', 'Update', 1, 1, '2019-04-06 17:12:27', 0),
(44, 13, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0);

INSERT INTO `admin_menu` (`id`, `name`, `description`, `module_id`, `controller_id`, `action`, `view`, `link`, `icon`, `icon_thumb`, `display_order`, `type`, `parent_id`, `status`, `created_date`, `created_by`) VALUES
(13, 'One Many', 'One Many', 1, 13, 'index', '', '', 'ic-backend-72', '', 12, 1, 1, 1, '2019-04-16 22:11:45', 1);

DROP TABLE IF EXISTS `admin_actions_roles`;
CREATE TABLE `admin_actions_roles` (
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `role_id`       smallint(11) UNSIGNED DEFAULT NULL COMMENT 'Id of role',
    `controller_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'Id of controller',
    `actions`       text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'action',
    `can_access`    tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Flag can access',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 COMMENT='Actions - Roles';
DROP TABLE IF EXISTS `admin_actions_users`;
CREATE TABLE `admin_actions_users` (
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `user_id`       int(11) UNSIGNED DEFAULT NULL COMMENT 'Id of user',
    `controller_id` int(11) UNSIGNED DEFAULT NULL COMMENT 'Id of controller',
    `actions`       text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'action',
    `can_access`    tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Flag can access',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 COMMENT='Actions - User';

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(45, 4, 'authorization', 'Permission for the role: {role_name}', 1, 1, '2019-04-08 08:23:17', 1),
(46, 4, 'authorization-user', 'Permission for user: {username}', 1, 1, '2019-04-11 09:36:06', 1);

DROP TABLE IF EXISTS `admin_auto_emails`;
CREATE TABLE `admin_auto_emails` (
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `subject`       varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Subject of email',
    `content`       text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Content of email',
    `sent_to`       varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email to sent',
    `type`          tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Type of email (1 - Announce, 2 - Campaign, 3 - ...)',
    `time_sent`     datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Time to send email',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 COMMENT='Automation emails';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(14, 'admin-auto-emails', 1, 'Automation emails', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(47, 14, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(48, 14, 'view', 'Detail', 1, 1, '2019-04-06 17:11:56', 0),
(49, 14, 'create', 'Create', 1, 1, '2019-04-06 17:11:56', 0),
(50, 14, 'update', 'Update', 1, 1, '2019-04-06 17:12:27', 0),
(51, 14, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0);

INSERT INTO `admin_menu` (`id`, `name`, `description`, `module_id`, `controller_id`, `action`, `view`, `link`, `icon`, `icon_thumb`, `display_order`, `type`, `parent_id`, `status`, `created_date`, `created_by`) VALUES
(14, 'Automation Emails', 'Admin Auto emails', 1, 14, 'index',
 '', '', 'ic-backend-23', '', 13, 1, 1, 1, '2019-04-16 22:11:45', 1);

DROP TABLE IF EXISTS `admin_change_pass_requests`;
CREATE TABLE `admin_change_pass_requests` (
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `user_id`       int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'User account',
    `code`          varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Code of record',
    `ip_address`    varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'IP address',
    `country`       varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Country',
    `device`        tinyint(1) DEFAULT '1' COMMENT 'Type of device, 1: Android, 2: iOS, 3: Windows, 4: Web',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 COMMENT='Change password requests';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(15, 'admin-change-pass-requests', 1, 'Change password requests', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(52, 15, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(53, 15, 'view', 'Detail', 1, 1, '2019-04-06 17:11:56', 0),
(54, 15, 'create', 'Create', 1, 1, '2019-04-06 17:11:56', 0),
(55, 15, 'update', 'Update', 1, 1, '2019-04-06 17:12:27', 0),
(56, 15, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0);

INSERT INTO `admin_menu` (`id`, `name`, `description`, `module_id`, `controller_id`, `action`, `view`, `link`, `icon`, `icon_thumb`, `display_order`, `type`, `parent_id`, `status`, `created_date`, `created_by`) VALUES
(15, 'Change password request', 'Admin Change Pass Requests ', 1, 15, 'index',
 '', '', 'ic-backend-40', '', 14, 1, 1, 1, '2019-04-16 22:11:45', 1);

DROP TABLE IF EXISTS `admin_files`;
CREATE TABLE `admin_files` (
    `id`            bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `type`          tinyint(1) UNSIGNED DEFAULT NULL COMMENT 'Type of relation',
    `belong_id`     bigint(11) UNSIGNED DEFAULT NULL COMMENT 'Id of record relate with file',
    `file_type`     tinyint(1) UNSIGNED DEFAULT NULL COMMENT 'Type of file (image/video/document...)',
    `order_number`  tinyint(1) UNSIGNED DEFAULT NULL COMMENT 'Order number',
    `file_name`     text COMMENT 'Name of file',
    `description`   text COMMENT 'Description',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 COMMENT='Files';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(16, 'admin-files', 1, 'Admin Files', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`id`, `controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(57, 16, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(58, 16, 'view', 'Detail', 1, 1, '2019-04-06 17:11:56', 0),
(59, 16, 'create', 'Create', 1, 1, '2019-04-06 17:11:56', 0),
(60, 16, 'update', 'Update', 1, 1, '2019-04-06 17:12:27', 0),
(61, 16, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0);

INSERT INTO `admin_menu` (`id`, `name`, `description`, `module_id`, `controller_id`, `action`, `view`, `link`, `icon`, `icon_thumb`, `display_order`, `type`, `parent_id`, `status`, `created_date`, `created_by`) VALUES
(16, 'File manager', 'Admin Files ', 1, 16, 'index',
 '', '', 'ic-backend-76', '', 15, 1, 1, 1, '2019-04-16 22:11:45', 1);