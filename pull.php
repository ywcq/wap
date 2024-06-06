<?php
$branch = 'dev'; // 设置分支
$maxLogNum = 10; // 设置日志最大文件数
$sign = '6836280'; // 密钥
$syncPath = '/www/web'; // 同步目录
$group = 'www:www';
$verFile = $syncPath.'/public/version.txt';
$verLogFile = $syncPath.'/public/version_';

// 只处理指定分支
$payload    = json_decode(file_get_contents("php://input"), true);
if ( ! isset($payload['ref']) || ! in_array($payload['ref'], ['refs/heads/'.$branch, 'refs/heads/test_version'])) {
    die('continue.');
}

$pullSign = isset($_REQUEST['sign']) ? $_REQUEST['sign'] : '';
$pullTime = isset($_REQUEST['timestamp']) ? $_REQUEST['timestamp'] : '';

$diffSign = $pullTime."\n".$sign;

$signOk = base64_encode(hash_hmac('sha256', $diffSign, $sign, true)) == $pullSign;
if (!$signOk) {
    die('forbidden.');
}
exec("cd {$syncPath}; git fetch --all 2<&1; git reset --hard origin/{$branch} 2<&1; git pull 2<&1;chown -R {$group} *;", $log, $code);

array_unshift($log, '['.date('Y-m-d H:i:s').']');

try {
    $verInfo = is_file($verFile) ? file_get_contents($verFile) : serialize(['i' => 0, 'time' => date('Y-m-d H:i:s')]);
    $verInfo = unserialize($verInfo);
} catch (Exception $e) {
    $verInfo = ['i' => 0, 'time' => date('Y-m-d H:i:s')];
}
$verInfo['i'] += 1;
$verInfo['time'] = date('Y-m-d H:i:s');
if ($verInfo['i'] > $maxLogNum) {
    $verInfo = ['i' => 1, 'time' => date('Y-m-d H:i:s')];
}
file_put_contents($verFile, serialize($verInfo));

file_put_contents($verLogFile.$verInfo['i'].'.log', implode(PHP_EOL, $log).PHP_EOL."[{$code}]");
echo 'success';
?>