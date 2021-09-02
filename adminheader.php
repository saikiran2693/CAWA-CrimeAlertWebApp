<?php
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin-login.php");
}
?>

<style>
    .user-name {
        color: aquamarine !important;
        text-shadow: 0 0 4px rgba(0,0,0,0.5);
    }
    .user-name:hover {
        text-shadow: 0 0 8px rgba(0,0,0,0.6);
    }
</style>
<!-- HEADER-->
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand" href="index.php">
        <img src="img/logo/logo.jpeg" width="180" height="90" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="text-white nav-link" href="admin-dashboard.php">Home <span
                            class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="admin-view-users.php">Manage User</a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="view-user-reports.php">User Report's</a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="admin-report-crime.php">Report New Crime</a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="admin-viewMy-report.php">My Crime Report</a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="admin-change-password.php">Change Password</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <!--                    <a class="nav-link text-white" href="javascript:void(0);">--><?php //echo $_SESSION['admin_email']; ?><!--</a>-->
                    <a class="nav-link font-weight-bold user-name text-capitalize" href="javascript:void(0);">
                        (<?php echo $_SESSION['admin_username']; ?>)
                    </a>
                </li>
                <li class="nav-item">
                    <a onclick="return confirm('Are you sure to Logout ?')" class="nav-link text-white btn btn-secondary" href="admin_logout.php">Logout</a>
                </li>
            </ul>
        </form>
    </div>
</nav>
<!-- //HEADER-->