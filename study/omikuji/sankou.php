<?php

    // ３つの要素を用意してそれぞれの出没確率を設定
    $first  = array("text" => "first" , "per"   => 10);
    $second = array("text" => "second",  "per"  => 20);
    $third  = array("text" => "third" ,  "per"  => 70);


    // 決められた確率に準じて、抽出する方法
    $array  = array($first, $second, $third);
    $target = rand(1, 100);
    foreach ($array as $val) {
        if ($target <= $val['per']) {
            echo "確率に応じて表示；" . $val['text']. "\n";
            break;
        } else {
            $target -= $val['per'];
        }
    }

 ?>