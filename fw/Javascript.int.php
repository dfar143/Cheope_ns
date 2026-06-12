<?
namespace Cheope_ns\fw;

interface Javascript
{
	 public function hasJavascriptManagement():bool;
	 public function putJavascriptInitializationCode(string $actPar):void;
     public function hasJavascriptEnabledSwitch():bool;
     public function setJavascriptEnabled(bool $actJavascriptEnabled):void;
	 public function getDelayedModule():bool;
	 public function setDelayedModule(bool $actDelayedModule):void;
}

?>