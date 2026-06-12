<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Xml_filter.class.php");
require_once(FRAMEWORK_PATH . "Xml_rev_filter.class.php");

$item1 = array("campo21"=>"b1");
$item2 = array("campo1"=>"a","campo2"=>$item1,"campo3"=>"c");
$xml_filter = new Xml_filter();
$xml_filter->setItem($item2);
$xml =  $xml_filter->exec();
echo $xml;
$xml_rev_filter = new Xml_rev_filter();
$xml_rev_filter->setItem($xml);
$item3 =$xml_rev_filter->exec();
print_r($item3);
?>