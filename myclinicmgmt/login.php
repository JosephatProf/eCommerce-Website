<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Login </title>

  <link rel="stylesheet" href="css/reset.css">

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>
<?php
error_reporting(0);
require_once 'db/db.php';
$user = $_POST['uname'];
$passwd = $_POST['password'];
if (isset($user) && isset($passwd)) {
	//continue with validation
	if (!empty($user) && !empty($passwd)) {
		// $sql = "SELECT username,password FROM users WHERE username= '".$user"'";
		// $res = $db->query($sql);
		$sql="SELECT `user_id` FROM `users` WHERE `username`='".$user."' AND `password`='".$passwd."'";  
			if($sql_run=$db->query($sql)){
				
				while ($row = $sql_run->fetch_assoc()) {
					$user_id = $row['user_id'];

				}
				
			$_SESSION['user_id']=$user_id;
			header('Location: dashboard.php');	
					
			}else{
				echo 'Error';
			}
			}
		}
	// }else{
	// 	echo "<span>All fields are required</span>";
	// }


?>
  <div class="wrap">
		<div class="avatar">
      <img src="images/hosp.jpg">
		</div>
		<form action="" method="post">
		<input name="uname" type="text" placeholder="username" required>
		<div class="bar">
			<i></i>
		</div>
		<input name="password" type="password" placeholder="password" required>
		<!-- <a href="" class="forgot_link">forgot ?</a> -->

		<input type="submit" name="submit" value="Sign In" class="btn btn-primary">
		<br><br><br>
		</form>
		<button><a href="register.php">Sign Up</a></button>
		<!-- <h3><strong>Don't have Account? <a href="register.php">Sign up free!!</a></strong></h3> -->
	</div>

  <script src="js/index.js"></script>

</body>

</html>