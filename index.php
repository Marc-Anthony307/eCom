
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


[$fn, $op1, $op2] = $parsedUrl;

//it is dangerous in PHP to write () after a string not inside quotes
echo "the result of $op1 + $op2 is ", $fn($op1,$op2);       


?>