<?
namespace Cheope_ns\fw;
 interface Css
 {
  public function hasCssManagement():bool;
  public function getCssModule():array|string;
  public function setCssModule($actCssModule);
  public function getCssClass():string;
  public function setCssClass(string $actCssClass):void;
 }
?>