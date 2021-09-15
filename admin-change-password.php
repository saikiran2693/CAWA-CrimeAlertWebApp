<?php
@session_start();
include_once "connection.php";
?>

<?php
$errorMsg = $oldpassword = "";

if ((isset($_REQUEST['update']))) {
    $username = $_SESSION['admin_username'];

    $oldpassword = $_REQUEST['oldpassword'];
    $oldpassword = ($oldpassword);

    $newpassword = $_REQUEST['newpassword'];
    $confirmpassword = $_REQUEST['confirmpassword'];

    $select = "SELECT * FROM `admin` WHERE username='$username'";
    $run = mysqli_query($conn, $select);

    if (mysqli_num_rows($run) > 0) {
        $row = mysqli_fetch_assoc($run);

        if ($row['password'] == $oldpassword) {
            if ($newpassword == $confirmpassword) {
                $newpassword = ($newpassword);
                $update = "UPDATE admin SET password='$newpassword' where username='$username'";
                $go = mysqli_query($conn, $update);

                $errorMsg = "success";
                $oldpassword = "";
            } else {
                $errorMsg = "notmatch";
            }
        } else {
            $errorMsg = "invpass";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Change Password</title>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<!-- HEADER-->
<?php include_once "adminheader.php" ?>
<!-- //HEADER-->

<div class="container my-5 py-5 alert-primary border">
    <h2 class="text-center text-underline mb-3">Admin Change Password</h2>

    <!-- SIGNUP-->
    <div class="col-lg-6 offset-lg-3">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="">
                <div class="form-group">
                    <input id="oldpassword" name="oldpassword" type="password" class="form-control"
                           placeholder="Enter Old Password...">

                    <?php
                    if ($errorMsg != "") {
                        if ($errorMsg == "invpass") {
                            ?>
                            <p class="text-danger">*Invalid Current Password !!</p>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="form-group">
                    <input id="newpassword" name="newpassword" type="password" class="form-control"
                           placeholder="Enter New Password...">
                </div>

                <div class="form-group">
                    <input id="confirmpassword" name="confirmpassword" type="password" class="form-control"
                           placeholder="Enter Confirm New Password...">

                    <?php
                    if ($errorMsg != "") {
                        if ($errorMsg == "notmatch") {
                            ?>
                            <p class="text-danger">*New Password & Confirm Password must be same !!</p>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="form-group">
                    <button type="submit" name="update" class="btn btn-primary btn-block">Update Password</button>

                    <?php
                    if ($errorMsg != "") {
                        if ($errorMsg == "success") {
                            ?>
                            <p class="text-success font-weight-bold mt-2">Password Updated.</p>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
    <!-- SIGNUP-->
</div>

<!-- Footer -->
<div class="fixed-bottom">
    <?php include_once "footer.php" ?>
</div>
<!-- Footer -->

</body>
</html>
