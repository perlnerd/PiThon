<?php
class myTherm {
	//var $probe = array();
	var $probeSerial;
	var $probeNickname;
	var $probePath;
	var $probeOutput = array();
	var $piece;
	var $pieces;
	var $lines;
	var $temperature;
	var $temperatureF;
	var $graphImages = array();

	//functions to deal with a single probe
	
	function getProbe(){
		return $this->probe;
	}
	function setProbeSerial($serial) {
		$this->probeSerial = $serial;	
	}
	function setProbeNickname($nickname) {
		$this->probeNickname = $nickname;	
	}
	function getProbeNickname() {
		return $this->probeNickname;
	}
	function getProbeSerial() {
		return $this->probeSerial;
	}
	
	
	function setProbePath($serial){
		$this->probePath = '/sys/bus/w1/devices/' . $serial . '/w1_slave';		

	}
	function setRawProbeInfo(){
		$this->lines = file($this->probePath);
	}
	function setCleanProbeInfo(){
		
		$this->piece = $this->lines[1];

		$this->pieces = explode("=",$this->piece);
		// divide raw temp by 1000 and format to 2 decimal places
	    	$this->temperature = sprintf("%01.2f", $this->pieces[1]/1000);
    		$this->temperatureF = sprintf("%01.2f",intval((9/5)* $this->temperature + 32));
	}
	function getTemperature(){
		return $this->temperature;
	}
	function getTemperatureF(){
		return $this->temperatureF;
	}
	function setGraphImages(){
	        $this->graphImages = array("graphOne"=>"plot/OneHrsplot.php?id=" . $this->probeSerial,
	                              "graphTwo"=>"plot/SixHrsplot.php?id=" . $this->probeSerial, 
	                              "graphThree"=>"plot/TwentyFourHrsplot.php?id=" . $this->probeSerial, 
	                              "graphFour"=>"plot/OneWeekplot.php?id=" . $this->probeSerial);
	}
	function getGraphImages(){
	        return $this->graphImages;
	}
//function setProbe($nickname,$serial) {
	//		//$this->probe = array();
	//	$this->probe[$nickname] = $serial;
	//}
	



}



?>