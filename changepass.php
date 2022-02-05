<?php 
  include "inc/header.php";
  include "lib/User.php";
  $user = new User();
?>

<?php 
  include "inc/sidebar.php";
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<?php 
    if(isset($_GET['action']) && $_GET['action'] == 'changepass'){
        $userId = $_GET['id'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
       $passChange = $user->updateUserPass($userId, $_POST);
    }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card" style="max-width:500px; margin:0 auto;">
            <?php 
    if(isset($passChange)){
      echo $passChange;
    }
  ?>
              <div class="card-header">
                <h3 class="card-title">Change Password </h3>
                <a href="view_user.php?id=<?php echo $userId; ?>" class="btn btn-info float-right">Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                      <label for="">Old Password</label>
                      <input type="password" name="old_pass" class="form-control" placeholder="Enter old password">
                    </div>
                    <div class="form-group">
                      <label for="">New Password</label>
                      <input type="password" name="password" class="form-control" placeholder="Enter new password">
                    </div>
                    <input type="submit" name="update" class="btn btn-success" value="Chenge">
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->
<?php include "inc/footer.php"; ?>
