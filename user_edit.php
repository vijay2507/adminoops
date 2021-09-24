<?php
include_once('./database/operations.php');
$db = new operations();

if (isset($_GET['action'])) {
    if (isset($_GET['id'])) {
        $where = array(
            'id' => $_GET['id'],
            'status' => 0,
            'deleted' => 0

        );
        $single_data =  $db->select('user_table', 'row', $where);
        // extract($single_data);
    }
}


if (isset($_POST['update'])) {
    $update_data = array(
        'name' =>  $_POST['name'],
        'email' =>  $_POST['email'],
        'mobile_no' =>  $_POST['mobile_no']
    );

    $where_condition = array(
        'id' => $_POST['id'],

    );

    $db->update('user_table', $update_data, $where_condition);
    header("location:user_view.php?updated=1");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTEoops | User Edit</title>

    <?php
    include_once('layout/css.php');

    ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>



        <?php
        include_once('layout/header.php')
        ?>
        <?php
        include_once('layout/left_side_bar.php')
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">User Edit</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User Edit</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

            <section class="content bg-light">
                <div class="container-fluid">

                    <div class="container">

                        <form action="" method="POST">
                            <div class="row">
                                <?php




                                ?>


                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="<?php echo isset($single_data['name']) ? $single_data['name'] : ''; ?>" aria-describedby="nameHelp">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" name="email" class="form-control" id="email" value="<?php echo isset($single_data['email'])  ? $single_data['email'] : ''; ?>">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="mobile_no" class="form-label">Mobile-No</label>
                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no" value="<?php echo isset($single_data['mobile_no']) ? $single_data['mobile_no'] : ''; ?>">
                                </div>
                                <div class="mb-3 col-md-6">

                                    <input type="hidden" name="id" class="form-control" id="id" value="<?php echo isset($single_data['id'])  ? $single_data['id'] : ''; ?>" aria-describedby="idHelp">
                                </div>

                                <div class="col-md-12 ">
                                    <button type="submit" name="update" class="btn btn-primary float-right"> Update</button>
                                </div>

                                <?php


                                ?>
                            </div>
                        </form>

                    </div><!-- /.container-fluid -->

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

    <?php
    include_once('layout/js.php')
    ?>

</body>

</html>