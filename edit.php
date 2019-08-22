<?php
 $connect = mysqli_connect("localhost", "root", "", "csvimport")
    or die("Unable to connect");
 $rownum = $_GET['edit'];
 $query = "SELECT * FROM table_2 WHERE CourseID IS NOT NULL AND RowNum = '$rownum'";
 $search_result = mysqli_query($connect, $query);
 $row = mysqli_fetch_array($search_result, MYSQLI_NUM);
 if(isset($_POST['update']))
   {
       $newID = $_POST['cid'];
       $newName = $_POST['cname'];
       $newDays = $_POST['days'];
       $newStartTime = $_POST['stime'];
       $newEndTime = $_POST['etime'];
       $newInstructor = $_POST['instructor'];
       $newRoom = $_POST['room'];
       $newUnits = $_POST['units'];
       $newEnrolled = $_POST['enrolled'];
       $newClassType = $_POST['classtype'];
       $newRowNum = $_POST['rownum'];
       $query = "UPDATE table_2 SET CourseID='$newID', CourseName='$newName', Days='$newDays', TimeStart='$newStartTime', TimeEnd='$newEndTime', Instructor='$newInstructor', Room='$newRoom', Units='$newUnits', TotalEnrolled='$newEnrolled', RoomType='$newClassType' WHERE RowNum='$newRowNum'";
       $res = mysqli_query($connect, $query);
       
   }
 ?>
 <!DOCTYPE html>
 <html lang="en">

  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="script.js"></script>
  </head>

  <body>

    <div class="header">
      <h1>Jessup Classroom Helper</h1>
    </div>

    <div class="navbar">
      <a href="http://localhost/csFinalProject/">Helper Home</a>
      <a href="https://jessup.edu/">Jessup Home</a>
      <a href="https://my.jessup.edu">My Jessup</a>
      <a href="https://faculty.jessup.edu/login.asp">Faculty Portal</a>
    </div>

    <div class="row">
      <div class="filter">
        <form action="index.php" method="POST">
        <h2>Course ID</h2>
        <input type="text" name="cid" value="<?php echo $row[0]; ?>"/>
        <h2>Course Name</h2>
        <input type="text" name="cname" value="<?php echo $row[1]; ?>"/>
        <h2>Days</h2>
        <input type="text" name="days" value="<?php echo $row[2]; ?>"/>
        <h2>Start Time</h2>
        <input type="text" name="stime" value="<?php echo $row[3]; ?>"/>
        <h2>End Time</h2>
        <input type="text" name="etime" value="<?php echo $row[4]; ?>"/>
        <h2>Instructor</h2>
        <input type="text" name="instructor" value="<?php echo $row[5]; ?>"/>
        <h2>Room</h2>
        <input type="text" name="room" value="<?php echo $row[6]; ?>"/>
        <h2>Units</h2>
        <input type="text" name="units" value="<?php echo $row[7]; ?>"/>
        <h2>Total Enrolled</h2>
        <input type="text" name="enrolled" value="<?php echo $row[8]; ?>"/>
        <h2>Classroom Type</h2>
        <input type="text" name="classtype" value="<?php echo $row[9]; ?>"/>
        <br><br>
        <input type="submit" name="update" value="Update"/>
        </form>
      </div>
    </div>
 </body>
</html>

<?php mysqli_close($connect); ?>
