<?php
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          $email = $_POST['Email'];
          $password = $_POST['userPassword'];

          // Add your database connection code here
          $conn = mysqli_connect('localhost:3306', 'root', 'Nisha@12345', 'BloodBank');

          if ($conn)
          {

               if (empty($email))
               {
                    header("Location: index.php?error=User Name is required");
                    exit();
               }

               else if(empty($password))
               {
                    header("Location: index.php?error=Password is required");
                    exit();
               }
               
               else
               {
                    $sql = "SELECT * FROM Staff WHERE S_Email = '$email' AND S_Password = '$password'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) === 1)
                    {
                         $row = mysqli_fetch_assoc($result);
                         session_start();
                         $_SESSION['id'] = $row['S_ID'];
                         $_SESSION['S_Name'] = $row['S_Name'];

                         if ($row['S_Position'] === 'Administrator')
                         {
                              header("Location: home_admin.php");
                         }

                         else
                         {
                              header("Location: home.php");
                         }
                         
                         exit();
                    }
                    
                    else
                    {
                         header("Location: index.php?error=Invalid credentials");
                         exit();
                    }
               }
          }
          
          else
          {
               die("Connection failed: " . mysqli_connect_error());
          }
     }
?>