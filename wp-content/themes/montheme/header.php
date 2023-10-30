<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/2de576d575.js" crossorigin="anonymous"></script>
  <?php wp_head(); ?>

</head>


<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header>
    <nav class="monmenu">
      <img src="<?php echo get_stylesheet_directory_uri() . '/images/Logo1.png' ?>" alt="logo" class="logo1">
      <div class="burger-menu">
        <i class="fa fa-bars"></i>
      </div>
      <?php wp_nav_menu(['theme_location' => 'header']) ?>
    </nav>
  </header>