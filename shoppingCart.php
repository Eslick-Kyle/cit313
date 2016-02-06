<?php include 'db.php'; ?>
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

                $stmt = $conn->prepare("SELECT u.id as uId, u.name as uName, s.quantity, i.id, i.name, i.price FROM item i JOIN shoppingcart s ON s.itemid = i.id JOIN user u ON s.userid = u.id");
                $stmt->execute();
                $items = $stmt->fetchAll();
                $output = "<h1>" . $items[0]['uName'] . "'s Shopping Cart</h1>";
                $output .= '<table class="table table-hover"><thead><tr><th>Name</th><th>Price</th><th>Quantity</th></tr></thead>';
                $output .= '<tbody style="cursor:pointer;">';
                $price = 0;
                foreach ($items as $item) {
                    $output .= '<tr><td><a href="item.php?item=' . $item['id'] . '"></a>' . $item['name'] . '</td><td>' . $item['price'] . '</td><td>' . 
                    $item['quantity'] . '</td></tr>';
                    $price += $item['quantity'] * $item['price'];
                }

                
                $output .= '</tbody></table>';
                $output .= '<div style="text-align: right; font-size: 2em;"><b>Total: $' . $price . '</b></div>';
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