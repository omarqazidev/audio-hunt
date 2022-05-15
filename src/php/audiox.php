<?php

class AudioX {
    var $trackTitle;
    var $trackLink;
    var $artistTitle;
    var $artistLink;
    var $downloadLink;
    var $albumCover;

    function __construct($tt, $tl, $at, $al, $dl, $ac) {
        $this->trackTitle = $tt;
        $this->trackLink = $tl;
        $this->artistTitle = $at;
        $this->artistLink = $al;
        $this->downloadLink = $dl;
        $this->albumCover = $ac; 
    }
    
}

?>