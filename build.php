<?php
$data = file_get_contents('./index.php');
$template = file_get_contents('./template.php');
$compressed = base64_encode(gzdeflate($data, 9));

//Here replace all data by compiler
$output = str_replace("{{CONTENT}}", $compressed, $template);
$output = str_replace("{{PASSWORD}}", "878787", $output);

//Here format
$output = str_replace(";\n\r", ";", $output);
$output = str_replace(";\r", ";", $output);
$output = str_replace(";\n", ";", $output);

$output = str_replace("{\n\r", "{", $output);
$output = str_replace("{\r", "{", $output);
$output = str_replace("{\n", "{", $output);

$output = str_replace("}\n\r", "}", $output);
$output = str_replace("}\r", "}", $output);
$output = str_replace("}\n", "}", $output);

$output = str_replace("<?php\n\r", "<?php ", $output);
$output = str_replace("<?php\r", "<?php ", $output);
$output = str_replace("<?php\n", "<?php ", $output);

$output = str_replace("<?php \n\r", "<?php ", $output);
$output = str_replace("<?php \r", "<?php ", $output);
$output = str_replace("<?php \n", "<?php ", $output);

file_put_contents('./dist/index.php', $output);