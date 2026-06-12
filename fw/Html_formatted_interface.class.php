<?
namespace Cheope_ns\fw;

require_once("Html_writer.class.php");
require_once("Generic_interface.class.php");
require_once("Creator.tra.php");
require_once("Css.int.php");
require_once("Bootstrap.int.php");
require_once("Javascript.int.php");
require_once("JQuery.int.php");
require_once("Dojo.int.php");


abstract class Html_formatted_interface extends Generic_interface implements Css,Bootstrap,Javascript,JQuery,Dojo
{
	
	const ERROR_1 = "Html_formatted_interface:Errore nell'inserimento dell'Html_writer.";
	const ERROR_2 = "Html_formatted_interface:Errore nell'inserimento dei disp fields.";
	const ERROR_3 = "Html_formatted_interface:Errore impostazioni di classe javascript.";
	
	protected $dispFields=array();
	protected $cssClass=STRING_NULL;
	protected $style=STRING_NULL;
	protected $javascriptModule=STRING_NULL;
	protected $cssModule=STRING_NULL;
	protected $bootstrapEnabled=false;
	protected $javascriptEnabled=false;
	protected $delayedModule = false;
	protected $htmlWriter=null;
	static private $htmlFormattedInterfacesTotNum = 0;
	static $useShortNameAsInterfaceId = true;
	static $useJQuery = false;
	static $useDojo = false;
	//
	// Flag inclusione modulo Js esterno associato eventualmente 
	// codice di inizializzazione - abilita gestione javascript switch.
	static $hasJavascriptEnabledSwitch = false;
	// Flag abilitazione gestione javascript 
	static $hasJavascriptManagement = false;
	// Flag gestione Css (Inclusione file css associati alle classi)
	static $hasCssManagement=false;
	
	function __construct(string $actOp=OP_NONE,string $actType,$actNum=STRING_NULL)
	{
		self::$htmlFormattedInterfacesTotNum++;
 	  if($actNum === STRING_NULL)
 	   $actNum = self::$htmlFormattedInterfacesTotNum-1;
		parent::__construct($actOp,$actType,$actNum);
		$itemStack = $this->getItemStack();
		$htmlWriter = self::createHtmlWriter();
		$htmlWriter->setItemStack($itemStack);
		$this->setHtmlWriter($htmlWriter);
		if(! self::testJavascriptCorrectness())
	    {
		 echo $actType;
		 die(self::ERROR_3);
		}
	} 
	
	
	static function testJavascriptCorrectness():bool
	{
		if((!self::$hasJavascriptManagement)&&
		((self::$useJQuery)||(self::$hasJavascriptEnabledSwitch)||(self::$useDojo)))
		 return false;
		return true;
	}
	
	function getInterfaceId(string $actSepChar=self::INTERFACE_ID_CHAR_SEP):string
	{
		if(self::$useShortNameAsInterfaceId)
		{
			$intShortName = $this->getShortName();
			if($intShortName!==STRING_NULL)
			 return $intShortName;
			else
			 return parent::getInterfaceId($actSepChar);
		}
		return parent::getInterfaceId($actSepChar);
	}
	
//	function exec()
//	{}

//    function enableBootstrap()
//	{
//	}
	
	function useJQuery():bool
	{
		return self::$useJQuery;
	}
	
	function useDojo():bool
	{
		return self::$useDojo;
	}
	
	function hasJavascriptEnabledSwitch():bool
	{
		return self::$hasJavascriptEnabledSwitch;
	}
	
