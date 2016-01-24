<?php
session_start();

$processor = $processorSpeed = $ram = $videoCard = $uses = "";
if( isset($_POST["processor"]) &&
    isset($_POST["processorSpeed"]) &&
    isset($_POST["ram"]) &&
    isset($_POST["videoCard"]) &&
    isset($_POST["uses"])) {
        $_SESSION["submit"] = true;
        $processor = $_POST["processor"];
        $processorSpeed = $_POST["processorSpeed"];
        $ram = $_POST["ram"];
        $videoCard = $_POST["videoCard"];
        $uses = $_POST["uses"];
        $arr = array('processor' => $processor,
                    'processorSpeed' => $processorSpeed,
                    'ram' => $ram,
                    'videoCard' => $videoCard,
                    'uses' => $uses);
        write($arr);
}

function read(){
    return file_get_contents("results.txt");
}
function write($arr){

    $read = json_decode(read(), true); 

    $arrkey = array_keys($arr);
    foreach ($arrkey as $temp) {
        if (is_array($arr[$temp])) {
            print_r($arr[$temp]);
            foreach ($arr[$temp] as $value) {
                $read[$temp][$value] += 1;
            }
        } else {
            if (array_key_exists($arr[$temp], $read[$temp])){
                $read[$temp][$arr[$temp]] += 1;
            }
        }
    }

    if (!array_key_exists($arr['processorSpeed'], $read['processorSpeed'])){
        $read['processorSpeed'] += array($arr['processorSpeed'] => 1);
    }
    file_put_contents("results.txt", json_encode($read));
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
    <script type="text/javascript" src="css/canvasjs-1.8.0/canvasjs.min.js"></script>
    <script type="text/javascript">
        window.onload = function () {
            var text = "<?php echo addslashes(read()); ?>";
            var info = JSON.parse(text);
            var chart = new CanvasJS.Chart("processor",
            {
              title:{
                text: "Processor Brand"    
            },
            data: [

            {        
                type: "column",  
                showInLegend: true, 
                legendMarkerType: "none",
                legendText: "# of processors by brand",
                dataPoints: [      
                { x: 1, y: info["processor"]["AMD"], label: "AMD"},
                { x: 2, y: info["processor"]["Intel"],  label: "Intel" }
                ]
            }
            ]
        });


            chart.render();

            var chart = new CanvasJS.Chart("ram",
            {
                title:{
                    text: "Ram"
                },
                legend: {
                    maxWidth: 350,
                    itemWidth: 120
                },
                data: [
                {
                    type: "pie",
                    showInLegend: true,
                    legendText: "{indexLabel}",
                    dataPoints: [
                    { y: info["ram"][2], indexLabel: "2 GB" },
                    { y: info["ram"][4], indexLabel: "4 GB" },
                    { y: info["ram"][6], indexLabel: "6 GB" },
                    { y: info["ram"][8], indexLabel: "8 GB" },
                    { y: info["ram"][12], indexLabel: "12 GB" },
                    { y: info["ram"][16], indexLabel: "16 GB" },
                    { y: info["ram"][32], indexLabel: "32 GB" },
                    { y: info["ram"][64], indexLabel: "64 GB" }

                    ]
                }
                ]
            });
            chart.render();

            var chart = new CanvasJS.Chart("videoCard",
            {
                title:{
                    text: "Video Card Brand"
                },
                legend: {
                    maxWidth: 350,
                    itemWidth: 120
                },
                data: [
                {
                    type: "pie",
                    showInLegend: true,
                    legendText: "{indexLabel}",
                    dataPoints: [
                    { y: info["videoCard"]["AMD"], indexLabel: "AMD" },
                    { y: info["videoCard"]["Nvidia"], indexLabel: "Nvidia" },
                    { y: info["videoCard"]["Intel"], indexLabel: "Intel" }

                    ]
                }
                ]
            });
            chart.render();

            var chart = new CanvasJS.Chart("uses",
            {
              title:{
                text: "Uses"    
            },
            data: [

            {        
                type: "column",  
                showInLegend: true, 
                legendMarkerType: "none",
                legendText: "# of uses",
                dataPoints: [      
                { x: 1, y: info["uses"]["Games"], label: "Games"},
                { x: 2, y: info["uses"]["Video Processing"],  label: "Video Processing" },
                { x: 3, y: info["uses"]["Web/Cat Videos"], label: "Web/Cat Videos"},
                { x: 4, y: info["uses"]["Other"], label: "Other"}
                ]
            }
            ]
        });

            chart.render();
        }
    </script>

</head>

<body>

    <div class="container">
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
                    <a class="navbar-brand" href="#">Project: Store</a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.html">Home</a></li>
                        <li class="active"><a href="homework.html">Homework</a></li>
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
                    <!--
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#">Default <span class="sr-only">(current)</span></a></li>
                        <li><a href="../navbar-static-top/">Static top</a></li>
                        <li><a href="../navbar-fixed-top/">Fixed top</a></li>
                    </ul> -->
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>
    </div> <!-- /container -->

    <div class="container">
        <div class="container tinted round">
            <?php
                if (isset($_POST["processor"]) &&
                    isset($_POST["processorSpeed"]) &&
                    isset($_POST["ram"]) &&
                    isset($_POST["videoCard"]) &&
                    isset($_POST["uses"])) {
                    echo "<p class=\"text-center\">Thank you for sending your computer's information</p>";
                }
                else if ($_SESSION["submit"]) {
                    echo "<p class=\"text-center\">You have already submitted a form.</p>";
                }
            ?>
            <h1>Results</h1>
            <div id="processor" style="height: 300px; width: 100%;"></div>
            <div id="processorSpeed">
                <?php 
                    $temp = json_decode(read(), true);
                    $temp = $temp["processorSpeed"];
                    arsort($temp);
                    $keys = array_keys($temp);
                    $count = 0;
                    echo "<h3>Top Processor Speeds</h3>";
                    echo "<table class=\"table table-striped\"><tr><th>Number</th><th>Speed</th><th>Count</th></tr>";

                    foreach ($keys as $key) {
                        $count++;
                        echo "<tr><td>#" . $count . "</td><td>" . $key . " GHz</td><td>" . $temp[$key] . "</td></tr>";
                        if ($count > 10) {
                            break;
                        }
                    }
                    echo "</table>";
    
                ?>
            </div>
            <div id="ram" style="height: 300px; width: 100%;"></div>
            <div id="videoCard" style="height: 300px; width: 100%;"></div>
            <div id="uses" style="height: 300px; width: 100%;"></div>
            <?php


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
</body>
</html>