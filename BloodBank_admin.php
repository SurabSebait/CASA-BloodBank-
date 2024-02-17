<?php 
    require_once "pdo.php";
    session_start();
?>

<?php 
    if( isset($_POST['Bank_id']) && isset($_POST['delete'])){
        $sql = "DELETE FROM blood_bank WHERE Bank_ID = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':zip' => $_POST['Bank_id']
        ));
    }
?>

<?php
     include_once 'connection.php';
                              
     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitBank']))
     {
          $bName = $_POST['bName'];
          $bEmail = $_POST['bEmail'];
          $bPhone = $_POST['bPhone'];
          $bLoc = $_POST['bLoc'];

          if ($conn)
          {
               $sql = "INSERT INTO Blood_Bank (Bank_Name, Location, Bank_Email, Bank_Phone_No)
                         VALUES ('$bName', '$bLoc', '$bEmail', '$bPhone')";
               
               $result = mysqli_query($conn, $sql);

               if ($result)
               {
                    echo "Data inserted successfully.";
                    header("Location: BloodBank.php"); 
                    exit();
               }

               else
               {
                    echo "Error: " . mysqli_error($conn);
                    header("Location: BloodBank.php");
                    exit();
               }

               mysqli_close($conn);
          }

          else
          {
               die("Connection failed: " . mysqli_connect_error());
          }
     }
?>

