<?php
session_start();
require "IdentifyClass.php";
$_POST['org_img'] = isset($_POST['org_img']) ? $_POST['org_img'] : "";

//echo $_POST['org_img'];
$identify = new Identify($_POST['org_img']);
$res =  $identify->test();

echo $res; //将值传给main.js
