<?php
include_once('./database/operations.php');
$db = new operations();




$error_alert = '';
if (isset($_POST['submit'])) {
    extract($_POST);
    $email = $_POST['email'];
    $name = $_POST['name'];
    $mobile_no = $_POST['mobile_no'];
    $password = $_POST['password'];

    // $fields = array('name', 'email', 'mobile_no', 'password', 'gender');
    // $db->insertData('user_table', $fields, $_POST);
    if (!preg_match("/^[a-zA-z]*$/", $name)) {
        $error_alert .= "Enter Valid Name !" . "<br>";
    }
    if (!preg_match('/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/', $email)) {
        $error_alert .= "Enter Valid Email !" . "<br>";
    }
    if ($_POST['password'] != $_POST['confirm_password']) {
        $error_alert .= "Enter Same Password !" . '<br>';
    }

    if (!((strlen($password)) >= 7)) {
        $error_alert .= "Enter minimum 7 Charater Password !" . '<br>';
    }
    if (!preg_match("/^[0-9]*$/", $mobile_no)) {
        $error_alert .= "Enter Valid Mobile Number !" . "<br>";
    }

    $t = time();
    $date = (date("Y-m-d", $t));

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $verify = $db->verify('user_table', 'email', $email);

    if ($verify == 1) {
        $error_alert .= "Email already exists" . "<br>";
    }


    $static = array("created" => $date, "status" => 0, "password" => $hashed_password);


    $fields = array('confirm_password', 'submit');
    if ($error_alert == '') {
        $result_db =  $db->insertData('user_table', $fields, $_POST, $static);
        header("Location: user_add.php?added=1");
    }
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
                        <?php
                        if ($error_alert != '') {
                        ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                <?php echo $error_alert; ?>
                            </div>
                        <?php
                        }
                        if (isset($_GET['added'])) {
                        ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-check"></i>
                                Entry has been Submitted
                            </div>
                        <?php
                        }

                        ?>

                        <form action="/adminlteoops/user_add.php" method="POST">
                            <div class="row">

                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="<?php echo isset($name) ? $name : ''; ?>" aria-describedby="nameHelp">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" name="email" class="form-control" id="email" value="<?php echo isset($email) ? $email : ''; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" value="<?php echo isset($password) ? $password : ''; ?>">
                                </div>


                                <div class="mb-3 col-md-6">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" value="<?php echo isset($Confirm_password) ? $Confirm_password : ''; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="mobile_no" class="form-label">Mobile-No</label>
                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no" value="<?php echo isset($mobile_no) ? $mobile_no : ''; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="type" class="form-label">User Type</label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="">Select</option>
                                        <option value="admin">Admin</option>
                                        <option value="sub_admin">Sub-Admin</option>
                                        <option value="User">User</option>

                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image" id="image" value="<?php echo isset($user_image) ? $user_image : ''; ?>">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="" class="form-label">Gender</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male">
                                        <label class="form-check-label" for="inlineRadio1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female">
                                        <label class="form-check-label" for="inlineRadio2">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="Other">
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