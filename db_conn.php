<?php
 

// For local hosting ----> configuration starts

//  $mysql_hostname  =  "localhost";
//  $mysql_user  =  "root"; 
//  $mysql_password  =  "";
//  $mysql_database  =  "intern";
//  $bd  =  mysqli_connect($mysql_hostname,  $mysql_user,  $mysql_password);
//  mysqli_select_db($bd,$mysql_database);
//  $conn  =  mysqli_connect($mysql_hostname,$mysql_user,$mysql_password,$mysql_database); 

// For local hosting ----> configuration ends



// For live hosting ----> configuration starts
    $mysql_hostname  =  "localhost";
    $mysql_user  =  "id6292511_felix"; 
    $mysql_password  =  "password";
    $mysql_database  =  "id6292511_intern";
    $bd  =  mysqli_connect($mysql_hostname,  $mysql_user,  $mysql_password);
    mysqli_select_db($bd,$mysql_database);
    $conn  =  mysqli_connect($mysql_hostname,$mysql_user,$mysql_password,$mysql_database);

// For live hosting ----> configuration ends


 ?>
