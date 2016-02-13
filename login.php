<?php 
session_start();

include 'db.php'; 

if (isset($_POST["email"]) && isset($_POST["pass"])) {
    try {
        $stmt = $conn->prepare("SELECT id, name, email FROM user WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $_POST["email"]);
        $stmt->bindParam(':password', $_POST["pass"]);
        $stmt->execute();
        $id = $stmt->fetch();
        $_SESSION['id'] = $id["id"];
        $_SESSION['name'] = $id["name"];
        $_SESSION['email'] = $id["email"];
        $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
        header("Location:", $_SESSION['referer']);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
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
                <label for="email">Email:</label>
                <input class="form-control" type="text" name="email" id="email"></input>
                <label for="pass">Password:</label>
                <input class="form-control" type="password" name="pass"></input><br/>
                <a href="signup.php">Create new account</a><br/>
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