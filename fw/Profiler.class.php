<?
namespace Cheope_ns\fw;
class Profiler
{
 var $startTime;
 var $endTime;
 var $totTimeSec;

 function __construct()
 {
 }
 
 function _getmicrotime():float
 { 
  list($usec, $sec) = explode(" ",microtime()); 
  return ((float)$usec + (float)$sec); 
 }
 
 function start():void
 {
 	$this->startTime = $this->_getmicrotime();
 }
 
 function end():void
 {
 	$this->endTime = $this->_getmicrotime();
 	$this->totTimeSec = $this->totTimeSec + 
 	($this->endTime - $this->startTime);
 }
 
 function reset():void
 {
 	$this->totTimeSec = 0.0;
 }
 
 function print_profile():void
 {
 	
 	echo "<BR>";
 	echo "Tempo:$this->totTimeSec<BR>";
  echo "<BR>";
  
 }
 
}

?>