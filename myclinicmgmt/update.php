<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <script type='text/javascript' src='js/jquery.js'></script>
<link href='css/calendar.css' rel='stylesheet' type='text/css'>
    <title>Update Patient</title>
    <script type="text/javascript">
      var getDatee = new Date();
            var monthe = getDatee.getMonth();
            var yeare = getDatee.getFullYear();
            var day = getDatee.getDate(); 
            function isEmpty(val){
               return (val === undefined || val == null || val.length <= 0) ? true : false;
            }
            
            function prev()
            {
              monthe = monthe-1;
                if(monthe < 0)
          {
              yeare = yeare-1;  
                    monthe = 11;
                }
                dispCal(monthe, yeare);
                return false;
            }
            
            function next()
            {
              monthe = monthe+1;
                if(monthe > 11)
          {
              yeare = yeare+1;  
                    monthe = 0;
                }
                dispCal(monthe, yeare);
                return false;
            }
            
            function daysInMonth(monthe, yeare)
            {
                return 32 - new Date(yeare, monthe, 32).getDate();
            }

            function getElementPosition(arrName,arrItem){
                for(var pos=0; pos<arrName.length; pos++ ){
                    if(arrName[pos]==arrItem){
                        return pos;
                    }
                }
            }
            
            function setVal(getDat){
                $('#sel').val(getDat);
                $('#calendar').hide();
            }
            
            function dispCal(mon,yea){
    var ar = new Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
                var chkEmpty = isEmpty(mon);
                var n,days,calendar,startDate,newYea,setvale,i;
                if(chkEmpty != true){
                    mon = mon+1;
                    n = ar[mon-1];
                    n += " "+yea;
                    newYea = yea;
                    days = daysInMonth((mon-1),yea);
                    startDate = new Date(ar[mon-1]+" 1"+","+parseInt(yea));
                }else{
                    mon = getElementPosition(ar,ar[getDatee.getMonth()]);
                    n = ar[getDatee.getMonth()];
                    n += " "+yeare;
                    newYea = yeare;
                    days = daysInMonth(mon,yeare);
                    startDate = new Date(ar[mon]+" 1"+","+parseInt(yeare));
                }
                
                var startDay = startDate.getDay();
                var startDay1 = startDay;
                while(startDay> 0){
                   calendar += "<td></td>";  
                   startDay--;
                }                
                i = 1;
                while (i <= days){
                  if(startDay1 > 6){
                      startDay1 = 0;  
                      calendar += "</tr><tr>";  
                  }  
                  mon = monthe+1;
                  setvale = i+","+n;
      if(i == day && newYea==yeare && mon==monthe){
        calendar +="<td class='thisday' onclick='setVal(\""+i+"-"+mon+"-"+newYea+"\")'>"+i+"</td>";
                  }else{  
                    calendar +="<td class='thismon' onclick='setVal(\""+i+"-"+mon+"-"+newYea+"\")'>"+i+"</td>";   
                  }
      startDay1++;  
                  i++;  
                }
        calendar +="<td><a style='font-size: 9px; color: #efefef; font-family: arial; text-decoration: none;' href='http://www.hscripts.com'>&copy;h</a></td>";   
    
                $('#calendar').css('display','block');
                $('#month').html(n);
                var test = "<tr class='weekdays'><td>Sun</td><td>Mon</td><td>Tue</td><td>Wed</td><td>Thu</td><td>Fri</td><td>Sat</td></tr>";  
                test += calendar;
    $('#dispDays').html(test);
            }
    </script>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        
        <h3 class="text-muted">Clinic management system</h3>
      </div>

      <div class="jumbotron">
        <h1 class="display-3">Update Patient Information</h1>
        <p class="lead">This is my system i developed to capture patient booking details.</p>
        <div class="container">
        <?php
        require_once 'db/db.php';
        error_reporting(0);
        $pNo = $_POST['pNo'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $clinic = $_POST['clinic'];
        $date = $_POST['date'];
          
          $patientId=$_GET['id'];
          
          $sql1 = "SELECT * from patients WHERE id = '$patientId'";
          $result = $db->query($sql1);
          while ($row = $result->fetch_assoc()) {
            $patient = $row['pNo'];
            $pfname = $row['pfName'];
            $plname = $row['plName'];
            $uClinic = $row['cName'];
            $uDate = $row['date'];   
          }
          
            if (isset($_POST['submit'])) {
            if (!empty($pNo) && !empty($fname) && !empty($lname) && !empty($date)) {
            /*if ($pNo == $patient) {
                ?>
              <script type="text/javascript">
                alert('Patient number Entered Already exists!');
              </script>
              <?php
            }else{
            */
            $sql = "UPDATE patients SET pNo = '$pNo',pfName = '$fname',plName = '$lname',cName = '$clinic',dateTovisit='$date' where id = '$patientId'";
              $stmt = $db->query($sql);
              if ($stmt) {
                // $url = 
                ?>
              <script type="text/javascript">
                alert('Data updated succefully!')
                window.location = "dashboard.php";
              </script>
              <?php

              }else{
                ?>
              <script type="text/javascript">
                alert('Ooops!! Error occured please try again')
              </script>
              <?php
              }
              
              }else{
                //execute error message
              }
              }
          
        ?>
      <form class="form-horizontal" action="" method="post">
      <div class="form-group">
        <label class="control-label col-sm-2" for="pNo">Patient No:</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="pNo" placeholder="Enter patient No." name="pNo" value="<?php echo $patient;?>" readonly="readonly">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="fname">First Name:</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="fname" placeholder="Enter patient first name" name="fname" value="<?php echo $pfname;?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="lname">Last Name:</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="lname" placeholder="Enter patient last name" name="lname" value="<?php echo $plname;?>">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="lname">Clinic Name:</label>
      <div class="input-group">
        <select class="form-control" name="clinic">
          <option>Select clinic</option>
          <option>ENT Unit</option>
          <option>Gastro Unit</option>
          <option>Diabetic Clinic</option>
          <option>Radiotherapy</option>
          <option>Orthopedic clinic</option>
        </select>            
        <span class="input-group-btn">
          <button class="btn btn-default" type="button" tabindex="-1"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        </span>
      </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="pname">Date admitted:</label>
        <div class="col-sm-10"> 
          <input type='text' class="form-control" id='sel' onclick='dispCal()' size=10 readonly='readonly' placeholder="1/1/2017" name="date">
          
            <table class='calendar' id='calendar' border=0 cellpadding=0 cellspacing=0>
                <tr class='monthdisp'>
                    <td class='navigate' align='left'><img src='images/previous.png' onclick='return prev()' /></td>
                    <td align='center' id='month'></td>
                    <td class='navigate' align='right'><img src='images/next.png' onclick='return next()' /></td>
                    </tr>
                <tr>
                    <td colspan=3>
                        <table id='dispDays' border=0 cellpadding=4 cellspacing=4>                        
                        </table>                    
                    </td>
                </tr>
            </table>
        </div>
      </div>
      </div>
      <div class="form-group"> 
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>&nbsp&nbsp&nbsp
             <button class="btn btn-default"><a href="dashboard.php">View Patients</a></button>
        </div>
      </div>
    </form>
    </div>

        
      </div>

      
      </div>

      <footer class="footer" align="center">
        <p>&copy; Designed and developed by Florence Gatome</p>
      </footer>

    </div> 
   
  </body>
</html>
