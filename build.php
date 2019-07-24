<?php
include('vendor/autoload.php');
use NodejsPhpFallback\Uglify;
use voku\helper\HtmlMin;

$data = file_get_contents('./index.php');
$template = file_get_contents('./template.php');

// Here mifify js
$uglify = new Uglify(array(
    './js.js',
));
$data = str_replace("{{JS}}", $uglify, $data);

// Here mifify css
$uglify = new Uglify(array(
    './css.css',
));
$data = str_replace("{{CSS}}", $uglify, $data);

$htmlMin = new HtmlMin();

$data = $htmlMin->minify($data);
// Here compression front-end
$compressed = base64_encode(gzdeflate($data, 9));

//Here replace all data by compiler
$output = str_replace("{{CONTENT}}", $compressed, $template);
$output = str_replace("{{PASSWORD}}", "878787", $output);

//Here format
function format($data){
    $output = str_replace(";\n\r", ";", $data);
    $output = str_replace(";\r", ";", $output);
    $output = str_replace(";\n", ";", $output);
    $output = str_replace("; ", ";", $output);

    $output = str_replace("{\n\r", "{", $output);
    $output = str_replace("{\r", "{", $output);
    $output = str_replace("{\n", "{", $output);
    $output = str_replace("{ ", "{", $output);

    $output = str_replace("}\n\r", "}", $output);
    $output = str_replace("}\r", "}", $output);
    $output = str_replace("}\n", "}", $output);
    $output = str_replace("} ", "}", $output);

    $output = str_replace("<?php\n\r", "<?php ", $output);
    $output = str_replace("<?php\r", "<?php ", $output);
    $output = str_replace("<?php\n", "<?php ", $output);
    $output = str_replace("<?php  ", "<?php ", $output);

    $output = str_replace("<?php \n\r", "<?php ", $output);
    $output = str_replace("<?php \r", "<?php ", $output);
    $output = str_replace("<?php \n", "<?php ", $output);
    return $output;
}
file_put_contents('./dist/index.php', format($output));