	function hasJavascriptManagement():bool
	{
		return self::$hasJavascriptManagement;
	}
	
	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}
	
  function setJavascriptEnabled(bool $actJavascriptEnabled):void
  {
	$this->javascriptEnabled=$actJavascriptEnabled;  
  }
  
  function getJavascriptEnabled():bool
  {
	 return $this->javascriptEnabled;
  }
  
  function setDelayedModule(bool $actDelayedModule):void
  {
	$this->delayedModule=$actDelayedModule;  
  }
  
  function getDelayedModule():bool
  {
	 return $this->delayedModule;
  }
	 
 static function getInterfacesTotNum():string|int
 {
 	return self::$htmlFormattedInterfacesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
  self::$htmlFormattedInterfacesTotNum=$actIntNum;
 }

 function serialize():void
 {
 	parent::serialize();
 	$serializer = $this->getSerializer();
 	$cssClass = $this->getCssClass();
 	$item1 = array("cssClass"=>$cssClass);
 	$serializer->loadItems($item1);
 	$style = $this->getStyle();
 	$item2 = array("@style"=>$style);
 	$serializer->loadItems($item2);
 	$dispFields = $this->getDispFields();
 	$item3 = array("\$dispFields"=>$dispFields);
 	$serializer->loadItems($item3);
 	$bootstrapEnabled = $this->getBootstrapEnabled();
 	$item4 = array("*bootstrapEnabled"=>$bootstrapEnabled);
 	$serializer->loadItems($item4);
 	$javascriptEnabled = $this->getJavascriptEnabled();
 	$item41 = array("*javascriptEnabled"=>$javascriptEnabled);
 	$serializer->loadItems($item41);
 	$javascriptModule = $this->getJavascriptModule();
 	$item5 = array("javascriptModule"=>$javascriptModule);
 	$serializer->loadItems($item5);
 	$cssModule = $this->getCssModule();
 	$item6 = array("cssModule"=>$cssModule);
 	$serializer->loadItems($item6);
 	$delayedModule = $this->getDelayedModule();
 	$item7 = array("delayedModule"=>$delayedModule);
 	$serializer->loadItems($item7);
 }

 
 function getJavascriptModule():array|string
 {
 	return $this->javascriptModule;
 }
 
 function setJavascriptModule(string|array $actJavascriptModule):void
 {
 	$this->javascriptModule = $actJavascriptModule;
 }
 
 function getCssModule():array|string
 {
 	return $this->cssModule;
 }
 
 function setCssModule($actCssModule):void
 {
 	$this->cssModule = $actCssModule;
 }
 
 function setHtmlWriter(?Html_writer $actHtmlWriter):void
 {
 	 $this->htmlWriter = $actHtmlWriter;
 }
 
 function getHtmlWriter():?Html_writer
 {
 	return $this->htmlWriter;
 }
 
 function setCREnabled(bool $actEnabled):void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$htmlWriter->setCREnabled($actEnabled);
 }
	
 function setDispFields(array|string $actDispFields):void
 {
 	if(is_array($actDispFields))
   $this->dispFields = $actDispFields;
  else
   $this->dispFields = array($actDispFields);
  /*else
   die(ERROR_2);*/
 }
 
 function getDispFields():array
 {
  return $this->dispFields;
 }
	
	function getCssClass():string
	{
		return $this->cssClass;
	}
	
	function setCssClass(string $actCssClass):void
	{
		$this->cssClass = $actCssClass;
	}
	
	function getStyle():string
	{
		return $this->style;
	}
	
	function setStyle(string $actStyle):void
	{
		$this->style = $actStyle;
	}
	
 function getBootstrapEnabled():bool
 {
 	return $this->bootstrapEnabled;
 }
 
 function setBootstrapEnabled(bool $actBootstrapEnabled):void
 {
 	$this->bootstrapEnabled = $actBootstrapEnabled;
 } 
 
 static function createHtmlWriter():Html_writer
 {
 	return Creator::create(getClassNameForCreate(Classes_info::HTML_WRITER_CLASS),STRING_NULL);
 }	
 
 function getCompleteInterfaceId(string $actSepChar=Generic_interface::INTERFACE_ID_CHAR_SEP):string
 {
 	$interfaceId = $this->getInterfaceId($actSepChar);
 	return $interfaceId;
 }
 
 function getInstanceName(string $actSepChar=Generic_interface::INTERFACE_INSTANCE_CHAR_SEP):string
 {
 	$instanceName = $this->getAppName() . $actSepChar .
 	$this->getPageName() . $actSepChar . $this->getInterfaceId($actSepChar);
 	return $instanceName;
 }
 
 function getDualInterfaceName():string
 {
 	return STRING_NULL;
 }
	
 function getHeader(array $actRow):string
 {
 	return STRING_NULL;
 }
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 }
	
}

?>