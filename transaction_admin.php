<?php 
    require_once "pdo.php";
?>

<?php 
        if(isset($_POST['Bag_ID']) && isset($_POST['Rec_id']) && isset($_POST['T_date'])){
            $sql = "INSERT INTO transfusion(Bag_ID,Rec_ID,T_Date,Quantity,T_time) VALUES(:Bag_ID,:Rec_ID,:T_Date,:Quantity,:T_time)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':Bag_ID' => $_POST['Bag_ID'],
                ':Rec_ID' => $_POST['Rec_id'],
                ':T_Date' => $_POST['T_date'],
                ':Quantity' => $_POST['quantity'],
                ':T_time' => $_POST['T_time']
                
            ));
            
        }
    ?>

    <?php 
        if(isset($_POST['T_ID']) && isset($_POST['delete'])){
            $sql = "DELETE FROM transfusion
                    WHERE T_ID = :zip";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':zip'=>$_POST['T_ID']
            ));
        }
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CASA Database</title>
        
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
                <h1> Add a Transaction </h1>
                <form method="POST">
                    <div class="form">
                        <!-- <label for="bag_ID">Bag ID:</label> -->
                        <input type="text" placeholder = "Bag ID" name = "Bag_ID" ><br>

                        <!-- <label for="rec_ID">Recipient ID: </label> -->
                        <input type="text" placeholder = "Recipient ID" name="Rec_id"><br>
                        
                        <!-- <label for="quan">Quantity: </label> -->
                        <input type="number" placeholder = "Quantity" name='quantity' id="quant"><br>
                        
                        <!-- <label for="date">Transaction Date:</label> -->
                        <input type="date" placeholder = "Transaction Date" name="T_date"><br>

                        <!-- <label for="T_time">Transaction Time:</label> -->
                        <input type="time" placeholder = "Transaction Time" name="T_time"><br>

                        <input type="Submit" name = "Add Transaction" value="Add Transaction" class = "submitBtn">
                    </div>
                </form>
            </div>
        </div>

        <div class = "rightContainer"> 
            <div class="search">
                <h1>Search Transaction</h1>
                <form method="GET">
                    <div class = "form" id = "searchInput">
                        <!-- <label for="T_id">Transaction ID:</label> -->
                        <input type="text" placeholder = "Transaction ID" name = "T_id" id="id">
                        
                        <input type="Submit" name="search" value="Search Transaction" class = "submitBtn">
                    </div>
                </form>

                <div class = "searchRes">
                    <?php 
                        if( isset($_GET['T_id']))
                        {
                            $sql1 = "SELECT * FROM transfusion
                                        WHERE T_ID=:trans_id";
                            $stmt1 = $pdo->prepare($sql1);
                            $stmt1->execute(array(
                                ':trans_id' => $_GET['T_id'],
                                
                            ));
                            $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                            echo '<br><br>';
                            echo '<table border = "1">'."\n";
                            echo '<tr><td>';
                            echo 'Transaction ID';
                            echo '</td><td>';
                            echo 'Bag ID';
                            echo '</td><td>';
                            echo 'Recipient ID';
                            echo '</td><td>';
                            echo 'Transaction Date';
                            echo '</td><td>';
                            echo 'Quantity';
                            echo '</td><td>';
                            echo 'Transaction Time';
                            echo '</td><td>';
                            echo 'Update opt.';
                            echo '</td><td>';
                            echo 'Delete opt.';
                            echo '</td></tr>';

                            echo "<tr><td>";
                            echo $row1['T_ID'];
                            echo "</td><td>";
                            echo $row1['Bag_ID'];
                            echo "</td><td>";
                            echo $row1['Rec_ID'];
                            echo "</td><td>";
                            echo $row1['T_Date'];
                            echo "</td><td>";
                            echo $row1['Quantity'];
                            echo "</td><td>";
                            echo $row1['T_time'];
                            echo "</td><td>";
                            echo ('<a href="transaction_update.php?T_ID='.$row1['T_ID'].'">Edit</a>');
                            echo "</td><td>";
                            echo ('<form method = "POST">');
                            echo ('<input type="hidden" name="T_ID" value="'.$row1['T_ID'].'">'."\n");
                            echo ('<input type="submit" name= "delete" value="Delete" class = "deleteBtn">');
                            echo ('</form>');
                            echo ("</td></tr>");   

                            echo "</table>\n";
                        }
                    ?>
                </div>
            </div>

            <div class="view">
                <h1>Transactions</h1>
                <?php 
                    $stmt = $pdo->query("SELECT * FROM transfusion");

                    echo '<br><br>';
                    echo '<table border = "1">'."\n";
                    echo '<tr><td>';
                    echo 'Transaction ID';
                    echo '</td><td>';
                    echo 'Bag ID';
                    echo '</td><td>';
                    echo 'Recipient ID';
                    echo '</td><td>';
                    echo 'Transaction Date';
                    echo '</td><td>';
                    echo 'Quantity';
                    echo '</td><td>';
                    echo 'Transaction Time';
                    echo '</td><td>';
                    echo 'Update opt.';
                    echo '</td><td>';
                    echo 'Delete opt.';
                    echo '</td></tr>';

                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr><td>";
                        echo $row['T_ID'];
                        echo "</td><td>";
                        echo $row['Bag_ID'];
                        echo "</td><td>";
                        echo $row['Rec_ID'];
                        echo "</td><td>";
                        echo $row['T_Date'];
                        echo "</td><td>";
                        echo $row['Quantity'];
                        echo "</td><td>";
                        echo $row['T_time'];
                        echo "</td><td>";
                        echo ('<a href="transaction_update.php?T_ID='.$row['T_ID'].'">Edit</a>');
                        echo "</td><td>";
                        echo ('<form method = "POST">');
                        echo ('<input type="hidden" name="T_ID" value="'.$row['T_ID'].'">'."\n");
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

