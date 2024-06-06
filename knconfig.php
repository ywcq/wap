<?php
//服务器设置 修改商户信息 根据回调密钥区分分区 所以不能重复
//连接它区数据库 要在它区mysql给一个远程连接权限
$config = array(
	//1区
	1=>array(
		"host"=>"127.0.0.1",//数据库ip
		"port"=>"3306", //端口
		"db"=>"gamedata", // 数据库
		"root"=>"root", // 账号
		"pass"=>"6836280aa", // 密码
		"token"=>"dofQgzAUHbjXyOEh" // 回调密钥 分区管理中设置好回调地址后自动生成
		),
	//2区
	2=>array(
		"host"=>"127.0.0.1",//数据库ip
		"port"=>"3306", //端口
		"db"=>"gamedata", // 数据库
		"root"=>"root", // 账号
		"pass"=>"6836280aa", // 密码
		"token"=>"WMMhtCPnreOFMusY" // 回调密钥 分区管理中设置好回调地址后自动生成
		),	
);
?>