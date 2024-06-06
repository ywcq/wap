
<?php require_once('../conn.php'); 
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="yes" name="apple-mobile-web-app-capable"/>
    <meta content="yes" name="apple-touch-fullscreen"/>
    <meta content="telephone=no,email=no" name="format-detection"/>
    <meta content="fullscreen=yes,preventMove=no" name="ML-Config"/>
    <meta http-equiv="Expires" content="-1"/>
    <meta http-equiv="pragram" content="no-cache"/>
    <title>传奇注册</title>
    <meta name="keywords" content="注册">
    <meta name="description" content="注册">
    
	<script>
		
    if ((navigator.userAgent.match(/(iPhone|iPod|Android|ios|iOS|iPad|Backerry|WebOS|Symbian|Windows Phone|Phone)/i))) {
        document.write("<link rel='stylesheet' href='css/ph.css?2'>");
    }else{
        document.write("<link rel='stylesheet' href='css/ph_pc.css?2'>");
    }

	</script>
	<script src="js/sweetalert.min.js"></script>
	<script src="js/jquery.js"></script>
    <script src="js/jquery1.42.min.js"></script>
    <script type="text/javascript" src="js/m640.js"></script>
    <script src="js/TouchSlide.1.1.js"></script>
    <script src="js/jquery.SuperSlide.2.1.1.js"></script>
	<script src="sweetalert.min.js"></script>

	<script type="text/javascript">
		function InUrl(s){
		    window.setTimeout("window.location='https://qm.qq.com/cgi-bin/qm/qr?k=9YEwP5DCYtikgYNZumO7-wlNBZnB3LY-&jump_from=webapi&authKey=68+K8+/NOSbCrk344TWDNkC59TJA7JsvPclmD6Dk6Ny6QEdNKvf1XSeZELjMtlrI'",s); 
        }	
		function CheckReg(){
			var user=$.trim($(".name").val());
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
			var password=$.trim($(".pass").val());
			if(password.length<6){
				alert("密码最少6位!");
				return false;
			}
			if(password.length>12){
				alert("密码最长12位!");
				return false;
			}			
            var pwdRegex = new RegExp('(?=.*[0-9])(?=.*[a-zA-Z])');
            if (!pwdRegex.test(password)){
				alert("您的密码复杂度太低（密码中必须包含字母、数字）");
                return false;
            }			
			var password2=$.trim($(".pass2").val());
			if(password2 != password){
				alert("两次输入的密码不一致!");
				return false;
			}
			var email = $.trim($(".email").val());
			if(email.length<6){
				alert("安全码最少6位!");
				return false;
			}
			if(email.length>12){
				alert("安全码最长12位!");
				return false;
			}
			if (!pwdRegex.test(email)){
                alert("您的安全码复杂度太低（密码中必须包含字母、数字）");
                return false;
            }
		}
		function CheckRes(){
			var user=$.trim($(".name_res").val());
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
			var password=$.trim($(".pass_res").val());
			if(password.length<6){
				alert("密码最少6位!");
				return false;
			}
			if(password.length>12){
				alert("密码最长12位!");
				return false;
			}			
            var pwdRegex = new RegExp('(?=.*[0-9])(?=.*[a-zA-Z])');
            if (!pwdRegex.test(password)){
				alert("您的密码复杂度太低（密码中必须包含字母、数字）");
                return false;
            }			
			var password2=$.trim($(".pass2_res").val());
			if(password2 != password){
				alert("两次输入的密码不一致!");
				return false;
			}
			var email = $.trim($(".email_res").val());
			if(email.length<6){
				alert("安全码最少6位!");
				return false;
			}
			if(email.length>12){
				alert("安全码最长12位!");
				return false;
			}
			if (!pwdRegex.test(email)){
                alert("您的安全码复杂度太低（密码中必须包含字母、数字）");
                return false;
            }
		}
	</script>
<body>

