
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Clinic admin dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
     <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse ">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only"><!-- Toggle navigation --></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Clinic Management System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
           
            <li><a href="help.php">Help</a></li>
          </ul>
          
          <form class="navbar-form navbar-right" action="" method="post">
            <input type="text" class="form-control" placeholder="Search..." name="search_name">
          </form>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
            <!-- <li><a href="#">Reports</a></li> -->
            <li><a href="booking.php">Add patient</a></li>
            <!-- <li><a href="#">Analysis</a></li> -->
          </ul>
          
        </div>
        <div class="col-sm-9">

          <h1 class="page-header">Dashboard</h1>

          <div class="row">
          <?php
        require_once 'db/db.php';
        if(isset($_POST['search_name']) && !empty($_POST['search_name'])){
            $search_name=$_POST['search_name'];
            if(strlen($search_name)>=2){
            $sql="SELECT * FROM `patients` WHERE `pNo` LIKE  '%".$search_name."%' OR `pfName` LIKE '%".$search_name."%' OR `plName` LIKE '%".$search_name."%'";
            $sql_run=$db->query($sql);
            $sql_num_rows=mysqli_num_rows($sql_run);
            if($sql_num_rows  >= 1){
              while($sql_fetch = $sql_run->fetch_assoc()){
                
                $params[] = array(
                      'id' => $sql_fetch['id'],
                      'pNo' => $sql_fetch['pNo'],
                      'fname' => $sql_fetch['pfName'],
                      'lname' => $sql_fetch['plName'],
                      'clinic' => $sql_fetch['cName'],
                      'date' => $sql_fetch['dateTovisit']
                  );
                ?>
                <div class="table-responsive">
                <table class="table table-striped">
                  <h2 align="center"><bold>Search Results here</bold></h2>
                  <tbody>
                  <?php
                  require_once 'db/db.php';
                    if (@$params == "") {
                  echo '<tr><span style="color:red; font-size:24px; text-align:center;">No records Exist</span></tr>';
              }else{
                foreach($params as $p){
                  // $pId = $v['id'];

                    echo "
                    <tr>

                        <td>".$p['pNo']."</td>
                        <td>".$p['fname']."</td>
                        <td>".$p['lname']."</td>
                        <td>".$p['clinic']."</td>
                        <td>".$p['date']."</td>
                        <td>".'<button class="btn btn-success" ><a href="update.php?id='.$p['id'].'">UPDATE</a></button>'."</td>
                        <td>".'<button class="btn btn-danger"><a href="delete.php?id='.$p['id'].'">DELETE</a></button>'."</td>
                    </tr>
                    ";
                }
              }?>
                  </tbody>
                  </table>
                  </div>
                
                <?php
              }


            }else{
              echo 'No Search results found';
            }
          }else{
            ?>
            <SCRIPT TYPE="text/javascript">
            alert('Input string must be 2 characters and above.');
            </SCRIPT>
            <?php
          }
          }
          ?>

          </div>

          <h2 class="sub-header" align="center">Patient book Details</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Patient No:</th>
                  <th>First Name:</th>
                  <th>Last Name:</th>
                  <th>Clinic </th>
                  <th>Date</th>
                  <th>Update Patient</th>
                  <th>Delete Patient</th>
                </tr>
              </thead>
              <tbody>
                 <?php
              require_once 'db/db.php';
              $sql = "SELECT * FROM patients";
              $result = $db->query($sql);
              while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                  $values[] = array(
                      'id' => $row['id'],
                      'pNo' => $row['pNo'],
                      'fname' => $row['pfName'],
                      'lname' => $row['plName'],
                      'clinic' => $row['cName'],
                      'date' => $row['dateTovisit']
                  );
              }
              if (@$values == "") {
                  echo '<tr><span style="color:red; font-size:24px; text-align:center;">No records Exist</span></tr>';
              }else{
                foreach($values as $v){
                  // $pId = $v['id'];

                    echo "
                    <tr>

                        <td>".$v['pNo']."</td>
                        <td>".$v['fname']."</td>
                        <td>".$v['lname']."</td>
                        <td>".$v['clinic']."</td>
                        <td>".$v['date']."</td>
                        <td>".'<button class="btn btn-success" ><a href="update.php?id='.$v['id'].'">UPDATE</a></button>'."</td>
                        <td>".'<button class="btn btn-danger"><a href="delete.php?id='.$v['id'].'">DELETE</a></button>'."</td>
                    </tr>
                    ";
                }
              }
            
          
              ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

   
  </body>
</html>

