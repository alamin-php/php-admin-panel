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
                <h3 class="card-title">All Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Serial</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i=0;
                      $result = $user->readAllUser();
                      if($result){
                        foreach($result as $value){
                          $i++;
                    ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value["name"]; ?></td>
                    <td><?php echo $value["username"]; ?></td>
                    <td><?php echo $value["email"]; ?></td>
                    <td><?php echo ucfirst($value["role"]); ?></td>
                    <td><?php echo $value["status"] == 1 ? "<strong class='text-success'>Active</strong>" : "<strong class='text-danger'>Deactive</strong>";?></td>
                    <td>
                        <a href="view_user.php?action=view&id=<?php echo $value['id'] ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>                  
                  <?php } } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Serial</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
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
