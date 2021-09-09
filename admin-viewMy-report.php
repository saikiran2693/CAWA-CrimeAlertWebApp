<?php
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Reports</title>

    <?php
    include_once 'linkFiles.php';
    ?>
</head>
<body>

<!-- HEADER-->
<?php include_once "adminheader.php" ?>
<!-- //HEADER-->

<div class="container my-5">
    <h2 class="text-center text-underline mb-3">View Report</h2>

    <!-- Table-->
    <div class="table-responsive">
        <table class="table table-striped border">
            <thead>
            <tr class="text-center text-info">
                <th>#</th>
                <th>Type&nbsp;of&nbsp;Activity</th>
                <th>Type&nbsp;of&nbsp;Crime</th>
                <th>Description</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!-- //Table-->
</div>

<!-- Footer -->
<div class="fixed-bottom">
    <?php include_once "footer.php" ?>
</div>
<!-- Footer -->

</body>
</html>
