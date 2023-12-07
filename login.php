<?php
session_start();
if (isset($_SESSION["user"])) {
  header("Location: techmart.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--BOOTSTRAP CDN-->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <!--CSS LINK-->

  <link rel="stylesheet" href="style.css">

  <title>Login Form</title>
</head>
<body>
  
    <div class="container">
      <form action="login.php" method="post">

      <!--PHP code below here-->
      <?php
        if (isset($_POST["login"])) {
          $email = $_POST["email"];
          $password = $_POST["password"];
          require_once "database.php";
          $sql = "SELECT * FROM users WHERE email = '$email' ";
          $result = mysqli_query($conn, $sql);
          $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
          if ($user) {
            if (password_verify($password, $user["password"])) {
              session_start();
              $_SESSION["user"] = "yes" ;
              header("Location: techmart.php");
              die();
            } else {
              echo "<div class='alert alert-danger'>Password does not match</div>";
            }

          } else {
            echo "<div class='alert alert-danger'>Email does not match</div>";
          }
        }

      ?>


      <!--continuation of html form here -->
      <h1 class="page-title">Login</h1>
        <div class="form-group">
          <input type="email" placeholder="Enter email:" name="email" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" placeholder="Enter password:" name="password" class="form-control">
        </div>
        <div class="form-btn">
          <input type="submit" value="Login" name="login" class="btn">
        </div>
        <div class="lr-link"><p>Not registered yet? </p><a href="registration.php">Register here!</a></div>
      </form>
    </div>
  
</body>
</html>