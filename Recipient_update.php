<?php 
    require_once "pdo.php";
    session_start();
?>

<?php
    if( isset($_POST['Rec_ID']) && $_POST['update']){
        $sql2 = "UPDATE recipient
                    SET Rec_Name = :name,Rec_DoB = :Dob, Rec_Gender = :gender, Rec_Blood_Type = :bloodtype, Rec_Email = :email, Rec_Phone_No = :phone WHERE Rec_ID = :id";
        $stmt3 = $pdo->prepare($sql2);
        $stmt3->execute(array(
            ':name'=>$_POST['name'],
            ':Dob'=> $_POST['dob'],
            ':gender'=>$_POST['gender'],
            ':bloodtype'=>$_POST['bloodtype'],
            ':email'=> $_POST['email'],
            ':phone'=> $_POST['phone'],
            ':id'=>$_POST['Rec_ID']
        ));
        $_SESSION['success'] = 'Record updated';
        header("Location: Recipient_admin.php");
        return;
    }

    $stmt = $pdo->prepare("SELECT * FROM recipient where Rec_ID = :id");
    $stmt->execute(array(
        ':id'=>$_GET['Rec_ID']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row === false){
        $_SESSION['error'] = 'Bad value for Rec_ID';
        header('Location:Recipient_admin.php');
        return;
    }
    $n = htmlentities($row['Rec_Name']);
    $d = htmlentities($row['Rec_DoB']);
    $g = htmlentities($row['Rec_Gender']);
    $b = htmlentities($row['Rec_Blood_Type']);
    $e = htmlentities($row['Rec_Email']);
    $p = htmlentities($row['Rec_Phone_No']);
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
                <h1>Update Recipient</h1>
                
                <form method="POST">
                    <div class = "form">

                        <input type="text" placeholder = "Name" name="name" value="<?= $n?>"><br>

                        <input type="date" placeholder = "DOB" name = "dob" value="<?= $d?>"><br>

                        <input type="text" placeholder = "Gender" name='gender' value='<?= $g?>'><br />

                        <input type="text" placeholder = "Blood Type" name="bloodtype" value="<?= $b?>"><br>

                        <input type="email" placeholder = "Email" name='email' value="<?= $e?>"><br>

                        <input type="text" placeholder = "Phone No" name="phone" value="<?= $p?>"><br>

                        <input type="hidden" name="Rec_ID" value="<?= $id?>">

                        <input type="Submit" name = "update" value="Update Recipient" class = "submitBtn">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>