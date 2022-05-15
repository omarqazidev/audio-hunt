<?php

function getRegExMatches($regexString, $sourceData)
{
    preg_match_all($regexString, $sourceData, $matches);
    return $matches;
}

function getRegExMatchesMultiCurl($regexString, $sourceData){

    for ($i = 0; $i < count($sourceData); $i++) {
        preg_match_all($regexString, $sourceData[$i], $matches);
        $toReturn[] = $matches[1];
    }

    for ($i = 0; $i < count($sourceData); $i++) {
        @$toReturn[$i] = @$toReturn[$i][0];
    }

    return $toReturn;
}

?>