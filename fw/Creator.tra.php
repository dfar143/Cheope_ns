<?
namespace Cheope_ns\fw;

require_once("generic.const.php");

//
// Fallisce coi le variabili passate per riferimento nei costruttori.
// però funziona con un numero qualsiasi di argomenti.
//


trait Creator_B
{
	
	static function getNew():object {
    return self::newFrom(func_get_args());
  }

  static function newFrom(array $args):object {
    return self::makeFrom(get_called_class(), $args);
  }
  
  static function make(string $className):object {
    return self::makeFrom($className, self::noHead(func_get_args()));
  }

  static function makeFrom(string $className, array $args):object {
    return (new \ReflectionClass($className))->newInstanceArgs($args);
  }

  static function noHead(array $arr,int $how=1):array {
    self::popHead($arr, $how);
    return $arr;
  }

  static function popHead(array &$arr,int $how=1):array {
    if ($how == 1) return array_shift($arr);
    $ret = [];
    for ($i=0; $i<$how; ++$i) $ret[] = array_shift($arr);
    return $ret;
  }
  
  static function create_b():object
  {
  	
  	$type = isset(func_get_args()[0])?(func_get_args()[0]):(STRING_NULL);
  	$scope = isset(func_get_args()[1])?(func_get_args()[1]):(STRING_NULL);
		if(($scope !== __NAMESPACE__)&&($scope !== STRING_NULL)&&($scope !== STRING_BACKSLASH))
		 $className = $scope . STRING_BACKSLASH . $type;
		elseif($scope == STRING_BACKSLASH) 
		 $className = $type;
		else
		 $className = __NAMESPACE__ . STRING_BACKSLASH . $type;
		 
		 $obj = self::makeFrom($className, self::noHead(func_get_args(),2));
		 return $obj;  
  }
  
}


trait Creator 
{
	static function create(string $actType,string $actScope=STRING_NULL,
	$actItem1=null,
	$actItem2=null,
	$actItem3=null,
	$actItem4=null,
	$actItem5=null,
	$actItem6=null,
    $actItem7=null,
    $actItem8=null,
	$actItem9=null,
	$actItem10=null,
	$actItem11=null)
	{	  
				
		if(($actScope !== __NAMESPACE__)&&($actScope !== STRING_NULL)&&($actScope !== STRING_BACKSLASH))
		 $className = $actScope . STRING_BACKSLASH . $actType;
		elseif($actScope == STRING_BACKSLASH) 
		 $className = $actType;
		else
		 $className = __NAMESPACE__ . STRING_BACKSLASH . $actType;

		if(! is_null($actItem10))
		 $obj = new $className($actItem1,$actItem2,
		 $actItem3,$actItem4,$actItem5,$actItem6,$actItem7,
		 $actItem8,$actItem9,$actItem10,$actItem11);
		elseif(! is_null($actItem9))
		 $obj = new $className($actItem1,$actItem2,
		 $actItem3,$actItem4,$actItem5,$actItem6,$actItem7,
		 $actItem8,$actItem9,$actItem10,$actItem9);		
		elseif(! is_null($actItem9))
		 $obj = new $className($actItem1,$actItem2,
		 $actItem3,$actItem4,$actItem5,$actItem6,$actItem7,
		 $actItem8,$actItem9,$actItem9);		
		elseif(! is_null($actItem8))
		 $obj = new $className($actItem1,$actItem2,
		 $actItem3,$actItem4,$actItem5,$actItem6,$actItem7,
		 $actItem8);		
		elseif(! is_null($actItem7))
		 $obj = new $className($actItem1,$actItem2,
		 $actItem3,$actItem4,$actItem5,$actItem6,$actItem7);
		elseif(! is_null($actItem6))
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