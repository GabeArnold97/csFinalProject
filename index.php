<?php
   if(isset($_POST['search']))
   {
       $valueToSearch = $_POST['valueToSearch'];
       $query = "SELECT * FROM table_2 WHERE CONCAT(CourseID, CourseName, Days, TimeStart, TimeEnd, Instructor, Room, Units, TotalEnrolled, RoomType) LIKE '%".$valueToSearch."%' AND CourseID != ''";
       $connect = mysqli_connect("localhost", "root", "", "csvimport");
       $search_result = mysqli_query($connect, $query);
       if (!$search_result) {
       printf("Error: %s\n", mysqli_error($connect));
       exit();
       
       }
   }

    elseif(isset($_POST['timesearch'])) {
       $connect = mysqli_connect("localhost", "root", "", "csvimport");
       $time1 = $_POST['time1'];
       $time2 = $_POST['time2'];
       $query = "SELECT * FROM table_2 WHERE CAST(TimeStart AS time) BETWEEN '". mysqli_real_escape_string($connect, $time1)  ."' AND '". mysqli_real_escape_string($connect, $time2)  ."' ORDER BY TimeStart";
       $search_result = mysqli_query($connect, $query);
       if (!$search_result) {
       printf("Error: %s\n", mysqli_error($connect));
       exit();
   }
   }
    else {
       $query = "SELECT * FROM table_2 WHERE CourseID != ''";
       $connect = mysqli_connect("localhost", "root", "", "csvimport");
       $search_result = mysqli_query($connect, $query);
       if (!$search_result) {
       printf("Error: %s\n", mysqli_error($connect));
       exit();
   }
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
         <form action="index.php" method="post">
            <div class="filter">
               <h2>Filter</h2>
               <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
               <input type="submit" name="search" value="Search">
               <a href="http://localhost/csFinalProject/"><button>Clear</button></a><br><br>
            </div>
            <div class="filter">
               <h2>Availability Search</h2>
               <b>Start Time From - To</b><br>
                <select name="time1">
                    <option value="07:00:00">7:00 AM</option>
                    <option value="08:00:00">8:00 AM</option>
                    <option value="09:00:00">9:00 AM</option>
                    <option value="10:00:00">10:00 AM</option>
                    <option value="11:00:00">11:00 AM</option>
                    <option value="12:00:00">12:00 PM</option>
                    <option value="13:00:00">1:00 PM</option>
                    <option value="14:00:00">2:00 PM</option>
                    <option value="15:00:00">3:00 PM</option>
                    <option value="16:00:00">4:00 PM</option>
                    <option value="17:00:00">5:00 PM</option>
                    <option value="18:00:00">6:00 PM</option>
                    <option value="19:00:00">7:00 PM</option>
                    <option value="20:00:00">8:00 PM</option>
                    <option value="21:00:00">9:00 PM</option>
                    <option value="22:00:00">10:00 PM</option>
                </select>
                <select name="time2">
                    <option value="07:00:00">7:00 AM</option>
                    <option value="08:00:00">8:00 AM</option>
                    <option value="09:00:00">9:00 AM</option>
                    <option value="10:00:00">10:00 AM</option>
                    <option value="11:00:00">11:00 AM</option>
                    <option value="12:00:00">12:00 PM</option>
                    <option value="13:00:00">1:00 PM</option>
                    <option value="14:00:00">2:00 PM</option>
                    <option value="15:00:00">3:00 PM</option>
                    <option value="16:00:00">4:00 PM</option>
                    <option value="17:00:00">5:00 PM</option>
                    <option value="18:00:00">6:00 PM</option>
                    <option value="19:00:00">7:00 PM</option>
                    <option value="20:00:00">8:00 PM</option>
                    <option value="21:00:00">9:00 PM</option>
                    <option value="22:00:00">10:00 PM</option>
                </select><br><br>
                <input type="submit" name="timesearch" value="Search">
                <a href="http://localhost/csFinalProject/"><button>Clear</button></a><br><br>
            </div>
            <div class="courseList">
               <h2>Course List</h2>
               <table class="table table-bordered table-hover table-condensed" ; style="border:1px solid black;">
                  <thead>
                     <tr bgcolor="#304566" style="font-weight:bold; color:white">
                        <th title="Field #1" align="left">Course ID</th>
                        <th title="Field #2" align="left">Course Name</th>
                        <th title="Field #3" align="left">Days</th>
                        <th title="Field #4" align="left">Start Time</th>
                        <th title="Field #5" align="left">End Time</th>
                        <th title="Field #6" align="left">Instructor</th>
                        <th title="Field #7" align="left">Room</th>
                        <th title="Field #8" align="left">Units</th>
                        <th title="Field #9" align="left">Enrolled</th>
                        <th title="Field #10" align="left">Classroom Type</th>
                        <th title="Field #11" align="left">EDIT</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr bgcolor="#304566" style="font-weight:bold; color:white">
                        <td colspan="100%">End of Results</td>
                     </tr>
                  </tfoot>
                  <tbody id="table">
                     <?php
                        $num = 1;
                        while ($row = mysqli_fetch_assoc($search_result)) {
                            if ($num % 2) {
                                $rclass = "rowa"; 
                            } else {
                                $rclass = "rowb"; 
                            }
                            echo
                            "<tr class=$rclass>
                                <td>{$row['CourseID']}</td>
                                <td>{$row['CourseName']}</td>
                                <td>{$row['Days']}</td>
                                <td>{$row['TimeStart']}</td>
                                <td>{$row['TimeEnd']}</td>
                                <td>{$row['Instructor']}</td>
                                <td>{$row['Room']}</td>
                                <td>{$row['Units']}</td>
                                <td>{$row['TotalEnrolled']}</td>
                                <td>{$row['RoomType']}</td>
                                <td><a href='edit.php?edit=$num'>edit</a></td>
                            </tr>";
                            $num = $num + 1;
                            }
                            ?>
                  </tbody>
               </table>
            </div>
         </form>
      </div>
   </body>
</html>
<?php mysqli_close($connect); ?>
