<?php
/* developer 张善飞 QQ3460698227
*
*/
$postStr = file_get_contents("php://input");

$Uemail = explode('&',$postStr)[0];
$Uscore = explode('&',$postStr)[1];
$mysqli = new mysqli('localhost','root','root','qeder');
$sqlstr = "drop procedure if exists ins_sc;  create procedure ins_sc()  begin set @tot =(select count(id)from qe_gamescore where useremail= '$Uemail' ) ;if (@tot<3) then  insert into qe_gamescore values(null, '$Uemail' , '$Uscore'); end if;  end;  call ins_sc();  ";
$result = $mysqli->multi_query($sqlstr);
$mysqli->autocommit(TRUE);
$mysqli->close();


