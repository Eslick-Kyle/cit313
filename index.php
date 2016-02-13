<?php 
session_start();
include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Kyle Eslick</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/color.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <script type="text/javascript">
    function hello () {
        alert("That's me!");
    }
    </script>
</head>

<body>
<?php include "nav.php"; ?>

    <div class="container">
        <div class="container tinted round">
            <div class="row">
                <div class="col-sm-8">
                    <h1>Kyle Eslick</h1>
                    <p class="lead">Software Engineer in his last semester of college at Brigham Young University Idaho.</p>
                </div>
                <div class="col-sm-4">
                    <img src="images/kyle.jpg" onclick="hello()">
                </div>
            </div>
        </div>

        <footer class="footer">
            <p>&copy; Kyle Eslick</p>
        </footer>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>