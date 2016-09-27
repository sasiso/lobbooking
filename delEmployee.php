<?php
session_start();
if(!$_SESSION["loggedin"])
{
header("Location: administratorLogin.html");
exit;
}
$result=@mysql_connect("localhost","root","") or die(mysql_error());
$result=mysql_select_db("labbookingsite");
$ssoid=$_POST['ssoid'];
$query="select name from employee where ssoid='".$ssoid."'";
$result=mysql_query($query) or die(mysql_error());
$answer=mysql_fetch_row($result);
if($answer[0]==NULL)
{
	header("Location: delEmployee.html?done=false");
	exit;
}
$query="delete from employee where ssoid='".$ssoid."'";
$result=mysql_query($query) or die(mysql_error());
$query="delete from booking where ssoid='".$ssoid."'";
if($result == TRUE)
{
	header("Location: delEmployee.html?done=true");
	exit;
}
else
{
	header("Location: delEmployee.html?done=false");
	exit;
}
?>