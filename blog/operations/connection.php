<?php 

//session_start();

$server = "localhost";
$user   = "root";
$password = "";
$dbName = "full_project";

$con = mysqli_connect($server,$user,$password,$dbName);

 if(!$con){
     die("error :".mysqli_connect_error());
 }
 ?>