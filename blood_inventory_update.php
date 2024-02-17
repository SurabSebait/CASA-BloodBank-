<?php 
    require_once "pdo.php";
    session_start();
?>

<?php
    if( isset($_POST['Bld_Bag_ID']) && $_POST['update']){
        $sql2 = "UPDATE blood_inventory
                    SET D_ID = :d_id,Bank_ID = :b_id, Date_of_Donatn = :dod, Quantity = :quantity, Price = :price,Don_Status = :ds WHERE Bld_Bag_ID = :id";
        $stmt3 = $pdo->prepare($sql2);
        $stmt3->execute(array(
            ':d_id'=>$_POST['D_ID'],
            ':b_id'=> $_POST['bank_id'],
            ':dod'=>$_POST['dod'],
            ':quantity'=>$_POST['quantity'],
            ':price'=> $_POST['price'],
            ':ds'=> $_POST['don'],
           
            ':id'=>$_POST['Bld_Bag_ID']
        ));
        $_SESSION['success'] = 'Record updated';
        header("Location: blood_inventory_admin.php");
        return;
    }

    $stmt = $pdo->prepare("SELECT * FROM blood_inventory where Bld_Bag_ID = :id");
    $stmt->execute(array(
        ':id'=>$_GET['Bld_Bag_ID']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row === false){
        $_SESSION['error'] = 'Bad value for Bld_Bag_ID';
        header('Location:blood_inventory_admin.php');
        return;
    }
    $d = htmlentities($row['D_ID']);
    $b = htmlentities($row['Bank_ID']);
    $dodn = htmlentities($row['Date_of_Donatn']);
    $q = htmlentities($row['Quantity']);
    $p = htmlentities($row['Price']);
    
    $dst = htmlentities($row['Don_Status']);
    $id = htmlentities($row['Bld_Bag_ID']);
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
        <div class = "leftContainer">
            <div class = "add">
                <h3>Update Blood Inventory</h3>
                
                <form method="POST">
                    <div class = "form">
                        <!-- <label for="D_ID">Donor ID:</label> -->
                        <input type="text" placeholder = "Donor ID" name = "D_ID" value="<?= $d?>"><br>

                        <!-- <label for="Bank_ID">Bank ID: </label> -->
                        <input type="text" placeholder = "Blood Bank ID" name="bank_id" value="<?= $b?>">

                        <!-- <label for="date">Date Of Donation:</label> -->
                        <input type="date" placeholder = "Date of Donation" name="dod" id="dod" value="<?= $dodn?>"><br>

                        <!-- <label for="quan">Quantity: </label> -->
                        <input type="text" placeholder = "Quantity" name='quantity' id="quant" value="<?= $q?>"><br>

                        <!-- <label for="price">Price:</label> -->
                        <input type="text" placeholder = "Price" name="price" value="<?= $p?>"><br>

                        <!-- <label for="inp">Status:</label> -->
                        <input type="text" placeholder = "Status" name = 'don' value='<?= $dst?>'><br>

                        <input type="hidden" name="Bld_Bag_ID" value="<?= $id?>">

                        <input type="submit" name="update" value="Update Inventory" class = "submitBtn">
                    </div>
                </form>                
            </div>
        </div>
    </body>
</html>
