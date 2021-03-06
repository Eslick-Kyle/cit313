<?php
try {
    $stmt = $conn->prepare("SELECT s.quantity FROM item i JOIN shoppingcart s ON s.itemid = i.id JOIN user u ON s.userid = u.id WHERE u.id = :id");
    $stmt->bindParam(':id', $_SESSION["id"]);
    $stmt->execute();
    $count = $stmt->fetchAll();
    $quantity = 0;
    foreach ($count as $c) {
        $quantity += $c['quantity'];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} 
?>
    <div style="width: 100%; " class="container">
        <!-- Static navbar -->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="store.php">Project: Store</a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="homework.php">Homework</a></li>
                        <!--<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="#">Separated link</a></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>-->
                    </ul> 
                    <?php if (isset($_SESSION['id'])): ?>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="logout.php">logout?</a></li>
                        <li><a href="shoppingCart.php">Shopping Cart
                        <?php 
                        if ($quantity > 0)
                        {
                            echo " [$quantity]";
                        }

                        ?>
                        </a></li>
                    <?php else: ?>
                        <ul class="nav navbar-nav navbar-right">
                        <li><a href="login.php">Login</a></li>
                    <?php endif; ?>
                    <!--    <li><a href="../navbar-static-top/">Static top</a></li>
                        <li><a href="../navbar-fixed-top/">Fixed top</a></li> -->
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>
    </div> <!-- /container -->
