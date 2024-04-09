<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROTOTYPE 3</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="search">
            <form action="" method="get" id="searchForm">
                <input type="text" id="city1" name="city" placeholder="Enter the city name" spellcheck="false">
                <button id="btn1" name="btn" type="submit">Search</button>
            </form>
        </div>
        <div class="weather">
            <h1 id="city"></h1>
            <h1 id="temp"></h1>
            <h1 id="weatherType"></h1>
        </div>
    </div>

    <?php
        if(isset($_GET["btn"])) {
            include "saveData.php";
        }
    ?> 

    <script src="script.js"></script>

</body>
</html>
