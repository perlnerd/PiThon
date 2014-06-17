<?php
?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>The PiThon programmable thermostat</title>
<link href="multi/boilerplate.css" rel="stylesheet" type="text/css">
<link href="multi/multi.css" rel="stylesheet" type="text/css">
<link href="formatting.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="multi/respond.min.js"></script>
<script type="text/javascript">
function jumpto(x){

  if (document.Selector.probe.value != "null") {
    document.location.href = x
  }
}

</script>
</head>
<body>
<div class="gridContainer clearfix">
<div id="LayoutDiv1">
  <h1><a href="/"><img src="/logo.png" width="90" height="100" alt="The PiThon" name="Logo" style="background: rgba(198,213,128, .5);" /></a>The PiThon</h1>
  <h3><em id="nickname"> </em> temperature is <span id="temperature"> </span>&deg;C. (<span id="temperaturef"> </span>&deg;F.)
</h3>
</div>
<div id="LayoutDiv2">
  <ul id="menu">
  <li><form name="Selector">
      <select id="jumpmenu" name="probe" size="1" onChange="jumpto(document.Selector.probe.options[document.Selector.probe.options.selectedIndex].value)">
      <option value="">Select Probe</option>
<?php
//include("jumpmenu.php");
?>
      </select>
      </form></li>
    <li><a href="/admin/index.php"><span class="blackBar">&nbsp;&nbsp;|&nbsp;&nbsp;</span>Admin</a></li>
    <li><a href="contact.php"><span class="blackBar">&nbsp;&nbsp;|&nbsp;&nbsp;</span>Contact</a></li>
 </ul>
</div>

<div class="clearfloat"></div>

<div id="LayoutDiv3">
<h3>The PiThon</h3>
<p>This is an experiment to see if I can build a reptile keepers thermostat using a
    <a href="http://www.raspberrypi.org">Raspberry Pi</a> computer,
    <a href="http://datasheets.maximintegrated.com/en/ds/DS18B20.pdf">DS18B20</a>
    digital 1-wire thermometer, and <a href="http://yourduino.com/sunshop2/index.php?l=product_detail&p=171">relay board</a>.</p>

    <p>The Raspberry Pi is running <a href="http://www.raspbian.org">Raspian Linux</a> headless and connects
    to the internet via a <a href="http://www.amazon.ca/gp/product/B004HYI3OU/ref=oh_details_o01_s00_i00?ie=UTF8&psc=1">USB
    wifi adapter</a>.</p>

    <p>Temperature logging and graphing were originally handled by <a href="http://oss.oetiker.ch/rrdtool/">rrdtool</a>
    using instructions found <a href="http://webshed.org/wiki/RaspberryPI_DS1820">here</a>. I have now moved to a
    logging/graphing solution consisting of SQLite/Perl for logging and SQLite/PHP5/<a href="http://www.phplot.com">PHPlot</a> for graphing  . This website is served by
    <a href="http://nginx.org/en/">nginx</a> along with <A HREF="http://php.net">php5</a>,
    <a href="http://www.sqlite.org">SQLite</a>, and javascript providing dynamic content.</p>

    <p>I am not yet controlling the temperature with the Raspberry Pi.  My relay board <del>should arrive soon</del> has arrived! I'm playing and doing some tests before hooking up a 120v heat source.  I don't want to fry my Pi (or myself).</p>
</div>    

<div id="LayoutDiv4"><h3>My Goals</h3>
<p>Since it's introduction the Rasperry Pi interested me, but without something cool to do with it this was nothing more than tiny computer running Linux.</p>

<p>My first 'Pi' was setup as an Airplay interface using <a href="https://github.com/albertz/shairport">shairport</a> .   This took only a matter of minutes and barely scratched the surface of what I soon realized this little Linux box could do.  Soon I was experimenting with the <a href="http://elinux.org/RPi_Low-level_peripherals#General_Purpose_Input.2FOutput_.28GPIO.29">GPIO</a> pins and a plan began to forment</p>

<p>The ultimate goal of this project is to create, in conjunction with the afformantioned sensors and relays, a powerful browser-based administration panel to automate the control
    of several heat sources and their associated thermometers. Night-time temperature drops, and seasonal temperature shifts
    are two must have features I will then work on implementing.</p>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
$( document ).ready(function() {
  var API = "json.php";
  $.getJSON( API, function( data ) {
            $("#temperature").html(data.temperature);
            $("#temperaturef").html(data.temperatureF);
            $("#nickname").html(data.probeNickname);

    });
});

$.get( "jumpmenu.php", function( data ) {
  $( "#jumpmenu" ).append( data );
    alert( "Load was performed." );
    });                                                      
</script>
</body>


</html>
