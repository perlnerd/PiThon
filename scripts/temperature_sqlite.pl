#!/usr/bin/perl
$mods = `cat /proc/modules`;
if ($mods =~ /w1_gpio/ && $mods =~ /w1_therm/) {
 print "w1 modules already loaded \n";
}
else {
 print "loading w1 modules \n";
 $mod_gpio = `sudo modprobe w1-gpio`;
 $mod_them = `sudo modprobe w1-therm`;
 }
 
 $sensor_temp = `cat /sys/bus/w1/devices/28-00000484b401/w1_slave 2>&1`;
if ($sensor_temp !~ /No such file or directory/) {
 if ($sensor_temp !~ /NO/) {
         $sensor_temp =~ /t=(\d+)/i;
         $temperature = ($1/1000);
         #$rrd_out = `/usr/bin/rrdtool update  /home/pi/temperature/rPItemp.rrd N:$tempreature`;
         use DBI;
         
         
         $dbh = DBI->connect( "dbi:SQLite:/usr/share/nginx/sqlite/thermin.db" ) || die "Cannot connect: $DBI::errstr";
         $sensorId = '28-00000484b401';
         $time = time;
         $dbh->do( "INSERT INTO tempLog VALUES ( '$sensorId','$temperature', '$time' ) " );
         print "rPI temp = $temperature\n"; 
         exit;
  }
die "Error locating sensor file or sensor CRC was invalid";
}
