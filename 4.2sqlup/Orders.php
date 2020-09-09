<?php 
session_start();
# à¼Âá¾Ãèã¹ http://www.thaiall.com/perlphpasp/source.pl?9137
# ===
# ÊèÇ¹¡ÓË¹´¤èÒàÃÔèÁµé¹¢Í§ÃÐºº
$host     = "localhost";
$db       = "test";  
$tb       = "test"; 
$user     = "root"; // ÃËÑÊ¼Ùéãªé ãËéÊÍº¶ÒÁ¨Ò¡¼Ùé´ÙáÅÃÐºº
$password = "";    // ÃËÑÊ¼èÒ¹ ãËéÊÍº¶ÒÁ¨Ò¡¼Ùé´ÙáÅÃÐºº
$create_table_sql = "create table Orders (Ordid varchar(20),  Ordcustomerid varchar(20), Ordfreight int(30))";
if (isset($_REQUEST{'action'})) $act = $_REQUEST{'action'}; else $act = "";
# ===
# ÊèÇ¹áÊ´§¼ÅËÅÑ¡ ·Ñé§»¡µÔ áÅÐËÅÑ§¡´»ØèÁ del ËÃ×Í edit
if (strlen($act) == 0 || $act == "del" || $act == "edit") {
  $conn = mysql_connect("$host","$user","$password");
  $r = mysql_db_query($db,"select * from Orders") or die ("phpmyadmin - " . $create_table_sql . "<br/>" . mysql_error());
  echo "<table>";
  while ($o = mysql_fetch_object($r)) {
    if (isset($_REQUEST{'Ordid'}) && $_REQUEST{'Ordid'}  == $o->Ordid) $chg = " style='background-color:#f9f9f9"; else $chg = " readonly style='background-color:#ffffdd";
    echo "<tr><form action='' method=post>
      <td><input name=Ordid size=5 value='". $o->Ordid . "' style='background-color:#dddddd' readonly></td>
      <td><input name=Ordcustomerid size=40 value='". $o->Ordcustomerid . "' $chg'></td>
      <td><input name=Ordfreight size=20 value='". $o->Ordfreight . "' $chg;text-align:right'></td>
      <td>";
    if (isset($_REQUEST{'Ordid'}) && $_REQUEST{'Ordid'} == $o->Ordid) {
      if ($act == "del") echo "<input type=submit name=action value='del : confirm' style='height:40;background-color:yellow'>";
      if ($act == "edit") echo "<input type=submit name=action value='edit : confirm' style='height:40;background-color:#aaffaa'>";
    } else {
      echo "<input type=submit name=action value='del' style='height:26'> <input type=submit name=action value='edit' style='height:26'>";
    }
    echo "</td></form></tr>";
  }	
  echo "<tr><form action='' method=post><td><input name=Ordid size=5></td><td><input name=Ordcustomerid size=40></td><td><input name=Ordfreight size=20></td><td><input type=submit name=action value='add' style='height:26'></td></tr>
  </form></table>";
  if (isset($_SESSION["msg"])) echo "<br>".$_SESSION["msg"];
  $_SESSION["msg"] = ""; 
  exit;
} 
# ===
# ÊèÇ¹à¾ÔèÁ¢éÍÁÙÅ
if ($act == "add") {
  $q  = "insert into Orders values('". $_REQUEST{'Ordid'} . "','". $_REQUEST{'Ordcustomerid'} . "',". $_REQUEST{'Ordfreight'} . ")";
  $conn = mysql_connect("$host","$user","$password");
  $r = mysql_db_query($db,$q);   
  if ($r) $_SESSION["msg"] = "insert : completely";
  mysql_close($connect);  
  header("Location: ". $_SERVER["SCRIPT_NAME"]);
}
# ===
# ÊèÇ¹Åº¢éÍÁÙÅ
if ($act == "del : confirm") {
  $q  = "delete from Orders where Ordid ='". $_REQUEST{'Ordid'} . "'";
  $conn = mysql_connect("$host","$user","$password");
  $r = mysql_db_query($db,$q);   
  if ($r) $_SESSION["msg"] = "delete : completely";
  mysql_close($connect);  
  header("Location: ". $_SERVER["SCRIPT_NAME"]);
}
# ===
# ÊèÇ¹á¡éä¢¢éÍÁÙÅ
if ($act == "edit : confirm") {
  $q  = "update $tb set Ordcustomerid ='". $_REQUEST{'Ordcustomerid'} . "', Ordfreight = ". $_REQUEST{'Ordfreight'} . " where Ordid ='" . $_REQUEST{'Ordid'} . "'";
// die($q);
  $conn = mysql_connect("$host","$user","$password");
  $r = mysql_db_query($db,$q);   
  if ($r) $_SESSION["msg"] = "edit : completely";
  mysql_close($connect);  
  header("Location: ". $_SERVER["SCRIPT_NAME"]);
}
?>