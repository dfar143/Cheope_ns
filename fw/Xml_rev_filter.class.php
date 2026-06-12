<?
namespace Cheope_ns\fw;
require_once("Filter.class.php");

//
// Carica un file xml in un oggetto php SimpleXml 
// e poi lo trasforma in un elemento php (array o scalare). 
//

class Xml_rev_filter extends Filter 
{
	function __construct()
	{
		parent::__construct();
	}
	
	function exec_recurse(\SimpleXMLElement $actItem,
	string &$actInd):array|string
	{
	 $values = array();
	 $loadedValues = array();
	 
	 if($actItem['type']=="array")
	 {
	 	foreach($actItem->children() as $itemVal)
	 	{
     $value = $this->exec_recurse($itemVal,$actInd);
	 	 $values[$actInd] = $value;
	 	}
	 	$actInd = (string)$actItem['id'];
	 	$loadedValues = $values;
	 }
	 elseif($actItem['type']=="scalar")
	 {
	 	$actInd=(string)$actItem['id'];
	 	if(is_numeric($actInd))
	 		$actInd = (int)$actInd;
	 	$loadedValues = (string)$actItem;
	 }
	 else
	 {
    $loadedValues = (string)$actItem;
	 }
	 return $loadedValues;
	}
	
	function exec():array
	{
	 $item = $this->getItem();
	 $xml = simplexml_load_string($item);
	 $loadedValues=array();
	 $ind = STRING_NULL;
	 foreach($xml->children() as $item)
	 {
	  $values = $this->exec_recurse($item,$ind);
	  $loadedValues[$ind] = $values;
	 }
	 return $loadedValues;		
	}
	
}
?>