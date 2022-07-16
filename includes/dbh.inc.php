<?php

$dbHost = 'sql106.epizy.com';
$dbUser = 'epiz_32135750';
$dbpassword = 'sZ3Nab91jz';
$dbName = 'epiz_32135750_jackasoftoffical';

$conn = mysqli_connect($dbHost,$dbUser,$dbpassword,$dbName);

if(!$conn){
    die('failed to connect!');
}
