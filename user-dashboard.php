<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>

    <style>
        .btn-circle.btn-sm {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            font-size: 8px;
            text-align: center;
        }

        .btn-circle.btn-md {
            width: 50px;
            height: 50px;
            padding: 7px 10px;
            border-radius: 25px;
            font-size: 10px;
            text-align: center;
        }

        .btn-circle.btn-xl {
            width: 120px;
            height: 120px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 20px;
            text-align: center;
        }
    </style>

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<!-- HEADER-->
<?php include_once "userheader.php" ?>
<!-- //HEADER-->

<div class="container my-5 py-5">

    <div class="row">
        <div class="col-lg-9">
            <div class="jumbotron text-center">
                <h2>Welcome User <i class="text-success far fa-smile"></i></h2>
            </div>
        </div>

        <div class="col-lg-3 text-center">
            <!--            <a href="sendEmail.php">-->
            <!--            <form action="sendEmail.php" method="post">-->
            <button type="button" id="btnsendmail" onclick="sendMessage()">
                <img src="img/help-button.png"
                     style="height: 160px;filter: drop-shadow(0 0 7px rgba(0,0,0,0.9));"
                     alt="Panic Button">
            </button>
            <!--            </a>-->
            <!--            </form>-->
        </div>
    </div>
</div>

<div class="fixed-bottom">
    <?php include_once "footer.php" ?>
</div>

<script>
    function sendMessage() {
        document.getElementById('btnsendmail').disabled=true;
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('btnsendmail').disabled=false;
                alert(this.response);
            }
        };
        xhttp.open("GET", "sendEmail.php",true);
        xhttp.send();
    }
</script>
</body>
</html>
