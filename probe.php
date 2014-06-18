<?php
if(isset($_GET['id']) && mb_strlen($_GET['id']) == 15) {
  $probeSerial = $_GET['id'];
}
else {
  echo "Error: invalid probe serial";
  exit();
}
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
<style type="text/css" media="screen">
<!--
#graphOne {
border: 1px solid #ccc;
width: 600px;
height: 160px;
overflow: hidden;
z-index: 5;
}
#graphTwo {
border: 1px solid #ccc;
width: 600px;
height: 160px;
overflow: hidden;

}
#graphThree {
border: 1px solid #ccc;
width: 600px;
height: 160px;
overflow: hidden;

}
#graphFour {
border: 1px solid #ccc;
width: 600px;
height: 160px;
overflow: hidden;
margin-bottom: 5px;

}

.graphelement {
background: url(ajax-loader-2.gif) no-repeat center center;
}
.loadingtext {

}

-->
</style>
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
  <h3><em class="nickname"> </em> temperature is <span id="temperature"> </span>&deg;C. (<span id="temperaturef"> </span>&deg;F.)
</div>
<div id="LayoutDiv2">
  <ul id="menu">
  <li><form name="Selector">
      <select id="jumpmenu"  name="probe" size="1" onChange="jumpto(document.Selector.probe.options[document.Selector.probe.options.selectedIndex].value)">
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

   
<div id="LayoutDivProbe">
<h3>Current Graphs for <em class="nickname"></em></h3>
<div id="graphimages">
<div class="graphelement" id="graphOne">
<h2 class="loadingtext">Getting graph images</h2>
</div>   
<div class="graphelement" id="graphTwo">
</div>   
<div class="graphelement" id="graphThree">
</div>   
<div class="graphelement" id="graphFour">
</div>   
</div>
</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script>

$( document ).ready(function() {
  var API = "json.php";
    $.getJSON( API, {id : "probeSerial"}, function( data ) {     
    $("#temperature").html(data.temperature);        
    $("#temperaturef").html(data.temperatureF);        
    $(".nickname").html(data.probeNickname);                    
    
    $.each( data.graphImages, function( index, value ) {
    //  $( "<img>" ).attr( "src", value ).appendTo( "#graphimages" );
    //$("<img width='600' height='160' src='" + value + "' border='0' alt='Lazy Image' /'>").appendTo("#graphimages");;
    //  alert(index + ": " + value);
    $(function () {
      var img = new Image();
      $(img).load(function () {
      //$(this).css('display', 'none'); // .hide() doesn't work in Safari when the element isn't on the DOM already
        $(this).hide();
        $('#' + index).removeClass('graphelement').append(this);
        $(".loadingtext").hide();
        $(this).fadeIn();
      }).error(function () {
      // notify the user that the image could not be loaded
      }).attr('src', value);
    });


    
    });
    

    });
});                                                      

$.get( "jumpmenu.php", function( data ) {
  $( "#jumpmenu" ).append( data );
      
});


</script>
</body>
</html>
