<?php
include_once('./database/operations.php');
$db = new operations();
      
   $deleted='';
 if(isset($_GET['delete'])){
     
     $where =array('id'=>$_GET['user_id']);
  
     if($db->delete("user_table",$where)){
         header("location: user_view.php?deleted=1");
     }
 }
if(isset($_GET['deleted'])){
   $deleted='Entry has been Deleted';
}


if(isset($_GET['updated'])){
    $deleted='Entry has been Updated';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
<?Php include_once('layout/css.php')   ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include_once('layout/header.php')   ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once('layout/left_side_bar.php')   ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User View</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User View</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <?php
                        if ($deleted != '') {
                        ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-check"></i>
                                <?php echo $deleted; ?>
                            </div>
                        <?php
                        }
                     
                        ?>
    
                 
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example_user" class="table table-bordered table-striped">
                  <thead>
                  <tr>

                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Gender</th>
                    <th>Image</th>
                    <th>type</th>
                    <th>Action</th>
                    <th>Delete</th>
                   
                  
                  </tr>
                </thead>
                <tbody>
<?php  
     $serial_no = 1;
  $post_data = $db->select('user_table','result');
    foreach($post_data as $post)
{
   
?>
                  <tr>
                     
                    <td><?php echo $serial_no; ?></td>
                    <td><?php echo $post["name"]; ?></td>
                    <td><?php echo $post["email"]; ?></td>
                    <td><?php echo $post["mobile_no"]; ?> </td>
                    <td><?php echo $post["gender"]; ?></td>
                    <td><img src="<?php echo $post["image"]; ?>" alt="error"></td>
                    <td><?php echo $post["type"]; ?></td>

                    <td>  <a href="user_edit.php?action=edit&id=<?php echo $post["id"]; ?>"name="edit" class="btn btn-success">Edit</a>    </td>
                    <td>  <a href="#"id="<?php echo $post["id"]; ?>" name="delete" class="delete btn btn-danger" >Delete </a>    </td>
                    
                  
                  </tr>
                  
                  <?php
                $serial_no++;
                   
                 } ?>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
        include_once('layout/footer.php')
        ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
        
<!-- jQuery -->
<?php include_once('layout/js.php')   ?>
<!-- Page specific script -->
<script>
   $(function () {
    $("#example_user").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example_user_wrapper .col-md-6:eq(0)');
    // $('#example_user').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });
  });
</script>
<script>
    $(document).ready(function(){
        $('.delete').click(function(){
            var user_id =$(this).attr("id");
           if(confirm('are you sure you want to delete ')){
               window.location ="user_view.php?delete=1&user_id="+user_id+"";
           }else{
               return false;
           }
    });
    });
    </script>
    </body>
</html>