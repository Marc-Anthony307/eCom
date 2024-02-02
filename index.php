
<?php

//= $_GET['url']
/*
    echo 'Hello World'
    ?>
*/
/*
function add($a, $b){
    return $a+$b;

}

function subtract($a, $b){
    return $a-$b;

}

function multiply($a, $b){
    return $a*$b;

}
function divide($a, $b){
    return $a/$b;

}

function parse($url){
    return explode('/', $url);
}
 
$url = $_GET['url'];
$parsedUrl = parse($url);
var_dump($parsedUrl);


[$fn, $op1, $op2] = $parsedUrl;

//it is dangerous in PHP to write () after a string not inside quotes
$result = 0;

if($fn == 'add'){
    $result = add($op1,$op2);

}elseif($fn == 'subtract'){
    $result = subtract($op1,$op2);

}elseif($fn == 'multiply'){
    $result = multiply($op1,$op2);

}elseif($fn == 'divide'){
    $result = divide($op1,$op2);

}
*/
use app\core\App;
require('app/core/init.php');
new App();

?>