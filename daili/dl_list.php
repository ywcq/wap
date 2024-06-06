<?php require_once('../conn.php'); 
loggedIn();
@$user = htmlspecialchars($_POST['user']);
if ($_POST['go']=='report') {
@$user = htmlspecialchars($_POST['user']);
@$agent = "$user";
$sql = "SELECT COUNT(*) FROM account.normal  where agent='{$user}'";
$res = mysqli_query($my_conn, $sql);
$res  = mysqli_fetch_array($res );
$count=$res['0'];
									
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
    <h1 class="title">用户管理</h1>
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="javascript:location.reload();" class="btn btn-light"><i class="fa fa-refresh"></i>刷新</a>
      </div>
    </div>
  </div>
    <div class="col-md-12" id="guolvlb">
      <div class="panel panel-default">
            <div class="panel-body">
		<form action="" method="post" name="myform"  class="form-inline">
                <div class="form-group">
                  <label for="example1" class="form-label">代理查询： </label>
			<select name="user"  size="1" class="selectpicker">
				  
                            <option value ="" >请选择代理</option>
			 <?php 
				$sql = "select * from web_wan.codepay_user";
				$result = mysqli_query( $my_conn,$sql );
				while($rows=mysqli_fetch_array($result)){   
				?>
				<option  value="<?php echo $rows['user']; ?>"><?php echo $rows['user']; ?></option>
			  <?php } ?>
                      </select>    
                </div>    

                <div class="form-group">
		<input type="hidden" value="report" name="go" class="form-control" /> 
                </div>				
			<button type="submit" class="btn btn-default" value="查询" >查询</button>

              </form>
            </div>

      </div>
    </div>
<div class="container-padding">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
	<label>查询总人数：<span class="font_red"><span><?php echo $count ?> 人</span></label>

        <div class="panel-body table-responsive">

            <table id="example0" class="table display">
                <thead>
                    <tr>
                        <th>用户名</th>
                        <th>密码</th>
                        <th>注册时间</th>
                        <th>最后登陆</th>
                        <th>pt_id</th>
                        <th>密保</th>
                        <th>所属代理</th>
                        <th>操作</th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <th>用户名</th>
                        <th>密码</th>
                        <th>注册时间</th>
                        <th>最后登陆</th>
                        <th>pt_id</th>
                        <th>密保</th>
                        <th>所属代理</th>
                        <th>操作</th>
                    </tr>
                </tfoot>
             
                <tbody>
				
	<?php


		if ($_POST['go']=='report') {
	            $user = htmlspecialchars($_POST['user']);
	       @$agent = "$user";

		
$sql = "SELECT * FROM account.normal  where agent='{$user}'";
									$res = mysqli_query($my_conn, $sql);
									$count=count($res );
									

while ( $v = $res->fetch_array() ) {

	?>  
                    <tr>
    <td><?php echo $v['uid'] ?></td>
	<td><?php echo $v['password'] ?></td>
    <td><?php echo $v['create_time'] ?></td>
	<td><?php echo $v['login_time'] ?></td>
	<td><?php echo $v['pt_id'] ?></td>
	<td><?php echo $v['safecode'] ?></td>
	<td><?php echo $v['agent'] ?></td>
	<td><a href="user_edit.php?normal_id=<?php echo $v['uid'] ?>" class="btn btn-option5"><i class="fa fa-user"></i><span>编辑</span></a></td>
                    </tr>
		<?php }} ?> 
                </tbody>
            </table>


        </div>

      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script src="js/datatables/datatables.min.js"></script>
<script type="text/javascript" src="js/bootstrap-select/bootstrap-select.js"></script>
<script type="text/javascript" src="js/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="js/moment/moment.min.js"></script>
<script type="text/javascript" src="js/date-range-picker/daterangepicker.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#date-range-picker').daterangepicker(null, function(start, end, label) {
    console.log(start.toISOString(), end.toISOString(), label);
  });
});
</script>

<!-- Basic Single Date Picker -->
<script type="text/javascript">
$(document).ready(function() {
  $('#date-picker').daterangepicker({ singleDatePicker: true }, function(start, end, label) {
    console.log(start.toISOString(), end.toISOString(), label);
  });
});
</script>

<!-- Date Range and Time Picker -->
<script type="text/javascript">
$(document).ready(function() {
  $('#date-range-and-time-picker').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    format: 'YYYY-MM-DD hh:mm'
  }, function(start, end, label) {
    console.log(start.toISOString(), end.toISOString(), label);
  });
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