<?php

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['S_Name']))
{
     ?>

<!DOCTYPE html>
<html lang="en">

     <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title> Home </title>
          <!-- <link rel="stylesheet" href="login.css"> -->

          <link rel="stylesheet" href="styles.css">

          <script src="https://kit.fontawesome.com/f890b33209.js" crossorigin="anonymous"></script>
          <link rel="stylesheet" href="home-nav.css">
     </head>

<body class = "homeBody">

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

     
          <div>
               <h1>Hello, 
                    <?php echo $_SESSION['S_Name']; ?>
               </h1><br />
               <button class="submitBtn"> <a href = "logout.php">Logout</a></button>
          </div>
          
          <div>
               <!-- <h3><a href = "Donor.php">Donor</a></h3>
               <h3><a href = "Recipient_user.php">Recipient</a></h3>
               <h3><a href = "staff.php">Staff</a></h3>
               <h3><a href = "BloodBank.php">Blood Bank</a></h3> 
               <h3><a href = "transaction.php">Transfusion</a></h3>
               <h3><a href = "blood_inventory_user.php">Inventory</a></h3> -->
          </div>
     </body>
</html>

<?php
}

else
{
     header("Location: index.php");
     exit();
}
?>