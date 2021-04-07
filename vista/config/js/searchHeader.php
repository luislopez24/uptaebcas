
<?php


$search = mb_strtoupper($_POST['search'], 'UTF-8');
$search = mb_convert_case($search, MB_CASE_TITLE, "UTF-8");


?>