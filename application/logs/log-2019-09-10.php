<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-09-10 00:07:10 --> Query error: Unknown column 'ticket' in 'field list' - Invalid query: INSERT INTO `message` (`user_id`, `ticket`, `message`) VALUES (NULL, NULL, NULL)
ERROR - 2019-09-10 00:07:33 --> Query error: Column 'user_id' cannot be null - Invalid query: INSERT INTO `message` (`user_id`, `title`, `message`) VALUES (NULL, NULL, NULL)
ERROR - 2019-09-10 00:14:32 --> Severity: Notice --> Undefined property: Message::$message C:\AppServ\www\apiFoodOrder\system\core\Model.php 73
ERROR - 2019-09-10 00:14:32 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 3 - Invalid query: SELECT *
FROM `message`
JOIN `users` ON `users`.`id` = .`user_id`
ERROR - 2019-09-10 01:04:44 --> 404 Page Not Found: Orders/get_all_orders
ERROR - 2019-09-10 01:04:50 --> 404 Page Not Found: Orders/get_all_orders
ERROR - 2019-09-10 01:05:28 --> 404 Page Not Found: Orders/get_all_orders
ERROR - 2019-09-10 01:05:43 --> 404 Page Not Found: Orders/get_all_orders
ERROR - 2019-09-10 01:05:58 --> 404 Page Not Found: Orders/get_all_orders
ERROR - 2019-09-10 01:06:00 --> 404 Page Not Found: Orders/get_all_orders
ERROR - 2019-09-10 11:19:07 --> Severity: error --> Exception: Call to undefined method Order_model::add_order_log() C:\AppServ\www\apiFoodOrder\application\controllers\Order.php 93
ERROR - 2019-09-10 11:21:02 --> Severity: Notice --> Undefined variable: user C:\AppServ\www\apiFoodOrder\application\controllers\Auth.php 62
ERROR - 2019-09-10 11:23:30 --> Severity: Notice --> Undefined variable: user C:\AppServ\www\apiFoodOrder\application\controllers\Auth.php 62