<!DOCTYPE html>
<html lang = "en">
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
                         <a href = "home_admin.php"><h1 id = "navName"><b>CASA</b></h1></a>
                    </div>

                    <ul>
                         <li class="sidebar-item"><a class="sidebar-link" href="home_admin.php"><i class="fa-solid fa-house"></i> Home </a>
                         </li>
                         <li class="sidebar-item"><a class="sidebar-link" href="Donor_admin.php"><i class="fas fa-hand-holding-heart"></i> Donor </a>
                         </li>
                         <li class="sidebar-item"><a class="sidebar-link" href="Recipient_admin.php"><i class="fas fa-procedures"></i> Recipients </a>
                         </li>
                         <li class="sidebar-item"><a class="sidebar-link" href="transaction_admin.php"><i class="fas fa-ambulance"></i> Transfusions</a>
                         </li>
                         <li class="sidebar-item"><a class="sidebar-link" href="blood_inventory_admin.php"><i class="fas fa-vials"></i>
                              Inventory</a></li>
                         <li class="sidebar-item"><a class="sidebar-link" href="staff.php"><i class="fas fa-user-md"></i> Staff
                              </a></li>
                         <li class="sidebar-item"><a class="sidebar-link" href="BloodBank.php"><i class="fas fa-user-md"></i> Blood Bank
                         </a></li>
                    </ul>
               </div>
          </div>

          <div class = "leftContainer">
               <div class = "add">
                    <h1>Add a Blood Bank</h1>
                    <form method = "POST">
                    <div class = "form">
                              <input type = "text" placeholder = "Name" name = 'bName' id = "bName" required /><br><br>

                              <input type = "email" placeholder = "Email" name = 'bEmail' id = "bEmail" required /><br><br>

                              <input type = "tel" placeholder = "Phone Number" name = 'bPhone' id = "bPhone" required /><br><br>

                              <input type = "text" placeholder = "Location" name = 'bLoc' id = "bLoc" required /><br><br>

                              <input type = "submit" name = 'submitBank' class = "submitBtn" />

                         </div>
                    </form>
               </div>
          </div>



          <div class = "rightContainer">     
               <div class = "search">
                    <h1>Search Blood Banks</h1>
                    <form method = "POST">
                         <div class = "form" id = "searchInput">
                              <input type = "text" placeholder = "Blood Bank ID" name = "Bank_ID" id = "Bank_ID" /><br><br>

                              <input type = "text" placeholder = "Bank Name" name = "Bank_Name" id = "Bank_Name" /><br><br>

                              <input type = "Submit" name = "searchBank" class = "submitBtn" /><br><br>
                         </div>

                         <div class = "searchRes">
                              <?php
                                   $conn = mysqli_connect('localhost:3307', 'root', 'root', 'BloodBank');

                                   if (isset($_POST['searchBank']))
                                   {
                                        $Bank_ID = $_POST["Bank_ID"];
                                        $Bank_Name = $_POST["Bank_Name"];

                                        if (!$Bank_ID && !$Bank_Name)
                                        {
                                             $msg = "You must enter at least one field.";
                                             echo $msg;
                                        }
                                        
                                        else
                                        {
                                             $conditions = array();

                                             if ($Bank_ID)
                                             {
                                                  $conditions[] = "Bank_ID = '$Bank_ID'";
                                             }

                                             if ($Bank_Name)
                                             {
                                                  $conditions[] = "Bank_Name LIKE BINARY '%$Bank_Name%'";
                                             }

                                             $conditionString = implode(" AND ", $conditions);

                                             $query = "SELECT * FROM Blood_Bank WHERE $conditionString";
                                             $result = $conn->query($query);

                                             if (mysqli_num_rows($result) == 0)
                                             {
                                                  echo "No matching records found.";
                                             }
                                             
                                             else
                                             {
                                                  echo '<table border = "1">'."\n";
                                                  echo '<tr><td>';
                                                  echo 'Bank ID';
                                                  echo '</td><td>';
                                                  echo 'Name';
                                                  echo '</td><td>';
                                                  echo 'Location';
                                                  echo '</td><td>';
                                                  echo 'Email';
                                                  echo '</td><td>';
                                                  echo 'Phone No';
                                                  echo '</td><td>';
                                                  echo 'Manager ID';
                                                  echo '</td><td>';
                                                  echo 'Update opt.';
                                                  echo '</td><td>';
                                                  echo 'Delete opt.';
                                                  echo '</td></tr>';

                                                  while ($row = $result->fetch_assoc())
                                                  {
                                                       echo "<tr><td>";
                                                       echo $row['Bank_ID'];
                                                       echo "</td><td>";
                                                       echo $row['Bank_Name'];
                                                       echo "</td><td>";
                                                       echo $row['Location'];
                                                       echo "</td><td>";
                                                       echo $row['Bank_Email'];
                                                       echo "</td><td>";
                                                       echo $row['Bank_Phone_No'];
                                                       echo "</td><td>";
                                                       echo $row['Mgr_ID'];
                                                       echo "</td><td>";
                                                       echo ('<a href="BloodBank_update.php?Bank_ID='.$row['Bank_ID'].'">Edit</a>');
                                                       echo "</td><td>";
                                                       
                                                       echo ('<form method = "POST">');
                                                       echo ('<input type="hidden" name="Bank_id" value="'.$row['Bank_ID'].'">'."\n");
                                                       echo ('<input type="submit" name= "delete" value="Delete" class ="deleteBtn">');
                                                       echo ('</form>');
                                                  
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
                    <h1>All Blood Banks</h1>
                    <?php
                         $conn = mysqli_connect('localhost:3307', 'root', 'root', 'BloodBank');
                         
                         $query = "SELECT * FROM Blood_Bank";
                         
                         if ($result = $conn->query($query))
                         {
                              echo '<table border = "1">'."\n";
                              echo '<tr><td>';
                              echo 'Bank ID';
                              echo '</td><td>';
                              echo 'Name';
                              echo '</td><td>';
                              echo 'Location';
                              echo '</td><td>';
                              echo 'Email';
                              echo '</td><td>';
                              echo 'Phone No';
                              echo '</td><td>';
                              echo 'Manager ID';
                              echo '</td><td>';
                              echo 'Update opt.';
                              echo '</td><td>';
                              echo 'Delete opt.';
                              echo '</td></tr>';

                              while ($row = $result->fetch_assoc())
                              {
                                   echo "<tr><td>";
                                   echo $row['Bank_ID'];
                                   echo "</td><td>";
                                   echo $row['Bank_Name'];
                                   echo "</td><td>";
                                   echo $row['Location'];
                                   echo "</td><td>";
                                   echo $row['Bank_Email'];
                                   echo "</td><td>";
                                   echo $row['Bank_Phone_No'];
                                   echo "</td><td>";
                                   echo $row['Mgr_ID'];
                                   echo "</td><td>";
                                   echo ('<a href="BloodBank_update.php?Bank_ID='.$row['Bank_ID'].'">Edit</a>');
                                   echo "</td><td>";
                                   
                                   echo ('<form method = "POST">');
                                   echo ('<input type="hidden" name="Bank_id" value="'.$row['Bank_ID'].'">'."\n");
                                   echo ('<input type="submit" name= "delete" value="Delete" class ="deleteBtn">');
                                   echo ('</form>');
                              
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