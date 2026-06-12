<?
namespace Cheope_ns\fw;
require_once("Serializable_node.class.php");
require_once("Json_serializer.class.php");

class Json_node extends Serializable_node
{
 const ERROR_1 = "Json_node:Errore nel tipo del serializzatore.";
 const JSON_DATA_SOURCE_SUFFIX = "data_source";
 
 function __construct(Serializer $actSerializer,string $actFileName=STRING_NULL)
 {
 	if (is_a($actSerializer,Classes_info::JSON_SERIALIZER_CLASS))
 	 parent::__construct($actSerializer,$actFileName);
  else
   die(self::ERROR_1);
 }
 
 function setSerializer(Serializer $actSerializer):void
 {
 	if (is_a($actSerializer,Classes_info::JSON_SERIALIZER_CLASS))
 	 parent::__construct($actSerializer,$actFileName);
  else
   die(self::ERROR_1);
 }
	
}

?>