<?php
     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitDonor'])) {
          $dName = $_POST['dName'];
          $dEmail = $_POST['dEmail'];
          $dPhone = $_POST['dPhone'];
          $dGroup = $_POST['dGroup'];
          $dHist = $_POST['dHist'];
          $dGend = $_POST['dGend'];
          $dDOB = $_POST['dDOB'];

          $conn = mysqli_connect('localhost', 'root', 'Nisha@12345', 'BloodBank');

          if ($conn)
          {
               $sql = "INSERT INTO Donor (D_Name, D_DoB, D_Gender, D_Blood_Type, D_Email, D_Phone_No, Medical_History) 
                         VALUES ('$dName', '$dDOB', '$dGend', '$dGroup', '$dEmail', '$dPhone', '$dHist')";
               $result = mysqli_query($conn, $sql);

               if ($result)
               {
                    echo "Data inserted successfully.";
               }

               else
               {
                    echo "Error: " . mysqli_error($conn);
               }

               mysqli_close($conn);
          }
          
          else
          {
               die("Connection failed: " . mysqli_connect_error());
          }
     }
?>