<?php
/* developer 张善飞 QQ3460698227
*
*/
$Uemail = explode(',',$_POST)[0];
$Uscore = explode(',',$_POST)[1];
	$mysqli = new mysqli('127.0.0.1','root','root','qeder');
	
	$sqlstr = "INSERT INTO qe_gamescore(useremail,score)value('$Uemail','$Uscore')";
	$result = $mysqli->query($sqlstr);
	$mysqli->autocommit(TRUE);
	$mysqli->close();
