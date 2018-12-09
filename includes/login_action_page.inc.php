<?php

  require "dbh.inc.php";


$errors = array();
$data  = array();

$loginuname = $_POST['loginuname'];
$loginpwd = $_POST['loginpwd'];
$loginstatus = '0';

      if (empty($_POST['loginuname']))
            $errors['loginuname'] = ' User Name is required.';

      if (empty($_POST['loginpwd']))
            $errors['loginpwd'] = 'Password is required.';

      
      if ( ! empty($errors)) {
            $data['success'] = false;
            $data['errors']  = $errors;
            echo json_encode($data);
            exit();
}

          $sql = "SELECT username FROM users WHERE username=? OR email=?;";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            $errors['loginuname'] = ' User Name sqlerror.';
            if ( ! empty($errors)) {
              $data['success'] = false;
              $data['errors']  = $errors;
              echo json_encode($data);
            exit();
      }
          }
          else {
            mysqli_stmt_bind_param($stmt, "ss", $loginuname,$loginuname);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCount = mysqli_stmt_num_rows($stmt);
            mysqli_stmt_close($stmt);
            if ($resultCount < 1) {
              $errors['loginuname'] = ' No Such Username.';
              if ( ! empty($errors)) {
                $data['success'] = false;
                $data['errors']  = $errors;
                echo json_encode($data);
                exit();
            }
          }
        }

      $sql = "SELECT status FROM users WHERE username=? AND status=?;";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            $errors['loginuname'] = ' User Name sqlerror.';
            if ( ! empty($errors)) {
              $data['success'] = false;
              $data['errors']  = $errors;
              echo json_encode($data);
              exit();
      }
          }
          else {
            mysqli_stmt_bind_param($stmt, "ss", $loginuname, $loginstatus);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCount = mysqli_stmt_num_rows($stmt);
            mysqli_stmt_close($stmt);
            if ($resultCount == 1) {
              $errors['loginuname'] = ' You need to activate you account before you can login';
              if ( ! empty($errors)) {
                $data['success'] = false;
                $data['errors']  = $errors;
                echo json_encode($data);
                exit();
            }
          }
        }
    $sql = "SELECT * FROM users WHERE username=? OR email=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ss", $loginuname, $loginuname);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($loginpwd, $row['password']);
        if ($pwdCheck == false) {
           $errors['loginpwd'] = 'Password is incorrect';
              if ( ! empty($errors)) {
                $data['success'] = false;
                $data['errors']  = $errors;
                echo json_encode($data);
                exit();
                }
        }
        else if ($pwdCheck == true) {
          session_start();
          $_SESSION['id'] = $row['id'];
          $_SESSION['uid'] = $row['username'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['type'] = $row['type_id'];
            if ( ! empty($errors)) {
              $data['success'] = false;
              $data['errors']  = $errors;
              echo json_encode($data);
              exit();
            }
      else{
            $data['success'] = true;
            $data['message'] = 'Success, You have logged in successfully';
            echo json_encode($data);
            exit();
          }
      }
    }
}
  mysqli_stmt_close($stmt);
  mysqli_close($conn);



       