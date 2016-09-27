<?php
session_start();
if(!$_SESSION["loggedin"])
{
header("Location: administratorLogin.html");
exit;
}
$result=@mysql_connect("localhost","root","") or die(mysql_error());
$result=mysql_select_db("labbookingsite");
$name=$_POST['equipname'];
$query="select equipId from equipment where equipname='".$name."'";
$result=mysql_query($query) or die(mysql_error());
$answer=mysql_fetch_row($result);
if($answer[0]==NULL)
{
	header("Location: delEquipment.html?done=false");
	exit;
}
$query="delete from booking where equipId='".$answer[0]."'";
$result=mysql_query($query) or die(mysql_error());
$query="delete from equipment where equipId='".$answer[0]."'";
$result=mysql_query($query) or die(mysql_error());
if($result == TRUE)
{
	header("Location:delEquipment.html?done=true");
	exit;
}
else
{
	header("Location: delEquipment.html?done=false");
	exit;
}
?>