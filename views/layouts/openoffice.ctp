<?php

//header(empty($type)) ? $type = 'applications' : $type = $type;

header("Content-type: application/vnd.oasis.opendocument.spreadsheet");
header("Content-Disposition: attachment; filename=$nome.ods");
//header('Cache-control: no-store, no-cache, must-revalidate');
//header('Pragma: no-cache');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Expires: 0');
 

echo $content_for_layout;
?>