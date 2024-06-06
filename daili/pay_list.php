<?php require_once('../conn.php'); 
loggedIn();

$my = "SELECT id FROM web_wan.codepay_user WHERE user = '{$user}'";
$my = mysqli_query($my_conn,$my ) or die(mysqli_error());
$row_my = mysqli_fetch_assoc($my);

?>
<?php

@$param = $_POST['param'];
@$order = $_POST['order'];
@$pay_tag = $_POST['pay_tag'];


if($param != ''){
$query_Recordset1 = "SELECT * FROM web_wan.codepay_order WHERE `pay_id` LIKE '%{$param}%'";
$Recordset1 = mysqli_query($my_conn,$query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
}elseif($order != ''){
$query_Recordset1 = "SELECT * FROM web_wan.codepay_order WHERE `pay_no` LIKE '%{$order}%'";
$Recordset1 = mysqli_query($my_conn,$query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);	
}elseif($pay_tag != ''){
$query_Recordset1 = "SELECT * FROM web_wan.codepay_order WHERE `pay_tag` LIKE '%{$pay_tag}%'";
$Recordset1 = mysqli_query($my_conn,$query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
}else{
$query_Recordset1 = "SELECT * FROM web_wan.codepay_order where `pay_id` LIKE '%{$param}%' ";
$Recordset1 = mysqli_query($my_conn,$query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
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
               
			   <!--div class="form-group">
				<form method="post" action="pay_list.php">
                        <input type="text"  placeholder="角色ID关键字" name="param"/>
					<input  type="submit" name="button" id="button" value="搜索">
                    </form>
                    <form  method="post" action="pay_list.php">
                        <input type="text"  placeholder="流水号关键字" name="order"/>
					<input  type="submit" name="button" id="button" value="搜索">
                    </form>					
                    <form  method="post" action="pay_list.php">
                        <input type="text"  placeholder="代理账号" name="pay_tag"/>
					<input  type="submit" name="button" id="button" value="搜索">
                    </form>	        </div-->
              
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
                        <th>充值时间</th>
                        <th>用户账号</th>
                        <th>充值金额</th>
                        <th>订单号</th>
						<th>所属代理</th>
						<th>区服</th>
                        <th>状态</th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <th>充值时间</th>
                        <th>用户账号</th>
                        <th>充值金额</th>
                        <th>订单号</th>
						<th>所属代理</th>
						<th>区服</th>
                        <th>状态</th>
                    </tr>
                </tfoot>
             
                <tbody>
				
			                                <?php do { ?>
<?php 
if($row_Recordset1['pay_tag']=="$user"||$row_my['id'] ==='1'){
?>
                    <tr>
                                  <th><?php echo $row_Recordset1['up_time']; ?></th>
								  <th><?php echo iconv("gbk//TRANSLIT","UTF-8",$row_Recordset1['pay_id']); ?></th>
                                   <th><?php echo $row_Recordset1['money']; ?></th>
								  <th><?php echo $row_Recordset1['pay_no']; ?></th>
                   <th><?php echo $row_Recordset1['pay_tag'];?></th>
                                  <th><?php echo $row_Recordset1['param'];?>区</th>
								  <th><?php echo $row_Recordset1['status']; ?></th>
                    </tr>
					<?php }?>
                                  <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
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
</body>
</html>