<?
namespace Cheope_ns\fw;
require_once("generic.const.php");

interface Serializable
{
	// Salva gli item in un buffer in memoria (nel caso del Xml_serializer
	// è un DOMDocument).
 function loadItems(array|string $actItems=STRING_NULL):void;
	
	// Salva il buffer su disco.
 function saveData():void;
  
  // Carica da disco.
 function loadData():void;
}

?>