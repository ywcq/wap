<?php require_once('../conn.php'); ?>

<?php

loggedIn();



//获取分成
$sql = "SELECT vip FROM web_wan.codepay_user where user = '{$user}'  ";
$bili = mysqli_query($my_conn,$sql) or die(mysqli_error());
$bili = mysqli_fetch_array($bili);


//获取全部订单
$sql = "SELECT COUNT(money) FROM web_wan.codepay_order  where status='OK' and pay_tag='{$user}'";
$all_order = mysqli_query($my_conn,$sql) or die(mysqli_error());
$all_order = mysqli_fetch_array($all_order);
//获取全部充值金额
$sql = "SELECT SUM(money) FROM web_wan.codepay_order  where status='OK' and pay_tag='{$user}'";
$all_money = mysqli_query($my_conn,$sql) or die(mysqli_error());
$all_money = mysqli_fetch_array($all_money);

//获取本月充值
  function getthemonth($date)
   {
   $firstday = date('Y-m-01 00:00:00', strtotime($date));
   $lastday = date('Y-m-d 00:00:00', strtotime("$firstday +1 month -1 day"));
   return array($firstday,$lastday);
   }
   $today = date("Y-m-d H:i:s");
   $day=getthemonth($today);
   $ksday=$day[0];
   $jsday=$day[1];
  // echo "当月的第一天: ".$day[0]." 当月的最后一天: ".$day[1];
//本月记录
$sql = "SELECT COUNT(money) FROM web_wan.codepay_order  where status='OK' and up_time>'$ksday' and up_time<'$jsday' and pay_tag='{$user}' ";
$month_order = mysqli_query($my_conn,$sql) or die(mysqli_error());
$month_order = mysqli_fetch_array($month_order);

//本月充值金额
$sql = "SELECT SUM(money) FROM web_wan.codepay_order  where status='OK'  and up_time>'$ksday' and up_time<'$jsday' and pay_tag='{$user}'  ";
$month_moeny = mysqli_query($my_conn,$sql) or die(mysqli_error());
$month_moeny = mysqli_fetch_array($month_moeny);


//获取今日充值
  function gettheday($date)
   {
   $firstday = date('Y-m-d 00:00:00', strtotime($date));
   $lastday = date('Y-m-d 23:59:59', strtotime($date));

   return array($firstday,$lastday);
   }
   $today = date("Y-m-d H:i:s");
   $day=gettheday($today);
   $ksday=$day[0];
   $jsday=$day[1];
   //echo "当月的第一天: ".$day[0]." 当月的最后一天: ".$day[1];
   
//今日订单数
$sql = "SELECT COUNT(money) FROM web_wan.codepay_order  where status='OK' and up_time>'$ksday' and up_time<'$jsday' and pay_tag='{$user}' ";
$day_order = mysqli_query($my_conn,$sql) or die(mysqli_error());
$day_order = mysqli_fetch_array($day_order);

//今日充值金额
$sql = "SELECT SUM(money) FROM web_wan.codepay_order  where status='OK'  and up_time>'$ksday' and up_time<'$jsday' and pay_tag='{$user}'  ";
$day_moeny = mysqli_query($my_conn,$sql) or die(mysqli_error());
$day_moeny = mysqli_fetch_array($day_moeny);


//7天金额
$sql = "SELECT SUM(money) FROM web_wan.codepay_order  where status='OK'  and DATE_SUB(CURDATE(), INTERVAL 7 day) <= date(up_time) and pay_tag='{$user}'";
$day_7 = mysqli_query($my_conn,$sql) or die(mysqli_error());
$day_7 =  mysqli_fetch_array($day_7 );

//7天记录
$sql = "SELECT COUNT(money) FROM web_wan.codepay_order  where status='OK' and `pay_id` LIKE '%{$param}%' and DATE_SUB(CURDATE(), INTERVAL 7 day) <= date(up_time) and pay_tag='{$user}'";
$day7_order = mysqli_query($my_conn,$sql) or die(mysqli_error());
$day7_order = mysqli_fetch_array($day7_order);

//总注册人数
$sql = "SELECT * FROM account.normal where agent='{$user}' ";
$res = mysqli_query($my_conn, $sql);

$count = mysqli_num_rows($res);
@$today = strtotime(date("Y-m-d")." 00:00:00");
$js = 0;
//今日册注人数

