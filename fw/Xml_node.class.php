<?
namespace Cheope_ns\fw;
require_once("Serializable_node.class.php");

class Xml_node extends Serializable_node
{
 const ERROR_1 = "Xml_node:Errore nel tipo del serializzatore.";
 const XML_DATA_SOURCE_SUFFIX = "data_source";
 
 function __construct(object $actSerializer,string $actFileName=STRING_NULL)
 {
 	if (is_a($actSerializer,Classes_info::XML_SERIALIZER_CLASS))
 	 parent::__construct($actSerializer,$actFileName);
  else
   die(self::ERROR_1);
 }
 
 function setSerializer(object $actSerializer):void
 {
 	if (is_a($actSerializer,Classes_info::XML_SERIALIZER_CLASS))
 	 parent::setSerializer($actSerializer);
  else
   die(self::ERROR_1); 
 }
	
}

?>