// Жестокое обращение с животными

<?php
    // 1
    $fauna = ["Africa" => ["Loxodonta","Addax nasomaculatus","Hystricidae"],
    "Asia" => ["Tetracerus quadricornis","Castor fiber","Pteromys"],
    "Europa" => ["Savalia savaglia","Halichoerus grypus","Martes"],
    "Australia" => ["Macropus rufus","Sepia apama","Thylacinus cynocephalus"]];

    // 2
    while ($fauna != null) {
        $region = array_pop($fauna);
        while($region != null) {
            $animal = array_pop($region);
            $check = strpos($animal," ");
            if($check) {
                $result2[] = $animal;
            } else continue;
        }
    }

    // 3
    $len = count($result2);
    for ($i = 0; $i < $len; $i++) {
        $task3 = explode(" ",$result2[$i]);
        $first_w[] = $task3[0];
        $second_w[] = $task3[1];
    }
    shuffle($second_w);
    for ($i = 0; $i < $len; $i++) {
        $result3[] = $first_w[$i]." ".$second_w[$i];
    }
    print_r($result3);
    echo "<br>";
?>