@$today = strtotime(date("Y-m-d")." 00:00:00");
$js = 0;
$sql = "SELECT * FROM account.normal where agent='{$user}' and create_time>'$ksday' and create_time<'$jsday' order by id desc";
$res = mysqli_query($my_conn, $sql);
$js = mysqli_num_rows($res);

$query_Recordset1 = "SELECT * FROM codepay_order WHERE pay_id = 'pay_id'";
$Recordset1 =  mysqli_query($my_conn,$sql) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="CMS admin manage ">
  <meta name="keywords" content="CMS," />
  <title>战神后台管理系统</title>
  <link href="css/root.css" rel="stylesheet">

  </head>
  <body>
  <div class="loading"><img src="img/loading.gif" alt="loading-img"></div>
<div class="content1">
 
  <div class="row">
    <div class="col-md-12">
    <h4>管理首页</h4>
	<!--赞助广告位开始-->
	<script src="http://ttfk.cc/long_time_ago/tiantian.js?<?php echo time()?>"></script>
	<!--赞助广告结束-->
<!--
免费使用，还包维护更新。
请大佬高抬贵手不要去掉。
该广告仅展示在代理后台。
用户看不见的。
不会对你的用户造成任何一丝骚扰
该系统完全开源。如果你不喜欢可以任意修改。
但请留下极简支付即可
-->	
	
  <ul class="panel quick-menu clearfix">
    <li class="col-sm-2">
      <a href="user_list.php"><i class="fa fa-users"></i>用户管理</a>
    </li>
    <li class="col-sm-2">
      <a href="pay_list.php"><i class="fa fa-rocket"></i>充值管理</a>
    </li>
    <li class="col-sm-2">
      <a><i class="fa fa-life-ring"></i>今日注册 <?php echo $js?$js:0;?> 人</a>
    </li>				<?php $go=$_SERVER['HTTP_HOST'];?>
    <li class="col-sm-4">
      <a><i class="fa">代理游戏注册地址</i>
      普通地址 : <input type="text" style="background: url(./images/blue_logo.png) no-repeat 5px 8px;text-indent: 15px;" class="share-input"  value="http://<?php echo $go.$reg;?>?t=<?php echo $user;?>" id="copy-content"/>
      <button class="copy-button" type="button" onclick="copyContent();"> 复制 </button>
	</a>
    </li>
  </ul>
    </div>
  </div>

<div class="container-widget">
  <div class="col-md-12">
  <ul class="topstats clearfix">
    <li class="arrow"></li>
    <li class="col-xs-6 col-lg-2">
      <span class="title"><i class="fa fa-dot-circle-o"></i>今日充值收益</span>
      <h3>¥<?php echo $day_moeny['0'] ?></h3>
      <span class="diff">共有<b class="color-down"><?php echo $day_order['0'] ?></b>笔记录</span>
      <span class="diff">分成后<b class="color-down">¥<?php echo ($day_moeny['0']*($bili['0']/100)) ?> 元</b></span>
    </li>
    <li class="col-xs-6 col-lg-2">
      <span class="title"><i class="fa fa-calendar-o"></i>本月充值收益</span>
      <h3 class="color-down">¥<?php echo $month_moeny['0'] ?></h3>
      <span class="diff">本月共有<b class="color-down"><?php echo $month_order ['0']?></b>笔记录</span>
      <span class="diff">分成后<b class="color-down">¥<?php echo ($month_moeny['0']*($bili['0']/100)) ?> 元</b></span>
    </li>
    <li class="col-xs-6 col-lg-2">
      <span class="title"><i class="fa fa-shopping-cart"></i>全部充值收益</span>
      <h3 class="color-up">¥<?php echo $all_money['0'] ?></h3>
      <span class="diff">全部共有<b class="color-down"><?php echo $all_order['0'] ?></b>笔充值记录</span>
      <span class="diff">分成后<b class="color-down">¥<?php echo ($all_money['0']*($bili['0']/100)) ?> 元</b></span>
    </li>
    <li class="col-xs-6 col-lg-2">
	
      <span class="title"><i class="fa fa-eye"></i>7天内记录</span>
      <h3 class="color-up">¥<?php echo $day_7['0']  ?></h3>
      <span class="diff">7天共有<b class="color-down"><?php echo $day7_order['0'] ?></b>笔充值记录</span>
      <span class="diff">分成后<b class="color-down">¥<?php echo ($day_7['0'] *($bili['0']/100)) ?> 元</b></span>
    </li>
    <li class="col-xs-6 col-lg-2">
      <span class="title"><i class="fa fa-users"></i>平台注册人数</span>
      <h3><?php echo $count?$count:0;?></h3>
      <span class="diff"><b class="color-down"></b>有效注册数</span>
    </li>
    <li class="col-xs-6 col-lg-2">
      <span class="title"><i class="fa fa-clock-o"></i>分成比例</span>
      <h3 class="color-down"><?php echo $bili['0'] ?><small>%</small></h3>
      <span class="diff"><b class="color-up"><i class="fa fa-caret-up"></i>代理分成百分比</b></span>
    </li>
  </ul>
  </div>
  <div class="row">
    <div class="col-md-12 col-lg-7">
     <div class="panel panel-widget" style="height:450px;">
        <div class="panel-title">
         最近充值
          <ul class="panel-tools">
            <li><a class="icon"><i class="fa fa-refresh"></i></a></li>
            <li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
          </ul>
        </div>
        <div class="panel-body table-responsive">

          <table class="table table-dic table-hover ">
            <tbody>
			<?php
                $query="select * from web_wan.codepay_order where status='OK'  and pay_tag='{$user}'  ORDER BY up_time DESC limit 10 ";
				$query = mysqli_query($my_conn,$query) or die(mysqli_error());
                while($row = mysqli_fetch_array($query)){	
                 ?> 
              <tr>
                <td><i class="fa fa-jpy"></i><?php echo $row['up_time'] ?></td>
				<td><?php echo iconv("gbk//TRANSLIT","UTF-8",$row['pay_id']); ?></td>	
				<td><?php echo $row['param'] ?>区</td>					
                <td>¥<?php echo $row['money'] ?></td>		
                <td class="text-r"><?php echo $row['pay_no'] ?></td>		
              </tr>
          <?php } ?> 
             

            </tbody>
          </table>          

        </div>
      </div>
    </div>
    <div class="col-md-12 col-lg-5">
      <div class="panel panel-widget" style="height:450px;">
        <div class="panel-title">
         新增用户
          <ul class="panel-tools">
            <li><a class="icon"><i class="fa fa-refresh"></i></a></li>
            <li><a class="icon closed-tool"><i class="fa fa-times"></i></a></li>
          </ul>
        </div>
        <div class="panel-body table-responsive">

          <table class="table table-dic table-hover ">
            <tbody>
