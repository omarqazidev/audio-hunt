<?php
include('curl_lib.php');
include('regex_lib.php');
include('audiox_handler.php');

#The searched keyword(s)
$search = $_REQUEST["q"];
//$search = $_POST['Search'];
//$search = "time";

#Setting Search URL of Site 
$url1 = "http://freemusicarchive.org/search/?quicksearch=" . $search . "";
//$url1 = "https://freemusicarchive.org/search/?quicksearch=" . $search . "&sort=track_date_published&d=1&page=" . $curr_page . "";


#Load CURL'ed data into variable
$result1 = singleCurl($url1);

#Verify if content exists
$regex_doesResultExist = "~<h1>Search Results: (.+) Tracks Found!<\/h1>~";
$doesResultExist = getRegExMatches($regex_doesResultExist, $result1)[1];
$doesResultExist = $doesResultExist[0];

if(!empty($doesResultExist)){
    $page_number = $doesResultExist / 15 ;
    $page_number = ceil($page_number);
}


if ($doesResultExist > 0) {

    #Regular Expression Strings
    $regex_links = "~<span class=\"playicn\">\s*<a href=\"(.+)\" class=\"icn-arrow\" title=\"Download\"><\/a>\s*<a href=\"#\" class=\"icn-plus\" title=\"Add to Player\"><\/a>\s*<\/span>~";
    $regex_tracks = "~<span class=\"ptxt-track\"><a href=\"(.+)\">(.+)<\/a><\/span>~";
    $regex_artists = "~<span class=\"ptxt-artist\">\s+<a href=\"(.+)\">(.+)<\/a>\s+<\/span>~";
    $regex_images = "~img src=\"(.+)\?method=crop&amp;width=290&amp;height=290\" alt=\"\" align=\"top\" class=\"sbar-fullimg\" \/>~";

    $download_links[] = getRegExMatches($regex_links, $result1)[1];
    $track_links[] = getRegExMatches($regex_tracks, $result1)[1];
    $track_titles[] = getRegExMatches($regex_tracks, $result1)[2];
    $artist_links[] = getRegExMatches($regex_artists, $result1)[1];
    $artist_titles[] = getRegExMatches($regex_artists, $result1)[2];

    $download_links = $download_links[0];
    $track_links = $track_links[0];
    $track_titles = $track_titles[0];
    $artist_links = $artist_links[0];
    $artist_titles = $artist_titles[0];

    $result2 = multipleCurl($track_links);
    $album_images[] = getRegExMatchesMultiCurl($regex_images, $result2);

    $audioxArr = array();
    $audioxArr = makeAudioXArray($track_titles, $track_links, $artist_titles, $artist_links, $download_links, $album_images, (int)$page_number, $curr_page );
    
    $jsoned = json_encode($audioxArr);
    
    echo $jsoned;
    

}else{

    #if content doesnt exist return the String "X"
    echo "X";

}


?>

