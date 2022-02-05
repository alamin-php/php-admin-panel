<?php 
  $filepath = realpath(dirname(__FILE__));
  include $filepath.'/inc/header.php';
  include $filepath.'/inc/sidebar.php';
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
                  <tr>
                    <td>1</td>
                    <td>Al Amin</td>
                    <td>alamin</td>
                    <td>alamin@gmail.com</td>
                    <td>Admin</td>
                    <td>Active</td>
                    <td>
                        <a href="#" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>                  
                  <tr>
                    <td>2</td>
                    <td>User</td>
                    <td>user</td>
                    <td>user@gmail.com</td>
                    <td>User</td>
                    <td>Deactive</td>
                    <td>
                        <a href="#" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        <a href="#" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
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
<?php 
  include $filepath.'/inc/footer.php';
?>
