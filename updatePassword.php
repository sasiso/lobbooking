<?php
session_start();
if(!$_SESSION["loggedin"])
{
header("Location: index.html");
exit;
}
unset($_SESSION['loggedin']);
session_destroy();
$result=@mysql_connect("localhost","root","") or die(mysql_error());
$result=mysql_select_db("labbookingsite");
$ssoid=$_POST['ssoid'];
$oldpass=$_POST['oldpasswd'];
$newpass=$_POST['newpasswd'];
echo $ssoid;
$query="select password from employee where ssoid='".$ssoid."'";
$result=mysql_query($query) or die(mysql_error());
$answer=mysql_fetch_row($result) or die(mysql_error());
echo $answer[0];
if($answer[0]==$oldpass)
{
	$query="update employee set password = '".$newpass."' where ssoid='".$ssoid."'";
	$result=mysql_query($query) or die(mysql_error());
	header("Location: passwordChanged.html?done=true");
	exit;
}
else
{
	header("Location: passwordChanged.html?done=false");
	exit;
}
?>