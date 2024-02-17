<?php 
require_once "pdo.php";
?>

<?php 
    if(isset($_POST['D_ID']) && isset($_POST['bank_id']) && isset($_POST['dod'])){
        $sql = "INSERT INTO blood_inventory(D_ID,Bank_ID,Date_of_Donatn,Quantity,Price,Don_Status) VALUES(:D_ID,:Bank_ID,:Date_of_Donatn,:Quantity,:Price,:Don_Status)";
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

<?php 
if( isset($_POST['Bld_Bag_id']) && isset($_POST['delete'])){
    $sql = "DELETE FROM blood_inventory WHERE Bld_Bag_ID = :zip";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':zip' => $_POST['Bld_Bag_id']
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
                            $sql1 = "SELECT * FROM blood_inventory
                                        WHERE Bld_Bag_ID=:bag_id";
                            $stmt1 = $pdo->prepare($sql1);
                            $stmt1->execute(array(
                                ':bag_id' => $_GET['bag_id'],
                                
                            ));

                            $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                            echo '<br><br>';
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
                            echo '</td><td>';
                            echo 'Update opt.';
                            echo '</td><td>';
                            echo 'Delete opt.';
                            echo '</td></tr>';

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
                            echo "</td><td>";
                            echo ('<a href="blood_inventory_update.php?Bld_Bag_ID='.$row['Bld_Bag_ID'].'">Edit</a>');
                            echo "</td><td>";
                            
                            echo ('<form method = "POST">');
                            echo ('<input type="hidden" name="Bld_Bag_id" value="'.$row['Bld_Bag_ID'].'">'."\n");
                            echo ('<input type="submit" name= "delete" value="Delete">');
                            echo ('</form>');
                            echo ("</td></tr>");
                            
                            echo "</table>\n";
                        }
                    ?>
                </div>
            </div>

            <div class="view">
                    <h3>Blood Inventory</h3>
                    <?php 
                        $stmt = $pdo->query("SELECT * FROM blood_inventory");

                        echo '<br><br>';
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
                        echo '</td><td>';
                        echo 'Update opt.';
                        echo '</td><td>';
                        echo 'Delete opt.';
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
                            echo "</td><td>";
                            echo ('<a href="blood_inventory_update.php?Bld_Bag_ID='.$row['Bld_Bag_ID'].'">Edit</a>');
                            echo "</td><td>";
                            
                            echo ('<form method = "POST">');
                            echo ('<input type="hidden" name="Bld_Bag_id" value="'.$row['Bld_Bag_ID'].'">'."\n");
                            echo ('<input type="submit" name= "delete" value="Delete">');
                            echo ('</form>');
                            
                            echo ("</td></tr>");
                        }

                        echo "</table>\n";
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

