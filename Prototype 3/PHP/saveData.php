<?php

include "connect.php";

$city = $_GET['city'];

$fetch_query = "SELECT * FROM weather WHERE city = ? AND weather_when >= DATE_SUB(NOW(), INTERVAL 1 HOUR) ORDER BY weather_when DESC LIMIT 1";
$stmt = mysqli_prepare($conn, $fetch_query);
mysqli_stmt_bind_param($stmt, "s", $city);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


$url = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=".$city."&appid=d041a046b7cfd16f7fc37862f5767b2b";
$test = @file_get_contents($url);

if($test == false){
    echo "API request error";
    exit();
}

$json = json_decode($test, true);

if(mysqli_num_rows($result) == 0){

    $insert_query = "INSERT INTO weather(city,temp,weatherType) VALUES(?,?,?)";
    $stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($stmt, "sss", $city, $json["main"]["temp"], $json["weather"][0]["description"]);
    mysqli_stmt_execute($stmt);
}


function display($city){
    include "connect.php";
    $fetch_query = "SELECT * FROM weather WHERE city = ? ORDER BY weather_when DESC LIMIT 1";
    $stmt = mysqli_prepare($conn, $fetch_query);
    mysqli_stmt_bind_param($stmt, "s", $city);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);

    echo "<div class='weather'>
    <h1 id='city'>{$row["city"]}</h1>
    <h1 id='temp'>{$row["temp"]}<span>°c</span></h1>
    <h1 id='weatherType'>{$row["weatherType"]}</h1>
    <h1 id='weather_when'>{$row["weather_when"]}</h1>
    </div>";
}

display($city);

?>
