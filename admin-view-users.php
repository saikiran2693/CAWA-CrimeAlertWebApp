<?php
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>

    <?php include_once "linkFiles.php"; ?>
</head>
<body>

<!-- HEADER-->
<?php include_once "adminheader.php" ?>
<!-- //HEADER-->

<div class="container my-5">
    <h2 class="text-center text-underline mb-3">View Users</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th class="text-center" colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td><?php echo $srno; ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td>
                            <img src="<?php echo $row['photo']; ?>" style="height: 50px" alt="Photo">
                        </td>
                        <td><?php echo $row['gender'] ?></td>
                        <td class="text-capitalize"><?php echo $row['status'] ?></td>
                            <td colspan="2" class="text-center">
                                <button onclick="changeStatus('<?php echo $row['email'] ?>','active')" type="button"
                                        class="btn btn-success btn-sm">
                                    Unblock
                                </button>
                            </td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>

<!-- Footer -->
<?php include_once "footer.php" ?>
<!-- Footer -->

<!-- Modal -->
<div class="modal" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center text-info">Status Updated.</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

</body>
</html>
