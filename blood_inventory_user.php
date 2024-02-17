<?php 
    require_once "pdo.php";
?>

<?php 
        if(isset($_POST['D_ID']) && isset($_POST['bank_id']) && isset($_POST['dod'])){
            $sql = "INSERT INTO Blood_Inventory(D_ID,Bank_ID,Date_of_Donatn,Quantity,Price,Don_Status) VALUES(:D_ID,:Bank_ID,:Date_of_Donatn,:Quantity,:Price,:Don_Status)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':D_ID' => $_POST['D_ID'],
                ':Bank_ID' => $_POST['bank_id'],
                ':Date_of_Donatn' => $_POST['dod'],
                ':Quantity' => $_POST['quantity'],
                ':Price' => $_POST['price'],
                ':Don_Status' => $_POST['don']
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
                <h1> Add a Donation </h1>
                <form method="POST">
                    <div class = "form">
                        <!-- <label for="D_ID">Donor ID:</label> -->
                        <input type="text" placeholder = "Donor ID" name = "D_ID" ><br>

                        <!-- <label for="Bank_ID">Bank ID: </label> -->
                        <input type="text" placeholder = "Blood Bank ID" name="bank_id"><br>

                        <!-- <label for="date">Date Of Donation:</label> -->
                        <input type="date" placeholder = "Date of Donation" name="dod" id="dod"><br>

                        <!-- <label for="quan">Quantity: </label> -->
                        <input type="text" placeholder = "Quantity" name='quantity' id="quant"><br>

                        <!-- <label for="price">Price:</label> -->
                        <input type="text" placeholder = "Price" name="price"><br>

                        <input type="hidden" name = 'don' value='Available'>

                        <input type="Submit" name = "Add Donation" value="Add Donation" class = "submitBtn">
                    </div>
                </form>
            </div>
        </div>


        <div class = "rightContainer">
            <div class="search">
                <h1>Search Blood Bag</h1>
                <form method="GET">
                    <div class = "form" id = "searchInput">
                        <input type="text" placeholder = "Blood Bag ID" name = "bag_id" id="id">
                        
                        <input type="Submit" name="search" value="Search Recipient" class = "submitBtn">
                    </div>
                </form>

                <div class = "searchRes">
                    <?php 
                        if( isset($_GET['bag_id'])){
                            $sql1 = "SELECT * FROM Blood_Inventory
                                        WHERE Bld_Bag_ID=:bag_id";
                            $stmt1 = $pdo->prepare($sql1);
                            $stmt1->execute(array(
                                ':bag_id' => $_GET['bag_id'],
                                
                            ));
                            $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                            echo '<table border = "1">'."\n";
                            echo '<tr><td>';
                            echo 'Blood Bag ID';
                            echo '</td><td>';
                            echo 'Donor ID';
                            echo '</td><td>';
                            echo 'Bank ID';
                            echo '</td><td>';
                            echo 'Date Of Donation';
                            echo '</td><td>';
                            echo 'Quantity';
                            echo '</td><td>';
                            echo 'Price';
                            echo '</td><td>';
                            echo 'Donation Status';
                            echo '</td></tr>';
                            echo "<tr><td>";
                            echo $row1['Bld_Bag_ID'];
                            echo "</td><td>";
                            echo $row1['D_ID'];
                            echo "</td><td>";
                            echo $row1['Bank_ID'];
                            echo "</td><td>";
                            echo $row1['Date_of_Donatn'];
                            echo "</td><td>";
                            echo $row1['Quantity'];
                            echo "</td><td>";
                            echo $row1['Price'];
                            echo "</td><td>";
                            echo $row1['Don_Status'];
                            echo ("</td></tr>");
                            echo "</table>\n";
                        }
                        else{
                            print ("Enter Bag ID");
                        }
                    ?>
                </div>
            </div>

            <div class="view">
                <h1>Blood Inventory</h1>
                <?php 
                    $stmt = $pdo->query("SELECT * FROM Blood_Inventory");

                    echo '<table border = "1">'."\n";
                    echo '<tr><td>';
                    echo 'Blood Bag ID';
                    echo '</td><td>';
                    echo 'Donor ID';
                    echo '</td><td>';
                    echo 'Bank ID';
                    echo '</td><td>';
                    echo 'Date Of Donation';
                    echo '</td><td>';
                    echo 'Quantity';
                    echo '</td><td>';
                    echo 'Price';
                    echo '</td><td>';
                    echo 'Donation Status';
                    echo '</td></tr>';
                    
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr><td>";
                        echo $row['Bld_Bag_ID'];
                        echo "</td><td>";
                        echo $row['D_ID'];
                        echo "</td><td>";
                        echo $row['Bank_ID'];
                        echo "</td><td>";
                        echo $row['Date_of_Donatn'];
                        echo "</td><td>";
                        echo $row['Quantity'];
                        echo "</td><td>";
                        echo $row['Price'];
                        echo "</td><td>";
                        echo $row['Don_Status'];
                        echo ("</td></tr>");
                    }

                    echo "</table>\n";
                ?>
            </div>
        </div>
    </body>
</html>

