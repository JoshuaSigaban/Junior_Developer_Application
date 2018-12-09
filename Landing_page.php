<?php
    // this starts a session on each page and my database is connected
  require "header.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>Developer coding test</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/avatar.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
  </head>
            <body>
              <header>
                <nav class="nav-header-main">
                  <a class="header-logo" href="index.php">
                    <!--Just a cool script i found on github for the avatar with users name and i use a session to get the loggedin users name-->
                    <img class="round" width="50" height="50" avatar="<?php echo $_SESSION['uid']; ?>">
                  </a>
                </nav>
                <div class="header-login">
                  <?php
                  if (isset($_SESSION['id'])) {
                    echo '<form action="includes/logout.inc.php" method="post">
                      <button class="button" type="submit" name="logout">Logout</button>
                    </form>';
                  }
                  ?>
                </div>
              </header>
                  <main>
                <div class="wrapper-main">
                  <section class="section-default">
                      <!--a check i run to make sure the user is actually logged in if not just a return to the login page-->
                    <?php
                    if (!isset($_SESSION['id'])) {
                      header("Location:index.php");
                    }
                    else if(isset($_SESSION['id'])) 
                    {
                      echo "<h2>Details are diplayed in a nested/tree view list click on it to display more</h2>";
                      echo "<br><br>";
                    }
                      // Here im checking the user type
                    if (isset($_SESSION['type'])){
                    if($_SESSION['type'] == "Sales"){

                      $sql = "SELECT users.username, user_types.type_description
                              FROM users INNER JOIN user_types
                              ON user_types.id = users.type_id
                              WHERE users.type_id = user_types.id;";

                        $query = mysqli_query($conn, $sql);
                        echo '<div class="container">';
                        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                          echo'
                              <details>
                                <summary>
                                  <div class="selector"></div>
                                   User Name : '.$row['username'].'
                                   </summary>
                                   <li>Type Description : '.$row['type_description'].'</li>
                                   </details>';
                        }
                        echo '</div>';
                      }
                    if($_SESSION['type'] == "Operations"){

                      $sql = "SELECT users.username, user_types.type_description,users.email,users.status
                              FROM users INNER JOIN user_types
                              ON user_types.id = users.type_id
                              WHERE users.type_id = user_types.id;";
                        $query = mysqli_query($conn, $sql);
                        echo '<div class="container">';
                        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                          echo'
                              <details>
                                <summary>
                                <div class="selector"></div>
                                User Name : '.$row['username'].'
                                </summary>
                                <li>Type Description : '.$row['type_description'].'</li>
                                <li>Email : '.$row['email'].'</li>
                                <li>Email Activation Status : '.$row['status'].'</li>
                                </details>';
                        }
                        echo '</div>';
                      }
                    }
                    ?>
                  </section>
                </div>
              </main>
              <footer>
          </footer>
      </body>
</html>


