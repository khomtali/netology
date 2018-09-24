<?php
    if(isset($argv[1])) {
        $input = urlencode($argv[1]);
        $query = 'https://www.googleapis.com/books/v1/volumes?q='.$input;
        $file = file_get_contents($query, TRUE);
        $found = json_decode($file, TRUE);
        if (!function_exists('json_last_error_msg')) {
            function json_last_error_msg() {
                static $ERRORS = array(
                    JSON_ERROR_NONE => 'No error',
                    JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
                    JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
                    JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
                    JSON_ERROR_SYNTAX => 'Syntax error',
                    JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded'
                );
                $error = json_last_error();
                return isset($ERRORS[$error]) ? $ERRORS[$error] : 'Unknown error';
            }
        }
        foreach($found['items'] as $item) {
            $book[] = $item['id'];
            $book[] = $item['volumeInfo']['title'];
            if(!empty($item['volumeInfo']['authors']))
                foreach($item['volumeInfo']['authors'] as $author)
                    $book[] = $author;
            $books[] = $book;
            unset($book);
        }
        if(!empty($file = fopen('books.csv', 'a'))) {
            foreach ($books as $book)
                fputcsv($file, $book, ',');
        }
        fclose($file);
        echo "Please, see the search results in 'books.csv'.\n";
    } else echo "Please, input a search query.\n"
?>
