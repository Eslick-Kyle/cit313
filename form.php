<?php
session_start();
if (isset($_SESSION["submit"])) {
    header('Location: response.php');
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
            <h1>Computer Information</h1>
            <form action="response.php" method="post" id="myForm" name="myForm">
                <label>Processor brand:</label>
                <div class="radio">
                    <label>    
                        <input type="radio" name="processor" value="AMD"> AMD
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="processor" value="Intel"> Intel
                    </label>
                </div>

                <div class="form-group">
                    <label for="speedInput">Processor Speed (GHz)</label>
                    <input type="text" id="speedInput" name="processorSpeed" class="form-control">
                </div>

                <label for="ramInput">Ram:</label>
                <select name="ram" id="ramInput" class="form-control">
                    <option value="2">2 GB</option>
                    <option value="4">4 GB</option>
                    <option value="6">6 GB</option>
                    <option value="8" selected>8 GB</option>
                    <option value="12">12 GB</option>
                    <option value="16">16 GB</option>
                    <option value="32">32 GB</option>
                    <option value="64">64 GB</option>
                </select>

                <label>Video Card brand:</label>
                <div class="radio">
                    <label>    
                        <input type="radio" name="videoCard" value="AMD"> AMD
                    </label>
                </div>
                <div class="radio">
                    <label>    
                        <input type="radio" name="videoCard" value="Nvidia"> Nvidia
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="videoCard" value="Intel"> Intel
                    </label>
                </div>

                <label for="usesInput">What do you use your computer for?</label>
                <div class="form-group">
                    <input type="checkbox" name="uses[]" value="Games"> Games<br/>
                    <input type="checkbox" name="uses[]" value="Video Processing"> Video Processing<br/>
                    <input type="checkbox" name="uses[]" value="Web/Cat Videos"> Web/Cat Videos<br/>
                    <input type="checkbox" name="uses[]" value="Other"> Other<br/>
                </div>

                <div class="form-group" id="submit">
                    <button type="submit" class="btn btn-default" >Submit</button>
                    <a href="response.php" class="btn btn-default" >View Results</a>
                </div>
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