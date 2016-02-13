<?php 
session_start();
if(!isset($_SESSION['id'])) {
    header("Location: login.php");
}
include 'db.php'; 

if (isset($_GET["item"])) {
    $stmt = $conn->prepare("SELECT * from shoppingcart WHERE userId = :userId AND itemId = :itemId");
    $stmt->bindParam(":userId", $_SESSION["id"]);
    $stmt->bindParam(":itemId", $_GET["item"]);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        $stmt = $conn->prepare("INSERT INTO shoppingcart (itemId, userId, quantity)
        VALUES (
          (SELECT id FROM item WHERE id = :itemId)
        , :userId
        , 1 )");
        $stmt->bindParam(":userId", $_SESSION["id"]);
        $stmt->bindParam(":itemId", $_GET["item"]);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("UPDATE shoppingcart SET quantity = quantity + 1 WHERE userId = :userId AND itemId = :itemId");
        $stmt->bindParam(":userId", $_SESSION["id"]);
        $stmt->bindParam(":itemId", $_GET["item"]);
        $stmt->execute();
    }
}

if (isset($_GET['remove'])) {
    $stmt = $conn->prepare("DELETE from shoppingcart WHERE userId = :userId AND itemId = :itemId");
    $stmt->bindParam(":userId", $_SESSION["id"]);
    $stmt->bindParam(":itemId", $_GET["remove"]);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Kyle Eslick</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/color.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <script type="text/javascript">

    </script>
</head>

<body>
<?php include "nav.php"; ?>

    <div class="container">
        <div class="container tinted round">
           <?php 
            try {

                $stmt = $conn->prepare("SELECT u.id as uId, u.name as uName, s.quantity, i.id, i.name, i.price FROM item i JOIN shoppingcart s ON s.itemid = i.id JOIN user u ON s.userid = u.id WHERE u.id = :id");
                $stmt->bindParam(':id', $_SESSION["id"]);
                $stmt->execute();
                $items = $stmt->fetchAll();
                if ($stmt->rowCount() == 0) {
                    echo "<h1>" . $_SESSION['name'] . "'s Shopping Cart</h1><h3>There is nothing here!";
                } else {
                $output = "<h1>" . $items[0]['uName'] . "'s Shopping Cart</h1>";
                $output .= '<table class="table table-hover"><thead><tr><th>Name</th><th>Price</th><th>Quantity</th></tr></thead>';
                $output .= '<tbody>';
                $price = 0;
                foreach ($items as $item) {
                    $output .= '<tr><td id="item" style="cursor:pointer;"><a href="item.php?item=' . $item['id'] . '"></a>' . $item['name'] . '</td><td>$' . $item['price'] . '</td><td>' . $item['quantity']
                     . '</td><td><a href="shoppingCart.php?remove=' . $item['id']. '" class="btn btn-primary">Remove</a></td></tr>' . "\n";
                    $price += $item['quantity'] * $item['price'];
                }

                
                $output .= '</tbody></table>';
                $output .= '<div style="text-align: right; font-size: 2em;"><b>Total: $' . $price . '</b></div>';
                echo $output;
            }
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
    $("#item").click(function() {
        window.location.href = $(this).find("a").attr("href");
    });
    </script>
</body>
</html>