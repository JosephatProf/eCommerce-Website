<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
   <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<?php
require_once 'db/db.php';
error_reporting(0);
$uname = $_POST['name'];
$passwd = $_POST['pass'];
$mail = $_POST['email'];
$passconf = $_POST['conf_pass'];

if(isset($uname) && isset($mail) && isset($passwd) && isset($passconf)){
  //proceed 
    if(!empty($uname) && !empty($mail) && !empty($passwd) && !empty($passconf)){
       //proceed to register user
       //check if password same
       if($passwd == $passconf){
          //proceed
           $sql = "INSERT INTO `users`(`username`, `email`, `bk_details`, `password`) VALUES ('$uname','$mail','','$passwd')";
           if($db->query($sql)){
              echo 'Successfully Registered';
           }else{
              echo 'Error occured';
           }
       }else{
          echo '<script>alert("Please check Your password")</script>';

       }
      
    }else{
        echo '<script>alert("Please enter all your details")</script>';
    }
}
?>
<div class="container">
  <h2>Sign Up for the Clinic booking Now!!</h2>
  <form class="form-horizontal" action="" method="post">
  <div class="form-group">
      <label class="control-label col-sm-2" for="username">Username:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Enter your username" name="name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pass">
      </div>
      </div>
      <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password Confirm:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password again" name="conf_pass">
      </div>
      </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox"> Remember me</label>
        </div>
        <label>You Have an Account? <a href="login.php">Login Here</a></label>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>
