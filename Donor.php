<?php
// Include your connection code here (only once)
include_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitDonor'])) {
     $dName = $_POST['dName'];
     $dEmail = $_POST['dEmail'];
     $dPhone = $_POST['dPhone'];
     $dGroup = $_POST['dGroup'];
     $dHist = $_POST['dHist'];
     $lDOD = $_POST['lDOD'];
     $dGend = $_POST['dGend'];
     $dDOB = $_POST['dDOB'];
 
     if ($conn) {
         $sql = "INSERT INTO Donor (D_Name, D_DoB, D_Gender, D_Blood_Type, D_Email, D_Phone_No, Last_Date_of_Donation, Medical_History) 
                 VALUES ('$dName', '$dDOB', '$dGend', '$dGroup', '$dEmail', '$dPhone', '$lDOD', '$dHist')";
         $result = mysqli_query($conn, $sql);
 
         if ($result) {
             // Data inserted successfully, redirect to Donor_admin.php
             header("Location: Donor_admin.php");
             exit();
         } else {
             echo "Error: " . mysqli_error($conn);
         }
     } else {
         die("Connection failed: " . mysqli_connect_error());
     }
 }

// Close the connection after use
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

     <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title> CASA Database </title>

          <link rel="stylesheet" href="styles.css">

          <script src="https://kit.fontawesome.com/f890b33209.js" crossorigin="anonymous"></script>
          <link rel="stylesheet" href="home-nav.css">
     </head>

     <body>

     <div class="main-container">
          <div class="left-menu">
               <div>
                    <a href = "home.php"><h1 id = "navName"><b>CASA</b></h1></a>
               </div>

               <ul>
                    <li class="sidebar-item"><a class="sidebar-link" href="home.php"><i class="fa-solid fa-house"></i> Home </a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="Donor.php"><i class="fas fa-hand-holding-heart"></i> Donor </a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="Recipient_user.php"><i class="fas fa-procedures"></i> Recipients </a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="transaction.php"><i class="fas fa-ambulance"></i> Transfusions</a>
                    </li>
                    <li class="sidebar-item"><a class="sidebar-link" href="blood_inventory_user.php"><i class="fas fa-vials"></i>
                         Inventory</a></li>
                    <!-- <li class="sidebar-item"><a class="sidebar-link" href="staff.php"><i class="fas fa-user-md"></i> Staff
                         </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="BloodBank_admin.php"><i class="fas fa-clinic-medical"></i> Blood Bank
                    </a></li> -->
               </ul>
          </div>
     </div>



     <div class="leftContainer">
          <div class="add">
               <h1>Add a Donor</h1>
               <form method="POST">
                    <div class="form">
                         <input type="text" placeholder="*Name" name='dName' id="dName" required /><br>
                         <input type="email" placeholder="*Email" name='dEmail' id="dEmail" required /><br>
                         <input type="tel" placeholder="*Phone Number" name='dPhone' id="dPhone" required /><br>
                         <select id="dropdown" name="dGroup" required>
                         <option value="" disabled selected>*Blood Group</option>
                              <option value="A+">A+</option>
                              <option value="A-">A-</option>
                              <option value="B+">B+</option>
                              <option value="B-">B-</option>
                              <option value="O+">O+</option>
                              <option value="O-">O-</option>
                              <option value="AB-">AB-</option>
                              <option value="AB+">AB+</option>
                         </select><br>
                         <select id="dropdown" name="dGend" required>
                              <option value="" disabled selected>*Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                              <option value="Other">Other</option>                   
                         </select><br>
                         <label for="inp">D.O.B.</label>
                         <input type="date" name='dDOB' id="dDOB" required /><br>
                         <input type="text" placeholder="Medical History" name='dHist' id="dHist" /><br>
                         <label for="inp">Last Date Of Donation</label>
                         <input type = "date" placeholder = "Last Donation Date" name = 'lDOD'/><br>
                         <input type="submit" name='submitDonor' class="submitBtn" />
                    </div>
               </form>
          </div>
     </div>


               
          <div class = "rightContainer">
               <div class = "search">
                    <h1>Search Donors</h1>
                    <form method = "POST">
                         <div class = "form" id = "searchInput">
                              <input type = "text" placeholder = "Donor ID" name = "D_ID" id = "D_ID" />

                              <input type = "text" placeholder = "Donor Name" name = "D_Name" id = "D_Name" />

                              <input type = "Submit" name = "searchDonor" class = "submitBtn" />
                              
                         </div>

                         <div class = "searchRes">
                              <?php
                                   $conn = mysqli_connect('localhost:3306', 'root', 'Nisha@12345', 'BloodBank');

                                   if (isset($_POST['searchDonor']))
                                   {
                                        $D_ID = $_POST["D_ID"];
                                        $D_Name = $_POST["D_Name"];

                                        if (!$D_ID && !$D_Name)
                                        {
                                             $msg = "You must enter at least one field.";
                                             echo $msg;
                                        }
                                        
                                        else
                                        {
                                             $conditions = array();

                                             if ($D_ID)
                                             {
                                                  $conditions[] = "D_ID = '$D_ID'";
                                             }

                                             if ($D_Name)
                                             {
                                                  $conditions[] = "D_Name LIKE BINARY '%$D_Name%'";
                                             }

                                             $conditionString = implode(" AND ", $conditions);

                                             $query = "SELECT * FROM Donor WHERE $conditionString";
                                             $result = $conn->query($query);

                                             if (mysqli_num_rows($result) == 0)
                                             {
                                                  echo "No matching records found.";
                                             }
                                             
                                             else
                                             {
                                                  echo '<br><br>';
                                                  echo '<table border = "1">' . "\n";
                                                  echo '<tr><td>';
                                                  echo 'Donor ID';
                                                  echo '</td><td>';
                                                  echo 'Name';
                                                  echo '</td><td>';
                                                  echo 'DOB';
                                                  echo '</td><td>';
                                                  echo 'Gender';
                                                  echo '</td><td>';
                                                  echo 'Blood Type';
                                                  echo '</td><td>';
                                                  echo 'Email';
                                                  echo '</td><td>';
                                                  echo 'Phone No';
                                                  echo '</td><td>';
                                                  echo 'Last Date of Donation';
                                                  echo '</td><td>';
                                                  echo 'Medical History';
                                                  echo '</td></tr>';

                                                  while ($row = $result->fetch_assoc())
                                                  {
                                                       echo "<tr><td>";
                                                       echo $row['D_ID'];
                                                       echo "</td><td>";
                                                       echo $row['D_Name'];
                                                       echo "</td><td>";
                                                       echo $row['D_DoB'];
                                                       echo "</td><td>";
                                                       echo $row['D_Gender'];
                                                       echo "</td><td>";
                                                       echo $row['D_Blood_Type'];
                                                       echo "</td><td>";
                                                       echo $row['D_Email'];
                                                       echo "</td><td>";
                                                       echo $row['D_Phone_No'];
                                                       echo "</td><td>";
                                                       echo $row['Last_Date_of_Donation'];
                                                       echo "</td><td>";
                                                       echo $row['Medical_History'];
                                                       echo "</td></tr>";
                                                  }

                                                  echo "</table>\n";
                                             }

                                             $result->free();
                                        }
                                   }
                              ?>
                         </div>
                    </form>
               </div>

               <div class = "view">
                    <h1>All Donors</h1><br>
                    <?php
                         $conn = mysqli_connect('localhost:3306', 'root', 'Nisha@12345', 'BloodBank');
                         
                         $query = "SELECT * FROM Donor";
                         
                         if ($result = $conn->query($query))
                         {
                              echo '<table border = "1">'."\n";
                              echo '<tr><td>';
                              echo 'Donor ID';
                              echo '</td><td>';
                              echo 'Name';
                              echo '</td><td>';
                              echo 'DOB';
                              echo '</td><td>';
                              echo 'Gender';
                              echo '</td><td>';
                              echo 'Blood Type';
                              echo '</td><td>';
                              echo 'Email';
                              echo '</td><td>';
                              echo 'Phone No';
                              echo '</td><td>';
                              echo 'Last Date of Donation';
                              echo '</td><td>';
                              echo 'Medical History';
                              echo '</td></tr>';

                              while ($row = $result->fetch_assoc())
                              {
                                   echo "<tr><td>";
                                   echo $row['D_ID'];
                                   echo "</td><td>";
                                   echo $row['D_Name'];
                                   echo "</td><td>";
                                   echo $row['D_DoB'];
                                   echo "</td><td>";
                                   echo $row['D_Gender'];
                                   echo "</td><td>";
                                   echo $row['D_Blood_Type'];
                                   echo "</td><td>";
                                   echo $row['D_Email'];
                                   echo "</td><td>";
                                   echo $row['D_Phone_No'];
                                   echo "</td><td>";
                                   echo $row['Last_Date_of_Donation'];
                                   echo "</td><td>";
                                   echo $row['Medical_History'];
                                   echo "</td></tr>";
                              }

                              echo "</table>\n";
                         
                         /*freeresultset*/
                         $result->free();
                         }
                    ?>
               </div>
          </div>
     </body>
</html>