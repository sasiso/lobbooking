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
$query="select * from equipment where equipname='".$name."'";
$result=mysql_query($query) or die(mysql_error());
$answer=mysql_fetch_row($result);
if($answer[0]==NULL)
{
	header("Location: updEquipment.html?done=false");
	exit;
}
$equipId=$answer[0];
$equipname=$answer[1];
$desc=$answer[2];
echo "<title>Update Equipment Details</title>";
echo"<body bgcolor='#ffffff'>
<p align='center'><strong><font color='#004080' size='7' face='GE Inspira Pitch'><u>Equipment&nbsp;Update 
Page</u>  
</font></strong></p>
<p align='center'><strong><font face='GE Inspira Pitch' color='#004080' size='7'><font size='4'> 
</font> </font></strong>&nbsp;</p>
<form name='addempform' method='post' action='updateEquipInfo.php'>
<input type='hidden' name='equipid' value='".$equipId."'/><strong><font face='GE Inspira Pitch' color='#004080' size='7'><font face='GE Inspira Pitch' size='4'>
<p align='center'><strong><font face='GE Inspira Pitch' color='#004080' size='7'><font face='GE Inspira Pitch' size='4'>Equipment 
Name&nbsp;:</font>&nbsp;&nbsp; </font><input 
style='WIDTH: 153px; HEIGHT: 22px' name='equipname' value='".$equipname."'></strong></p>
<p align='center'>Description 
:</font>&nbsp;&nbsp; </font><input 
style='WIDTH: 153px; HEIGHT: 22px' name='desc' value='".$desc."'></p><strong>
<p align='center'>
<p align='center'><input type='submit' value='Update' name='submit'>&nbsp;&nbsp;&nbsp;<input type='reset' value=' Reset' name='reset'> 
</form></p></font></strong>
<p></p>
<form name='form2' action='updEquipment.html'>
<p align='center'>&nbsp;
<input type='submit' value='Go Back'>
</form></p>";
?>