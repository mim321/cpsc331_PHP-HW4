<?php
require("sup_s1connect.php");
if (!$result=mysql_query("drop database $db",$connect))
  echo "Drop database : failed";
else
  echo "Drop database : succeeded";
mysql_close($connect);
?>
<input type='button' onclick="location.href='sup_s0index.php'" value='back'>