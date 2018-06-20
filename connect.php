<?php 
	mysql_query("SET NAMES 'UTF8'"); //設定語系
	$sql=mysql_connect("localhost", "root", "12345")or die("cannot connect");//連接資料庫
	$db=mysql_select_db("limesurvey")or die("cannot connect DB");
?>
