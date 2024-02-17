<?php 
    require_once "pdo.php";
    session_start();
?>

<?php

    if( isset($_POST['Bank_ID']) && $_POST['update']){
        $sql2 = "UPDATE blood_bank
                    SET Bank_Name = :name,Location = :l, Bank_Email = :email, Bank_Phone_No = :p, Mgr_ID = :m WHERE Bank_ID = :id";
        $stmt3 = $pdo->prepare($sql2);
        $stmt3->execute(array(
            ':name'=>$_POST['bName'],
            ':l'=> $_POST['loc1'],
            ':email'=>$_POST['bEmail'],
            ':p'=>$_POST['bPhone'],
            ':m'=> $_POST['mi1'],
        
            ':id'=>$_POST['Bank_ID']
        ));
        $_SESSION['success'] = 'Record updated';
        header("Location: BloodBank_admin.php");
        return;
    }

    $stmt = $pdo->prepare("SELECT * FROM blood_bank WHERE Bank_ID = :id");
    $stmt->execute(array(
        ':id'=>$_GET['Bank_ID']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row === false){
        $_SESSION['error'] = 'Bad value for Bank_ID';
        header('Location:BloodBank_admin.php');
        return;
    }
    $n = htmlentities($row['Bank_Name']);
    $l = htmlentities($row['Location']);
    $e = htmlentities($row['Bank_Email']);
    $p = htmlentities($row['Bank_Phone_No']);
    $m = htmlentities($row['Mgr_ID']);
    $id = htmlentities($row['Bank_ID']);
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
    <body>
        <div class = "leftContainer">
            <div class = "add">
                
                <h3>Update Blood Bank</h3>
                
                <form method="POST">
                    <div class = "form">
                        <!-- <label for="in">Name:</label> -->
                        <input type = "text" name = 'bName' id = "bName" value="<?= $n?>" required /><br />
                    

                        <!-- <label for = "email">Email:</label> -->
                        <input type = "email"  name = 'bEmail' id = "bEmail" value="<?= $e?>" required /><br />
                    

                        <!-- <label for = "phone">Phone:</label> -->
                        <input type = "tel" name = 'bPhone' id = "bPhone" value="<?= $p?>" required /><br />
                    

                        <!-- <label for = "loc">Location:</label> -->
                        <input type = "text"  name = 'loc1'  value="<?= $l?>" required /><br />
                    

                        <!-- <label for = "Mgr">Manager ID:</label> -->
                        <input type = "text" name = 'mi1' value="<?= $m?>" />
                    

                    
                
                        <input type="hidden" name="Bank_ID" value="<?= $id?>">
                    
                        <input type="submit" name="update" value="Update Bank" class="submitBtn">
                    </div>
                </form>

                    
            </div>
        </div>  

    </body>
</html>