// Жестокое обращение с животными

<?php
    // 1
    $fauna = ["Africa" => ["Loxodonta","Addax nasomaculatus","Hystricidae"],
    "Asia" => ["Tetracerus quadricornis","Elephas (Palaeloxdon) naumanni","Pteromys"],
    "Europa" => ["Savalia savaglia","Halichoerus grypus","Martes"],
    "Australia" => ["Macropus rufus","Sepia apama","Thylacinus cynocephalus"]];

    // 2
    foreach($fauna as $region) {
        foreach($region as $value) {
            $animal = explode(" ", $value);
            $n = count($animal);
            if($n == 2)
                $result2[] = $value;
        }
    }

    // 3
    foreach($result2 as $value) {
        $task3 = explode(" ",$value);
        $first_w[] = $task3[0];
        $second_w[] = $task3[1];
    }
    shuffle($first_w);
    for ($i = 0; $i < count($second_w); $i++) {
        $result3[] = $first_w[$i]." ".$second_w[$i];
    }
    foreach($result3 as $key => $value) {
        $key += 1;
        echo "$key) $value<br>";
    }

    // additional task
    foreach($fauna as $key => $value) {
        $region = $key;
        echo "<h2>$region</h2><br>";
        $result_add = [];
        foreach($value as $true_animal) {
            foreach($result3 as $find_animal) {
                $addtask = explode(" ",$find_animal);
                $first_w = $addtask[0];
                $found = strpos($true_animal,$first_w);
                if ($found !== FALSE)
                    $result_add[] = $find_animal;
            }
        }
        $n = count($result_add)-1;
        for($i = 0; $i < $n; $i++)
            echo "$result_add[$i], ";
        echo "$result_add[$n]";
    }
?>
