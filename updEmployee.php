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
$query="select * from employee where ssoid='".$ssoid."'";
$result=mysql_query($query) or die(mysql_error());
$answer=mysql_fetch_row($result);
if($answer[0]==NULL)
{
	header("Location: updEmployee.html?done=false");
	exit;
}
$sso=$answer[0];
$name=$answer[1];
$email=$answer[2];
echo "<title>Update Employee Details</title>";
echo"<body bgcolor='#ffffff'>
<p align='center'><strong><font color='#004080' size='7' face='GE Inspira Pitch'><u>Employee&nbsp;Update 
Page</u>  
</font></strong></p>
<p align='center'><strong><font face='GE Inspira Pitch' color='#004080' size='7'><font size='4'> 
</font> </font></strong>&nbsp;</p>
<form name='addempform' method='post' action='updateEmpInfo.php'>
<input type='hidden' name='oldsso' value='".$ssoid."'/><strong><font face='GE Inspira Pitch' color='#004080' size='7'><font face='GE Inspira Pitch' size='4'>
<p align='center'><strong><font face='GE Inspira Pitch' color='#004080' size='7'><font face='GE Inspira Pitch' size='4'>SSO 
ID&nbsp;:</font>&nbsp;&nbsp; </font><input 
style='WIDTH: 153px; HEIGHT: 22px' name='ssoid' value='".$sso."'></strong></p>
<p align='center'>Name 
:</font>&nbsp;&nbsp; </font><input 
style='WIDTH: 153px; HEIGHT: 22px' name='empname' value='".$name."'></p>
<p align='center'><strong><font face='GE Inspira Pitch' color='#004080' size='7'><font size='4'>Email&nbsp;:</font>&nbsp;&nbsp; </font><input 
style='WIDTH: 153px; HEIGHT: 22px' name='email' value='".$email."'></strong></p></strong><strong>
<p align='center'>
<p align='center'><input type='submit' value='Update' name='submit'>&nbsp;&nbsp;&nbsp;<input type='reset' value=' Reset' name='reset'> 
</form></p></font></strong>
<p></p>
<form name='form2' action='updEmployee.html'>
<p align='center'>&nbsp;
<input type='submit' value='Go Back'>
</form></p>";
?>