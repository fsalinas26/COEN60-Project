<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div id="header">
            <a href="index.php"><img id="logo" src="./images/scu_logo.png"></a>
            <h1 id="title_text">Senior Design Projects</h1>
        </div>
        <div class="navbar">
            <a href="about.php">ABOUT</a>
            <a href="index.php">PROJECTS</a>
            <a href="professors.php">PROFESSORS</a>
        </div>
        <div id="main">
            <div id="filter">
            </div>
            <?php
                $json = file_get_contents("./data.json");
                $data = json_decode($json,true);
                $data_temp = [];

                if(isset($_GET['year'])) {
                    $year = $_GET['year'];
                    foreach ($data as $item) {
                        if ($item["year"] == $year) {
                            array_push($data_temp, $item);
                        }
                    }
                    $data = $data_temp;
                    $data_temp = [];
                }

                if(isset($_GET['advisor'])) {
                    $advisor = $_GET['advisor'];
                    foreach ($data as $item) {
                        if ($item["advisor"] == $advisor) {
                            array_push($data_temp, $item);
                        }
                    }
                    $data = $data_temp;
                    $data_temp = [];
                }

                if(isset($_GET['major'])) {
                    $major = $_GET['major'];
                    foreach ($data as $item) {
                        if (str_contains($item["major"], $major)) {
                            array_push($data_temp, $item);
                        }
                    }
                    $data = $data_temp;
                    $data_temp = [];
                }
                if (empty($data)) {
                    echo '<div id="empty-display"><div id="empty-text"><h1> No Results </h1></div></div>';
                }
                else {
                    echo '<div id="info">';
                    foreach ($data as $item) {
                        echo '<div class="info-item">';
                        echo "<h3>".$item["title"]." - ";

                        if (gettype($item["major"]) == "array") {
                            for ($i = 0; $i < count($item["major"]); $i++) {
                                echo $item["major"][$i];
                                if ($i != count($item["major"]) - 1) {
                                    echo ", ";
                                }
                            }
                        }
                        else {
                            echo $item["major"];
                        }
                        echo " - ".$item["year"]."</h3>";
                        echo "<p><b>Advisors: </b>";
                        if (gettype($item["advisor"]) == "array") {
                            echo "<h4>";
                            for ($i = 0; $i < count($item["advisor"]); $i++) {
                                echo $item["advisor"][$i];
                                if ($i != count($item["advisor"]) - 1) {
                                    echo ", ";
                                }
                            }
                            echo "</h4>";
                        }
                        else {
                            echo $item["advisor"]."</p>";
                        }
                        if (strlen($item["abstract"]) > 100)
                            echo "<p><b>Abstract: </b>".substr($item["abstract"], 0, 500)."...</p>";
                        else {
                            echo "<p><b>Abstract: </b>".$item["abstract"]."</p>";
                        }
                        echo "<a href=".$item["url"].">Link to Project PDF</a><br><br>";
                        echo "</div>";
                    }
                    echo "</div>";
                }
            ?>
        </div>
        <div class="container">
            <div class="box">
            </div>
            <div class="box">
            </div>
            <div class="box">
            </div>
        </div>
    </body>
</html>