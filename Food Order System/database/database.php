<?php 
session_start();
define('SITEURL','http://localhost/Project/');
$dbhost='localhost:3307';
$dbuser='root';
$dbpass='';
$dbname='majorproject';
$mysqli=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
/*if($mysqli)
{
    echo "connected";
}
else{
    echo "not connected";
}*/
 
?>