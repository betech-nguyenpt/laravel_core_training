/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  nguyenpt
 * Created: Feb 29, 2020
 */

-- Last controller id.
SELECT @ControllerId := MAX(id) FROM `admin_controllers`;
-- Last menu id.
SELECT @MenuId := MAX(id) FROM `admin_menu`;

SET @ControllerId_api_default       = @ControllerId + 1;
SET @ControllerId_api_request_logs  = @ControllerId + 2;
SET @ControllerId_api_user_tokens   = @ControllerId + 3;
SET @ControllerId_api_reg_requests  = @ControllerId + 4;
SET @MenuId_API                     = @MenuId + 1;

DROP TABLE IF EXISTS `api_request_logs`;
CREATE TABLE `api_request_logs` (
    `id`                int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `ip_address`        varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'IP address',
    `country`           varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Country',
    `user_id`           int(11) DEFAULT NULL COMMENT 'Id of user',
    `method`            text COLLATE utf8_unicode_ci COMMENT 'Method',
    `content`           text COLLATE utf8_unicode_ci COMMENT 'Content',
    `response`          text COLLATE utf8_unicode_ci COMMENT 'Response',
    `created_date`      datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `responsed_date`    datetime DEFAULT NULL COMMENT 'Time response',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 COMMENT='API request logs';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(@ControllerId_api_default, 'default', 2, 'Default API', 1, '2019-04-06 16:11:12', 0),
(@ControllerId_api_request_logs, 'api-request-logs', 2, 'Request Logs', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(@ControllerId_api_default, 'index', 'Default API index', 1, 1, '2019-04-06 17:11:44', 0),
(@ControllerId_api_request_logs, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(@ControllerId_api_request_logs, 'view', 'Detail', 1, 1, '2019-04-06 17:11:56', 0),
(@ControllerId_api_request_logs, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0);

INSERT INTO `admin_menu` (`id`,`name`, `description`, `module_id`, `controller_id`, `action`, `view`,
 `link`, `icon`, `icon_thumb`, `display_order`, `type`, `parent_id`, `status`, `created_date`, `created_by`) VALUES
(@MenuId_API, 'API', 'API', 2, @ControllerId_api_default, 'index',
 '', '', 'ic-backend-8', 'ic-backend-65',    2, 1, NULL, 1, '2019-04-16 15:39:16', 1),
(@MenuId_API+1, 'API Request Logs', 'API Request Logs', 2, @ControllerId_api_request_logs, 'index',
 '', '', 'ic-backend-32', '', 1, 1, @MenuId_API, 1, '2019-04-16 22:11:45', 1);

DROP TABLE IF EXISTS `api_user_tokens`;
CREATE TABLE `api_user_tokens` (
    `id`            bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `type`          tinyint(1) DEFAULT '1' COMMENT 'Type of device, 1: Android, 2: iOS, 3: Windows, 4: Web',
    `user_id`       int(11) UNSIGNED NOT NULL COMMENT 'User id',
    `token`         varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Token use to access through API request',
    `device_token`  varchar(256) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Device token use to push notification',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 COMMENT='API user tokens';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(@ControllerId_api_user_tokens, 'api-user-tokens', 2, 'User Tokens', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(@ControllerId_api_user_tokens, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(@ControllerId_api_user_tokens, 'view', 'Detail', 1, 1, '2019-04-06 17:11:56', 0),
(@ControllerId_api_user_tokens, 'update', 'Update', 1, 1, '2019-04-06 17:11:56', 0),
(@ControllerId_api_user_tokens, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0);

INSERT INTO `admin_menu` (`id`,`name`, `description`, `module_id`, `controller_id`, `action`, `view`,
 `link`, `icon`, `icon_thumb`, `display_order`, `type`, `parent_id`, `status`, `created_date`, `created_by`) VALUES
(@MenuId_API+2, 'Token', 'API User Tokens', 2, @ControllerId_api_user_tokens, 'index',
 '', '', 'ic-backend-91', '', 2, 1, @MenuId_API, 1, '2019-04-16 22:11:45', 1);

DROP TABLE IF EXISTS `api_reg_requests`;
CREATE TABLE `api_reg_requests` (
    `id`            int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `phone`         varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Phone',
    `password`      text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Password hash',
    `temp_password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Temp password',
    `code`          varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'OTP',
    `time_verify`   datetime DEFAULT NULL COMMENT 'Time verify',
    `status`        tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'Status',
    `created_date`  datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created date',
    `created_by`    int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Created by',
PRIMARY KEY ( `id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 COMMENT='API register requests';

INSERT INTO `admin_controllers` (`id`, `name`, `module_id`, `description`, `status`, `created_date`, `created_by`) VALUES
(@ControllerId_api_reg_requests, 'api-reg-requests', 2, 'Register Requests', 1, '2019-04-06 16:11:12', 0);

INSERT INTO `admin_controller_actions` (`controller_id`, `action`, `name`, `permission`, `status`, `created_date`, `created_by`) VALUES
(@ControllerId_api_reg_requests, 'index', 'List', 1, 1, '2019-04-06 17:11:44', 0),
(@ControllerId_api_reg_requests, 'view', 'Detail', 1, 1, '2019-04-06 17:11:56', 0),
(@ControllerId_api_reg_requests, 'delete', 'Delete', 1, 1, '2019-04-06 17:12:40', 0);

INSERT INTO `admin_menu` (`id`,`name`, `description`, `module_id`, `controller_id`, `action`, `view`,
 `link`, `icon`, `icon_thumb`, `display_order`, `type`, `parent_id`, `status`, `created_date`, `created_by`) VALUES
(@MenuId_API+3, 'Register requests', 'API Register Requests', 2, @ControllerId_api_reg_requests, 'index',
 '', '', 'ic-backend-31', '', 2, 1, @MenuId_API, 1, '2019-04-16 22:11:45', 1);