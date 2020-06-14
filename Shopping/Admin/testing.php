<?php 
$string = 'Test@12345';
if(md5($string) == '5c428d8875d2948607f3e3fe134d71b4'){
    echo "Correct";
}
else{
    echo "Incorrect";
}
?>