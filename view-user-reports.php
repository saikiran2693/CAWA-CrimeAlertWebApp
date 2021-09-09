<?php
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Report's</title>

    <?php include_once "linkFiles.php"; ?>

    <style>
        .date-time {
            min-width: 130px;
        }
    </style>
</head>
<body>

<!-- HEADER-->
<?php include_once "adminheader.php" ?>
<!-- //HEADER-->

<div class="container-fluid my-5">
    <h2 class="text-center text-underline mb-3">View Crime Alerts</h2>
        <!-- Table-->
        <div class="table-responsive">
            <table class="table table-striped border">
                <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Email</th>
                    <th>Type&nbsp;of&nbsp;Activity</th>
                    <th>Type&nbsp;of&nbsp;Crime</th>
                    <th>Description</th>
                    <th class="date-time">Date</th>
                    <th class="date-time">Time</th>
                    <th>Status</th>
                    <th class="text-center" colspan="2">Action</th>
                </tr>
                </thead>

            </table>
        </div>
</div>
</body>
</html>


<!-- Footer -->
<div class="">
    <?php include_once "footer.php" ?>
</div>
<!-- Footer -->

</body>
</html>
