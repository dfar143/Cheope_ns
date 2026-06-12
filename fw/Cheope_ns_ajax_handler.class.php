<?
namespace Cheope_ns\fw;
require_once("Generic_interface.class.php");
require_once("Xml_filter.class.php");
require_once("AjaxOps_container.class.php");
require_once("Creator.tra.php");
require_once("Caller.tra.php");

class Cheope_ns_ajax_handler extends Generic_interface
{
//	const ERROR_1 = "Cheope_ns_ajax_handler:Errore nell'inserimento del filtro xml.";
	use Caller;
	use Creator;
	
	private $xmlFilter = null;
	private $opsContainer = null;
	
  function action(string $actStr,Interfaces_container $actInterfacesContainer):void
  {
 	 $this->putData();
  }
	
	function __construct(string $actNum=STRING_NULL)
	{
		parent::__construct(OP_NONE,self::INT_AJAX_HANDLER,$actNum);
		$xmlFilter = $this->createXmlFilter();
		$this->setXmlFilter($xmlFilter);
  }
  
  function setXmlFilter(Xml_filter $actXmlFilter):void
  {
  	 $this->xmlFilter = $actXmlFilter;
  }
  
  function getXmlFilter():Xml_filter
  {
  	return $this->xmlFilter;
  }
  
  function createXmlFilter():Xml_filter
  {
  	return Creator::create(getClassNameForCreate(Classes_info::XML_FILTER_CLASS));
  }
  
  function createArrayItem():Array_item
  {
  	return Creator::create(getClassNameForCreate(Classes_info::ARRAY_ITEM_CLASS),STRING_NULL,array());
  }
  
  function createStringItem():String_item
  {
  	return Creator::create(getClassNameForCreate(Classes_info::STRING_ITEM_CLASS),STRING_NULL,STRING_NULL);
  }
	
	function getOpsContainer():AjaxOps_container
	{
		return $this->opsContainer;
	}
	
	function getContainer():AjaxOps_container
	{
		return $this->opsContainer;
	}
	
	function setOpsContainer(AjaxOps_container $actOps):void
	{
		$this->opsContainer = $actOps; 
	}
	
 function isStandard():bool
 {
 	return false;
 }
	
	function isContainer():bool
	{
		return true;
	}
	
 function isDecorator():bool
 {
  return false;
 }
	
	function getOpByName(string $actName):mixed
	{
    return $this->getOneInContainerByName($actName);
	}
	
	function putData():void
	{
		$xmlFilter = $this->getXmlFilter();
		$getBuf = $_GET;
		$actions = array_keys($getBuf);
		$ids = array_values($getBuf);
		$i=0;
		foreach($actions as $action)
		{
			$op = $this->getOpByName($action);
			//die(print_r($op));
			if (! is_null($op))
			{
				$data = $op->exec_1($ids[$i]);
				if($op->isJsonEnabled())
				{
					echo json_encode($data);
				}
				else
				{
				 if(is_array($data))
				 {
				  $xmlFilter->setItem($data);
				  echo $xmlFilter->exec();
				 }
				 elseif(is_a($data,Classes_info::ITEM_CLASS))
				 {
				  $xmlFilter->setItem($data);
				  echo $xmlFilter->exec();					
				 }
				 else
				  echo $data;
				}
				return;
			}
			$i++;
		}
	}
	
}

?>