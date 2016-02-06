<?php
if (isset($_GET['item'])){
    try {
        include 'db.php';

        $stmt = $conn->prepare("SELECT * FROM item WHERE id = :id");
        $id = $_GET['item'];
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $item = $stmt->fetch();
        if ($stmt->rowCount() == 0){
            header('Location: store.php');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header('Location: store.php');
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
</head>

<body>
<?php include "nav.php"; ?>

    <div class="container">
        <div class="container tinted round">
           <?php 

           ?>
            <div class="row">
                <div class="col-sm-4">
                    <img style="max-width: 350px;" src="<?php echo $item['picture']; ?>">
                </div>
                <div class="col-sm-8">
                    
                    <h1><?php echo $item['name']; ?></h1>
                    <p class="lead">Price: $<?php echo $item['price']; ?> <button>Add to Cart</button></p>
                    <p><?php echo $item['description']; ?></p>
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