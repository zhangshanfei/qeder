<?php
/* developer 张善飞 QQ3460698227
*
*/
$postStr = file_get_contents("php://input");

$Uemail = explode('&',$postStr)[0];
$Uscore = explode('&',$postStr)[1];
$mysqli = new mysqli('localhost','root','root','qeder');
$sqlstr = "INSERT INTO qe_gamescore(useremail,score)value('$Uemail','$Uscore');";
$result = $mysqli->query($sqlstr);
$mysqli->autocommit(TRUE);
$mysqli->close();
