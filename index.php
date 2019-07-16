<?php
   if(isset($_POST['search']))
   {
       $valueToSearch = $_POST['valueToSearch'];
       $query = "SELECT * FROM table_1 WHERE CONCAT(Course_ID, Course_Name, Days, Times, Instructor, Room, Units, Seats, Enrolled, Available) LIKE '%".$valueToSearch."%'";
       $connect = mysqli_connect("localhost", "root", "", "csvimport");
       $search_result = mysqli_query($connect, $query);
       if (!$search_result) {
       printf("Error: %s\n", mysqli_error($connect));
       exit();
       
       }
   }
    else {
       $query = "SELECT * FROM table_1";
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
            <!--<div class="filter">
               <h2>Availability Search</h2>
               <input type="text" id="search" placeholder="Type to search">
               </div>-->
            <div class="courseList">
               <h2>Course List</h2>
               <table class="table table-bordered table-hover table-condensed" ; style="border:1px solid black;">
                  <thead>
                     <tr bgcolor="#304566" style="font-weight:bold; color:white">
                        <th title="Field #1" align="left">Course ID</th>
                        <th title="Field #2" align="left">Course Name</th>
                        <th title="Field #3" align="left">Days</th>
                        <th title="Field #4" align="left">Times</th>
                        <th title="Field #5" align="left">Instructor</th>
                        <th title="Field #6" align="left">Room</th>
                        <th title="Field #7" align="left">Units</th>
                        <th title="Field #8" align="left">Seats</th>
                        <th title="Field #9" align="left">Enrolled</th>
                        <th title="Field #10" align="left">Available</th>
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
                                <td>{$row['Course_ID']}</td>
                                <td>{$row['Course_Name']}</td>
                                <td>{$row['Days']}</td>
                                <td>{$row['Times']}</td>
                                <td>{$row['Instructor']}</td>
                                <td>{$row['Room']}</td>
                                <td>{$row['Units']}</td>
                                <td>{$row['Seats']}</td>
                                <td>{$row['Enrolled']}</td>
                                <td>{$row['Available']}</td>
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