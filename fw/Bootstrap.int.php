<?
namespace Cheope_ns\fw;
 interface Bootstrap
 {
  public function getBootstrapEnabled():bool; 
  public function setBootstrapEnabled(bool $actBootstrapEnabled):void;
  public function enableBootstrap():void;
 }
?>