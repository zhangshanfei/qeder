<?php
/* developer 张善飞 QQ3460698227
*
*/
$now = new DateTime();
$deadline = new DateTime();		
$deadline->setDate("2017", "11", "30");  // 设置截止日期
$deadline->setTime(0,0,0);	// 设置截止日期的时间，时、分、秒
if($now<$deadline){
$postStr = file_get_contents("php://input");

$Uemail = explode('&',$postStr)[0];
$Uscore = explode('&',$postStr)[1];
$gamename = explode('&', $postStr)[2];
$mysqli = new mysqli('localhost','root','root','qeder');	
// $sqlstr ="drop procedure if exists ins_sc;  create procedure ins_sc()  begin set @tot =(select count(id)from qe_gamescore where useremail= '$Uemail' ) ;if (@tot<3) then  insert into qe_gamescore values(null, '$Uemail' , '$Uscore'); end if;  end;  call ins_sc();";

$sqlstr = "drop procedure if exists ins_sc;  create procedure ins_sc()  begin SET @tot=(SELECT count(id) FROM qe_gamescore WHERE useremail= '$Uemail'and gamename='$gamename' and score>'$Uscore'); if(@tot=0) THEN INSERT INTO qe_gamescore VALUES(NULL,'$Uemail' , '$Uscore','$gamename') on duplicate key update score='$Uscore';END IF;END;call ins_sc();";
$result = $mysqli->multi_query($sqlstr);
$mysqli->autocommit(TRUE);
$mysqli->close();
}