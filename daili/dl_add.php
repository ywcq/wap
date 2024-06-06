<?php
require_once('../conn.php');
loggedIn();


?>
<?php
if(!empty($_POST['MM_insert'])){
$daili_user = $_POST['user'];
$vip = $_POST['vip'];//比例
$pass = $_POST['pass'];
$pay = $_POST['pay'];
$name = $_POST['name'];
$qq = $_POST['qq'];
//验证表单


$sql = "SELECT user FROM web_wan.codepay_user WHERE user='{$daili_user}'";
$result = mysqli_query($my_conn, $sql);
 while($row = mysqli_fetch_array($result))
{
   if($row['user']=="$daili_user"){
	   exit( "<script>alert('已存在该用户名,请重试!');javascript:history.go(-1)</script>");
   }
}

$sql = "insert into web_wan.codepay_user(`user`,`vip`, `pass`, `pay`, `name`, `qq`, `group`) values('$daili_user','$vip','$pass','$pay','$name','$qq','$user')";
$sq2 = "insert into web_wan.codepay_zong(`user`,`vip`) values('$daili_user','$vip')";

if (mysqli_query($my_conn, $sql)&&mysqli_query($my_conn, $sq2)) {
    echo("<script>alert('注册成功添加代理成功');javascript:history.go(-1)</script>");
} else {
     exit( "<script>alert('注册失败了');javascript:history.go(-1)</script>");
}
   
}
	
		
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Kode is a Premium Bootstrap Admin Template, It's responsive, clean coded and mobile friendly">
  <meta name="keywords" content="bootstrap, admin, dashboard, flat admin template, responsive," />
  <title>Kode</title>
<script>
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
				if(user.length>10){
					alert("用户名最长10位!");
					return false;
				}
			var vip=$.trim($(".vip").val());
					var bili=/^[0-9]*$/g;
					if(vip.length>3||vip==""){
						alert("比例不正确");
						return false;
					}
					if(bili.test(vip)==false){
						alert("比例只能是数字!");
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
			}			
</script>
  <!-- ========== Css Files ========== -->
  <link href="css/root.css" rel="stylesheet">
  </head>
  <body>
  <!-- Start Page Loading -->
  <div class="loading"><img src="img/loading.gif" alt="loading-img"></div>
  <!-- End Page Loading -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
 
 <!-- //////////////////////////////////////////////////////////////////////////// --> 
<!-- START CONTENT -->
<div class="content1">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title">开通代理</h1>


    <!-- Start Page Header Right Div -->
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="javascript:location.reload();" class="btn btn-light">刷新</a>
      </div>
    </div>
    <!-- End Page Header Right Div -->

  </div>
  <!-- End Page Header -->



            <div class="panel-body">
              
                <div role="tabpanel">

                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs tabcolor5-bg" role="tablist">
                    <li role="presentation" class="active"><a href="#home10" aria-controls="home10" role="tab" data-toggle="tab">基本设置</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home10">
     <div class="panel panel-default">

        <div class="panel-title">
          基本设置
          <ul class="panel-tools">
            <li><a class="icon minimise-tool"><i class="fa fa-minus"></i></a></li>
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
            <li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
          </ul>
        </div>

            <div class="panel-body">
			
<form name="form" method="POST" action="" onSubmit="return CheckReg()" class="form-horizontal">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <span>代理账号</span>
                                    </div>
                                    <div class="col-md-4">
                                       <input class="form-control name" placeholder="代理账号" type="text" value="" name="user"/>
                                    </div>
                                </div>
									<div class="form-group row">
                                    <div class="col-md-2">
                                        <span>分成比例</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control vip" placeholder="分成比例"   type="text" value="" name="vip"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <span>代理密码</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control pass" placeholder="代理密码" type="text" value="" name="pass"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <span>提现方式</span>
                                    </div>
                                    <div class="col-md-4">
                                       支付宝
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <span>提现账户</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" placeholder="请输入提现账户" type="text" value="" name="pay"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <span>提现户名</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" placeholder="请输入真实姓名" type="text" value="" name="name"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <span>联系人QQ</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" placeholder="QQ" type="text" value="" name="qq"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <span></span>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-lg btn-success">开通代理</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="MM_insert" value="form">
          </form>
			
            </div>

    </div>   
	</div>
         

</div>
<!-- END CONTAINER -->
 <!-- //////////////////////////////////////////////////////////////////////////// --> 




</div>
<!-- End Content -->

<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="js/jquery.min.js"></script>

<!-- ================================================
Bootstrap Core JavaScript File
================================================ -->
<script src="js/bootstrap/bootstrap.min.js"></script>

<!-- ================================================
Plugin.js - Some Specific JS codes for Plugin Settings
================================================ -->
<script type="text/javascript" src="js/plugins.js"></script>
							<script>
				function readFile(obj,id){
							$('#default-img'+id).attr('src','../do/loading.gif');
							var file = obj.files[0];
							//判断类型是不是图片
							if(!/image\/\w+/.test(file.type)){
											alert("请确保文件为图像类型");
											return false;
							}

							data = new FormData();
							data.append("file", file);
							$.ajax({
									data: data,
									type: "POST",
									url: "../do/imgupload.php",
									cache: false,
									contentType: false,
									processData: false,
									success: function(url) {
										$('#default-img'+id).attr('src',url);
										$('#pub-input'+id).attr('value',url);
									},
									error : function(data) {
										alert('上传失败');
										$('#default-img'+id).attr('src','../do/upload.jpg');
									}
							});
			}
				</script>
</body>
</html>