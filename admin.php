<?php 
session_start();
if (!$_SESSION['id'] == 1){
    header("LOCATION:store.php");
}
include 'db.php';
$success = false;
if (isset($_POST['name'])
    && isset($_POST['description'])
    && isset($_POST['picture'])
    && isset($_POST['quantity'])
    && isset($_POST['price'])) {
    $stmt = $conn->prepare("INSERT INTO item (name, quantity, picture, description, price) VALUES (:name, :quantity, :picture, :description, :price)");
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':picture', $_POST['picture']);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':description', $_POST['description']);
    $stmt->bindParam(':price', $price, PDO::PARAM_STR);
    $stmt->execute();
    $success = true;
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="js/sortable.js"></script>
    <meta charset="utf-8">
    <title>Kyle Eslick</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/color.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>

<body>
<?php include "nav.php"; ?>

    <div class="container">
        <div class="container tinted round">
            <form action="" method="post">
                <?php 
                if ($success) {
                    echo '<h3>Item Entered</h3>';
                }
                     ?>
                <h1>New item entry</h1>
                Name: <input name="name" type="text"></input><br/>
                Description:<br/><textarea name="description" type="text"></textarea><br/>
                Picture(url): <input name="picture" type="text"></input><br/>
                Quantity: <input name="quantity" type="text"></input><br/>
                Price: <input name="price" type="text"></input><br/>
                <button type="submit">Submit</button>
            </form>
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