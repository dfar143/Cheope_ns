<?
namespace Cheope_ns\fw;

require_once("generic.const.php");

class Creator_class
{
	private function __construct()
	{
	}
	
	static function create(string $actType,string $actScope=STRING_NULL,
	mixed $actItem1=null,
	mixed $actItem2=null,
	mixed $actItem3=null,
	mixed $actItem4=null,
	mixed $actItem5=null,
	mixed $actItem6=null):object
	{	  
				
		if(($actScope !== __NAMESPACE__)&&($actScope !== STRING_NULL)&&($actScope !== STRING_BACKSLASH))
		 $className = $actScope . STRING_BACKSLASH . $actType;
		elseif($actScope == STRING_BACKSLASH) 
		 $className = $actType;
		else
		 $className = __NAMESPACE__ . STRING_BACKSLASH . $actType;

		if(! is_null($actItem6))
		 $obj = new $className($actItem1,$actItem2,
		 $actItem3,$actItem4,$actItem5,$actItem6);
		elseif(! is_null($actItem5))
		 $obj = new $className($actItem1,$actItem2,
		 $actItem3,$actItem4,$actItem5);		 
		elseif(! is_null($actItem4))
		 $obj = new $className($actItem1,$actItem2,$actItem3,$actItem4);
		elseif(!is_null($actItem3))
		 $obj = new $className($actItem1,$actItem2,$actItem3);
		elseif(! is_null($actItem2))
		 $obj = new $className($actItem1,$actItem2);
		elseif(! is_null($actItem1))
		 $obj = new $className($actItem1);
		else
		 $obj = new $className();

		return $obj;
	}


}

?>