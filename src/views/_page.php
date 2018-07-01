<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo baseUrl() ?>vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="<?php echo baseUrl() ?>assets/css/common.css">

    <title><?php echo $title ?></title>
  </head>
  <body>
    <?php require_once "_header.php" ?>
    <div style="height: 20px;"></div>
    <div class="container">
      <?php
        if (!empty($partialFile))
        {
          require_once $partialFile;
        } 
      ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo baseUrl() ?>vendor/components/jquery/jquery.min.js"></script>
    <script src="<?php echo baseUrl() ?>vendor/twbs/bootstrap/assets/js/vendor/popper.min.js"></script>
    <script src="<?php echo baseUrl() ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <script src="<?php echo baseUrl() ?>assets/js/shop.api.js"></script>
    <!-- instantiate api script -->
    <script>
      const mainDomain = "<?php echo baseUrl() ?>";
      const mainShopCart = new shopApi("<?php echo $data['token'] ?>", mainDomain); 
    </script>

    <!-- custom js -->
        <script src="<?php echo baseUrl() ?>assets/js/common.js"></script>
    <?php foreach ($customJs as $jsFile)
    	  {?>
    		<script src="<?php echo baseUrl() ?>assets/js/<?php echo $jsFile ?>.js"></script>
    <?php } ?>

  </body>
</html>