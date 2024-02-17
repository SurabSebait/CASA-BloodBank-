<?php 
    require_once "pdo.php";
?>

<?php 
    if(isset($_POST['bank_ID']) && isset($_POST['name'])){
        $sql = "INSERT INTO staff(Bank_ID,S_Name,S_Position,S_Email,S_Password,S_Phone_No) VALUES(:Bank_ID,:S_Name,:S_Position,:S_Email,:S_Password,:S_Phone_No)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
           
            ':Bank_ID' => $_POST['bank_ID'],
            ':S_Name' => $_POST['name'],
            ':S_Position' => $_POST['position'],
            ':S_Email' => $_POST['email'],
            ':S_Password' => $_POST['pass'],
            ':S_Phone_No' => $_POST['phone']
        ));
        
    }
?>

<?php 
    if( isset($_POST['S_id']) && isset($_POST['delete'])){
        $sql = "DELETE FROM staff WHERE S_ID = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':zip' => $_POST['S_id']
        ));
    }
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
    
        <div class="leftContainer">
            <div class="add">
                <h1> Add a Staff </h1>
                <form method="POST">
                    <div class="form">
                        <!-- <label for="bank_ID">Bank_ID:</label> -->
                        <input type="text" placeholder = "Blood Bank ID" name="bank_ID" id="input"><br>

                        <!-- <label for="Name">Name:</label> -->
                        <input type="text" placeholder = "Name" name = "name" id = "name"><br>

                        <!-- <label for="pos">Position: </label> -->
                        <input type="text" placeholder = "Position" name="position"><br>

                        <input type="email" placeholder = "Email" name="email" id="email"><br>

                        <input type="password" placeholder = "Password" name='pass' id="pass"><br>

                        <input type="text" placeholder = "Phone No" name="phone" id="phone"><br>

                        <input type="Submit" name = "Add Staff" value="Add Staff" class = "submitBtn">
                    </div>
                </form>
            </div>
        </div>

        <div class = "rightContainer">
            <div class = "search">
                <h1>Search Staff</h1>
                <form method="POST">
                    <div class = "form" id = "searchInput">
                        <!-- <label for="id">Staff ID:</label> -->
                        <input type="text" placeholder = "Staff ID" name = "id" >

                        <!-- <label for="name">Staff Name:</label> -->
                        <input type="text" placeholder = "Staff Name" name="name" id="name">

                        <input type="Submit" name="search" value="Search Staff" class = "submitBtn">
                    </div>
                </form>

                <div class = "searchRes">
                    <?php 
                        if(isset($_POST['search'])){
                            $id = $_POST['id'];
                            $name = $_POST['name'];
                            if( $id && $name){
                                $sql1 = "SELECT * FROM staff
                                            WHERE S_ID=:id AND S_Name like :name";
                                $stmt1 = $pdo->prepare($sql1);
                                $stmt1->execute(array(
                                    ':id' => $_POST['id'],
                                    ':name' => '%'.$_POST['name'].'%'
                                ));
                                $row = $stmt1->fetch(PDO::FETCH_ASSOC);
                                echo '<table border = "1">'."\n";
                                echo '<tr><td>';
                                echo 'Staff ID';
                                echo '</td><td>';
                                echo 'Bank ID';
                                echo '</td><td>';
                                echo 'Name';
                                echo '</td><td>';
                                echo 'Position';
                                echo '</td><td>';
                                echo 'Email';
                                echo '</td><td>';
                                echo 'Password';
                                echo '</td><td>';
                                echo 'Phone No';
                                echo '</td></tr>';
                                echo "<tr><td>";
                                echo "<tr><td>";

                                echo "<tr><td>";
                                echo $row['S_ID'];
                                echo "</td><td>";
                                echo $row['Bank_ID'];
                                echo "</td><td>";
                                echo $row['S_Name'];
                                echo "</td><td>";
                                echo $row['S_Position'];
                                echo "</td><td>";
                                echo $row['S_Email'];
                                echo "</td><td>";
                                echo $row['S_Password'];
                                echo "</td><td>";
                                echo $row['S_Phone_No'];
                                echo "</td><td>";
                                echo ('<a href="staff_update.php?S_ID='.$row['S_ID'].'">Edit</a>');
                                echo "</td><td>\n";
                                echo ('<form method = "POST">');
                                echo ('<input type="hidden" name="S_id" value="'.$row['S_ID'].'">'."\n");
                                echo ('<input type="submit" name= "delete" value="Delete" class = "deleteBtn">');
                                echo ('</form>');
                                echo ("</td></tr>");

                                echo "</table>\n";

                            }
                            else if($id && !$name){
                                $sql1 = "SELECT * FROM staff
                                            WHERE S_ID=:id ";
                                $stmt1 = $pdo->prepare($sql1);
                                $stmt1->execute(array(
                                    ':id' => $_POST['id']
                                    
                                ));
                                $row = $stmt1->fetch(PDO::FETCH_ASSOC);
                                echo '<table border = "1">'."\n";
                                echo '<tr><td>';
                                echo 'Staff ID';
                                echo '</td><td>';
                                echo 'Bank ID';
                                echo '</td><td>';
                                echo 'Name';
                                echo '</td><td>';
                                echo 'Position';
                                echo '</td><td>';
                                echo 'Email';
                                echo '</td><td>';
                                echo 'Password';
                                echo '</td><td>';
                                echo 'Phone No';
                                echo '</td></tr>';
                                echo "<tr><td>";
                                echo "<tr><td>";

                                echo "<tr><td>";
                                echo $row['S_ID'];
                                echo "</td><td>";
                                echo $row['Bank_ID'];
                                echo "</td><td>";
                                echo $row['S_Name'];
                                echo "</td><td>";
                                echo $row['S_Position'];
                                echo "</td><td>";
                                echo $row['S_Email'];
                                echo "</td><td>";
                                echo $row['S_Password'];
                                echo "</td><td>";
                                echo $row['S_Phone_No'];
                                echo "</td><td>";
                                echo ('<a href="staff_update.php?S_ID='.$row['S_ID'].'">Edit</a>');
                                echo "</td><td>\n";
                                echo ('<form method = "POST">');
                                echo ('<input type="hidden" name="S_id" value="'.$row['S_ID'].'">'."\n");
                                echo ('<input type="submit" name= "delete" value="Delete" class = "deleteBtn">');
                                echo ('</form>');
                                echo ("</td></tr>");

                                echo "</table>\n";

                            }
                            else if(!$id && $name){
                                $sql1 = "SELECT * FROM staff
                                            WHERE S_Name like :name ";
                                $stmt1 = $pdo->prepare($sql1);
                                $stmt1->execute(array(
                                    ':name' => '%'.$_POST['name'].'%'
                                    
                                ));
                                $row = $stmt1->fetch(PDO::FETCH_ASSOC);
                                echo '<br><br>';
                                echo '<table border = "1">'."\n";
                                echo '<tr><td>';
                                echo 'Staff ID';
                                echo '</td><td>';
                                echo 'Bank ID';
                                echo '</td><td>';
                                echo 'Name';
                                echo '</td><td>';
                                echo 'Position';
                                echo '</td><td>';
                                echo 'Email';
                                echo '</td><td>';
                                echo 'Password';
                                echo '</td><td>';
                                echo 'Phone No';
                                echo '</td><td>';
                                echo 'Update opt.';
                                echo '</td><td>';
                                echo 'Delete opt.';
                                echo '</td></tr>';

                                echo "<tr><td>";
                                echo $row['S_ID'];
                                echo "</td><td>";
                                echo $row['Bank_ID'];
                                echo "</td><td>";
                                echo $row['S_Name'];
                                echo "</td><td>";
                                echo $row['S_Position'];
                                echo "</td><td>";
                                echo $row['S_Email'];
                                echo "</td><td>";
                                echo $row['S_Password'];
                                echo "</td><td>";
                                echo $row['S_Phone_No'];
                                echo "</td><td>";
                                echo ('<a href="staff_update.php?S_ID='.$row['S_ID'].'">Edit</a>');
                                echo "</td><td>\n";
                                echo ('<form method = "POST">');
                                echo ('<input type="hidden" name="S_id" value="'.$row['S_ID'].'">'."\n");
                                echo ('<input type="submit" name= "delete" value="Delete" class = "deleteBtn">');
                                echo ('</form>');
                                echo ("</td></tr>");

                                echo "</table>\n";
                            }
                            else
                            {
                                $message = "Enter atleast one of the entries.";
                                print $message;
                            }
                        
                        }
                    ?>
                </div>
            </div>

            <div class="view">
                <h1>All Staff</h1>
                <?php 
                    $stmt2 = $pdo->query("SELECT * FROM staff");

                    echo '<br><br>';
                    echo '<table border = "1">'."\n";
                    echo '<tr><td>';
                    echo 'Staff ID';
                    echo '</td><td>';
                    echo 'Bank ID';
                    echo '</td><td>';
                    echo 'Name';
                    echo '</td><td>';
                    echo 'Position';
                    echo '</td><td>';
                    echo 'Email';
                    echo '</td><td>';
                    echo 'Password';
                    echo '</td><td>';
                    echo 'Phone No';
                    echo '</td><td>';
                    echo 'Update opt.';
                    echo '</td><td>';
                    echo 'Delete opt.';
                    echo '</td></tr>';
                    
                    while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr><td>";
                        echo $row2['S_ID'];
                        echo "</td><td>";
                        echo $row2['Bank_ID'];
                        echo "</td><td>";
                        echo $row2['S_Name'];
                        echo "</td><td>";
                        echo $row2['S_Position'];
                        echo "</td><td>";
                        echo $row2['S_Email'];
                        echo "</td><td>";
                        echo $row2['S_Password'];
                        echo "</td><td>";
                        echo $row2['S_Phone_No'];
                        echo "</td><td>";
                        echo ('<a href="staff_update.php?S_ID='.$row2['S_ID'].'">Edit</a>');
                        echo "</td><td>\n";
                        echo ('<form method = "POST">');
                        echo ('<input type="hidden" name="S_id" value="'.$row2['S_ID'].'">'."\n");
                        echo ('<input type="submit" name= "delete" value="Delete" class = "deleteBtn">');
                        echo ('</form>');
                        echo ("</td></tr>");
                    }

                    echo "</table>\n";
                ?>
            </div>
        </div>
    </body>
</html>

