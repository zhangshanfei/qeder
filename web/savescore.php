<?php
/* developer 张善飞 QQ3460698227
*
*/
	$mysqli = new mysqli('127.0.0.1','root','root','qeder');
	/* if ($mysqli->connect_error) {
		die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
	}
	elseif(mysqli_connect_error()) {
		die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	} */
	$sqlstr = "INSERT INTO qe_gamescore(useremail,score)value('$Uemail','$Uscore')";
	$result = $mysqli->query($sqlstr);
	$mysqli->autocommit(TRUE);
	$mysqli->close();
