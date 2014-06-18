<?php
include("sqlite.inc.php");
$db = new MyDB();
$resultTwo = $db->query('SELECT serial,nickname FROM onewire');
while ($row = $resultTwo->fetchArray(SQLITE3_ASSOC))
{
  echo "<option value=\"probe.php?id={$row['serial']}\">{$row['nickname']}</option>";
}

?>
