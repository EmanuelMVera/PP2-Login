<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/styles.css" />
  <!-- <link rel="stylesheet" href="../assets/css/login-styles.css" /> -->
  <?php
  $pageName = basename($_SERVER['PHP_SELF']);
  if ($pageName === 'login.php') {
    echo '<link rel="stylesheet" href="../assets/css/login-styles.css">';
  } elseif ($pageName === 'dashboard.php') {
    echo '<link rel="stylesheet" href="../assets/css/dashboard.css">';
  }
  ?>
  <title>PP2</title>
</head>

<body>