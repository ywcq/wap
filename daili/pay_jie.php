<?php require_once('../conn.php'); 
loggedIn();
?>
<?php
$user=$_SESSION['user'];
$zong = $_POST['zong'];
$vip = $_POST['vip'];


if($user != ''){
$query_Recordset1 = "SELECT * FROM web_wan.codepay_zong";
$Recordset1 = mysqli_query( $my_conn,$query_Recordset1) or die(mysqli_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
}

$user=$_SESSION['user'];
$jin = $_POST['jin'];
$vip = $_POST['vip'];
$time = $_POST['time'];


if($user != ''){
$query_Recordset2 = "SELECT * FROM web_wan.codepay_jie";
$Recordset2 = mysqli_query( $my_conn,$query_Recordset2) or die(mysqli_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
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
	<?php 
		if($row_Recordset2['user']=="$user"){
	?>
                    <tr>
                                  <th><?php echo $row_Recordset2['user']; ?></th>
                                  <th><?php echo $row_Recordset2['zong']; ?></th>
								  <th><?php echo $row_Recordset2['vip']; ?>%</th>
                                  <th><?php echo (($row_Recordset2['zong']*($row_Recordset2['vip'])/100)); ?></th>
								  <th><?php echo $row_Recordset2['time'];?></th>
                    </tr>
		<?php }?>   
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
</body>
</html>