<?php 
    require_once "pdo.php";
    session_start();
?>

<?php
    if( isset($_POST['S_ID']) && $_POST['update']){
        $sql2 = "UPDATE staff
                    SET Bank_ID = :b_id,S_Name = :name, S_Position = :pos,  S_Email = :email, S_Password = :pass, S_Phone_No = :phone WHERE S_ID = :id";
        $stmt3 = $pdo->prepare($sql2);
        $stmt3->execute(array(
            ':b_id'=>$_POST['bank_ID'],
            ':name'=> $_POST['name'],
            ':pos'=>$_POST['position'],
            ':email'=>$_POST['email'],
            ':pass'=> $_POST['pass'],
            ':phone'=> $_POST['phone'],
            ':id'=>$_POST['S_ID']
        ));
        $_SESSION['success'] = 'Record updated';
        header("Location: staff.php");
        return;
    }

    $stmt = $pdo->prepare("SELECT * FROM staff where S_ID = :id");
    $stmt->execute(array(
        ':id'=>$_GET['S_ID']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row === false){
        $_SESSION['error'] = 'Bad value for S_ID';
        header('Location:staff.php');
        return;
    }
    $b = htmlentities($row['Bank_ID']);
    $n = htmlentities($row['S_Name']);
    $sp = htmlentities($row['S_Position']);
    $se = htmlentities($row['S_Email']);
    $spa = htmlentities($row['S_Password']);
    $spn = htmlentities($row['S_Phone_No']);
    $id = htmlentities($row['S_ID']);
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
                <h3>Update a particular Staff</h3>
                
                <form method="POST">
                    <div class = "form">
                        <label for="bank_ID">Bank_ID:</label>
                        <input type="text" placeholder = "Blood Bank ID" name="bank_ID" id="input" value="<?= $b?>"><br>

                        <label for="Name">Name:</label>
                        <input type="text" placeholder = "Name" name = "name" id = "name" value="<?= $n?>"><br>

                        <label for="pos">Position: </label>
                        <input type="text" placeholder = "Position" name="position" value="<?= $sp?>">

                        <label for="email">Blood Staff Email:</label>
                        <input type="email" placeholder = "Email" name="email" id="email" value="<?= $se?>">

                        <label for="Pass">Password: </label>
                        <input type="password" placeholder = "Password" name='pass' id="pass" value="<?= $spa?>"><br>

                        <label for="phoneno">Phone No:</label>
                        <input type="text" placeholder = "Phone No" name="phone" id="phone" value="<?= $spn?>"><br>

                        <input type="hidden" name="S_ID" value="<?= $id?>">

                        <input type="Submit" name = "update" value="Update Staff" class = "submitBtn">
                    </div>
                </form>
        
        </div>

    </body>
</html>