<nav class="res">
    <div class="list" style="margin-top: 50px;font-size:34px;background-color:rgba(255,255,255,0.4)">
	  <div class="close"><img src="images/close.png" width="180" height="70"/></div>
        <header class="ui-header">
            <h1 style="font-size:50px;color:#fff700;text-align:center;padding-top:50px;font-weight:bold;">传奇注册</h1>
        </header>
		        <form method="post" action="" style="margin: 0 auto;margin-top:50px;" onSubmit="return CheckReg()">
                        <input class="sinput name" type="text" name="edit[name]" maxlength=12 id="name"  placeholder="用户名(6-12位)" value="" onFocus="if(this.placeholder=='用户名(6-12位)'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='用户名(6-12位)'}">

						<input class="sinput" type="hidden" name="code" value="<?php echo $_GET["t"]?>">
						
                        <input class="sinput pass" type="password" name="edit[pass]" maxlength=12 id="pass"  placeholder="密码(6-12位[包含数字,字母])" value="" onFocus="if(this.placeholder=='密码(6-12位[包含数字,字母])'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='密码(6-12位[包含数字,字母])'}">
                        <input class="sinput pass2" type="password" name="edit[pass2]" maxlength=12 id="pass2"  placeholder="再次输入密码" value="" onFocus="if(this.placeholder=='再次输入密码'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='再次输入密码'}">
                        <input class="sinput email" type="text" name="edit[email]" maxlength=12 id="email"  placeholder="安全码(6-12位[包含数字,字母])" value="" onFocus="if(this.placeholder=='安全码(6-12位[包含数字,字母])'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='安全码(6-12位[包含数字,字母])'}">                    
			
				<div class="weui-cell-button">
					<input class="bount weui-btn weui-btn_primary weui-btn-submit" type="submit" name="op" style="width:92%;font-size: 1.2em;margin-left:27px;margin-top:30px;margin-bottom:50px;border-radius: 10px;outline:none;cursor: pointer;" value="注册">
               </div>
                </form>
    </div>
</nav>
<!--修改密码-->

<nav class="update">
    <div class="list" style="margin-top: 50px;font-size:34px;background-color:rgba(255,255,255,0.4)">
	  <div class="close"><img src="images/close.png" width="180" height="70"/></div>
        <header class="ui-header">
            <h1 style="font-size:50px;color:#fff700;text-align:center;padding-top:50px;font-weight:bold;">修改密码</h1>
        </header>
		        <form method="post" action="" style="margin: 0 auto;margin-top:50px;" onSubmit="return CheckRes()">
                        <input class="sinput name_res" type="text" name="edit[name]" maxlength=12 id="name"  placeholder="用户名(6-12位)" value="" onFocus="if(this.placeholder=='用户名(6-12位)'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='用户名(6-12位)'}">
						
                        <input class="sinput old_pass_res" type="password" name="edit[old_pass]" maxlength=12 id="old_pass"  placeholder="当前密码" value="" onFocus="if(this.placeholder=='当前密码'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='当前密码'}">
						
                        <input class="sinput pass_res" type="password" name="edit[pass]" maxlength=12 id="pass"  placeholder="新密码(6-12位[包含数字,字母])" value="" onFocus="if(this.placeholder=='密码(6-12位[包含数字,字母])'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='密码(6-12位[包含数字,字母])'}">
						
                        <input class="sinput pass2_res" type="password" name="edit[pass2]" maxlength=12 id="pass2"  placeholder="再次输入新密码" value="" onFocus="if(this.placeholder=='再次输入新密码'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='再次输入新密码'}">
                        <input class="sinput email_res" type="text" name="edit[email]" maxlength=12 id="email" placeholder="你的安全码" value="" onFocus="if(this.placeholder=='你的安全码(6-12位[包含数字,字母])'){this.placeholder=''}" onBlur="if(this.placeholder==''){this.placeholder='你的安全码(6-12位[包含数字,字母])'}">                    
			
				<div class="weui-cell-button">
					<input class="bount weui-btn weui-btn_primary weui-btn-submit" type="submit" name="res" style="width:92%;font-size: 1.2em;margin-left:27px;margin-top:30px;margin-bottom:50px;border-radius: 10px;outline:none;cursor: pointer;" value="修改">
               </div>
                </form>
    </div>
</nav>

<!--修改密码-->
<div class="tops">
    <div class="to">
        <div class="to1"><img src="images/an-1.png"></div>
        <div class="to3"><img src="images/an-3.png"></div>
        <div class="to2"><a href="" onclick="InUrl(0)";><img src="images/d-1.png"></a></div>
    </div>
</div>
<div class="join_1">
            <img src="images/25.jpg" style="width: 100%;height:auto">
</div>
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
