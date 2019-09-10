<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-09-09 22:45:07 --> Query error: Table 'food_order.baskets' doesn't exist - Invalid query: DELETE FROM `baskets`
WHERE `user_id` = '1'
ERROR - 2019-09-09 23:28:37 --> Severity: error --> Exception: Call to undefined method Order_model::add_order_log() C:\AppServ\www\apiFoodOrder\application\controllers\Order.php 56
ERROR - 2019-09-09 23:29:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '(`user_id`, `address`, `drink`, `food_id`, `status`) VALUES ('1', 'Ev', 'Ayran',' at line 1 - Invalid query: INSERT INTO  (`user_id`, `address`, `drink`, `food_id`, `status`) VALUES ('1', 'Ev', 'Ayran', '2', 1)
