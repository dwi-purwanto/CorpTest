<?php
    $nilai = array(72, 65, 73, 78, 75, 74, 90, 81, 87, 65, 55, 69, 72, 78, 79, 91, 100, 40, 67, 77, 86);

    function findAVG($nilai)
    {
        $avg = array_sum($nilai) / count($nilai);
        echo number_format($avg);
    }

    function findMIN($nilai)
    {
        $batas = 1;
        sort($nilai, SORT_NUMERIC);
        foreach($nilai as $item) {
            if($batas <= 7 ) {
                echo $item.", ";
            }
            $batas++;
        }
    }

    function findMAX($nilai)
    {
        $batas = 1;
        rsort($nilai, SORT_NUMERIC);
        foreach($nilai as $item) {
            if($batas <= 7 ) {
                echo $item.", ";
            }
            $batas++;
        }
    }

    function findLowerCase()
    {
        $string = "TranSISI";
        $b      = str_split($string);
        $jml    = 0;
        foreach($b as $item) {
            if(ctype_upper($item)){
            }else{
                $jml = $jml + 1;
            }
        }
        echo "Jumlah : ".$jml." huruf kecil";
    }

    function checkArray($array, $string)
    {
        $result = call_user_func_array('array_merge', $array);
        $split = 4;
        $array = array_chunk($result, $split);
        $new   = call_user_func_array('array_merge', $array);
        $text  = implode("",$new);
        similar_text($text, $string, $persen);
        if(number_format($persen) >= 50) {
            echo 'true';
        }else {
            echo 'false';
        }


    }

    function printUnigram($string)
    {
        $max = str_word_count($string);
        $data = explode (" ",strtolower($string));
        for ($i=0; $i < $max ; $i++) {
            if($i > $max){
                $a = " ";
            }else {
                $a = ", ";
            }
            echo $data[$i].$a;
        }
    }

    function printBigram($string)
    {
        $max = str_word_count($string);
        $data = explode (" ",strtolower($string));
        for ($i=0; $i < $max ; $i++) {
            if($i == 1 || $i ==3){
                $a = ", ";
            }else {
                $a = " ";
            }
            echo $data[$i].$a;
        }
    }
    function printTrigram($string)
    {
        $max = str_word_count($string);
        $data = explode (" ",strtolower($string));
        for ($i=0; $i < $max ; $i++) {
            if($i == 2){
                $a = ", ";
            }else {
                $a = " ";
            }
            echo $data[$i].$a;
        }
    }

    echo"Average : ";
    findAVG($nilai);

    echo"<br><br>";
    echo"Min : ";
    findMIN($nilai);

    echo"<br><br>";
    echo"Max : ";
    findMAX($nilai);

    echo"<br><br>";

    findLowerCase();
    echo"<br><br>";

    $arr =  [
        ['f', 'g', 'h', 'i'],
        ['j', 'k', 'p', 'q'],
        ['r', 's', 't', 'u']
    ];

    echo "Hasil Fungsi = cari(\$arr, 'fghi') = ";
    checkArray($arr, 'fghi');
    echo "<br>";
    echo "Hasil Fungsi = cari(\$arr, 'fghp') = ";
    checkArray($arr, 'fghp');
    echo "<br>";
    echo "Hasil Fungsi = cari(\$arr, 'fjrstp') = ";
    checkArray($arr, 'fjrstp');
    echo "<br><br>";

    echo"Unigram : ";
    $text = 'Jakarta adalah ibukota negara Republik Indonesia';
    printUnigram($text);
    echo "<br><br>";

    echo"Bigram : ";
    printBigram($text);
    echo"<br><br>";

    echo"Trigram : ";
    printTrigram($text);
    echo"<br><br>";

    $row    = 8;
    $column = 8;
    $a      = 0;
    $num    = array(1,2,5,7,10,11,13,14,17,19,22,23,25,26,29,31,34,35,37,38,41,43,46,47,49,50,53,55,58,59,61,62);
    $color  = "";

    echo "<table>";
    for ($j=1; $j<=$row; $j++) {
        echo "<tr>";
        for ($i=1; $i<=$column; $i++) {
            $a++;
            if(in_array($a, $num)) {
                $color = "black;color:white";
            }else{
                $color = "white";
            }
            echo "<td style='background-color:".$color."'>";
                echo "$a";
            echo "</td>";
        }
    echo "</tr>";
    }
    echo "</table>";
