<?php

$json = file_get_contents("php://input");
//获取请求参数
if (empty($json)) {
    die('request is empty');
}
$data = json_decode($json, true);

//$savePath = __DIR__;//本文件放在项目根目录的写法
$savePath = dirname(__DIR__);//这是TP写法，本文件放在public下

//密码
if($data['password']){
    $password = '6836280';
//验证密码是否正确
    if ($data['password'] != $password) {
        header("HTTP/1.1 403 Forbidden");
        die('非法提交');
    }
}

//一定要在php.ini 配置文件中解除所有禁用 disable_funtions  exec 方法

// git放弃修改，强制覆盖本地代码
echo shell_exec("cd {$savePath} && git checkout ."); // git checkout
// echo shell_exec("cd {$savePath} && git pull {$gitPath}  2>&1");

$res = PHP_EOL . "pull start " . PHP_EOL;
$res .= shell_exec("cd " . $savePath . " && git pull https:xxxxxxxxxx.git 2<&1 "); //代码仓库 一定要使用ssh方式不然每次都得输入密码
$res_log = PHP_EOL;
$res_log .= $data['user_name'] . ' 在' . date('Y-m-d H:i:s') . '向' . $data['repository']['name'] ;
$res_log .= '项目的' . $data['ref'] . '分支push了' . $data['total_commits_count'] . '个 ';
$res_log .= 'commit：' . $data['commits']['message'];
$res_log .= $res;
$res_log .= "pull end -----------------------------------------------------" . PHP_EOL;

//保存日志文件路径 注意开启日志写入权限
$filePath = $savePath . "/runtime/webhook/" . date('Y-m-d', time()) . ".txt";
if (!file_exists($filePath)) touch($filePath);
file_put_contents($filePath, $res_log, FILE_APPEND);//写入日志到log文件中

if (isset($data['ref']) && $data['total_commits_count'] > 0) {
    $typeText = "\r\n更新正常\r\n";
    $res_log .= $typeText;
} else {
    $typeText = "\r\n无提交也更新\r\n";
    $res_log .= $typeText;
}

echo $res_log;

?>