<?php
include('audiox.php');

function makeAudioXArray($tt, $tl, $at, $al, $dl, $ac){
    
    $audioxs = array();
    
    for ($i=0;$i<count($dl);$i++){
        $audioxs[] = new AudioX(
            $tt[$i], 
            $tl[$i], 
            $at[$i], 
            $al[$i], 
            $dl[$i], 
            $ac[0][$i]
        );
    }
    return $audioxs;
}


?>