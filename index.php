
<?php

//= $_GET['url']
/*
    echo 'Hello World'
    ?>
*/

function add($a, $b){
    return $a+$b;

}

function parse($url){
    return explode('/', $url);
}
 
$url = $_GET['url'];
$parsedUrl = parse($url);
var_dump($parsedUrl);

?>