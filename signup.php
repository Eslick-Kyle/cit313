<?php 
session_start();

include 'db.php'; 

if (isset($_POST["email"]) && isset($_POST["pass"]) && isset($_POST["name"])) {
    try {
        $stmt = $conn->prepare("INSERT INTO user (name, email, password)
        VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $_POST["name"]);
        $stmt->bindParam(':email', $_POST["email"]);
        $stmt->bindParam(':password', $_POST["pass"]);
        $stmt->execute();
        $_SESSION['id'] = $conn->lastInsertId();
        $_SESSION['name'] = $_POST["name"];
        $_SESSION['email'] = $_POST["email"];
        $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
        header("Location:", $_SESSION['referer']);
    } catch (PDOException $e) {
        echo "<h1 style=\"color: white\">Email already in use</h1>";
    }
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
            <form action="" method="post">
            <fieldset class="form-group">
                <h1>New user</h1>
                <label for="name">Name:</label>
                <input class="form-control" type="text" name="name" id="name"></input>
                <label for="email">Email:</label>
                <input class="form-control" type="text" name="email" id="email"></input>
                <label for="pass">Password:</label>
                <input class="form-control" type="password" name="pass"></input><br/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
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
</body>
</html>