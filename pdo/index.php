<?php

#例1  Driver invocation
$dsn = 'mysql:dbname=testdb;host=127.0.0.1';
$usr = 'dbuser';
$password = 'dbpass';

try{
    $dbh = new PDO($dsn, $usr, $password);
}catch(PDOException $e){
    echo 'Connection failed:'.$e->getMessage();
}


#例2  URI invocation
$dsn = 'uri:file:///usr/local/dbconnect';
$user = '';
$password = '';

try{
    $dbh = new PDO($dsn, $usr, $password);
}catch(PDOException $exception){
    echo 'Connection failed:'.$exception->getMessage();
}


#例三
#Aliasing
$dsn = 'nydb';
$usr = '';
$password = '';


try{
    $dbh = new PDO($dsn, $usr, $password);
}catch(PDOException $e){
    echo 'Connect failed,'.$e->getMessage();
}