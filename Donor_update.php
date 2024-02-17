<?php 
    require_once "pdo.php";
    session_start();
?>

<?php
    if( isset($_POST['D_ID']) && $_POST['update']){
        $sql2 = "UPDATE donor
                    SET D_Name = :name,D_DoB = :dob, D_Gender = :gender, D_Blood_Type = :dbt, D_Email = :email,D_Phone_No = :dpn,Last_Date_of_Donation = :dod, Medical_History = :mh WHERE D_ID = :id";
        $stmt3 = $pdo->prepare($sql2);
        $stmt3->execute(array(
            ':name'=>$_POST['dName'],
            ':dob'=> $_POST['dDOB'],
            ':gender'=>$_POST['dGend'],
            ':dbt'=>$_POST['dGroup'],
            ':email'=> $_POST['dEmail'],
            ':dpn'=> $_POST['dPhone'],
            ':dod'=> $_POST['lDOD'],
            ':mh'=> $_POST['dHist'],
            ':id'=>$_POST['D_ID']
        ));
        $_SESSION['success'] = 'Record updated';
        header("Location: Donor_admin.php");
        return;
    }

    $stmt = $pdo->prepare("SELECT * FROM donor WHERE D_ID = :id");
    $stmt->execute(array(
        ':id'=>$_GET['D_ID']
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row === false){
        $_SESSION['error'] = 'Bad value for D_ID';
        header('Location:Donor_admin.php');
        return;
    }
    $n = htmlentities($row['D_Name']);
    $dd = htmlentities($row['D_DoB']);
    $dg = htmlentities($row['D_Gender']);
    $db = htmlentities($row['D_Blood_Type']);
    $de = htmlentities($row['D_Email']);
    $dp = htmlentities($row['D_Phone_No']);
    $dod = htmlentities($row['Last_Date_of_Donation']);
    $m = htmlentities($row['Medical_History']);
    $id = htmlentities($row['D_ID']);
?>

<html>
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
                    <h3>Update Donor</h3>
                    
                    <form method="POST">
                        <div class = "form">
                            <!-- <label for="in">Name:</label> -->
                            <input type = "text" placeholder = "Name" name = 'dName' id = "dName" value="<?= $n?>" /><br><br>

                            <!-- <label for = "email">Email</label><br> -->
                            <input type = "email" placeholder = "Email"  name = 'dEmail' id = "dEmail" value="<?= $de?>" /><br><br>

                            <!-- <label for = "phone">Phone</label><br> -->
                            <input type = "tel" placeholder = "Phone No" name = 'dPhone' id = "dPhone" value="<?= $dp?>" /><br><br>

                            <!-- <label for = "bgroup">Blood Group</label><br> -->
                            <input type = "text" placeholder = "Blood Group"  name = 'dGroup' id = "dGroup" value="<?= $db?>" /><br><br>

                            <!-- <label for = "medicalHistory">Medical History</label><br>  -->
                            <input type = "text" placeholder = "Medical History" name = 'dHist' id = "dHist" value="<?= $m?>" /><br><br>

                            <!-- <label for = "gender">Gender</label><br>  -->
                            <input type = "text" placeholder = "Gender" name = 'dGend' id = "dGend" value="<?= $dg?>" /><br><br>

                            <label for = "dob">Date of Birth</label><br>
                            <input type = "date" placeholder = "DOB" name = 'dDOB' id = "dDOB" value="<?= $dd?>" /><br><br>
                            
                            <label for="inp">Last Date Of Donation:</label>
                            <input type = "date" placeholder = "Last Date of donation" name = 'lDOD' value="<?= $dod?>" /><br><br>
                        
                            <input type="hidden" name="D_ID" value="<?= $id?>">
                            
                            <input type="submit" name="update" value="Update Donor" class = "submitBtn">
                        </div>
                    </form>
                </div>
            
        </div>
    </body>
</html>
