<?php require_once('../conn.php');
loggedIn();

 ?>

<?php

$query_Recordset1 = "SELECT * FROM web_wan.codepay_user";
$Recordset1 = mysqli_query($my_conn,$query_Recordset1 ) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
$pay_id = $_POST['pay_id'];
if($pay_id != ''){
	$query_Recordset1 = "SELECT * FROM web_wan.codepay_user WHERE `user` LIKE '%{$pay_id}%'";
	$Recordset1 = mysqli_query($my_conn,$query_Recordset1) or die(mysqli_error());
	$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysqli_num_rows($Recordset1);	
}

//删除代理
$action = $_GET['action'];
if ($action == 'del_game') 
{
	$id = stripslashes(trim($_POST['id']));
	$id = $_GET['id'];
	$sql = "delete from web_wan.codepay_user where id = $id";
	$result = mysqli_query($my_conn,$sql);
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
	echo "<script>alert('删除成功');location.href='daili_list.php';</script>";
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
									<th>代理名</th>
                                    <th>上级代理</th>
                                    <th>今日充值</th>
                                    <th>昨日充值</th>
                                    <th>总充值量</th>
                                    <th>收款账号</th>
                                    <th>收款姓名</th>
                                    <th>收款人QQ</th>
									<th>注册人数</th>
									<th>今日注册</th>
									<th>分成比例</th>

                    </tr>
                </thead>

             
                <tbody>
				
			                                <?php do { ?>
		<?php if($row_Recordset1['id']!='1'){?>
		
                    <tr>
                                <th><?php echo $row_Recordset1['user'];?></th>
								<th><?php echo $row_Recordset1['group']; ?></th>
                                <th>
                                    <?php
									$user=$row_Recordset1['user'];

									date_default_timezone_set('PRC'); 
									$jt=date("Y-m-d");

									$time = time();
									$sql = "SELECT SUM(money) FROM web_wan.codepay_order WHERE up_time LIKE '%$jt%' AND pay_tag LIKE '{$user}'";
									$row0 = mysqli_fetch_array( mysqli_query($my_conn,$sql) );
									echo $row0[0]?$row0[0]:0;?> |
									<?php echo (($row0[0]?$row0[0]:0)*($row_Recordset1['vip'])/100) ?>
								</th>
                                <th>
                                    <?php
									$user=$row_Recordset1['user'];
									date_default_timezone_set('PRC'); 
									$sql = "SELECT SUM(money) FROM web_wan.codepay_order WHERE up_time < curdate() and up_time >= date_sub(curdate(),INTERVAL 1 DAY) and pay_tag='{$user}'";
									$row1 = mysqli_fetch_array( mysqli_query($my_conn,$sql) );
									echo $row1[0]?$row1[0]:0;?> |
									<?php echo (($row1[0]?$row1[0]:0)*($row_Recordset1['vip'])/100) ?>
									</th>
                                  <th>  
								  <?php
								  $user=$row_Recordset1['user'];
									date_default_timezone_set('PRC'); 
									
									$sql = "SELECT sum(money) FROM web_wan.codepay_order WHERE pay_tag LIKE '$user'";
									$row4 = mysqli_fetch_array( mysqli_query($my_conn,$sql) );
									echo $row4[0]?$row4[0]:0;?> |
									<?php echo (($row4[0]?$row4[0]:0)*($row_Recordset1['vip'])/100) ?>
									</th>
						<th><?php echo iconv("gbk//TRANSLIT","UTF-8",$row_Recordset1['zf']); ?>  <?php echo $row_Recordset1['pay']; ?></th>
								  <th><?php echo iconv("gbk//TRANSLIT","UTF-8",$row_Recordset1['name']); ?></th>
						<th><?php echo $row_Recordset1['qq']; ?></th>
						<th><?php 
									
									$sql = "SELECT * FROM account.normal  where agent='{$user}'";
									$res = mysqli_query($my_conn, $sql);
									$count=count($res );
									echo $count;
							?></th>
						<th><?php 
							@$today = strtotime(date("Y-m-d")." 00:00:00");
							$js = 0;
							foreach($res as $k=>$v){
								@$sj = strtotime($v['create_time']);
								if($sj>=$today){
									$js++;
								}
							}
							echo $js;
						?></th>
						<th><?php echo $row_Recordset1['vip']; ?>%</th>

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
<?php
mysqli_free_result($Recordset1);
?>
