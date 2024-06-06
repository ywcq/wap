<?php require_once('../conn.php'); 
loggedIn();


$my = "SELECT id FROM web_wan.codepay_user WHERE user = '{$user}'";
$my = mysqli_query($my_conn,$my ) or die(mysqli_error());
$row_my = mysqli_fetch_assoc($my);




if($row_my['id']!='1'){
	exit('小伙子想啥呢?不该看的地方不要看');
	
}


?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue; 
}
}
$user=$_SESSION['user'];
$zong = $_POST['zong'];
$vip = $_POST['vip'];


if($user != ''){
$query_Recordset1 = "SELECT * FROM web_wan.codepay_zong";
$Recordset1 = mysqli_query($my_conn,$query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
}

$user=$_SESSION['user'];
$jin = $_POST['jin'];
$vip = $_POST['vip'];
$time = $_POST['time'];


if($user != ''){
$query_Recordset2 = "SELECT * FROM web_wan.codepay_jie";
$Recordset2 = mysqli_query($my_conn,$query_Recordset2) or die(mysqli_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
}

$action = $_GET['action'];
if ($action == 'jie') {
	$user=$_GET['user'];
		$sql = "insert into web_wan.codepay_jie(user, zong, vip, time) values('$user',(select jin from web_wan.codepay_zong where user ='{$user}'),(select vip from web_wan.codepay_zong where user ='{$user}'),now())";
	$result = mysqli_query($my_conn,$sql);
		$sq2 = "update web_wan.codepay_zong set `jin`= '0' where user = '$user'";
    $result2 = mysqli_query($my_conn,$sq2);
	 	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
		echo "<script>alert('结算成功');location.href='javascript:history.back()';</script>";	

}

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
<style type="text/css">
.code_img{width:150px;height:170px;background:#0e0d0d; display:1; position: absolute;left: 60%;top: -35%;}
.code_img p{position: relative;top: -18px;text-align: center;color:#ed2042;font-weight: 800;}
.codeth{    width: 270px;padding: 0!important;margin:0!important;line-height: 54px !important; }
</style>
  </head>
  <body>
<div class="content1">
  <div class="page-header">
    <h1 class="title">充值管理</h1>
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="javascript:location.reload();" class="btn btn-light"><i class="fa fa-refresh"></i>刷新</a>
      </div>
    </div>
  </div>
     <div class="col-md-12" id="guolvlb">
      <div class="panel panel-default">
            <div class="panel-body">
              <table class="table display">
                <thead>
                    <tr>
                        <th>代理账号</th>
                        <th>推广总额</th>
                        <th>分成比例</th>
                        <th style="color:red;">应打款</th>
                        <th class="codeth" >查看收款信息</th>
                        <th>是否结算</th>
                    </tr>
                </thead>
 
             
                <tbody>
				
			                                <?php do { ?>
		<?php if($row_Recordset1['id']!='1'&& $row_Recordset1['jin']>0){?>
                    <tr>
						
                                  <th><?php echo $row_Recordset1['user']; ?></th>
                                   <th><?php echo $row_Recordset1['jin']; ?></th>
								  <th><?php echo $row_Recordset1['vip']; ?>%</th>
								 
                                  <th style="color:red;font-weight:800;"><?php echo (($row_Recordset1['jin']*($row_Recordset1['vip'])/100)); ?></th>
								  <?php
									$paycode = "SELECT pay FROM web_wan.codepay_user WHERE user = '{$row_Recordset1['user']}'";
									$paycode = mysqli_query($my_conn,$paycode ) or die(mysqli_error());
									$row_paycode = mysqli_fetch_assoc($paycode);
									echo' <th class="codeth"><a class="codes" tag="'.$row_paycode['pay'].'" href="javascript:void(0)">生成二维码</a></th>';
									//echo'<image class="code_img" style="display:none; position: relative;left: 60%;top: -35%;" src="https://qun.qq.com/qrcode/index?data='.$row_paycode['pay'].'">';
								  ?>
								  
                        <td><a href="pay_adminjie.php?action=jie&user=<?php echo $row_Recordset1['user']; ?>" class="btn btn-option5"><i class="fa fa-gears"></i>结算分成</a>      
						</td>
                    </tr>
					
						<?php }?>
                                  <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
                </tbody>
            </table>
            </div>

      </div>
    </div>
<div class="container-padding">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">

        <div class="panel-body table-responsive">

            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>所属代理</th>
                        <th>已结算总额</th>
                        <th>分成比例</th>
                        <th>已结算分成</th>
						<th>结算时间</th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <th>所属代理</th>
                        <th>已结算总额</th>
                        <th>分成比例</th>
                        <th>已结算分成</th>
						<th>结算时间</th>
                    </tr>
                </tfoot>
             
                <tbody>
				
			                                <?php do { ?>

                    <tr>
                                  <th><?php echo $row_Recordset2['user']; ?></th>
                                  <th><?php echo $row_Recordset2['zong']; ?></th>
								  <th><?php echo $row_Recordset2['vip']; ?>%</th>
                                  <th><?php echo (($row_Recordset2['zong']*($row_Recordset2['vip'])/100)); ?></th>
								  <th><?php echo $row_Recordset2['time'];?></th>
                    </tr>
                                  <?php } while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2)); ?>
                </tbody>
            </table>


        </div>

      </div>
    </div>
  </div>
<?php echo $allrmb; ?>
</div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script src="js/datatables/datatables.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select/bootstrap-select.js"></script>
<script type="text/javascript" src="js/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="js/jeDate/jedate.js"></script>
<script type="text/javascript">

    jeDate({
		dateCell:"#dateinfo",
		format:"YYYY-MM-DD hh:mm:ss",
		isinitVal:true,
		isup_time:true, //isClear:false,
		minDate:"2014-09-19 00:00:00",
		okfun:function(val){}
	});

</script>

<script>
$(document).ready(function() {
    $('#example0').DataTable({
                "order": [[ 0, "desc" ]]
              });
} );
</script>

<script>$(function () {
  $('#guolv').on('click', function () {
      $("#guolvlb").toggle(1000);
  });
});</script>



<script type="text/javascript">
$(document).ready(function(){
  $(".codes").click(function(){
	 var this_X = $(this).offset().left-$(this).scrollTop()+60;
	 var this_Y = $(this).offset().top-$(this).scrollLeft()-255; 
	  var img_url = $(this).attr("tag");
	 $(this).attr("style","color:red")
	$(this).append("<div class='code_img' style='z-index:999999; position: absolute;left: "+this_X+"px;top: "+this_Y+"px;' ><image src='https://qun.qq.com/qrcode/index?data="+img_url+"'><p>支付宝扫码</p></div>")
  });
  $(".codes").mouseout(function(){
   $(".code_img").remove();
   $(this).attr("style","color:#399bff")
  });
});
</script>
</body>
</html>