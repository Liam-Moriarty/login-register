<?php
session_start();
if (isset($_SESSION["user"])) {
  header("Location: techmart.html");
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

  <title>Registration Form</title>
</head>
<body>

    <div class="container">
        <form action="registration.php" method="post">
        <!--PHP code below here-->

        <?php
          // this print_r code is to check if the connection between registration.php is
          // succesfull that it can get the array after clicking the submit button

          /* print_r($_POST); */

          // this if statemet is if someone click the submit button 

          if (isset($_POST["submit"])) {
            // this store's the data in the variable so we can access it later
            $fullname = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            // this passwordHash is to not see the password in the database  
            // for extra security

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // for validation

            $errors = array();

            if (empty($fullname) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
              array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              array_push($errors, "Email is not valid");
            }
            if (strlen($password)<8) {
              array_push($errors, "Password must be at least 8 characters long");
            }
            if ($password !== $passwordRepeat) {
              array_push($errors, "Password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email' ";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
              array_push($errors, "Email already exist!");
            }

            if (count($errors)>0) {
              foreach ($errors as $errors) {
                echo "<div class='alert alert-danger'>$errors</div>";
              }
            } else {

              // we will insert the data in the database

              $sql = "INSERT INTO users (full_name,	email, password) VALUES (?, ?, ?)";
              $stmt = mysqli_stmt_init($conn);
              $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
              if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
              } else {
                die("Something went wrong");
              }
            }
              
          }
        ?>
          <!--continuation of html code here-->
          <div><h1 class="page-title">Register</h1></div>
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full name:">
            </div>

            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
            </div>

            <div class="form-btn">
                <input type="submit" class="btn" value="Register" name="submit">
            </div>
            <div class="lr-link"><p>Already register?</p><a href="login.php">Login here!</a></div>
        </form>
    </div>
</body>
</html>