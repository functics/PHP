<?php
$dsn = "mysql:dbname:test;host:localhost";
$usr = "root";
$password = "root";

try{
    $conn = new PDO($dsn, $usr, $password);
}catch(PDOException $exception){
    die("Connection failed".$exception->getMessage());
}

$sql = "SELECT id,username FROM test";

foreach ($conn->query($sql) as $row){
    print $row['id']."\t";
    print $row['username']."\n";
}