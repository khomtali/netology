<?php
    if(!empty($file = fopen('opendata.csv', 'r'))) {
        $info = array_map('str_getcsv', file('opendata.csv'));
        if(isset($argv[1])) {
            $input = $argv[1];
            $shortest = -1;
            foreach($info as $country) {
                $lev = levenshtein($input, $country[1]);
                if($lev == 0) {
                    $closest = $country[1];
                    $shortest = 0;
                    break;
                } elseif ($lev <= $shortest || $shortest < 0) {
                    $closest  = $country[1];
                    $shortest = $lev;
                }
            }
            if($shortest == 0)
                echo "$closest: $country[4]\n";
            else echo "If you mean $closest: $country[4].\nIf not, please, type again.\n";
        } else echo "Please, type a name of country.\n";
    } else echo "Cannot open the file with data.\n";
?>
