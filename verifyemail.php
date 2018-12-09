<?php
//the page im using to do the account verification
  require "includes/dbh.inc.php";

      $uid = $_GET['uname'];
      $mail = $_GET['email'];
      $status = '1';
      
      $sql = "UPDATE users SET status = $status WHERE username ='$uid' AND email = '$mail';";
          if (mysqli_query($conn, $sql)) {
            header("Location:index.php?message=Verified Account For " .$mail.  " You May Now Login &Successful=true");
            exit();
          }else {
            echo "Error updating: " . mysqli_error($conn);
            exit();
           }
mysqli_stmt_close($stmt);
mysqli_close($conn);

				      
                    


                            

         
     





    