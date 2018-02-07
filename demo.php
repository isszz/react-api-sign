<?php

require SignSrv.php;

$data = array_merge($_GET, $_POST);

if (empty($data['sign'])) {
    exit(json_encode(['code' => 1003, 'message' => '缺少参数sign']));
}

if (empty($data['$timestamp'])) {
    exit(json_encode(['code' => 1004, 'message' => '缺少参数timestamp']));
}

if (time() - intval($data['$timestamp']) > 1800) {
    exit(json_encode(['code' => 1005, 'message' => '请求过期']));
}

if (!SignSrv::check()) {
    exit(json_encode(['code' => 1006, 'message' => 'invalid sign']));
}
