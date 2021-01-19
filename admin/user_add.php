<?php

    session_start();
    require '../config/config.php';

    if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
        header('location: login.php');
    }

    if($_SESSION['role'] != 1) {
        header('location: login.php');
      }

    if($_POST) {    
        if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || strlen($_POST['password']) < 4) {
            if(empty($_POST['name'])) {
              $nameError = "Name cannot be null";
            }
            if(empty($_POST['email'])) {
              $emailError = "Email cannot be null";
            }
            if(empty($_POST['password'])) {
              $passwordError = "Password cannot be null";
            }
            if(strlen($_POST['password']) < 4) {
                $passwordError = "Password must be 4 charcters or digits at least";
            }
      
          } else {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if(empty($_POST['role'])) {
                $role = 0;
            } else {
                $role = 1;
            }

            $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if($user) {
                echo "<script>alert('Your email is already exists.')</script>";
            } else {
                $stmt = $pdo->prepare("INSERT INTO users(name,email,password,role) VALUES (:name,:email,:password,:role)");
                $result = $stmt->execute(
                    array(':name'=>$name,':email'=>$email,':password'=>$password,'role'=>$role)
                );
                if($result) {
                    echo "<script>alert('Successfully register');window.location.href='user_list.php';</script>";
                }
            }
          }
        }    

    
?>


<?php include('header.php') ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="user_add.php" method="post">
                    <div class="form-group">
                        <label for="">Name</label><p style="color:red"><?php echo empty($nameError) ? '' : '*'.$nameError; ?></p>
                        <input type="text" name="name" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="">Email</label><p style="color:red"><?php echo empty($emailError) ? '' : '*'.$emailError; ?></p>
                        <input type="email" name="email" class="form-control" vlaue="">
                    </div>

                    <div class="form-group">
                        <label for="">Password</label><p style="color:red"><?php echo empty($passwordError) ? '' : '*'.$passwordError; ?></p>
                        <input type="password" name="password" class="form-control" vlaue="">
                    </div>

                    <div class="form-group">
                        <label for="">Admin</label>
                        <input type="checkbox" name="role" vlaue="1">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="SUBMIT">
                        <a href="user_list.php" type="button" class="btn btn-warning">Back</a>
                    </div>
                    
                    
                </form>
                
                 

              </div>
              <!-- /.card-body -->
              
              
            </div>
            <!-- /.card -->

            
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  
<?php include('footer.html') ?>
