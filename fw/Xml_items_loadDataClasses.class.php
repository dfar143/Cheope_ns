<?
namespace  Cheope_ns\fw;
require_once("Items_factory.class.php");
require_once("Factory_2.int.php");
require_once("Executable_7.int.php");
require_once("Creator.tra.php");

abstract class LoadData_items_base implements Executable_7
{
//	const ERROR_1="LoadData_items_base:L'object caller non può essere nullo.";
//	const ERROR_2="LoadData_items_base:L'oggetto deve essere di tipo Items_factory.";
//	const ERROR_3="LoadData_items_base:L'oggetto non può essere null.";
	
	protected $callerObj=null;
	protected $itemsFactory=null;
	protected $item=null;
	
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		$this->setCallerObj($actCallerObj);
		$this->setItemsFactory($actItemsFactory);
		$this->setItem($actItem);
	}
	
	function setCallerObj(Xml_items_serializer $actCallerObj):void
	{
		 $this->callerObj=$actCallerObj;
	}
	
	function getCallerObj():Xml_items_serializer
	{
		return $this->callerObj;
	}
	
	function setItemsFactory(Items_factory $actItemsFactory):void
	{
	   $this->itemsFactory = $actItemsFactory;
	}
	
	function getItemsFactory():Items_factory
	{
		return $this->itemsFactory;
	}
	
	function setItem(\SimpleXMLElement $actItem):void
	{
//		if(! is_null($actItem))
		 $this->item = $actItem;
//	  else
//	   die(self::ERROR_3);
	}
	
	function getItem():\SimpleXMLElement
	{
		return $this->item;
	}
	
}

class LoadData_items_sections extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Sections");
   	$newItem = $itemsFactory->create($values);
   	$newItem->setName((string)$item["name"]);
   	return $newItem;
	}
}

class LoadData_items_section extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Section");
   	$newItem = $itemsFactory->create($values);
   	$newItem->setName((string)$item["name"]);
   	return $newItem;
	}
}

class LoadData_items_code extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}

	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Code");
   	$newItem = $itemsFactory->create((count($values)>0)?(string)$values[0]:STRING_NULL);
   	return $newItem;
	}	
	
}

class LoadData_items_def extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Def");
   	$newItem = $itemsFactory->create($values);
   	return $newItem;
	}
}

class LoadData_items_function_call extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Function_call");
   	$newItem = $itemsFactory->create($values);
   	$newItem->setName((string)$item["name"]);
   	return $newItem;
	}
}

class LoadData_items_method_call extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Method_call");
   	$newItem = $itemsFactory->create($values);
   	$newItem->setName((string)$item["name"]);
   	//var_dump($newItem);
   	$newItem->setParent((((string)$item["parent"]=="true")||
   	((string)$item["parent"]=="1"))? true : false );
   	return $newItem;
	}
}

class LoadData_items_class_prop extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Class_prop");
   	$newItem = $itemsFactory->create($values[0]);
   	$newItem->setName((string)$item['name']);
   	return $newItem;
	}
}


class LoadData_items_class_def extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Class_def");
   	$newItem = $itemsFactory->create($values[0]);
   	$newItem->setName((string)$item['name']);
   	$newItem->setExtendsClass((string)$item['extends']);
   	return $newItem;
	}
}

class LoadData_items_class_var extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Class_var");
   	$newItem = $itemsFactory->create($values);
   	return $newItem;
	}
}

class LoadData_items_function_def extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
  	$itemsFactory->setItemStr("Function_def");
   	$newItem = $itemsFactory->create($values);
   	$newItem->setName((string)$item['name']);
	$newItem->setRetType((string)$item["retType"]);
   	return $newItem;
	}
}

class LoadData_items_block_def extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Block_def");
   	if(isset($item['brackets']))
   	   $brackets = (string)$item['brackets'];
   	else
   	   $brackets=false;
   	$newItem = $itemsFactory->create($values);
   	$newItem->setName((string)$item['name']);
   	$newItem->setBrackets($brackets);
   	return $newItem;
	}
}

class LoadData_items_concat extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Concat");
   	$newItem = $itemsFactory->create($values);
   	$newItem->setName((string)$item['name']);
   	return $newItem;
	}
}

class LoadData_items_cond extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Cond");
   	$newItem = $itemsFactory->create($values[0]);
   	return $newItem;
	}
}

class LoadData_items_expr extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Expr");
   	$newItem = $itemsFactory->create((count($values)>0)?(string)$values[0]:STRING_NULL);   	
   	return $newItem;
	}
}

class LoadData_items_if_else extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("If_else");
   	$newItem = $itemsFactory->create($values);   	
   	return $newItem;
	}
}

class LoadData_items_args_list extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Args_list");
   	$newItem = $itemsFactory->create($values);   	
   	return $newItem;
	}
}

class LoadData_items_constructor_call extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Constructor_call");
   	$newItem = $itemsFactory->create($values);
   	$newItem->setName((string)$item['name']);
   	return $newItem;
	}
}

class LoadData_items_arg extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	if(isset($values[0]))
   	   $value = $values[0];
   	else
   	   $value = null;
   	$itemsFactory->setItemStr("Arg");
   	$newItem = $itemsFactory->create($value);
   	return $newItem;
	}
}

class LoadData_items_var extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Var");
   	$newItem = $itemsFactory->create((string)$values[0]);   	
   	return $newItem;
	}
}

