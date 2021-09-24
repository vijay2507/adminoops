<?php
include_once('database/db.php');
$db = new operations();

if (isset($_POST['submit'])) {

    $db->insertData('$user_table', $_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTEoops | Dashboard</title>

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
                            <h1 class="m-0">Add User</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add user</li>
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
                        <form method="POST">
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>


                                <div class="mb-3 col-md-6">
                                    <label for="confirm-password" class="form-label">Confirm Password</label>
                                    <input type="password" name="confirm-password" class="form-control" id="confirm-password" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="mobile-no" class="form-label">Mobile-No</label>
                                    <input type="text" class="form-control" name="mobile-no" id="mobile-no" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="" class="form-label">Gender</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="option3">
                                        <label class="form-check-label" for="inlineRadio3">Other</label>
                                    </div>

                                </div>
                                <div class="col-md-12 ">
                                    <button type="submit" name="submit" class="btn btn-primary float-right"> Submit</button>
                                </div>
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