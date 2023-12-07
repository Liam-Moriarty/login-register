<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>TechMart</title>

    <!-- This code is needed for responsive design to work.
      (Responsive design = make the website look good on
      smaller screen sizes like a phone or a tablet). -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Load a font called Roboto from Google Fonts. -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- Here are the CSS files for this page. -->
    <link rel="stylesheet" href="styles/shared/general.css" />
    <link rel="stylesheet" href="styles/shared/techmart-header.css" />
    <link rel="stylesheet" href="styles/pages/techmart.css" />
  </head>
  <body>
    <div class="amazon-header">
      <div class="amazon-header-left-section">
        <a href="techmart.php" class="header-link">
          <h1 class="logo-of-site">Tech<span class="cart-logo">Mart</span></h1>
        </a>
      </div>

      <div class="amazon-header-middle-section">
        <h2 class="h2-products">PRODUCTS</h2>
      </div>

      <div class="amazon-header-right-section">
        <a class="cart-link header-link" href="checkout.html">
          <ion-icon name="cart"></ion-icon>
        </a>
        <div class="cart-quantity js-cart-quantity">0</div>
        <a class="cart-link header-link" href="logout.php">
          <ion-icon name="log-out"></ion-icon>
        </a>
      </div>
    </div>

    <div class="main">
      <div class="products-grid js-products-grid"></div>
    </div>

    <!--Scripts of Icons-->
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>

    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>

    <script type="module" src="scripts/techmart.js"></script>
  </body>
</html>
