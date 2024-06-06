<?php require_once('../conn.php'); 
  $user=$_SESSION['user'];

$my = "SELECT id FROM web_wan.codepay_user WHERE user = '{$user}'";
$my = mysqli_query($my_conn,$my) or die(mysql_error());
$row_my = mysqli_fetch_assoc($my);
$normal_id = $_GET['normal_id'];
$password = $_GET['password'];
$agent = $_GET['agent'];



$sql = "SELECT * FROM account.normal   WHERE uid='{$normal_id}'";
$res = mysqli_query($my_conn, $sql);


$num=count($res );



if ($_POST["user_add"] == "go") 
{    

 exit( "<script>alert('免费版,功能有限。');javascript:history.go(-1)</script>");

}


while ( $v = $res->fetch_array() ) {

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
  <div class="page-header">
    <h1 class="title">用户信息</h1>
    <div class="right">
      <div class="btn-group" role="group" aria-label="...">
        <a href="user_list.php" class="btn btn-light">返回列表</a>
        <a href="javascript:location.reload();" class="btn btn-light"><i class="fa fa-refresh"></i>刷新</a>
      </div>
    </div>
  </div>
            <div class="panel-body">
              
                <div role="tabpanel">
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home10">
     <div class="panel panel-default">
            <div class="panel-body">
              <form class="form-horizontal" method="post" action="">
			  <INPUT type="hidden" value="<?php echo $normal_id ?>" name="normal_id">
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">用户名</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="normal_id" value="<?php echo $v['uid'] ?>" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">密码</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="password" value="<?php echo $v['password'] ?>">
                  </div>
                </div>	
              
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">注册时间</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="create_time" value="<?php echo $v['create_time'] ?>" disabled>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">最后登陆</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="login_time" value="<?php echo $v['login_time'] ?>" disabled>
                  </div>
                </div>			

                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">pt_id</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="pt_id"  value="<?php echo $v['pt_id'] ?>" disabled>
                  </div>
                </div>					
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">密保</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control"  name="safecode"  value="<?php echo $v['safecode'] ?>" disabled>
					 <span class="col-sm-3 help-label"></span>
                  </div>
                </div>	
                <div class="form-group">
                  <label class="col-sm-2 control-label form-label">所属代理</label>
                  <div class="col-sm-10">
				  <?php
				  if($row_my['id']=='1'){
					  echo' <input type="text" class="form-control" name="agent"   value="'.$v['agent'].'" >';
				  }else{
					   echo'<p disabled class="form-control">'.$v['agent'].'</p>';
				  }
				  ?>
                   
					 <span class="col-sm-3 help-label"></span>
                  </div>
                </div>	
              			
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
 					<input class="btn btn-default" type="submit" name="user_add" value="go" />

                  </div>
                </div>


              </form>
<?php
}

?>
            </div>

    </div>          
                    </div>

                  </div>

                </div>              

            </div>

</div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>

</body>
</html>