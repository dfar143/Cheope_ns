<?
namespace Cheope_ns\fw;

require_once("generic.const.php");

class Creator_b
{
  private function __construct()
  {
  }

	static function getNew():object {
    return self::newFrom(func_get_args());
  }

  static function newFrom(array $args):object {
    return self::makeFrom(get_called_class(), $args);
  }
  
  static function make($className):object {
    return self::makeFrom($className, self::noHead(func_get_args()));
  }

  static function makeFrom(string $className, array $args):object {
    return (new \ReflectionClass($className))->newInstanceArgs($args);
  }

  static function noHead(array $arr, int $how=1):array {
    self::popHead($arr, $how);
    return $arr;
  }

  static function popHead(array &$arr,int $how=1):array {
    if ($how == 1) return array_shift($arr);
    $ret = [];
    for ($i=0; $i<$how; ++$i) $ret[] = array_shift($arr);
    return $ret;
  }
  
  static function create():object
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

?>