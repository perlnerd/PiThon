<?php
/*include("sqlite.inc.php");
$db = new MyDB();
$resultTwo = $db->query('SELECT serial,nickname FROM onewire');
while ($row = $resultTwo->fetchArray(SQLITE3_ASSOC))
{
  echo "<option value=\"probe.php?id={$row['serial']}\">{$row['nickname']}</option>";
}
*/


include("sqlite.inc.php");
$db = new MyDB();

$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Could not connect");

$key = md5('List 9lessons Demos'); // Unique Words
$cache_result = array();
$cache_result = $memcache->get($key); // Memcached object 

if($cache_result)
{
// Second User Request
$demos_result=$cache_result;
echo "Cache returned";
}
else
{
// First User Request 
$resultTwo = $db->query('SELECT serial,nickname FROM onewire');
while ($row = $resultTwo->fetchArray(SQLITE3_ASSOC))
{
  $demos_result[] = $row;
  
}
print_r($demos_result);
  $memcache->set($key, $demos_result, MEMCACHE_COMPRESSED, 1200); 
  

// 1200 Seconds
echo "No Cache.  Creating now";
}

// Result 
foreach($demos_result as $row)
{
//echo '<a href='.$row['serial'].'>'.$row['nickname'].'</a><br />';
echo "<option value=\"probe.php?id={$row['serial']}\">{$row['nickname']}</option>";

}

?>
