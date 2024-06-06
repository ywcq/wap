<?php require_once('../conn.php'); 
/*
该系统由极简支付 pay.1234500000.com 提供二次开发。该系统永久免费。有人卖给你就举报他骗子！
该系统由极简支付 pay.1234500000.com 提供二次开发。该系统永久免费。有人卖给你就举报他骗子！
该系统由极简支付 pay.1234500000.com 提供二次开发。该系统永久免费。有人卖给你就举报他骗子！
*/
?>
<?php


loggedIn();

$my = "SELECT id FROM web_wan.codepay_user WHERE user = '{$user}'";
$my = mysqli_query($my_conn,$my) or die(mysqli_error());
$row_my = mysqli_fetch_array($my);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="战神后台管理系统">
  <meta name="keywords" content="战神后台管理系统" />
  <title>战神后台管理系统</title>
  <link href="css/root.css" rel="stylesheet">

  </head>
  <body>
  <div class="loading"><img src="img/loading.gif" alt="loading-img"></div>
  <div id="top" class="clearfix">
  	<div class="applogo">
  		<a href="#" class="logo">战神后台管理系统</a>
  	</div>
    <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <ul class="topmenu">
      <li>　　欢迎回来：<b class="color-down"><?php echo $user ?></b></li>
    </ul>
    <a href="#sidepanel" class="sidepanel-open-button"><i class="fa fa-outdent"></i></a>
    <ul class="top-right">


    <li class="dropdown link">
      <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><img src="img/profileimg.png" alt="img"><b>管理员</b><span class="caret"></span></a>
        <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">

          <li><a href="./login.php"><i class="fa falist fa-power-off"></i>退出</a></li>
        </ul>
    </li>

    </ul>
  </div>
<div class="sidebar clearfix">

<ul class="sidebar-panel nav">
  <li class="sidetitle">管理菜单</li>
  <?php if ($row_my['id'] ==='1'){
echo<<<ETO
	  <li><a href="javascript:" onclick="zairu('admin_kongzhi.php');"><span class="icon color5"><i class="fa fa-home"></i></span>管理首页</a></li>
      <li><a href="javascript:" onclick="zairu('dl_list.php');"><span class="icon color14"><i class="fa fa-sitemap"></i></span>代理用户管理</a></li>
      <li><a href="javascript:" onclick="zairu('user_list.php');"><span class="icon color7"><i class="fa fa-male"></i></span>用户查询管理</a></li>
      <li><a href="javascript:" onclick="zairu('pay_list.php');"><span class="icon color7"><i class="fa fa-shopping-cart"></i></span>充值查询管理</a></li>
      <li><a href="javascript:" onclick="zairu('daili_list.php');"><span class="icon color7"><i class="fa fa-shopping-cart"></i></span>代理总计管理</a></li>
      <li><a href="javascript:" onclick="zairu('dl_add.php');"><span class="icon color7"><i class="fa fa-shopping-cart"></i></span>开通下级代理</a></li>
      <li><a href="javascript:" onclick="zairu('pay_adminjie.php');"><span class="icon color7"><i class="fa fa-shopping-cart"></i></span>结算查询管理</a></li>
  </li>
ETO;
}else{
echo<<<ETO
<li><a href="javascript:" onclick="zairu('kongzhi.php');"><span class="icon color5"><i class="fa fa-home"></i></span>管理首页</a></li>
      <li><a href="javascript:" onclick="zairu('user_list.php');"><span class="icon color7"><i class="fa fa-male"></i></span>用户查询管理</a></li>
      <li><a href="javascript:" onclick="zairu('pay_list.php');"><span class="icon color7"><i class="fa fa-shopping-cart"></i></span>充值查询管理</a></li>

      <li><a href="javascript:" onclick="zairu('pay_jie.php');"><span class="icon color7"><i class="fa fa-shopping-cart"></i></span>结算查询管理</a></li>
ETO;
  }?>
  
</ul>



</div>
<div class="content">
<?php if ($row_my['id'] ==='1'){
echo'<iframe name="right" id="rightMain" src="admin_kongzhi.php" frameborder="false" scrolling="auto" style="border:none;" width="100%" height="1000" allowtransparency="true"></iframe>';
}else{
	echo'<iframe name="right" id="rightMain" src="kongzhi.php" frameborder="false" scrolling="auto" style="border:none;" width="100%" height="1000" allowtransparency="true"></iframe>';
	
}?>
 
</div>


</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript"> 
function zairu(lujing)
{
document.getElementById('rightMain').src=lujing;
 }
function dakai()
{
}
</script>


</body>
</html>