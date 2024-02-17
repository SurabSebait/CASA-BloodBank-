<?php 
    require_once "pdo.php";
    session_start();
?>

<?php
    if( isset($_POST['T_ID']) && $_POST['update']){
        $sql2 = "UPDATE transfusion
                    SET Bag_ID = :b_id,Rec_ID = :R_id, T_Date = :date, Quantity = :quantity, T_time = :time WHERE T_ID = :id";
        $stmt3 = $pdo->prepare($sql2);
        $stmt3->execute(array(
            ':b_id'=>$_POST['Bag_ID'],
            ':R_id'=> $_POST['Rec_id'],
            ':date'=>$_POST['T_date'],
            ':quantity'=>$_POST['quantity'],
            ':time'=> $_POST['T_time'],
           
            ':id'=>$_POST['T_ID']
        ));
        $_SESSION['success'] = 'Record updated';
        header("Location: transaction_admin.php");
        return;
    }

    $stmt = $pdo->prepare("SELECT * FROM transfusion where T_ID = :id");
    $stmt->execute(array(
        ':id'=>$_GET['T_ID']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row === false){
        $_SESSION['error'] = 'Bad value for Rec_ID';
        header('Location:Recipient_admin.php');
        return;
    }
    $b = htmlentities($row['Bag_ID']);
    $r = htmlentities($row['Rec_ID']);
    $t = htmlentities($row['T_Date']);
    $q = htmlentities($row['Quantity']);
    $tt = htmlentities($row['T_time']);
    
    $id = htmlentities($row['Rec_ID']);
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
        
        <div class='leftContainer'>
            <div class = "add">
                <h3>Update a particular recipient</h3>
                
                <form method="POST">
                    <div class = "from">
                    
                        <!-- <label for="bag_ID">Bag ID:</label> -->
                        <input type="text" placeholder = "Blood Bag ID" name = "Bag_ID" value="<?= $b?>"><br>

                        <!-- <label for="rec_ID">Recipient ID: </label> -->
                        <input type="text" placeholder = "Recipient ID" name="Rec_id" value="<?= $r?>"><br>

                        <!-- <label for="date">Transaction Date:</label> -->
                        <input type="date" placeholder = "Transaction Date" name="T_date" value="<?= $t?>"><br>

                        <!-- <label for="quan">Quantity: </label> -->
                        <input type="text" placeholder = "QUantity" name='quantity' id="quant" value="<?= $q?>"><br>

                        <!-- <label for="T_time">Transaction Time:</label> -->
                        <input type="time" placeholder = "Transaction Time" name="T_time" value="<?= $tt?>"><br>

                        <input type="hidden" name="T_ID" value="<?= $id?>"><br>
                        <input type="submit" name="update" value="Update Transaction" class="submitBtn">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
