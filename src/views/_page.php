<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
     <link rel="stylesheet" href="assets/css/common.css">

    <title><?php echo $title ?></title>
  </head>
  <body>
    <?php require_once "_header.php" ?>

    <div class="container">
      <?php $partial ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/assets/js/vendor/popper.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- custom js -->
    <?php foreach ($customJs as $jsFile)
    	  {?>
    		<script src="assets/js/"<?php echo $jsFile ?>></script>
    <?php } ?>
  </body>
</html>