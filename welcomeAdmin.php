<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
<?php
session_start();
if(!isset($_SESSION["loggedin"]))
{
header("Location: administratorLogin.html");
exit;
}
?>
<head>
<meta name="GENERATOR" content="PageBreeze Free HTML Editor (http://www.pagebreeze.com)">
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" >
<title>Welcome Administrator</title>
</head>
<body bgcolor="#ffffff">
<p align="center"><strong><font color="#004080" size="7"><u>Welcome 
Administrator</u>  
</font></strong></p>
<p align="center"><a href="addEmployee.html"><font color="#400040" 
size=5 face='ge inspira pitch'><strong>Add Employee</strong></font> </a>&nbsp;</p>
<p align="center"><a href="updEmployee.html"><font color="#400040" 
size=5 face='ge inspira pitch'><strong>Update Employee</strong></font> </a>&nbsp;</p>
<p align="center"><a href="delEmployee.html"><font color="#400040"
size=5 face='ge inspira pitch'><strong>Delete&nbsp;Employee</strong></font> </a></p>
<p align="center"><a href="addEquipment.html"><font color="#400040" 
size=5 face='ge inspira pitch'><strong>Add Equipment</strong></font> </a></p>
<p align="center"><a href="updEquipment.html"><font color="#400040" 
size=5 face='ge inspira pitch'><strong>Update Equipment</strong></font> </a></p>
<p align="center"><a href="delEquipment.html"><font color="#400040" 
size=5 face='ge inspira pitch'><strong>Delete Equipment</strong></font> </a></p>
<table align=center cellpadding=10 border=0><tr><td align=center>
<a href="changeAdminPass.html"><font face='ge inspira pitch' size=4 color=red>Change Password</font></a></td><td align=center><a href="resetEmpPass.html"><font face='ge inspira pitch' size=4 color=red>Reset Employee Password</font></a></td><td align=center><a href="logout.php"><font face='ge inspira pitch' size=4 color=red>Logout</a></table>
</body>
</html>