<?php
//sqlite> create table  onewire(serial, nickname);
//sqlite> create table temps(iId, temperature);

class MyDB extends SQLite3
{

	function __construct()
        {
                $this->sqliteDbpath = $_SERVER['DOCUMENT_ROOT']."/../sqlite/thermin.db";

                $this->open($this->sqliteDbpath);
        }
}

//Usage:

//$db = new MyDB();
//$db->exec('CREATE TABLE stuff (house,car, boat)');
//$db->exec("INSERT INTO stuff (house,car,boat) VALUES ('Side split','Mazda','John')");

//$result = $db->query('SELECT ROWID,* FROM stuff');

//echo "<HTML><HEAD<TITLE></TITLE></HEAD><BODY>";
//while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
//  foreach($row as $key => $value) {
//   echo $key . ' is ' . $value . '<p>';
//  }
?>