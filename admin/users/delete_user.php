<?php
include($_SERVER['DOCUMENT_ROOT']."/myweb/mera-darzi/helper.php");

$record_id = $_GET["id"];

$result = delete_record("tbl_users", $record_id);
header("Location: users.php?msg=" . urlencode($result));
exit();