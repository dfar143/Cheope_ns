<?
namespace Cheope_ns\fw;
require_once("Generic_container.class.php");
require_once("Classes_info.class.php");
require_once("Int_field.class.php");
require_once("Caller.tra.php");

class Int_fields_container extends Generic_container
{	
	Use Caller;
	
//	const ERROR_1 = "Int_fields_container:Errore nell'inserimento del campo nel contenitore";
	const ERROR_2 = "Int_fields_container:Errore nell'aggiunta del campo nel contenitore";
	
	function __construct(string $actName=STRING_NULL)
	{
		parent::__construct($actName);
	}
	
	function setFields(array $actFields):void
	{
		parent::setContents($actFields);
	}
	
	function &getFields():array
	{
 	 $contents = &parent::getContents();
   return $contents;
	}
	
	function setElement(mixed $actItem,string|int $actPos):bool
  {
   if(is_a($actItem,Classes_info::INT_FIELD_CLASS))
    return parent::setElement($actItem,$actPos);
   else
    die(self::ERROR_1);
	}
	
	function add():void
	{
	 foreach(func_get_args() as $arg)
	 if(is_a($arg,Classes_info::INT_FIELD_CLASS))
	 {
    parent::add($arg);
	 }
	 else
	  die(self::ERROR_2);
	}
	
	function create():Generic_iterator
	{
		$newFieldsIterator=Creator::create(getClassNameForCreate(Classes_info::GENERIC_ITERATOR_CLASS),STRING_NULL,$this);
		return $newFieldsIterator;
	}
	  
  function getField(string $actFieldName):?Int_field
  {
   return $this->getOneInSetByName($actFieldName);
  }
  	
}

?>