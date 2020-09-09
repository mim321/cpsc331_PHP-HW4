<body>
<form action="sup_s4insert.php">
<input name="nid" value="1004">
<input name="nname" value="kmit">
<input type="submit" value="sup_s4insert.php">
</form>
<?php
if (!isset($_GET['nid']) || !isset($_GET['nname'])) exit;
require("sup_s1connect.php");
$sql="insert into $tb values('".$_GET['nid']."','".$_GET['nname']."')";
if(!$result=mysql_db_query($db,$sql)) 
  echo "$sql : failed";
else
  echo "$sql : succeeded";
mysql_close($connect);
?>
</body><?php
require("sup_s1connect.php");
$sql="select * from $tb";
if (!$result=mysql_db_query($db,$sql)) die("Query : failed");
echo "Display all records : <br/>";
while ($object = mysql_fetch_object($result)) {
  echo $object->eid . "  " . $object->ename . "<br/>";
}
echo "Total " . mysql_num_rows($result) ." records";
mysql_close($connect);
?>