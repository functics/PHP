<?php
$dsn = "mysql:dbname=test;host=127.0.0.1;port=3306;";
$usr = "root";
$password = "root";
try{
    $conn = new PDO($dsn, $usr, $password);
}catch(PDOException $exception){
    die("Connection failed".$exception->getMessage());
}

$sql = "SELECT * FROM `test`;";
foreach ($conn->query($sql, PDO::FETCH_ASSOC) as $row){
    print $row['id']."\t";
    print $row['username']."\n";
}
//$sql = "UPDATE test SET username='HEJIANING' WHERE id=1";
//$conn->exec($sql) or die(print_r($conn->errorInfo(), true));
