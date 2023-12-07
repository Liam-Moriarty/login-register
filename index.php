<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
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
  <link rel="stylesheet" href="index.css">
  <title>Dashboard</title>
</head>
<body>
  <div class="container">
    <h3>Thank you for trusting techmart</h3>
    <div class="buttons">
      <a href="techmart.php" class="btn">Buy again</a>
      <a href="logout.php" class="btn">Logout</a>
    </div>
    
  </div>
</body>
</html>