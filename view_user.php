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
    if(isset($_GET['id'])){
        $userId = $_GET['id'];
    }
if(isset($_POST["update"])){
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["update"]){
       $roleChange = $user->changeRoleStatus($userId, $_POST);
    }
}

if(isset($_POST["updateProfile"])){
    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["updateProfile"]){
       $profileUpdate = $user->updateUserProfile($userId, $_POST);
    }
}


    $result = $user->getUserById($userId);
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Profile </h3>
                <a href="users.php" class="btn btn-info float-right">Back</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php 
                    if(isset($roleChange)){
                        echo $roleChange;
                    } 
                    if(isset($profileUpdate)){
                        echo $profileUpdate;
                    }
                ?>
                  <?php  if($result) {?>
               <form action="" method="post">
                   <div class="form-group">
                     <label for="">Full Name</label>
                     <input type="text" name="name" class="form-control" value="<?php echo $result->name; ?>">
                   </div>
                   <div class="form-group">
                     <label for="">Username</label>
                     <input type="text" name="username" class="form-control" value="<?php echo $result->username; ?>">
                   </div>
                   <div class="form-group">
                     <label for="">Email</label>
                     <input type="text" name="email" class="form-control" value="<?php echo $result->email; ?>">
                   </div>
                   <?php 
                    $userRole = Session::get('role');

                    if(!empty($userRole) && "admin" == $userRole){
                        if(Session::get("id") == $userId){

                        }else{
                        ?>
                   <div class="form-group">
                     <label for="">Role: </label>
                     <input type="radio" name="role" value="user" <?php echo $result->role == "user" ? "checked" : "" ?>> User
                     <input type="radio" name="role" value="admin" <?php echo $result->role == "admin" ? "checked" : "" ?>> Admin
                   </div>
                   <div class="form-group">
                     <label for="">Status: </label>
                     <input type="radio" name="status" value="0" <?php echo $result->status == 0 ? "checked" : "" ?>> Deactive
                     <input type="radio" name="status" value="1" <?php echo $result->status == 1 ? "checked" : "" ?>> Active
                   </div>
                        <input type="submit" name="update" class="btn btn-success" value="Change role & status">
                        
                        <?php
                    }}
                    ?>
                   <?php if(Session::get('id') == $userId) : ?>
                    <input type="submit" name="updateProfile" class="btn btn-primary" value="Update Profile">
                   <a href="changepass.php?action=changepass&id=<?php echo $result->id; ?>" class="btn btn-info">Change Password</a>
                   <?php endif; ?>
               </form>
               <?php } ?>
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
