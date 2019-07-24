<?php
$data = file_get_contents('./index.php');
$css = file_get_contents('./css.css');
$js = file_get_contents('./js.js');
$data = str_replace("{{JS}}", $js, $data);
$data = str_replace("{{CSS}}", $css, $data);
eval("?>" . $data);