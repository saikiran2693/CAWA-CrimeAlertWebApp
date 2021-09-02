<!-- HEADER-->
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['EmailUser'])) {
    header('location:user-login.php');
}
?>
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
                <a class="text-white nav-link" href="user-dashboard.php">Home <span
                            class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="manage-email.php">Manage Email</a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="crime-report.php">Report New Crime</a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="view-my-report.php">My Crime Reports</a>
            </li>

            <li class="nav-item">
                <a class="text-white nav-link" href="user-profile.php">My Profile</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="javascript:void(0);"><?php echo $_SESSION['EmailUser']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn btn-secondary" href="userlogout.php">Logout</a>
                </li>
            </ul>
        </form>
    </div>
</nav>
<!-- //HEADER-->
