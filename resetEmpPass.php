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
	header("Location: resetEmpPass.html?done=false");
	exit;
}
$query="update employee set password = '".$ssoid."' where ssoid='".$ssoid."'";
$result=mysql_query($query) or die(mysql_error());
if($result == TRUE)
{
	header("Location: resetEmpPass.html?done=true");
	exit;
}
else
{
	header("Location: resetEmpPass.html");
	exit;
}
?>