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
$desc=$_POST['description'];
$query="select equipname from equipment where equipname='".$name."'";
$result=mysql_query($query) or die(mysql_error());
$answer=mysql_fetch_row($result);
if($answer[0]!=NULL)
{
	header("Location: addEquipment.html?done=false");
	exit;
}
if($name!=NULL)
{
	$query="select max(equipId) from equipment";
	$result=mysql_query($query) or die(mysql_error());
	$answer=mysql_fetch_row($result);
	if($answer[0]==NULL)
	{
		$id=0;
	}
	else
	{
		$id=$answer[0]+1;
	}
	$query="insert into equipment values('".$id."','".$name."','".$desc."')";
	$result=mysql_query($query) or die(mysql_error());
}
if($result == TRUE)
{
	header("Location: addEquipment.html?done=true");
	exit;
}
else
{
	header("Location: addEquipment.html?done=false");
	exit;
}
?>