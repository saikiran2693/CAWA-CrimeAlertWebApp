<?php
@session_start();
$username = $password = $errorMsg = "";

if (isset($_REQUEST['login'])) {
    include "connection.php";

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $password = md5($password);

    $select = "SELECT * FROM `admin` WHERE username='$username'";
    $run = mysqli_query($conn, $select);
    if (mysqli_num_rows($run) > 0) {
        $row = mysqli_fetch_assoc($run);

        if ($row['password'] === $password) {
            $_SESSION['admin_username'] = $row['username'];
            $_SESSION['admin_email'] = $username;
            header("Location: admin-dashboard.php");
        } else {
            $errorMsg = "Password";
        }
    } else {
        $errorMsg = "Username";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <style>
        .error {
            color: red !important;
        }
    </style>

    <?php
    include_once 'linkFiles.php';
    ?>
</head>
<body>

<!-- HEADER-->
<?php include "publicheader.php"; ?>
<!-- //HEADER-->

<div class="container my-5 py-5 alert-primary border">
    <h2 class="text-center text-underline mb-3">Admin Login</h2>

    <!-- LOGIN-->
    <div class="col-lg-6 offset-lg-3">
        <form action="" method="post" class="form-validation">
            <div class="form-group">
                <input name="username" id="username" data-rule-required="true" type="text"
                       value="<?php echo $username; ?>" class="form-control" placeholder="Enter Username...">

                <?php
                if ($errorMsg != "") {
                    if ($errorMsg == "Username") {
                        ?>
                        <p class="text-danger">Invalid Username !!</p>
                        <?php
                    }
                }
                ?>
            </div>

            <div class="form-group">
                <input name="password" id="password" data-rule-required="true" type="password"
                       class="form-control" placeholder="Enter Password...">

                <?php
                if ($errorMsg != "") {
                    if ($errorMsg == "Password") {
                        ?>
                        <p class="text-danger">Invalid Password !!</p>
                        <?php
                    }
                }
                ?>
            </div>

            <div class="form-group text-center">
                <button type="submit" name="login" class="btn btn-primary">
                    Login
                </button>
            </div>
        </form>
    </div>
    <!-- //LOGIN-->
</div>

<!-- Footer -->
<div class="fixed-bottom">
    <?php include "footer.php"; ?>
</div>
<!-- Footer -->

<script>
    $(document).ready(function () {
        $(".form-validation").validate();
    });
</script>

</body>
</html>
