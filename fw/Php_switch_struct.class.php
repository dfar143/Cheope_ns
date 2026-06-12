<?
namespace Cheope_ns\fw;
require_once("Html_formatted_interface.class.php");
require_once("Interfaces_container.class.php");


class Php_switch_struct extends Html_formatted_interface
{
	
	const ERROR_0 = "Php_switch_struct:Errore condizione non frammento php.";
	const ERROR_1 = "Php_switch_struct:Errore branch non frammento php.";
	const DEFAULT_EXECUTE_AT_ONCE = true;
	
 	private $selectCondition = STRING_NULL;
 	private $conditionsContainer = null;
	private $branchesContainer = null;
  private $executeAtOnce=self::DEFAULT_EXECUTE_AT_ONCE;
  static $hasCssManagement=false;
  static $hasJavascriptManagement = false;
  static private $switchPhpStructTotNum=0;
		
	function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
	{
		self::$switchPhpStructTotNum++;
		if($actNum === STRING_NULL)
		{
			$actNum = self::$switchPhpStructTotNum - 1;
		}
		$conditionsContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $this->setConditionsContainer($conditionsContainer);
    $branchesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $this->setBranchesContainer($branchesContainer);
    parent::__construct($actOp,self::INT_PHP_SWITCH_STRUCT,$actNum);
	}
	
	function hasJavascriptManagement():bool
	{
		return self::$hasJavascriptManagement;
	}
 
	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}	
	
  static function getInterfacesTotNum():string|int
  {
 	 return self::$switchPhpStructTotNum;
  }
 
  static function setInterfacesTotNum(int|string $actIntNum):void
  {
 	  self::$switchPhpStructTotNum=$actIntNum + 0;
  }
  
  function enableBootstrap():void
 {
 }
  
 function setExecuteAtOnce(bool $actExecute):void
 {
  $this->executeAtOnce = $actExecute;
 }
 
 function getExecuteAtOnce():bool
 {
 	if($this->executeAtOnce == STRING_NULL)
 	 return self::DEFAULT_EXECUTE_AT_ONCE;
 	else
 	 return $this->executeAtOnce;
 }
  
 function isStandard():bool
 {
 	return false;
 }
 
 function isDecorator():bool
 {
 	return false;
 }
 
 function isContainer():bool
 {
 	return false;
 }
  
 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$selectCondition = $this->getSelectCondition();
 	$item1 = array("@selectCondition"=>$selectCondition);
 	$conditionsContainer = $this->getConditionsContainer();
 	$item2 = array("conditionsContainer"=>$conditionsContainer);
 	$serializer->loadItems($item2); 
 	$branchesContainer = $this->getBranchesContainer();
 	$item3 = array("branchesContainer"=>$branchesContainer);
 	$serializer->loadItems($item3);
 	$executeAtOnce = $this->getExecuteAtOnce();
 	$item4 = array("executeAtOnce"=>$executeAtOnce);
 	$serializer->loadItems($item4);	  	
 }
	
	function getSelectCondition():string
	{
		return $this->selectCondition;
	}
	
	function setSelectCondition(string $actSelectCondition):void
	{
	 $this->selectCondition = $actSelectCondition;	
	}
	
	function setConditionsContainer(Interfaces_container $actConditionsContainer):void
	{
		foreach($actConditionsContainer as $val)
    {
    	if(!((is_a($val,Classes_info::PHP_FRAGMENT_CLASS) 
    	|| is_a($val,Classes_info::PHP_DATA_FRAGMENT_CLASS))))
      {
      	die(self::ERROR_0);
      }
    }
		$this->conditionsContainer = $actConditionsContainer;
	}
	
	function getConditionsContainer():Interfaces_container
	{
		return $this->conditionsContainer;
	}
	
	function setBranchesContainer(Interfaces_container $actBranchesContainer):void
	{
		foreach($actBranchesContainer as $val)
    {
    	if(!((is_a($val,Classes_info::PHP_FRAGMENT_CLASS) ||
    	 is_a($val,Classes_info::PHP_DATA_FRAGMENT_CLASS))))
      {
      	die(self::ERROR_1);
      }
    }
		$this->branchesContainer = $actBranchesContainer;
	}
	
	function getBranchesContainer():Interfaces_container
	{
		return $this->branchesContainer;
	}
	
	function putData():void
	{
	 	$selectCondition = $this->getSelectCondition();
    $branchesContainer = $this->getBranchesContainer();
    $conditionsContainer = $this->getConditionsContainer();
    $structureStr = "switch(" . $selectCondition . ")" 
    . STRING_RETURN . STRING_LINE_FEED;	
    $structureStr .= STRING_OPEN_GRAFF_BRACKET;
    $branchesIterator = $branchesContainer->create();
    $branchesIterator->reset();
    $conditionsIterator = $conditionsContainer->create();
    $conditionsIterator->reset(); 
    $htmlWriter = $this->getHtmlWriter();
    while($branchesIterator->hasMore())
    {
     $cond = $conditionsIterator->current();
     $branch = $branchesIterator->current();
     $structureStr .= STRING_RETURN . STRING_LINE_FEED . 
     "case" . STRING_SPACE . $cond->getPhpFragment() . STRING_COLON . STRING_RETURN . 
     STRING_LINE_FEED . $branch->getPhpFragment() . STRING_RETURN . STRING_LINE_FEED . 
     "break" . STRING_SEMICOLON . STRING_RETURN . STRING_LINE_FEED;
     $conditionsIterator->next();
     $branchesIterator->next();
    } 
    $structureStr .= STRING_CLOSE_GRAFF_BRACKET;
 	  $executeAtOnce = $this->getExecuteAtOnce();
 	  if($executeAtOnce)
	  {
 	   $thisObj = $this;
 	   $fragmentFun = static function($actPhpFragment) use ($thisObj)
 	   {
		//echo $actPhpFragment;
 	 	eval($actPhpFragment);
 	   };
 	 $fragmentFun($structureStr); 	  
	 }
 	  else
 	   $htmlWriter->put($structureStr); 	
	}
}

?>