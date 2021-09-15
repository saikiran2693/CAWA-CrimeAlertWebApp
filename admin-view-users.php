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

        <?php
        $srno = 1;
        include_once "connection.php";

        $select = "SELECT * FROM `users`";
        $run = mysqli_query($conn, $select);

        if (mysqli_num_rows($run) > 0) {
        ?>
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

                        <?php
                        while ($row = mysqli_fetch_assoc($run)) {
                        ?>
                            <tr class="text-center">
                                <td><?php echo $srno; ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td>
                                    <img src="<?php echo $row['photo']; ?>" style="height: 50px" alt="Photo">
                                </td>
                                <td><?php echo $row['gender'] ?></td>
                                <td class="text-capitalize"><?php echo $row['status'] ?></td>

                                <?php
                                if ($row['status'] == 'active') {
                                ?>
                                    <td colspan="2" class="text-center">
                                        <button onclick="changeStatus('<?php echo $row['email'] ?>','inactive')" type="button" class="btn btn-danger btn-sm">
                                            Block
                                        </button>
                                    </td>
                                <?php
                                }
                                ?>

                                <?php
                                if ($row['status'] == 'inactive') {
                                ?>
                                    <td colspan="2" class="text-center">
                                        <button onclick="changeStatus('<?php echo $row['email'] ?>','active')" type="button" class="btn btn-success btn-sm">
                                            Unblock
                                        </button>
                                    </td>
                                <?php
                                }
                                ?>


                            </tr>
                        <?php
                            $srno++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger">*No Data Found !!</div>
        <?php
        }
        ?>
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

    <script>
        //Change Status
        function changeStatus(email, status) {
            if (confirm("You want to change Status ?")) {
                let request = new XMLHttpRequest();
                let formData = new FormData();

                formData.append("action", "changestatus");
                formData.append("email", email);
                formData.append("status", status);

                request.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        if (this.response === "success") {
                            alert("Status Updated.")
                            window.location.reload();
                        } else {
                            alert("Error Occurred.")
                        }
                    }
                };

                request.open("POST", "script.php", true);
                request.send(formData);
            }
        }
    </script>

</body>

</html>