class LoadData_items_const extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Const");
   	$newItem = $itemsFactory->create((count($values)>0)?(string)$values[0]:STRING_NULL);  	
   	return $newItem;
	}
}

class LoadData_items_ref extends LoadData_items_base
{
	private $resolveRef=true;
	private $appDir=STRING_NULL;
	
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function getAppDir():string
	{
		return $this->appDir;
	}
	
	function setAppDir(string $actAppDir):void
	{
		$this->appDir=$actAppDir;
	}

  function getResolveRef():string
  {
  	return $this->resolveRef;
  }
  
  function setResolveRef(string $actResolveRef):void
  {
  	$this->resolveRef = $actResolveRef;
  }
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$resolveRef = $this->getResolveRef();
   	if($resolveRef)
   	{
   	 $newSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL);
   	 //$newSerializer = new Xml_items_serializer();
   	 $appDir = $this->getAppDir();
   	 if($appDir==STRING_NULL)
   	   $newSerializer->setFileName(trim($item) . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX);
   	 else
   	   $newSerializer->setFileName($appDir . DIR_SEP . trim($item) . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX);
   	 $newSerializer->loadData();
   	 $newItems = $newSerializer->getItems();
   	 $values = $newItems;
   	 $itemsFactory->setItemStr("Array");
   	 $newItem = $itemsFactory->create($values);
   	}
   	else
   	{
   	 $values = $callerObj->loadDataRecurse($item);
     $itemsFactory->setItemStr("Ref");
   	 $newItem = $itemsFactory->create((string)$values[0]);
    }
   	return $newItem;
	}
}

class LoadData_items_associative extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Associative");
   	$newItem = $itemsFactory->create($values);
   	return $newItem;
	}
}

class LoadData_items_string extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("String");
   	$type = (string)$item['type'];
   	$name = (string)$item['name'];
   	$newItem = $itemsFactory->create((count($values)>0)?(string)$values[0]:STRING_NULL);
   	$newItem->setType($type);
   	$newItem->setName($name);
   	return $newItem;
	}
}

class LoadData_items_namespace extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Namespace");
   	$name = (string)$item['name'];
   	$newItem = $itemsFactory->create((count($values)>0)?(string)$values[0]:STRING_NULL);
   	$newItem->setName($name);
   	return $newItem;
	}
}

class LoadData_items_clone_call extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	if(isset($values[0]))
   	   $value = $values[0];
   	else
   	   $value = null;
   	$itemsFactory->setItemStr("Clone_call");
   	$newItem = $itemsFactory->create($value);
   	return $newItem;
	}
}

class LoadData_items_array extends LoadData_items_base
{
	function __construct(Xml_items_serializer $actCallerObj,
	Items_factory $actItemsFactory,\SimpleXMLElement $actItem)
	{
		parent::__construct($actCallerObj,$actItemsFactory,$actItem);
	}
	
	function exec():Item
	{
		$callerObj = $this->getCallerObj();
		$itemsFactory = $this->getItemsFactory();
		$item = $this->getItem();
   	$values = $callerObj->loadDataRecurse($item);
   	$itemsFactory->setItemStr("Array");
   	$newArrayItem = $itemsFactory->create($values);
   	return $newItem;
	}
}


class LoadData_items_factory implements Factory_2
{
	Use Creator;
//	const ERROR_1="LoadData_items_factory:L'item non può essere vuoto.";
//	const ERROR_2="LoadData_items_factory:L'oggetto deve essere di tipo Items_factory.";
	
	private $item=STRING_NULL;
	private $itemsFactory=null;
	private $resolveRef=true;
	private $appDir=STRING_NULL;
	
	function __construct(\SimpleXMLElement $actItem,
	Items_factory $actItemsFactory)
	{
		$this->setItem($actItem);
		$this->setItemsFactory($actItemsFactory);
	}
	
	function setResolveRef(bool $actResolveRef):void
	{
		$this->resolveRef = $actResolveRef;
	} 
	
	function getResolveRef():bool
	{
		return $this->resolveRef;
	}
	
	function setAppDir(string $actAppDir):void
	{
		$this->appDir = $actAppDir;
	} 
	
	function getAppDir():string
	{
		return $this->appDir;
	}
	
	function setItem(\SimpleXMLElement $actItem):void
	{
	//	if($actItem !== STRING_NULL)
		 $this->item = $actItem;
	//  else
	//   die(self::ERROR_1);
	}
	
	function getItem():\SimpleXMLElement
	{
		return $this->item;
	}
	
	function setItemsFactory(Items_factory $actItemsFactory):void
	{
		 $this->itemsFactory = $actItemsFactory;
	}
	
	function getItemsFactory():Items_factory
	{
		return $this->itemsFactory;
	}
	
	function create(Xml_items_serializer $actCallerObj,
	string $actInd):object
	{
		$item = $this->getItem();
		$itemsFactory = $this->getItemsFactory();
		$loadDataClass = "LoadData" . 
		VAR_SEP . "items" . VAR_SEP . $actInd;
		$obj = Creator::create($loadDataClass,STRING_NULL,$actCallerObj,$itemsFactory,$item);
   	if($actInd=="ref")
   	{
      $obj->setResolveRef($this->getResolveRef());
      $obj->setAppDir($this->getAppDir());
   	} 	    	     	    	  
    return $obj;		
	}
}

?>