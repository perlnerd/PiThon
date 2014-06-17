#!/usr/bin/perl
 
 # NAME      wifi-check.pl
 # AUTHOR    Kronalias
 # PROVIDES  Checks to see if WiFi has a network IP and if not restarts WiFi
 #
 # CRONTAB   Run wifi-check.pl every minute
 #           */1 * * * * /home/pi/my/scripts/wifi-check.pl >> /mnt/ramdisk/wifi-check.log
 #
 # HISTORY
 # 1.01 - Base version
 my $name = 'wifi-check.pl';
 my $version = 1.01;
  
use strict;
use warnings;
   
my $wlan = 'wlan0';
    
use POSIX "strftime";
print strftime("%H:%M:%S %a %d %b %Y", localtime(time())) . ' ' . $name . ' ' . $version . ' ';
     
if (`/sbin/ifconfig $wlan | /bin/grep "inet addr:"`) {
print "Up\n";
} else {
print "Down\n";
`/usr/bin/sudo /sbin/ifdown $wlan`;
sleep 5;
`/usr/bin/sudo /sbin/ifup --force $wlan`;
}
exit;