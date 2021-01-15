<?php

    session_start();
    require '../config/config.php';

    if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
        header('location: login.php');
    }

    if($_POST) {
        $id =$_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        if(empty($_POST['role'])) {
            $role = 0;
        } else {
            $role = 1;
        }
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email AND id!=:id");
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user) {
            echo "<script>alert('Your email is already exists.')</script>";
        } else {
            $stmt = $pdo->prepare("UPDATE users SET name=$name, email=$email, role=$role WHERE id='$id'");
            $result = $stmt->execute();
            if($result) {
                echo "<script>alert('Successfully updated');window.location.href='user_list.php';</script>";
            }
        }
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id=".$_GET['id']);
    $stmt->execute();
    $result = $stmt->fetchAll();


    
?>


<?php include('header.html') ?>

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
                    <input type="hidden" name="id" value="<?php echo $user[0]['id']?>">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $result[0]['name']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" vlaue="<?php echo $user[0]['email']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="">Admin</label>
                        <input type="checkbox" name="role" value="<?php  echo $result[0]['role']; ?>" >
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
