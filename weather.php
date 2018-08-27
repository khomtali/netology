// openweathermap

<?php
    $city = "Moscow";
    $region = "ru";
    $units = "metric";
    $url = "http://api.openweathermap.org/data/2.5/weather?q=$city,$region&units=$units&appid=ae7d5313e2d51d4fc6e4adfb20eda50e";
    $data = file_get_contents($url);
    if ($data) {
        $dataJson = json_decode($data);
        $weather = $dataJson->weather;
        $main = $dataJson->main;
        echo "Current weather in $city is: ".$weather[0]->description."<br/>
        temperature ".$main->temp."<br/>
        pressure ".$main->pressure."<br/>
        humidity ".$main->humidity;
    } else {
        echo "Service is unavailable";
    }
?>
