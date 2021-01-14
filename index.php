<?php
  session_start();
  require 'config/config.php';

  if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
    header('location: login.php');
  }

    $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
    $stmt->execute();
    $result = $stmt->fetchAll();

?>


<!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blog Site</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>
  <body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left:0px !important">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
              <h1 style="text-align:center">Blog Site</h1>
        </div><!-- /.container-fluid -->
      </section>
      
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <?php if($result) :?>
            <?php foreach($result as $value): ?>
              <div class="col-md-4">
                <!-- Box Comment -->
                <div class="card card-widget">
                  <div class="card-header">
                    <div class="card-title" style="text-align:center !important; float:none">
                        <h4><?php echo $value['title']; ?></h4>

                    <!-- /.card-tools -->
                    </div>    
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <a href="blogdetail.php?id=<?php echo $value['id']; ?>"><img class="img-fluid pad"  src="admin/images/<?php echo $value['image']; ?>" style="height:200px" !important ></a>
                  </div>
                  <!-- /.card-body -->
                  
                </div>
                <!-- /.card -->
              </div>
              <?php endforeach; ?>
            <?php else: ?>
          <?php endif; ?>  

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

      <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
      </a>
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer" style="margin-left:0px !important">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        <a href="logout.php" type="button" class="btn btn-default">Logout</a>
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2020 <a href="#">A Programmer</a>.</strong> All rights reserved.
    </footer>
  </div>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  </body>
</html>