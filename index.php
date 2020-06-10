<?php
session_start();
include("db/config.inc.php");
//establishing a connection with database
if (isset($config) && is_array($config)) {
                try {
                    $dbh = new PDO('mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'] . ';charset=utf8mb4', $config['db_user'], $config['db_password']);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $e) {
                    print "Cannot connect with database server: " . $e->getMessage();
                    exit();
                }
            }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Photo gallery</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>
    <!-- Custom CSS-->
    <link rel="stylesheet" type="text/css" href="styles/stylesheet.css">
    <!-- TinyMCE text editor-->
    <script src="https://cdn.tiny.cloud/1/j86hjjpzaoofwxcvkdfozzrppdt78uqkxm3nzr93rb5saa7x/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- TinyMCE text editor settings-->
    <script>tinymce.init({
      selector:'.art-editor',
      forced_root_block : ''
      });
    </script>  
  </head>

  <body>
      <!--HEADER-->
    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading">Photo gallery</h1>
        <p class="lead text-muted">Create your own gallery</p>
        <p>
          <a href="/gallery"  class="btn btn-gallery">Gallery</a>
          <a href="/add_photo"  class="btn btn-add_photo">Add photo</a>
          <a href="/settings"  class="btn  btn-settings">Settings</a>
        </p>
      </div>
          
    </section>

           
      <!--MAIN CONTENT-->  
    <main role="main" id="main-content">
      <div class="container" id="category_buttons_container">
        	<!--Category buttons are loaded here (by script from gallery.php) -->
      </div>

    <?php
       //Load subpages (if they exist and are allowed otherwise load gallery.php)
      $allowed_pages = ['index','gallery', 'add_photo', 'edit_photo', 'delete_photo','delete_category', 'filter_category', 'settings'];
        if (isset($_GET['page']) && in_array($_GET['page'], $allowed_pages)) {

            if (file_exists($_GET['page'] . '.php')) {
                include($_GET['page'] . '.php');
            } else {
                print 'Plik ' . $_GET['page'] . '.php nie istnieje.';
            }
              
        } else {
            include('gallery.php');
        }
    ?>  

        <!--script that display thumbnails in choosen style -->
        <script src="/js/imageResizing.js"></script>
        <!-- script that block right-click and opening source code -->
        <script src="js/blocker.js"></script>
    </main>
  </body>
</html>