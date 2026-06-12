<?
namespace Cheope_ns\fw;

require_once("class.const.php");

trait Serialize_props
{
	function serialize_props_exec(array $actBooleanPropsArray=array(),array $actArrayPropsArray=array(),array $actTextPropsArray=array(),array $actPercPropsArray):void
	{
 	  $serializer = $this->getSerializer();
	  $reflect = new \ReflectionClass($this);
	  $props1  = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE);
	  $props2  = $reflect->getProperties(\ReflectionProperty::IS_STATIC);
	  $props3 = $reflect->getProperties(\ReflectionProperty::IS_PROTECTED);
	  $props4 = array_diff($props1,$props2);
	  $props = array_merge($props3,$props4);
	  foreach($props as $prop)
	  { 		
		$code1 = "\$$prop->name" . "=" . "\$this->get" . ucfirst($prop->name) . "();";
		$code21 = "if ((! is_object(\$$prop->name)) || (is_a(\$$prop->name,\"" . 
		GENERIC_CONTAINER_CLASS . "\") || (is_a(\$$prop->name,\"" .  GENERIC_INTERFACE_CLASS . "\")))){";
	    if(! in_array($prop->name,$actBooleanPropsArray))
		 $code22 = "\$item" . "=" . "array(\"" . $prop->name . "\"=>" . "\$$prop->name);";
	    else
		{
		 $code22 = "\$item" . "=" . "array(\"*" . $prop->name . "\"=>" . "\$$prop->name);";
		}
	    if(! in_array($prop->name,$actArrayPropsArray))
		 $code23 = "\$item" . "=" . "array(\"" . $prop->name . "\"=>" . "\$$prop->name);";
	    else
		{
		 $code23 = "\$item" . "=" . "array(\"\$" . $prop->name . "\"=>" . "\$$prop->name);";
		}
	    if(! in_array($prop->name,$actTextPropsArray))
		 $code24 = "\$item" . "=" . "array(\"" . $prop->name . "\"=>" . "\$$prop->name);";
	    else
		{
		 $code24 = "\$item" . "=" . "array(\"\@" . $prop->name . "\"=>" . "\$$prop->name);";
		}
	    if(! in_array($prop->name,$actPercPropsArray))
		 $code25 = "\$item" . "=" . "array(\"" . $prop->name . "\"=>" . "\$$prop->name);";
	    else
		{
		 $code25 = "\$item" . "=" . "array(\"\%" . $prop->name . "\"=>" . "\$$prop->name);";
		}
		$code26 = "\$serializer->loadItems(\$item);}";
		$code3 = $code1 . $code21 . $code22 . $code23 . $code24 . $code25 . $code26;
		//echo $code3 . STRING_EOL;
		eval($code3);
	  }
	}
}

?>