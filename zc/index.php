<?php require_once('../conn.php'); 
error_reporting(0);
error_reporting(0);

header("Content-Type:text/html; charset=utf-8");
@$code = $_GET['t'];
if($code ==''){
	$code = 'admin';
}
if(checkPassword($code)){

	$err = "1";
 }else{
	 exit("请不要尝试注入手法。但凡你看了源码就知道无从下手！");
 }
if ($_POST["op"] == "注册") {
if(!empty($_POST["edit"])){
foreach ($_POST["edit"] as $value) {
 if(checkPassword($value)){
	
	$err = "1";
 }else{
	 exit("<script>alert('注册失败了请联系管理员处理00!');javascript:history.go(-1)</script>");
 }
}
}
  $form = $_POST["edit"];
  $username = trim($form["name"]);
  $password = trim($form["pass"]);
  $safecode = trim($form["email"]);
  
$sql = "SELECT uid FROM account.normal WHERE uid='{$username}'";
$result = mysqli_query($my_conn, $sql);
 while($row = mysqli_fetch_array($result))
{
   if($row['uid']=="$username"){
	   exit( "<script>alert('已存在该用户名,请重试!');javascript:history.go(-1)</script>");
   }
}

$reg_time = date("Y-m-d H:i:s");
$sql = "INSERT INTO account.normal (pt_id, uid, password,safecode,login_time,create_time,agent,email,fenghao)
VALUES ('{$username}', '{$username}', '{$password}','{$password}','{$reg_time}','{$reg_time}','{$code}','{$safecode}','0')";
if (mysqli_query($my_conn, $sql)) {
    echo("<script>alert('注册成功！请牢记用户名密码下载登录器哦');</script>");
} else {
     exit( "<script>alert('注册失败了请联系管理员处理66!');javascript:history.go(-1)</script>");
}


}

if ($_POST["res"] == "修改") {
	 
if(!empty($_POST["edit"])){
foreach ($_POST["edit"] as $value) {
 if(checkPassword($value)){
	
	$err = "1";
 }else{
	 exit("<script>alert('修改失败了哦.要不换信息试试!');javascript:history.go(-1)</script>");
 }
}
}
  $form = $_POST["edit"];
  $username = trim($form["name"]);
  $old_password = trim($form["old_pass"]);
  $password = trim($form["pass"]);
  $safecode = trim($form["email"]);

$sql = "SELECT * FROM account.normal WHERE uid='{$username}'";
$result = mysqli_query($my_conn, $sql);
 $row = mysqli_fetch_array($result);
 if($row['password']=="$old_password"&&$row['safecode']=="$safecode"){
	 $sql = "UPDATE account.normal SET password='{$password}' WHERE uid='{$username}'";
	  mysqli_query($my_conn, $sql);
	if(mysqli_affected_rows($my_conn)>0){
		echo"<script>alert('密码修改成功,新密码：".$password."');";
	}
   }else{
	   echo"<script>alert('密码或安全码错误!');javascript:history.go(-1)</script>";
   }
}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport"/>
	<meta content="yes" name="apple-mobile-web-app-capable"/>
	<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
	<meta content="telephone=no" name="format-detection"/>
    <link rel="stylesheet" href="css/xin.css">
  <script src="js/jquery.js"></script>
	<title>传奇注册</title>
	
	<script type="text/javascript">
	function InUrl(s){
		    window.setTimeout("window.location='<?php echo $down;?>'",s); 
        }	
		function CheckReg(){
			var user=$.trim($("#name").val());
			var username=/^[0-9a-zA-Z]*$/g;
			if(user.length<6){
				alert("用户名最少6位!");
				return false;
			}
			if(username.test(user)==false){
				alert("用户名只能是英文或数字!");
				return false;
			}
			if(user.length>12){
				alert("用户名最长12位!");
				return false;
			}			
			var password=$.trim($("#pass").val());
			if(password.length<6){
				alert("密码最少6位!");
				return false;
			}
			if(password.length>12){
				alert("密码最长12位!");
				return false;
			}		
			var password2=$.trim($("#pass2").val());
			if(password2 != password){
				alert("两次输入的密码不一致!");
				return false;
			}
			var email = $.trim($("#email").val());
			if(email.length<6){
				alert("安全码最少6位!");
				return false;
			}
			if(email.length>12){
				alert("安全码最长12位!");
				return false;
			}
		}
	</script>
</head>
<body>
 	<div class="wrap">
 		<div class="logo"></div>
 		<div class="title">注  册<div class="border"></div></div>
 		<div class="from-box">
		        <form method="post" action="" style="margin: 0 auto;margin-top:50px;" onSubmit="return CheckReg()">
 			<div class="input-box">
 						<input class="vcode" type="text" name="edit[name]" maxlength=12 id="name" placeholder="用户名(8-12位)" value="" onFocus="if(this.placeholder=='用户名(8-12位)'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='用户名(8-12位)'}">
                        <input class="vcode2" type="password" name="edit[pass]" maxlength=12 id="pass" placeholder="密码(8-12位[包含数字,字母])" value="" onFocus="if(this.placeholder=='密码(8-12位[包含数字,字母])'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='密码(8-12位[包含数字,字母])'}">
                        <input class="vcode3" type="password" name="edit[pass2]" maxlength=12 id="pass2" placeholder="再次输入密码" value="" onFocus="if(this.placeholder=='再次输入密码'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='再次输入密码'}">
                        <input class="vcode4" type="text" name="edit[email]" maxlength=12 id="email" placeholder="安全码(找回账号时用的)" value="" onFocus="if(this.placeholder=='安全码(找回账号时用的)'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='安全码(找回账号时用的)'}">                    
              
 			</div>
 			<div class="loginbtn"><input type="submit" name="op" class="login" value="注册"></div>
 			</form>								
 			<div class="loginbtn"><input type="button" onclick="location.href='https://www.123pan.com/s/Z9FDVv-Jsqjh.html'" class="reg" value="安卓下载"><input type="button" onclick="location.href='https://www.123pan.com/s/Z9FDVv-Msqjh.html'" class="zhao" value="苹果下载"></div>

 		</div>
  	</div>
<?php echo $alert; ?>

	<script src="js/app.js"></script>
<script src="js/scrollreveal.js"></script>
<script>
    if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
        (function(){
            window.scrollReveal = new scrollReveal({reset: true});
        })();
    };
</script>
</body>
</html>