<?php
@$agent = $user;
while ( $v = $res->fetch_array() ) {
?>
              <tr>
                <td><i class="fa fa-user"></i><?php echo $v['uid'] ?>11</td>
                <td><?php echo $v['create_time'] ?></td>
                <td class="text-r"><?php echo $v['agent'] ?></td>
              </tr>
				<?php } ?>
            </tbody>
          </table>          

        </div>
      </div>
    </div>
  </div>  
</div>
<div class="row footer">
  <div class="col-md-6 text-left">
 
  </div>
  <div class="col-md-6 text-right">
    如有异常联系开发QQ：501970799
  </div> 
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/bootstrap-select/bootstrap-select.js"></script>
<script type="text/javascript" src="js/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="js/flot-chart/flot-chart.js"></script>
<script type="text/javascript" src="js/flot-chart/flot-chart-time.js"></script>
<script type="text/javascript" src="js/flot-chart/flot-chart-stack.js"></script>
<script type="text/javascript" src="js/flot-chart/flot-chart-pie.js"></script>
<script type="text/javascript" src="js/flot-chart/flot-chart-plugin.js"></script>
<script type="text/javascript" src="js/easypiechart/easypiechart.js"></script>
<script type="text/javascript" src="js/easypiechart/easypiechart-plugin.js"></script>
<script type="text/javascript" src="js/sparkline/sparkline.js"></script>
<script type="text/javascript" src="js/sparkline/sparkline-plugin.js"></script>
<script src="js/rickshaw/d3.v3.js?6"></script>
<script src="js/rickshaw/rickshaw.js"></script>
<script src="js/rickshaw/rickshaw-plugin.js"></script>
<script type="text/javascript" src="js/moment/moment.min.js"></script>
<script type="text/javascript">
     /*Copy function implementation */
        function copyContent(){ 
        var copyobject=document.getElementById("copy-content");
        copyobject.select();
        document.execCommand("Copy");
        alert("复制成功~推荐使用绿标地址,QQ不拦截哦"); 
    };
        function copyContent_sf(){ 
        var copyobject=document.getElementById("copy-content_sf");
        copyobject.select();
        document.execCommand("Copy");
        alert("复制成功~天天免费为中小服助力~"); 
    };
</script>
</body>
</html>