<?php
include('classes.php');

$db = new DatabaseUtility();
$db->create_Table();
$db->insert_update(001, "update data");
$data = '{"update_id":608586272,"message":{"message_id":376,"from":{"id":889294912,"is_bot":false,"first_name":"Slim","last_name":"Danney","username":"SlimDanney","language_code":"en"},"chat":{"id":889294912,"first_name":"Slim","last_name":"Danney","username":"SlimDanney","type":"private"},"date":1604360914,"text":"asdfsd"}}';
$db->insert_update(608586272, $data);
$db->get_Table("SELECT * FROM Updates");

?>