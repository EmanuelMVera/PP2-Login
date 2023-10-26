<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/styles.css" />
  <?php
  $pageName = basename($_SERVER['PHP_SELF']);
  if ($pageName === 'index.php') {
    echo '<link rel="stylesheet" href="../assets/css/index.css">';
  } elseif ($pageName === 'dashboard.php') {
    echo '<link rel="stylesheet" href="../assets/css/dashboard.css">';
    echo '<link rel="stylesheet" href="../assets/css/menu.css">';
  } elseif ($pageName === 'editar.php') {
    echo '<link rel="stylesheet" href="../assets/css/update.css">';
  } elseif ($pageName === 'delete.php') {
    echo '<link rel="stylesheet" href="../assets/css/delete.css">';
  }

  ?>
  <title>PP2</title>
</head>

<body>