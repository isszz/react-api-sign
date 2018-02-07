<?php

require SignSrv.php;

$sign = empty($_GET['sign']) ? (empty($_POST['sign']) ? '' : $_POST['sign']) : $_GET['sign'];
$timestamp = empty($_GET['timestamp']) ? (empty($_POST['timestamp']) ? '' : $_POST['timestamp']) : $_GET['timestamp'];

if (empty($sign)) {
    exit(json_encode(['code' => 1003, 'message' => '缺少参数sign']));
}

if (empty($timestamp)) {
    exit(json_encode(['code' => 1004, 'message' => '缺少参数timestamp']));
}

$sign = trim($sign);
$timestamp = trim($timestamp);

if ((Helper::time() - $timestamp) > 1800) {
    exit(json_encode(['code' => 1005, 'message' => '请求过期']));
}

if (!SignSrv::check()) {
    exit(json_encode(['code' => 1006, 'message' => 'invalid sign']));
}
