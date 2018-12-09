<?php

  require "dbh.inc.php";

$errors = array();
$data  = array();
$uname = $_POST['uname'];
$email = $_POST['email'];
$utype = $_POST['utype'];
$pwd = $_POST['pwd'];
$pwd_rp = $_POST['pwd_rp'];
      //making sure all field are filled in
      if (empty($_POST['uname']))
            $errors['uname'] = ' User Name is required.';
      if (empty($_POST['email']))
            $errors['email'] = 'Email is required.';
      if (empty($_POST['utype']))
            $errors['utype'] = 'User type is required.';
      if (empty($_POST['pwd']))
            $errors['pwd'] = 'Password is required.';
      if (empty($_POST['pwd_rp']))
            $errors['pwd_rp'] = 'Password repeat is required.';
      if ($pwd !== $pwd_rp) {
            $errors['pwd'] = 'Passwords do not match.';
            $errors['pwd_rp'] = 'Passwords do not match.';
      }
      if ( ! empty($errors)) {
            $data['success'] = false;
            $data['errors']  = $errors;
            echo json_encode($data);
            exit();
          }//cecking is the user name is already in use this was not asked for but i think it is good practice 
          $sql = "SELECT username FROM users WHERE username=?;";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
                  $errors['uname'] = ' User Name sqlerror.';
                  if ( ! empty($errors)) {
                  $data['success'] = false;
                  $data['errors']  = $errors;
                  echo json_encode($data);
                  exit();
                }
              }else {
                      mysqli_stmt_bind_param($stmt, "s", $uname);
                      mysqli_stmt_execute($stmt);
                      mysqli_stmt_store_result($stmt);
                      $resultCount = mysqli_stmt_num_rows($stmt);
                      mysqli_stmt_close($stmt);
                      if ($resultCount > 0) {
                        $errors['unamechk'] = ' User Name is already taken.';
                        if ( ! empty($errors)) {
                            $data['success'] = false;
                            $data['errors']  = $errors;
                            echo json_encode($data);
                            exit();
                  }
                }
              }
          //again not asked for but its better practice
         $sql = "SELECT email FROM users WHERE email=?;";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            $errors['emailchk'] = ' User Name sqlerror.';
            if ( ! empty($errors)) {
              $data['success'] = false;
              $data['errors']  = $errors;
              echo json_encode($data);
              exit();
              }
          }else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCount = mysqli_stmt_num_rows($stmt);
            mysqli_stmt_close($stmt);
            if ($resultCount > 0) {
              $errors['emailchk'] = ' This email is already in use.';
              if ( ! empty($errors)) {
                $data['success'] = false;
                $data['errors']  = $errors;
                echo json_encode($data);
                exit();
              }
            }
          }
        $sql = "INSERT INTO users (username, password, email, type_id) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $errors['uname'] = ' User Name sqlerror.';
            if ( ! empty($errors)) {
                $data['success'] = false;
                $data['errors']  = $errors;
                echo json_encode($data);
                exit();
            }
        }else {
          //the encrytion you asked for i used this method as it is was better then md5 
          $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "ssss", $uname, $hashedPwd, $email, $utype);
          mysqli_stmt_execute($stmt);
            if ( ! empty($errors)) {
                $data['success'] = false;
                $data['errors']  = $errors;
                echo json_encode($data);
                exit();
            }
        }//creating the random string for the verification email  
        $randStr = uniqid(false);
        $randStr = uniqid($randStr, true);
        $explodeStr = explode('.', $randStr);
        $getStrEnd = $explodeStr[0];
        $url = '10.0.0.3/verifyemail.php?'.$getStrEnd.'verifyemail'.$getStrEnd.'&uname='.$uname.'&'.$getStrEnd.'&email='.$email.'&'.$getStrEnd.$getStrEnd; //change this to where the location of the verification link is going to go 

        $subject = 'Activate Your Account';
        $message = '<p>Congratulations on your recent registration. ';
        $message .= 'Before we can proceed You need to confirm your email address</p>';
        $message .= '<p>You can do that by following this link: </br>';
        $message .= '<a href = '.$url.'> Verify Me !</a></p>';

        $headers = "From: Joshua <joshua@1nsuresa.co.za>\r\n";//change this for email verification to work
        $headers .= "Reply-To: joshua@1nsuresa.co.za\r\n";//change this for email verification to work
        $headers .= "Content-type: text/html\r\n";
        //sending the email
        if(!mail($email, $subject, $message, $headers)){
            $errors['emailverification'] = ' email error.';
            if ( ! empty($errors)) {
                $data['success'] = false;
                $data['errors']  = $errors;
                echo json_encode($data);
                exit();
              }            
              }else{
                    $data['success'] = true;
                    $data['message'] = 'Success, check your email for verification link before you can log in!';
                    echo json_encode($data);
                    exit();
                  
                  }
   
mysqli_stmt_close($stmt);
mysqli_close($conn);
 