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
                <button class="dropbtn">YEARS
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="search.php">2022</a>
                    <a href="search.php">2021</a>
                    <a href="search.php">2020</a>
                    <a href="search.php">More...</a>
                </div>
            </div> 
            <div class="dropdown">
                <button class="dropbtn">MAJORS
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="search.php">Bioengineering</a>
                    <a href="search.php">Civil Engineering</a>
                    <a href="search.php">Computer Engineering</a>
                    <a href="search.php">More...</a>
                </div>
            </div> 
            <div class="dropdown">
                <button class="dropbtn">PROFESSORS 
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="search.php">Link 1</a>
                    <a href="search.php">Link 2</a>
                    <a href="search.php">Link 3</a>
                    <a href="search.php">More...</a>
                </div>
            </div> 
        </div>
        <?php
            $json = file_get_contents("./data.json");
            $json_data = json_decode($json,true);

            foreach ($json_data as $item) {
                echo $item["title"]." - ";

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
                echo " - ".$item["year"]."<br>";
                if (gettype($item["advisor"]) == "array") {
                    for ($i = 0; $i < count($item["advisor"]); $i++) {
                        echo $item["advisor"][$i];
                        if ($i != count($item["advisor"]) - 1) {
                            echo ", ";
                        }
                    }
                    echo "<br>";
                }
                else {
                    echo $item["advisor"]."<br>";
                }
                echo $item["url"]."<br>";
                echo $item["abstract"]."<br>";
                echo "<br>";
            }
        ?>
    </body>
</html>