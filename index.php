<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
    <div class="header">
            <a href="index.php"><img id="logo" src="./images/scu_logo.png"></a>
            <h1 id="title_text">Senior Design Projects</h1>
        </div>
        <div class="navbar">
            <a href="about.php">ABOUT</a>
            <div class="dropdown">
                <button class="dropbtn">PROJECTS
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="search.php">Bioengineering</a>
                    <a href="search.php">Civil Engineering</a>
                    <a href="search.php">Computer Engineering</a>
                    <a href="search.php">More...</a>
                </div>
            </div> 
            <a href="professors.php">PROFESSORS</a>
        </div>
        <?php
            $json = file_get_contents("./data.json");
            $json_data = json_decode($json,true);

            foreach ($json_data as $item) {
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
                if ()
                echo "<p><b>Abstract: </b>".$item["abstract"]."</p>";
                echo "<a href=".$item["url"].">Link to Project PDF</a><br><br>";
            }
        ?>
    </body>
</html>