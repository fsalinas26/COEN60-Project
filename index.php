<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="index.js"></script>
    </head>
    <body>
        <div id="header">
            <a href="index.php"><img id="logo" src="./images/scu_logo.png"></a>
            <h1 id="title_text">Senior Design Projects</h1>
        </div>
        <div class="navbar">
            <div class="nav">
                <a href="about.php">ABOUT</a>
                <a href="index.php">PROJECTS</a>
                <a href="professors.php">PROFESSORS</a>
            </div>
        </div>
        <div id="main">
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
                        if (isset($item["advisor"]) && $item["advisor"] == $advisor) {
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
                        echo '<div class="info-item box">';
                            echo '<a target="_blank" class="box" href='.$item["url"].'>';
                            echo "<h1>".$item["title"]." - ".$item["year"]."</h1>";

                            echo "<h2>";
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
                            echo "</h2>";
                            echo "<h3><b>Advisor(s): </b>";
                            if (gettype($item["advisor"]) == "array") {
                                for ($i = 0; $i < count($item["advisor"]); $i++) {
                                    echo $item["advisor"][$i];
                                    if ($i != count($item["advisor"]) - 1) {
                                        echo ", ";
                                    }
                                }
                                echo "</h3>";
                            }
                            else {
                                echo $item["advisor"]."</h2>";
                            }
                            if (strlen($item["abstract"]) > 500)
                                echo '<div class="description"<b>Abstract: </b>'.substr($item["abstract"], 0, 500).'...</div>';
                            else {
                                echo '<div class="description"<b>Abstract: </b>'.$item["abstract"].'</div>';
                            }
                            echo "</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                }
            ?>
        </div>
        <div class="container">
            <div class="box filter" id="filter-width">
                <h1 style="text-align: center;margin:10px;";>Filter Projects</h1>
                <div class="options">
                    <div class="option">
                    <h1>Year</h1>
                    <button id="all_years" onclick="load_data(`year`, ``)" class="btn">All</button>
                    <button id="2019" onclick="load_data(`year`, `2019`)" class="btn">2019</button>
                    <button id="2020" onclick="load_data(`year`, `2020`)" class="btn">2020</button>
                    <button id="2021" onclick="load_data(`year`, `2021`)" class="btn">2021</button>
                    <button id="2022" onclick="load_data(`year`, `2022`)" class="btn">2022</button>
                    </div>

                    <div class="option">
                        <h1>Major</h1>
                        <button id="all_majors" onclick="load_data(`major`, ``)" class="btn">All</button>
                        <button id="BIOE" onclick="load_data(`major`, `BIOE`)" class="btn">BIOE</button>
                        <button id="CENG" onclick="load_data(`major`, `CENG`)" class="btn">CENG</button>
                        <button id="COEN" onclick="load_data(`major`, `COEN`)" class="btn">COEN</button>
                        <button id="ECEN" onclick="load_data(`major`, `ECEN`)" class="btn">ECEN</button>
                        <button id="ELEN" onclick="load_data(`major`, `ELEN`)" class="btn">ELEN</button>
                        <button id="ENGR" onclick="load_data(`major`, `ENGR`)" class="btn">ENGR</button>
                        <button id="MECH" onclick="load_data(`major`, `MECH`)" class="btn">MECH</button>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    window.onload = get_url;
    function get_url() {
        get_url_params(window.location.search);
    }
</script>