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
           <?php 
            try {
                include 'db.php';

                $stmt = $conn->prepare("SELECT * FROM item");
                $stmt->execute();
                $items = $stmt->fetchAll();
                $output = '<table class="table table-hover"><thead><tr><th>Name</th><th>price</th></tr></thead><tbody style="cursor:pointer;">';
                foreach ($items as $item) {
                    $output .= '<tr><td><a href="item.php?item=' . $item['id'] . '"></a>' . $item['name'] . '</td><td>' . $item['price'] . '</td></tr>';
                }
                $output .= '</tbody></table>';
                echo $output;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
           ?>
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
    <script>
    $("tbody tr").click(function() {
        window.location.href = $(this).find("a").attr("href");
    });
    </script>
</body>
</html>