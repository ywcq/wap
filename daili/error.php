<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php 
@$msg = $_GET['msg'];
$error = array(
			1=>'：余额不足',
			2=>'：错误81',
			3=>'：请完善信息后再次提交',
			4=>'：该代理不存在或不属于你',
		);
if(strlen($msg) > 1){
	echo "<script language=javascript>alert('失败{$msg}');history.back();</script>";
}else{		
	echo "<script language=javascript>alert('失败{$error[$msg]}');history.back();</script>";
}
?>
</body>
</html>
