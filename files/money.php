<?php
    $csv = 'costlist.csv';
    if (isset($argv[1]) && isset($argv[2])) {
        $file = fopen($csv, 'w');
        if($file) {
            $row[] = date('Y-m-d');
            $row[] = $argv[1];
            $purchase = implode(' ', array_slice($argv, 2));
            $row[] = $purchase;
            fputcsv($file, $row, ";");
            $expense = implode(', ',$row);
            echo "Expense added: $expense\n";
            fclose($file);
            } else echo "Error! Disable to write in file.\n";
        } else echo "Error! Access to write in .csv file denied.\n";
    } elseif(isset($argv[1]) && $argv[1] == '--today') {
        if(is_readable($csv)) {
            $file = fopen($csv, 'r');
            $expense = fgetcsv($file, '1000', ";");
            $sum = 0;
            while(!empty($expense))
                if($expense[0] === date('Y-m-d'))
                    $sum += $expense[1];
            echo date('Y-m-d')." current expense is .$sum\n";
            fclose($file);
        } else echo ".csv file with expenses is not exist!\n";
    } else echo "Error! Arguments are not specified. Put the flag --today or run the script with arguments {price} and {purchase}\n";
?>
